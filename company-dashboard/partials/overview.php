<?php
// company-dashboard/partials/overview.php
?>
<!-- Overview Content -->
<div class="overview-content">
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['active_jobs']; ?></h3>
                    <p>Active Jobs</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-success"><?php echo $stats['total_jobs']; ?> Total</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['total_applicants']; ?></h3>
                    <p>Total Applicants</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-info"><?php echo $stats['shortlisted']; ?> Shortlisted</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['hired']; ?></h3>
                    <p>Hired Candidates</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-primary"><?php echo $stats['interviews']; ?> Interviews</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['profile_views']; ?></h3>
                    <p>Profile Views</p>
                </div>
                <div class="stat-badge">
                    <span class="badge bg-warning">This Month</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Applications Overview</h5>
                    <div class="card-header-actions">
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                            <option>All Time</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="applicationsChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Hiring Pipeline</h5>
                </div>
                <div class="card-body">
                    <canvas id="pipelineChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Jobs & Activity -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Job Postings</h5>
                    <a href="#" onclick="loadCompanyContent('jobs')" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Applications</th>
                                    <th>Status</th>
                                    <th>Posted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jobs = [
                                    ['title' => 'Frontend Developer', 'applications' => 24, 'status' => 'active', 'posted' => '2 days ago'],
                                    ['title' => 'Backend Engineer', 'applications' => 18, 'status' => 'active', 'posted' => '1 week ago'],
                                    ['title' => 'UI/UX Designer', 'applications' => 12, 'status' => 'active', 'posted' => '2 weeks ago'],
                                    ['title' => 'DevOps Engineer', 'applications' => 8, 'status' => 'expired', 'posted' => '1 month ago'],
                                    ['title' => 'Data Scientist', 'applications' => 15, 'status' => 'active', 'posted' => '3 days ago']
                                ];
                                
                                foreach ($jobs as $job): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo $job['title']; ?></strong>
                                        <div class="small text-muted">Full-time · Remote</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?php echo $job['applications']; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo $job['status'] == 'active' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($job['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $job['posted']; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning ms-1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Applicants</h5>
                    <a href="#" onclick="loadCompanyContent('applicants')" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="applicants-list">
                        <?php
                        $applicants = [
                            ['name' => 'John Doe', 'position' => 'Frontend Developer', 'time' => '2 hours ago', 'status' => 'new'],
                            ['name' => 'Sarah Johnson', 'position' => 'UI/UX Designer', 'time' => '1 day ago', 'status' => 'reviewed'],
                            ['name' => 'Mike Chen', 'position' => 'Backend Engineer', 'time' => '2 days ago', 'status' => 'shortlisted'],
                            ['name' => 'Emily White', 'position' => 'Data Scientist', 'time' => '3 days ago', 'status' => 'interviewed'],
                            ['name' => 'Alex Turner', 'position' => 'DevOps Engineer', 'time' => '1 week ago', 'status' => 'hired']
                        ];
                        
                        foreach ($applicants as $applicant): ?>
                        <div class="applicant-item">
                            <div class="applicant-avatar">
                                <?php echo strtoupper(substr($applicant['name'], 0, 1)); ?>
                            </div>
                            <div class="applicant-info">
                                <h6><?php echo $applicant['name']; ?></h6>
                                <p><?php echo $applicant['position']; ?></p>
                                <small><?php echo $applicant['time']; ?></small>
                            </div>
                            <div class="applicant-status">
                                <span class="badge bg-<?php 
                                    echo $applicant['status'] == 'new' ? 'info' : 
                                         ($applicant['status'] == 'reviewed' ? 'warning' : 
                                         ($applicant['status'] == 'shortlisted' ? 'success' : 'primary'));
                                ?>">
                                    <?php echo ucfirst($applicant['status']); ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Quick Stats</h5>
                </div>
                <div class="card-body">
                    <div class="quick-stats">
                        <div class="stat-item">
                            <i class="fas fa-clock text-warning"></i>
                            <div>
                                <h6>Pending Reviews</h6>
                                <p class="mb-0"><?php echo $stats['total_applicants'] - $stats['shortlisted']; ?> applications</p>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-calendar-check text-success"></i>
                            <div>
                                <h6>Upcoming Interviews</h6>
                                <p class="mb-0"><?php echo $stats['interviews']; ?> scheduled</p>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star text-primary"></i>
                            <div>
                                <h6>Profile Rating</h6>
                                <p class="mb-0">4.8/5.0 (245 reviews)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>