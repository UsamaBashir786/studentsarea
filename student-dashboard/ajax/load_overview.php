<?php
// student-dashboard/ajax/load_overview.php
session_start();
require_once '../../config/database.php'; // Your database config

// Get user stats from database
$userId = $_SESSION['user_id'];

// Query database for stats
// This is a sample - implement your actual queries
$stats = [
    'total_projects' => 12,
    'completed_projects' => 8,
    'total_articles' => 5,
    'draft_articles' => 2,
    'total_earnings' => 1250,
    'pending_earnings' => 350,
    'skills_count' => 8,
    'certificates' => 3
];

$activities = [
    ['icon' => 'fas fa-code', 'title' => 'Project Completed', 'desc' => 'E-commerce Website', 'time' => '2 hours ago'],
    ['icon' => 'fas fa-newspaper', 'title' => 'Article Published', 'desc' => 'React Hooks Guide', 'time' => '1 day ago'],
    ['icon' => 'fas fa-star', 'title' => 'Skill Added', 'desc' => 'TypeScript Advanced', 'time' => '2 days ago'],
    ['icon' => 'fas fa-wallet', 'title' => 'Payment Received', 'desc' => '$250 from Freelance', 'time' => '3 days ago'],
    ['icon' => 'fas fa-comment', 'title' => 'New Comment', 'desc' => 'On your portfolio article', 'time' => '4 days ago']
];
?>

<div class="overview-content">
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-code"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['total_projects']; ?></h3>
                    <p>Total Projects</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-success"><?php echo $stats['completed_projects']; ?> Completed</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['total_articles']; ?></h3>
                    <p>Published Articles</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-warning"><?php echo $stats['draft_articles']; ?> Drafts</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-info">
                    <h3>$<?php echo $stats['total_earnings']; ?></h3>
                    <p>Total Earnings</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-info">$<?php echo $stats['pending_earnings']; ?> Pending</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['skills_count']; ?></h3>
                    <p>Skills</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-primary"><?php echo $stats['certificates']; ?> Certificates</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity & Quick Actions -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <?php foreach ($activities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="<?php echo $activity['icon']; ?>"></i>
                            </div>
                            <div class="activity-content">
                                <h6><?php echo $activity['title']; ?></h6>
                                <p><?php echo $activity['desc']; ?></p>
                                <small><?php echo $activity['time']; ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <button class="btn btn-primary w-100 mb-3" onclick="loadDashboardContent('projects')">
                            <i class="fas fa-plus me-2"></i> Start New Project
                        </button>
                        <button class="btn btn-success w-100 mb-3" onclick="loadDashboardContent('articles')">
                            <i class="fas fa-pen me-2"></i> Write Article
                        </button>
                        <button class="btn btn-info w-100 mb-3" onclick="loadDashboardContent('skills')">
                            <i class="fas fa-star me-2"></i> Add Skill
                        </button>
                        <button class="btn btn-warning w-100" onclick="loadDashboardContent('profile')">
                            <i class="fas fa-user-edit me-2"></i> Update Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>