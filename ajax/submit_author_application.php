<?php
// ajax/submit_author_application.php
header('Content-Type: application/json');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=studentsarea', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

// Handle file upload
$uploadDir = 'uploads/author_documents/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$documentPath = null;
if (isset($_FILES['verificationDocument']) && $_FILES['verificationDocument']['error'] === UPLOAD_ERR_OK) {
    $fileName = time() . '_' . basename($_FILES['verificationDocument']['name']);
    $targetPath = $uploadDir . $fileName;
    
    // Validate file type
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
    $fileType = mime_content_type($_FILES['verificationDocument']['tmp_name']);
    
    if (in_array($fileType, $allowedTypes) && $_FILES['verificationDocument']['size'] <= 5 * 1024 * 1024) {
        if (move_uploaded_file($_FILES['verificationDocument']['tmp_name'], $targetPath)) {
            $documentPath = $targetPath;
        }
    }
}

// Get form data
$step1 = json_decode($_POST['step1'], true);
$step2 = json_decode($_POST['step2'], true);

// Generate unique application ID
$applicationId = 'AUTH' . date('Ymd') . strtoupper(uniqid());

try {
    // Begin transaction
    $pdo->beginTransaction();
    
    // Insert into author_applications table
    $stmt = $pdo->prepare("
        INSERT INTO author_applications 
        (application_id, user_id, full_name, email, username, twitter_url, linkedin_url, 
         expertise, bio, writing_style, portfolio_link, sample_article, 
         verification_document, agree_terms, agree_original, agree_quality, status, submitted_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())
    ");
    
    $stmt->execute([
        $applicationId,
        $_SESSION['user_id'],
        $step1['fullName'],
        $step1['email'],
        $step1['username'],
        $step1['twitter'] ?? null,
        $step1['linkedin'] ?? null,
        implode(',', $step2['expertise']),
        $step2['bio'],
        $step2['writingStyle'] ?? null,
        $_POST['portfolioLink'] ?? null,
        $_POST['sampleArticle'] ?? null,
        $documentPath,
        $_POST['agreeTerms'] ? 1 : 0,
        $_POST['agreeOriginal'] ? 1 : 0,
        $_POST['agreeQuality'] ? 1 : 0
    ]);
    
    // Update user role to 'author_pending'
    $stmt = $pdo->prepare("UPDATE users SET role = 'author_pending' WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    
    // Update session
    $_SESSION['user_role'] = 'author_pending';
    
    // Commit transaction
    $pdo->commit();
    
    // Send notification email (optional)
    sendNotificationEmail($step1['email'], $applicationId, $step1['fullName']);
    
   echo json_encode([
    'success' => true,
    'message' => 'Application submitted successfully!',
    'applicationId' => $applicationId,
    'redirect' => 'index.php'  // Add this line
]);
    
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

function sendNotificationEmail($email, $applicationId, $name) {
    $to = $email;
    $subject = "Author Application Received - StudentsArea";
    $message = "
    <html>
    <head>
        <title>Author Application Received</title>
    </head>
    <body>
        <h2>Hello $name,</h2>
        <p>Thank you for applying to become an author on StudentsArea!</p>
        <p><strong>Application ID:</strong> $applicationId</p>
        <p>Our team will review your application within 2-3 business days. You'll receive another email once your application is processed.</p>
        <p>Best regards,<br>StudentsArea Team</p>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@studentsarea.com" . "\r\n";
    
    mail($to, $subject, $message, $headers);
}
?>