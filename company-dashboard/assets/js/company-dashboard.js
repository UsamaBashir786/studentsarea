// company-dashboard/assets/js/company-dashboard.js

class CompanyDashboard {
    constructor() {
        this.currentSection = 'overview';
        this.selectedApplicants = [];
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.loadStats();
        this.checkMessages();
    }
    
    bindEvents() {
        // Navigation
        $(document).on('click', '.nav-link[data-section]', (e) => {
            e.preventDefault();
            const section = $(e.currentTarget).data('section');
            this.loadSection(section);
        });
        
        // Search
        $('#dashboardSearch').on('keyup', (e) => {
            if (e.key === 'Enter') {
                this.handleSearch(e.target.value);
            }
        });
        
        // Post job button
        $('#postJobBtn').on('click', () => {
            this.showPostJobModal();
        });
        
        // Bulk actions
        $(document).on('change', '.applicant-checkbox', (e) => {
            this.updateSelectedApplicants();
        });
        
        // Keyboard shortcuts
        $(document).on('keydown', (e) => {
            this.handleKeyboardShortcuts(e);
        });
    }
    
    loadSection(section) {
        this.currentSection = section;
        
        // Update UI
        $('.nav-link').removeClass('active');
        $(`.nav-link[data-section="${section}"]`).addClass('active');
        
        // Update page title
        this.updatePageTitle(section);
        
        // Load content via AJAX
        $.ajax({
            url: `ajax/load_${section}.php`,
            type: 'GET',
            beforeSend: () => {
                $('#loadingOverlay').show();
            },
            success: (response) => {
                $('#dashboardContent').html(response);
                this.afterSectionLoad(section);
            },
            error: () => {
                $('#dashboardContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error loading content. Please try again.
                    </div>
                `);
            },
            complete: () => {
                $('#loadingOverlay').hide();
            }
        });
    }
    
    updatePageTitle(section) {
        const titles = {
            'overview': 'Dashboard Overview',
            'jobs': 'Job Postings',
            'applicants': 'Applicant Management',
            'analytics': 'Analytics Dashboard',
            'company': 'Company Profile',
            'messages': 'Messages',
            'candidates': 'Candidate Pool',
            'reports': 'Reports'
        };
        
        $('#pageTitle').text(titles[section] || section);
        $('#breadcrumbCurrent').text(titles[section] || section);
    }
    
    afterSectionLoad(section) {
        // Initialize section-specific functionality
        switch(section) {
            case 'overview':
                this.initOverviewCharts();
                break;
            case 'jobs':
                this.initJobFilters();
                break;
            case 'applicants':
                this.initApplicantFilters();
                break;
            case 'analytics':
                this.initAnalyticsCharts();
                break;
        }
        
        // Scroll to top
        window.scrollTo(0, 0);
    }
    
    initOverviewCharts() {
        // Applications Chart
        const applicationsCtx = document.getElementById('applicationsChart');
        if (applicationsCtx) {
            new Chart(applicationsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Applications',
                        data: [65, 78, 90, 120, 85, 110],
                        borderColor: '#0a2463',
                        backgroundColor: 'rgba(10, 36, 99, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
        
        // Pipeline Chart
        const pipelineCtx = document.getElementById('pipelineChart');
        if (pipelineCtx) {
            new Chart(pipelineCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Applied', 'Screened', 'Interview', 'Hired'],
                    datasets: [{
                        data: [156, 85, 32, 12],
                        backgroundColor: ['#6c757d', '#ffc107', '#0dcaf0', '#198754']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    }
    
    initAnalyticsCharts() {
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart');
        if (performanceCtx) {
            new Chart(performanceCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [
                        {
                            label: 'Profile Views',
                            data: [120, 180, 220, 300, 280, 350],
                            backgroundColor: 'rgba(10, 36, 99, 0.8)'
                        },
                        {
                            label: 'Applications',
                            data: [8, 12, 15, 22, 18, 25],
                            backgroundColor: 'rgba(163, 146, 116, 0.8)'
                        }
                    ]
                },
                options: {
                    responsive: true
                }
            });
        }
    }
    
    loadStats() {
        $.ajax({
            url: 'ajax/dashboard_stats.php',
            type: 'GET',
            success: (response) => {
                if (response.success) {
                    this.updateStats(response.stats);
                }
            }
        });
    }
    
    updateStats(stats) {
        // Update stats cards with real data
        Object.keys(stats).forEach(key => {
            $(`#stat-${key}`).text(stats[key]);
        });
    }
    
    checkMessages() {
        $.ajax({
            url: 'ajax/get_message_count.php',
            type: 'GET',
            success: (response) => {
                if (response.count !== undefined) {
                    $('#messageCount').text(response.count);
                }
            }
        });
    }
    
    handleSearch(query) {
        if (query.length > 2) {
            $.ajax({
                url: 'ajax/search.php',
                type: 'GET',
                data: { q: query },
                success: (response) => {
                    this.showSearchResults(response);
                }
            });
        }
    }
    
    showSearchResults(results) {
        const modalHtml = `
            <div class="modal fade" id="searchResultsModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Search Results</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            ${results}
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#searchResultsModal').remove();
        $('body').append(modalHtml);
        $('#searchResultsModal').modal('show');
    }
    
    showPostJobModal() {
        $.ajax({
            url: 'ajax/post_job.php',
            type: 'GET',
            success: (response) => {
                $('#postJobModal').remove();
                $('body').append(response);
                $('#postJobModal').modal('show');
            }
        });
    }
    
    initJobFilters() {
        // Job status filter
        $('#statusFilter').on('change', () => {
            this.filterJobs();
        });
        
        // Job type filter
        $('#typeFilter').on('change', () => {
            this.filterJobs();
        });
    }
    
    filterJobs() {
        const status = $('#statusFilter').val();
        const type = $('#typeFilter').val();
        const location = $('#locationFilter').val();
        
        $.ajax({
            url: 'ajax/filter_jobs.php',
            type: 'GET',
            data: { status: status, type: type, location: location },
            success: (response) => {
                $('#jobsGrid').html(response);
            }
        });
    }
    
    initApplicantFilters() {
        // Applicant filters
        $('#applicantStatusFilter, #applicantJobFilter, #dateFilter').on('change', () => {
            this.filterApplicants();
        });
    }
    
    filterApplicants() {
        const status = $('#applicantStatusFilter').val();
        const job = $('#applicantJobFilter').val();
        const date = $('#dateFilter').val();
        
        $.ajax({
            url: 'ajax/filter_applicants.php',
            type: 'GET',
            data: { status: status, job: job, date: date },
            success: (response) => {
                $('tbody').html(response);
            }
        });
    }
    
    updateSelectedApplicants() {
        this.selectedApplicants = [];
        $('.applicant-checkbox:checked').each(function() {
            this.selectedApplicants.push($(this).val());
        });
        
        if (this.selectedApplicants.length > 0) {
            $('#bulkActionsBtn').prop('disabled', false);
        } else {
            $('#bulkActionsBtn').prop('disabled', true);
        }
    }
    
    handleKeyboardShortcuts(e) {
        // Ctrl/Cmd + P to post job
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            this.showPostJobModal();
        }
        
        // Ctrl/Cmd + F to search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            $('#dashboardSearch').focus();
        }
        
        // Escape to close modals
        if (e.key === 'Escape') {
            $('.modal').modal('hide');
        }
    }
    
    // Applicant actions
    viewApplicant(id) {
        $.ajax({
            url: 'ajax/view_applicant.php',
            type: 'GET',
            data: { id: id },
            success: (response) => {
                $('#viewApplicantModal').remove();
                $('body').append(response);
                $('#viewApplicantModal').modal('show');
            }
        });
    }
    
    updateApplicantStatus(id, status) {
        $.ajax({
            url: 'ajax/update_applicant_status.php',
            type: 'POST',
            data: { id: id, status: status },
            success: (response) => {
                if (response.success) {
                    this.showNotification('Status updated successfully', 'success');
                    this.loadSection('applicants');
                }
            }
        });
    }
    
    messageApplicant(id) {
        $.ajax({
            url: 'ajax/message_applicant.php',
            type: 'GET',
            data: { id: id },
            success: (response) => {
                $('#messageModal').remove();
                $('body').append(response);
                $('#messageModal').modal('show');
            }
        });
    }
    
    // Job actions
    viewJob(id) {
        $.ajax({
            url: 'ajax/view_job.php',
            type: 'GET',
            data: { id: id },
            success: (response) => {
                $('#viewJobModal').remove();
                $('body').append(response);
                $('#viewJobModal').modal('show');
            }
        });
    }
    
    editJob(id) {
        $.ajax({
            url: 'ajax/edit_job.php',
            type: 'GET',
            data: { id: id },
            success: (response) => {
                $('#editJobModal').remove();
                $('body').append(response);
                $('#editJobModal').modal('show');
            }
        });
    }
    
    deleteJob(id) {
        if (confirm('Are you sure you want to delete this job posting?')) {
            $.ajax({
                url: 'ajax/delete_job.php',
                type: 'POST',
                data: { id: id },
                success: (response) => {
                    if (response.success) {
                        this.showNotification('Job deleted successfully', 'success');
                        this.loadSection('jobs');
                    }
                }
            });
        }
    }
    
    // Company profile
    updateCompanyProfile() {
        const formData = new FormData();
        formData.append('name', $('#companyName').val());
        formData.append('email', $('#companyEmail').val());
        formData.append('website', $('#companyWebsite').val());
        formData.append('description', $('#companyDescription').val());
        
        if ($('#companyLogo')[0].files[0]) {
            formData.append('logo', $('#companyLogo')[0].files[0]);
        }
        
        $.ajax({
            url: 'ajax/update_company.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                if (response.success) {
                    this.showNotification('Company profile updated successfully', 'success');
                }
            }
        });
    }
    
    // Analytics export
    exportAnalytics() {
        window.location.href = 'ajax/export_analytics.php';
    }
    
    // Reports generation
    generateReport(type) {
        $.ajax({
            url: 'ajax/generate_report.php',
            type: 'POST',
            data: { type: type },
            success: (response) => {
                if (response.success) {
                    window.open(response.url, '_blank');
                }
            }
        });
    }
    
    // Notification system
    showNotification(message, type = 'info') {
        const notification = $(`
            <div class="alert alert-${type} alert-dismissible fade show position-fixed top-3 end-3" 
                 style="z-index: 9999; max-width: 350px;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 
                                   type === 'error' ? 'exclamation-circle' : 
                                   'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
        
        $('.alert.position-fixed').remove();
        $('body').append(notification);
        
        setTimeout(() => {
            notification.alert('close');
        }, 5000);
    }
}

// Initialize dashboard when document is ready
$(document).ready(function() {
    window.companyDashboard = new CompanyDashboard();
});

// Global functions for inline onclick handlers
function loadCompanyContent(section) {
    if (window.companyDashboard) {
        window.companyDashboard.loadSection(section);
    }
}

function showNotification(message, type) {
    if (window.companyDashboard) {
        window.companyDashboard.showNotification(message, type);
    }
}

// Auto-refresh messages every minute
setInterval(() => {
    if (window.companyDashboard) {
        window.companyDashboard.checkMessages();
    }
}, 60000);