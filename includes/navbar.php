<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$userType = $isLoggedIn ? ($_SESSION['user_type'] ?? '') : '';
$userName = $isLoggedIn ? ($_SESSION['user_name'] ?? 'User') : '';
$userEmail = $isLoggedIn ? ($_SESSION['user_email'] ?? '') : '';
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand navbar-brand-custom" href="index.php">
            Students<span>Area</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-toggler-icon-custom"></span>
        </button>
        
        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Center Navigation Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                
                <!-- Remote Jobs Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="jobsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Remote Jobs
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="jobsDropdown">
                        <?php if ($isLoggedIn && $userType === 'company'): ?>
                            <li><a class="dropdown-item" href="post-job.php" style="color: var(--gold-accent); font-weight: 600;">
                                <i class="fas fa-plus-circle me-2"></i>Post a Job
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="browse-jobs.php">
                            <i class="fas fa-search me-2"></i>Browse Jobs
                        </a></li>
                        <li><a class="dropdown-item" href="apply-company.php" style="color: var(--gold-accent); font-weight: 600;">
                            <i class="fas fa-building me-2"></i>Apply as Company
                        </a></li>
                    </ul>
                </li>
                
                <!-- Projects Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Projects
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="projectsDropdown">
                        <li><span class="dropdown-header">Build Your Portfolio</span></li>
                        <li><a class="dropdown-item" href="project-ideas.php"><i class="fas fa-lightbulb me-2"></i>Project Ideas</a></li>
                        <li><a class="dropdown-item" href="projects.php"><i class="fas fa-project-diagram me-2"></i>Browse Projects</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php if ($isLoggedIn && ($userType === 'author' || $userType === 'freelancer')): ?>
                        <li><a class="dropdown-item" href="sell-projects.php" style="color: var(--gold-accent); font-weight: 600;">
                            <i class="fas fa-upload me-2"></i>Sell Your Projects
                        </a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                
                <!-- Business Ideas -->
                <li class="nav-item">
                    <a class="nav-link" href="business-ideas.php">
                        Business Ideas
                    </a>
                </li>
                
                <!-- Articles -->
                <li class="nav-item">
                    <a class="nav-link" href="articles.php">Articles</a>
                </li>
                
                <!-- Become an Author - Hide if user is already author or has pending application -->
                <?php if (!$isLoggedIn || ($userType !== 'author' && $userType !== 'company')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="become-author.php">
                        <i class="fas fa-user-edit me-1"></i>Become Author
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- Live Support -->
                <li class="nav-item">
                    <a class="nav-link" href="live-support.php">
                        <i class="fas fa-headset me-1"></i>Live Support
                    </a>
                </li>
            </ul>
            
            <!-- Desktop Buttons (Right Side) -->
            <div class="desktop-buttons d-flex align-items-center">
                <?php if ($isLoggedIn): ?>
                    <!-- User Dropdown for Logged In Users -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo htmlspecialchars(explode(' ', $userName)[0]); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><span class="dropdown-item-text text-muted"><small>Logged in as <?php echo htmlspecialchars($userType); ?></small></span></li>
                            <li><hr class="dropdown-divider"></li>
                            
                            <?php if ($userType === 'author'): ?>
                                <li><a class="dropdown-item" href="author-dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="my-applications.php"><i class="fas fa-file-alt me-2"></i>My Applications</a></li>
                            <?php elseif ($userType === 'company'): ?>
                                <li><a class="dropdown-item" href="company-dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="my-jobs.php"><i class="fas fa-briefcase me-2"></i>My Jobs</a></li>
                                <li><a class="dropdown-item" href="post-job.php"><i class="fas fa-plus-circle me-2"></i>Post a Job</a></li>
                            <?php elseif ($userType === 'student'): ?>
                                <li><a class="dropdown-item" href="student-dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="my-applications.php"><i class="fas fa-file-alt me-2"></i>My Applications</a></li>
                            <?php endif; ?>
                            
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-cog me-2"></i>Profile Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); logoutUser();"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Login/Signup for Guests -->
                    <a href="login.php" class="btn-outline-secondary me-2">Login</a>
                    <a href="signup.php" class="btn-secondary">Sign Up</a>
                <?php endif; ?>
            </div>
            
            <!-- Mobile Buttons (Inside Collapse) -->
            <div class="mobile-buttons mt-3">
                <?php if ($isLoggedIn): ?>
                    <!-- Mobile User Info -->
                    <div class="p-3 mb-2 bg-light rounded">
                        <p class="mb-1"><strong><i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($userName); ?></strong></p>
                        <p class="mb-2 small text-muted"><?php echo htmlspecialchars($userType); ?></p>
                        
                        <?php if ($userType === 'author'): ?>
                            <a href="author-dashboard.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                            <a href="my-applications.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-file-alt me-2"></i>My Applications</a>
                        <?php elseif ($userType === 'company'): ?>
                            <a href="company-dashboard.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                            <a href="my-jobs.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-briefcase me-2"></i>My Jobs</a>
                            <a href="post-job.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-plus-circle me-2"></i>Post a Job</a>
                        <?php elseif ($userType === 'student'): ?>
                            <a href="student-dashboard.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                            <a href="my-applications.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-file-alt me-2"></i>My Applications</a>
                        <?php endif; ?>
                        
                        <a href="profile.php" class="btn btn-outline-secondary w-100 mb-2"><i class="fas fa-user-cog me-2"></i>Profile Settings</a>
                        <a href="#" class="btn btn-danger w-100" onclick="event.preventDefault(); logoutUser();"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                    </div>
                <?php else: ?>
                    <!-- Mobile Login/Signup -->
                    <a href="post-job.php" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="fas fa-briefcase me-1"></i>Post a Job
                    </a>
                    <a href="login.php" class="btn btn-outline-secondary w-100 mb-2">Login</a>
                    <a href="signup.php" class="btn btn-secondary w-100">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- includes/scrollTop.php - Animated Icon -->
<div id="scrollTopBtn" class="scroll-top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
        <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
    </svg>
</div>

<style>
.scroll-top {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 50px;
    height: 50px;
    background: #0a2463;
    border-radius: 50%;
    display: grid;
    place-items: center;
    cursor: pointer;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(10, 36, 99, 0.3);
}

.scroll-top.visible {
    opacity: 1;
    transform: translateY(0);
}

.scroll-top:hover {
    background: #1a3d8f;
    transform: translateY(-5px);
}

.scroll-top svg {
    transition: transform 0.3s;
}

.scroll-top:hover svg {
    transform: translateY(-2px);
}

/* User dropdown styles */
.dropdown-menu {
    border: none;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 0.5rem 0;
}

.dropdown-item {
    padding: 0.7rem 1.5rem;
    font-size: 0.95rem;
    transition: all 0.3s;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: var(--luxury-blue);
    padding-left: 2rem;
}

.dropdown-item.text-danger:hover {
    background-color: #fee;
}

/* Mobile buttons */
.mobile-buttons {
    display: none;
}

@media (max-width: 991.98px) {
    .desktop-buttons {
        display: none !important;
    }
    
    .mobile-buttons {
        display: block;
        padding: 1rem;
    }
    
    .btn-outline-secondary, .btn-secondary, .btn-danger {
        display: block;
        text-align: center;
        padding: 0.8rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
// Scroll to top button
const btn = document.querySelector('#scrollTopBtn');
if (btn) {
    window.addEventListener('scroll', () => {
        btn.classList.toggle('visible', window.scrollY > 500);
    });
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// Logout function
function logoutUser() {
    // Show loading state
    const logoutBtn = event?.target || document.activeElement;
    const originalText = logoutBtn.innerHTML;
    logoutBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Logging out...';
    logoutBtn.disabled = true;
    
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=logout'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect || 'index.php';
        } else {
            window.location.href = 'index.php';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        window.location.href = 'index.php';
    });
}
</script>