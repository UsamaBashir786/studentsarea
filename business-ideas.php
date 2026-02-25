<?php
// business-ideas.php
$pageTitle = "Business Ideas for Students - Start Your Entrepreneurial Journey";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/extra.min.css">
    <!-- Isotope for filtering -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <style>
        /* Business Ideas Page Specific Styles */
        .business-ideas-page {
            min-height: 100vh;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--luxury-blue-light) 0%, var(--luxury-blue) 100%);
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 20px 20px;
            color: white;
        }
        
        .page-header-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .search-section {
            max-width: 600px;
            margin: 2rem auto 0;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 2.5rem 1rem 3rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--luxury-blue);
            font-size: 1.2rem;
        }
        
        /* Quick Stats */
        .quick-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold-accent);
            margin-bottom: 0.3rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* Main Layout */
        .main-content {
            padding-bottom: 5rem;
        }
        
        /* Sidebar Filters */
        .sidebar-card {
            background: var(--section-bg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }
        
        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 1.2rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        .filter-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .filter-item {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
        }
        
        .filter-checkbox {
            margin-right: 0.75rem;
            width: 18px;
            height: 18px;
            accent-color: var(--luxury-blue);
        }
        
        .filter-label {
            color: #555;
            font-size: 0.95rem;
            cursor: pointer;
            transition: color 0.3s ease;
            flex: 1;
        }
        
        .filter-label:hover {
            color: var(--luxury-blue);
        }
        
        .filter-count {
            background: rgba(10, 36, 99, 0.1);
            color: var(--luxury-blue);
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }
        
        /* Investment Range Slider */
        .investment-range {
            padding: 1rem 0;
        }
        
        .range-values {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }
        
        .range-slider {
            width: 100%;
            height: 6px;
            -webkit-appearance: none;
            background: #ddd;
            border-radius: 3px;
            outline: none;
        }
        
        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: var(--luxury-blue);
            border-radius: 50%;
            cursor: pointer;
        }
        
        /* Compact Business Grid */
        .business-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        @media (min-width: 1400px) {
            .business-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }
        
        @media (min-width: 1200px) and (max-width: 1399px) {
            .business-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (min-width: 992px) and (max-width: 1199px) {
            .business-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 991px) {
            .business-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .business-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Business Card */
        .business-card {
            background: var(--section-bg);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .business-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--gold-accent);
        }
        
        .business-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--luxury-blue-light), var(--luxury-blue));
        }
        
        .business-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .business-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .business-category {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .category-online {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        
        .category-service {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }
        
        .category-digital {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .category-physical {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }
        
        .category-education {
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
            color: white;
        }
        
        .investment-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .investment-low {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }
        
        .investment-medium {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }
        
        .investment-high {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
        
        .business-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }
        
        .business-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
            font-size: 0.95rem;
        }
        
        .business-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-light);
        }
        
        .stat-item-small {
            text-align: center;
        }
        
        .stat-number-small {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin-bottom: 0.2rem;
        }
        
        .stat-label-small {
            font-size: 0.8rem;
            color: #777;
        }
        
        .business-footer {
            margin-top: auto;
        }
        
        /* Quick Filter Tabs */
        .filter-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: var(--section-bg);
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }
        
        .filter-tab {
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            color: #555;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }
        
        .filter-tab:hover,
        .filter-tab.active {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        /* Sort Dropdown */
        .sort-dropdown {
            min-width: 200px;
        }
        
        /* Results Header */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .results-count {
            color: #666;
            font-size: 1rem;
        }
        
        /* Load More Button */
        .load-more-container {
            text-align: center;
            margin: 3rem 0;
        }
        
        .load-more-btn {
            padding: 1rem 3rem;
            font-size: 1.1rem;
            min-width: 200px;
        }
        
        /* No Results */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--section-bg);
            border-radius: 12px;
            border: 2px dashed var(--border-light);
            display: none;
        }
        
        .no-results-icon {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1.5rem;
        }
        
        /* Clear Filters Button */
        .clear-filters {
            background: transparent;
            color: var(--luxury-blue);
            border: 1px solid var(--luxury-blue);
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }
        
        .clear-filters:hover {
            background: var(--luxury-blue);
            color: white;
        }
        
        /* Earning Potential Tags */
        .earning-tag {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
            display: inline-block;
        }
        
        .earning-low {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }
        
        .earning-medium {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }
        
        .earning-high {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .business-ideas-page {
                padding-top: 80px;
            }
            
            .page-header {
                padding: 3rem 0;
                border-radius: 0 0 15px 15px;
            }
            
            .results-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .quick-stats {
                gap: 2rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .filter-tabs {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
            }
            
            .filter-tab {
                flex-shrink: 0;
            }
        }
        
        /* Loading Animation */
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-light);
            border-top-color: var(--luxury-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Featured Badge */
        .featured-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, var(--gold-accent), #8f7d5f);
            color: var(--luxury-blue);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 1;
        }
        
        .business-card.featured {
            border: 2px solid var(--gold-accent);
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Business Ideas Page -->
    <div class="business-ideas-page">
        <!-- Header -->
        <section class="page-header">
            <div class="container">
                <div class="page-header-content">
                    <h1 class="display-title" style="color: white; font-size: 3rem; margin-bottom: 1rem;">
                        Student Business Ideas
                    </h1>
                    <p class="lead-text" style="color: rgba(255,255,255,0.9);">
                        200+ proven business ideas you can start while studying. 
                        Low investment, high potential opportunities for student entrepreneurs.
                    </p>
                    
                    <div class="search-section">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" id="searchInput" placeholder="Search business ideas by title, category, or description...">
                        </div>
                    </div>
                    
                    <div class="quick-stats">
                        <div class="stat-item">
                            <div class="stat-number">200+</div>
                            <div class="stat-label">Business Ideas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">95%</div>
                            <div class="stat-label">Low Investment</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15K+</div>
                            <div class="stat-label">Students Started</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Main Content -->
        <section class="main-content">
            <div class="container">
                <div class="row">
                    <!-- Sidebar Filters -->
                    <div class="col-lg-3 col-xl-2">
                        <div class="sticky-top" style="top: 120px;">
                            <!-- Category Filter -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Category</h3>
                                <ul class="filter-list">
                                    <li class="filter-item">
                                        <input type="checkbox" id="cat-online" class="filter-checkbox" checked data-filter=".online">
                                        <label for="cat-online" class="filter-label">
                                            Online Business
                                            <span class="filter-count">78</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="cat-service" class="filter-checkbox" checked data-filter=".service">
                                        <label for="cat-service" class="filter-label">
                                            Service-Based
                                            <span class="filter-count">45</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="cat-digital" class="filter-checkbox" data-filter=".digital">
                                        <label for="cat-digital" class="filter-label">
                                            Digital Products
                                            <span class="filter-count">32</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="cat-physical" class="filter-checkbox" data-filter=".physical">
                                        <label for="cat-physical" class="filter-label">
                                            Physical Products
                                            <span class="filter-count">28</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="cat-education" class="filter-checkbox" data-filter=".education">
                                        <label for="cat-education" class="filter-label">
                                            Education/Tutoring
                                            <span class="filter-count">17</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Investment Range -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Investment Range</h3>
                                <div class="investment-range">
                                    <div class="range-values">
                                        <span>$0</span>
                                        <span>$500</span>
                                        <span>$1000+</span>
                                    </div>
                                    <input type="range" class="range-slider" id="investmentSlider" min="0" max="1000" value="500">
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small>Selected: </small>
                                        <small id="investmentValue">Up to $500</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Time Commitment -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Time Commitment</h3>
                                <ul class="filter-list">
                                    <li class="filter-item">
                                        <input type="checkbox" id="time-low" class="filter-checkbox" checked data-time="low">
                                        <label for="time-low" class="filter-label">
                                            < 10 hrs/week
                                            <span class="filter-count">89</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="time-medium" class="filter-checkbox" data-time="medium">
                                        <label for="time-medium" class="filter-label">
                                            10-20 hrs/week
                                            <span class="filter-count">67</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="time-high" class="filter-checkbox" data-time="high">
                                        <label for="time-high" class="filter-label">
                                            > 20 hrs/week
                                            <span class="filter-count">44</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Skill Level -->
                            <div class="sidebar-card">
                                <h3 class="sidebar-title">Skill Level</h3>
                                <ul class="filter-list">
                                    <li class="filter-item">
                                        <input type="checkbox" id="skill-beginner" class="filter-checkbox" checked data-skill="beginner">
                                        <label for="skill-beginner" class="filter-label">
                                            Beginner
                                            <span class="filter-count">112</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="skill-intermediate" class="filter-checkbox" data-skill="intermediate">
                                        <label for="skill-intermediate" class="filter-label">
                                            Intermediate
                                            <span class="filter-count">68</span>
                                        </label>
                                    </li>
                                    <li class="filter-item">
                                        <input type="checkbox" id="skill-advanced" class="filter-checkbox" data-skill="advanced">
                                        <label for="skill-advanced" class="filter-label">
                                            Advanced
                                            <span class="filter-count">20</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Clear Filters -->
                            <button class="clear-filters" id="clearFilters">
                                <i class="fas fa-times-circle me-2"></i> Clear All Filters
                            </button>
                        </div>
                    </div>
                    
                    <!-- Main Content Area -->
                    <div class="col-lg-9 col-xl-10">
                        <!-- Results Header -->
                        <div class="results-header">
                            <div>
                                <h2 class="section-heading" style="font-size: 1.8rem; margin-bottom: 0.5rem;">
                                    Business Ideas
                                </h2>
                                <div class="results-count" id="resultsCount">Showing 20 of 200+ ideas</div>
                            </div>
                            
                            <!-- Sort Dropdown -->
                            <div class="dropdown sort-dropdown">
                                <button class="btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-sort me-2"></i>Sort by: Popular
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                    <li><a class="dropdown-item" href="#" data-sort="popular">Most Popular</a></li>
                                    <li><a class="dropdown-item" href="#" data-sort="newest">Newest First</a></li>
                                    <li><a class="dropdown-item" href="#" data-sort="investment">Lowest Investment</a></li>
                                    <li><a class="dropdown-item" href="#" data-sort="potential">Highest Earning Potential</a></li>
                                    <li><a class="dropdown-item" href="#" data-sort="time">Lowest Time Commitment</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Quick Filter Tabs -->
                        <div class="filter-tabs">
                            <div class="filter-tab active" data-filter="*">
                                <i class="fas fa-layer-group"></i> All Ideas
                            </div>
                            <div class="filter-tab" data-filter=".featured">
                                <i class="fas fa-star"></i> Featured
                            </div>
                            <div class="filter-tab" data-filter=".online">
                                <i class="fas fa-laptop"></i> Online Business
                            </div>
                            <div class="filter-tab" data-filter=".service">
                                <i class="fas fa-concierge-bell"></i> Service-Based
                            </div>
                            <div class="filter-tab" data-filter=".digital">
                                <i class="fas fa-file-download"></i> Digital Products
                            </div>
                            <div class="filter-tab" data-filter=".physical">
                                <i class="fas fa-box"></i> Physical Products
                            </div>
                            <div class="filter-tab" data-filter=".education">
                                <i class="fas fa-graduation-cap"></i> Education
                            </div>
                        </div>
                        
                        <!-- Loading Spinner -->
                        <div class="loading-spinner" id="loadingSpinner">
                            <div class="spinner"></div>
                            <p class="mt-3">Loading business ideas...</p>
                        </div>
                        
                        <!-- Business Ideas Grid -->
                        <div class="business-grid" id="businessGrid">
                            <!-- Business Idea 1 - Featured -->
                            <div class="business-card featured online" data-investment="100" data-time="low" data-skill="beginner" data-potential="medium">
                                <div class="featured-badge">FEATURED</div>
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-online">Online Business</span>
                                        <span class="investment-badge investment-low">$100-500</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Dropshipping Store</a>
                                    </h3>
                                    <p class="business-description">
                                        Start an e-commerce store without inventory. Source products from suppliers who ship directly to customers.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $500-5K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.8</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">2.3K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">&lt;10h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 2 -->
                            <div class="business-card service" data-investment="50" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-service">Service-Based</span>
                                        <span class="investment-badge investment-low">$50-200</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Freelance Writing</a>
                                    </h3>
                                    <p class="business-description">
                                        Write articles, blog posts, and content for clients. Perfect for students with good writing skills.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $300-2K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.5</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">3.1K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">5-15h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 3 -->
                            <div class="business-card online" data-investment="200" data-time="medium" data-skill="intermediate" data-potential="high">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-online">Online Business</span>
                                        <span class="investment-badge investment-low">$200-800</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Print-on-Demand</a>
                                    </h3>
                                    <p class="business-description">
                                        Create custom designs for t-shirts, mugs, and other products. Only pay when items are sold.
                                    </p>
                                    <div class="earning-tag earning-high">Earning: $1K-10K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.7</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.8K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">10-20h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 4 - Featured -->
                            <div class="business-card featured digital" data-investment="300" data-time="medium" data-skill="intermediate" data-potential="medium">
                                <div class="featured-badge">FEATURED</div>
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-digital">Digital Products</span>
                                        <span class="investment-badge investment-low">$300-600</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Online Course Creation</a>
                                    </h3>
                                    <p class="business-description">
                                        Create and sell online courses on topics you're knowledgeable about. Earn passive income.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $500-8K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.9</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">890</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">15-25h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 5 -->
                            <div class="business-card service" data-investment="100" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-service">Service-Based</span>
                                        <span class="investment-badge investment-low">$100-300</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Social Media Management</a>
                                    </h3>
                                    <p class="business-description">
                                        Manage social media accounts for small businesses. Create content and grow their online presence.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $400-3K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.4</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">2.5K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">5-10h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 6 -->
                            <div class="business-card education" data-investment="50" data-time="medium" data-skill="intermediate" data-potential="medium">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-education">Education</span>
                                        <span class="investment-badge investment-low">$50-150</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Online Tutoring</a>
                                    </h3>
                                    <p class="business-description">
                                        Tutor students in subjects you excel at. Flexible hours and good hourly rates.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $500-4K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.8</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.2K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">10-15h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 7 -->
                            <div class="business-card digital" data-investment="150" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-digital">Digital Products</span>
                                        <span class="investment-badge investment-low">$150-400</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Stock Photography</a>
                                    </h3>
                                    <p class="business-description">
                                        Sell your photos on stock websites. Earn royalties every time someone downloads your images.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $200-2K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.3</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.2K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">&lt;5h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 8 -->
                            <div class="business-card online" data-investment="500" data-time="high" data-skill="advanced" data-potential="high">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-online">Online Business</span>
                                        <span class="investment-badge investment-medium">$500-1K</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">YouTube Channel</a>
                                    </h3>
                                    <p class="business-description">
                                        Create educational or entertaining videos. Monetize through ads, sponsorships, and memberships.
                                    </p>
                                    <div class="earning-tag earning-high">Earning: $1K-50K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.6</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">3.5K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">20-30h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 9 -->
                            <div class="business-card physical" data-investment="800" data-time="medium" data-skill="intermediate" data-potential="medium">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-physical">Physical Products</span>
                                        <span class="investment-badge investment-medium">$800-1.5K</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Custom Jewelry Making</a>
                                    </h3>
                                    <p class="business-description">
                                        Create and sell handmade jewelry online. Target niche markets with unique designs.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $600-5K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.7</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">950</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">15-20h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 10 -->
                            <div class="business-card service" data-investment="200" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-service">Service-Based</span>
                                        <span class="investment-badge investment-low">$200-400</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Virtual Assistant</a>
                                    </h3>
                                    <p class="business-description">
                                        Provide administrative support to businesses remotely. Manage emails, scheduling, and data entry.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $300-3K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.5</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">2.8K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">10-15h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 11 -->
                            <div class="business-card digital" data-investment="100" data-time="medium" data-skill="intermediate" data-potential="medium">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-digital">Digital Products</span>
                                        <span class="investment-badge investment-low">$100-300</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Mobile App Development</a>
                                    </h3>
                                    <p class="business-description">
                                        Create simple mobile apps for local businesses or develop your own app ideas.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $1K-8K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.8</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.1K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">20-25h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 12 -->
                            <div class="business-card education" data-investment="50" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-education">Education</span>
                                        <span class="investment-badge investment-low">$50-100</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Language Tutoring</a>
                                    </h3>
                                    <p class="business-description">
                                        Teach your native language to international students. High demand for English tutors.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $400-3K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.9</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">2.2K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">5-10h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 13 -->
                            <div class="business-card online" data-investment="300" data-time="medium" data-skill="intermediate" data-potential="high">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-online">Online Business</span>
                                        <span class="investment-badge investment-low">$300-600</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Affiliate Marketing Blog</a>
                                    </h3>
                                    <p class="business-description">
                                        Create a blog in a niche you're passionate about. Earn commissions by recommending products.
                                    </p>
                                    <div class="earning-tag earning-high">Earning: $1K-15K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.7</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.5K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">15-20h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 14 -->
                            <div class="business-card service" data-investment="150" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-service">Service-Based</span>
                                        <span class="investment-badge investment-low">$150-350</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Graphic Design Services</a>
                                    </h3>
                                    <p class="business-description">
                                        Design logos, social media graphics, and marketing materials for small businesses.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $500-4K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.6</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">2.1K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">10-15h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 15 -->
                            <div class="business-card digital" data-investment="200" data-time="medium" data-skill="intermediate" data-potential="medium">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-digital">Digital Products</span>
                                        <span class="investment-badge investment-low">$200-500</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Website Templates</a>
                                    </h3>
                                    <p class="business-description">
                                        Create and sell website templates for popular platforms like WordPress and Shopify.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $800-6K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.8</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.3K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">15-25h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 16 -->
                            <div class="business-card physical" data-investment="600" data-time="high" data-skill="intermediate" data-potential="medium">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-physical">Physical Products</span>
                                        <span class="investment-badge investment-medium">$600-1.2K</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Custom T-shirt Printing</a>
                                    </h3>
                                    <p class="business-description">
                                        Print custom designs on t-shirts and sell them online or at local events.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $700-6K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.5</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.7K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">20-30h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 17 -->
                            <div class="business-card online" data-investment="100" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-online">Online Business</span>
                                        <span class="investment-badge investment-low">$100-300</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Instagram Theme Pages</a>
                                    </h3>
                                    <p class="business-description">
                                        Grow Instagram pages in specific niches and monetize through sponsorships and promotions.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $300-5K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.4</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">3.2K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">5-10h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 18 -->
                            <div class="business-card service" data-investment="50" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-service">Service-Based</span>
                                        <span class="investment-badge investment-low">$50-150</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Resume Writing Service</a>
                                    </h3>
                                    <p class="business-description">
                                        Help job seekers create professional resumes and cover letters.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $200-3K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.7</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">1.9K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">5-10h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 19 -->
                            <div class="business-card education" data-investment="100" data-time="medium" data-skill="intermediate" data-potential="medium">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-education">Education</span>
                                        <span class="investment-badge investment-low">$100-400</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">Coding Bootcamp</a>
                                    </h3>
                                    <p class="business-description">
                                        Teach coding skills to beginners through online workshops and courses.
                                    </p>
                                    <div class="earning-tag earning-medium">Earning: $1K-10K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.9</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">850</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">20-25h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Business Idea 20 -->
                            <div class="business-card digital" data-investment="150" data-time="low" data-skill="beginner" data-potential="low">
                                <div class="business-image"></div>
                                <div class="business-content">
                                    <div class="business-header">
                                        <span class="business-category category-digital">Digital Products</span>
                                        <span class="investment-badge investment-low">$150-350</span>
                                    </div>
                                    <h3 class="business-title">
                                        <a href="business-detail.php" class="text-decoration-none text-reset">E-book Publishing</a>
                                    </h3>
                                    <p class="business-description">
                                        Write and publish e-books on Amazon Kindle or other platforms. Earn royalties on sales.
                                    </p>
                                    <div class="earning-tag earning-low">Earning: $300-5K/month</div>
                                    <div class="business-stats">
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">4.6</div>
                                            <div class="stat-label-small">Rating</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">2.4K</div>
                                            <div class="stat-label-small">Started</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-number-small">10-15h</div>
                                            <div class="stat-label-small">Weekly</div>
                                        </div>
                                    </div>
                                    <div class="business-footer">
                                        <a href="business-detail.php" class="btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Load More Button -->
                        <div class="load-more-container">
                            <button class="btn-primary load-more-btn" id="loadMoreBtn">
                                <i class="fas fa-plus-circle me-2"></i>Load More Ideas
                            </button>
                        </div>
                        
                        <!-- No Results Message -->
                        <div class="no-results" id="noResults">
                            <i class="fas fa-search no-results-icon"></i>
                            <h3 class="card-heading mb-3">No Business Ideas Found</h3>
                            <p class="body-text mb-4">Try adjusting your filters or search terms to find more ideas.</p>
                            <button class="clear-filters" id="clearNoResults">Clear All Filters</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="section section-secondary" style="padding: 4rem 0;">
            <div class="container text-center">
                <h2 class="section-heading mb-4">
                    Ready to Start Your Business?
                </h2>
                <p class="lead-text mb-4">
                    Join our community of student entrepreneurs and get mentorship, resources, and support to launch your business.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#" class="btn-primary btn-lg">
                        <i class="fas fa-rocket me-2"></i>Start Free 7-Day Course
                    </a>
                    <a href="#" class="btn-outline-primary btn-lg">
                        <i class="fas fa-comments me-2"></i>Talk to Business Mentor
                    </a>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v2.php' ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Initialize Isotope
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Isotope grid
        const grid = document.querySelector('.business-grid');
        let iso = new Isotope(grid, {
            itemSelector: '.business-card',
            layoutMode: 'fitRows',
            percentPosition: true,
            fitRows: {
                gutter: 15
            }
        });
        
        // DOM Elements
        const searchInput = document.getElementById('searchInput');
        const categoryCheckboxes = document.querySelectorAll('.filter-checkbox[data-filter]');
        const timeCheckboxes = document.querySelectorAll('.filter-checkbox[data-time]');
        const skillCheckboxes = document.querySelectorAll('.filter-checkbox[data-skill]');
        const investmentSlider = document.getElementById('investmentSlider');
        const investmentValue = document.getElementById('investmentValue');
        const filterTabs = document.querySelectorAll('.filter-tab');
        const sortItems = document.querySelectorAll('.dropdown-item[data-sort]');
        const sortButton = document.getElementById('sortDropdown');
        const clearFiltersBtn = document.getElementById('clearFilters');
        const clearNoResultsBtn = document.getElementById('clearNoResults');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const noResults = document.getElementById('noResults');
        const resultsCount = document.getElementById('resultsCount');
        
        // Filter state
        let filters = {
            search: '',
            categories: [],
            time: [],
            skill: [],
            investment: 500,
            sort: 'popular'
        };
        
        // Current visible items count
        let visibleItems = 20;
        const totalItems = 20; // In production, this would be from backend
        
        // Investment slider update
        investmentSlider.addEventListener('input', function() {
            const value = parseInt(this.value);
            filters.investment = value;
            investmentValue.textContent = value === 1000 ? '$1000+' : `Up to $${value}`;
            filterItems();
        });
        
        // Search input
        searchInput.addEventListener('input', function() {
            filters.search = this.value.toLowerCase();
            filterItems();
        });
        
        // Category checkboxes
        categoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const filter = this.getAttribute('data-filter');
                
                if (this.checked) {
                    if (!filters.categories.includes(filter)) {
                        filters.categories.push(filter);
                    }
                } else {
                    const index = filters.categories.indexOf(filter);
                    if (index > -1) {
                        filters.categories.splice(index, 1);
                    }
                }
                filterItems();
            });
        });
        
        // Time commitment checkboxes
        timeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const time = this.getAttribute('data-time');
                
                if (this.checked) {
                    if (!filters.time.includes(time)) {
                        filters.time.push(time);
                    }
                } else {
                    const index = filters.time.indexOf(time);
                    if (index > -1) {
                        filters.time.splice(index, 1);
                    }
                }
                filterItems();
            });
        });
        
        // Skill level checkboxes
        skillCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const skill = this.getAttribute('data-skill');
                
                if (this.checked) {
                    if (!filters.skill.includes(skill)) {
                        filters.skill.push(skill);
                    }
                } else {
                    const index = filters.skill.indexOf(skill);
                    if (index > -1) {
                        filters.skill.splice(index, 1);
                    }
                }
                filterItems();
            });
        });
        
        // Filter tabs
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                // Update category checkboxes based on tab
                categoryCheckboxes.forEach(checkbox => {
                    const filter = checkbox.getAttribute('data-filter');
                    if (filterValue === '*') {
                        checkbox.checked = filter === '.online' || filter === '.service';
                    } else if (filterValue === filter) {
                        checkbox.checked = true;
                    } else if (filterValue.startsWith('.') && filter !== filterValue) {
                        checkbox.checked = false;
                    }
                });
                
                // Update filters
                if (filterValue === '*') {
                    filters.categories = ['.online', '.service'];
                } else if (filterValue === '.featured') {
                    filters.categories = [];
                } else {
                    filters.categories = [filterValue];
                }
                
                filterItems();
            });
        });
        
        // Sort dropdown
        sortItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sortText = this.textContent;
                sortButton.innerHTML = `<i class="fas fa-sort me-2"></i>Sort by: ${sortText}`;
                
                filters.sort = this.getAttribute('data-sort');
                sortItems();
            });
        });
        
        // Clear filters
        clearFiltersBtn.addEventListener('click', clearAllFilters);
        clearNoResultsBtn.addEventListener('click', clearAllFilters);
        
        // Load more button
        loadMoreBtn.addEventListener('click', function() {
            loadingSpinner.style.display = 'block';
            loadMoreBtn.disabled = true;
            
            // Simulate loading more items
            setTimeout(() => {
                visibleItems += 10;
                updateResultsCount();
                
                // In production, this would fetch more items from backend
                // For demo, we'll just show all items
                const hiddenItems = document.querySelectorAll('.business-card[style*="display: none"]');
                const itemsToShow = Math.min(10, hiddenItems.length);
                
                for (let i = 0; i < itemsToShow; i++) {
                    hiddenItems[i].style.display = 'flex';
                }
                
                // Update Isotope
                iso.arrange();
                
                // Hide load more button if all items are shown
                if (visibleItems >= totalItems) {
                    loadMoreBtn.style.display = 'none';
                }
                
                loadingSpinner.style.display = 'none';
                loadMoreBtn.disabled = false;
            }, 1000);
        });
        
        // Filter items function
        function filterItems() {
            loadingSpinner.style.display = 'block';
            
            setTimeout(() => {
                let filterString = '';
                
                // Build filter string for Isotope
                if (filters.categories.length > 0) {
                    filterString = filters.categories.join(', ');
                }
                
                // Apply Isotope filter
                iso.arrange({
                    filter: function(itemElem) {
                        let showItem = true;
                        
                        // Check search
                        if (filters.search) {
                            const title = itemElem.querySelector('.business-title').textContent.toLowerCase();
                            const desc = itemElem.querySelector('.business-description').textContent.toLowerCase();
                            if (!title.includes(filters.search) && !desc.includes(filters.search)) {
                                showItem = false;
                            }
                        }
                        
                        // Check categories (if any selected)
                        if (filters.categories.length > 0 && showItem) {
                            const hasCategory = filters.categories.some(cat => itemElem.classList.contains(cat.substring(1)));
                            if (!hasCategory) {
                                showItem = false;
                            }
                        }
                        
                        // Check time commitment
                        if (filters.time.length > 0 && showItem) {
                            const time = itemElem.getAttribute('data-time');
                            if (!filters.time.includes(time)) {
                                showItem = false;
                            }
                        }
                        
                        // Check skill level
                        if (filters.skill.length > 0 && showItem) {
                            const skill = itemElem.getAttribute('data-skill');
                            if (!filters.skill.includes(skill)) {
                                showItem = false;
                            }
                        }
                        
                        // Check investment
                        if (showItem) {
                            const investment = parseInt(itemElem.getAttribute('data-investment'));
                            if (investment > filters.investment) {
                                showItem = false;
                            }
                        }
                        
                        return showItem;
                    }
                });
                
                // Update results count
                updateResultsCount();
                
                // Show/hide no results message
                const visibleCount = iso.filteredItems.length;
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                    businessGrid.style.display = 'none';
                    loadMoreBtn.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    businessGrid.style.display = 'grid';
                    loadMoreBtn.style.display = 'block';
                    
                    // Show only first 20 items
                    const items = document.querySelectorAll('.business-card');
                    items.forEach((item, index) => {
                        if (index < visibleItems) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Update Isotope
                    iso.arrange();
                }
                
                loadingSpinner.style.display = 'none';
            }, 300);
        }
        
        // Sort items function
        function sortItems() {
            let sortBy;
            
            switch(filters.sort) {
                case 'newest':
                    sortBy = 'original-order';
                    break;
                case 'investment':
                    sortBy = function(itemElem) {
                        return parseInt(itemElem.getAttribute('data-investment'));
                    };
                    break;
                case 'potential':
                    sortBy = function(itemElem) {
                        const potential = itemElem.getAttribute('data-potential');
                        const order = { high: 3, medium: 2, low: 1 };
                        return order[potential] || 0;
                    };
                    break;
                case 'time':
                    sortBy = function(itemElem) {
                        const time = itemElem.getAttribute('data-time');
                        const order = { low: 1, medium: 2, high: 3 };
                        return order[time] || 0;
                    };
                    break;
                case 'popular':
                default:
                    sortBy = function(itemElem) {
                        const rating = parseFloat(itemElem.querySelector('.stat-number-small').textContent);
                        return -rating; // Negative for descending
                    };
                    break;
            }
            
            iso.arrange({
                sortBy: sortBy,
                sortAscending: filters.sort === 'investment' || filters.sort === 'time'
            });
        }
        
        // Clear all filters function
        function clearAllFilters() {
            // Reset checkboxes
            categoryCheckboxes.forEach(checkbox => {
                checkbox.checked = checkbox.id === 'cat-online' || checkbox.id === 'cat-service';
            });
            
            timeCheckboxes.forEach(checkbox => {
                checkbox.checked = checkbox.id === 'time-low';
            });
            
            skillCheckboxes.forEach(checkbox => {
                checkbox.checked = checkbox.id === 'skill-beginner';
            });
            
            // Reset filter tabs
            filterTabs.forEach(tab => {
                if (tab.getAttribute('data-filter') === '*') {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
            
            // Reset search
            searchInput.value = '';
            
            // Reset investment slider
            investmentSlider.value = 500;
            investmentValue.textContent = 'Up to $500';
            
            // Reset sort
            sortButton.innerHTML = '<i class="fas fa-sort me-2"></i>Sort by: Popular';
            
            // Reset filters
            filters = {
                search: '',
                categories: ['.online', '.service'],
                time: ['low'],
                skill: ['beginner'],
                investment: 500,
                sort: 'popular'
            };
            
            // Reset visible items
            visibleItems = 20;
            
            // Apply filters
            filterItems();
            sortItems();
        }
        
        // Update results count
        function updateResultsCount() {
            const visibleCount = iso.filteredItems.length;
            resultsCount.textContent = `Showing ${Math.min(visibleItems, visibleCount)} of ${visibleCount} ideas`;
            
            // Update load more button text
            if (visibleItems >= visibleCount) {
                loadMoreBtn.style.display = 'none';
            } else {
                loadMoreBtn.style.display = 'block';
                loadMoreBtn.innerHTML = `<i class="fas fa-plus-circle me-2"></i>Load More (${visibleCount - visibleItems} more)`;
            }
        }
        
        // Initial filter
        filterItems();
    });
    </script>
</body>
</html>