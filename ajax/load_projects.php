<?php
// ajax/load_projects.php

// Set headers for JSON response
header('Content-Type: application/json');

// Simulate database connection (replace with actual DB connection)
$projects = [
    [
        'id' => 1,
        'title' => 'E-commerce Website with React',
        'short_title' => 'E-commerce Website with React',
        'short_description' => 'Build a fully functional e-commerce website with React, Node.js, and MongoDB.',
        'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'price' => 0,
        'difficulty_level' => 'intermediate',
        'downloads' => 1250,
        'estimated_hours' => '15-20',
        'tags' => '["React", "Node.js", "MongoDB"]',
        'is_featured' => true
    ],
    [
        'id' => 2,
        'title' => 'Mobile Banking App UI Design',
        'short_title' => 'Mobile Banking App Design',
        'short_description' => 'Modern banking app UI design with Figma. Includes 20+ screens.',
        'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'price' => 19.99,
        'difficulty_level' => 'intermediate',
        'downloads' => 540,
        'estimated_hours' => '10-15',
        'tags' => '["Figma", "UI Design", "Banking"]',
        'is_featured' => false,
        'discount_price' => 14.99
    ],
    [
        'id' => 3,
        'title' => 'Weather App with API Integration',
        'short_title' => 'Weather App with API Integration',
        'short_description' => 'Create a weather app that fetches real-time data from a weather API.',
        'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'price' => 0,
        'difficulty_level' => 'beginner',
        'downloads' => 890,
        'estimated_hours' => '5-8',
        'tags' => '["JavaScript", "API", "CSS"]',
        'is_featured' => false
    ],
    [
        'id' => 4,
        'title' => 'IoT Smart Home System',
        'short_title' => 'IoT Smart Home System',
        'short_description' => 'Build a smart home system with Arduino and IoT sensors.',
        'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'price' => 49.99,
        'difficulty_level' => 'advanced',
        'downloads' => 210,
        'estimated_hours' => '40-50',
        'tags' => '["Arduino", "IoT", "Smart Home"]',
        'is_featured' => true
    ],
    [
        'id' => 5,
        'title' => 'Machine Learning Model for Sales Prediction',
        'short_title' => 'Machine Learning Model for Sales Prediction',
        'short_description' => 'Predict sales using machine learning algorithms with Python.',
        'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'price' => 29.99,
        'difficulty_level' => 'advanced',
        'downloads' => 320,
        'estimated_hours' => '30-40',
        'tags' => '["Python", "ML", "Data Science"]',
        'is_featured' => true
    ],
    [
        'id' => 6,
        'title' => 'Task Management Chrome Extension',
        'short_title' => 'Task Management Chrome Extension',
        'short_description' => 'Productivity Chrome extension for task management.',
        'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'price' => 0,
        'difficulty_level' => 'beginner',
        'downloads' => 670,
        'estimated_hours' => '3-5',
        'tags' => '["JavaScript", "Chrome", "Extension"]',
        'is_featured' => false
    ]
];

// Apply filters (simulated)
$filteredProjects = $projects;
$totalProjects = count($filteredProjects);

// Generate HTML
$html = '';
if (count($filteredProjects) > 0) {
    $html .= '<div class="row g-4">';
    foreach ($filteredProjects as $project) {
        $html .= generateProjectCard($project);
    }
    $html .= '</div>';
} else {
    $html = '
    <div class="no-projects-found">
        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
        <h4>No projects found</h4>
        <p>Try adjusting your filters or check back later for new projects.</p>
    </div>';
}

// Generate summary
$freeCount = count(array_filter($projects, fn($p) => $p['price'] == 0));
$premiumCount = count(array_filter($projects, fn($p) => $p['price'] > 0));
$summary = "{$freeCount} free • {$premiumCount} premium projects";

// Generate pagination (simplified)
$itemsPerPage = 6;
$totalPages = ceil($totalProjects / $itemsPerPage);
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

