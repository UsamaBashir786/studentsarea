<?php
// article-details.php
$pageTitle = "Article Title - StudentsArea";
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
    <!-- Prism.js for code syntax highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    <style>
        /* Article Details Page Specific Styles */
        .article-details-page {
            min-height: 100vh;
        }
        
        .article-header {
            background: linear-gradient(135deg, var(--luxury-blue-light) 0%, var(--luxury-blue) 100%);
            padding: 4rem 0;
            color: white;
        }
        
        .article-header-content {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .article-breadcrumb {
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        .article-category {
            display: inline-block;
            background: var(--gold-accent);
            color: var(--luxury-blue);
            padding: 0.4rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .article-title {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .article-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .author-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold-accent);
        }
        
        .author-details h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .author-details p {
            margin: 0;
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .meta-stats {
            display: flex;
            gap: 1.5rem;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }
        
        .stat-item i {
            color: var(--gold-accent);
        }
        
        .article-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .action-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Main Content */
        .article-content {
            padding: 5rem 0;
            background: var(--section-bg);
        }
        
        .article-body {
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
        
        /* Typography */
        .article-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 1.8rem;
        }
        
        .article-text h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin: 2.5rem 0 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        .article-text h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin: 2rem 0 1rem;
        }
        
        .article-text ul, .article-text ol {
            margin: 1.5rem 0;
            padding-left: 1.8rem;
        }
        
        .article-text li {
            margin-bottom: 0.8rem;
            line-height: 1.6;
        }
        
        .article-text blockquote {
            border-left: 4px solid var(--gold-accent);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #555;
            background: linear-gradient(135deg, rgba(163, 146, 116, 0.05), rgba(10, 36, 99, 0.05));
            padding: 1.5rem;
            border-radius: 0 8px 8px 0;
        }
        
        /* Code Blocks */
        .code-block {
            background: #1a1a1a;
            border-radius: 8px;
            overflow: hidden;
            margin: 2rem 0;
        }
        
        .code-header {
            background: #2d2d2d;
            padding: 0.8rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #444;
        }
        
        .code-language {
            color: #ccc;
            font-size: 0.9rem;
            font-family: monospace;
        }
        
        .copy-btn {
            background: #444;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .copy-btn:hover {
            background: #555;
        }
        
        .code-content {
            padding: 1.5rem;
            overflow-x: auto;
        }
        
        /* Info Boxes */
        .info-box {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-left: 4px solid var(--luxury-blue);
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 0 8px 8px 0;
        }
        
        .info-box.warning {
            border-left-color: #ffc107;
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.05), rgba(255, 193, 7, 0.1));
        }
        
        .info-box.success {
            border-left-color: #28a745;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.05), rgba(40, 167, 69, 0.1));
        }
        
        .info-box-title {
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Share Bar */
        .share-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 3rem 0;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-radius: 10px;
        }
        
        .share-label {
            font-weight: 600;
            color: var(--luxury-blue);
            margin-right: 1rem;
        }
        
        .share-buttons {
            display: flex;
            gap: 0.8rem;
        }
        
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .share-facebook { background: #3b5998; }
        .share-twitter { background: #1da1f2; }
        .share-linkedin { background: #0077b5; }
        .share-whatsapp { background: #25d366; }
        .share-copy { background: #6c757d; }
        
        /* Author Bio */
        .author-bio {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-radius: 12px;
            padding: 2rem;
            margin: 3rem 0;
        }
        
        .author-bio-content {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .author-bio-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gold-accent);
        }
        
        .author-bio-text h3 {
            color: var(--luxury-blue);
            margin-bottom: 0.5rem;
        }
        
        .author-bio-text p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .author-social {
            display: flex;
            gap: 1rem;
        }
        
        .author-social a {
            color: var(--luxury-blue);
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        
        .author-social a:hover {
            color: var(--gold-accent);
        }
        
        /* Related Articles */
        .related-articles {
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
        
        /* Comments Section */
        .comments-section {
            padding: 3rem 0;
            border-top: 1px solid var(--border-light);
        }
        
        .comment-form {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 3rem;
        }
        
        .comment {
            background: var(--section-bg);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .comment-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .comment-author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .comment-date {
            color: #777;
            font-size: 0.9rem;
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
        
        /* Table of Contents */
        .toc {
            /* position: sticky; */
            top: 120px;
        }
        
        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .toc-item {
            margin-bottom: 0.8rem;
        }
        
        .toc-link {
            color: #555;
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
            border-left: 3px solid transparent;
            padding-left: 1rem;
            transition: all 0.3s ease;
        }
        
        .toc-link:hover,
        .toc-link.active {
            color: var(--luxury-blue);
            border-left-color: var(--gold-accent);
            padding-left: 1.5rem;
        }
        
        /* Download Resources */
        .download-resource {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));
            border-radius: 8px;
            margin-bottom: 1rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        
        .download-resource:hover {
            background: linear-gradient(135deg, rgba(10, 36, 99, 0.1), rgba(163, 146, 116, 0.1));
            transform: translateY(-2px);
        }
        
        .download-icon {
            font-size: 1.5rem;
            color: var(--luxury-blue);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .article-details-page {
                padding-top: 80px;
            }
            
            .article-header {
                padding: 3rem 0;
            }
            
            .article-title {
                font-size: 2.5rem;
            }
            
            .article-body {
                padding: 2rem;
            }
            
            .author-bio-content {
                flex-direction: column;
                text-align: center;
            }
        }
        
        @media (max-width: 768px) {
            .article-title {
                font-size: 2rem;
            }
            
            .article-subtitle {
                font-size: 1.1rem;
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .featured-image {
                height: 250px;
            }
            
            .share-bar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Article Details Page -->
    <div class="article-details-page">
        <!-- Article Header -->
        <section class="article-header">
            <div class="container">
                <div class="article-header-content">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="article-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="articles.php">Articles</a></li>
                            <li class="breadcrumb-item"><a href="#">Career Advice</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Article Title</li>
                        </ol>
                    </nav>
                    
                    <!-- Category -->
                    <span class="article-category">Career Advice</span>
                    
                    <!-- Title -->
                    <h1 class="article-title">The Ultimate Guide to Landing Your First Remote Job as a Student</h1>
                    
                    <!-- Subtitle -->
                    <p class="article-subtitle">
                        Discover proven strategies to secure remote work while studying. Learn how to build a standout portfolio, ace virtual interviews, and balance work with academics.
                    </p>
                    
                    <!-- Meta Information -->
                    <div class="article-meta">
                        <div class="author-info">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Johnson" class="author-avatar">
                            <div class="author-details">
                                <h4>Alex Johnson</h4>
                                <p>Senior Career Advisor • 5 years experience</p>
                            </div>
                        </div>
                        
                        <div class="meta-stats">
                            <div class="stat-item">
                                <i class="far fa-calendar"></i>
                                <span>March 15, 2024</span>
                            </div>
                            <div class="stat-item">
                                <i class="far fa-clock"></i>
                                <span>8 min read</span>
                            </div>
                            <div class="stat-item">
                                <i class="far fa-eye"></i>
                                <span>12,458 views</span>
                            </div>
                            <div class="stat-item">
                                <i class="far fa-comment"></i>
                                <span>84 comments</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="article-actions">
                        <a href="#" class="action-btn">
                            <i class="far fa-bookmark"></i> Save for later
                        </a>
                        <a href="#comments" class="action-btn">
                            <i class="far fa-comment"></i> Add comment
                        </a>
                        <a href="#share" class="action-btn">
                            <i class="fas fa-share"></i> Share article
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Article Content -->
        <section class="article-content">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <div class="article-body">
                            <!-- Featured Image -->
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Remote Work" class="featured-image">
                            
                            <!-- Article Text -->
                            <div class="article-text">
                                <p>As a student, the idea of landing a remote job might seem daunting. Between classes, assignments, and exams, how can you possibly find time to work? The truth is, remote work offers incredible flexibility that can perfectly complement your academic schedule. In this comprehensive guide, we'll walk you through every step of securing your first remote position.</p>
                                
                                <h2>Why Remote Work is Perfect for Students</h2>
                                <p>Remote work isn't just a trend—it's a fundamental shift in how we work. For students, it offers several unique advantages:</p>
                                
                                <ul>
                                    <li><strong>Flexible Schedule</strong>: Work around your class timetable and study sessions</li>
                                    <li><strong>No Commute</strong>: Save time and money on transportation</li>
                                    <li><strong>Global Opportunities</strong>: Access jobs from companies worldwide</li>
                                    <li><strong>Skill Development</strong>: Build professional experience while studying</li>
                                    <li><strong>Income Generation</strong>: Earn money to support your education</li>
                                </ul>
                                
                                <div class="info-box">
                                    <div class="info-box-title">
                                        <i class="fas fa-lightbulb text-warning"></i>
                                        <span>Pro Tip</span>
                                    </div>
                                    <p>Start with part-time remote positions (10-20 hours per week) to ensure you can balance work with your studies effectively.</p>
                                </div>
                                
                                <h2>Step 1: Build a Standout Portfolio</h2>
                                <p>Your portfolio is your most powerful tool when applying for remote jobs. Here's how to make it shine:</p>
                                
                                <h3>What to Include:</h3>
                                <ol>
                                    <li><strong>Personal Projects</strong>: Showcase work that demonstrates your skills</li>
                                    <li><strong>Academic Work</strong>: Include relevant assignments and projects</li>
                                    <li><strong>Freelance Work</strong>: Even small gigs show initiative</li>
                                    <li><strong>Code Samples</strong>: GitHub repositories with clean, documented code</li>
                                    <li><strong>Testimonials</strong>: Ask professors or clients for brief endorsements</li>
                                </ol>
                                
                                <h3>Portfolio Platform Options:</h3>
                                
                                <div class="code-block">
                                    <div class="code-header">
                                        <span class="code-language">HTML</span>
                                        <button class="copy-btn" onclick="copyCode(this)">
                                            <i class="fas fa-copy me-1"></i> Copy
                                        </button>
                                    </div>
                                    <div class="code-content">
                                        <pre><code class="language-html">
<!-- Portfolio Website Structure -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Name - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="#" class="logo">YourName</a>
            <ul class="nav-links">
                <li><a href="#projects">Projects</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Frontend Developer & Student</h1>
            <p>Building beautiful, functional web experiences</p>
            <a href="#projects" class="btn">View My Work</a>
        </div>
    </section>
    
    <!-- Projects Section -->
    <section id="projects" class="projects">
        <div class="container">
            <h2>Featured Projects</h2>
            <div class="project-grid">
                <!-- Project items here -->
            </div>
        </div>
    </section>
</body>
</html>
                                        </code></pre>
                                    </div>
                                </div>
                                
                                <div class="info-box success">
                                    <div class="info-box-title">
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>Success Story</span>
                                    </div>
                                    <p>"I landed my first remote job by creating a portfolio with just 3 personal projects. The hiring manager told me they were impressed by how well-documented my code was and the thought process behind each project." - Sarah, Computer Science Student</p>
                                </div>
                                
                                <h2>Step 2: Master the Virtual Interview</h2>
                                <p>Remote interviews have their own set of best practices:</p>
                                
                                <h3>Technical Setup:</h3>
                                <ul>
                                    <li><strong>Reliable Internet</strong>: Use a wired connection if possible</li>
                                    <li><strong>Good Lighting</strong>: Face a window or use a ring light</li>
                                    <li><strong>Professional Background</strong>: Clean, uncluttered space</li>
                                    <li><strong>Quality Audio</strong>: Use headphones with a microphone</li>
                                </ul>
                                
                                <blockquote>
                                    "The most important thing in a remote interview is showing that you can communicate effectively in a digital environment. Practice explaining technical concepts clearly and concisely."
                                </blockquote>
                                
                                <h3>Common Remote Interview Questions:</h3>
                                <ol>
                                    <li>"How do you manage your time and stay productive while working remotely?"</li>
                                    <li>"What tools do you use for communication and project management?"</li>
                                    <li>"How would you handle a situation where you're stuck on a problem and can't ask for immediate help?"</li>
                                    <li>"Describe your ideal remote work setup and routine."</li>
                                </ol>
                                
                                <h2>Step 3: Balance Work and Studies</h2>
                                <p>Finding the right balance is crucial for long-term success:</p>
                                
                                <div class="info-box warning">
                                    <div class="info-box-title">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                        <span>Avoid Burnout</span>
                                    </div>
                                    <p>Don't take on more work than you can handle. Start with 10-15 hours per week and adjust based on your academic workload. Remember: your education comes first!</p>
                                </div>
                                
                                <h3>Time Management Strategies:</h3>
                                <ul>
                                    <li><strong>Time Blocking</strong>: Allocate specific hours for work, study, and rest</li>
                                    <li><strong>Pomodoro Technique</strong>: Work in focused 25-minute intervals</li>
                                    <li><strong>Prioritization Matrix</strong>: Use Eisenhower's Urgent/Important matrix</li>
                                    <li><strong>Digital Detox</strong>: Schedule regular breaks from screens</li>
                                </ul>
                                
                                <h2>Step 4: Continue Learning and Growing</h2>
                                <p>The remote work landscape is constantly evolving. Stay ahead by:</p>
                                
                                <ol>
                                    <li>Taking online courses in your field</li>
                                    <li>Participating in virtual hackathons and competitions</li>
                                    <li>Contributing to open-source projects</li>
                                    <li>Building a professional network on LinkedIn</li>
                                    <li>Attending virtual conferences and webinars</li>
                                </ol>
                                
                                <p>Remember, your first remote job is just the beginning. Use it as a stepping stone to build experience, develop skills, and position yourself for even better opportunities in the future.</p>
                                
                                <h2>Next Steps</h2>
                                <p>Ready to start your remote work journey? Here's your action plan:</p>
                                
                                <ol>
                                    <li>Update your LinkedIn profile with relevant keywords</li>
                                    <li>Create or update your portfolio website</li>
                                    <li>Set up job alerts on remote job boards</li>
                                    <li>Practice your virtual interview skills</li>
                                    <li>Start applying to 3-5 positions per week</li>
                                </ol>
                                
                                <p>The remote work revolution is here, and as a student, you're perfectly positioned to take advantage of it. With the right preparation and mindset, you can build a successful career while still completing your education.</p>
                            </div>
                            
                            <!-- Share Bar -->
                            <div class="share-bar">
                                <span class="share-label">Share this article:</span>
                                <div class="share-buttons">
                                    <a href="#" class="share-btn share-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="share-btn share-twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="share-btn share-linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="share-btn share-whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <button class="share-btn share-copy" onclick="copyArticleLink()">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Author Bio -->
                            <div class="author-bio">
                                <div class="author-bio-content">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Johnson" class="author-bio-avatar">
                                    <div class="author-bio-text">
                                        <h3>About the Author</h3>
                                        <p>Alex Johnson is a Senior Career Advisor with 5+ years of experience helping students launch successful careers. He specializes in remote work strategies and has helped over 500 students secure their first remote positions. Alex is passionate about making career opportunities accessible to everyone, regardless of their location or background.</p>
                                        <div class="author-social">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                            <a href="#"><i class="fab fa-github"></i></a>
                                            <a href="#"><i class="fas fa-globe"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Comments Section -->
                            <div class="comments-section" id="comments">
                                <h2 class="section-title">Comments (84)</h2>
                                
                                <!-- Comment Form -->
                                <div class="comment-form">
                                    <h4 class="mb-3">Leave a Comment</h4>
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Your Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" placeholder="Your Email" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn-primary">Post Comment</button>
                                    </form>
                                </div>
                                
                                <!-- Comments List -->
                                <div class="comment">
                                    <div class="comment-header">
                                        <div class="comment-author">
                                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah">
                                            <div>
                                                <h5 class="mb-0">Sarah Miller</h5>
                                                <small>Computer Science Student</small>
                                            </div>
                                        </div>
                                        <div class="comment-date">2 days ago</div>
                                    </div>
                                    <p>This article came at the perfect time! I've been struggling to balance my studies with job hunting. The portfolio tips were especially helpful. Thank you!</p>
                                    <a href="#" class="btn-outline-primary btn-sm">Reply</a>
                                </div>
                                
                                <div class="comment">
                                    <div class="comment-header">
                                        <div class="comment-author">
                                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="David">
                                            <div>
                                                <h5 class="mb-0">David Chen</h5>
                                                <small>Recent Graduate</small>
                                            </div>
                                        </div>
                                        <div class="comment-date">1 week ago</div>
                                    </div>
                                    <p>I followed this guide exactly and landed a remote internship last month! The virtual interview preparation section made all the difference. Highly recommended!</p>
                                    <a href="#" class="btn-outline-primary btn-sm">Reply</a>
                                </div>
                                
                                <!-- View More Comments -->
                                <div class="text-center mt-4">
                                    <a href="#" class="btn-outline-primary">Load More Comments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Table of Contents -->
                        <div class="sidebar-card toc">
                            <h3 class="sidebar-title">Table of Contents</h3>
                            <ul class="toc-list">
                                <li class="toc-item">
                                    <a href="#why-remote" class="toc-link active">Why Remote Work is Perfect</a>
                                </li>
                                <li class="toc-item">
                                    <a href="#build-portfolio" class="toc-link">Build a Standout Portfolio</a>
                                </li>
                                <li class="toc-item">
                                    <a href="#master-interview" class="toc-link">Master the Virtual Interview</a>
                                </li>
                                <li class="toc-item">
                                    <a href="#balance-work" class="toc-link">Balance Work and Studies</a>
                                </li>
                                <li class="toc-item">
                                    <a href="#continue-learning" class="toc-link">Continue Learning & Growing</a>
                                </li>
                                <li class="toc-item">
                                    <a href="#next-steps" class="toc-link">Next Steps</a>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Download Resources -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Download Resources</h3>
                            <a href="#" class="download-resource">
                                <div class="download-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Remote Job Checklist</div>
                                    <small>PDF • 120KB</small>
                                </div>
                            </a>
                            <a href="#" class="download-resource">
                                <div class="download-icon">
                                    <i class="fas fa-file-word"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Interview Questions Template</div>
                                    <small>DOCX • 85KB</small>
                                </div>
                            </a>
                            <a href="#" class="download-resource">
                                <div class="download-icon">
                                    <i class="fas fa-file-excel"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Time Management Tracker</div>
                                    <small>XLSX • 95KB</small>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Related Articles -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Related Articles</h3>
                            <div class="related-card mb-3">
                                <h4><a href="#" class="text-decoration-none">10 Essential JavaScript Concepts Every Beginner Should Master</a></h4>
                                <small class="text-muted">Web Development • 6 min read</small>
                            </div>
                            <div class="related-card mb-3">
                                <h4><a href="#" class="text-decoration-none">How I Made $5,000/month Freelancing While in College</a></h4>
                                <small class="text-muted">Freelancing • 10 min read</small>
                            </div>
                            <div class="related-card">
                                <h4><a href="#" class="text-decoration-none">Building a Killer Portfolio: What Recruiters Really Look For</a></h4>
                                <small class="text-muted">Portfolio Building • 7 min read</small>
                            </div>
                        </div>
                        
                        <!-- Newsletter -->
                        <div class="sidebar-card" style="background: linear-gradient(135deg, rgba(10, 36, 99, 0.05), rgba(163, 146, 116, 0.05));">
                            <h3 class="sidebar-title">Get Career Insights</h3>
                            <p class="body-text mb-3">
                                Join 15,000+ students who receive weekly career advice and job opportunities.
                            </p>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your email address">
                            </div>
                            <button class="btn-primary w-100">Subscribe Now</button>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-shield-alt me-1"></i> No spam, unsubscribe anytime
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Related Articles Section -->
        <section class="related-articles">
            <div class="container">
                <h2 class="section-heading text-center mb-5">
                    More <span style="color: var(--gold-accent);">Career Articles</span>
                </h2>
                
                <div class="row g-4">
                    <!-- Related 1 -->
                    <div class="col-md-4">
                        <div class="related-card">
                            <span class="badge bg-primary mb-2">Interview Tips</span>
                            <h4>15 Common Technical Interview Questions & How to Answer Them</h4>
                            <p>Prepare for your next tech interview with these common questions and expert-approved answers.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="far fa-clock me-1"></i> 12 min read</small>
                                <a href="#" class="btn-outline-primary btn-sm">Read Article</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related 2 -->
                    <div class="col-md-4">
                        <div class="related-card">
                            <span class="badge bg-primary mb-2">Portfolio Building</span>
                            <h4>Building a Killer Portfolio: What Recruiters Really Look For</h4>
                            <p>Your portfolio is your ticket to great opportunities. Learn what makes a portfolio stand out.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="far fa-clock me-1"></i> 7 min read</small>
                                <a href="#" class="btn-outline-primary btn-sm">Read Article</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related 3 -->
                    <div class="col-md-4">
                        <div class="related-card">
                            <span class="badge bg-primary mb-2">Freelancing</span>
                            <h4>How to Set Your Freelance Rates: A Student's Guide</h4>
                            <p>Learn how to price your services competitively while ensuring you're fairly compensated for your work.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="far fa-clock me-1"></i> 9 min read</small>
                                <a href="#" class="btn-outline-primary btn-sm">Read Article</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <a href="articles.php" class="btn-primary btn-lg">
                        <i class="fas fa-newspaper me-2"></i> Browse All Articles
                    </a>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Prism.js for syntax highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    
    <script>
    // Copy code functionality
    function copyCode(button) {
        const codeBlock = button.closest('.code-block').querySelector('code');
        const textArea = document.createElement('textarea');
        textArea.value = codeBlock.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Change button text temporarily
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        button.classList.add('bg-success');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('bg-success');
        }, 2000);
    }
    
    // Copy article link
    function copyArticleLink() {
        const articleLink = window.location.href;
        const textArea = document.createElement('textarea');
        textArea.value = articleLink;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Show notification
        alert('Article link copied to clipboard!');
    }
    
    // Table of contents scroll spy
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Prism
        if (typeof Prism !== 'undefined') {
            Prism.highlightAll();
        }
        
        // Table of contents click handler
        const tocLinks = document.querySelectorAll('.toc-link');
        const sections = document.querySelectorAll('.article-text h2');
        
        // Scroll to section when TOC link is clicked
        tocLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Update reading progress
        function updateReadingProgress() {
            const articleBody = document.querySelector('.article-body');
            const articleHeight = articleBody.offsetHeight;
            const scrollPosition = window.scrollY - articleBody.offsetTop + 100;
            const progress = (scrollPosition / articleHeight) * 100;
            
            // Update progress bar if exists
            const progressBar = document.querySelector('.reading-progress');
            if (progressBar) {
                progressBar.style.width = Math.min(100, Math.max(0, progress)) + '%';
            }
        }
        
        // Add reading progress bar
        const progressBar = document.createElement('div');
        progressBar.className = 'reading-progress';
        progressBar.style.position = 'fixed';
        progressBar.style.top = '70px';
        progressBar.style.left = '0';
        progressBar.style.height = '3px';
        progressBar.style.background = 'linear-gradient(135deg, var(--luxury-blue), var(--gold-accent))';
        progressBar.style.width = '0%';
        progressBar.style.zIndex = '1000';
        progressBar.style.transition = 'width 0.3s ease';
        document.body.appendChild(progressBar);
        
        // Update progress on scroll
        window.addEventListener('scroll', updateReadingProgress);
        
        // Update TOC active state
        window.addEventListener('scroll', function() {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (scrollY >= sectionTop - 150) {
                    current = section.getAttribute('id');
                }
            });
            
            tocLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').substring(1) === current) {
                    link.classList.add('active');
                }
            });
        });
        
        // Bookmark functionality
        const bookmarkBtn = document.querySelector('.action-btn .fa-bookmark').closest('.action-btn');
        bookmarkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.innerHTML = '<i class="fas fa-bookmark"></i> Saved!';
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-bookmark"></i> Saved';
                }, 2000);
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.innerHTML = '<i class="far fa-bookmark"></i> Save for later';
            }
        });
    });
    </script>
</body>
</html>