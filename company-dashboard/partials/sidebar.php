<?php
// company-dashboard/partials/sidebar.php
$currentSection = $_GET['section'] ?? 'overview';
?>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <div class="company-info">
            <img src="<?php echo $company['logo']; ?>" alt="<?php echo htmlspecialchars($company['name']); ?>" class="company-logo">
            <div class="company-details">
                <h6><?php echo htmlspecialchars($company['name']); ?></h6>
                <span class="badge bg-success"><?php echo ucfirst($company['plan']); ?> Plan</span>
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
                <a class="nav-link <?php echo $currentSection == 'jobs' ? 'active' : ''; ?>" 
                   href="#" data-section="jobs">
                    <i class="fas fa-briefcase"></i>
                    <span>Job Postings</span>
                    <span class="badge bg-primary float-end"><?php echo $stats['active_jobs']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'applicants' ? 'active' : ''; ?>" 
                   href="#" data-section="applicants">
                    <i class="fas fa-users"></i>
                    <span>Applicants</span>
                    <span class="badge bg-info float-end"><?php echo $stats['total_applicants']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'analytics' ? 'active' : ''; ?>" 
                   href="#" data-section="analytics">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                    <span class="badge bg-warning float-end">New</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'messages' ? 'active' : ''; ?>" 
                   href="#" data-section="messages">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                    <span class="badge bg-danger float-end"><?php echo $stats['messages']; ?></span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'candidates' ? 'active' : ''; ?>" 
                   href="#" data-section="candidates">
                    <i class="fas fa-user-tie"></i>
                    <span>Candidate Pool</span>
                    <span class="badge bg-success float-end">245</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <hr>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'company' ? 'active' : ''; ?>" 
                   href="#" data-section="company">
                    <i class="fas fa-building"></i>
                    <span>Company Profile</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo $currentSection == 'reports' ? 'active' : ''; ?>" 
                   href="#" data-section="reports">
                    <i class="fas fa-file-alt"></i>
                    <span>Reports</span>
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
        <div class="plan-status">
            <h6>Plan Status</h6>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 65%"></div>
            </div>
            <small>65% of job posts used</small>
            <a href="#" class="btn btn-sm btn-outline-light w-100 mt-2">
                <i class="fas fa-rocket me-1"></i> Upgrade Plan
            </a>
        </div>
    </div>
</div>