<?php
// business-detail.php
$pageTitle = "Business Idea Details - Start Your Entrepreneurial Journey";
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
    <style>
        /* Business Detail Page Specific Styles */
        .business-detail-page {
            /* padding-top: 100px; */
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
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        .business-category {
            display: inline-block;
            background: var(--gold-accent);
            color: var(--luxury-blue);
            padding: 0.4rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .business-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .business-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        
        .business-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .meta-icon {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .meta-text {
            font-size: 1.1rem;
        }
        
        .business-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        /* Main Content */
        .main-content {
            padding-bottom: 5rem;
        }
        
        .business-body {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 3rem;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
        }
        
        .featured-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 2.5rem;
        }
        
        /* Section Styles */
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin: 2.5rem 0 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        .body-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 1.8rem;
        }
        
        .body-text ul, .body-text ol {
            margin: 1.5rem 0;
            padding-left: 1.8rem;
        }
        
        .body-text li {
            margin-bottom: 0.8rem;
            line-height: 1.6;
        }
        
        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2.5rem 0;
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.95rem;
        }
        
        /* Strategy Steps */
        .strategy-steps {
            margin: 2.5rem 0;
        }
        
        .step-item {
            margin-bottom: 2.5rem;
            position: relative;
            padding-left: 3rem;
        }
        
        .step-number {
            position: absolute;
            left: 0;
            top: 0;
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--luxury-blue-light), var(--luxury-blue));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .step-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.8rem;
        }
        
        /* Resources Section */
        .resources-section {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-radius: 12px;
            padding: 2rem;
            margin: 2.5rem 0;
        }
        
        .resource-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        
        .resource-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .resource-icon {
            font-size: 1.5rem;
            color: var(--luxury-blue);
        }
        
        .resource-info {
            flex: 1;
        }
        
        .resource-title {
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.2rem;
        }
        
        .resource-desc {
            font-size: 0.9rem;
            color: #666;
        }
        
        .download-btn {
            background: var(--luxury-blue);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .download-btn:hover {
            background: var(--luxury-blue-light);
        }
        
        /* Sidebar */
        .sidebar-card {
            background: var(--section-bg);
            border-radius: 12px;
            padding: 1.8rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }
        
        .sidebar-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        /* Quick Facts */
        .quick-fact {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--border-light);
        }
        
        .fact-label {
            color: #666;
        }
        
        .fact-value {
            font-weight: 600;
            color: var(--luxury-blue);
        }
        
        /* Success Stories */
        .success-story {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .story-author {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .author-name {
            font-weight: 600;
            color: var(--luxury-blue);
        }
        
        /* Related Ideas */
        .related-ideas {
            padding: 4rem 0;
            background: var(--cream-bg);
        }
        
        .related-card {
            background: var(--section-bg);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .related-card h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }
        
        .related-card p {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .business-detail-page {
                padding-top: 80px;
            }
            
            .page-header {
                padding: 3rem 0;
                border-radius: 0 0 15px 15px;
            }
            
            .business-title {
                font-size: 2.5rem;
            }
            
            .business-body {
                padding: 2rem;
            }
            
            .featured-image {
                height: 300px;
            }
        }
        
        @media (max-width: 768px) {
            .business-title {
                font-size: 2rem;
            }
            
            .business-subtitle {
                font-size: 1.1rem;
            }
            
            .business-meta {
                flex-direction: column;
                gap: 1rem;
            }
            
            .business-actions {
                flex-direction: column;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Business Detail Page -->
    <div class="business-detail-page">
        <!-- Header -->
        <section class="page-header">
            <div class="container">
                <div class="page-header-content">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="business-ideas.php">Business Ideas</a></li>
                            <li class="breadcrumb-item"><a href="#">Online Business</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dropshipping Store</li>
                        </ol>
                    </nav>
                    
                    <!-- Category -->
                    <span class="business-category">Online Business</span>
                    
                    <!-- Title -->
                    <h1 class="business-title">Dropshipping Store</h1>
                    
                    <!-- Subtitle -->
                    <p class="business-subtitle">
                        Start an e-commerce business without inventory. Source products from suppliers who ship directly to your customers. Perfect for students with limited capital.
                    </p>
                    
                    <!-- Meta Information -->
                    <div class="business-meta">
                        <div class="meta-item">
                            <i class="fas fa-dollar-sign meta-icon"></i>
                            <span class="meta-text">Investment: $100 - $500</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock meta-icon"></i>
                            <span class="meta-text">Time: 5-15 hours/week</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-chart-line meta-icon"></i>
                            <span class="meta-text">Earning Potential: $500 - $5,000/month</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users meta-icon"></i>
                            <span class="meta-text">Skill Level: Beginner</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="business-actions">
                        <a href="#resources" class="btn-primary">
                            <i class="fas fa-download me-2"></i>Download Resources
                        </a>
                        <a href="#" class="btn-outline-secondary">
                            <i class="fas fa-play-circle me-2"></i>Watch Tutorial
                        </a>
                        <a href="#" class="btn-secondary">
                            <i class="fas fa-comments me-2"></i>Get Mentorship
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Main Content -->
        <section class="main-content">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <div class="business-body">
                            <!-- Featured Image -->
                            <div class="featured-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                            
                            <!-- Overview -->
                            <section>
                                <h2 class="section-title">Business Overview</h2>
                                <p class="body-text">
                                    Dropshipping is a retail fulfillment method where you don't keep products in stock. Instead, when you sell a product, you purchase it from a third party and have it shipped directly to the customer. This means you never see or handle the product.
                                </p>
                                <p class="body-text">
                                    This business model is perfect for students because it requires minimal upfront investment, can be managed from anywhere, and allows you to focus on marketing rather than inventory management. You can start with as little as $100 and scale up as you learn.
                                </p>
                            </section>
                            
                            <!-- Key Stats -->
                            <section>
                                <h2 class="section-title">Key Statistics</h2>
                                <div class="stats-cards">
                                    <div class="stat-card">
                                        <div class="stat-number">85%</div>
                                        <div class="stat-label">Success Rate for Students</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-number">2-4</div>
                                        <div class="stat-label">Weeks to First Sale</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-number">30-50%</div>
                                        <div class="stat-label">Average Profit Margin</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-number">2.3K</div>
                                        <div class="stat-label">Students Started</div>
                                    </div>
                                </div>
                            </section>
                            
                            <!-- Step-by-Step Strategy -->
                            <section>
                                <h2 class="section-title">Step-by-Step Strategy</h2>
                                <div class="strategy-steps">
                                    <!-- Step 1 -->
                                    <div class="step-item">
                                        <div class="step-number">1</div>
                                        <h3 class="step-title">Niche Selection</h3>
                                        <p class="body-text">
                                            Choose a specific niche (e.g., eco-friendly products, pet accessories, fitness gear). Research trending products using tools like Google Trends and AliExpress. Look for products with good profit margins and reliable suppliers.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 2 -->
                                    <div class="step-item">
                                        <div class="step-number">2</div>
                                        <h3 class="step-title">Supplier Research</h3>
                                        <p class="body-text">
                                            Find reliable suppliers on platforms like AliExpress, SaleHoo, or Oberlo. Order samples to check product quality. Negotiate shipping times and prices. Look for suppliers with good ratings and reviews.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 3 -->
                                    <div class="step-item">
                                        <div class="step-number">3</div>
                                        <h3 class="step-title">Store Setup</h3>
                                        <p class="body-text">
                                            Create your online store using Shopify, WooCommerce, or BigCommerce. Choose a professional theme, add products with high-quality images and descriptions, set up payment gateways (Stripe, PayPal), and configure shipping settings.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 4 -->
                                    <div class="step-item">
                                        <div class="step-number">4</div>
                                        <h3 class="step-title">Marketing Strategy</h3>
                                        <p class="body-text">
                                            Start with Facebook and Instagram ads targeting your ideal customers. Create engaging content, run promotions, and build an email list. Use influencer marketing and SEO to drive organic traffic.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 5 -->
                                    <div class="step-item">
                                        <div class="step-number">5</div>
                                        <h3 class="step-title">Customer Service</h3>
                                        <p class="body-text">
                                            Set up automated email responses for order confirmations and shipping updates. Use tools like Zendesk for customer support. Handle returns and refunds professionally to build trust.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 6 -->
                                    <div class="step-item">
                                        <div class="step-number">6</div>
                                        <h3 class="step-title">Scale Your Business</h3>
                                        <p class="body-text">
                                            Once profitable, reinvest profits into more advertising. Add new products to your store. Consider creating your own branded products. Automate processes to save time.
                                        </p>
                                    </div>
                                </div>
                            </section>
                            
                            <!-- Resources -->
                            <section id="resources">
                                <h2 class="section-title">Downloadable Resources</h2>
                                <div class="resources-section">
                                    <!-- Resource 1 -->
                                    <a href="#" class="resource-card">
                                        <div class="resource-icon">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div class="resource-info">
                                            <div class="resource-title">Complete Dropshipping Guide</div>
                                            <div class="resource-desc">PDF • 45 pages • Includes supplier checklist and templates</div>
                                        </div>
                                        <button class="download-btn">Download</button>
                                    </a>
                                    
                                    <!-- Resource 2 -->
                                    <a href="#" class="resource-card">
                                        <div class="resource-icon">
                                            <i class="fas fa-file-excel"></i>
                                        </div>
                                        <div class="resource-info">
                                            <div class="resource-title">Profit Calculator & Tracker</div>
                                            <div class="resource-desc">Excel • Automatically calculates ROI and margins</div>
                                        </div>
                                        <button class="download-btn">Download</button>
                                    </a>
                                    
                                    <!-- Resource 3 -->
                                    <a href="#" class="resource-card">
                                        <div class="resource-icon">
                                            <i class="fas fa-file-word"></i>
                                        </div>
                                        <div class="resource-info">
                                            <div class="resource-title">Email Templates Pack</div>
                                            <div class="resource-desc">Word • Customer service and marketing email templates</div>
                                        </div>
                                        <button class="download-btn">Download</button>
                                    </a>
                                    
                                    <!-- Resource 4 -->
                                    <a href="#" class="resource-card">
                                        <div class="resource-icon">
                                            <i class="fas fa-video"></i>
                                        </div>
                                        <div class="resource-info">
                                            <div class="resource-title">Video Course: From Zero to First Sale</div>
                                            <div class="resource-desc">MP4 • 3 hours • Step-by-step video tutorials</div>
                                        </div>
                                        <button class="download-btn">Download</button>
                                    </a>
                                </div>
                            </section>
                            
                            <!-- Tools & Platforms -->
                            <section>
                                <h2 class="section-title">Recommended Tools & Platforms</h2>
                                <p class="body-text">
                                    Here are the essential tools you'll need to start your dropshipping business:
                                </p>
                                <ul class="body-text">
                                    <li><strong>Shopify</strong> - E-commerce platform ($29/month)</li>
                                    <li><strong>Oberlo</strong> - Product sourcing app (Free for beginners)</li>
                                    <li><strong>Canva</strong> - Graphic design tool (Free plan available)</li>
                                    <li><strong>Google Analytics</strong> - Traffic analysis (Free)</li>
                                    <li><strong>Mailchimp</strong> - Email marketing (Free up to 2,000 subscribers)</li>
                                    <li><strong>Facebook Business Manager</strong> - Advertising platform (Free)</li>
                                </ul>
                            </section>
                            
                            <!-- Common Challenges -->
                            <section>
                                <h2 class="section-title">Common Challenges & Solutions</h2>
                                <div class="body-text">
                                    <p><strong>Challenge 1:</strong> Long shipping times<br>
                                    <strong>Solution:</strong> Use suppliers with ePacket shipping or source from local suppliers.</p>
                                    
                                    <p><strong>Challenge 2:</strong> Low profit margins<br>
                                    <strong>Solution:</strong> Bundle products, upsell accessories, or create unique value propositions.</p>
                                    
                                    <p><strong>Challenge 3:</strong> Product quality issues<br>
                                    <strong>Solution:</strong> Always order samples first and have quality control checks.</p>
                                    
                                    <p><strong>Challenge 4:</strong> High advertising costs<br>
                                    <strong>Solution:</strong> Focus on organic marketing through SEO and social media.</p>
                                </div>
                            </section>
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Quick Facts -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Quick Facts</h3>
                            <div class="quick-fact">
                                <span class="fact-label">Startup Cost</span>
                                <span class="fact-value">$100 - $500</span>
                            </div>
                            <div class="quick-fact">
                                <span class="fact-label">Time to Launch</span>
                                <span class="fact-value">1 - 2 weeks</span>
                            </div>
                            <div class="quick-fact">
                                <span class="fact-label">Monthly Revenue</span>
                                <span class="fact-value">$500 - $5,000</span>
                            </div>
                            <div class="quick-fact">
                                <span class="fact-label">Profit Margin</span>
                                <span class="fact-value">30% - 50%</span>
                            </div>
                            <div class="quick-fact">
                                <span class="fact-label">Break-even Time</span>
                                <span class="fact-value">1 - 3 months</span>
                            </div>
                            <div class="quick-fact">
                                <span class="fact-label">Student Rating</span>
                                <span class="fact-value">4.8/5.0</span>
                            </div>
                        </div>
                        
                        <!-- Success Stories -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Student Success Stories</h3>
                            <div class="success-story">
                                <div class="story-author">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah" class="author-avatar">
                                    <div>
                                        <div class="author-name">Sarah Chen</div>
                                        <small>Computer Science Student</small>
                                    </div>
                                </div>
                                <p class="body-text" style="font-size: 0.95rem;">
                                    "Started with $200 during my sophomore year. Now earning $3,000/month profit while studying full-time. This business paid for my tuition!"
                                </p>
                            </div>
                            <div class="success-story">
                                <div class="story-author">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex" class="author-avatar">
                                    <div>
                                        <div class="author-name">Alex Johnson</div>
                                        <small>Business Student</small>
                                    </div>
                                </div>
                                <p class="body-text" style="font-size: 0.95rem;">
                                    "Used the exact strategy from this guide. Made my first sale in 2 weeks, now running a 6-figure dropshipping store."
                                </p>
                            </div>
                        </div>
                        
                        <!-- Mentorship -->
                        <div class="sidebar-card" style="background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));">
                            <h3 class="sidebar-title">Need Help Starting?</h3>
                            <p class="body-text mb-3">
                                Get 1-on-1 mentorship from successful student entrepreneurs who have built profitable dropshipping businesses.
                            </p>
                            <a href="#" class="btn-primary w-100">
                                <i class="fas fa-user-graduate me-2"></i>Book Mentorship Session
                            </a>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-clock me-1"></i> Free 30-minute consultation
                            </small>
                        </div>
                        
                        <!-- Related Ideas -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Related Business Ideas</h3>
                            <div class="related-card mb-3">
                                <h4><a href="business-detail.php" class="text-decoration-none">Print-on-Demand Business</a></h4>
                                <small class="text-muted">Online Business • $200-800 investment</small>
                            </div>
                            <div class="related-card mb-3">
                                <h4><a href="business-detail.php" class="text-decoration-none">Affiliate Marketing Blog</a></h4>
                                <small class="text-muted">Online Business • $300-600 investment</small>
                            </div>
                            <div class="related-card">
                                <h4><a href="business-detail.php" class="text-decoration-none">Social Media Management</a></h4>
                                <small class="text-muted">Service-Based • $100-300 investment</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Related Ideas -->
        <section class="related-ideas">
            <div class="container">
                <h2 class="section-heading text-center mb-5">
                    More <span style="color: var(--gold-accent);">Business Ideas</span>
                </h2>
                
                <div class="row g-4">
                    <!-- Related 1 -->
                    <div class="col-md-4">
                        <div class="related-card">
                            <span class="badge bg-primary mb-2">Online Business</span>
                            <h4>Print-on-Demand</h4>
                            <p>Create custom designs for t-shirts, mugs, and other products. Only pay when items are sold.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">$200-800 investment</small>
                                <a href="business-detail.php" class="btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related 2 -->
                    <div class="col-md-4">
                        <div class="related-card">
                            <span class="badge bg-primary mb-2">Digital Products</span>
                            <h4>Online Course Creation</h4>
                            <p>Create and sell online courses on topics you're knowledgeable about. Earn passive income.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">$300-600 investment</small>
                                <a href="business-detail.php" class="btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related 3 -->
                    <div class="col-md-4">
                        <div class="related-card">
                            <span class="badge bg-primary mb-2">Service-Based</span>
                            <h4>Freelance Writing</h4>
                            <p>Write articles, blog posts, and content for clients. Perfect for students with good writing skills.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">$50-200 investment</small>
                                <a href="business-detail.php" class="btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <a href="business-ideas.php" class="btn-primary btn-lg">
                        <i class="fas fa-lightbulb me-2"></i>Browse All Business Ideas
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
    // Download button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const downloadButtons = document.querySelectorAll('.download-btn');
        
        downloadButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const resourceCard = this.closest('.resource-card');
                const resourceTitle = resourceCard.querySelector('.resource-title').textContent;
                
                // Simulate download
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Downloading...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-check me-2"></i>Downloaded';
                    alert(`"${resourceTitle}" has been downloaded to your device.`);
                    
                    // Reset button after 2 seconds
                    setTimeout(() => {
                        this.innerHTML = 'Download';
                        this.disabled = false;
                    }, 2000);
                }, 1500);
            });
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
    </script>
</body>
</html>