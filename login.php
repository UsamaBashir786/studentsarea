<?php
// ============================================
// DATABASE CONFIGURATION - CHANGE THESE VALUES
// ============================================
$db_host = 'localhost';
$db_name = 'students';
$db_user = 'root';
$db_pass = '';

// ============================================
// START SESSION
// ============================================
session_start();

// ============================================
// DATABASE CONNECTION
// ============================================
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255),
            user_type ENUM('student', 'author', 'company', 'freelancer') NOT NULL DEFAULT 'student',
            google_id VARCHAR(100) NULL,
            profile_picture VARCHAR(255) NULL,
            remember_token VARCHAR(255) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_email (email)
        );

        CREATE TABLE IF NOT EXISTS author_applications (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            full_name VARCHAR(100) NOT NULL,
            expertise VARCHAR(100) NOT NULL,
            bio TEXT NOT NULL,
            portfolio_url VARCHAR(255),
            writing_samples TEXT,
            status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
            submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            reviewed_at TIMESTAMP NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS company_applications (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            company_name VARCHAR(100) NOT NULL,
            industry VARCHAR(50) NOT NULL,
            website VARCHAR(255) NOT NULL,
            company_size VARCHAR(50) NOT NULL,
            description TEXT NOT NULL,
            contact_person VARCHAR(100) NOT NULL,
            contact_position VARCHAR(100) NOT NULL,
            status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
            submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            reviewed_at TIMESTAMP NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS job_postings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            title VARCHAR(200) NOT NULL,
            job_type VARCHAR(50) NOT NULL,
            location VARCHAR(100) NOT NULL,
            category VARCHAR(50) NOT NULL,
            salary VARCHAR(100),
            duration VARCHAR(100),
            description TEXT NOT NULL,
            requirements TEXT NOT NULL,
            benefits TEXT,
            application_email VARCHAR(100) NOT NULL,
            status ENUM('active', 'closed', 'draft') DEFAULT 'active',
            views INT DEFAULT 0,
            applications_count INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            expires_at TIMESTAMP NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS activity_logs (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NULL,
            action VARCHAR(100) NOT NULL,
            ip_address VARCHAR(45),
            user_agent TEXT,
            details TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        );
    ");
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// ============================================
// HELPER FUNCTIONS
// ============================================

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function logActivity($pdo, $user_id, $action, $details = '') {
    try {
        $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, ip_address, user_agent, details) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $action,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? '',
            $details
        ]);
    } catch(Exception $e) {}
}

