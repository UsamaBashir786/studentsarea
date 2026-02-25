<!-- Jobs Sidebar Filters -->
<div class="jobs-sidebar">
    <!-- Search Box -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Search Jobs</h6>
        <div class="input-group">
            <input type="text" class="form-control" id="jobSearch" placeholder="Job title, skills, company...">
            <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Categories Filter -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Job Categories</h6>
        <div class="filter-group">
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="web_development" id="catWebDev">
                <label class="form-check-label" for="catWebDev">
                    Web Development
                </label>
                <span class="badge bg-light text-dark float-end">120</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="design" id="catDesign">
                <label class="form-check-label" for="catDesign">
                    UI/UX Design
                </label>
                <span class="badge bg-light text-dark float-end">85</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="writing" id="catWriting">
                <label class="form-check-label" for="catWriting">
                    Content Writing
                </label>
                <span class="badge bg-light text-dark float-end">65</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="marketing" id="catMarketing">
                <label class="form-check-label" for="catMarketing">
                    Digital Marketing
                </label>
                <span class="badge bg-light text-dark float-end">42</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="data" id="catData">
                <label class="form-check-label" for="catData">
                    Data Analysis
                </label>
                <span class="badge bg-light text-dark float-end">38</span>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="category" value="support" id="catSupport">
                <label class="form-check-label" for="catSupport">
                    Customer Support
                </label>
                <span class="badge bg-light text-dark float-end">55</span>
            </div>
        </div>
    </div>
    
    <!-- Job Type Filter -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Job Type</h6>
        <select class="form-select filter-option filter-select" data-filter="job_type" id="jobType">
            <option value="">All Types</option>
            <option value="part_time">Part Time</option>
            <option value="full_time">Full Time</option>
            <option value="contract">Contract</option>
            <option value="freelance">Freelance</option>
            <option value="internship">Internship</option>
        </select>
    </div>
    
    <!-- Experience Level -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Experience Level</h6>
        <select class="form-select filter-option filter-select" data-filter="experience" id="experienceLevel">
            <option value="">Any Experience</option>
            <option value="student">Student (No Experience)</option>
            <option value="entry">Entry Level (0-1 years)</option>
            <option value="junior">Junior (1-2 years)</option>
            <option value="mid">Mid Level (2-4 years)</option>
        </select>
    </div>
    
    <!-- Salary Range -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Hourly Rate</h6>
        <select class="form-select filter-option filter-select" data-filter="salary_range" id="salaryRange">
            <option value="">Any Rate</option>
            <option value="0-10">Under $10/hr</option>
            <option value="10-15">$10 - $15/hr</option>
            <option value="15-20">$15 - $20/hr</option>
            <option value="20-25">$20 - $25/hr</option>
            <option value="25+">$25+/hr</option>
        </select>
    </div>
    
    <!-- Remote Type -->
    <div class="sidebar-card mb-4">
        <h6 class="sidebar-title">Remote Type</h6>
        <div class="filter-group">
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="remote_type" value="fully_remote" id="fullyRemote">
                <label class="form-check-label" for="fullyRemote">
                    Fully Remote
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="remote_type" value="hybrid" id="hybrid">
                <label class="form-check-label" for="hybrid">
                    Hybrid
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input filter-option" type="checkbox" 
                       data-filter="remote_type" value="flexible" id="flexible">
                <label class="form-check-label" for="flexible">
                    Flexible Hours
                </label>
            </div>
        </div>
    </div>
    
    <!-- Clear Filters Button -->
    <div class="sidebar-card">
        <button class="btn btn-outline-primary w-100" id="clearFilters">
            <i class="fas fa-times me-2"></i>Clear All Filters
        </button>
    </div>
    
    <!-- Post Job CTA -->
    <div class="sidebar-card mt-4" style="background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-dark) 100%); color: white; padding: 1.5rem; border-radius: 10px;">
        <h6 class="mb-3" style="color: white;">Hiring Students?</h6>
        <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 1.5rem;">
            Post your remote job and reach 15,000+ student candidates.
        </p>
        <a href="apply-company.php" class="btn-secondary w-100">
            <i class="fas fa-briefcase me-2"></i>Post a Job
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