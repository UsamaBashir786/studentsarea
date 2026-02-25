// student-dashboard/assets/js/dashboard.js

// Dashboard Global Functions
class Dashboard {
    constructor() {
        this.currentSection = 'overview';
        this.notificationCount = 0;
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.loadStats();
        this.checkNotifications();
    }
    
    bindEvents() {
        // Navigation
        $(document).on('click', '.nav-link[data-section]', (e) => {
            e.preventDefault();
            const section = $(e.currentTarget).data('section');
            this.loadSection(section);
        });
        
        // Search
        $('#dashboardSearch').on('input', (e) => {
            this.handleSearch(e.target.value);
        });
        
        // Quick add button
        $('#quickAddBtn').on('click', () => {
            this.showQuickAddModal();
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
        
        // Update page title and breadcrumb
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
            'projects': 'My Projects',
            'articles': 'My Articles',
            'earnings': 'Earnings',
            'skills': 'Skills',
            'notifications': 'Notifications',
            'profile': 'Profile',
            'settings': 'Settings'
        };
        
        $('#pageTitle').text(titles[section] || section);
        $('#breadcrumbCurrent').text(titles[section] || section);
    }
    
    afterSectionLoad(section) {
        // Initialize section-specific functionality
        switch(section) {
            case 'overview':
                this.initCharts();
                break;
            case 'projects':
                this.initProjectFilters();
                break;
            case 'articles':
                this.initArticleFilters();
                break;
        }
        
        // Scroll to top
        window.scrollTo(0, 0);
    }
    
    initCharts() {
        // Projects Progress Chart
        const projectsCtx = document.getElementById('projectsChart');
        if (projectsCtx) {
            new Chart(projectsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'In Progress', 'Not Started'],
                    datasets: [{
                        data: [8, 3, 1],
                        backgroundColor: ['#28a745', '#ffc107', '#dc3545']
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
        
        // Activity Chart
        const activityCtx = document.getElementById('activityChart');
        if (activityCtx) {
            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Activity',
                        data: [12, 19, 8, 15, 22, 18, 14],
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
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
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
                    this.updateStatsDisplay(response.stats);
                }
            }
        });
    }
    
    updateStatsDisplay(stats) {
        // Update stats cards with real data
        Object.keys(stats).forEach(key => {
            $(`#stat-${key}`).text(stats[key]);
        });
    }
    
    checkNotifications() {
        $.ajax({
            url: 'ajax/get_notification_count.php',
            type: 'GET',
            success: (response) => {
                if (response.count !== undefined) {
                    this.notificationCount = response.count;
                    $('#notificationCount').text(response.count);
                    
                    // Show notification badge if count > 0
                    if (response.count > 0) {
                        $('#notificationCount').addClass('pulse');
                    }
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
                    this.displaySearchResults(response);
                }
            });
        }
    }
    
    displaySearchResults(results) {
        // Implement search results display
    }
    
    showQuickAddModal() {
        const modalHtml = `
            <div class="modal fade" id="quickAddModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Quick Add</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100 h-100 py-4" 
                                            onclick="dashboard.loadSection('projects')">
                                        <i class="fas fa-code fa-2x mb-2"></i><br>
                                        New Project
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-success w-100 h-100 py-4"
                                            onclick="dashboard.loadSection('articles')">
                                        <i class="fas fa-pen fa-2x mb-2"></i><br>
                                        Write Article
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-info w-100 h-100 py-4"
                                            onclick="dashboard.loadSection('skills')">
                                        <i class="fas fa-star fa-2x mb-2"></i><br>
                                        Add Skill
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-warning w-100 h-100 py-4"
                                            onclick="dashboard.loadSection('tasks')">
                                        <i class="fas fa-tasks fa-2x mb-2"></i><br>
                                        Add Task
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#quickAddModal').remove();
        $('body').append(modalHtml);
        $('#quickAddModal').modal('show');
    }
    
    handleKeyboardShortcuts(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            this.saveCurrentSection();
        }
        
        // Ctrl/Cmd + / to search
        if ((e.ctrlKey || e.metaKey) && e.key === '/') {
            e.preventDefault();
            $('#dashboardSearch').focus();
        }
    }
    
    saveCurrentSection() {
        // Implement save functionality based on current section
        switch(this.currentSection) {
            case 'profile':
                this.saveProfile();
                break;
            case 'settings':
                this.saveSettings();
                break;
        }
    }
    
    saveProfile() {
        const formData = new FormData();
        formData.append('name', $('#profileName').val());
        formData.append('email', $('#profileEmail').val());
        formData.append('bio', $('#profileBio').val());
        
        if ($('#profileAvatar')[0].files[0]) {
            formData.append('avatar', $('#profileAvatar')[0].files[0]);
        }
        
        $.ajax({
            url: 'ajax/update_profile.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                if (response.success) {
                    this.showNotification('Profile updated successfully', 'success');
                }
            }
        });
    }
    
    showNotification(message, type = 'info') {
        const notification = $(`
            <div class="notification notification-${type}">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 
                                   type === 'error' ? 'exclamation-circle' : 
                                   'info-circle'} me-2"></i>
                ${message}
            </div>
        `);
        
        $('.notification').remove();
        $('#dashboardContent').prepend(notification);
        
        setTimeout(() => {
            notification.fadeOut();
        }, 3000);
    }
    
    initProjectFilters() {
        // Project status filter
        $('.project-filter').on('click', function() {
            const status = $(this).data('status');
            $('.project-filter').removeClass('active');
            $(this).addClass('active');
            
            if (status === 'all') {
                $('.project-card').show();
            } else {
                $('.project-card').hide();
                $(`.project-card .badge.bg-${this.getStatusColor(status)}`).closest('.project-card').show();
            }
        });
    }
    
    getStatusColor(status) {
        const colors = {
            'completed': 'success',
            'in_progress': 'warning',
            'not_started': 'danger'
        };
        return colors[status] || 'secondary';
    }
    
    initArticleFilters() {
        // Article status filter
        $('.article-filter').on('click', function() {
            const status = $(this).data('status');
            $('.article-filter').removeClass('active');
            $(this).addClass('active');
            
            $.ajax({
                url: 'ajax/filter_articles.php',
                type: 'GET',
                data: { status: status },
                success: (response) => {
                    $('tbody').html(response);
                }
            });
        });
    }
}

// Initialize dashboard when document is ready
$(document).ready(function() {
    window.dashboard = new Dashboard();
});

// Global notification function
function showGlobalNotification(message, type = 'info') {
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

// Auto-refresh notifications every 30 seconds
setInterval(() => {
    if (window.dashboard) {
        window.dashboard.checkNotifications();
    }
}, 30000);