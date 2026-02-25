<?php
// company-dashboard/ajax/load_jobs.php
session_start();

// Sample jobs data (replace with database)
$jobs = [
    [
        'id' => 1,
        'title' => 'Frontend Developer (React)',
        'type' => 'Full-time',
        'location' => 'Remote',
        'salary' => '$60k - $80k',
        'applications' => 24,
        'status' => 'active',
        'posted' => '2024-01-15',
        'description' => 'Looking for an experienced React developer with 3+ years of experience.'
    ],
    [
        'id' => 2,
        'title' => 'Backend Engineer (Node.js)',
        'type' => 'Full-time',
        'location' => 'San Francisco, CA',
        'salary' => '$80k - $100k',
        'applications' => 18,
        'status' => 'active',
        'posted' => '2024-01-12',
        'description' => 'Build scalable APIs and microservices for our platform.'
    ],
    [
        'id' => 3,
        'title' => 'UI/UX Designer',
        'type' => 'Contract',
        'location' => 'Remote',
        'salary' => '$50/hr',
        'applications' => 12,
        'status' => 'active',
        'posted' => '2024-01-10',
        'description' => 'Design beautiful and user-friendly interfaces for web and mobile.'
    ],
    [
        'id' => 4,
        'title' => 'DevOps Engineer',
        'type' => 'Full-time',
        'location' => 'New York, NY',
        'salary' => '$90k - $120k',
        'applications' => 8,
        'status' => 'expired',
        'posted' => '2023-12-20',
        'description' => 'Manage cloud infrastructure and CI/CD pipelines.'
    ],
    [
        'id' => 5,
        'title' => 'Data Scientist',
        'type' => 'Full-time',
        'location' => 'Remote',
        'salary' => '$70k - $90k',
        'applications' => 15,
        'status' => 'active',
        'posted' => '2024-01-05',
        'description' => 'Work on machine learning models and data analysis.'
    ],
    [
        'id' => 6,
        'title' => 'Mobile Developer (React Native)',
        'type' => 'Part-time',
        'location' => 'Remote',
        'salary' => '$45/hr',
        'applications' => 9,
        'status' => 'draft',
        'posted' => '2024-01-18',
        'description' => 'Develop cross-platform mobile applications.'
    ]
];
?>

<div class="jobs-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Job Postings</h4>
        <button class="btn btn-primary" onclick="showPostJobModal()">
            <i class="fas fa-plus me-2"></i> Post New Job
        </button>
    </div>
    
    <!-- Job Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="typeFilter">
                        <option value="all">All Types</option>
                        <option value="full-time">Full-time</option>
                        <option value="part-time">Part-time</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="locationFilter">
                        <option value="all">All Locations</option>
                        <option value="remote">Remote</option>
                        <option value="onsite">On-site</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-primary w-100" onclick="filterJobs()">
                        <i class="fas fa-filter me-2"></i> Filter Jobs
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Jobs Grid -->
    <div class="row g-4" id="jobsGrid">
        <?php foreach ($jobs as $job): ?>
        <div class="col-md-6 col-lg-4">
            <div class="job-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="job-title"><?php echo $job['title']; ?></h5>
                    <span class="badge bg-<?php 
                        echo $job['status'] == 'active' ? 'success' : 
                             ($job['status'] == 'expired' ? 'secondary' : 'warning'); 
                    ?>">
                        <?php echo ucfirst($job['status']); ?>
                    </span>
                </div>
                
                <div class="job-meta">
                    <div class="job-meta-item">
                        <i class="fas fa-clock"></i>
                        <span><?php echo $job['type']; ?></span>
                    </div>
                    <div class="job-meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo $job['location']; ?></span>
                    </div>
                    <div class="job-meta-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span><?php echo $job['salary']; ?></span>
                    </div>
                </div>
                
                <p class="job-description"><?php echo $job['description']; ?></p>
                
                <div class="job-stats">
                    <div>
                        <span class="badge bg-info">
                            <i class="fas fa-users me-1"></i>
                            <?php echo $job['applications']; ?> applications
                        </span>
                    </div>
                    <div class="job-actions">
                        <button class="btn btn-sm btn-outline-primary" 
                                onclick="viewJob(<?php echo $job['id']; ?>)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-warning ms-1"
                                onclick="editJob(<?php echo $job['id']; ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger ms-1"
                                onclick="deleteJob(<?php echo $job['id']; ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function filterJobs() {
    const status = $('#statusFilter').val();
    const type = $('#typeFilter').val();
    const location = $('#locationFilter').val();
    
    $.ajax({
        url: 'ajax/filter_jobs.php',
        type: 'GET',
        data: { status: status, type: type, location: location },
        success: function(response) {
            $('#jobsGrid').html(response);
        }
    });
}

function viewJob(id) {
    $.ajax({
        url: 'ajax/view_job.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            $('#viewJobModal').remove();
            $('body').append(response);
            $('#viewJobModal').modal('show');
        }
    });
}

function editJob(id) {
    $.ajax({
        url: 'ajax/edit_job.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            $('#editJobModal').remove();
            $('body').append(response);
            $('#editJobModal').modal('show');
        }
    });
}

function deleteJob(id) {
    if (confirm('Are you sure you want to delete this job posting?')) {
        $.ajax({
            url: 'ajax/delete_job.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    showNotification('Job deleted successfully', 'success');
                    loadCompanyContent('jobs');
                }
            }
        });
    }
}
</script>