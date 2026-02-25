<!-- Projects Sidebar Filters -->
<div class="projects-sidebar">
    <!-- Search Box -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Search Projects</h6>
        <div class="input-group">
            <input type="text" class="form-control" id="projectSearch" placeholder="Project name, technology, tags...">
            <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Price Type Filter -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Price Type</h6>
        <div class="filter-group">
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="price_type" value="free" id="priceFree">
                <label class="form-check-label" for="priceFree">
                    Free Projects
                </label>
                <span class="badge bg-light text-dark float-end">350</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="price_type" value="premium" id="pricePremium">
                <label class="form-check-label" for="pricePremium">
                    Premium Projects
                </label>
                <span class="badge bg-light text-dark float-end">150</span>
            </div>
        </div>
    </div>
    
    <!-- Categories Filter -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Project Categories</h6>
        <select class="form-select filter-option filter-select" data-filter="category" id="projectCategory">
            <option value="">All Categories</option>
            <option value="web_development">Web Development</option>
            <option value="mobile_apps">Mobile Apps</option>
            <option value="ui_ux_design">UI/UX Design</option>
            <option value="data_science">Data Science</option>
            <option value="machine_learning">Machine Learning</option>
            <option value="game_development">Game Development</option>
            <option value="iot">IoT Projects</option>
            <option value="blockchain">Blockchain</option>
            <option value="cybersecurity">Cybersecurity</option>
            <option value="final_year">Final Year Projects</option>
        </select>
    </div>
    
    <!-- Difficulty Level -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Difficulty Level</h6>
        <div class="filter-group">
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="difficulty" value="beginner" id="diffBeginner">
                <label class="form-check-label" for="diffBeginner">
                    Beginner
                </label>
                <span class="badge bg-light text-dark float-end">180</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="difficulty" value="intermediate" id="diffIntermediate">
                <label class="form-check-label" for="diffIntermediate">
                    Intermediate
                </label>
                <span class="badge bg-light text-dark float-end">210</span>
            </div>
            <div class="form-check">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="difficulty" value="advanced" id="diffAdvanced">
                <label class="form-check-label" for="diffAdvanced">
                    Advanced
                </label>
                <span class="badge bg-light text-dark float-end">110</span>
            </div>
        </div>
    </div>
    
    <!-- Project Duration -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Time Required</h6>
        <select class="form-select filter-option filter-select" data-filter="duration" id="projectDuration">
            <option value="">Any Duration</option>
            <option value="1-3">1-3 hours</option>
            <option value="4-8">4-8 hours</option>
            <option value="1-3_days">1-3 days</option>
            <option value="1_week">1 week</option>
            <option value="2_weeks">2 weeks</option>
            <option value="1_month">1 month+</option>
        </select>
    </div>
    
    <!-- Programming Languages -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Programming Languages</h6>
        <select class="form-select filter-option filter-select" data-filter="language" id="projectLanguage">
            <option value="">All Languages</option>
            <option value="html_css">HTML/CSS</option>
            <option value="javascript">JavaScript</option>
            <option value="python">Python</option>
            <option value="java">Java</option>
            <option value="php">PHP</option>
            <option value="csharp">C#</option>
            <option value="cpp">C++</option>
            <option value="react">React</option>
            <option value="nodejs">Node.js</option>
            <option value="flutter">Flutter</option>
        </select>
    </div>
    
    <!-- Clear Filters Button -->
    <div class="sidebar-card">
        <button class="btn btn-outline-primary w-100" id="clearFilters">
            <i class="fas fa-times me-2"></i>Clear All Filters
        </button>
    </div>
    
    <!-- Sell Project CTA -->
    <div class="sidebar-card mt-4" style="background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-dark) 100%); color: white; padding: 1.5rem; border-radius: 10px;">
        <h6 class="mb-3" style="color: white;">Have a Project?</h6>
        <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 1.5rem;">
            Sell your projects to 15,000+ students and earn money.
        </p>
        <a href="sell-projects.php" class="btn-secondary w-100">
            <i class="fas fa-upload me-2"></i>Sell Your Project
        </a>
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

.btn-outline-secondary {
    border-color: #dee2e6;
}

.btn-outline-secondary:hover {
    background-color: var(--luxury-blue-light);
    border-color: var(--luxury-blue-light);
}
</style>