// ============================================
// HANDLE AJAX REQUESTS
// ============================================

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => 'Invalid request'];

    try {
        switch($_POST['action']) {

            case 'login':
                $email    = sanitize($_POST['email'] ?? '');
                $password = $_POST['password'] ?? '';
                $remember = isset($_POST['remember']);

                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                    $_SESSION['user_email']= $user['email'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['logged_in'] = true;

                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?")->execute([$token, $user['id']]);
                        setcookie('remember_token', $token, time() + 86400 * 30, '/');
                    }

                    logActivity($pdo, $user['id'], 'login', 'User logged in');

                    // Send redirect URL based on user type
                    $redirect = '';
                    if ($user['user_type'] === 'author')  $redirect = 'become-author.php';
                    if ($user['user_type'] === 'company') $redirect = 'apply-company.php';

                    $response = [
                        'success'  => true,
                        'message'  => 'Login successful',
                        'redirect' => $redirect,
                        'user'     => [
                            'name'  => $user['first_name'] . ' ' . $user['last_name'],
                            'email' => $user['email'],
                            'type'  => $user['user_type']
                        ]
                    ];
                } else {
                    $response = ['success' => false, 'message' => 'Invalid email or password'];
                }
                break;

            case 'register':
                $first_name = sanitize($_POST['first_name'] ?? '');
                $last_name  = sanitize($_POST['last_name']  ?? '');
                $email      = sanitize($_POST['email']      ?? '');
                $password   = $_POST['password'] ?? '';
                $user_type  = sanitize($_POST['user_type']  ?? 'student');

                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $response = ['success' => false, 'message' => 'Email already exists'];
                    break;
                }

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, user_type) VALUES (?, ?, ?, ?, ?)");

                if ($stmt->execute([$first_name, $last_name, $email, $hashed_password, $user_type])) {
                    $user_id = $pdo->lastInsertId();

                    $_SESSION['user_id']   = $user_id;
                    $_SESSION['user_name'] = $first_name . ' ' . $last_name;
                    $_SESSION['user_email']= $email;
                    $_SESSION['user_type'] = $user_type;
                    $_SESSION['logged_in'] = true;

                    logActivity($pdo, $user_id, 'register', 'New user registered');

                    // Send redirect URL based on user type
                    $redirect = 'account.php';
                    if ($user_type === 'author')  $redirect = 'become-author.php';
                    if ($user_type === 'company') $redirect = 'apply-company.php';

                    $response = [
                        'success'  => true,
                        'message'  => 'Registration successful',
                        'redirect' => $redirect,
                        'user'     => [
                            'name'  => $first_name . ' ' . $last_name,
                            'email' => $email,
                            'type'  => $user_type
                        ]
                    ];
                } else {
                    $response = ['success' => false, 'message' => 'Registration failed'];
                }
                break;

            case 'logout':
                if (isset($_SESSION['user_id'])) {
                    logActivity($pdo, $_SESSION['user_id'], 'logout', 'User logged out');
                }
                $_SESSION = [];
                session_destroy();
                if (isset($_COOKIE['remember_token'])) {
                    setcookie('remember_token', '', time() - 3600, '/');
                }
                $response = ['success' => true, 'message' => 'Logged out successfully'];
                break;

            case 'check_session':
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                    $redirect = 'account.php';
                    if ($_SESSION['user_type'] === 'author')  $redirect = 'become-author.php';
                    if ($_SESSION['user_type'] === 'company') $redirect = 'apply-company.php';

                    $response = [
                        'logged_in' => true,
                        'redirect'  => $redirect,
                        'user'      => [
                            'name'  => $_SESSION['user_name'],
                            'email' => $_SESSION['user_email'],
                            'type'  => $_SESSION['user_type']
                        ]
                    ];
                } else {
                    $response = ['logged_in' => false];
                }
                break;

            case 'submit_author':
                if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
                    $response = ['success' => false, 'message' => 'Please login first'];
                    break;
                }
                $stmt = $pdo->prepare("INSERT INTO author_applications (user_id, full_name, expertise, bio, portfolio_url, writing_samples) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([
                    $_SESSION['user_id'],
                    sanitize($_POST['full_name']       ?? ''),
                    sanitize($_POST['expertise']       ?? ''),
                    sanitize($_POST['bio']             ?? ''),
                    sanitize($_POST['portfolio_url']   ?? ''),
                    sanitize($_POST['writing_samples'] ?? '')
                ])) {
                    logActivity($pdo, $_SESSION['user_id'], 'author_application', 'Submitted author application');
                    $response = ['success' => true, 'message' => 'Author application submitted successfully!', 'redirect' => 'become-author.php'];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to submit application'];
                }
                break;

            case 'submit_company':
                if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
                    $response = ['success' => false, 'message' => 'Please login first'];
                    break;
                }
                $stmt = $pdo->prepare("INSERT INTO company_applications (user_id, company_name, industry, website, company_size, description, contact_person, contact_position) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([
                    $_SESSION['user_id'],
                    sanitize($_POST['company_name']    ?? ''),
                    sanitize($_POST['industry']        ?? ''),
                    sanitize($_POST['website']         ?? ''),
                    sanitize($_POST['company_size']    ?? ''),
                    sanitize($_POST['description']     ?? ''),
                    sanitize($_POST['contact_person']  ?? ''),
                    sanitize($_POST['contact_position']?? '')
                ])) {
                    logActivity($pdo, $_SESSION['user_id'], 'company_application', 'Submitted company application');
                    $response = ['success' => true, 'message' => 'Company application submitted successfully!', 'redirect' => 'index.php'];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to submit application'];
                }
                break;

            case 'submit_job':
                if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
                    $response = ['success' => false, 'message' => 'Please login first'];
                    break;
                }
                $stmt = $pdo->prepare("INSERT INTO job_postings (user_id, title, job_type, location, category, salary, duration, description, requirements, benefits, application_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([
                    $_SESSION['user_id'],
                    sanitize($_POST['title']             ?? ''),
                    sanitize($_POST['job_type']          ?? ''),
                    sanitize($_POST['location']          ?? ''),
                    sanitize($_POST['category']          ?? ''),
                    sanitize($_POST['salary']            ?? ''),
                    sanitize($_POST['duration']          ?? ''),
                    sanitize($_POST['description']       ?? ''),
                    sanitize($_POST['requirements']      ?? ''),
                    sanitize($_POST['benefits']          ?? ''),
                    sanitize($_POST['application_email'] ?? '')
                ])) {
                    logActivity($pdo, $_SESSION['user_id'], 'job_posting', 'Posted a job');
                    $response = ['success' => true, 'message' => 'Job posted successfully!', 'redirect' => 'index.php'];
                } else {
                    $response = ['success' => false, 'message' => 'Failed to post job'];
                }
                break;

            case 'google_login':
                $google_data = json_decode($_POST['google_data'] ?? '{}', true);
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$google_data['email']]);
                $user = $stmt->fetch();

                if ($user) {
                    if (empty($user['google_id'])) {
                        $pdo->prepare("UPDATE users SET google_id = ?, profile_picture = ? WHERE id = ?")
                            ->execute([$google_data['id'], $google_data['picture'], $user['id']]);
                    }
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                    $_SESSION['user_email']= $user['email'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['logged_in'] = true;

                    $redirect = 'account.php';
                    if ($user['user_type'] === 'author')  $redirect = 'become-author.php';
                    if ($user['user_type'] === 'company') $redirect = 'apply-company.php';

                    $response = ['success' => true, 'redirect' => $redirect];
                } else {
                    $name_parts = explode(' ', $google_data['name'], 2);
                    $first_name = $name_parts[0];
                    $last_name  = $name_parts[1] ?? '';
                    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, google_id, profile_picture, user_type) VALUES (?, ?, ?, ?, ?, 'student')");
                    if ($stmt->execute([$first_name, $last_name, $google_data['email'], $google_data['id'], $google_data['picture']])) {
                        $user_id = $pdo->lastInsertId();
                        $_SESSION['user_id']   = $user_id;
                        $_SESSION['user_name'] = $google_data['name'];
                        $_SESSION['user_email']= $google_data['email'];
                        $_SESSION['user_type'] = 'student';
                        $_SESSION['logged_in'] = true;
                        $response = ['success' => true, 'redirect' => 'account.php'];
                    }
                }
                break;
        }
    } catch(Exception $e) {
        $response = ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }

    echo json_encode($response);
    exit;
}

