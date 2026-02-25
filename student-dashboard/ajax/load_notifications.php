<?php
// student-dashboard/ajax/load_notifications.php
session_start();

// Sample notifications
$notifications = [
    [
        'id' => 1,
        'title' => 'New Comment',
        'message' => 'John Doe commented on your article',
        'time' => '2 hours ago',
        'type' => 'comment',
        'read' => false
    ],
    [
        'id' => 2,
        'title' => 'Payment Received',
        'message' => 'You received $250 for your freelance work',
        'time' => '1 day ago',
        'type' => 'payment',
        'read' => true
    ],
    [
        'id' => 3,
        'title' => 'Article Approved',
        'message' => 'Your article "React Hooks Guide" has been approved',
        'time' => '2 days ago',
        'type' => 'approval',
        'read' => true
    ],
    [
        'id' => 4,
        'title' => 'Project Deadline',
        'message' => 'Your project "E-commerce Website" deadline is in 2 days',
        'time' => '3 days ago',
        'type' => 'deadline',
        'read' => false
    ]
];
?>

<div class="notifications-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Notifications</h4>
        <div>
            <button class="btn btn-sm btn-outline-primary me-2" onclick="markAllAsRead()">
                <i class="fas fa-check-double me-1"></i> Mark All Read
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="clearAllNotifications()">
                <i class="fas fa-trash me-1"></i> Clear All
            </button>
        </div>
    </div>
    
    <!-- Notifications List -->
    <div class="card">
        <div class="card-body">
            <div class="notifications-list">
                <?php foreach ($notifications as $notification): ?>
                <div class="notification-item <?php echo $notification['read'] ? 'read' : 'unread'; ?>">
                    <div class="notification-icon">
                        <i class="fas fa-<?php 
                            echo $notification['type'] == 'comment' ? 'comment' : 
                                 ($notification['type'] == 'payment' ? 'dollar-sign' : 'bell');
                        ?>"></i>
                    </div>
                    <div class="notification-content">
                        <h6><?php echo $notification['title']; ?></h6>
                        <p><?php echo $notification['message']; ?></p>
                        <small><?php echo $notification['time']; ?></small>
                    </div>
                    <div class="notification-actions">
                        <?php if (!$notification['read']): ?>
                        <button class="btn btn-sm btn-outline-success" 
                                onclick="markAsRead(<?php echo $notification['id']; ?>)">
                            <i class="fas fa-check"></i>
                        </button>
                        <?php endif; ?>
                        <button class="btn btn-sm btn-outline-danger ms-1"
                                onclick="deleteNotification(<?php echo $notification['id']; ?>)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
function markAsRead(id) {
    $.ajax({
        url: 'ajax/mark_notification_read.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            if (response.success) {
                loadDashboardContent('notifications');
                updateNotificationCount();
            }
        }
    });
}

function markAllAsRead() {
    $.ajax({
        url: 'ajax/mark_all_notifications_read.php',
        type: 'POST',
        success: function(response) {
            if (response.success) {
                loadDashboardContent('notifications');
                updateNotificationCount();
            }
        }
    });
}

function deleteNotification(id) {
    if (confirm('Delete this notification?')) {
        $.ajax({
            url: 'ajax/delete_notification.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    loadDashboardContent('notifications');
                    updateNotificationCount();
                }
            }
        });
    }
}

function clearAllNotifications() {
    if (confirm('Clear all notifications?')) {
        $.ajax({
            url: 'ajax/clear_all_notifications.php',
            type: 'POST',
            success: function(response) {
                if (response.success) {
                    loadDashboardContent('notifications');
                    updateNotificationCount();
                }
            }
        });
    }
}

// Update notification count in sidebar
function updateNotificationCount() {
    $.ajax({
        url: 'ajax/get_notification_count.php',
        type: 'GET',
        success: function(response) {
            if (response.count !== undefined) {
                $('#notificationCount').text(response.count);
            }
        }
    });
}
</script>