<?php
// company-dashboard/ajax/get_announcements.php
session_start();

// Sample announcements (replace with database)
echo json_encode([
    'announcements' => [
        [
            'title' => 'New Feature: Candidate Matching',
            'message' => 'We\'ve launched an AI-powered candidate matching system to help you find the best candidates faster.',
            'link' => 'features.php#candidate-matching'
        ]
    ]
]);
?>