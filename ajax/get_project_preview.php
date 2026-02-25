<?php
// ajax/get_project_preview.php

$project_id = $_GET['project_id'] ?? 0;

// In real app, fetch project details from database
// For demo, return sample preview

echo '
<div class="project-preview">
    <div class="position-relative">
        <img src="https://via.placeholder.com/900x450/1a3d8f/ffffff?text=Project+Preview" 
             class="project-image" alt="Project Preview">
        <div class="position-absolute top-0 start-0 p-4">
            <span class="badge-free p-2">FREE PROJECT</span>
        </div>
    </div>
    
    <div class="p-4">
        <h3 class="mb-3">E-commerce Website with React</h3>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Category:</strong> Web Development</p>
                <p><strong>Difficulty:</strong> <span class="badge-beginner p-1">Beginner</span></p>
                <p><strong>Time Required:</strong> 15-20 hours</p>
            </div>
            <div class="col-md-6">
                <p><strong>Primary Language:</strong> JavaScript</p>
                <p><strong>Downloads:</strong> 1,250+</p>
                <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐ (4.8/5.0)</p>
            </div>
        </div>
        
        <h5 class="mb-3">Project Description</h5>
        <p class="mb-4">Build a fully functional e-commerce website from scratch using React for the frontend, Node.js for the backend, and MongoDB for the database. This project will teach you full-stack development with modern technologies.</p>
        
        <h5 class="mb-3">Features</h5>
        <ul class="mb-4">
            <li>User authentication & authorization</li>
            <li>Product catalog with categories</li>
            <li>Shopping cart functionality</li>
            <li>Payment integration (Stripe)</li>
            <li>Order management system</li>
            <li>Admin dashboard</li>
        </ul>
        
        <h5 class="mb-3">Technologies Used</h5>
        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="badge bg-primary">React</span>
            <span class="badge bg-primary">Node.js</span>
            <span class="badge bg-primary">MongoDB</span>
            <span class="badge bg-primary">Express.js</span>
            <span class="badge bg-primary">Redux</span>
            <span class="badge bg-primary">JWT</span>
            <span class="badge bg-primary">Stripe API</span>
        </div>
        
        <h5 class="mb-3">What You\'ll Learn</h5>
        <div class="row">
            <div class="col-md-6">
                <p><i class="fas fa-check text-success me-2"></i> Full-stack development</p>
                <p><i class="fas fa-check text-success me-2"></i> REST API design</p>
                <p><i class="fas fa-check text-success me-2"></i> State management</p>
            </div>
            <div class="col-md-6">
                <p><i class="fas fa-check text-success me-2"></i> Database design</p>
                <p><i class="fas fa-check text-success me-2"></i> Payment integration</p>
                <p><i class="fas fa-check text-success me-2"></i> Deployment to production</p>
            </div>
        </div>
        
        <div class="mt-4 pt-4 border-top">
            <button class="btn-primary btn-lg w-100" id="startProjectBtn">
                <i class="fas fa-download me-2"></i>Download Project Files
            </button>
            <p class="text-center text-muted mt-2 mb-0">Includes: Source code, documentation, and setup guide</p>
        </div>
    </div>
</div>
';
?>