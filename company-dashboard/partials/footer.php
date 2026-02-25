<?php
// company-dashboard/partials/footer.php
?>
<!-- Footer -->
<footer class="dashboard-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-left">
                    <p class="mb-0">
                        &copy; <?php echo date('Y'); ?> StudentsArea. All rights reserved.
                        <span class="text-muted mx-2">|</span>
                        <a href="../privacy.php" class="text-muted">Privacy Policy</a>
                        <span class="text-muted mx-2">|</span>
                        <a href="../terms.php" class="text-muted">Terms of Service</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-right text-md-end">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                onclick="loadCompanyContent('help')">
                            <i class="fas fa-question-circle me-1"></i> Help
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                onclick="showFeedbackModal()">
                            <i class="fas fa-comment me-1"></i> Feedback
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                onclick="showReportBugModal()">
                            <i class="fas fa-bug me-1"></i> Report Bug
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Sidebar Overlay (for mobile) -->
<div class="sidebar-overlay"></div>

<!-- Quick Actions Modal -->
<div class="modal fade" id="quickActionsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <button class="btn btn-outline-primary w-100 h-100 py-4" 
                                onclick="loadCompanyContent('jobs')">
                            <i class="fas fa-briefcase fa-2x mb-2"></i><br>
                            View Jobs
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-success w-100 h-100 py-4"
                                onclick="loadCompanyContent('applicants')">
                            <i class="fas fa-users fa-2x mb-2"></i><br>
                            Applicants
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-info w-100 h-100 py-4"
                                onclick="loadCompanyContent('analytics')">
                            <i class="fas fa-chart-line fa-2x mb-2"></i><br>
                            Analytics
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-warning w-100 h-100 py-4"
                                onclick="showPostJobModal()">
                            <i class="fas fa-plus fa-2x mb-2"></i><br>
                            Post Job
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="feedbackForm">
                    <div class="mb-3">
                        <label class="form-label">Feedback Type</label>
                        <select class="form-select" name="type">
                            <option value="suggestion">Suggestion</option>
                            <option value="bug">Bug Report</option>
                            <option value="feature">Feature Request</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email (optional)</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitFeedback()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Report Bug Modal -->
<div class="modal fade" id="reportBugModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report a Bug</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bugReportForm">
                    <div class="mb-3">
                        <label class="form-label">Bug Description</label>
                        <textarea class="form-control" name="description" rows="4" 
                                  placeholder="Describe the bug in detail..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Steps to Reproduce</label>
                        <textarea class="form-control" name="steps" rows="3" 
                                  placeholder="Step by step instructions to reproduce the bug..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expected Behavior</label>
                        <textarea class="form-control" name="expected" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Actual Behavior</label>
                        <textarea class="form-control" name="actual" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Screenshots (optional)</label>
                        <input type="file" class="form-control" name="screenshots[]" multiple accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="submitBugReport()">Report Bug</button>
            </div>
        </div>
    </div>
</div>

<script>
// Show feedback modal
function showFeedbackModal() {
    $('#feedbackModal').modal('show');
}

// Show bug report modal
function showReportBugModal() {
    $('#reportBugModal').modal('show');
}

// Submit feedback
function submitFeedback() {
    const formData = $('#feedbackForm').serialize();
    
    $.ajax({
        url: 'ajax/submit_feedback.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#feedbackModal').modal('hide');
                $('#feedbackForm')[0].reset();
                showNotification('Feedback submitted successfully!', 'success');
            }
        }
    });
}

// Submit bug report
function submitBugReport() {
    const formData = new FormData($('#bugReportForm')[0]);
    
    $.ajax({
        url: 'ajax/submit_bug_report.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                $('#reportBugModal').modal('hide');
                $('#bugReportForm')[0].reset();
                showNotification('Bug report submitted. Thank you!', 'success');
            }
        }
    });
}

// Show quick actions modal (keyboard shortcut)
$(document).on('keydown', function(e) {
    if (e.ctrlKey && e.key === 'k') {
        e.preventDefault();
        $('#quickActionsModal').modal('show');
    }
});

// Update footer with current stats
function updateFooterStats() {
    $.ajax({
        url: 'ajax/get_footer_stats.php',
        type: 'GET',
        success: function(response) {
            if (response.stats) {
                // Update any stats in footer if needed
                console.log('Footer stats updated:', response.stats);
            }
        }
    });
}

// Check for system announcements
function checkAnnouncements() {
    $.ajax({
        url: 'ajax/get_announcements.php',
        type: 'GET',
        success: function(response) {
            if (response.announcements && response.announcements.length > 0) {
                showAnnouncementModal(response.announcements[0]);
            }
        }
    });
}

function showAnnouncementModal(announcement) {
    const modalHtml = `
        <div class="modal fade" id="announcementModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-bullhorn me-2"></i>${announcement.title}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>${announcement.message}</p>
                        ${announcement.link ? `<a href="${announcement.link}" class="btn btn-primary">Learn More</a>` : ''}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    $('#announcementModal').remove();
    $('body').append(modalHtml);
    $('#announcementModal').modal('show');
}

// Check for announcements on page load
$(document).ready(function() {
    setTimeout(checkAnnouncements, 2000);
    
    // Update footer stats every 5 minutes
    setInterval(updateFooterStats, 300000);
    
    // Show welcome message for first-time users
    const firstVisit = localStorage.getItem('companyDashboardFirstVisit');
    if (!firstVisit) {
        setTimeout(() => {
            showNotification('Welcome to your Company Dashboard! Start by posting your first job.', 'info');
            localStorage.setItem('companyDashboardFirstVisit', 'true');
        }, 1000);
    }
});

// Keyboard shortcuts help
$(document).on('keydown', function(e) {
    if (e.key === '?') {
        e.preventDefault();
        showKeyboardShortcuts();
    }
});

function showKeyboardShortcuts() {
    const shortcuts = `
        <div class="modal fade" id="shortcutsModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keyboard Shortcuts</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td><kbd>Ctrl</kbd> + <kbd>K</kbd></td>
                                        <td>Quick Actions</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Ctrl</kbd> + <kbd>P</kbd></td>
                                        <td>Post New Job</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Ctrl</kbd> + <kbd>F</kbd></td>
                                        <td>Search</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>?</kbd></td>
                                        <td>Show this help</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Esc</kbd></td>
                                        <td>Close modal/panel</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    $('#shortcutsModal').remove();
    $('body').append(shortcuts);
    $('#shortcutsModal').modal('show');
}
</script>