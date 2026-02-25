<!-- includes/job_card.php -->
<div class="job-card-component" style="display: none;">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-md-8">
                    <div class="d-flex align-items-start mb-3">
                        <div class="company-logo me-3">
                            <div class="logo-placeholder">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="color: var(--luxury-blue);">{JOB_TITLE}</h5>
                            <p class="text-muted mb-2"><i class="fas fa-building me-1"></i>{COMPANY_NAME}</p>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-{JOB_TYPE_COLOR}">{JOB_TYPE}</span>
                                <span class="badge bg-{EXP_COLOR}">{EXPERIENCE_LEVEL}</span>
                                <span class="badge bg-light text-dark"><i class="fas fa-clock me-1"></i>{SALARY}/hr</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="card-text text-muted" style="font-size: 0.95rem;">{DESCRIPTION}</p>
                    
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        {SKILLS}
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-muted"></i> 
                               <small>{REMOTE_TYPE}</small></p>
                            <p class="mb-1"><i class="fas fa-calendar-alt me-2 text-muted"></i> 
                               <small>Posted: {POSTED_DATE}</small></p>
                            <p class="mb-3"><i class="fas fa-hourglass-end me-2 text-muted"></i> 
                               <small>Apply before: {DEADLINE}</small></p>
                        </div>
                        
                        <div class="mt-auto">
                            <button class="btn-primary w-100 apply-job-btn" data-job-id="{JOB_ID}">
                                <i class="fas fa-paper-plane me-2"></i>Apply Now
                            </button>
                            <button class="btn btn-outline-primary w-100 mt-2 view-details-btn" data-job-id="{JOB_ID}">
                                <i class="fas fa-eye me-2"></i>View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.logo-placeholder {
    width: 60px;
    height: 60px;
    background: #f0f2f5;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-placeholder i {
    font-size: 1.5rem;
    color: var(--luxury-blue);
}
</style>