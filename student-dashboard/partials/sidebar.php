<?php
// student-dashboard/partials/sidebar.php
$currentSection = $_GET['section'] ?? 'overview';
?>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <div class="user-info">
            <img src="<?php echo $user['avatar']; ?>" alt="<?php echo htmlspecialchars($user['name']); ?>" class="user-avatar">
            <div class="user-details">
                <h6><?php echo htmlspecialchars($user['name']); ?></h6>
                <span class="badge bg-primary"><?php echo ucfirst($user['role']); ?></span>
            </div>
        </div>
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'overview' ? 'active' : ''; ?>" 
                   href="#" data-section="overview">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Overview</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'projects' ? 'active' : ''; ?>" 
                   href="#" data-section="projects">
                    <i class="fas fa-code"></i>
                    <span>Projects</span>
                    <span class="badge bg-success float-end"><?php echo $stats['total_projects']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'articles' ? 'active' : ''; ?>" 
                   href="#" data-section="articles">
                    <i class="fas fa-newspaper"></i>
                    <span>My Articles</span>
                    <span class="badge bg-info float-end"><?php echo $stats['total_articles']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'earnings' ? 'active' : ''; ?>" 
                   href="#" data-section="earnings">
                    <i class="fas fa-wallet"></i>
                    <span>Earnings</span>
                    <span class="badge bg-warning float-end">$<?php echo $stats['total_earnings']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'skills' ? 'active' : ''; ?>" 
                   href="#" data-section="skills">
                    <i class="fas fa-star"></i>
                    <span>Skills</span>
                    <span class="badge bg-primary float-end"><?php echo $stats['skills_count']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'notifications' ? 'active' : ''; ?>" 
                   href="#" data-section="notifications">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                    <span class="badge bg-danger float-end" id="notificationCount">3</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <hr>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'profile' ? 'active' : ''; ?>" 
                   href="#" data-section="profile">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'settings' ? 'active' : ''; ?>" 
                   href="#" data-section="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="sidebar-footer">
        <div class="progress-card">
            <h6>Profile Completion</h6>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 75%"></div>
            </div>
            <small>75% complete</small>
        </div>
    </div>
</div>