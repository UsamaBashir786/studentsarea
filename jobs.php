<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remote Jobs for Students - StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/extra.min.css">
    <!-- Jobs Page CSS -->
    <style>
    .jobs-page {
        padding-top: 6rem;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .page-header {
        background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-dark) 100%);
        color: white;
        padding: 4rem 0 2rem;
        margin-bottom: 2rem;
    }
    
    .jobs-container {
        padding: 2rem 0;
    }
    
    .jobs-counter {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .loading-spinner {
        text-align: center;
        padding: 3rem;
        color: var(--luxury-blue);
    }
    
    .loading-spinner i {
        font-size: 2rem;
        margin-bottom: 1rem;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .no-jobs-found {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .pagination-container {
        margin-top: 2rem;
        text-align: center;
    }
    
    .pagination-custom .page-item.active .page-link {
        background-color: var(--luxury-blue);
        border-color: var(--luxury-blue);
    }
    
    .pagination-custom .page-link {
        color: var(--luxury-blue);
        border: 1px solid #dee2e6;
        margin: 0 3px;
        border-radius: 5px;
        padding: 0.5rem 1rem;
    }
    
    .pagination-custom .page-link:hover {
        background-color: var(--luxury-blue-light);
        color: white;
        border-color: var(--luxury-blue-light);
    }
    
    .mobile-filter-btn {
        display: none;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }
    
    .sidebar-mobile {
        position: fixed;
        top: 0;
        left: -300px;
        width: 280px;
        height: 100%;
        background: white;
        z-index: 1050;
        transition: left 0.3s ease;
        overflow-y: auto;
        padding: 1rem;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .sidebar-mobile.show {
        left: 0;
    }
    
    .mobile-sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    
    @media (max-width: 991px) {
        .mobile-filter-btn {
            display: block;
        }
        
        .sidebar-desktop {
            display: none;
        }
        
        .jobs-page {
            padding-top: 5rem;
        }
    }
    
    @media (min-width: 992px) {
        .sidebar-mobile {
            display: none;
        }
    }
    
    .apply-btn-loading {
        pointer-events: none;
        opacity: 0.7;
    }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-title mb-3" style="color: white;">Remote Jobs for Students</h1>
                    <p class="lead-text" style="color: rgba(255,255,255,0.9); margin-bottom: 0;">
                        Find flexible remote jobs that fit your student schedule. Start earning while you learn.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="apply-company.php" class="btn-secondary btn-lg">
                        <i class="fas fa-briefcase me-2"></i>Post a Job
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Jobs Container -->
    <div class="jobs-page">
        <div class="container">
            <!-- Mobile Filter Button -->
            <button class="btn-primary mobile-filter-btn" id="mobileFilterBtn">
                <i class="fas fa-filter me-2"></i>Filter Jobs
            </button>
            
            <div class="row">
                <!-- Sidebar Column -->
                <div class="col-lg-3 sidebar-desktop">
                    <?php include 'includes/jobs_sidebar.php' ?>
                </div>
                
                <!-- Jobs Listing Column -->
                <div class="col-lg-9">
                    <!-- Jobs Counter -->
                    <div class="jobs-counter">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0" id="jobsCountText">Loading jobs...</h5>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <select class="form-select form-select-sm" id="sortBy" style="width: auto; display: inline-block;">
                                    <option value="newest">Newest First</option>
                                    <option value="salary_high">Highest Salary</option>
                                    <option value="salary_low">Lowest Salary</option>
                                    <option value="deadline">Deadline Soon</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Jobs Listing Container -->
                    <div id="jobsListingContainer">
                        <!-- Jobs will be loaded here via AJAX -->
                        <div class="loading-spinner">
                            <i class="fas fa-spinner"></i>
                            <p>Loading remote jobs...</p>
                        </div>
                    </div>
                    
                    <!-- Pagination Container -->
                    <div class="pagination-container" id="paginationContainer">
                        <!-- Pagination will be loaded here via AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Mobile Sidebar -->
    <div class="sidebar-mobile" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <h5 class="mb-0">Filter Jobs</h5>
            <button class="btn-close" id="closeMobileSidebar"></button>
        </div>
        <?php include 'includes/jobs_sidebar.php' ?>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Include Scroll to Top -->
    <?php include 'includes/scrollTop.php' ?>
    
    <!-- jQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Jobs AJAX Script -->
    <script>
    $(document).ready(function() {
        // Initial variables
        let currentPage = 1;
        let filters = {
            category: '',
            job_type: '',
            experience: '',
            salary_range: '',
            remote_type: '',
            search: ''
        };
        
        // Load jobs on page load
        loadJobs();
        
        // Function to load jobs via AJAX
        function loadJobs() {
            // Show loading
            $('#jobsListingContainer').html(`
                <div class="loading-spinner">
                    <i class="fas fa-spinner"></i>
                    <p>Loading remote jobs...</p>
                </div>
            `);
            
            // Prepare data
            const data = {
                page: currentPage,
                ...filters,
                sort_by: $('#sortBy').val()
            };
            
            // AJAX request
            $.ajax({
                url: 'ajax/load_jobs.php',
                type: 'GET',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update jobs count
                        $('#jobsCountText').text(`${response.total_jobs} Remote Jobs Found`);
                        
                        // Update jobs listing
                        $('#jobsListingContainer').html(response.html);
                        
                        // Update pagination
                        if (response.pagination_html) {
                            $('#paginationContainer').html(response.pagination_html);
                        } else {
                            $('#paginationContainer').html('');
                        }
                    } else {
                        $('#jobsListingContainer').html(`
                            <div class="no-jobs-found">
                                <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                                <h4>No jobs found</h4>
                                <p>Try adjusting your filters or check back later for new opportunities.</p>
                            </div>
                        `);
                        $('#paginationContainer').html('');
                    }
                },
                error: function() {
                    $('#jobsListingContainer').html(`
                        <div class="no-jobs-found">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3 text-danger"></i>
                            <h4>Error loading jobs</h4>
                            <p>Please try again later or contact support.</p>
                            <button class="btn-primary mt-3" onclick="loadJobs()">Retry</button>
                        </div>
                    `);
                }
            });
        }
        
        // Handle filter changes
        $('.filter-option').on('change', function() {
            const filterName = $(this).data('filter');
            const filterValue = $(this).val();
            
            if ($(this).is(':checkbox')) {
                // For checkboxes, use checked value or empty
                filters[filterName] = $(this).is(':checked') ? $(this).val() : '';
            } else {
                // For other inputs
                filters[filterName] = filterValue;
            }
            
            // Reset to page 1 when filters change
            currentPage = 1;
            loadJobs();
            
            // Close mobile sidebar if open
            closeMobileSidebar();
        });
        
        // Handle search input with debounce
        let searchTimeout;
        $('#jobSearch').on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filters.search = $(this).val();
                currentPage = 1;
                loadJobs();
            }, 500);
        });
        
        // Handle sort change
        $('#sortBy').on('change', function() {
            currentPage = 1;
            loadJobs();
        });
        
        // Handle pagination clicks
        $(document).on('click', '.page-link-custom', function(e) {
            e.preventDefault();
            currentPage = $(this).data('page');
            loadJobs();
            
            // Scroll to top of jobs listing
            $('html, body').animate({
                scrollTop: $('#jobsListingContainer').offset().top - 100
            }, 500);
        });
        
        // Handle apply button clicks
        $(document).on('click', '.apply-job-btn', function() {
            const jobId = $(this).data('job-id');
            const btn = $(this);
            
            // Show loading on button
            btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Applying...');
            btn.addClass('apply-btn-loading');
            
            // Simulate API call (replace with actual API)
            setTimeout(() => {
                btn.html('<i class="fas fa-check me-2"></i>Applied');
                btn.removeClass('btn-primary').addClass('btn-success');
                btn.prop('disabled', true);
                
                // Show success message
                showNotification('Application submitted successfully!', 'success');
            }, 1500);
        });
        
        // Mobile sidebar functionality
        $('#mobileFilterBtn').on('click', function() {
            $('#mobileSidebar').addClass('show');
            $('#sidebarOverlay').show();
        });
        
        $('#closeMobileSidebar').on('click', closeMobileSidebar);
        $('#sidebarOverlay').on('click', closeMobileSidebar);
        
        function closeMobileSidebar() {
            $('#mobileSidebar').removeClass('show');
            $('#sidebarOverlay').hide();
        }
        
        // Clear all filters
        $('#clearFilters').on('click', function() {
            // Reset all filters
            filters = {
                category: '',
                job_type: '',
                experience: '',
                salary_range: '',
                remote_type: '',
                search: ''
            };
            
            // Reset form elements
            $('.filter-option').prop('checked', false).val('');
            $('.filter-select').val('');
            $('#jobSearch').val('');
            $('#sortBy').val('newest');
            
            // Reload jobs
            currentPage = 1;
            loadJobs();
            
            // Close mobile sidebar if open
            closeMobileSidebar();
        });
        
        // Notification function
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = $(`
                <div class="alert alert-${type} alert-dismissible fade show position-fixed" 
                     style="top: 80px; right: 20px; z-index: 1060; min-width: 300px;">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `);
            
            // Add to body
            $('body').append(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.alert('close');
            }, 5000);
        }
        
        // Make loadJobs available globally for retry button
        window.loadJobs = loadJobs;
    });
    </script>
</body>
</html>