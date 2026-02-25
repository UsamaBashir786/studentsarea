<?php
// Get article ID from URL
$articleId = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Sample article data
$article = [
    'id' => 1,
    'title' => 'How to Build a Portfolio as a Student Developer: A Complete Guide',
    'slug' => 'how-to-build-portfolio-student-developer',
    'author' => 'John Doe',
    'author_title' => 'Senior Developer at TechCorp',
    'author_avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
    'author_bio' => '8+ years experience in web development. Passionate about helping students launch their tech careers.',
    'date' => 'January 15, 2024',
    'read_time' => 8,
    'views' => 1250,
    'likes' => 89,
    'comments' => 24,
    'category' => 'Career',
    'difficulty' => 'Beginner',
    'tags' => ['Portfolio', 'Career', 'Students', 'Development'],
    'featured_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
    'content' => '
        <p class="lead">In today\'s competitive tech landscape, having a strong portfolio can make all the difference for student developers seeking internships and entry-level positions.</p>
        
        <h2>Why a Portfolio Matters More Than Your Resume</h2>
        <p>While a resume tells employers what you claim to know, a portfolio shows them what you can actually do. For students with limited professional experience, a strong portfolio can be the deciding factor in getting an interview.</p>
        
        <div class="alert-box">
            <i class="fas fa-lightbulb"></i>
            <strong>Pro Tip:</strong> Recruiters spend an average of 6 seconds on a resume but 2-3 minutes on a portfolio website.
        </div>
        
        <h3>Step 1: Choose Your Projects Wisely</h3>
        <p>As a student, you might not have professional projects to showcase. That\'s perfectly fine! Focus on quality over quantity.</p>
        
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="info-card">
                    <h5><i class="fas fa-graduation-cap text-primary me-2"></i>Course Projects</h5>
                    <p>Even class assignments can be portfolio-worthy if you polish them with proper documentation and clean code.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card">
                    <h5><i class="fas fa-heart text-primary me-2"></i>Personal Projects</h5>
                    <p>Build something you\'re passionate about or solve a problem you\'ve encountered in your daily life.</p>
                </div>
            </div>
        </div>
        
        <h3>Step 2: Document Your Projects Effectively</h3>
        <p>Each project should tell a compelling story of your problem-solving process. Include:</p>
        
        <ul>
            <li><strong>Project Title & Description:</strong> What does it do and why did you build it?</li>
            <li><strong>Technologies Used:</strong> List all technologies, frameworks, and tools</li>
            <li><strong>Your Role:</strong> What part did you play in the project?</li>
            <li><strong>Challenges & Solutions:</strong> What problems did you encounter and how did you solve them?</li>
            <li><strong>Results:</strong> What was the outcome? Any metrics or feedback?</li>
        </ul>
        
        <div class="code-block">
            <div class="code-header">
                <span>Example README.md</span>
                <button class="btn-copy" onclick="copyCode(this)">
                    <i class="far fa-copy"></i> Copy
                </button>
            </div>
            <pre><code># E-commerce Website with React

## Project Overview
Built a fully functional e-commerce website to learn modern web development.

## Tech Stack
- Frontend: React, Redux, CSS Grid
- Backend: Node.js, Express
- Database: MongoDB

## Key Features
- User authentication
- Shopping cart with persistence
- Payment integration with Stripe
- Admin dashboard for product management

## Live Demo & Source
- Live Site: https://demo.example.com
- GitHub: https://github.com/username/project</code></pre>
        </div>
    '
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo htmlspecialchars($article['title']); ?> | StudentsArea</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Learn how to create an impressive portfolio as a student developer. Step-by-step guide with practical tips and examples.">
    <meta name="keywords" content="portfolio, student developer, career, web development, projects">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($article['title']); ?>">
    <meta property="og:description" content="Learn how to create an impressive portfolio as a student developer.">
    <meta property="og:image" content="<?php echo $article['featured_image']; ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($article['title']); ?>">
    <meta name="twitter:description" content="Learn how to create an impressive portfolio as a student developer.">
    <meta name="twitter:image" content="<?php echo $article['featured_image']; ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Highlight.js for code syntax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/github.min.css">
    
    <!-- Your Main CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    
    <style>
    /* ===== FIX FOR HORIZONTAL SCROLLBAR ===== */
    html, body {
        overflow-x: hidden;
        max-width: 100%;
        position: relative;
    }
    
    * {
        box-sizing: border-box;
    }
    
    .container, .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .row {
        margin-left: 0;
        margin-right: 0;
    }
    
    .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12,
    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
    .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12,
    .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12 {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* ===== READING PROGRESS BAR ===== */
    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--border-light);
        z-index: 9999;
        display: none;
    }
    
    .reading-progress-bar {
        height: 100%;
        background: var(--gold-accent);
        width: 0%;
        transition: width 0.3s ease;
    }
    
    /* ===== MAIN LAYOUT ===== */
    .article-detail-page {
        padding-top: 80px;
        background: var(--cream-bg);
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
    }
    
    .article-header {
        background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-dark) 100%);
        color: var(--text-light);
        padding: 3rem 0 5rem;
        margin-bottom: -2rem;
        position: relative;
        width: 100%;
    }
    
    /* ===== BREADCRUMB ===== */
    .article-breadcrumb {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 0.6rem 1.2rem;
        border-radius: 4px;
        display: inline-flex;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        max-width: 100%;
    }
    
    .article-breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        white-space: nowrap;
    }
    
    .article-breadcrumb a:hover {
        color: var(--text-light);
    }
    
    .article-breadcrumb .separator {
        color: rgba(255, 255, 255, 0.6);
        margin: 0 0.5rem;
    }
    
    /* ===== ARTICLE TITLE & META ===== */
    .article-title {
        font-size: 2.25rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 1.2rem;
        color: var(--text-light);
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .article-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
        max-width: 100%;
        line-height: 1.6;
    }
    
    /* ===== ARTICLE META ===== */
    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.9);
        flex-wrap: nowrap;
    }
    
    .meta-item i {
        opacity: 0.8;
        font-size: 0.9rem;
    }
    
    /* ===== TAGS ===== */
    .article-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-top: 1rem;
    }
    
    .article-tag {
        background: rgba(255, 255, 255, 0.15);
        color: var(--text-light);
        padding: 0.3rem 0.8rem;
        border-radius: 4px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
        white-space: nowrap;
    }
    
    .article-tag:hover {
        background: var(--gold-accent);
        color: var(--luxury-blue);
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    /* ===== MAIN CONTENT LAYOUT ===== */
    .article-main {
        display: block;
        margin-top: 2rem;
        position: relative;
        width: 100%;
    }
    
    @media (min-width: 992px) {
        .article-main {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 2rem;
        }
    }
    
    /* ===== ARTICLE CONTENT ===== */
    .article-content {
        background: var(--section-bg);
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        z-index: 1;
        width: 100%;
        overflow: hidden;
    }
    
    @media (min-width: 768px) {
        .article-content {
            padding: 2.5rem;
        }
    }
    
    /* ===== FEATURED IMAGE ===== */
    .article-image {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* ===== TYPOGRAPHY ===== */
    .article-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 2rem 0 1.2rem;
        color: var(--luxury-blue);
        position: relative;
        padding-bottom: 0.5rem;
        line-height: 1.4;
        word-wrap: break-word;
    }
    
    .article-content h2:before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--gold-accent);
        border-radius: 2px;
    }
    
    .article-content h3 {
        font-size: 1.4rem;
        font-weight: 600;
        margin: 1.5rem 0 1rem;
        color: var(--luxury-blue-light);
        line-height: 1.4;
    }
    
    .article-content p {
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.2rem;
        color: var(--text-dark);
        word-wrap: break-word;
    }
    
    .article-content p.lead {
        font-size: 1.15rem;
        font-weight: 500;
        color: var(--luxury-blue);
    }
    
    .article-content ul, .article-content ol {
        margin-left: 1.2rem;
        margin-bottom: 1.2rem;
        padding-left: 0.5rem;
    }
    
    .article-content li {
        margin-bottom: 0.6rem;
        font-size: 1.05rem;
        color: var(--text-dark);
        line-height: 1.6;
    }
    
    /* ===== ALERT BOX ===== */
    .alert-box {
        background: linear-gradient(135deg, var(--luxury-blue-light) 0%, var(--luxury-blue) 100%);
        color: var(--text-light);
        border-radius: 8px;
        padding: 1.2rem;
        margin: 1.5rem 0;
        border-left: 4px solid var(--gold-accent);
        word-wrap: break-word;
    }
    
    .alert-box i {
        color: var(--gold-accent);
        margin-right: 0.6rem;
        font-size: 1.1rem;
    }
    
    /* ===== INFO CARDS ===== */
    .info-card {
        background: var(--cream-bg);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 1.2rem;
        height: 100%;
        transition: all 0.3s ease;
        word-wrap: break-word;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border-color: var(--luxury-blue-light);
    }
    
    .info-card h5 {
        color: var(--luxury-blue);
        margin-bottom: 0.6rem;
        font-size: 1.1rem;
    }
    
    .info-card h5 i {
        color: var(--gold-accent);
    }
    
    /* ===== CODE BLOCK ===== */
    .code-block {
        background: #1e293b;
        border-radius: 8px;
        padding: 1.2rem;
        margin: 1.5rem 0;
        position: relative;
        overflow: hidden;
        border: 1px solid #2d3748;
        max-width: 100%;
    }
    
    .code-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        color: #94a3b8;
        font-size: 0.85rem;
        flex-wrap: wrap;
    }
    
    .btn-copy {
        background: #475569;
        color: #e2e8f0;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        white-space: nowrap;
    }
    
    .btn-copy:hover {
        background: var(--gold-accent);
        color: var(--luxury-blue);
    }
    
    pre {
        margin: 0;
        overflow-x: auto;
        padding: 0.5rem 0;
        max-width: 100%;
    }
    
    pre::-webkit-scrollbar {
        height: 6px;
    }
    
    pre::-webkit-scrollbar-track {
        background: #2d3748;
        border-radius: 3px;
    }
    
    pre::-webkit-scrollbar-thumb {
        background: var(--gold-accent);
        border-radius: 3px;
    }
    
    code {
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        color: #e2e8f0;
        word-break: break-word;
        white-space: pre-wrap;
    }
    
    /* ===== ACTION BUTTONS ===== */
    .article-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin: 1.5rem 0;
        padding: 1.5rem 0;
        border-top: 1px solid var(--border-light);
        border-bottom: 1px solid var(--border-light);
    }
    
    .btn-action {
        flex: 1;
        min-width: 140px;
        padding: 0.6rem 1.2rem;
        border-radius: 4px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.95rem;
    }
    
    .btn-like {
        background: var(--cream-bg);
        color: var(--luxury-blue);
        border: 1px solid var(--border-light);
    }
    
    .btn-like:hover {
        background: var(--luxury-blue);
        color: var(--text-light);
        text-decoration: none;
    }
    
    .btn-like.liked {
        background: var(--luxury-blue);
        color: var(--text-light);
    }
    
    .btn-share {
        background: var(--gold-accent);
        color: var(--luxury-blue);
        border: 1px solid var(--gold-accent);
    }
    
    .btn-share:hover {
        background: #8f7d5f;
        color: var(--luxury-blue);
        text-decoration: none;
    }
    
    /* ===== SIDEBAR ===== */
    .article-sidebar {
        margin-top: 2rem;
        width: 100%;
    }
    
    @media (min-width: 992px) {
        .article-sidebar {
            position: sticky;
            top: 90px;
            height: fit-content;
            margin-top: 0;
        }
    }
    
    .sidebar-card {
        background: var(--section-bg);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        width: 100%;
    }
    
    /* ===== AUTHOR CARD ===== */
    .author-card {
        text-align: center;
        padding: 1.5rem;
    }
    
    .author-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1rem;
        border: 3px solid var(--cream-bg);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .author-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--luxury-blue);
        margin-bottom: 0.25rem;
        word-wrap: break-word;
    }
    
    .author-title {
        color: var(--gold-accent);
        font-size: 0.9rem;
        margin-bottom: 0.8rem;
        font-weight: 500;
    }
    
    .author-bio {
        color: var(--text-dark);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        word-wrap: break-word;
    }
    
    .author-social {
        display: flex;
        justify-content: center;
        gap: 0.6rem;
        margin-top: 0.8rem;
    }
    
    .social-link {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--cream-bg);
        color: var(--luxury-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .social-link:hover {
        background: var(--luxury-blue);
        color: var(--text-light);
        transform: translateY(-2px);
    }
    
    /* ===== TABLE OF CONTENTS ===== */
    .toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .toc-item {
        padding: 0.6rem 0;
        border-bottom: 1px solid var(--border-light);
    }
    
    .toc-item:last-child {
        border-bottom: none;
    }
    
    .toc-item a {
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
        word-wrap: break-word;
    }
    
    .toc-item a:hover {
        color: var(--luxury-blue);
        padding-left: 0.4rem;
    }
    
    .toc-item a:before {
        content: '#';
        color: var(--gold-accent);
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    /* ===== ARTICLE STATS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
        text-align: center;
    }
    
    .stat-item {
        padding: 0.8rem 0.4rem;
    }
    
    .stat-number {
        display: block;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--luxury-blue);
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.2rem;
    }
    
    /* ===== RELATED ARTICLES ===== */
    .related-articles {
        margin-top: 3rem;
        width: 100%;
        overflow: hidden;
    }
    
    .section-title {
        font-size: 1.75rem;
        color: var(--luxury-blue);
        margin-bottom: 1.5rem;
        font-weight: 700;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.2rem;
        width: 100%;
    }
    
    @media (min-width: 576px) {
        .related-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (min-width: 992px) {
        .related-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    .related-card {
        background: var(--section-bg);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        text-decoration: none;
        height: 100%;
        width: 100%;
    }
    
    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        border-color: var(--luxury-blue-light);
    }
    
    .related-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    
    .related-content {
        padding: 1.2rem;
    }
    
    .related-category {
        color: var(--gold-accent);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.6rem;
        display: block;
    }
    
    .related-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--luxury-blue);
        line-height: 1.4;
        margin-bottom: 0.6rem;
        word-wrap: break-word;
    }
    
    .related-meta {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: #666;
        font-size: 0.8rem;
    }
    
    /* ===== NEWSLETTER ===== */
    .newsletter-card {
        background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-light) 100%);
        color: var(--text-light);
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        width: 100%;
    }
    
    .newsletter-title {
        font-size: 1.3rem;
        margin-bottom: 0.8rem;
        color: var(--text-light);
        font-weight: 600;
    }
    
    .newsletter-desc {
        opacity: 0.9;
        margin-bottom: 1.2rem;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    /* ===== SHARE BUTTONS ===== */
    .share-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .share-btn {
        flex: 1;
        min-width: 80px;
        padding: 0.5rem;
        border-radius: 4px;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid var(--border-light);
        background: var(--cream-bg);
        color: var(--luxury-blue);
    }
    
    .share-btn:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    .share-twitter:hover {
        background: #1da1f2;
        color: white;
        border-color: #1da1f2;
    }
    
    .share-linkedin:hover {
        background: #0077b5;
        color: white;
        border-color: #0077b5;
    }
    
    .share-facebook:hover {
        background: #1877f2;
        color: white;
        border-color: #1877f2;
    }
    
    /* ===== RESPONSIVE FIXES ===== */
    @media (max-width: 1199px) {
        .container {
            max-width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
    }
    
    @media (max-width: 991px) {
        .article-header {
            padding: 2rem 0 4rem;
        }
        
        .article-title {
            font-size: 2rem;
        }
        
        .article-content {
            padding: 1.5rem;
        }
        
        .article-image {
            max-height: 300px;
        }
        
        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.8rem;
        }
        
        .meta-item {
            width: 100%;
            justify-content: flex-start;
        }
    }
    
    @media (max-width: 767px) {
        .article-detail-page {
            padding-top: 70px;
        }
        
        .article-header {
            padding: 1.5rem 0 3rem;
        }
        
        .article-title {
            font-size: 1.75rem;
        }
        
        .article-subtitle {
            font-size: 1rem;
        }
        
        .article-breadcrumb {
            font-size: 0.85rem;
            padding: 0.5rem 0.8rem;
        }
        
        .article-content h2 {
            font-size: 1.5rem;
        }
        
        .article-content h3 {
            font-size: 1.25rem;
        }
        
        .article-content p {
            font-size: 1rem;
        }
        
        .btn-action {
            min-width: 100%;
        }
        
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }
        
        .stat-number {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 575px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .article-title {
            font-size: 1.5rem;
        }
        
        .article-content {
            padding: 1.2rem;
        }
        
        .article-content h2 {
            font-size: 1.3rem;
        }
        
        .article-content h3 {
            font-size: 1.1rem;
        }
        
        .article-tags {
            gap: 0.3rem;
        }
        
        .article-tag {
            padding: 0.25rem 0.6rem;
            font-size: 0.75rem;
        }
        
        .sidebar-card {
            padding: 1.2rem;
        }
        
        .author-avatar {
            width: 70px;
            height: 70px;
        }
        
        .author-name {
            font-size: 1rem;
        }
        
        .author-title {
            font-size: 0.85rem;
        }
        
        .author-bio {
            font-size: 0.85rem;
        }
        
        .related-grid {
            grid-template-columns: 1fr;
        }
        
        .share-btn {
            min-width: 70px;
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 375px) {
        .article-title {
            font-size: 1.35rem;
        }
        
        .article-meta {
            font-size: 0.85rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    /* ===== FIX FOR CODE BLOCKS ===== */
    .code-block pre {
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .code-block code {
        white-space: pre;
        word-break: normal;
        word-wrap: normal;
    }
    
    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .article-content > * {
        animation: fadeInUp 0.4s ease forwards;
    }
    
    /* ===== UTILITY CLASSES ===== */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .text-truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    
    /* ===== FIX FOR BOOTSTRAP OVERFLOW ===== */
    .row.g-3, .row.g-4 {
        margin-left: -7.5px;
        margin-right: -7.5px;
    }
    
    .row.g-3 > [class*="col-"], .row.g-4 > [class*="col-"] {
        padding-left: 7.5px;
        padding-right: 7.5px;
    }
    </style>
</head>
<body>
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress">
        <div class="reading-progress-bar" id="readingProgressBar"></div>
    </div>
    
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Article Header -->
    <header class="article-header">
        <div class="container">
            <!-- Breadcrumb -->
            <nav class="article-breadcrumb">
                <a href="index.php">Home</a>
                <span class="separator">/</span>
                <a href="articles.php">Articles</a>
                <span class="separator">/</span>
                <a href="articles.php?category=<?php echo strtolower($article['category']); ?>">
                    <?php echo $article['category']; ?>
                </a>
                <span class="separator">/</span>
                <span><?php echo htmlspecialchars(substr($article['title'], 0, 30)) . '...'; ?></span>
            </nav>
            
            <!-- Article Title -->
            <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
            
            <!-- Article Meta -->
            <div class="article-meta">
                <div class="meta-item">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($article['author']); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span><?php echo $article['date']; ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span><?php echo $article['read_time']; ?> min read</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-eye"></i>
                    <span><?php echo number_format($article['views']); ?> views</span>
                </div>
            </div>
            
            <!-- Tags -->
            <div class="article-tags">
                <?php foreach ($article['tags'] as $tag): ?>
                    <a href="articles.php?tag=<?php echo urlencode(strtolower($tag)); ?>" class="article-tag">
                        <?php echo htmlspecialchars($tag); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="container article-detail-page">
        <div class="article-main">
            <!-- Article Content -->
            <article class="article-content">
                <!-- Featured Image -->
                <img src="<?php echo $article['featured_image']; ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="article-image img-fluid">
                
                <!-- Article Content -->
                <?php echo $article['content']; ?>
                
                <!-- Action Buttons -->
                <div class="article-actions">
                    <a href="#" class="btn-action btn-like" id="likeButton">
                        <i class="far fa-heart"></i>
                        <span>Like Article (<?php echo $article['likes']; ?>)</span>
                    </a>
                    <a href="#" class="btn-action btn-share" onclick="showShareModal()">
                        <i class="fas fa-share-alt"></i>
                        <span>Share Article</span>
                    </a>
                </div>
                
                <!-- Newsletter -->
                <div class="newsletter-card">
                    <h3 class="newsletter-title">Enjoying this article?</h3>
                    <p class="newsletter-desc">Subscribe to our newsletter for weekly tech insights, tutorials, and career tips.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Your email address">
                        <button class="btn-secondary" type="button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <small style="opacity: 0.7; font-size: 0.85rem;">No spam. Unsubscribe anytime.</small>
                </div>
            </article>
            
            <!-- Sidebar -->
            <aside class="article-sidebar">
                <!-- Author Card -->
                <div class="sidebar-card author-card">
                    <img src="<?php echo $article['author_avatar']; ?>" alt="<?php echo htmlspecialchars($article['author']); ?>" class="author-avatar">
                    <h4 class="author-name"><?php echo htmlspecialchars($article['author']); ?></h4>
                    <p class="author-title"><?php echo $article['author_title']; ?></p>
                    <p class="author-bio"><?php echo $article['author_bio']; ?></p>
                    <div class="author-social">
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Table of Contents -->
                <div class="sidebar-card">
                    <h5 style="color: var(--luxury-blue); margin-bottom: 1rem; font-size: 1.1rem;">
                        <i class="fas fa-list me-2"></i>Table of Contents
                    </h5>
                    <ul class="toc-list">
                        <li class="toc-item">
                            <a href="#why-portfolio-matters">Why a Portfolio Matters</a>
                        </li>
                        <li class="toc-item">
                            <a href="#choosing-projects">Choosing Projects Wisely</a>
                        </li>
                        <li class="toc-item">
                            <a href="#documenting-projects">Documenting Projects</a>
                        </li>
                        <li class="toc-item">
                            <a href="#common-mistakes">Common Mistakes to Avoid</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Article Stats -->
                <div class="sidebar-card">
                    <h5 style="color: var(--luxury-blue); margin-bottom: 1rem; font-size: 1.1rem;">
                        <i class="fas fa-chart-bar me-2"></i>Article Stats
                    </h5>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number"><?php echo number_format($article['views']); ?></span>
                            <span class="stat-label">Views</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo number_format($article['likes']); ?></span>
                            <span class="stat-label">Likes</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo number_format($article['comments']); ?></span>
                            <span class="stat-label">Comments</span>
                        </div>
                    </div>
                </div>
                
                <!-- Share Card -->
                <div class="sidebar-card">
                    <h5 style="color: var(--luxury-blue); margin-bottom: 1rem; font-size: 1.1rem;">
                        <i class="fas fa-share-alt me-2"></i>Share Article
                    </h5>
                    <div class="share-buttons">
                        <a href="#" class="share-btn share-twitter" onclick="shareArticle('twitter')">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="#" class="share-btn share-linkedin" onclick="shareArticle('linkedin')">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="#" class="share-btn share-facebook" onclick="shareArticle('facebook')">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="#" class="share-btn" onclick="copyArticleUrl()">
                            <i class="fas fa-link"></i> Copy Link
                        </a>
                    </div>
                </div>
            </aside>
        </div>
        
        <!-- Related Articles -->
        <section class="related-articles">
            <h3 class="section-title">Related Articles</h3>
            <div class="related-grid">
                <a href="article-detail.php?id=2" class="related-card">
                    <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?ixlib=rb-4.0.3&w=400&h=200&fit=crop&q=80" class="related-image img-fluid" alt="React Projects">
                    <div class="related-content">
                        <span class="related-category">Web Development</span>
                        <h4 class="related-title text-truncate-2">10 React Projects Every Beginner Should Try</h4>
                        <div class="related-meta">
                            <span><i class="far fa-clock me-1"></i>12 min</span>
                            <span><i class="far fa-eye me-1"></i>980</span>
                        </div>
                    </div>
                </a>
                
                <a href="article-detail.php?id=3" class="related-card">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&w=400&h=200&fit=crop&q=80" class="related-image img-fluid" alt="Freelancing Guide">
                    <div class="related-content">
                        <span class="related-category">Career</span>
                        <h4 class="related-title text-truncate-2">Freelancing Guide for Students: Earn While You Learn</h4>
                        <div class="related-meta">
                            <span><i class="far fa-clock me-1"></i>15 min</span>
                            <span><i class="far fa-eye me-1"></i>1.5K</span>
                        </div>
                    </div>
                </a>
                
                <a href="article-detail.php?id=4" class="related-card">
                    <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&w=400&h=200&fit=crop&q=80" class="related-image img-fluid" alt="Machine Learning">
                    <div class="related-content">
                        <span class="related-category">Data Science</span>
                        <h4 class="related-title text-truncate-2">Machine Learning Roadmap for 2024</h4>
                        <div class="related-meta">
                            <span><i class="far fa-clock me-1"></i>20 min</span>
                            <span><i class="far fa-eye me-1"></i>2.3K</span>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </main>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Highlight.js for code syntax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    
    <script>
    // Initialize syntax highlighting
    document.addEventListener('DOMContentLoaded', function() {
        hljs.highlightAll();
        
        // Show progress bar on scroll
        window.addEventListener('scroll', updateProgressBar);
        
        // Initialize like button
        initLikeButton();
        
        // Show progress bar after scrolling down a bit
        window.addEventListener('scroll', function() {
            const progressBar = document.getElementById('readingProgress');
            if (window.scrollY > 100) {
                progressBar.style.display = 'block';
            } else {
                progressBar.style.display = 'none';
            }
        });
        
        // Fix for anchor links with IDs
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    });
    
    // Reading progress bar
    function updateProgressBar() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById("readingProgressBar").style.width = scrolled + "%";
    }
    
    // Like functionality
    function initLikeButton() {
        const likeBtn = document.getElementById('likeButton');
        if (!likeBtn) return;
        
        const likeIcon = likeBtn.querySelector('i');
        const likeText = likeBtn.querySelector('span');
        let liked = localStorage.getItem('article_<?php echo $articleId; ?>_liked') === 'true';
        
        if (liked) {
            likeBtn.classList.add('liked');
            likeIcon.classList.remove('far');
            likeIcon.classList.add('fas');
        }
        
        likeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (liked) {
                // Unlike
                likeBtn.classList.remove('liked');
                likeIcon.classList.remove('fas');
                likeIcon.classList.add('far');
                likeText.textContent = `Like Article (${<?php echo $article['likes']; ?>})`;
                localStorage.removeItem('article_<?php echo $articleId; ?>_liked');
                liked = false;
                showNotification('Article unliked', 'info');
            } else {
                // Like
                likeBtn.classList.add('liked');
                likeIcon.classList.remove('far');
                likeIcon.classList.add('fas');
                likeText.textContent = `Liked (${<?php echo $article['likes'] + 1; ?>})`;
                localStorage.setItem('article_<?php echo $articleId; ?>_liked', 'true');
                liked = true;
                showNotification('Article liked!', 'success');
            }
        });
    }
    
    // Share functionality
    function shareArticle(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('<?php echo addslashes($article['title']); ?>');
        const text = encodeURIComponent('Check out this article: <?php echo addslashes($article['title']); ?>');
        
        let shareUrl;
        switch(platform) {
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                break;
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                break;
            default:
                return;
        }
        
        window.open(shareUrl, '_blank', 'width=600,height=400');
        showNotification('Shared successfully!', 'success');
    }
    
    // Copy URL to clipboard
    function copyArticleUrl() {
        navigator.clipboard.writeText(window.location.href)
            .then(() => showNotification('Link copied to clipboard!', 'success'))
            .catch(() => showNotification('Failed to copy link', 'error'));
    }
    
    // Copy code to clipboard
    function copyCode(button) {
        const codeBlock = button.closest('.code-block').querySelector('code');
        const codeText = codeBlock.textContent;
        
        navigator.clipboard.writeText(codeText)
            .then(() => {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> Copied!';
                button.style.background = 'var(--gold-accent)';
                button.style.color = 'var(--luxury-blue)';
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.background = '';
                    button.style.color = '';
                }, 2000);
                showNotification('Code copied to clipboard!', 'success');
            })
            .catch(() => showNotification('Failed to copy code', 'error'));
    }
    
    // Show share modal
    function showShareModal() {
        const modalHTML = `
            <div class="modal fade" id="shareModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Share Article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="share-buttons mb-4">
                                <a href="#" class="share-btn share-twitter" onclick="shareArticle('twitter')">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="#" class="share-btn share-linkedin" onclick="shareArticle('linkedin')">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                                <a href="#" class="share-btn share-facebook" onclick="shareArticle('facebook')">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" value="${window.location.href}" readonly id="shareUrlInput">
                                <button class="btn-primary" onclick="copyArticleUrl()" id="copyUrlBtn">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing modal
        const existingModal = document.getElementById('shareModal');
        if (existingModal) existingModal.remove();
        
        // Add new modal
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        const modal = new bootstrap.Modal(document.getElementById('shareModal'));
        modal.show();
    }
    
    // Notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.querySelector('.custom-notification');
        if (existing) existing.remove();
        
        const container = document.createElement('div');
        container.className = `position-fixed top-3 end-3 alert alert-${type} alert-dismissible fade show custom-notification`;
        container.style.zIndex = '9999';
        container.style.maxWidth = '350px';
        container.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(container);
        
        setTimeout(() => {
            if (container.parentNode) {
                container.remove();
            }
        }, 3000);
    }
    
    // Fix for iOS Safari 100vh issue
    function setVH() {
        let vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    
    window.addEventListener('resize', setVH);
    setVH();
    
    // Prevent horizontal scroll on touch devices
    document.addEventListener('touchmove', function(e) {
        if (e.touches.length > 1) {
            e.preventDefault();
        }
    }, { passive: false });
    
    // Fix for iOS viewport height
    window.addEventListener('orientationchange', function() {
        setTimeout(setVH, 100);
    });
    </script>
</body>
</html>