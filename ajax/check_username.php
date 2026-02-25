<?php
// ajax/check_username.php
header('Content-Type: application/json');
session_start();

// Database connection (example using PDO)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=studentsarea', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['available' => false, 'message' => 'Database connection error']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // Validate username format
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        echo json_encode(['available' => false, 'message' => 'Username must be 3-20 characters (letters, numbers, underscores only)']);
        exit;
    }
    
    // Check if username exists
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo json_encode(['available' => false, 'message' => 'Username already taken']);
    } else {
        echo json_encode(['available' => true, 'message' => 'Username available']);
    }
} else {
    echo json_encode(['available' => false, 'message' => 'Invalid request']);
}
?>