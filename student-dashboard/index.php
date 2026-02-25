<?php
// student-dashboard/index.php
session_start();

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../login.php?redirect=dashboard');
//     exit();
// }

// User data from session/database
$user = [
    'id' => $_SESSION['user_id'],
    'name' => $_SESSION['user_name'] ?? 'Student',
    'email' => $_SESSION['user_email'] ?? '',
    'avatar' => $_SESSION['user_avatar'] ?? 'https://randomuser.me/api/portraits/men/32.jpg',
    'role' => $_SESSION['user_role'] ?? 'student',
    'status' => $_SESSION['user_status'] ?? 'active'
];

// Get dashboard stats (this would come from database)
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <!-- Main CSS (from root) -->
    <link rel="stylesheet" href="../assets/css/main.min.css">
    
    <style>
    /* Additional inline styles for dashboard */
    .dashboard-wrapper {
        min-height: 100vh;
        background: #f0f2f5;
    }
    
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        display: none;
    }
    
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #0a2463;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Dashboard Wrapper -->
    <div class="dashboard-wrapper">
        <?php include 'partials/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <?php include 'partials/header.php'; ?>
            
            <!-- Dynamic Content Area -->
            <div class="content-wrapper">
                <div id="dashboardContent">
                    <!-- Content will be loaded here via AJAX -->
                    <?php include 'partials/overview.php'; ?>
                </div>
            </div>
            
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Dashboard JS -->
    <script src="assets/js/dashboard.js"></script>
    
    <script>
    // Initialize dashboard
    $(document).ready(function() {
        // Load overview by default
        loadDashboardContent('overview');
        
        // Handle navigation clicks
        $('.nav-link[data-section]').on('click', function(e) {
            e.preventDefault();
            const section = $(this).data('section');
            loadDashboardContent(section);
            
            // Update active state
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
        });
        
        // Handle mobile sidebar toggle
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').toggleClass('collapsed');
            $('.main-content').toggleClass('expanded');
        });
    });
    
    // Function to load dashboard content
    function loadDashboardContent(section) {
        showLoading();
        
        $.ajax({
            url: `ajax/load_${section}.php`,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#dashboardContent').html(response);
                hideLoading();
                
                // Initialize section-specific scripts
                if (section === 'overview') {
                    initCharts();
                }
            },
            error: function(xhr, status, error) {
                $('#dashboardContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error loading content. Please try again.
                    </div>
                `);
                hideLoading();
            }
        });
    }
    
    // Show/hide loading
    function showLoading() {
        $('#loadingOverlay').fadeIn();
    }
    
    function hideLoading() {
        $('#loadingOverlay').fadeOut();
    }
    
    // Initialize charts for overview
    function initCharts() {
        // Projects Progress Chart
        const projectsCtx = document.getElementById('projectsChart');
        if (projectsCtx) {
            new Chart(projectsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'In Progress', 'Not Started'],
                    datasets: [{
                        data: [8, 3, 1],
                        backgroundColor: [
                            '#28a745',
                            '#ffc107',
                            '#dc3545'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
        
        // Activity Chart
        const activityCtx = document.getElementById('activityChart');
        if (activityCtx) {
            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Activity',
                        data: [12, 19, 8, 15, 22, 18, 14],
                        borderColor: '#0a2463',
                        backgroundColor: 'rgba(10, 36, 99, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
    </script>
</body>
</html>