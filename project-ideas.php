<?php
// project-ideas.php
$pageTitle = "Final Year Project Ideas for University Students";
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
    <!-- Select2 for better select boxes -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Project Ideas Page Specific Styles */
        .project-ideas-page {
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
            max-width: 800px;
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
        
        /* Compact Sidebar */
        .compact-sidebar {
            position: sticky;
            top: 120px;
        }
        
        .filter-card {
            background: var(--section-bg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }
        
        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            cursor: pointer;
        }
        
        .filter-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin: 0;
        }
        
        .filter-toggle {
            color: var(--gold-accent);
            font-size: 0.9rem;
            background: none;
            border: none;
            padding: 0;
        }
        
        .filter-content {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }
        
        .filter-content.collapsed {
            max-height: 0;
            overflow: hidden;
        }
        
        /* Custom Checkbox & Radio */
        .filter-option {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
        }
        
        .filter-checkbox, .filter-radio {
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
        
        /* Select2 Customization */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid var(--border-light);
            border-radius: 8px;
            min-height: 42px;
            padding: 0.25rem;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--luxury-blue);
            box-shadow: 0 0 0 3px rgba(10, 36, 99, 0.1);
        }
        
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: var(--luxury-blue);
            border: 1px solid var(--luxury-blue);
            color: white;
            border-radius: 4px;
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
        
        /* Compact Project Grid */
        .compact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .project-card-compact {
            background: var(--section-bg);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .project-card-compact:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--gold-accent);
        }
        
        .project-header-compact {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .project-category {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .category-web {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        
        .category-ai {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .category-mobile {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }
        
        .category-data {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }
        
        .category-iot {
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
            color: white;
        }
        
        .difficulty-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .difficulty-beginner {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }
        
        .difficulty-intermediate {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }
        
        .difficulty-advanced {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
        
        .project-title-compact {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin-bottom: 1rem;
            line-height: 1.4;
        }
        
        .project-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }
        
        .project-skills {
            margin-bottom: 1.5rem;
        }
        
        .skills-label {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .skills-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .skill-tag {
            background: rgba(10, 36, 99, 0.08);
            color: var(--luxury-blue);
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            font-size: 0.85rem;
            border: 1px solid rgba(10, 36, 99, 0.1);
        }
        
        .project-footer-compact {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--border-light);
        }
        
        .project-meta {
            display: flex;
            gap: 1rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #777;
            font-size: 0.9rem;
        }
        
        .meta-item i {
            color: var(--gold-accent);
        }
        
        /* View Toggle */
        .view-toggle {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
            gap: 0.5rem;
        }
        
        .view-btn {
            background: transparent;
            border: 1px solid var(--border-light);
            color: #666;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .view-btn:hover, .view-btn.active {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        /* Results Header */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .results-count {
            color: #666;
            font-size: 1rem;
        }
        
        .sort-dropdown {
            min-width: 180px;
        }
        
        /* No Results */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--section-bg);
            border-radius: 12px;
            border: 2px dashed var(--border-light);
        }
        
        .no-results-icon {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1.5rem;
        }
        
        /* Category Tabs */
        .category-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        
        .category-tab {
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            background: var(--section-bg);
            border: 1px solid var(--border-light);
            color: var(--luxury-blue);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .category-tab:hover,
        .category-tab.active {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        .category-tab i {
            font-size: 1.1rem;
        }
        
        /* Technology Stack Filter */
        .tech-stack-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 1.5rem;
        }
        
        .tech-pill {
            padding: 0.4rem 1rem;
            background: rgba(10, 36, 99, 0.08);
            color: var(--luxury-blue);
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(10, 36, 99, 0.1);
        }
        
        .tech-pill:hover,
        .tech-pill.active {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        /* Pagination */
        .compact-pagination {
            margin-top: 3rem;
        }
        
        .page-link {
            color: var(--luxury-blue);
            border: 1px solid var(--border-light);
            padding: 0.75rem 1.25rem;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .page-link:hover {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        .page-item.active .page-link {
            background: var(--luxury-blue);
            color: white;
            border-color: var(--luxury-blue);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .project-ideas-page {
                padding-top: 80px;
            }
            
            .page-header {
                padding: 3rem 0;
                border-radius: 0 0 15px 15px;
            }
            
            .compact-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
            
            .compact-sidebar {
                position: static;
                margin-bottom: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .compact-grid {
                grid-template-columns: 1fr;
            }
            
            .results-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .quick-stats {
                gap: 2rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .category-tabs {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
            }
            
            .category-tab {
                flex-shrink: 0;
            }
        }
        
        @media (max-width: 576px) {
            .search-input {
                padding: 0.8rem 2rem 0.8rem 2.5rem;
                font-size: 1rem;
            }
            
            .project-title-compact {
                font-size: 1.2rem;
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
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Project Ideas Page -->
    <div class="project-ideas-page">
        <!-- Header -->
        <section class="page-header">
            <div class="container">
                <div class="page-header-content">
                    <h1 class="display-title" style="color: white; font-size: 3rem; margin-bottom: 1rem;">
                        Final Year Project Ideas
                    </h1>
                    <p class="lead-text" style="color: rgba(255,255,255,0.9);">
                        500+ innovative project ideas for Computer Science & Engineering students. 
                        Filter by technology, difficulty, and category to find your perfect project.
                    </p>
                    
                    <div class="search-section">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" id="searchInput" placeholder="Search projects by title, technology, or description...">
                        </div>
                    </div>
                    
                    <div class="quick-stats">
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Project Ideas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">24</div>
                            <div class="stat-label">Categories</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15K+</div>
                            <div class="stat-label">Students Helped</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Main Content -->
        <section class="main-content">
            <div class="container">
                <div class="row">
                    <!-- Compact Sidebar -->
                    <div class="col-lg-3">
                        <div class="compact-sidebar">
                            <!-- Category Filter -->
                            <div class="filter-card">
                                <div class="filter-header" onclick="toggleFilter('categoryFilter')">
                                    <h3 class="filter-title">Category</h3>
                                    <button class="filter-toggle">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="filter-content" id="categoryFilter">
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-web" class="filter-checkbox" checked>
                                        <label for="cat-web" class="filter-label">
                                            Web Development
                                            <span class="filter-count">156</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-ai" class="filter-checkbox" checked>
                                        <label for="cat-ai" class="filter-label">
                                            AI & Machine Learning
                                            <span class="filter-count">89</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-mobile" class="filter-checkbox">
                                        <label for="cat-mobile" class="filter-label">
                                            Mobile Apps
                                            <span class="filter-count">67</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-data" class="filter-checkbox">
                                        <label for="cat-data" class="filter-label">
                                            Data Science
                                            <span class="filter-count">54</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-iot" class="filter-checkbox">
                                        <label for="cat-iot" class="filter-label">
                                            IoT & Embedded
                                            <span class="filter-count">42</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-desktop" class="filter-checkbox">
                                        <label for="cat-desktop" class="filter-label">
                                            Desktop Applications
                                            <span class="filter-count">38</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-blockchain" class="filter-checkbox">
                                        <label for="cat-blockchain" class="filter-label">
                                            Blockchain
                                            <span class="filter-count">29</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="cat-cyber" class="filter-checkbox">
                                        <label for="cat-cyber" class="filter-label">
                                            Cyber Security
                                            <span class="filter-count">45</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Difficulty Filter -->
                            <div class="filter-card">
                                <div class="filter-header" onclick="toggleFilter('difficultyFilter')">
                                    <h3 class="filter-title">Difficulty Level</h3>
                                    <button class="filter-toggle">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="filter-content" id="difficultyFilter">
                                    <div class="filter-option">
                                        <input type="radio" id="diff-all" name="difficulty" class="filter-radio" checked>
                                        <label for="diff-all" class="filter-label">All Levels</label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="radio" id="diff-beginner" name="difficulty" class="filter-radio">
                                        <label for="diff-beginner" class="filter-label">
                                            Beginner
                                            <span class="filter-count">187</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="radio" id="diff-intermediate" name="difficulty" class="filter-radio">
                                        <label for="diff-intermediate" class="filter-label">
                                            Intermediate
                                            <span class="filter-count">256</span>
                                        </label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="radio" id="diff-advanced" name="difficulty" class="filter-radio">
                                        <label for="diff-advanced" class="filter-label">
                                            Advanced
                                            <span class="filter-count">97</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Technology Stack -->
                            <div class="filter-card">
                                <div class="filter-header" onclick="toggleFilter('techFilter')">
                                    <h3 class="filter-title">Technology Stack</h3>
                                    <button class="filter-toggle">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="filter-content" id="techFilter">
                                    <select class="form-select mb-3" id="techSelect" multiple="multiple">
                                        <option value="react">React.js</option>
                                        <option value="angular">Angular</option>
                                        <option value="vue">Vue.js</option>
                                        <option value="node">Node.js</option>
                                        <option value="python">Python</option>
                                        <option value="django">Django</option>
                                        <option value="flask">Flask</option>
                                        <option value="java">Java</option>
                                        <option value="spring">Spring Boot</option>
                                        <option value="php">PHP</option>
                                        <option value="laravel">Laravel</option>
                                        <option value="mysql">MySQL</option>
                                        <option value="mongodb">MongoDB</option>
                                        <option value="postgresql">PostgreSQL</option>
                                        <option value="tensorflow">TensorFlow</option>
                                        <option value="pytorch">PyTorch</option>
                                        <option value="react-native">React Native</option>
                                        <option value="flutter">Flutter</option>
                                        <option value="android">Android (Kotlin)</option>
                                        <option value="ios">iOS (Swift)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Skills Required -->
                            <div class="filter-card">
                                <div class="filter-header" onclick="toggleFilter('skillsFilter')">
                                    <h3 class="filter-title">Skills Required</h3>
                                    <button class="filter-toggle">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="filter-content" id="skillsFilter">
                                    <div class="filter-option">
                                        <input type="checkbox" id="skill-frontend" class="filter-checkbox">
                                        <label for="skill-frontend" class="filter-label">Frontend Development</label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="skill-backend" class="filter-checkbox">
                                        <label for="skill-backend" class="filter-label">Backend Development</label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="skill-database" class="filter-checkbox">
                                        <label for="skill-database" class="filter-label">Database Design</label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="skill-ml" class="filter-checkbox">
                                        <label for="skill-ml" class="filter-label">Machine Learning</label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="skill-mobile" class="filter-checkbox">
                                        <label for="skill-mobile" class="filter-label">Mobile Development</label>
                                    </div>
                                    <div class="filter-option">
                                        <input type="checkbox" id="skill-uiux" class="filter-checkbox">
                                        <label for="skill-uiux" class="filter-label">UI/UX Design</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Clear All Filters -->
                            <button class="clear-filters" id="clearFilters">
                                <i class="fas fa-times-circle me-2"></i> Clear All Filters
                            </button>
                        </div>
                    </div>
                    
                    <!-- Main Content Area -->
                    <div class="col-lg-9">
                        <!-- Results Header -->
                        <div class="results-header">
                            <div>
                                <h2 class="section-heading" style="font-size: 1.8rem; margin-bottom: 0.5rem;">
                                    Project Ideas
                                </h2>
                                <div class="results-count" id="resultsCount">Showing 12 of 500+ projects</div>
                            </div>
                            
                            <div class="d-flex gap-3">
                                <!-- Sort Dropdown -->
                                <div class="dropdown sort-dropdown">
                                    <button class="btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-sort me-2"></i>Sort by: Popular
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                        <li><a class="dropdown-item" href="#" data-sort="popular">Most Popular</a></li>
                                        <li><a class="dropdown-item" href="#" data-sort="newest">Newest First</a></li>
                                        <li><a class="dropdown-item" href="#" data-sort="difficulty">Difficulty (Low to High)</a></li>
                                        <li><a class="dropdown-item" href="#" data-sort="complexity">Complexity (High to Low)</a></li>
                                        <li><a class="dropdown-item" href="#" data-sort="alphabetical">Alphabetical</a></li>
                                    </ul>
                                </div>
                                
                                <!-- View Toggle -->
                                <div class="view-toggle">
                                    <button class="view-btn active" data-view="grid">
                                        <i class="fas fa-th-large"></i>
                                    </button>
                                    <button class="view-btn" data-view="list">
                                        <i class="fas fa-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Technology Stack Quick Filter -->
                        <div class="tech-stack-filter mb-4">
                            <span class="tech-pill active" data-tech="all">All</span>
                            <span class="tech-pill" data-tech="web">Web</span>
                            <span class="tech-pill" data-tech="ai">AI/ML</span>
                            <span class="tech-pill" data-tech="mobile">Mobile</span>
                            <span class="tech-pill" data-tech="data">Data Science</span>
                            <span class="tech-pill" data-tech="iot">IoT</span>
                        </div>
                        
                        <!-- Category Tabs -->
                        <div class="category-tabs mb-4">
                            <a href="#" class="category-tab active" data-category="all">
                                <i class="fas fa-layer-group"></i> All Categories
                            </a>
                            <a href="#" class="category-tab" data-category="inventory">
                                <i class="fas fa-boxes"></i> Inventory Systems
                            </a>
                            <a href="#" class="category-tab" data-category="pos">
                                <i class="fas fa-cash-register"></i> POS Systems
                            </a>
                            <a href="#" class="category-tab" data-category="ecommerce">
                                <i class="fas fa-shopping-cart"></i> E-commerce
                            </a>
                            <a href="#" class="category-tab" data-category="healthcare">
                                <i class="fas fa-heartbeat"></i> Healthcare
                            </a>
                            <a href="#" class="category-tab" data-category="education">
                                <i class="fas fa-graduation-cap"></i> Education
                            </a>
                        </div>
                        
                        <!-- Loading Spinner -->
                        <div class="loading-spinner" id="loadingSpinner">
                            <div class="spinner"></div>
                            <p class="mt-3">Loading projects...</p>
                        </div>
                        
                        <!-- Projects Grid -->
                        <div class="compact-grid" id="projectsGrid">
                            <!-- Web Development Projects -->
                            <!-- Project 1: Inventory Management System -->
                            <div class="project-card-compact" data-category="web,inventory" data-difficulty="intermediate" data-tech="web">
                                <div class="project-header-compact">
                                    <span class="project-category category-web">Web Development</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">Smart Inventory Management System</h3>
                                <p class="project-description">
                                    A comprehensive web application for tracking inventory, managing stock levels, generating reports, and automating reordering. Includes barcode scanning, supplier management, and real-time inventory tracking.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">React.js</span>
                                        <span class="skill-tag">Node.js</span>
                                        <span class="skill-tag">MongoDB</span>
                                        <span class="skill-tag">Express.js</span>
                                        <span class="skill-tag">REST API</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 4-6 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 1-3 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 2: POS System -->
                            <div class="project-card-compact" data-category="web,pos" data-difficulty="intermediate" data-tech="web">
                                <div class="project-header-compact">
                                    <span class="project-category category-web">Web Development</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">Cloud-Based Point of Sale System</h3>
                                <p class="project-description">
                                    A modern POS system with inventory management, sales tracking, customer management, and reporting. Features include barcode scanning, receipt printing, multi-branch support, and real-time analytics dashboard.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Angular</span>
                                        <span class="skill-tag">Spring Boot</span>
                                        <span class="skill-tag">MySQL</span>
                                        <span class="skill-tag">WebSocket</span>
                                        <span class="skill-tag">REST API</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 5-7 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 2-4 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 3: AI/ML - Disease Prediction -->
                            <div class="project-card-compact" data-category="ai,healthcare" data-difficulty="advanced" data-tech="ai">
                                <div class="project-header-compact">
                                    <span class="project-category category-ai">AI & ML</span>
                                    <span class="difficulty-badge difficulty-advanced">Advanced</span>
                                </div>
                                <h3 class="project-title-compact">AI-Powered Disease Prediction System</h3>
                                <p class="project-description">
                                    Machine learning system that predicts diseases based on symptoms and medical history. Uses neural networks and data analysis to provide early warnings and recommendations. Includes a web interface for healthcare professionals.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Python</span>
                                        <span class="skill-tag">TensorFlow</span>
                                        <span class="skill-tag">Flask</span>
                                        <span class="skill-tag">Scikit-learn</span>
                                        <span class="skill-tag">Pandas</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 6-8 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 2-3 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 4: E-commerce Platform -->
                            <div class="project-card-compact" data-category="web,ecommerce" data-difficulty="intermediate" data-tech="web">
                                <div class="project-header-compact">
                                    <span class="project-category category-web">Web Development</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">Full-Stack E-commerce Platform</h3>
                                <p class="project-description">
                                    Complete online shopping platform with user authentication, product catalog, shopping cart, payment gateway integration, order tracking, and admin dashboard. Supports multiple payment methods and shipping options.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Vue.js</span>
                                        <span class="skill-tag">Laravel</span>
                                        <span class="skill-tag">MySQL</span>
                                        <span class="skill-tag">Redis</span>
                                        <span class="skill-tag">Stripe API</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 5-6 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 3-4 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 5: Mobile App - Food Delivery -->
                            <div class="project-card-compact" data-category="mobile" data-difficulty="intermediate" data-tech="mobile">
                                <div class="project-header-compact">
                                    <span class="project-category category-mobile">Mobile App</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">Food Delivery Mobile Application</h3>
                                <p class="project-description">
                                    Cross-platform food delivery app with real-time order tracking, restaurant discovery, menu browsing, payment integration, and driver tracking. Includes separate apps for customers, restaurants, and delivery personnel.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">React Native</span>
                                        <span class="skill-tag">Firebase</span>
                                        <span class="skill-tag">Node.js</span>
                                        <span class="skill-tag">Google Maps API</span>
                                        <span class="skill-tag">Redux</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 6-7 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 3-4 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 6: AI/ML - Chatbot -->
                            <div class="project-card-compact" data-category="ai,education" data-difficulty="beginner" data-tech="ai">
                                <div class="project-header-compact">
                                    <span class="project-category category-ai">AI & ML</span>
                                    <span class="difficulty-badge difficulty-beginner">Beginner</span>
                                </div>
                                <h3 class="project-title-compact">Intelligent Educational Chatbot</h3>
                                <p class="project-description">
                                    AI-powered chatbot that answers student queries, provides learning resources, and assists with course selection. Uses natural language processing to understand and respond to questions in educational contexts.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Python</span>
                                        <span class="skill-tag">NLTK</span>
                                        <span class="skill-tag">Django</span>
                                        <span class="skill-tag">Dialogflow</span>
                                        <span class="skill-tag">React</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 4-5 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 2-3 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 7: Data Science - Sales Analytics -->
                            <div class="project-card-compact" data-category="data" data-difficulty="intermediate" data-tech="data">
                                <div class="project-header-compact">
                                    <span class="project-category category-data">Data Science</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">Sales Forecasting & Analytics Dashboard</h3>
                                <p class="project-description">
                                    Data analysis platform that processes sales data, predicts future trends, and provides actionable insights. Includes interactive dashboards, report generation, and machine learning models for sales forecasting.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Python</span>
                                        <span class="skill-tag">Pandas</span>
                                        <span class="skill-tag">Plotly</span>
                                        <span class="skill-tag">Flask</span>
                                        <span class="skill-tag">Scikit-learn</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 5-6 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 2-3 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 8: IoT - Smart Home -->
                            <div class="project-card-compact" data-category="iot" data-difficulty="advanced" data-tech="iot">
                                <div class="project-header-compact">
                                    <span class="project-category category-iot">IoT System</span>
                                    <span class="difficulty-badge difficulty-advanced">Advanced</span>
                                </div>
                                <h3 class="project-title-compact">IoT-Based Smart Home Automation</h3>
                                <p class="project-description">
                                    Complete smart home system with remote control of lights, appliances, security cameras, and climate control. Features include voice commands, mobile app control, energy monitoring, and automated schedules.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Arduino/Raspberry Pi</span>
                                        <span class="skill-tag">MQTT</span>
                                        <span class="skill-tag">Node.js</span>
                                        <span class="skill-tag">React Native</span>
                                        <span class="skill-tag">Python</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 7-8 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 3-4 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 9: Web - Learning Management System -->
                            <div class="project-card-compact" data-category="web,education" data-difficulty="intermediate" data-tech="web">
                                <div class="project-header-compact">
                                    <span class="project-category category-web">Web Development</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">Learning Management System (LMS)</h3>
                                <p class="project-description">
                                    Complete online learning platform with course creation, video lectures, assignments, quizzes, grading system, and student progress tracking. Supports multiple user roles and integrated video conferencing.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">React.js</span>
                                        <span class="skill-tag">Django</span>
                                        <span class="skill-tag">PostgreSQL</span>
                                        <span class="skill-tag">WebRTC</span>
                                        <span class="skill-tag">AWS S3</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 6-7 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 3-4 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 10: AI/ML - Image Recognition -->
                            <div class="project-card-compact" data-category="ai" data-difficulty="advanced" data-tech="ai">
                                <div class="project-header-compact">
                                    <span class="project-category category-ai">AI & ML</span>
                                    <span class="difficulty-badge difficulty-advanced">Advanced</span>
                                </div>
                                <h3 class="project-title-compact">Deep Learning Image Recognition System</h3>
                                <p class="project-description">
                                    Advanced image classification system using convolutional neural networks. Can identify objects, faces, text, and scenes in images. Includes web interface for uploading images and viewing results with confidence scores.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Python</span>
                                        <span class="skill-tag">PyTorch</span>
                                        <span class="skill-tag">OpenCV</span>
                                        <span class="skill-tag">Flask</span>
                                        <span class="skill-tag">React</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 7-8 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 2-3 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 11: Mobile - Fitness Tracker -->
                            <div class="project-card-compact" data-category="mobile,healthcare" data-difficulty="intermediate" data-tech="mobile">
                                <div class="project-header-compact">
                                    <span class="project-category category-mobile">Mobile App</span>
                                    <span class="difficulty-badge difficulty-intermediate">Intermediate</span>
                                </div>
                                <h3 class="project-title-compact">AI Fitness Tracker & Workout Planner</h3>
                                <p class="project-description">
                                    Mobile app that tracks workouts, provides exercise recommendations, and monitors health metrics. Uses AI to create personalized workout plans and track progress over time with detailed analytics.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Flutter</span>
                                        <span class="skill-tag">Firebase</span>
                                        <span class="skill-tag">Node.js</span>
                                        <span class="skill-tag">TensorFlow Lite</span>
                                        <span class="skill-tag">Health APIs</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 5-6 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 2-3 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                            
                            <!-- Project 12: Web - Hospital Management -->
                            <div class="project-card-compact" data-category="web,healthcare" data-difficulty="advanced" data-tech="web">
                                <div class="project-header-compact">
                                    <span class="project-category category-web">Web Development</span>
                                    <span class="difficulty-badge difficulty-advanced">Advanced</span>
                                </div>
                                <h3 class="project-title-compact">Hospital Management System</h3>
                                <p class="project-description">
                                    Comprehensive hospital management software for patient registration, appointment scheduling, medical records, billing, pharmacy management, and lab reports. Supports multiple departments and user roles.
                                </p>
                                <div class="project-skills">
                                    <span class="skills-label">Technologies:</span>
                                    <div class="skills-tags">
                                        <span class="skill-tag">Angular</span>
                                        <span class="skill-tag">Spring Boot</span>
                                        <span class="skill-tag">Oracle DB</span>
                                        <span class="skill-tag">Redis</span>
                                        <span class="skill-tag">WebSocket</span>
                                    </div>
                                </div>
                                <div class="project-footer-compact">
                                    <div class="project-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i> 7-9 months
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-users"></i> 4-5 students
                                        </span>
                                    </div>
                                    <a href="project-details.php" class="btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- No Results Message -->
                        <div class="no-results" id="noResults" style="display: none;">
                            <i class="fas fa-search no-results-icon"></i>
                            <h3 class="card-heading mb-3">No Projects Found</h3>
                            <p class="body-text mb-4">Try adjusting your filters or search terms to find more projects.</p>
                            <button class="clear-filters">Clear All Filters</button>
                        </div>
                        
                        <!-- Pagination -->
                        <nav aria-label="Projects pagination" class="compact-pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Call to Action -->
        <section class="section section-secondary" style="padding: 4rem 0;">
            <div class="container text-center">
                <h2 class="section-heading mb-4">
                    Need Help Choosing a Project?
                </h2>
                <p class="lead-text mb-4">
                    Our team of mentors can help you select the perfect project based on your skills, interests, and career goals.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#" class="btn-primary btn-lg">
                        <i class="fas fa-comments me-2"></i>Talk to a Mentor
                    </a>
                    <a href="#" class="btn-outline-primary btn-lg">
                        <i class="fas fa-download me-2"></i>Download Project Guide
                    </a>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery for Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
    // Initialize Select2
    $(document).ready(function() {
        $('#techSelect').select2({
            placeholder: "Select technologies...",
            allowClear: true,
            width: '100%'
        });
    });
    
    // Filter toggle functionality
    function toggleFilter(filterId) {
        const filterContent = document.getElementById(filterId);
        const toggleBtn = filterContent.previousElementSibling.querySelector('.filter-toggle i');
        
        filterContent.classList.toggle('collapsed');
        
        if (filterContent.classList.contains('collapsed')) {
            toggleBtn.classList.remove('fa-chevron-down');
            toggleBtn.classList.add('fa-chevron-right');
        } else {
            toggleBtn.classList.remove('fa-chevron-right');
            toggleBtn.classList.add('fa-chevron-down');
        }
    }
    
    // Initialize all filters as expanded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize filter toggles
        const filterHeaders = document.querySelectorAll('.filter-header');
        filterHeaders.forEach(header => {
            const toggleBtn = header.querySelector('.filter-toggle i');
            toggleBtn.classList.remove('fa-chevron-right');
            toggleBtn.classList.add('fa-chevron-down');
        });
        
        // Get DOM elements
        const searchInput = document.getElementById('searchInput');
        const categoryCheckboxes = document.querySelectorAll('.filter-checkbox[type="checkbox"]');
        const difficultyRadios = document.querySelectorAll('.filter-radio');
        const techPills = document.querySelectorAll('.tech-pill');
        const categoryTabs = document.querySelectorAll('.category-tab');
        const viewButtons = document.querySelectorAll('.view-btn');
        const sortItems = document.querySelectorAll('.dropdown-item[data-sort]');
        const sortButton = document.getElementById('sortDropdown');
        const clearFiltersBtn = document.getElementById('clearFilters');
        const projectsGrid = document.getElementById('projectsGrid');
        const projectCards = document.querySelectorAll('.project-card-compact');
        const resultsCount = document.getElementById('resultsCount');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const noResults = document.getElementById('noResults');
        
        let activeFilters = {
            category: ['web', 'ai'], // Default checked categories
            difficulty: 'all',
            techStack: [],
            search: '',
            view: 'grid',
            sort: 'popular',
            techFilter: 'all',
            categoryFilter: 'all'
        };
        
        // Search functionality
        searchInput.addEventListener('input', function(e) {
            activeFilters.search = e.target.value.toLowerCase();
            filterProjects();
        });
        
        // Category checkboxes
        categoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const category = this.id.replace('cat-', '');
                
                if (this.checked) {
                    if (!activeFilters.category.includes(category)) {
                        activeFilters.category.push(category);
                    }
                } else {
                    const index = activeFilters.category.indexOf(category);
                    if (index > -1) {
                        activeFilters.category.splice(index, 1);
                    }
                }
                filterProjects();
            });
        });
        
        // Difficulty radios
        difficultyRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    activeFilters.difficulty = this.id.replace('diff-', '');
                    filterProjects();
                }
            });
        });
        
        // Technology pills
        techPills.forEach(pill => {
            pill.addEventListener('click', function() {
                // Remove active class from all pills
                techPills.forEach(p => p.classList.remove('active'));
                // Add active class to clicked pill
                this.classList.add('active');
                
                activeFilters.techFilter = this.dataset.tech;
                filterProjects();
            });
        });
        
        // Category tabs
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                categoryTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                activeFilters.categoryFilter = this.dataset.category;
                filterProjects();
            });
        });
        
        // View toggle
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                viewButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                activeFilters.view = this.dataset.view;
                updateView();
            });
        });
        
        // Sort dropdown
        sortItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sortText = this.textContent;
                sortButton.innerHTML = `<i class="fas fa-sort me-2"></i>Sort by: ${sortText}`;
                
                activeFilters.sort = this.dataset.sort;
                sortProjects();
            });
        });
        
        // Clear all filters
        clearFiltersBtn.addEventListener('click', function() {
            // Reset checkboxes
            categoryCheckboxes.forEach(checkbox => {
                checkbox.checked = checkbox.id === 'cat-web' || checkbox.id === 'cat-ai';
            });
            
            // Reset radios
            document.getElementById('diff-all').checked = true;
            
            // Reset search
            searchInput.value = '';
            
            // Reset tech pills
            techPills.forEach(pill => {
                pill.classList.remove('active');
                if (pill.dataset.tech === 'all') {
                    pill.classList.add('active');
                }
            });
            
            // Reset category tabs
            categoryTabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.dataset.category === 'all') {
                    tab.classList.add('active');
                }
            });
            
            // Reset select2
            $('#techSelect').val(null).trigger('change');
            
            // Reset active filters
            activeFilters = {
                category: ['web', 'ai'],
                difficulty: 'all',
                techStack: [],
                search: '',
                view: 'grid',
                sort: 'popular',
                techFilter: 'all',
                categoryFilter: 'all'
            };
            
            filterProjects();
        });
        
        // Technology stack select
        $('#techSelect').on('change', function() {
            activeFilters.techStack = $(this).val() || [];
            filterProjects();
        });
        
        // Filter projects function
        function filterProjects() {
            loadingSpinner.style.display = 'block';
            projectsGrid.style.opacity = '0.5';
            
            setTimeout(() => {
                let visibleCount = 0;
                
                projectCards.forEach(card => {
                    const cardCategories = card.dataset.category.split(',');
                    const cardDifficulty = card.dataset.difficulty;
                    const cardTech = card.dataset.tech;
                    const cardTitle = card.querySelector('.project-title-compact').textContent.toLowerCase();
                    const cardDescription = card.querySelector('.project-description').textContent.toLowerCase();
                    const cardSkills = Array.from(card.querySelectorAll('.skill-tag')).map(tag => tag.textContent.toLowerCase());
                    
                    // Apply filters
                    let isVisible = true;
                    
                    // Category filter
                    if (activeFilters.category.length > 0) {
                        const hasCategory = cardCategories.some(cat => activeFilters.category.includes(cat));
                        if (!hasCategory) isVisible = false;
                    }
                    
                    // Difficulty filter
                    if (activeFilters.difficulty !== 'all' && cardDifficulty !== activeFilters.difficulty) {
                        isVisible = false;
                    }
                    
                    // Tech filter (pills)
                    if (activeFilters.techFilter !== 'all' && cardTech !== activeFilters.techFilter) {
                        isVisible = false;
                    }
                    
                    // Category filter (tabs)
                    if (activeFilters.categoryFilter !== 'all') {
                        if (activeFilters.categoryFilter === 'inventory' && !cardCategories.includes('inventory')) {
                            isVisible = false;
                        }
                        if (activeFilters.categoryFilter === 'pos' && !cardCategories.includes('pos')) {
                            isVisible = false;
                        }
                        if (activeFilters.categoryFilter === 'ecommerce' && !cardCategories.includes('ecommerce')) {
                            isVisible = false;
                        }
                        if (activeFilters.categoryFilter === 'healthcare' && !cardCategories.includes('healthcare')) {
                            isVisible = false;
                        }
                        if (activeFilters.categoryFilter === 'education' && !cardCategories.includes('education')) {
                            isVisible = false;
                        }
                    }
                    
                    // Technology stack filter
                    if (activeFilters.techStack.length > 0) {
                        const hasTech = activeFilters.techStack.some(tech => 
                            cardSkills.some(skill => skill.includes(tech.toLowerCase()))
                        );
                        if (!hasTech) isVisible = false;
                    }
                    
                    // Search filter
                    if (activeFilters.search) {
                        const searchTerm = activeFilters.search;
                        const matchesSearch = 
                            cardTitle.includes(searchTerm) ||
                            cardDescription.includes(searchTerm) ||
                            cardSkills.some(skill => skill.includes(searchTerm));
                        
                        if (!matchesSearch) isVisible = false;
                    }
                    
                    // Show/hide card
                    if (isVisible) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Update results count
                resultsCount.textContent = `Showing ${visibleCount} of ${projectCards.length} projects`;
                
                // Show/hide no results message
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                    projectsGrid.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    projectsGrid.style.display = 'grid';
                }
                
                // Sort projects
                sortProjects();
                
                // Hide loading spinner
                loadingSpinner.style.display = 'none';
                projectsGrid.style.opacity = '1';
            }, 300);
        }
        
        // Sort projects function
        function sortProjects() {
            const container = document.getElementById('projectsGrid');
            const cards = Array.from(container.querySelectorAll('.project-card-compact:not([style*="display: none"])'));
            
            cards.sort((a, b) => {
                switch(activeFilters.sort) {
                    case 'newest':
                        // For demo, we'll sort by difficulty (advanced first)
                        const difficultyOrder = { 'advanced': 3, 'intermediate': 2, 'beginner': 1 };
                        return difficultyOrder[b.dataset.difficulty] - difficultyOrder[a.dataset.difficulty];
                    
                    case 'difficulty':
                        const diffOrder = { 'beginner': 1, 'intermediate': 2, 'advanced': 3 };
                        return diffOrder[a.dataset.difficulty] - diffOrder[b.dataset.difficulty];
                    
                    case 'complexity':
                        const compOrder = { 'beginner': 1, 'intermediate': 2, 'advanced': 3 };
                        return compOrder[b.dataset.difficulty] - compOrder[a.dataset.difficulty];
                    
                    case 'alphabetical':
                        const titleA = a.querySelector('.project-title-compact').textContent;
                        const titleB = b.querySelector('.project-title-compact').textContent;
                        return titleA.localeCompare(titleB);
                    
                    case 'popular':
                    default:
                        // Default sort (by category)
                        const categoryOrder = { 'web': 1, 'ai': 2, 'mobile': 3, 'data': 4, 'iot': 5 };
                        const catA = a.dataset.tech;
                        const catB = b.dataset.tech;
                        return (categoryOrder[catA] || 6) - (categoryOrder[catB] || 6);
                }
            });
            
            // Re-append cards in sorted order
            cards.forEach(card => container.appendChild(card));
        }
        
        // Update view function
        function updateView() {
            if (activeFilters.view === 'list') {
                projectsGrid.style.gridTemplateColumns = '1fr';
                projectCards.forEach(card => {
                    card.style.flexDirection = 'row';
                    card.querySelector('.project-description').style.flexGrow = '0';
                });
            } else {
                projectsGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(350px, 1fr))';
                projectCards.forEach(card => {
                    card.style.flexDirection = 'column';
                    card.querySelector('.project-description').style.flexGrow = '1';
                });
            }
        }
        
        // Initial filter call
        filterProjects();
    });
    </script>
</body>
</html>