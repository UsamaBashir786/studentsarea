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
                    <div class="dropdown-menu" aria-labelledby="jobsDropdown">
                        <a class="dropdown-item" href="apply-company.php" style="color: var(--gold-accent); font-weight: 600;">
                            <i class="fas fa-building me-2"></i>Apply as Company
                        </a>
                    </div>
                </li>
                
                <!-- Projects Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Projects
                    </a>
                    <div class="dropdown-menu" aria-labelledby="projectsDropdown">
                        <div class="dropdown-header">Build Your Portfolio</div>
                                        <!-- Project Ideas -->
                        <a class="dropdown-item" href="project-ideas.php"><i class="fas fa-headset me-2"></i>Project Ideas</a>
                        <a class="dropdown-item" href="projects.php"><i class="fas fa-project-diagram me-2"></i>Browse Projects</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="sell-projects.php" style="color: var(--gold-accent); font-weight: 600;">
                            <i class="fas fa-upload me-2"></i>Sell Your Projects
                        </a>
                    </div>
                </li>
                
                <!-- Business Ideas Mega Dropdown -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Business Ideas
                        </a>
                </li>
                
                <!-- Articles -->
                <li class="nav-item">
                    <a class="nav-link" href="articles.php">Articles</a>
                </li>
                
                <!-- Become an Author -->
                <li class="nav-item">
                    <a class="nav-link" href="become-author.php">
                        <i class="fas fa-user-edit me-1"></i>Become Author
                    </a>
                </li>
                
                <!-- Live Support -->
                <li class="nav-item">
                    <a class="nav-link" href="live-support.php">
                        <i class="fas fa-headset me-1"></i>Live Support
                    </a>
                </li>
            </ul>
            
            <!-- Desktop Buttons (Right Side) -->
            <div class="desktop-buttons">
                <!-- <a href="post-job.php" class="btn-outline-secondary me-2">
                    <i class="fas fa-briefcase me-1"></i>Post a Job
                </a> -->
                <a href="login.php" class="btn-outline-secondary me-2">Login</a>
                <a href="signup.php" class="btn-secondary">Sign Up</a>
            </div>
            
            <!-- Mobile Buttons (Inside Collapse) -->
            <div class="mobile-buttons">
                <a href="post-job.php" class="btn-outline-secondary w-100 mb-2">
                    <i class="fas fa-briefcase me-1"></i>Post a Job
                </a>
                <a href="login.php" class="btn-outline-secondary w-100 mb-2">Login</a>
                <a href="signup.php" class="btn-secondary w-100">Sign Up</a>
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
</style>

<script>
const btn = document.querySelector('#scrollTopBtn');
window.addEventListener('scroll', () => {
    btn.classList.toggle('visible', window.scrollY > 500);
});
btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
</script>