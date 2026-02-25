<?php
// company-dashboard/ajax/load_analytics.php
session_start();

// Sample analytics data
$analytics = [
    'total_views' => 2450,
    'applications' => 156,
    'conversion_rate' => 6.4,
    'avg_response_time' => '2.3 days',
    'top_jobs' => [
        ['title' => 'Frontend Developer', 'applications' => 45],
        ['title' => 'Backend Engineer', 'applications' => 38],
        ['title' => 'UI/UX Designer', 'applications' => 28],
        ['title' => 'DevOps Engineer', 'applications' => 22],
        ['title' => 'Data Scientist', 'applications' => 23]
    ],
    'monthly_data' => [
        'views' => [120, 180, 220, 300, 280, 350, 400, 380, 420, 450, 480, 500],
        'applications' => [8, 12, 15, 22, 18, 25, 30, 28, 32, 35, 38, 40]
    ]
];
?>

<div class="analytics-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Analytics Dashboard</h4>
        <div class="btn-group">
            <button class="btn btn-outline-primary" onclick="exportAnalytics()">
                <i class="fas fa-download me-2"></i> Export Report
            </button>
            <button class="btn btn-outline-success" onclick="refreshAnalytics()">
                <i class="fas fa-sync-alt me-2"></i> Refresh
            </button>
        </div>
    </div>
    
    <!-- Analytics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="analytics-card">
                <div class="analytics-icon bg-primary">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="analytics-info">
                    <h3><?php echo number_format($analytics['total_views']); ?></h3>
                    <p>Total Profile Views</p>
                </div>
                <div class="analytics-trend">
                    <span class="text-success"><i class="fas fa-arrow-up"></i> 12%</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="analytics-card">
                <div class="analytics-icon bg-success">
                    <i class="fas fa-users"></i>
                </div>
                <div class="analytics-info">
                    <h3><?php echo $analytics['applications']; ?></h3>
                    <p>Total Applications</p>
                </div>
                <div class="analytics-trend">
                    <span class="text-success"><i class="fas fa-arrow-up"></i> 8%</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="analytics-card">
                <div class="analytics-icon bg-warning">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="analytics-info">
                    <h3><?php echo $analytics['conversion_rate']; ?>%</h3>
                    <p>Conversion Rate</p>
                </div>
                <div class="analytics-trend">
                    <span class="text-danger"><i class="fas fa-arrow-down"></i> 2%</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="analytics-card">
                <div class="analytics-icon bg-info">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="analytics-info">
                    <h3><?php echo $analytics['avg_response_time']; ?></h3>
                    <p>Avg Response Time</p>
                </div>
                <div class="analytics-trend">
                    <span class="text-success"><i class="fas fa-arrow-up"></i> 15%</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Performance</h5>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>Last 12 Months</option>
                        <option>Last 6 Months</option>
                        <option>Last 3 Months</option>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="performanceChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Top Performing Jobs</h5>
                </div>
                <div class="card-body">
                    <div class="top-jobs-list">
                        <?php foreach ($analytics['top_jobs'] as $index => $job): ?>
                        <div class="top-job-item">
                            <div class="job-rank">
                                <span class="rank-number"><?php echo $index + 1; ?></span>
                            </div>
                            <div class="job-info">
                                <h6><?php echo $job['title']; ?></h6>
                                <p><?php echo $job['applications']; ?> applications</p>
                            </div>
                            <div class="job-percentage">
                                <span class="badge bg-success">
                                    <?php echo round(($job['applications'] / $analytics['applications']) * 100); ?>%
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detailed Analytics -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Application Sources</h5>
                </div>
                <div class="card-body">
                    <canvas id="sourcesChart" height="250"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Candidate Quality</h5>
                </div>
                <div class="card-body">
                    <canvas id="qualityChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Performance Chart
    const performanceCtx = document.getElementById('performanceChart');
    if (performanceCtx) {
        new Chart(performanceCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Profile Views',
                        data: <?php echo json_encode($analytics['monthly_data']['views']); ?>,
                        backgroundColor: 'rgba(10, 36, 99, 0.8)',
                        borderColor: '#0a2463',
                        borderWidth: 1
                    },
                    {
                        label: 'Applications',
                        data: <?php echo json_encode($analytics['monthly_data']['applications']); ?>,
                        backgroundColor: 'rgba(163, 146, 116, 0.8)',
                        borderColor: '#a39274',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
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
    
    // Sources Chart
    const sourcesCtx = document.getElementById('sourcesChart');
    if (sourcesCtx) {
        new Chart(sourcesCtx, {
            type: 'pie',
            data: {
                labels: ['StudentsArea', 'LinkedIn', 'Indeed', 'Company Website', 'Referrals'],
                datasets: [{
                    data: [45, 25, 15, 10, 5],
                    backgroundColor: [
                        '#0a2463',
                        '#0077b5',
                        '#003580',
                        '#a39274',
                        '#198754'
                    ]
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
    
    // Quality Chart
    const qualityCtx = document.getElementById('qualityChart');
    if (qualityCtx) {
        new Chart(qualityCtx, {
            type: 'radar',
            data: {
                labels: ['Experience', 'Skills', 'Education', 'Portfolio', 'Communication', 'Culture Fit'],
                datasets: [{
                    label: 'Candidate Quality',
                    data: [85, 90, 80, 75, 88, 82],
                    backgroundColor: 'rgba(10, 36, 99, 0.2)',
                    borderColor: '#0a2463',
                    pointBackgroundColor: '#0a2463'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    }
});

function exportAnalytics() {
    window.location.href = 'ajax/export_analytics.php';
}

function refreshAnalytics() {
    loadCompanyContent('analytics');
    showNotification('Analytics refreshed', 'success');
}
</script>