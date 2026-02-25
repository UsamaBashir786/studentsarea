<?php
// student-dashboard/ajax/load_articles.php
session_start();

// Sample articles data
$articles = [
    [
        'id' => 1,
        'title' => 'How to Build a Portfolio as a Student Developer',
        'status' => 'published',
        'views' => 1250,
        'likes' => 89,
        'comments' => 24,
        'published_date' => '2024-01-15'
    ],
    [
        'id' => 2,
        'title' => 'React Hooks: Complete Guide for Beginners',
        'status' => 'published',
        'views' => 890,
        'likes' => 56,
        'comments' => 18,
        'published_date' => '2024-01-10'
    ],
    [
        'id' => 3,
        'title' => 'Node.js REST API Best Practices',
        'status' => 'draft',
        'views' => 0,
        'likes' => 0,
        'comments' => 0,
        'published_date' => null
    ],
    [
        'id' => 4,
        'title' => 'CSS Grid vs Flexbox',
        'status' => 'pending_review',
        'views' => 0,
        'likes' => 0,
        'comments' => 0,
        'published_date' => null
    ]
];
?>

<div class="articles-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>My Articles</h4>
        <div>
            <a href="../articles.php?action=write" class="btn btn-primary me-2">
                <i class="fas fa-pen me-2"></i> Write New Article
            </a>
            <button class="btn btn-outline-primary" onclick="loadDashboardContent('article_stats')">
                <i class="fas fa-chart-bar me-2"></i> View Stats
            </button>
        </div>
    </div>
    
    <!-- Articles Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Likes</th>
                            <th>Comments</th>
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <strong><?php echo $article['title']; ?></strong>
                            </td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $article['status'] == 'published' ? 'success' : 
                                         ($article['status'] == 'draft' ? 'warning' : 'info'); 
                                ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $article['status'])); ?>
                                </span>
                            </td>
                            <td><?php echo number_format($article['views']); ?></td>
                            <td><?php echo number_format($article['likes']); ?></td>
                            <td><?php echo number_format($article['comments']); ?></td>
                            <td>
                                <?php echo $article['published_date'] ? 
                                    date('M d, Y', strtotime($article['published_date'])) : 
                                    'Not published'; ?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" 
                                            onclick="editArticle(<?php echo $article['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-info ms-1"
                                            onclick="viewArticle(<?php echo $article['id']; ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-danger ms-1"
                                            onclick="deleteArticle(<?php echo $article['id']; ?>)">
                                        <i class="fas fa-trash"></i>
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
function editArticle(id) {
    // Redirect to article editor
    window.location.href = `../article-editor.php?id=${id}`;
}

function viewArticle(id) {
    // Open article in new tab
    window.open(`../article-detail.php?id=${id}`, '_blank');
}

function deleteArticle(id) {
    if (confirm('Are you sure you want to delete this article?')) {
        $.ajax({
            url: 'ajax/delete_article.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    loadDashboardContent('articles');
                    showNotification('Article deleted successfully', 'success');
                }
            }
        });
    }
}
</script>