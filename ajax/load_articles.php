<?php
// ajax/load_articles.php

// Set headers for JSON response
header('Content-Type: application/json');

// Sample articles data (replace with database)
$articles = [
    [
        'id' => 1,
        'title' => 'How to Build a Portfolio as a Student Developer',
        'excerpt' => 'Learn how to create an impressive portfolio even with limited experience. Tips on selecting projects, writing descriptions, and showcasing your skills effectively to potential employers.',
        'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Career',
        'author' => 'John Doe',
        'author_avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
        'date' => '2024-01-15',
        'read_time' => '8 min read',
        'views' => 1250,
        'likes' => 89,
        'comments' => 24,
        'tags' => ['Portfolio', 'Career', 'Students', 'Development'],
        'difficulty' => 'beginner',
        'featured' => true,
        'type' => 'guides'
    ],
    [
        'id' => 2,
        'title' => '10 React Projects Every Beginner Should Try',
        'excerpt' => 'A collection of React project ideas to practice your skills and build your portfolio. From simple to-do apps to weather applications with API integration.',
        'image' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Web Development',
        'author' => 'Sarah Johnson',
        'author_avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
        'date' => '2024-01-12',
        'read_time' => '12 min read',
        'views' => 980,
        'likes' => 120,
        'comments' => 45,
        'tags' => ['React', 'JavaScript', 'Projects', 'Beginners'],
        'difficulty' => 'beginner',
        'featured' => true,
        'type' => 'tutorials'
    ],
    [
        'id' => 3,
        'title' => 'Freelancing Guide for Students: Earn While You Learn',
        'excerpt' => 'Complete guide to starting your freelancing journey as a student. Find clients, set rates, manage your time effectively, and build a sustainable freelance business.',
        'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Freelancing',
        'author' => 'Mike Chen',
        'author_avatar' => 'https://randomuser.me/api/portraits/men/67.jpg',
        'date' => '2024-01-10',
        'read_time' => '15 min read',
        'views' => 1560,
        'likes' => 156,
        'comments' => 32,
        'tags' => ['Freelancing', 'Money', 'Students', 'Work'],
        'difficulty' => 'intermediate',
        'featured' => false,
        'type' => 'guides'
    ],
    [
        'id' => 4,
        'title' => 'Machine Learning Roadmap for 2024',
        'excerpt' => 'Step-by-step guide to learning machine learning in 2024. Covering essential mathematics, programming fundamentals, and practical project implementation with Python.',
        'image' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Data Science',
        'author' => 'Dr. Emily White',
        'author_avatar' => 'https://randomuser.me/api/portraits/women/68.jpg',
        'date' => '2024-01-08',
        'read_time' => '20 min read',
        'views' => 2340,
        'likes' => 210,
        'comments' => 67,
        'tags' => ['Machine Learning', 'AI', 'Roadmap', 'Python'],
        'difficulty' => 'advanced',
        'featured' => true,
        'type' => 'tech'
    ],
    [
        'id' => 5,
        'title' => 'CSS Grid vs Flexbox: When to Use Which',
        'excerpt' => 'Comprehensive comparison between CSS Grid and Flexbox with practical examples. Learn which layout system to use for different scenarios and how to combine them effectively.',
        'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Web Development',
        'author' => 'Alex Turner',
        'author_avatar' => 'https://randomuser.me/api/portraits/men/86.jpg',
        'date' => '2024-01-05',
        'read_time' => '10 min read',
        'views' => 890,
        'likes' => 95,
        'comments' => 28,
        'tags' => ['CSS', 'Grid', 'Flexbox', 'Layout'],
        'difficulty' => 'intermediate',
        'featured' => false,
        'type' => 'tutorials'
    ],
    [
        'id' => 6,
        'title' => 'Remote Internship Success: A Student\'s Guide',
        'excerpt' => 'How to excel in remote internships. Communication tips, productivity hacks, and making a lasting impression virtually. Essential advice for the modern remote work environment.',
        'image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Career',
        'author' => 'Jessica Lee',
        'author_avatar' => 'https://randomuser.me/api/portraits/women/26.jpg',
        'date' => '2024-01-03',
        'read_time' => '7 min read',
        'views' => 720,
        'likes' => 68,
        'comments' => 19,
        'tags' => ['Internship', 'Remote Work', 'Career', 'Tips'],
        'difficulty' => 'beginner',
        'featured' => false,
        'type' => 'career'
    ],
    [
        'id' => 7,
        'title' => 'Building REST APIs with Node.js and Express',
        'excerpt' => 'Complete tutorial on creating RESTful APIs using Node.js and Express. Includes authentication, error handling, validation, and production best practices for scalable applications.',
        'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Web Development',
        'author' => 'David Park',
        'author_avatar' => 'https://randomuser.me/api/portraits/men/75.jpg',
        'date' => '2023-12-28',
        'read_time' => '18 min read',
        'views' => 1430,
        'likes' => 134,
        'comments' => 42,
        'tags' => ['Node.js', 'Express', 'API', 'Backend'],
        'difficulty' => 'intermediate',
        'featured' => true,
        'type' => 'tutorials'
    ],
    [
        'id' => 8,
        'title' => 'Tech Interview Preparation: What Companies Look For',
        'excerpt' => 'Insider tips on preparing for technical interviews at top tech companies. Algorithm practice, system design concepts, behavioral questions, and negotiation strategies.',
        'image' => 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'category' => 'Career',
        'author' => 'Robert Kim',
        'author_avatar' => 'https://randomuser.me/api/portraits/men/55.jpg',
        'date' => '2023-12-25',
        'read_time' => '14 min read',
        'views' => 1890,
        'likes' => 178,
        'comments' => 56,
        'tags' => ['Interview', 'Tech', 'Preparation', 'Jobs'],
        'difficulty' => 'intermediate',
        'featured' => false,
        'type' => 'career'
    ]
];