// Check remember me cookie
if (!isset($_SESSION['logged_in']) && isset($_COOKIE['remember_token'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token = ?");
    $stmt->execute([$_COOKIE['remember_token']]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['user_email']= $user['email'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['logged_in'] = true;
    }
}

// PHP-level redirect for already logged-in users visiting this page directly
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    if ($_SESSION['user_type'] === 'author') {
        header('Location: become-author.php');
        exit;
    } elseif ($_SESSION['user_type'] === 'company') {
        header('Location: apply-company.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentsArea | Account Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --luxury-blue: #0a2463;
            --luxury-blue-light: #1a3d8f;
            --luxury-blue-dark: #061a42;
            --gold-accent: #a39274;
            --cream-bg: #f0f2f5;
            --text-dark: #1a1a1a;
            --text-light: #ffffff;
            --border-light: rgba(10, 36, 99, 0.1);
            --section-bg: #ffffff;
            --success-color: #28a745;
            --error-color: #dc3545;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--cream-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-container {
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
        }
        
        .auth-tabs {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .nav-tabs {
            background: var(--luxury-blue);
            padding: 0;
            border: none;
        }
        
        .nav-tabs .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 0;
            padding: 1.2rem 2rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-tabs .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-tabs .nav-link.active {
            color: white;
            background-color: var(--luxury-blue-light);
            border: none;
            position: relative;
        }
        
        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--gold-accent);
        }
        
        .tab-content {
            padding: 2.5rem;
        }
        
        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-title {
            font-size: 1.8rem;
            color: var(--luxury-blue);
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--luxury-blue);
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-light);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--luxury-blue-light);
            box-shadow: 0 0 0 0.25rem rgba(10, 36, 99, 0.25);
        }
        
        .form-check-input:checked {
            background-color: var(--luxury-blue);
            border-color: var(--luxury-blue);
        }
        
        .btn-primary-custom {
            background-color: var(--luxury-blue);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--luxury-blue-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
        }
        
        .btn-primary-custom:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        
        .btn-google {
            background-color: white;
            color: #444;
            border: 2px solid #ddd;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            transform: translateY(-2px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
            color: #666;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-light);
        }
        
        .divider span {
            padding: 0 1rem;
        }
        
        .application-forms {
            display: none;
        }
        
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .form-card h3 {
            color: var(--luxury-blue);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .status-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: none;
        }
        
        .status-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.3);
            color: var(--success-color);
        }
        
        .status-error {
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: var(--error-color);
        }
        
        .user-info {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: none;
        }
        
        .user-info .welcome-text {
            font-size: 1.2rem;
            color: var(--luxury-blue);
            font-weight: 500;
        }
        
        .logout-btn {
            background-color: transparent;
            color: var(--error-color);
            border: 2px solid var(--error-color);
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: var(--error-color);
            color: white;
        }
        
        .form-toggle {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            display: none;
        }
        
        .toggle-btn {
            background: white;
            border: 2px solid var(--luxury-blue);
            color: var(--luxury-blue);
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            min-width: 200px;
            text-align: center;
        }
        
        .toggle-btn:hover {
            background-color: var(--luxury-blue);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
        }
        
        .toggle-btn.active {
            background-color: var(--luxury-blue);
            color: white;
        }
        
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }
        
        @media (max-width: 768px) {
            .tab-content {
                padding: 1.5rem;
            }
            
            .form-toggle {
                flex-direction: column;
                align-items: center;
            }
            
            .toggle-btn {
                width: 100%;
                max-width: 300px;
            }
            
            .nav-tabs .nav-link {
                padding: 1rem 1.5rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- User Info Bar -->
        <div class="user-info d-flex justify-content-between align-items-center" id="userInfo">
            <div>
                <span class="welcome-text"><i class="fas fa-user-circle me-2"></i>Welcome, <span id="userName"></span></span>
                <small class="text-muted d-block" id="userEmail"></small>
            </div>
            <button class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </div>

        <!-- Form Selection Toggle -->
        <div class="form-toggle d-flex  " id="formToggle">
            <div class="toggle-btn" data-form="become-author">
                <i class="fas fa-user-edit me-2"></i> Become an Author
            </div>
            <div class="toggle-btn" data-form="apply-company">
                <i class="fas fa-building me-2"></i> Apply as Company
            </div>
            <div class="toggle-btn" data-form="job-posting">
                <i class="fas fa-briefcase me-2"></i> Job Posting
            </div>
        </div>

        <!-- Application Forms -->
        <div class="application-forms" id="applicationForms">
            <div class="status-message" id="applicationStatus"></div>

            <!-- Become an Author Form -->
            <div class="form-card" id="becomeAuthorForm">
                <h3><i class="fas fa-user-edit me-2"></i> Become an Author</h3>
                <p class="text-muted mb-4">Share your knowledge with the student community and earn recognition.</p>

                <form id="authorApplicationForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="authorName" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="authorName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="authorExpertise" class="form-label">Area of Expertise *</label>
                                <select class="form-control" id="authorExpertise" required>
                                    <option value="">Select your expertise</option>
                                    <option value="tech">Technology & Programming</option>
                                    <option value="design">Design & Creative</option>
                                    <option value="business">Business & Marketing</option>
                                    <option value="academic">Academic Subjects</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="authorBio" class="form-label">Professional Bio *</label>
                        <textarea class="form-control" id="authorBio" placeholder="Tell us about your background, experience, and why you want to become an author..." required></textarea>
                        <small class="text-muted">Minimum 100 characters</small>
                    </div>

                    <div class="form-group">
                        <label for="authorPortfolio" class="form-label">Portfolio/LinkedIn URL</label>
                        <input type="url" class="form-control" id="authorPortfolio" placeholder="https://">
                    </div>

                    <div class="form-group">
                        <label for="authorSamples" class="form-label">Writing Samples (URLs)</label>
                        <textarea class="form-control" id="authorSamples" placeholder="Provide links to your published articles, blog posts, or writing samples..."></textarea>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="authorTerms" required>
                        <label class="form-check-label" for="authorTerms">
                            I agree to the <a href="#" class="text-primary">Author Terms & Conditions</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn-primary-custom" id="submitAuthorBtn">
                        <i class="fas fa-paper-plane me-2"></i> Submit Application
                    </button>
                </form>
            </div>

            <!-- Apply as Company Form -->
            <div class="form-card d-none" id="applyCompanyForm">
                <h3><i class="fas fa-building me-2"></i> Apply as Company</h3>
                <p class="text-muted mb-4">Register your company to post jobs and find talented students.</p>

                <form id="companyApplicationForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyName" class="form-label">Company Name *</label>
                                <input type="text" class="form-control" id="companyName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyIndustry" class="form-label">Industry *</label>
                                <select class="form-control" id="companyIndustry" required>
                                    <option value="">Select industry</option>
                                    <option value="tech">Technology</option>
                                    <option value="design">Design & Creative</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="education">Education</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="companyWebsite" class="form-label">Company Website *</label>
                        <input type="url" class="form-control" id="companyWebsite" placeholder="https://" required>
                    </div>

                    <div class="form-group">
                        <label for="companySize" class="form-label">Company Size *</label>
                        <select class="form-control" id="companySize" required>
                            <option value="">Select company size</option>
                            <option value="1-10">1-10 employees</option>
                            <option value="11-50">11-50 employees</option>
                            <option value="51-200">51-200 employees</option>
                            <option value="201-500">201-500 employees</option>
                            <option value="500+">500+ employees</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="companyDescription" class="form-label">Company Description *</label>
                        <textarea class="form-control" id="companyDescription" placeholder="Describe your company, mission, and culture..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="contactPerson" class="form-label">Contact Person *</label>
                        <input type="text" class="form-control" id="contactPerson" required>
                    </div>

                    <div class="form-group">
                        <label for="contactPosition" class="form-label">Position in Company *</label>
                        <input type="text" class="form-control" id="contactPosition" required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="companyTerms" required>
                        <label class="form-check-label" for="companyTerms">
                            I agree to the <a href="#" class="text-primary">Company Terms & Conditions</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn-primary-custom" id="submitCompanyBtn">
                        <i class="fas fa-paper-plane me-2"></i> Submit Application
                    </button>
                </form>
            </div>

            <!-- Job Posting Form -->
            <div class="form-card d-none" id="jobPostingForm">
                <h3><i class="fas fa-briefcase me-2"></i> Post a Job</h3>
                <p class="text-muted mb-4">Create a job posting to find the perfect candidate for your opportunity.</p>

                <form id="jobPostingFormElement">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobTitle" class="form-label">Job Title *</label>
                                <input type="text" class="form-control" id="jobTitle" placeholder="e.g., Frontend Developer Intern" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobType" class="form-label">Job Type *</label>
                                <select class="form-control" id="jobType" required>
                                    <option value="">Select job type</option>
                                    <option value="internship">Internship</option>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="contract">Contract</option>
                                    <option value="remote">Remote</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobLocation" class="form-label">Location *</label>
                                <input type="text" class="form-control" id="jobLocation" placeholder="e.g., Remote, New York, etc." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobCategory" class="form-label">Category *</label>
                                <select class="form-control" id="jobCategory" required>
                                    <option value="">Select category</option>
                                    <option value="tech">Technology</option>
                                    <option value="design">Design</option>
                                    <option value="writing">Writing</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="business">Business</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobSalary" class="form-label">Salary/Stipend (per month)</label>
                                <input type="text" class="form-control" id="jobSalary" placeholder="e.g., $500-$1000 or Negotiable">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobDuration" class="form-label">Duration</label>
                                <input type="text" class="form-control" id="jobDuration" placeholder="e.g., 3 months, Permanent">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jobDescription" class="form-label">Job Description *</label>
                        <textarea class="form-control" id="jobDescription" placeholder="Describe the role, responsibilities, and requirements..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="jobRequirements" class="form-label">Requirements *</label>
                        <textarea class="form-control" id="jobRequirements" placeholder="List the skills, qualifications, and experience needed..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="jobBenefits" class="form-label">Benefits/Perks</label>
                        <textarea class="form-control" id="jobBenefits" placeholder="List any benefits, perks, or learning opportunities..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="applicationEmail" class="form-label">Application Email *</label>
                        <input type="email" class="form-control" id="applicationEmail" required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="jobTerms" required>
                        <label class="form-check-label" for="jobTerms">
                            I agree to the <a href="#" class="text-primary">Job Posting Terms & Conditions</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn-primary-custom" id="submitJobBtn">
                        <i class="fas fa-paper-plane me-2"></i> Post Job
                    </button>
                </form>
            </div>
        </div>

        <!-- Auth Tabs -->
        <div class="auth-tabs" id="authTabs">
            <ul class="nav nav-tabs" id="authTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" onclick="window.location.href='index.php'">
                        <i class="fas fa-arrow-left me-2"></i> Go Back
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Login Tab -->
                <div class="tab-pane fade show active" id="login" role="tabpanel">
                    <div class="form-container">
                        <h3 class="form-title">Login to Your Account</h3>

                        <div class="status-message" id="loginStatus"></div>

                        <form id="loginForm">
                            <div class="form-group">
                                <label for="loginEmail" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email" required>
                            </div>

                            <div class="form-group">
                                <label for="loginPassword" class="form-label">Password *</label>
                                <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <a href="#" class="text-primary">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn-primary-custom mb-3" id="loginBtn">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>

                            <div class="divider">
                                <span>Or continue with</span>
                            </div>

                            <button type="button" class="btn-google mb-3" id="googleLoginBtn">
                                <i class="fab fa-google me-2"></i>
                                Login with Google
                            </button>

                            <p class="text-center text-muted">
                                Don't have an account? 
                                <a href="#" class="text-primary" id="switchToRegister">Register here</a>
                            </p>
                        </form>
                    </div>
                </div>

                <!-- Register Tab -->
                <div class="tab-pane fade" id="register" role="tabpanel">
                    <div class="form-container">
                        <h3 class="form-title">Create New Account</h3>

                        <div class="status-message" id="registerStatus"></div>

                        <form id="registerForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registerFirstName" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="registerFirstName" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="registerLastName" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="registerLastName" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="registerEmail" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="registerEmail" required>
                            </div>

                            <div class="form-group">
                                <label for="registerPassword" class="form-label">Password *</label>
                                <input type="password" class="form-control" id="registerPassword" required>
                                <small class="text-muted">Must be at least 8 characters with letters and numbers</small>
                            </div>

                            <div class="form-group">
                                <label for="registerConfirmPassword" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control" id="registerConfirmPassword" required>
                            </div>

                            <div class="form-group">
                                <label for="registerUserType" class="form-label">I want to join as *</label>
                                <select class="form-control" id="registerUserType" required>
                                    <option value="">Select account type</option>
                                    <option value="student">Student/Learner</option>
                                    <option value="author">Author/Content Creator</option>
                                    <option value="company">Company/Employer</option>
                                    <option value="freelancer">Freelancer</option>
                                </select>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="registerTerms" required>
                                <label class="form-check-label" for="registerTerms">
                                    I agree to the <a href="#" class="text-primary">Terms & Conditions</a> and <a href="#" class="text-primary">Privacy Policy</a> *
                                </label>
                            </div>

                            <button type="submit" class="btn-primary-custom mb-3" id="registerBtn">
                                <i class="fas fa-user-plus me-2"></i> Create Account
                            </button>

                            <div class="divider">
                                <span>Or sign up with</span>
                            </div>

                            <button type="button" class="btn-google mb-3" id="googleRegisterBtn">
                                <i class="fab fa-google me-2"></i>
                                Sign up with Google
                            </button>

                            <p class="text-center text-muted">
                                Already have an account? 
                                <a href="#" class="text-primary" id="switchToLogin">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
    // Check login status on page load
    checkLoginStatus();

    // Tab switching
    $('#switchToRegister').on('click', function(e) {
        e.preventDefault();
        $('#register-tab').tab('show');
    });

    $('#switchToLogin').on('click', function(e) {
        e.preventDefault();
        $('#login-tab').tab('show');
    });

    // Login Form Submission
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        const formData = {
            action: 'login',
            email: $('#loginEmail').val().trim(),
            password: $('#loginPassword').val(),
            remember: $('#rememberMe').is(':checked') ? 1 : 0
        };

        if (!formData.email || !formData.password) {
            showStatus('loginStatus', 'Please fill in all required fields.', 'error');
            return;
        }

        const $btn = $('#loginBtn');
        const originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Logging in...').prop('disabled', true);

        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showStatus('loginStatus', response.message, 'success');
                    setTimeout(() => window.location.href = response.redirect, 1000);
                } else {
                    showStatus('loginStatus', response.message, 'error');
                    $btn.html(originalText).prop('disabled', false);
                }
            },
            error: function() {
                showStatus('loginStatus', 'An error occurred. Please try again.', 'error');
                $btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Register Form Submission
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        const password = $('#registerPassword').val();
        const confirmPassword = $('#registerConfirmPassword').val();

        if (password.length < 8) {
            showStatus('registerStatus', 'Password must be at least 8 characters.', 'error');
            return;
        }

        if (password !== confirmPassword) {
            showStatus('registerStatus', 'Passwords do not match.', 'error');
            return;
        }

        if (!$('#registerTerms').is(':checked')) {
            showStatus('registerStatus', 'Please agree to the terms and conditions.', 'error');
            return;
        }

        const formData = {
            action: 'register',
            first_name: $('#registerFirstName').val().trim(),
            last_name: $('#registerLastName').val().trim(),
            email: $('#registerEmail').val().trim(),
            password: password,
            user_type: $('#registerUserType').val()
        };

        const $btn = $('#registerBtn');
        const originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Creating account...').prop('disabled', true);

        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showStatus('registerStatus', response.message, 'success');
                    setTimeout(() => window.location.href = response.redirect, 1500);
                } else {
                    showStatus('registerStatus', response.message, 'error');
                    $btn.html(originalText).prop('disabled', false);
                }
            },
            error: function() {
                showStatus('registerStatus', 'An error occurred. Please try again.', 'error');
                $btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Google Login/Register
    $('#googleLoginBtn, #googleRegisterBtn').on('click', function() {
        showStatus('loginStatus', 'Redirecting to Google...', 'success');

        const googleData = {
            id: 'google_' + Math.random().toString(36).substr(2, 9),
            name: 'Google User',
            email: 'user' + Math.random().toString(36).substr(2, 5) + '@gmail.com',
            picture: 'https://via.placeholder.com/150'
        };

        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: {
                action: 'google_login',
                google_data: JSON.stringify(googleData)
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    showStatus('loginStatus', response.message, 'error');
                }
            }
        });
    });

    // Logout
    $('#logoutBtn').on('click', function() {
        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: { action: 'logout' },
            dataType: 'json',
            success: function() {
                window.location.href = 'index.php';
            }
        });
    });

    // Form Toggle
    $('.toggle-btn').on('click', function() {
        const formId = $(this).data('form');

        $('.toggle-btn').removeClass('active');
        $(this).addClass('active');

        $('#becomeAuthorForm, #applyCompanyForm, #jobPostingForm').addClass('d-none');

        if (formId === 'become-author') {
            $('#becomeAuthorForm').removeClass('d-none');
        } else if (formId === 'apply-company') {
            $('#applyCompanyForm').removeClass('d-none');
        } else if (formId === 'job-posting') {
            $('#jobPostingForm').removeClass('d-none');
        }
    });

    // Author Application Form
    $('#authorApplicationForm').on('submit', function(e) {
        e.preventDefault();

        if (!$('#authorTerms').is(':checked')) {
            showStatus('applicationStatus', 'Please agree to the terms and conditions.', 'error');
            return;
        }

        const formData = {
            action: 'submit_author',
            full_name: $('#authorName').val(),
            expertise: $('#authorExpertise').val(),
            bio: $('#authorBio').val(),
            portfolio_url: $('#authorPortfolio').val(),
            writing_samples: $('#authorSamples').val()
        };

        const $btn = $('#submitAuthorBtn');
        const originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...').prop('disabled', true);

        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showStatus('applicationStatus', response.message, 'success');
                    $('#authorApplicationForm')[0].reset();
                    setTimeout(() => window.location.href = response.redirect, 1500);
                } else {
                    showStatus('applicationStatus', response.message, 'error');
                }
                $btn.html(originalText).prop('disabled', false);
            },
            error: function() {
                showStatus('applicationStatus', 'An error occurred. Please try again.', 'error');
                $btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Company Application Form
    $('#companyApplicationForm').on('submit', function(e) {
        e.preventDefault();

        if (!$('#companyTerms').is(':checked')) {
            showStatus('applicationStatus', 'Please agree to the terms and conditions.', 'error');
            return;
        }

        const formData = {
            action: 'submit_company',
            company_name: $('#companyName').val(),
            industry: $('#companyIndustry').val(),
            website: $('#companyWebsite').val(),
            company_size: $('#companySize').val(),
            description: $('#companyDescription').val(),
            contact_person: $('#contactPerson').val(),
            contact_position: $('#contactPosition').val()
        };

        const $btn = $('#submitCompanyBtn');
        const originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...').prop('disabled', true);

        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showStatus('applicationStatus', response.message, 'success');
                    $('#companyApplicationForm')[0].reset();
                    setTimeout(() => window.location.href = response.redirect, 1500);
                } else {
                    showStatus('applicationStatus', response.message, 'error');
                }
                $btn.html(originalText).prop('disabled', false);
            },
            error: function() {
                showStatus('applicationStatus', 'An error occurred. Please try again.', 'error');
                $btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Job Posting Form
    $('#jobPostingFormElement').on('submit', function(e) {
        e.preventDefault();

        if (!$('#jobTerms').is(':checked')) {
            showStatus('applicationStatus', 'Please agree to the terms and conditions.', 'error');
            return;
        }

        const formData = {
            action: 'submit_job',
            title: $('#jobTitle').val(),
            job_type: $('#jobType').val(),
            location: $('#jobLocation').val(),
            category: $('#jobCategory').val(),
            salary: $('#jobSalary').val(),
            duration: $('#jobDuration').val(),
            description: $('#jobDescription').val(),
            requirements: $('#jobRequirements').val(),
            benefits: $('#jobBenefits').val(),
            application_email: $('#applicationEmail').val()
        };

        const $btn = $('#submitJobBtn');
        const originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Posting...').prop('disabled', true);

        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showStatus('applicationStatus', response.message, 'success');
                    $('#jobPostingFormElement')[0].reset();
                    setTimeout(() => window.location.href = response.redirect, 1500);
                } else {
                    showStatus('applicationStatus', response.message, 'error');
                }
                $btn.html(originalText).prop('disabled', false);
            },
            error: function() {
                showStatus('applicationStatus', 'An error occurred. Please try again.', 'error');
                $btn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Check login status
    function checkLoginStatus() {
        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: { action: 'check_session' },
            dataType: 'json',
            success: function(response) {
                if (response.logged_in) {
                    // Redirect immediately based on user type
                    window.location.href = response.redirect;
                } else {
                    $('#authTabs').show();
                    $('#userInfo').hide();
                    $('#formToggle').hide();
                    $('#applicationForms').hide();
                    $('#login-tab').tab('show');
                }
            }
        });
    }

    // Show status messages
    function showStatus(elementId, message, type) {
        const element = $(`#${elementId}`);
        element.removeClass('status-success status-error').addClass(`status-${type}`);
        element.html(message).fadeIn();
    }
});
</script>
</body>
</html>