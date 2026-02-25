<?php
// company-dashboard/ajax/get_notification_counts.php
session_start();

// Sample counts (replace with database)
echo json_encode([
    'notifications' => 3,
    'messages' => 5
]);
?>