// Apply filters
$filteredArticles = $articles;
$type = $_GET['type'] ?? 'all';
$category = $_GET['category'] ?? '';
$difficulty = $_GET['difficulty'] ?? '';
$readingTime = $_GET['reading_time'] ?? '';
$tag = $_GET['tag'] ?? '';
$search = $_GET['search'] ?? '';
$sortBy = $_GET['sort_by'] ?? 'newest';

// Filter by type
if ($type !== 'all') {
    if ($type === 'trending') {
        $filteredArticles = array_filter($filteredArticles, function($article) {
            return $article['views'] > 1000;
        });
    } else {
        $filteredArticles = array_filter($filteredArticles, function($article) use ($type) {
            return $article['type'] === $type;
        });
    }
}

// Filter by category
if ($category) {
    $filteredArticles = array_filter($filteredArticles, function($article) use ($category) {
        return strtolower($article['category']) === $category;
    });
}

// Filter by difficulty
if ($difficulty) {
    $filteredArticles = array_filter($filteredArticles, function($article) use ($difficulty) {
        return $article['difficulty'] === $difficulty;
    });
}

// Filter by tag
if ($tag) {
    $filteredArticles = array_filter($filteredArticles, function($article) use ($tag) {
        return in_array(ucfirst($tag), $article['tags']);
    });
}

// Filter by search
if ($search) {
    $searchLower = strtolower($search);
    $filteredArticles = array_filter($filteredArticles, function($article) use ($searchLower) {
        return str_contains(strtolower($article['title']), $searchLower) || 
               str_contains(strtolower($article['excerpt']), $searchLower) ||
               str_contains(strtolower(implode(' ', $article['tags'])), $searchLower);
    });
}

