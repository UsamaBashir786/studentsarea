<?php
// student-dashboard/ajax/update_profile.php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (empty($data['name']) || empty($data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Required fields missing']);
    exit();
}

// Update session data (in real app, update database)
$_SESSION['user_name'] = $data['name'];
$_SESSION['user_email'] = $data['email'];

// Handle file upload if exists
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../uploads/avatars/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $fileName = time() . '_' . basename($_FILES['avatar']['name']);
    $targetPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
        $_SESSION['user_avatar'] = '/uploads/avatars/' . $fileName;
    }
}

echo json_encode([
    'success' => true,
    'message' => 'Profile updated successfully',
    'user' => [
        'name' => $_SESSION['user_name'],
        'email' => $_SESSION['user_email'],
        'avatar' => $_SESSION['user_avatar'] ?? ''
    ]
]);