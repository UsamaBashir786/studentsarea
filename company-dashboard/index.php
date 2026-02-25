<?php
// company-dashboard/index.php
session_start();

// Check if company is logged in
// if (!isset($_SESSION['company_id'])) {
//     header('Location: ../login.php?redirect=company-dashboard');
//     exit();
// }

// Company data from session/database
$company = [
    'id' => $_SESSION['company_id'],
    'name' => $_SESSION['company_name'] ?? 'Company',
    'email' => $_SESSION['company_email'] ?? '',
    'logo' => $_SESSION['company_logo'] ?? 'https://randomuser.me/api/portraits/lego/1.jpg',
    'plan' => $_SESSION['company_plan'] ?? 'premium',
    'status' => $_SESSION['company_status'] ?? 'active'
];

// Dashboard stats (from database)
$stats = [
    'active_jobs' => 8,
    'total_jobs' => 24,
    'total_applicants' => 156,
    'shortlisted' => 32,
    'interviews' => 18,
    'hired' => 12,
    'messages' => 42,
    'profile_views' => 245
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard - StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Company Dashboard CSS -->
    <link rel="stylesheet" href="assets/css/company-dashboard.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/main.min.css">
    
    <style>
    .company-dashboard {
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
    
    /* Company Theme Colors */
    .company-primary {
        background: #0a2463 !important;
        color: white !important;
    }
    
    .company-secondary {
        background: #a39274 !important;
        color: #0a2463 !important;
    }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Dashboard Wrapper -->
    <div class="company-dashboard">
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
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Company Dashboard JS -->
    <script src="assets/js/company-dashboard.js"></script>
    
    <script>
    // Initialize company dashboard
    $(document).ready(function() {
        // Load overview by default
        loadCompanyContent('overview');
        
        // Handle navigation clicks
        $('.nav-link[data-section]').on('click', function(e) {
            e.preventDefault();
            const section = $(this).data('section');
            loadCompanyContent(section);
            
            // Update active state
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
        });
        
        // Handle mobile sidebar toggle
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').toggleClass('collapsed');
            $('.main-content').toggleClass('expanded');
        });
        
        // Quick action buttons
        $('#postJobBtn').on('click', function() {
            showPostJobModal();
        });
        
        // Search functionality
        $('#dashboardSearch').on('keyup', function() {
            const query = $(this).val();
            if (query.length > 2) {
                searchDashboard(query);
            }
        });
    });
    
    // Function to load company content
    function loadCompanyContent(section) {
        showLoading();
        
        $.ajax({
            url: `ajax/load_${section}.php`,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#dashboardContent').html(response);
                hideLoading();
                
                // Update page title
                updatePageTitle(section);
                
                // Initialize section-specific scripts
                if (section === 'overview') {
                    initCompanyCharts();
                } else if (section === 'applicants' || section === 'jobs') {
                    initDataTables();
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
    
    // Update page title
    function updatePageTitle(section) {
        const titles = {
            'overview': 'Dashboard Overview',
            'jobs': 'Job Postings',
            'applicants': 'Applicants',
            'analytics': 'Analytics',
            'company': 'Company Profile',
            'messages': 'Messages',
            'candidates': 'Candidate Pool',
            'reports': 'Reports'
        };
        
        $('#pageTitle').text(titles[section] || section);
        $('#breadcrumbCurrent').text(titles[section] || section);
    }
    
    // Initialize charts
    function initCompanyCharts() {
        // Applications Chart
        const applicationsCtx = document.getElementById('applicationsChart');
        if (applicationsCtx) {
            new Chart(applicationsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Applications',
                        data: [65, 78, 90, 120, 85, 110],
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
                    }
                }
            });
        }
        
        // Hiring Pipeline Chart
        const pipelineCtx = document.getElementById('pipelineChart');
        if (pipelineCtx) {
            new Chart(pipelineCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Applied', 'Screened', 'Interview', 'Hired'],
                    datasets: [{
                        data: [156, 85, 32, 12],
                        backgroundColor: [
                            '#6c757d',
                            '#ffc107',
                            '#0dcaf0',
                            '#198754'
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
    }
    
    // Initialize DataTables
    function initDataTables() {
        $('.data-table').DataTable({
            pageLength: 10,
            responsive: true,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries"
            }
        });
    }
    
    // Show post job modal
    function showPostJobModal() {
        $.ajax({
            url: 'ajax/post_job.php',
            type: 'GET',
            success: function(response) {
                $('#postJobModal').remove();
                $('body').append(response);
                $('#postJobModal').modal('show');
            }
        });
    }
    
    // Search dashboard
    function searchDashboard(query) {
        $.ajax({
            url: 'ajax/search.php',
            type: 'GET',
            data: { q: query },
            success: function(response) {
                $('#searchResults').remove();
                $('body').append(response);
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
    
    // Notification function
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="alert alert-${type} alert-dismissible fade show position-fixed top-3 end-3" 
                 style="z-index: 9999; max-width: 350px;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 
                                   type === 'error' ? 'exclamation-circle' : 
                                   'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
        
        $('.alert.position-fixed').remove();
        $('body').append(notification);
        
        setTimeout(() => {
            notification.alert('close');
        }, 5000);
    }
    </script>
</body>
</html>