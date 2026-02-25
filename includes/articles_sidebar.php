<!-- Articles Sidebar Filters -->
<div class="articles-sidebar">
    <!-- Search Box -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Search Articles</h6>
        <div class="input-group">
            <input type="text" class="form-control" id="articleSearch" placeholder="Search articles, topics...">
            <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Categories Filter -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Categories</h6>
        <div class="filter-group">
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="web_development" id="catWebDev">
                <label class="form-check-label" for="catWebDev">
                    Web Development
                </label>
                <span class="badge bg-light text-dark float-end">45</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="programming" id="catProgramming">
                <label class="form-check-label" for="catProgramming">
                    Programming
                </label>
                <span class="badge bg-light text-dark float-end">32</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="design" id="catDesign">
                <label class="form-check-label" for="catDesign">
                    UI/UX Design
                </label>
                <span class="badge bg-light text-dark float-end">28</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="career" id="catCareer">
                <label class="form-check-label" for="catCareer">
                    Career Advice
                </label>
                <span class="badge bg-light text-dark float-end">25</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="freelancing" id="catFreelancing">
                <label class="form-check-label" for="catFreelancing">
                    Freelancing
                </label>
                <span class="badge bg-light text-dark float-end">18</span>
            </div>
            <div class="form-check">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="productivity" id="catProductivity">
                <label class="form-check-label" for="catProductivity">
                    Productivity
                </label>
                <span class="badge bg-light text-dark float-end">22</span>
            </div>
        </div>
    </div>
    
    <!-- Popular Tags -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Popular Tags</h6>
        <div class="tags-cloud">
            <a href="#" class="tag" data-tag="javascript">JavaScript</a>
            <a href="#" class="tag" data-tag="react">React</a>
            <a href="#" class="tag" data-tag="python">Python</a>
            <a href="#" class="tag" data-tag="css">CSS</a>
            <a href="#" class="tag" data-tag="nodejs">Node.js</a>
            <a href="#" class="tag" data-tag="beginners">Beginners</a>
            <a href="#" class="tag" data-tag="tutorial">Tutorial</a>
            <a href="#" class="tag" data-tag="tips">Tips</a>
            <a href="#" class="tag" data-tag="interview">Interview</a>
            <a href="#" class="tag" data-tag="resume">Resume</a>
        </div>
    </div>
    
    <!-- Difficulty Level -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Difficulty Level</h6>
        <select class="form-select filter-option filter-select" data-filter="difficulty" id="difficultyLevel">
            <option value="">All Levels</option>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select>
    </div>
    
    <!-- Reading Time -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Reading Time</h6>
        <select class="form-select filter-option filter-select" data-filter="reading_time" id="readingTime">
            <option value="">Any Time</option>
            <option value="1-5">1-5 minutes</option>
            <option value="6-10">6-10 minutes</option>
            <option value="11-15">11-15 minutes</option>
            <option value="16+">16+ minutes</option>
        </select>
    </div>
    
    <!-- Popular Articles -->
    <div class="popular-articles">
        <h6 class="sidebar-title mb-3">Popular This Week</h6>
        <ul class="popular-list">
            <li class="popular-item">
                <span class="popular-rank">1</span>
                <h6 class="popular-title">How to Build a Portfolio as a Student</h6>
            </li>
            <li class="popular-item">
                <span class="popular-rank">2</span>
                <h6 class="popular-title">10 React Projects for Beginners</h6>
            </li>
            <li class="popular-item">
                <span class="popular-rank">3</span>
                <h6 class="popular-title">Freelancing Tips for Students</h6>
            </li>
            <li class="popular-item">
                <span class="popular-rank">4</span>
                <h6 class="popular-title">Machine Learning Roadmap 2024</h6>
            </li>
            <li class="popular-item">
                <span class="popular-rank">5</span>
                <h6 class="popular-title">CSS Grid vs Flexbox Guide</h6>
            </li>
        </ul>
    </div>
    
    <!-- Newsletter -->
    <div class="newsletter-card">
        <h6 class="mb-3" style="color: white;">Subscribe to Newsletter</h6>
        <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 1.5rem;">
            Get weekly articles, tutorials, and career tips.
        </p>
        <div class="input-group mb-3">
            <input type="email" class="form-control" id="newsletterEmail" placeholder="Your email">
            <button class="btn-secondary" type="button" id="subscribeBtn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        <p style="font-size: 0.8rem; opacity: 0.7; margin: 0;">
            No spam. Unsubscribe anytime.
        </p>
    </div>
    
    <!-- Clear Filters Button -->
    <div class="sidebar-card mt-4">
        <button class="btn btn-outline-primary w-100" id="clearFilters">
            <i class="fas fa-times me-2"></i>Clear All Filters
        </button>
    </div>
</div>

<style>
/* Sidebar Styles */
.sidebar-card {
    background: white;
    padding: 1.25rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 1rem;
}

.sidebar-title {
    color: var(--luxury-blue);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #eee;
}

.filter-group {
    max-height: 300px;
    overflow-y: auto;
    padding-right: 5px;
}

.filter-group::-webkit-scrollbar {
    width: 5px;
}

.filter-group::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.filter-group::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

.filter-group::-webkit-scrollbar-thumb:hover {
    background: #aaa;
}

.form-check {
    display: flex;
    align-items: center;
    padding-left: 0;
}

.form-check-input {
    margin-top: 0;
    margin-right: 10px;
    cursor: pointer;
}

.form-check-label {
    flex: 1;
    cursor: pointer;
    font-size: 0.9rem;
}

.form-select {
    font-size: 0.9rem;
    cursor: pointer;
}

/* Tags Cloud */
.tags-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    background: rgba(163, 146, 116, 0.1);
    color: var(--luxury-blue);
    border-radius: 20px;
    font-size: 0.85rem;
    text-decoration: none;
    border: 1px solid rgba(163, 146, 116, 0.2);
    transition: all 0.3s ease;
}

.tag:hover {
    background: var(--gold-accent);
    color: var(--luxury-blue);
    transform: translateY(-2px);
}

/* Popular Articles */
.popular-articles {
    background: white;
    border-radius: 10px;
    padding: 1.25rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.popular-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.popular-item {
    padding: 0.8rem 0;
    border-bottom: 1px solid #e9ecef;
    transition: all 0.3s ease;
    cursor: pointer;
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
}

.newsletter-card .form-control {
    border: none;
    padding: 0.75rem;
}

.newsletter-card .btn-secondary {
    border: none;
    padding: 0.75rem 1.25rem;
}
</style>