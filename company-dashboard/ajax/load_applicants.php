<?php
// company-dashboard/ajax/load_applicants.php
session_start();

// Sample applicants data
$applicants = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'position' => 'Frontend Developer',
        'applied_date' => '2024-01-15',
        'status' => 'new',
        'experience' => '3 years',
        'skills' => ['React', 'JavaScript', 'CSS', 'HTML5'],
        'score' => 85
    ],
    [
        'id' => 2,
        'name' => 'Sarah Johnson',
        'email' => 'sarah@example.com',
        'position' => 'UI/UX Designer',
        'applied_date' => '2024-01-14',
        'status' => 'reviewed',
        'experience' => '4 years',
        'skills' => ['Figma', 'Adobe XD', 'Photoshop', 'Sketch'],
        'score' => 92
    ],
    [
        'id' => 3,
        'name' => 'Mike Chen',
        'email' => 'mike@example.com',
        'position' => 'Backend Engineer',
        'applied_date' => '2024-01-13',
        'status' => 'shortlisted',
        'experience' => '5 years',
        'skills' => ['Node.js', 'Python', 'MongoDB', 'AWS'],
        'score' => 88
    ],
    [
        'id' => 4,
        'name' => 'Emily White',
        'email' => 'emily@example.com',
        'position' => 'Data Scientist',
        'applied_date' => '2024-01-12',
        'status' => 'interviewed',
        'experience' => '4 years',
        'skills' => ['Python', 'R', 'TensorFlow', 'SQL'],
        'score' => 90
    ],
    [
        'id' => 5,
        'name' => 'Alex Turner',
        'email' => 'alex@example.com',
        'position' => 'DevOps Engineer',
        'applied_date' => '2024-01-10',
        'status' => 'hired',
        'experience' => '6 years',
        'skills' => ['AWS', 'Docker', 'Kubernetes', 'CI/CD'],
        'score' => 95
    ]
];
?>

<div class="applicants-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Applicant Management</h4>
        <div class="btn-group">
            <button class="btn btn-outline-primary" onclick="exportApplicants()">
                <i class="fas fa-download me-2"></i> Export CSV
            </button>
            <button class="btn btn-outline-success" onclick="bulkActions()">
                <i class="fas fa-tasks me-2"></i> Bulk Actions
            </button>
        </div>
    </div>
    
    <!-- Applicant Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <select class="form-select" id="applicantStatusFilter">
                        <option value="all">All Status</option>
                        <option value="new">New</option>
                        <option value="reviewed">Reviewed</option>
                        <option value="shortlisted">Shortlisted</option>
                        <option value="interviewed">Interviewed</option>
                        <option value="hired">Hired</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="applicantJobFilter">
                        <option value="all">All Jobs</option>
                        <option value="frontend">Frontend Developer</option>
                        <option value="backend">Backend Engineer</option>
                        <option value="designer">UI/UX Designer</option>
                        <option value="devops">DevOps Engineer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="dateFilter" placeholder="Application Date">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary w-100" onclick="filterApplicants()">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Applicants Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Candidate</th>
                            <th>Applied For</th>
                            <th>Experience</th>
                            <th>Application Date</th>
                            <th>Status</th>
                            <th>Score</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applicants as $applicant): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="applicant-checkbox" value="<?php echo $applicant['id']; ?>">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="applicant-avatar me-3">
                                        <?php echo strtoupper(substr($applicant['name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?php echo $applicant['name']; ?></h6>
                                        <small class="text-muted"><?php echo $applicant['email']; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong><?php echo $applicant['position']; ?></strong>
                            </td>
                            <td><?php echo $applicant['experience']; ?></td>
                            <td><?php echo date('M d, Y', strtotime($applicant['applied_date'])); ?></td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $applicant['status'] == 'new' ? 'info' : 
                                         ($applicant['status'] == 'reviewed' ? 'warning' : 
                                         ($applicant['status'] == 'shortlisted' ? 'success' : 
                                         ($applicant['status'] == 'interviewed' ? 'primary' : 'success')));
                                ?>">
                                    <?php echo ucfirst($applicant['status']); ?>
                                </span>
                            </td>
                            <td>
                                <div class="progress" style="height: 6px; width: 80px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?php echo $applicant['score']; ?>%"></div>
                                </div>
                                <small><?php echo $applicant['score']; ?>%</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" 
                                            onclick="viewApplicant(<?php echo $applicant['id']; ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success ms-1"
                                            onclick="updateStatus(<?php echo $applicant['id']; ?>, 'shortlisted')">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <button class="btn btn-outline-warning ms-1"
                                            onclick="messageApplicant(<?php echo $applicant['id']; ?>)">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-outline-danger ms-1"
                                            onclick="rejectApplicant(<?php echo $applicant['id']; ?>)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Select all checkbox
    $('#selectAll').on('change', function() {
        $('.applicant-checkbox').prop('checked', $(this).prop('checked'));
    });
});

function filterApplicants() {
    const status = $('#applicantStatusFilter').val();
    const job = $('#applicantJobFilter').val();
    const date = $('#dateFilter').val();
    
    $.ajax({
        url: 'ajax/filter_applicants.php',
        type: 'GET',
        data: { status: status, job: job, date: date },
        success: function(response) {
            $('tbody').html(response);
        }
    });
}

function viewApplicant(id) {
    $.ajax({
        url: 'ajax/view_applicant.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            $('#viewApplicantModal').remove();
            $('body').append(response);
            $('#viewApplicantModal').modal('show');
        }
    });
}

function updateStatus(id, status) {
    $.ajax({
        url: 'ajax/update_applicant_status.php',
        type: 'POST',
        data: { id: id, status: status },
        success: function(response) {
            if (response.success) {
                showNotification('Status updated successfully', 'success');
                loadCompanyContent('applicants');
            }
        }
    });
}

function messageApplicant(id) {
    $.ajax({
        url: 'ajax/message_applicant.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            $('#messageModal').remove();
            $('body').append(response);
            $('#messageModal').modal('show');
        }
    });
}

function rejectApplicant(id) {
    if (confirm('Reject this applicant?')) {
        updateStatus(id, 'rejected');
    }
}

function exportApplicants() {
    window.location.href = 'ajax/export_applicants.php';
}

function bulkActions() {
    const selected = [];
    $('.applicant-checkbox:checked').each(function() {
        selected.push($(this).val());
    });
    
    if (selected.length === 0) {
        showNotification('Please select applicants first', 'warning');
        return;
    }
    
    $.ajax({
        url: 'ajax/bulk_actions.php',
        type: 'GET',
        data: { ids: selected.join(',') },
        success: function(response) {
            $('#bulkActionsModal').remove();
            $('body').append(response);
            $('#bulkActionsModal').modal('show');
        }
    });
}
</script>