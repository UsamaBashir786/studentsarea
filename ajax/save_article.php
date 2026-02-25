<?php
// Save/Unsave article handler
header('Content-Type: application/json');

$articleId = $_POST['article_id'] ?? 0;
$action = $_POST['action'] ?? 'save';

// In real app, save to database
// For demo, just return success

echo json_encode([
    'success' => true,
    'message' => $action === 'save' ? 'Article saved' : 'Article unsaved'
]);
?>