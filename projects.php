<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Projects - Build Your Portfolio | StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/extra.min.css">
    <!-- Projects Page CSS -->
    <style>
    .projects-page {
        padding-top: 6rem;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .page-header {
        background: linear-gradient(135deg, #1a3d8f 0%, #0a2463 100%);
        color: white;
        padding: 4rem 0 2rem;
        margin-bottom: 2rem;
    }
    
    .projects-container {
        padding: 2rem 0;
    }
    
    .projects-counter {
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
    
    .no-projects-found {
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
    
    /* Project Type Tabs */
    .project-type-tabs {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .project-tab {
        padding: 0.75rem 1.5rem;
        border: none;
        background: none;
        color: #666;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .project-tab.active {
        background: var(--luxury-blue);
        color: white;
    }
    
    .project-tab:hover:not(.active) {
        background: #f0f2f5;
        color: var(--luxury-blue);
    }
    
    /* ===== PROJECT CARDS CSS ===== */
    .project-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #e9ecef;
        position: relative;
    }
    
    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        border-color: var(--luxury-blue-light);
    }
    
    /* Image/Thumbnail Section */
    .project-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .project-card:hover .project-image {
        transform: scale(1.05);
    }
    
    /* Difficulty Badge */
    .difficulty-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        z-index: 2;
    }
    
    .difficulty-badge.beginner {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #b1dfbb;
    }
    
    .difficulty-badge.intermediate {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border: 1px solid #ffdf7e;
    }
    
    .difficulty-badge.advanced {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f1b0b7;
    }
    
    /* Price Badge */
    .price-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        z-index: 2;
    }
    
    .price-badge.free {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    .price-badge.premium {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: #212529;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }
    
    /* Discount Price */
    .discount-price {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        padding: 0.5rem;
        border-radius: 8px;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .original-price {
        color: #999;
        text-decoration: line-through;
        font-size: 0.8rem;
        display: block;
        text-align: right;
    }
    
    .discounted-price {
        color: #28a745;
        font-weight: 700;
        font-size: 1rem;
        display: block;
    }
    
    .discount-percent {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #dc3545;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    /* Card Body */
    .project-card-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .project-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--luxury-blue);
        margin-bottom: 0.3rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .project-subtitle {
        font-size: 1rem;
        color: #666;
        margin-bottom: 1rem;
        font-weight: 500;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .project-description {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Tags Section */
    .project-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .project-tag {
        background: rgba(163, 146, 116, 0.1);
        color: var(--luxury-blue);
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid rgba(163, 146, 116, 0.2);
    }
    
    /* Stats Section */
    .project-stats {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }
    
    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
    }
    
    .stat-icon {
        font-size: 1.2rem;
        margin-bottom: 0.3rem;
        color: var(--luxury-blue);
    }
    
    .stat-count {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--luxury-blue);
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.3rem;
    }
    
    .stat-divider {
        width: 1px;
        height: 40px;
        background: #dee2e6;
    }
    
    /* Buttons Section */
    .project-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: auto;
    }
    
    .action-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: 2px solid transparent;
        cursor: pointer;
    }
    
    .action-btn.preview {
        background: transparent;
        color: var(--luxury-blue);
        border-color: var(--luxury-blue);
    }
    
    .action-btn.preview:hover {
        background: var(--luxury-blue);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(10, 36, 99, 0.2);
    }
    
    .action-btn.download {
        background: var(--luxury-blue);
        color: white;
    }
    
    .action-btn.download:hover {
        background: var(--luxury-blue-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(10, 36, 99, 0.3);
    }
    
    .action-btn.purchase {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: #212529;
        border: none;
    }
    
    .action-btn.purchase:hover {
        background: linear-gradient(135deg, #fd7e14, #e8590c);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(253, 126, 20, 0.3);
        color: #212529;
    }
    
    /* Featured Projects */
    .project-card.featured {
        border: 2px solid var(--gold-accent);
    }
    
    .featured-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--gold-accent);
        color: var(--luxury-blue);
        padding: 0.3rem 1.5rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        z-index: 3;
        box-shadow: 0 2px 8px rgba(163, 146, 116, 0.3);
    }
    
    /* Save Button */
    .save-btn {
        position: absolute;
        top: 60px;
        right: 15px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 2;
    }
    
    .save-btn:hover {
        background: white;
        border-color: var(--gold-accent);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transform: scale(1.1);
    }
    
    .save-btn i {
        color: #666;
        font-size: 1rem;
        transition: color 0.3s ease;
    }
    
    .save-btn:hover i,
    .save-btn.saved i {
        color: #dc3545;
    }
    
    .save-btn.saved i {
        animation: heartBeat 0.5s ease;
    }
    
    @keyframes heartBeat {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }
    
    /* Button Loading State */
    .btn-loading {
        pointer-events: none;
        opacity: 0.7;
    }
    
    /* Custom Notification */
    .custom-notification {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 1060;
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* Project Preview Modal */
    .preview-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.8);
        z-index: 1060;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    
    .preview-modal.show {
        display: flex;
    }
    
    .preview-content {
        background: white;
        border-radius: 15px;
        max-width: 900px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
    }
    
    .close-preview {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1;
    }
    
    .close-preview:hover {
        background: rgba(0,0,0,0.7);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .project-image-container {
            height: 180px;
        }
        
        .project-card-body {
            padding: 1.25rem;
        }
        
        .project-title {
            font-size: 1.2rem;
        }
        
        .project-actions {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .action-btn {
            padding: 0.6rem;
        }
        
        .project-stats {
            padding: 0.75rem;
        }
        
        .stat-count {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .project-image-container {
            height: 160px;
        }
        
        .difficulty-badge,
        .price-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.8rem;
        }
        
        .project-title {
            font-size: 1.1rem;
        }
        
        .project-subtitle {
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 991px) {
        .mobile-filter-btn {
            display: block;
        }
        
        .sidebar-desktop {
            display: none;
        }
        
        .projects-page {
            padding-top: 5rem;
        }
        
        .project-tab {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
    
    @media (min-width: 992px) {
        .sidebar-mobile {
            display: none;
        }
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
                    <h1 class="display-title mb-3" style="color: white;">Student Projects</h1>
                    <p class="lead-text" style="color: rgba(255,255,255,0.9); margin-bottom: 0;">
                        Build your portfolio with real-world projects. Free projects to learn, premium projects to earn.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="sell-projects.php" class="btn-secondary btn-lg">
                        <i class="fas fa-upload me-2"></i>Sell Your Project
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Projects Container -->
    <div class="projects-page">
        <div class="container">
            <!-- Mobile Filter Button -->
            <button class="btn-primary mobile-filter-btn" id="mobileFilterBtn">
                <i class="fas fa-filter me-2"></i>Filter Projects
            </button>
            
            <div class="row">
                <!-- Sidebar Column -->
                <div class="col-lg-3 sidebar-desktop">
                    <?php include 'includes/projects_sidebar.php' ?>
                </div>
                
                <!-- Projects Listing Column -->
                <div class="col-lg-9">
                    <!-- Project Type Tabs -->
                    <div class="project-type-tabs">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="project-tab active" data-type="all">All Projects</button>
                            <button class="project-tab" data-type="free">Free Projects</button>
                            <button class="project-tab" data-type="premium">Premium Projects</button>
                            <button class="project-tab" data-type="featured">Featured</button>
                            <button class="project-tab" data-type="trending">Trending</button>
                        </div>
                    </div>
                    
                    <!-- Projects Counter -->
                    <div class="projects-counter">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0" id="projectsCountText">Loading projects...</h5>
                                <p class="text-muted mb-0" id="projectsSummary" style="font-size: 0.9rem;"></p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <select class="form-select form-select-sm" id="sortBy" style="width: auto; display: inline-block;">
                                    <option value="newest">Newest First</option>
                                    <option value="popular">Most Popular</option>
                                    <option value="rating">Highest Rated</option>
                                    <option value="downloads">Most Downloads</option>
                                    <option value="price_low">Price: Low to High</option>
                                    <option value="price_high">Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Projects Listing Container -->
                    <div id="projectsListingContainer">
                        <!-- Projects will be loaded here via AJAX -->
                        <div class="loading-spinner">
                            <i class="fas fa-spinner"></i>
                            <p>Loading projects...</p>
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
    
    <!-- Project Preview Modal -->
    <div class="preview-modal" id="projectPreviewModal">
        <div class="preview-content">
            <button class="close-preview" id="closePreview">
                <i class="fas fa-times"></i>
            </button>
            <div id="previewContent">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Mobile Sidebar -->
    <div class="sidebar-mobile" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <h5 class="mb-0">Filter Projects</h5>
            <button class="btn-close" id="closeMobileSidebar"></button>
        </div>
        <?php include 'includes/projects_sidebar.php' ?>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v2.php' ?>
    
    
    <!-- jQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Projects AJAX Script -->
    <script>
    $(document).ready(function() {
        // Initial variables
        let currentPage = 1;
        let currentType = 'all';
        let filters = {
            category: '',
            difficulty: '',
            price_type: '',
            duration: '',
            language: '',
            search: '',
            sort_by: 'newest'
        };
        
        // Load projects on page load
        loadProjects();
        
        // Function to load projects via AJAX
        function loadProjects() {
            // Show loading
            $('#projectsListingContainer').html(`
                <div class="loading-spinner">
                    <i class="fas fa-spinner"></i>
                    <p>Loading projects...</p>
                </div>
            `);
            
            // Prepare data
            const data = {
                page: currentPage,
                type: currentType,
                ...filters,
                sort_by: $('#sortBy').val()
            };
            
            // AJAX request
            $.ajax({
                url: 'ajax/load_projects.php',
                type: 'GET',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update projects count
                        $('#projectsCountText').text(`${response.total_projects} Projects Found`);
                        $('#projectsSummary').text(response.summary || '');
                        
                        // Update projects listing
                        $('#projectsListingContainer').html(response.html);
                        
                        // Update pagination
                        if (response.pagination_html) {
                            $('#paginationContainer').html(response.pagination_html);
                        } else {
                            $('#paginationContainer').html('');
                        }
                    } else {
                        $('#projectsListingContainer').html(`
                            <div class="no-projects-found">
                                <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                                <h4>No projects found</h4>
                                <p>Try adjusting your filters or check back later for new projects.</p>
                            </div>
                        `);
                        $('#paginationContainer').html('');
                    }
                },
                error: function() {
                    $('#projectsListingContainer').html(`
                        <div class="no-projects-found">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3 text-danger"></i>
                            <h4>Error loading projects</h4>
                            <p>Please try again later or contact support.</p>
                            <button class="btn-primary mt-3" onclick="loadProjects()">Retry</button>
                        </div>
                    `);
                }
            });
        }
        
        // Handle project type tabs
        $('.project-tab').on('click', function() {
            $('.project-tab').removeClass('active');
            $(this).addClass('active');
            currentType = $(this).data('type');
            currentPage = 1;
            loadProjects();
        });
        
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
            loadProjects();
            
            // Close mobile sidebar if open
            closeMobileSidebar();
        });
        
        // Handle search input with debounce
        let searchTimeout;
        $('#projectSearch').on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filters.search = $(this).val();
                currentPage = 1;
                loadProjects();
            }, 500);
        });
        
        // Handle sort change
        $('#sortBy').on('change', function() {
            filters.sort_by = $(this).val();
            currentPage = 1;
            loadProjects();
        });
        
        // Handle pagination clicks
        $(document).on('click', '.page-link-custom', function(e) {
            e.preventDefault();
            currentPage = $(this).data('page');
            loadProjects();
            
            // Scroll to top of projects listing
            $('html, body').animate({
                scrollTop: $('#projectsListingContainer').offset().top - 100
            }, 500);
        });
        
        // Handle save button clicks
        $(document).on('click', '.save-btn', function() {
            const btn = $(this);
            const icon = btn.find('i');
            
            // Toggle save state
            if (icon.hasClass('far')) {
                // Save project
                btn.addClass('saved');
                icon.removeClass('far').addClass('fas');
                showNotification('Project saved to favorites!', 'success');
            } else {
                // Unsave project
                btn.removeClass('saved');
                icon.removeClass('fas').addClass('far');
                showNotification('Project removed from favorites.', 'info');
            }
        });
        
        // Handle preview button clicks
        $(document).on('click', '.action-btn.preview', function() {
            const projectId = $(this).closest('.project-card').find('.download-project-btn').data('project-id');
            showProjectPreview(projectId);
        });
        
        // Handle download/purchase button clicks
        $(document).on('click', '.download-project-btn', function() {
            const btn = $(this);
            const projectId = btn.data('project-id');
            const isPremium = btn.hasClass('purchase');
            
            // Show loading
            const originalHtml = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin me-1"></i> Processing...');
            btn.addClass('btn-loading');
            
            if (isPremium) {
                // Premium project - show purchase modal
                setTimeout(() => {
                    const confirmPurchase = confirm('Complete purchase for $19.99?');
                    if (confirmPurchase) {
                        btn.html('<i class="fas fa-check me-1"></i> Purchased');
                        btn.removeClass('purchase').addClass('download');
                        showNotification('Purchase successful! Project downloaded.', 'success');
                    } else {
                        btn.html(originalHtml);
                        btn.removeClass('btn-loading');
                    }
                }, 1000);
            } else {
                // Free project - download
                setTimeout(() => {
                    btn.html('<i class="fas fa-check me-1"></i> Downloaded');
                    showNotification('Project downloaded successfully!', 'success');
                    
                    // Reset button after 2 seconds
                    setTimeout(() => {
                        btn.html(originalHtml);
                        btn.removeClass('btn-loading');
                    }, 2000);
                }, 1500);
            }
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
                difficulty: '',
                price_type: '',
                duration: '',
                language: '',
                search: '',
                sort_by: 'newest'
            };
            
            // Reset form elements
            $('.filter-option').prop('checked', false).val('');
            $('.filter-select').val('');
            $('#projectSearch').val('');
            $('#sortBy').val('newest');
            $('.project-tab[data-type="all"]').click();
            
            // Reload projects
            currentPage = 1;
            loadProjects();
            
            // Close mobile sidebar if open
            closeMobileSidebar();
        });
        
        // Preview modal functionality
        $('#closePreview').on('click', function() {
            $('#projectPreviewModal').removeClass('show');
        });
        
        $(document).on('click', function(e) {
            if ($(e.target).hasClass('preview-modal')) {
                $('#projectPreviewModal').removeClass('show');
            }
        });
        
        // Function to show project preview
        function showProjectPreview(projectId) {
            // Show loading in modal
            $('#previewContent').html(`
                <div class="text-center p-5">
                    <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                    <p>Loading preview...</p>
                </div>
            `);
            
            // Show modal
            $('#projectPreviewModal').addClass('show');
            
            // Load preview content
            setTimeout(() => {
                $('#previewContent').html(`
                    <div class="project-preview">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=900&q=80" 
                                 class="project-image" alt="Project Preview" style="width:100%;height:300px;object-fit:cover;">
                        </div>
                        
                        <div class="p-4">
                            <h3 class="mb-3">E-commerce Website with React</h3>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p><strong>Category:</strong> Web Development</p>
                                    <p><strong>Difficulty:</strong> <span class="badge intermediate" style="background:#fff3cd;color:#856404;padding:0.2rem 0.8rem;border-radius:4px;">Intermediate</span></p>
                                    <p><strong>Time Required:</strong> 15-20 hours</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Primary Language:</strong> JavaScript</p>
                                    <p><strong>Downloads:</strong> 1,250+</p>
                                    <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐ (4.8/5.0)</p>
                                </div>
                            </div>
                            
                            <h5 class="mb-3">Project Description</h5>
                            <p class="mb-4">Build a fully functional e-commerce website from scratch using React for the frontend, Node.js for the backend, and MongoDB for the database. This project will teach you full-stack development with modern technologies.</p>
                            
                            <h5 class="mb-3">Features</h5>
                            <ul class="mb-4">
                                <li>User authentication & authorization</li>
                                <li>Product catalog with categories</li>
                                <li>Shopping cart functionality</li>
                                <li>Payment integration (Stripe)</li>
                                <li>Order management system</li>
                                <li>Admin dashboard</li>
                            </ul>
                            
                            <h5 class="mb-3">Technologies Used</h5>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <span class="badge bg-primary">React</span>
                                <span class="badge bg-primary">Node.js</span>
                                <span class="badge bg-primary">MongoDB</span>
                                <span class="badge bg-primary">Express.js</span>
                                <span class="badge bg-primary">Redux</span>
                                <span class="badge bg-primary">JWT</span>
                                <span class="badge bg-primary">Stripe API</span>
                            </div>
                            
                            <div class="mt-4 pt-4 border-top">
                                <button class="btn-primary btn-lg w-100" onclick="downloadProject(${projectId})">
                                    <i class="fas fa-download me-2"></i>Download Project Files
                                </button>
                                <p class="text-center text-muted mt-2 mb-0">Includes: Source code, documentation, and setup guide</p>
                            </div>
                        </div>
                    </div>
                `);
            }, 1000);
        }
        
        // Function to download project
        window.downloadProject = function(projectId) {
            showNotification('Starting download...', 'info');
            $('#projectPreviewModal').removeClass('show');
            
            // Simulate download
            setTimeout(() => {
                showNotification('Project downloaded successfully!', 'success');
            }, 1500);
        };
        
        // Notification function
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            $('.custom-notification').remove();
            
            // Icon based on type
            let icon = 'info-circle';
            if (type === 'success') icon = 'check-circle';
            if (type === 'error') icon = 'exclamation-circle';
            
            // Create notification element
            const notification = $(`
                <div class="alert alert-${type} custom-notification alert-dismissible fade show">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${icon} me-2"></i>
                        <div>${message}</div>
                    </div>
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
        
        // Make loadProjects available globally for retry button
        window.loadProjects = loadProjects;
        
        // Keyboard shortcuts
        $(document).on('keydown', function(e) {
            // Escape closes modals
            if (e.key === 'Escape') {
                $('#projectPreviewModal').removeClass('show');
                closeMobileSidebar();
            }
            
            // Ctrl/Cmd + F focuses search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                $('#projectSearch').focus();
            }
        });
    });
    </script>
</body>
</html>