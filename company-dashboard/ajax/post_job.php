<?php
// company-dashboard/ajax/post_job.php
?>
<!-- Post Job Modal -->
<div class="modal fade" id="postJobModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Post New Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="postJobForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Job Title *</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Job Type *</label>
                            <select class="form-select" name="type" required>
                                <option value="">Select Type</option>
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                                <option value="remote">Remote</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location *</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Salary Range</label>
                            <input type="text" class="form-control" name="salary" placeholder="e.g., $60k - $80k">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Job Description *</label>
                        <textarea class="form-control" name="description" rows="5" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Requirements *</label>
                        <textarea class="form-control" name="requirements" rows="3" required></textarea>
                        <small class="text-muted">List each requirement on a new line</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Experience Level</label>
                            <select class="form-select" name="experience">
                                <option value="">Select Experience</option>
                                <option value="entry">Entry Level (0-2 years)</option>
                                <option value="mid">Mid Level (2-5 years)</option>
                                <option value="senior">Senior Level (5+ years)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Application Deadline</label>
                            <input type="date" class="form-control" name="deadline">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Required Skills</label>
                        <input type="text" class="form-control" name="skills" 
                               placeholder="React, JavaScript, Node.js, etc.">
                        <small class="text-muted">Separate skills with commas</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Benefits (Optional)</label>
                        <textarea class="form-control" name="benefits" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitJobPost()">
                    <i class="fas fa-paper-plane me-2"></i> Post Job
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function submitJobPost() {
    const formData = $('#postJobForm').serialize();
    
    $.ajax({
        url: 'ajax/save_job.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#postJobModal').modal('hide');
                showNotification('Job posted successfully!', 'success');
                loadCompanyContent('jobs');
            } else {
                showNotification(response.message || 'Error posting job', 'error');
            }
        }
    });
}
</script>