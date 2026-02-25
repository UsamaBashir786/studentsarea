<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Articles & Guides - Learn & Grow | StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/extra.min.css">
    <!-- Articles Page CSS -->
    <style>
    .articles-page {
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
    
    .articles-container {
        padding: 2rem 0;
    }
    
    .articles-counter {
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
    
    .no-articles-found {
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
    
    /* Article Type Tabs */
    .article-type-tabs {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .article-tab {
        padding: 0.75rem 1.5rem;
        border: none;
        background: none;
        color: #666;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .article-tab.active {
        background: var(--luxury-blue);
        color: white;
    }
    
    .article-tab:hover:not(.active) {
        background: #f0f2f5;
        color: var(--luxury-blue);
    }
    
    /* ===== ARTICLE LIST LAYOUT ===== */
    .article-list-item {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        display: block;
        text-decoration: none;
        color: inherit;
    }
    
    .article-list-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-color: var(--luxury-blue-light);
        text-decoration: none;
        color: inherit;
    }
    
    .article-list-item.featured {
        border-left: 4px solid var(--gold-accent);
        background: linear-gradient(to right, rgba(163, 146, 116, 0.05), white);
    }
    
    .article-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    
    .article-category {
        display: inline-block;
        padding: 0.3rem 1rem;
        background: var(--luxury-blue);
        color: white;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-right: 1rem;
    }
    
    .article-date {
        color: #666;
        font-size: 0.9rem;
    }
    
    .article-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--luxury-blue);
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }
    
    .article-title:hover {
        color: var(--luxury-blue-light);
    }
    
    .article-excerpt {
        color: #555;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .article-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .author-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .author-details h6 {
        margin: 0;
        font-size: 0.95rem;
        color: var(--luxury-blue);
    }
    
    .author-details small {
        color: #666;
        font-size: 0.85rem;
    }
    
    .article-stats {
        display: flex;
        gap: 1.5rem;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }
    
    .stat-item i {
        color: var(--luxury-blue);
    }
    
    .article-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }
    
    .article-tag {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        background: rgba(163, 146, 116, 0.1);
        color: var(--luxury-blue);
        border-radius: 4px;
        font-size: 0.85rem;
        text-decoration: none;
        border: 1px solid rgba(163, 146, 116, 0.2);
    }
    
    .article-tag:hover {
        background: var(--gold-accent);
        color: var(--luxury-blue);
    }
    
    .read-more {
        color: var(--luxury-blue);
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }
    
    .read-more:hover {
        color: var(--luxury-blue-light);
        gap: 0.7rem;
    }
    
    /* Featured Badge */
    .featured-badge {
        display: inline-block;
        background: var(--gold-accent);
        color: var(--luxury-blue);
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-right: 0.8rem;
    }
    
    /* Popular Articles */
    .popular-articles {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .popular-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .popular-item {
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .popular-item:hover {
        background: #f8f9fa;
        padding-left: 0.5rem;
    }
    
    .popular-item:last-child {
        border-bottom: none;
    }
    
    .popular-rank {
        display: inline-block;
        width: 24px;
        height: 24px;
        background: var(--luxury-blue);
        color: white;
        border-radius: 4px;
        text-align: center;
        line-height: 24px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-right: 0.8rem;
    }
    
    .popular-title {
        font-weight: 500;
        color: var(--luxury-blue);
        font-size: 0.95rem;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Newsletter */
    .newsletter-card {
        background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-dark) 100%);
        color: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 1.5rem;
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
    
    /* Responsive Design */
    @media (max-width: 991px) {
        .mobile-filter-btn {
            display: block;
        }
        
        .sidebar-desktop {
            display: none;
        }
        
        .articles-page {
            padding-top: 5rem;
        }
        
        .article-tab {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .article-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .article-stats {
            justify-content: flex-start;
        }
    }
    
    @media (min-width: 992px) {
        .sidebar-mobile {
            display: none;
        }
    }
    
    @media (max-width: 768px) {
        .article-title {
            font-size: 1.2rem;
        }
        
        .article-excerpt {
            font-size: 0.95rem;
            -webkit-line-clamp: 3;
        }
        
        .article-stats {
            gap: 1rem;
        }
    }
    
    /* Loading Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .article-list-item {
        animation: fadeIn 0.5s ease forwards;
    }
    
    /* Difficulty Badge */
    .difficulty-badge {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
    
    .difficulty-beginner {
        background: #d4edda;
        color: #155724;
    }
    
    .difficulty-intermediate {
        background: #fff3cd;
        color: #856404;
    }
    
    .difficulty-advanced {
        background: #f8d7da;
        color: #721c24;
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
                    <h1 class="display-title mb-3" style="color: white;">Student Articles & Guides</h1>
                    <p class="lead-text" style="color: rgba(255,255,255,0.9); margin-bottom: 0;">
                        Learn from expert articles, tutorials, and guides to boost your skills and career.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="submit-article.php" class="btn-secondary btn-lg">
                        <i class="fas fa-pen me-2"></i>Write Article
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Articles Container -->
    <div class="articles-page">
        <div class="container">
            <!-- Mobile Filter Button -->
            <button class="btn-primary mobile-filter-btn" id="mobileFilterBtn">
                <i class="fas fa-filter me-2"></i>Filter Articles
            </button>
            
            <div class="row">
                <!-- Sidebar Column -->
                <div class="col-lg-3 sidebar-desktop">
                    <?php include 'includes/articles_sidebar.php' ?>
                </div>
                
                <!-- Articles Listing Column -->
                <div class="col-lg-9">
                    <!-- Article Type Tabs -->
                    <div class="article-type-tabs">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="article-tab active" data-type="all">All Articles</button>
                            <button class="article-tab" data-type="tutorials">Tutorials</button>
                            <button class="article-tab" data-type="guides">Guides</button>
                            <button class="article-tab" data-type="career">Career Advice</button>
                            <button class="article-tab" data-type="tech">Tech News</button>
                            <button class="article-tab" data-type="trending">Trending</button>
                        </div>
                    </div>
                    
                    <!-- Articles Counter -->
                    <div class="articles-counter">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0" id="articlesCountText">Loading articles...</h5>
                                <p class="text-muted mb-0" id="articlesSummary" style="font-size: 0.9rem;"></p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <select class="form-select form-select-sm" id="sortBy" style="width: auto; display: inline-block;">
                                    <option value="newest">Newest First</option>
                                    <option value="popular">Most Popular</option>
                                    <option value="views">Most Views</option>
                                    <option value="reading_time">Shortest Read</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Articles Listing Container -->
                    <div id="articlesListingContainer">
                        <!-- Articles will be loaded here via AJAX -->
                        <div class="loading-spinner">
                            <i class="fas fa-spinner"></i>
                            <p>Loading articles...</p>
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
            <h5 class="mb-0">Filter Articles</h5>
            <button class="btn-close" id="closeMobileSidebar"></button>
        </div>
        <?php include 'includes/articles_sidebar.php' ?>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Include Scroll to Top -->
    <?php include 'includes/scrollTop.php' ?>
    
    <!-- jQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Articles AJAX Script -->
    <script>
    $(document).ready(function() {
        // Initial variables
        let currentPage = 1;
        let currentType = 'all';
        let filters = {
            category: '',
            tag: '',
            difficulty: '',
            reading_time: '',
            search: '',
            sort_by: 'newest'
        };
        
        // Load articles on page load
        loadArticles();
        
        // Function to load articles via AJAX
        function loadArticles() {
            // Show loading
            $('#articlesListingContainer').html(`
                <div class="loading-spinner">
                    <i class="fas fa-spinner"></i>
                    <p>Loading articles...</p>
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
                url: 'ajax/load_articles.php',
                type: 'GET',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update articles count
                        $('#articlesCountText').text(`${response.total_articles} Articles Found`);
                        $('#articlesSummary').text(response.summary || '');
                        
                        // Update articles listing
                        $('#articlesListingContainer').html(response.html);
                        
                        // Update pagination
                        if (response.pagination_html) {
                            $('#paginationContainer').html(response.pagination_html);
                        } else {
                            $('#paginationContainer').html('');
                        }
                    } else {
                        $('#articlesListingContainer').html(`
                            <div class="no-articles-found">
                                <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                                <h4>No articles found</h4>
                                <p>Try adjusting your filters or check back later for new articles.</p>
                            </div>
                        `);
                        $('#paginationContainer').html('');
                    }
                },
                error: function() {
                    $('#articlesListingContainer').html(`
                        <div class="no-articles-found">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3 text-danger"></i>
                            <h4>Error loading articles</h4>
                            <p>Please try again later or contact support.</p>
                            <button class="btn-primary mt-3" onclick="loadArticles()">Retry</button>
                        </div>
                    `);
                }
            });
        }
        
        // Handle article type tabs
        $('.article-tab').on('click', function() {
            $('.article-tab').removeClass('active');
            $(this).addClass('active');
            currentType = $(this).data('type');
            currentPage = 1;
            loadArticles();
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
            loadArticles();
            
            // Close mobile sidebar if open
            closeMobileSidebar();
        });
        
        // Handle search input with debounce
        let searchTimeout;
        $('#articleSearch').on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filters.search = $(this).val();
                currentPage = 1;
                loadArticles();
            }, 500);
        });
        
        // Handle tag clicks
        $(document).on('click', '.tag', function(e) {
            e.preventDefault();
            const tag = $(this).data('tag');
            filters.tag = tag;
            currentPage = 1;
            loadArticles();
        });
        
        // Handle sort change
        $('#sortBy').on('change', function() {
            filters.sort_by = $(this).val();
            currentPage = 1;
            loadArticles();
        });
        
        // Handle pagination clicks
        $(document).on('click', '.page-link-custom', function(e) {
            e.preventDefault();
            currentPage = $(this).data('page');
            loadArticles();
            
            // Scroll to top of articles listing
            $('html, body').animate({
                scrollTop: $('#articlesListingContainer').offset().top - 100
            }, 500);
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
                tag: '',
                difficulty: '',
                reading_time: '',
                search: '',
                sort_by: 'newest'
            };
            
            // Reset form elements
            $('.filter-option').prop('checked', false).val('');
            $('.filter-select').val('');
            $('#articleSearch').val('');
            $('#sortBy').val('newest');
            $('.article-tab[data-type="all"]').click();
            
            // Reload articles
            currentPage = 1;
            loadArticles();
            
            // Close mobile sidebar if open
            closeMobileSidebar();
        });
        
        // Newsletter subscription
        $('#subscribeBtn').on('click', function() {
            const email = $('#newsletterEmail').val();
            const btn = $(this);
            
            if (!email || !isValidEmail(email)) {
                showNotification('Please enter a valid email address.', 'error');
                return;
            }
            
            const originalText = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...');
            btn.prop('disabled', true);
            
            // Simulate subscription
            setTimeout(() => {
                btn.html(originalText);
                btn.prop('disabled', false);
                $('#newsletterEmail').val('');
                showNotification('Successfully subscribed to newsletter!', 'success');
            }, 1500);
        });
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
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
        
        // Keyboard shortcuts
        $(document).on('keydown', function(e) {
            // Escape closes sidebar
            if (e.key === 'Escape') {
                closeMobileSidebar();
            }
            
            // Ctrl/Cmd + F focuses search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                $('#articleSearch').focus();
            }
        });
        
        // Make functions available globally
        window.loadArticles = loadArticles;
    });
    </script>
</body>
</html>