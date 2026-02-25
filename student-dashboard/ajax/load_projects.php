<?php
// student-dashboard/ajax/load_projects.php
session_start();

// Sample projects data (replace with database)
$projects = [
    [
        'id' => 1,
        'title' => 'E-commerce Website',
        'description' => 'Full-stack e-commerce platform with React & Node.js',
        'status' => 'completed',
        'progress' => 100,
        'deadline' => '2024-01-15',
        'skills' => ['React', 'Node.js', 'MongoDB', 'Stripe']
    ],
    [
        'id' => 2,
        'title' => 'Portfolio Website',
        'description' => 'Personal portfolio with blog functionality',
        'status' => 'in_progress',
        'progress' => 75,
        'deadline' => '2024-02-28',
        'skills' => ['HTML', 'CSS', 'JavaScript', 'PHP']
    ],
    [
        'id' => 3,
        'title' => 'Task Management App',
        'description' => 'Mobile app for task management',
        'status' => 'in_progress',
        'progress' => 50,
        'deadline' => '2024-03-15',
        'skills' => ['React Native', 'Firebase']
    ],
    [
        'id' => 4,
        'title' => 'API Documentation',
        'description' => 'REST API documentation with Swagger',
        'status' => 'not_started',
        'progress' => 0,
        'deadline' => '2024-04-10',
        'skills' => ['Swagger', 'OpenAPI', 'Markdown']
    ]
];
?>

<div class="projects-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>My Projects</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProjectModal">
            <i class="fas fa-plus me-2"></i> New Project
        </button>
    </div>
    
    <!-- Projects Grid -->
    <div class="row g-4">
        <?php foreach ($projects as $project): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card project-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title"><?php echo $project['title']; ?></h5>
                        <span class="badge bg-<?php 
                            echo $project['status'] == 'completed' ? 'success' : 
                                 ($project['status'] == 'in_progress' ? 'warning' : 'danger'); 
                        ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $project['status'])); ?>
                        </span>
                    </div>
                    
                    <p class="card-text text-muted mb-3"><?php echo $project['description']; ?></p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Progress</small>
                            <small><?php echo $project['progress']; ?>%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?php echo $project['progress']; ?>%"></div>
                        </div>
                    </div>
                    
                    <!-- Skills -->
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Skills Used:</small>
                        <div class="skill-tags">
                            <?php foreach ($project['skills'] as $skill): ?>
                            <span class="badge bg-light text-dark"><?php echo $skill; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Deadline -->
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="far fa-calendar me-1"></i>
                            Deadline: <?php echo date('M d, Y', strtotime($project['deadline'])); ?>
                        </small>
                        <div class="project-actions">
                            <button class="btn btn-sm btn-outline-primary" 
                                    onclick="editProject(<?php echo $project['id']; ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger ms-1"
                                    onclick="deleteProject(<?php echo $project['id']; ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- New Project Modal -->
<div class="modal fade" id="newProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="newProjectForm">
                    <div class="mb-3">
                        <label class="form-label">Project Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" class="form-control" name="deadline" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Skills (comma separated)</label>
                        <input type="text" class="form-control" name="skills" 
                               placeholder="React, Node.js, MongoDB">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveProject()">Create Project</button>
            </div>
        </div>
    </div>
</div>

<script>
function editProject(id) {
    // AJAX call to load project data and show edit modal
    $.ajax({
        url: 'ajax/get_project.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            // Show edit modal with populated data
            $('#editProjectModal').remove();
            $('body').append(response);
            $('#editProjectModal').modal('show');
        }
    });
}

function deleteProject(id) {
    if (confirm('Are you sure you want to delete this project?')) {
        $.ajax({
            url: 'ajax/delete_project.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    loadDashboardContent('projects');
                    showNotification('Project deleted successfully', 'success');
                }
            }
        });
    }
}

function saveProject() {
    const formData = $('#newProjectForm').serialize();
    
    $.ajax({
        url: 'ajax/save_project.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#newProjectModal').modal('hide');
                loadDashboardContent('projects');
                showNotification('Project created successfully', 'success');
            }
        }
    });
}
</script>