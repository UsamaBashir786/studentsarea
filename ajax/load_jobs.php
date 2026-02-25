<?php
// ajax/load_jobs.php

// Set headers for JSON response
header('Content-Type: application/json');

// Database connection (adjust with your credentials)
$host = 'localhost';
$dbname = 'studentsarea';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// Get filter parameters
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_per_page = 10;
$offset = ($page - 1) * $items_per_page;

// Build WHERE clause based on filters
$where_conditions = [];
$params = [];

// Category filter
if (!empty($_GET['category'])) {
    $where_conditions[] = "category = :category";
    $params[':category'] = $_GET['category'];
}

// Job type filter
if (!empty($_GET['job_type'])) {
    $where_conditions[] = "job_type = :job_type";
    $params[':job_type'] = $_GET['job_type'];
}

// Experience filter
if (!empty($_GET['experience'])) {
    $where_conditions[] = "experience_level = :experience";
    $params[':experience'] = $_GET['experience'];
}

// Salary range filter
if (!empty($_GET['salary_range'])) {
    $range = explode('-', $_GET['salary_range']);
    if (count($range) == 2) {
        if ($range[1] == '+') {
            $where_conditions[] = "hourly_rate >= :min_salary";
            $params[':min_salary'] = intval($range[0]);
        } else {
            $where_conditions[] = "hourly_rate BETWEEN :min_salary AND :max_salary";
            $params[':min_salary'] = intval($range[0]);
            $params[':max_salary'] = intval($range[1]);
        }
    }
}

// Remote type filter
if (!empty($_GET['remote_type'])) {
    $where_conditions[] = "remote_type = :remote_type";
    $params[':remote_type'] = $_GET['remote_type'];
}

// Search filter
if (!empty($_GET['search'])) {
    $where_conditions[] = "(title LIKE :search OR company_name LIKE :search OR description LIKE :search)";
    $params[':search'] = '%' . $_GET['search'] . '%';
}

// Build WHERE clause
$where_clause = '';
if (!empty($where_conditions)) {
    $where_clause = 'WHERE ' . implode(' AND ', $where_conditions);
}

// Sort order
$sort_order = 'created_at DESC';
if (!empty($_GET['sort_by'])) {
    switch ($_GET['sort_by']) {
        case 'salary_high':
            $sort_order = 'hourly_rate DESC';
            break;
        case 'salary_low':
            $sort_order = 'hourly_rate ASC';
            break;
        case 'deadline':
            $sort_order = 'application_deadline ASC';
            break;
        default:
            $sort_order = 'created_at DESC';
    }
}

// Count total jobs
$count_sql = "SELECT COUNT(*) as total FROM remote_jobs $where_clause";
$stmt = $pdo->prepare($count_sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();
$total_jobs = $stmt->fetchColumn();

// Get jobs for current page
$sql = "SELECT * FROM remote_jobs $where_clause ORDER BY $sort_order LIMIT :offset, :limit";
$stmt = $pdo->prepare($sql);

// Bind parameters
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);

$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate HTML for jobs
$html = '';
if (count($jobs) > 0) {
    foreach ($jobs as $job) {
        $html .= generateJobCard($job);
    }
} else {
    $html = '
    <div class="no-jobs-found">
        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
        <h4>No jobs found</h4>
        <p>Try adjusting your filters or check back later for new opportunities.</p>
    </div>';
}

// Generate pagination HTML
$total_pages = ceil($total_jobs / $items_per_page);
$pagination_html = '';
if ($total_pages > 1) {
    $pagination_html .= '<nav aria-label="Page navigation"><ul class="pagination pagination-custom justify-content-center">';
    
    // Previous button
    $prev_disabled = ($page <= 1) ? 'disabled' : '';
    $pagination_html .= '<li class="page-item ' . $prev_disabled . '">
        <a class="page-link page-link-custom" href="#" data-page="' . ($page - 1) . '" ' . $prev_disabled . '>
            <i class="fas fa-chevron-left"></i>
        </a>
    </li>';
    
    // Page numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $pagination_html .= '<li class="page-item ' . $active . '">
            <a class="page-link page-link-custom" href="#" data-page="' . $i . '">' . $i . '</a>
        </li>';
    }
    
    // Next button
    $next_disabled = ($page >= $total_pages) ? 'disabled' : '';
    $pagination_html .= '<li class="page-item ' . $next_disabled . '">
        <a class="page-link page-link-custom" href="#" data-page="' . ($page + 1) . '" ' . $next_disabled . '>
            <i class="fas fa-chevron-right"></i>
        </a>
    </li>';
    
    $pagination_html .= '</ul></nav>';
}