// Sort articles
if ($sortBy === 'popular') {
    usort($filteredArticles, function($a, $b) {
        return $b['views'] - $a['views'];
    });
} elseif ($sortBy === 'views') {
    usort($filteredArticles, function($a, $b) {
        return $b['views'] - $a['views'];
    });
} elseif ($sortBy === 'reading_time') {
    usort($filteredArticles, function($a, $b) {
        $timeA = (int) $a['read_time'];
        $timeB = (int) $b['read_time'];
        return $timeA - $timeB;
    });
} else {
    // Newest first (default)
    usort($filteredArticles, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
}

// Pagination
$page = $_GET['page'] ?? 1;
$perPage = 8;
$totalArticles = count($filteredArticles);
$totalPages = ceil($totalArticles / $perPage);
$offset = ($page - 1) * $perPage;
$paginatedArticles = array_slice($filteredArticles, $offset, $perPage);

// Generate HTML
$html = '';
if (count($paginatedArticles) > 0) {
    foreach ($paginatedArticles as $article) {
        $html .= generateArticleListItem($article);
    }
} else {
    $html = '
    <div class="no-articles-found">
        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
        <h4>No articles found</h4>
        <p>Try adjusting your filters or check back later for new articles.</p>
    </div>';
}

// Generate summary
$featuredCount = count(array_filter($paginatedArticles, fn($a) => $a['featured']));
$summary = $featuredCount > 0 ? "{$featuredCount} featured articles" : "";

// Generate pagination HTML
$paginationHtml = '';
if ($totalPages > 1) {
    $paginationHtml .= '<nav aria-label="Page navigation"><ul class="pagination pagination-custom justify-content-center">';
    
    // Previous button
    $prevDisabled = ($page <= 1) ? 'disabled' : '';
    $paginationHtml .= '<li class="page-item ' . $prevDisabled . '">
        <a class="page-link page-link-custom" href="#" data-page="' . ($page - 1) . '">
            <i class="fas fa-chevron-left"></i>
        </a>
    </li>';
    
    // Page numbers
    $start = max(1, $page - 2);
    $end = min($totalPages, $page + 2);
    
    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $paginationHtml .= '<li class="page-item ' . $active . '">
            <a class="page-link page-link-custom" href="#" data-page="' . $i . '">' . $i . '</a>
        </li>';
    }
    
    // Next button
    $nextDisabled = ($page >= $totalPages) ? 'disabled' : '';
    $paginationHtml .= '<li class="page-item ' . $nextDisabled . '">
        <a class="page-link page-link-custom" href="#" data-page="' . ($page + 1) . '">
            <i class="fas fa-chevron-right"></i>
        </a>
    </li>';
    
    $paginationHtml .= '</ul></nav>';
}

// Return JSON response
echo json_encode([
    'success' => true,
    'html' => $html,
    'total_articles' => $totalArticles,
    'summary' => $summary,
    'current_page' => $page,
    'total_pages' => $totalPages,
    'pagination_html' => $paginationHtml
]);

// Function to generate article list item HTML
function generateArticleListItem($article) {
    $formattedDate = date('M d, Y', strtotime($article['date']));
    $viewsFormatted = number_format($article['views']);
    $likesFormatted = number_format($article['likes']);
    $commentsFormatted = number_format($article['comments']);
    
    $tagsHtml = '';
    foreach (array_slice($article['tags'], 0, 3) as $tag) {
        $tagsHtml .= '<a href="#" class="article-tag">' . htmlspecialchars($tag) . '</a>';
    }
    
    $difficultyClass = 'difficulty-' . $article['difficulty'];
    $difficultyText = ucfirst($article['difficulty']);
    
    return '
    <a href="article-detail.php?id=' . $article['id'] . '" class="article-list-item' . ($article['featured'] ? ' featured' : '') . '">
        <div class="article-header">
            <div>
                ' . ($article['featured'] ? '<span class="featured-badge">Featured</span>' : '') . '
                <span class="article-category">' . htmlspecialchars($article['category']) . '</span>
                <span class="difficulty-badge ' . $difficultyClass . '">' . $difficultyText . '</span>
            </div>
            <div class="article-date">
                <i class="far fa-clock me-1"></i>' . $article['read_time'] . '
            </div>
        </div>
        
        <h3 class="article-title">' . htmlspecialchars($article['title']) . '</h3>
        <p class="article-excerpt">' . htmlspecialchars($article['excerpt']) . '</p>
        
        <div class="article-meta">
            <div class="author-info">
                <img src="' . $article['author_avatar'] . '" class="author-avatar" alt="' . htmlspecialchars($article['author']) . '">
                <div class="author-details">
                    <h6>' . htmlspecialchars($article['author']) . '</h6>
                    <small>' . $formattedDate . '</small>
                </div>
            </div>
            <div class="article-stats">
                <div class="stat-item">
                    <i class="fas fa-eye"></i>
                    <span>' . $viewsFormatted . '</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-heart"></i>
                    <span>' . $likesFormatted . '</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-comment"></i>
                    <span>' . $commentsFormatted . '</span>
                </div>
            </div>
        </div>
        
        <div class="article-tags">' . $tagsHtml . '</div>
        
        <div class="read-more">
            Read full article <i class="fas fa-arrow-right"></i>
        </div>
    </a>';
}
?>