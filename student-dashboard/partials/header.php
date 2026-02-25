<?php
// student-dashboard/partials/header.php
?>
<!-- Header -->
<header class="dashboard-header">
    <div class="header-left">
        <h4 id="pageTitle">Dashboard Overview</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active" id="breadcrumbCurrent">Overview</li>
            </ol>
        </nav>
    </div>
    
    <div class="header-right">
        <div class="header-actions">
            <button class="btn btn-sm btn-outline-primary me-2" id="quickAddBtn">
                <i class="fas fa-plus me-1"></i> Quick Add
            </button>
            
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" 
                        data-bs-toggle="dropdown">
                    <i class="fas fa-bolt me-1"></i> Quick Actions
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="loadDashboardContent('projects')">
                        <i class="fas fa-code me-2"></i> New Project
                    </a></li>
                    <li><a class="dropdown-item" href="#" onclick="loadDashboardContent('articles')">
                        <i class="fas fa-pen me-2"></i> Write Article
                    </a></li>
                    <li><a class="dropdown-item" href="#" onclick="loadDashboardContent('skills')">
                        <i class="fas fa-star me-2"></i> Add Skill
                    </a></li>
                </ul>
            </div>
        </div>
        
        <div class="header-search">
            <input type="text" class="form-control form-control-sm" 
                   placeholder="Search dashboard..." id="dashboardSearch">
            <button class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</header>