$paginationHtml = '';
if ($totalPages > 1) {
    $paginationHtml .= '<nav aria-label="Page navigation"><ul class="pagination pagination-custom justify-content-center">';
    
    // Previous button
    $prevDisabled = ($currentPage <= 1) ? 'disabled' : '';
    $paginationHtml .= '<li class="page-item ' . $prevDisabled . '">
        <a class="page-link page-link-custom" href="#" data-page="' . ($currentPage - 1) . '">
            <i class="fas fa-chevron-left"></i>
        </a>
    </li>';
    
    // Page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $currentPage) ? 'active' : '';
        $paginationHtml .= '<li class="page-item ' . $active . '">
            <a class="page-link page-link-custom" href="#" data-page="' . $i . '">' . $i . '</a>
        </li>';
    }
    
    // Next button
    $nextDisabled = ($currentPage >= $totalPages) ? 'disabled' : '';
    $paginationHtml .= '<li class="page-item ' . $nextDisabled . '">
        <a class="page-link page-link-custom" href="#" data-page="' . ($currentPage + 1) . '">
            <i class="fas fa-chevron-right"></i>
        </a>
    </li>';
    
    $paginationHtml .= '</ul></nav>';
}

// Return JSON response
echo json_encode([
    'success' => true,
    'html' => $html,
    'total_projects' => $totalProjects,
    'summary' => $summary,
    'current_page' => $currentPage,
    'total_pages' => $totalPages,
    'pagination_html' => $paginationHtml
]);

// Function to generate project card HTML
function generateProjectCard($project) {
    // Extract project data
    $projectId = $project['id'];
    $title = htmlspecialchars($project['title']);
    $subtitle = htmlspecialchars($project['short_title']);
    $description = htmlspecialchars($project['short_description']);
    $thumbnail = $project['thumbnail_url'];
    $difficulty = strtolower($project['difficulty_level']);
    $difficultyText = ucfirst($project['difficulty_level']);
    $price = $project['price'];
    $downloads = number_format($project['downloads']);
    $hours = $project['estimated_hours'];
    $isFeatured = $project['is_featured'] ?? false;
    $discountPrice = $project['discount_price'] ?? null;
    
    // Get tags
    $tags = json_decode($project['tags'] ?? '[]', true) ?: [];
    $tagsHtml = '';
    foreach (array_slice($tags, 0, 3) as $tag) {
        $tagsHtml .= '<span class="project-tag">' . htmlspecialchars($tag) . '</span>';
    }
    
    // Determine price type and button
    if ($price == 0) {
        $priceBadge = '<span class="price-badge free">Free</span>';
        $downloadBtnClass = 'download';
        $downloadBtnText = 'Download';
        $downloadBtnIcon = 'fa-download';
    } else {
        if ($discountPrice && $discountPrice > 0) {
            $discountPercent = round(($price - $discountPrice) / $price * 100);
            $priceBadge = '
            <div class="discount-price">
                <span class="original-price">$' . number_format($price, 2) . '</span>
                <span class="discounted-price">$' . number_format($discountPrice, 2) . '</span>
                <span class="discount-percent">-' . $discountPercent . '%</span>
            </div>';
        } else {
            $priceBadge = '<span class="price-badge premium">$' . number_format($price, 2) . '</span>';
        }
        $downloadBtnClass = 'purchase';
        $downloadBtnText = 'Purchase';
        $downloadBtnIcon = 'fa-shopping-cart';
    }
    
    return '
    <div class="col-lg-4 col-md-6">
        <div class="project-card' . ($isFeatured ? ' featured' : '') . '">
            ' . ($isFeatured ? '<div class="featured-badge">Featured</div>' : '') . '
            
            <button class="save-btn" title="Save to favorites" data-project-id="' . $projectId . '">
                <i class="far fa-heart"></i>
            </button>
            
            <div class="project-image-container">
                <img src="' . $thumbnail . '" class="project-image" alt="' . $title . '">
                <span class="difficulty-badge ' . $difficulty . '">' . $difficultyText . '</span>
                ' . $priceBadge . '
            </div>
            
            <div class="project-card-body">
                <h3 class="project-title">' . $title . '</h3>
                <h4 class="project-subtitle">' . $subtitle . '</h4>
                <p class="project-description">' . $description . '</p>
                
                <div class="project-tags">' . $tagsHtml . '</div>
                
                <div class="project-stats">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="stat-count">' . $downloads . '</div>
                        <div class="stat-label">Downloads</div>
                    </div>
                    
                    <div class="stat-divider"></div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-count">' . $hours . '</div>
                        <div class="stat-label">Hours</div>
                    </div>
                </div>
                
                <div class="project-actions">
                    <button class="action-btn preview" data-project-id="' . $projectId . '">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    
                    <button class="action-btn ' . $downloadBtnClass . ' download-project-btn" data-project-id="' . $projectId . '">
                        <i class="fas ' . $downloadBtnIcon . '"></i> ' . $downloadBtnText . '
                    </button>
                </div>
            </div>
        </div>
    </div>';
}
?>