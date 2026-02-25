<?php
// company-dashboard/partials/header.php
?>
<!-- Header -->
<header class="dashboard-header">
    <div class="header-left">
        <button class="sidebar-toggle-btn d-lg-none me-3" id="mobileSidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div>
            <h4 id="pageTitle">Company Dashboard</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="../companies.php">Companies</a></li>
                    <li class="breadcrumb-item active" id="breadcrumbCurrent">Overview</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="header-right">
        <!-- Search -->
        <div class="header-search me-3 d-none d-md-block">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" 
                       placeholder="Search jobs, applicants..." 
                       id="dashboardSearch"
                       aria-label="Search dashboard">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        
        <!-- Notifications -->
        <div class="header-notifications dropdown me-3">
            <button class="btn btn-sm btn-outline-secondary position-relative dropdown-toggle" 
                    type="button" 
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    id="notificationDropdown">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                      id="notificationBadge">
                    3
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                <li class="dropdown-header">Notifications</li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <small>New applicant for Frontend Developer</small>
                                <div class="text-muted">2 minutes ago</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <small>Interview scheduled tomorrow</small>
                                <div class="text-muted">1 hour ago</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-envelope text-success"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <small>New message from candidate</small>
                                <div class="text-muted">3 hours ago</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center" href="#" onclick="loadCompanyContent('notifications')">
                    View All Notifications
                </a></li>
            </ul>
        </div>
        
        <!-- Messages -->
        <div class="header-messages dropdown me-3">
            <button class="btn btn-sm btn-outline-secondary position-relative dropdown-toggle" 
                    type="button" 
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    id="messageDropdown">
                <i class="fas fa-envelope"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                      id="messageBadge">
                    5
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messageDropdown">
                <li class="dropdown-header">Messages</li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                     class="rounded-circle" width="30" height="30" alt="User">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <small><strong>John Doe</strong></small>
                                <div class="text-muted">Are you available for an interview?</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                                     class="rounded-circle" width="30" height="30" alt="User">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <small><strong>Sarah Johnson</strong></small>
                                <div class="text-muted">Thanks for the opportunity!</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center" href="#" onclick="loadCompanyContent('messages')">
                    View All Messages
                </a></li>
            </ul>
        </div>
        
        <!-- User Profile -->
        <div class="header-profile dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" 
                    type="button" 
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    id="profileDropdown">
                <img src="<?php echo $company['logo']; ?>" 
                     alt="<?php echo htmlspecialchars($company['name']); ?>" 
                     class="rounded-circle me-2" 
                     width="32" 
                     height="32">
                <span class="d-none d-md-inline"><?php echo htmlspecialchars($company['name']); ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li class="dropdown-header"><?php echo htmlspecialchars($company['email']); ?></li>
                <li><a class="dropdown-item" href="#" onclick="loadCompanyContent('company')">
                    <i class="fas fa-building me-2"></i>Company Profile
                </a></li>
                <li><a class="dropdown-item" href="#" onclick="loadCompanyContent('settings')">
                    <i class="fas fa-cog me-2"></i>Settings
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../logout.php">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a></li>
            </ul>
        </div>
        
        <!-- Quick Action Button -->
        <button class="btn btn-primary ms-3 d-none d-md-inline-flex align-items-center" 
                id="postJobBtn">
            <i class="fas fa-plus me-2"></i>Post Job
        </button>
    </div>
</header>

<script>
// Search functionality
$('#searchButton').on('click', function() {
    const query = $('#dashboardSearch').val();
    if (query.trim() !== '') {
        searchDashboard(query);
    }
});

$('#dashboardSearch').on('keypress', function(e) {
    if (e.which === 13) { // Enter key
        const query = $(this).val();
        if (query.trim() !== '') {
            searchDashboard(query);
        }
    }
});

function searchDashboard(query) {
    $.ajax({
        url: 'ajax/search.php',
        type: 'GET',
        data: { q: query },
        success: function(response) {
            $('#dashboardContent').html(response);
            $('#pageTitle').text('Search Results');
            $('#breadcrumbCurrent').text('Search');
        }
    });
}

// Mobile sidebar toggle
$('#mobileSidebarToggle').on('click', function() {
    $('.sidebar').toggleClass('show');
    $('.sidebar-overlay').toggleClass('show');
});

// Close sidebar when clicking overlay
$('.sidebar-overlay').on('click', function() {
    $('.sidebar').removeClass('show');
    $(this).removeClass('show');
});

// Update notification and message counts
function updateNotificationCounts() {
    $.ajax({
        url: 'ajax/get_notification_counts.php',
        type: 'GET',
        success: function(response) {
            if (response.notifications !== undefined) {
                $('#notificationBadge').text(response.notifications);
            }
            if (response.messages !== undefined) {
                $('#messageBadge').text(response.messages);
            }
        }
    });
}

// Update counts every 30 seconds
setInterval(updateNotificationCounts, 30000);

// Initialize counts on page load
$(document).ready(function() {
    updateNotificationCounts();
});
</script>