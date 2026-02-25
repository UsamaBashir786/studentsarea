<?php
// company-dashboard/ajax/get_footer_stats.php
session_start();

// Sample stats (replace with database)
echo json_encode([
    'stats' => [
        'active_jobs' => 8,
        'pending_applications' => 12,
        'total_hires' => 24
    ]
]);
?>