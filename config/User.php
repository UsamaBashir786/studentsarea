<?php
// config/User.php
require_once 'database.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $user_type;
    public $google_id;
    public $profile_picture;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Register new user
    public function register() {
        try {
            // Check if email already exists
            if ($this->emailExists()) {
                return array("success" => false, "message" => "Email already exists.");
            }

            $query = "INSERT INTO " . $this->table_name . "
                    (first_name, last_name, email, password, user_type, google_id, profile_picture)
                    VALUES
                    (:first_name, :last_name, :email, :password, :user_type, :google_id, :profile_picture)";

            $stmt = $this->conn->prepare($query);

            // Sanitize inputs
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->user_type = htmlspecialchars(strip_tags($this->user_type));
            
            // Hash password
            $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

            // Bind parameters
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":user_type", $this->user_type);
            $stmt->bindParam(":google_id", $this->google_id);
            $stmt->bindParam(":profile_picture", $this->profile_picture);

            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                return array(
                    "success" => true,
                    "message" => "User registered successfully.",
                    "user_id" => $this->id
                );
            }
            return array("success" => false, "message" => "Registration failed.");
        } catch (PDOException $e) {
            return array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    }

    // Login user
    public function login($email, $password, $remember = false) {
        try {
            $query = "SELECT id, first_name, last_name, email, password, user_type, google_id 
                     FROM " . $this->table_name . " 
                     WHERE email = :email LIMIT 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (password_verify($password, $row['password'])) {
                    // Set session variables
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['first_name'] . ' ' . $row['last_name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['logged_in'] = true;

                    // Handle remember me
                    if ($remember) {
                        $this->setRememberMe($row['id']);
                    }

                    // Log activity
                    $this->logActivity($row['id'], 'login', 'User logged in');

                    return array(
                        "success" => true,
                        "message" => "Login successful.",
                        "user" => array(
                            "id" => $row['id'],
                            "name" => $row['first_name'] . ' ' . $row['last_name'],
                            "email" => $row['email'],
                            "type" => $row['user_type']
                        )
                    );
                }
            }
            return array("success" => false, "message" => "Invalid email or password.");
        } catch (PDOException $e) {
            return array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    }

    // Google login/register
    public function googleLogin($google_data) {
        try {
            // Check if user exists with this google_id or email
            $query = "SELECT * FROM " . $this->table_name . " 
                     WHERE google_id = :google_id OR email = :email LIMIT 1";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":google_id", $google_data['id']);
            $stmt->bindParam(":email", $google_data['email']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // User exists, update google_id if not set
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (empty($user['google_id'])) {
                    $update = "UPDATE " . $this->table_name . " 
                              SET google_id = :google_id, profile_picture = :picture 
                              WHERE id = :id";
                    $update_stmt = $this->conn->prepare($update);
                    $update_stmt->bindParam(":google_id", $google_data['id']);
                    $update_stmt->bindParam(":picture", $google_data['picture']);
                    $update_stmt->bindParam(":id", $user['id']);
                    $update_stmt->execute();
                }

                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['logged_in'] = true;

                return array(
                    "success" => true,
                    "user" => array(
                        "id" => $user['id'],
                        "name" => $user['first_name'] . ' ' . $user['last_name'],
                        "email" => $user['email'],
                        "type" => $user['user_type']
                    )
                );
            } else {
                // Create new user
                $name_parts = explode(' ', $google_data['name'], 2);
                $this->first_name = $name_parts[0];
                $this->last_name = isset($name_parts[1]) ? $name_parts[1] : '';
                $this->email = $google_data['email'];
                $this->password = ''; // No password for Google users
                $this->user_type = 'student'; // Default type
                $this->google_id = $google_data['id'];
                $this->profile_picture = $google_data['picture'];

                return $this->register();
            }
        } catch (PDOException $e) {
            return array("success" => false, "message" => "Database error: " . $e->getMessage());
        }
    }

    // Check if email exists
    public function emailExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Set remember me token
    private function setRememberMe($user_id) {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+30 days'));

        $query = "UPDATE " . $this->table_name . " 
                 SET remember_token = :token 
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":id", $user_id);
        
        if ($stmt->execute()) {
            setcookie('remember_token', $token, strtotime('+30 days'), '/', '', false, true);
        }
    }

    // Log user activity
    private function logActivity($user_id, $action, $details) {
        $query = "INSERT INTO activity_logs (user_id, action, ip_address, user_agent, details) 
                 VALUES (:user_id, :action, :ip_address, :user_agent, :details)";
        
        $stmt = $this->conn->prepare($query);
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":action", $action);
        $stmt->bindParam(":ip_address", $ip);
        $stmt->bindParam(":user_agent", $agent);
        $stmt->bindParam(":details", $details);
        $stmt->execute();
    }

    // Logout user
    public function logout() {
        if (isset($_SESSION['user_id'])) {
            $this->logActivity($_SESSION['user_id'], 'logout', 'User logged out');
        }
        
        $_SESSION = array();
        session_destroy();
        
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
    }

    // Get user by ID
    public function getUserById($id) {
        $query = "SELECT id, first_name, last_name, email, user_type, profile_picture 
                 FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }
}
?>