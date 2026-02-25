<?php
// ajax/get_article_detail.php

$articleId = $_GET['article_id'] ?? 1;

// Sample article content (replace with database)
$articles = [
    1 => [
        'title' => 'How to Build a Portfolio as a Student Developer',
        'author' => 'John Doe',
        'date' => 'January 15, 2024',
        'read_time' => '8 min read',
        'views' => '1,250',
        'category' => 'Career',
        'content' => '
            <div class="article-detail">
                <div class="article-header mb-5">
                    <h1 class="display-4 mb-4">How to Build a Portfolio as a Student Developer</h1>
                    <div class="article-meta d-flex align-items-center gap-4 mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe" class="rounded-circle" width="40">
                            <div>
                                <h6 class="mb-0">John Doe</h6>
                                <small class="text-muted">Senior Developer</small>
                            </div>
                        </div>
                        <div class="text-muted">
                            <i class="far fa-calendar me-1"></i> January 15, 2024
                        </div>
                        <div class="text-muted">
                            <i class="far fa-clock me-1"></i> 8 min read
                        </div>
                        <div class="text-muted">
                            <i class="far fa-eye me-1"></i> 1,250 views
                        </div>
                    </div>
                    <div class="badge bg-primary mb-4">Career</div>
                </div>
                
                <div class="article-image mb-5">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                         class="img-fluid rounded" alt="Student Developer Portfolio">
                </div>
                
                <div class="article-content">
                    <p class="lead mb-4">Building a portfolio as a student developer can be challenging when you have limited professional experience. However, with the right approach, you can create an impressive portfolio that showcases your skills and potential.</p>
                    
                    <h3 class="mb-3">Why a Portfolio Matters</h3>
                    <p>In today\'s competitive job market, a portfolio is more important than a resume for developers. It shows what you can actually do, not just what you claim to know. For students, it demonstrates initiative, learning ability, and practical skills.</p>
                    
                    <h3 class="mb-3 mt-5">Step 1: Choose Your Projects Wisely</h3>
                    <p>As a student, you might not have professional projects. That\'s okay! Focus on:</p>
                    <ul>
                        <li><strong>Course projects:</strong> Even class assignments can be portfolio-worthy if polished</li>
                        <li><strong>Personal projects:</strong> Build something you\'re passionate about</li>
                        <li><strong>Open source contributions:</strong> Contribute to projects on GitHub</li>
                        <li><strong>Hackathon projects:</strong> These show you can work under pressure</li>
                    </ul>
                    
                    <h3 class="mb-3 mt-5">Step 2: Document Your Projects</h3>
                    <p>For each project in your portfolio, include:</p>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light p-3 h-100">
                                <h5>Project Description</h5>
                                <p>Explain what the project does, why you built it, and what problems it solves.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light p-3 h-100">
                                <h5>Technologies Used</h5>
                                <p>List all technologies, frameworks, and tools used in the project.</p>
                            </div>
                        </div>
                    </div>
                    
                    <h3 class="mb-3 mt-5">Step 3: Showcase Your Code</h3>
                    <p>Make sure your GitHub profile is clean and organized:</p>
                    <pre><code class="language-javascript">
// Example: Clean, well-documented code
function calculateTotal(items) {
    return items.reduce((total, item) => total + item.price, 0);
}

// Add comments explaining complex logic
function processUserInput(input) {
    // Validate input before processing
    if (!input || input.trim() === \'\') {
        throw new Error(\'Input cannot be empty\');
    }
    // Process the input...
    return input.toLowerCase();
}
                    </code></pre>
                    
                    <h3 class="mb-3 mt-5">Step 4: Create a Personal Website</h3>
                    <p>Your portfolio should live on a personal website. Use platforms like:</p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-primary p-2">GitHub Pages</span>
                        <span class="badge bg-primary p-2">Vercel</span>
                        <span class="badge bg-primary p-2">Netlify</span>
                        <span class="badge bg-primary p-2">Custom Domain</span>
                    </div>
                    
                    <h3 class="mb-3 mt-5">Key Tips for Success</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6>Quality Over Quantity</h6>
                                    <p class="text-muted">3-5 excellent projects are better than 10 mediocre ones.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6>Keep It Updated</h6>
                                    <p class="text-muted">Regularly add new projects and remove outdated ones.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6>Include Readme Files</h6>
                                    <p class="text-muted">Every GitHub repository should have a detailed README.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                <div>
                                    <h6>Get Feedback</h6>
                                    <p class="text-muted">Ask peers and mentors to review your portfolio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-5">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Pro Tip:</strong> Include projects that demonstrate different skills - one for frontend, one for backend, one with databases, etc.
                    </div>
                    
                    <div class="article-footer mt-5 pt-5 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Tags</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark p-2">Portfolio</span>
                                    <span class="badge bg-light text-dark p-2">Career</span>
                                    <span class="badge bg-light text-dark p-2">Students</span>
                                    <span class="badge bg-light text-dark p-2">Development</span>
                                    <span class="badge bg-light text-dark p-2">GitHub</span>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h5 class="mb-3">Share This Article</h5>
                                <div class="d-flex gap-2 justify-content-md-end">
                                    <button class="btn btn-outline-primary">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </button>
                                    <button class="btn btn-outline-primary">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </button>
                                    <button class="btn btn-outline-primary">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        '
    ]
];

// Return article content
if (isset($articles[$articleId])) {
    echo $articles[$articleId]['content'];
} else {
    echo '
    <div class="text-center p-5">
        <i class="fas fa-exclamation-triangle fa-3x mb-3 text-danger"></i>
        <h4>Article Not Found</h4>
        <p>The requested article could not be found.</p>
    </div>';
}
?>

<style>
.article-detail {
    padding: 2rem;
}

.article-header {
    border-bottom: 2px solid #f0f2f5;
    padding-bottom: 2rem;
}

.article-meta {
    flex-wrap: wrap;
}

.article-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.article-content h3 {
    color: var(--luxury-blue);
    margin-top: 2rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e9ecef;
}

.article-content p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
    margin-bottom: 1.5rem;
}

.article-content ul {
    padding-left: 1.5rem;
    margin-bottom: 1.5rem;
}

.article-content ul li {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

pre {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1.5rem 0;
    border-left: 4px solid var(--luxury-blue);
}

code {
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .article-detail {
        padding: 1rem;
    }
    
    .article-image img {
        height: 250px;
    }
}
</style>