// Return JSON response
echo json_encode([
    'success' => true,
    'html' => $html,
    'total_jobs' => $total_jobs,
    'current_page' => $page,
    'total_pages' => $total_pages,
    'pagination_html' => $pagination_html
]);

// Function to generate job card HTML
function generateJobCard($job) {
    // Format salary
    $salary = '$' . number_format($job['hourly_rate'], 0) . '/hr';
    
    // Format date
    $posted_date = date('M d, Y', strtotime($job['created_at']));
    
    // Job type badge color
    $type_colors = [
        'part_time' => 'primary',
        'full_time' => 'success',
        'contract' => 'warning',
        'freelance' => 'info',
        'internship' => 'secondary'
    ];
    
    $type_color = $type_colors[$job['job_type']] ?? 'secondary';
    
    // Experience badge color
    $exp_colors = [
        'student' => 'info',
        'entry' => 'primary',
        'junior' => 'success',
        'mid' => 'warning'
    ];
    
    $exp_color = $exp_colors[$job['experience_level']] ?? 'secondary';
    
    return '
    <div class="job-card mb-4" data-job-id="' . $job['id'] . '">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="row align-items-start">
                    <div class="col-md-8">
                        <div class="d-flex align-items-start mb-3">
                            <div class="company-logo me-3">
                                <div style="width: 60px; height: 60px; background: #f0f2f5; border-radius: 10px; 
                                      display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-briefcase fa-2x" style="color: var(--luxury-blue);"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title mb-1" style="color: var(--luxury-blue);">' . htmlspecialchars($job['title']) . '</h5>
                                <p class="text-muted mb-2"><i class="fas fa-building me-1"></i>' . htmlspecialchars($job['company_name']) . '</p>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-' . $type_color . '">' . ucfirst(str_replace('_', ' ', $job['job_type'])) . '</span>
                                    <span class="badge bg-' . $exp_color . '">' . ucfirst($job['experience_level']) . '</span>
                                    <span class="badge bg-light text-dark"><i class="fas fa-clock me-1"></i>' . $salary . '</span>
                                </div>
                            </div>
                        </div>
                        
                        <p class="card-text text-muted" style="font-size: 0.95rem;">' 
                            . substr(htmlspecialchars($job['description']), 0, 200) . '...</p>
                        
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            ' . getSkillsHTML($job['skills_required']) . '
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-3">
                                <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-muted"></i> 
                                   <small>' . ($job['is_remote'] ? 'Fully Remote' : 'Hybrid') . '</small></p>
                                <p class="mb-1"><i class="fas fa-calendar-alt me-2 text-muted"></i> 
                                   <small>Posted: ' . $posted_date . '</small></p>
                                <p class="mb-3"><i class="fas fa-hourglass-end me-2 text-muted"></i> 
                                   <small>Apply before: ' . date('M d, Y', strtotime($job['application_deadline'])) . '</small></p>
                            </div>
                            
                            <div class="mt-auto">
                                <button class="btn-primary w-100 apply-job-btn" data-job-id="' . $job['id'] . '">
                                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                                </button>
                                <button class="btn btn-outline-primary w-100 mt-2 view-details-btn" data-job-id="' . $job['id'] . '">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

// Function to generate skills HTML
function getSkillsHTML($skills_json) {
    $skills = json_decode($skills_json, true);
    if (!is_array($skills)) {
        $skills = ['Remote', 'Flexible'];
    }
    
    $html = '';
    foreach ($skills as $skill) {
        $html .= '<span class="badge bg-light text-dark border">' . htmlspecialchars($skill) . '</span>';
    }
    return $html;
}
?>