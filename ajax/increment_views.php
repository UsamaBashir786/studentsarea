<?php
// Increment article view count
header('Content-Type: application/json');

$articleId = $_POST['article_id'] ?? 0;

// In real app, update view count in database
// For demo, just return success

echo json_encode([
    'success' => true,
    'message' => 'View count updated'
]);
?>