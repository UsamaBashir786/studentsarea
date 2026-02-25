<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php?redirect=apply-company.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_type = $_SESSION['user_type'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_application') {
    header('Content-Type: application/json');
    
    try {
        // Check if tables exist
        $tables_exist = true;
        $required_tables = ['company_applications_new', 'job_packages', 'activity_logs'];
        
        foreach ($required_tables as $table) {
            $check = $pdo->query("SHOW TABLES LIKE '$table'");
            if ($check->rowCount() == 0) {
                $tables_exist = false;
                throw new Exception("Database table '$table' does not exist. Please run the SQL setup first.");
            }
        }
        
        // Validate required fields
        $required_fields = ['company_name', 'company_type', 'industry', 'company_size', 'website', 'description', 'contact_name', 'contact_position', 'contact_email', 'contact_phone', 'selected_package'];
        
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("All required fields must be filled. Missing: $field");
            }
        }
        
        // Validate email
        if (!filter_var($_POST['contact_email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }
        
        // Validate website
        if (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid website URL");
        }
        
        // Begin transaction
        $pdo->beginTransaction();
        
        // Insert company application
        $stmt = $pdo->prepare("
            INSERT INTO company_applications_new (
                user_id, company_name, company_type, industry, company_size, 
                website, description, address, contact_name, contact_position, 
                contact_email, contact_phone, selected_package
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $result = $stmt->execute([
            $user_id,
            $_POST['company_name'],
            $_POST['company_type'],
            $_POST['industry'],
            $_POST['company_size'],
            $_POST['website'],
            $_POST['description'],
            $_POST['address'] ?? null,
            $_POST['contact_name'],
            $_POST['contact_position'],
            $_POST['contact_email'],
            $_POST['contact_phone'],
            $_POST['selected_package']
        ]);
        
        if (!$result) {
            throw new Exception("Failed to insert application data");
        }
        
        $application_id = $pdo->lastInsertId();
        
        // Handle file uploads
        $upload_dir = 'uploads/company_documents/';
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                throw new Exception("Failed to create upload directory");
            }
        }
        
        // Upload registration proof
        if (isset($_FILES['registration_proof']) && $_FILES['registration_proof']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['registration_proof'];
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'reg_' . $application_id . '_' . time() . '.' . $extension;
            $filepath = $upload_dir . $filename;
            
            if (!move_uploaded_file($file['tmp_name'], $filepath)) {
                throw new Exception("Failed to upload registration proof");
            }
        }
        
        // Upload tax document if provided
        if (isset($_FILES['tax_document']) && $_FILES['tax_document']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['tax_document'];
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'tax_' . $application_id . '_' . time() . '.' . $extension;
            $filepath = $upload_dir . $filename;
            
            if (!move_uploaded_file($file['tmp_name'], $filepath)) {
                throw new Exception("Failed to upload tax document");
            }
        }
        
        // Upload additional documents
        if (isset($_FILES['additional_docs']) && !empty($_FILES['additional_docs']['name'][0])) {
            $files = $_FILES['additional_docs'];
            $file_count = count($files['name']);
            
            for ($i = 0; $i < $file_count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                    $filename = 'add_' . $application_id . '_' . time() . '_' . $i . '.' . $extension;
                    $filepath = $upload_dir . $filename;
                    
                    if (!move_uploaded_file($files['tmp_name'][$i], $filepath)) {
                        throw new Exception("Failed to upload additional document");
                    }
                }
            }
        }
        
        // Log activity
        $log_stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, details, ip_address) VALUES (?, 'company_application', ?, ?)");
        $log_result = $log_stmt->execute([$user_id, 'Submitted company application for ' . $_POST['company_name'], $_SERVER['REMOTE_ADDR']]);
        
        if (!$log_result) {
            // Non-critical error, just log it but don't fail the transaction
            error_log("Failed to log activity for user $user_id");
        }
        
        // Commit transaction
        $pdo->commit();
        
        // Send confirmation email (optional - remove if causing issues)
        @mail($user_email, "Company Application Received", "Thank you for applying...");
        
        echo json_encode([
            'success' => true,
            'message' => 'Application submitted successfully! Our team will review your application within 24-48 hours.',
            'application_id' => $application_id
        ]);
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

// Get user's existing applications with error handling
try {
    $stmt = $pdo->prepare("SELECT * FROM company_applications_new WHERE user_id = ? ORDER BY submitted_at DESC LIMIT 1");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch();
    $existing_application = $result ?: [];
} catch (Exception $e) {
    $existing_application = [];
    error_log("Error fetching existing applications: " . $e->getMessage());
}

// Get available packages with error handling
try {
    $packages = $pdo->query("SELECT * FROM job_packages WHERE is_active = 1 ORDER BY price")->fetchAll();
    if (empty($packages)) {
        // Fallback packages if table doesn't exist or is empty
        $packages = [
            ['package_name' => 'basic', 'price' => 49.00, 'job_posts' => 1, 'listing_days' => 30, 'applications_limit' => 50, 'has_featured_tag' => false, 'has_priority_support' => false],
            ['package_name' => 'standard', 'price' => 99.00, 'job_posts' => 3, 'listing_days' => 45, 'applications_limit' => 150, 'has_featured_tag' => true, 'has_priority_support' => false],
            ['package_name' => 'premium', 'price' => 199.00, 'job_posts' => 10, 'listing_days' => 60, 'applications_limit' => null, 'has_featured_tag' => true, 'has_priority_support' => true]
        ];
    }
} catch (Exception $e) {
    // Fallback packages if table doesn't exist
    $packages = [
        ['package_name' => 'basic', 'price' => 49.00, 'job_posts' => 1, 'listing_days' => 30, 'applications_limit' => 50, 'has_featured_tag' => false, 'has_priority_support' => false],
        ['package_name' => 'standard', 'price' => 99.00, 'job_posts' => 3, 'listing_days' => 45, 'applications_limit' => 150, 'has_featured_tag' => true, 'has_priority_support' => false],
        ['package_name' => 'premium', 'price' => 199.00, 'job_posts' => 10, 'listing_days' => 60, 'applications_limit' => null, 'has_featured_tag' => true, 'has_priority_support' => true]
    ];
    error_log("Error fetching packages: " . $e->getMessage());
}
// Get user's existing applications
$stmt = $pdo->prepare("SELECT * FROM company_applications_new WHERE user_id = ? ORDER BY submitted_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$result = $stmt->fetch();

// Initialize as empty array if no result
$existing_application = [];
if ($result !== false) {
    $existing_application = $result;
}

// Get available packages
$packages = $pdo->query("SELECT * FROM job_packages WHERE is_active = 1 ORDER BY price")->fetchAll();
if ($packages === false) {
    $packages = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply as Company - StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/extra.min.css">
    <!-- Additional CSS for this page -->
    <style>
    .company-apply-section {
        padding: 6rem 0 4rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }
    
    .verification-steps {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
        border-left: 4px solid var(--luxury-blue);
    }
    
    .step-indicator {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--luxury-blue-light);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .step-content h5 {
        margin: 0;
        color: var(--luxury-blue);
    }
    
    .step-content p {
        margin: 0.3rem 0 0;
        color: #666;
        font-size: 0.9rem;
    }
    
    .form-section {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .section-title {
        color: var(--luxury-blue);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--gold-accent);
        font-weight: 600;
    }
    
    .form-label {
        font-weight: 500;
        color: var(--luxury-blue);
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--luxury-blue);
        box-shadow: 0 0 0 0.25rem rgba(10, 36, 99, 0.1);
    }
    
    .required-field::after {
        content: " *";
        color: #dc3545;
    }
    
    .file-upload-area {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .file-upload-area:hover {
        border-color: var(--luxury-blue);
        background: #f0f7ff;
    }
    
    .file-upload-area i {
        font-size: 3rem;
        color: var(--luxury-blue);
        margin-bottom: 1rem;
    }
    
    .uploaded-file {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
        border: 1px solid #ddd;
    }
    
    .package-card {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        height: 100%;
    }
    
    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .package-card.selected {
        border-color: var(--luxury-blue);
        background: linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 100%);
    }
    
    .package-card.recommended {
        border-color: var(--gold-accent);
        position: relative;
        overflow: hidden;
    }
    
    .package-card.recommended::before {
        content: "RECOMMENDED";
        position: absolute;
        top: 10px;
        right: -30px;
        background: var(--gold-accent);
        color: var(--luxury-blue);
        padding: 0.3rem 2rem;
        font-size: 0.7rem;
        font-weight: 600;
        transform: rotate(45deg);
    }
    
    .package-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--luxury-blue);
        margin: 1rem 0;
    }
    
    .package-features {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
        text-align: left;
    }
    
    .package-features li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #eee;
        color: #555;
    }
    
    .package-features li:last-child {
        border-bottom: none;
    }
    
    .package-features li i {
        color: var(--gold-accent);
        margin-right: 0.5rem;
    }
    
    .company-benefits {
        background: linear-gradient(135deg, var(--luxury-blue) 0%, var(--luxury-blue-dark) 100%);
        color: white;
        border-radius: 12px;
        padding: 2rem;
        margin-top: 3rem;
    }
    
    .benefit-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    
    .benefit-icon {
        background: var(--gold-accent);
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .benefit-icon i {
        color: var(--luxury-blue);
        font-size: 1.3rem;
    }
    
    .benefit-content h5 {
        margin: 0 0 0.5rem;
        color: white;
    }
    
    .benefit-content p {
        margin: 0;
        opacity: 0.9;
    }
    
    .verification-badge {
        background: var(--gold-accent);
        color: var(--luxury-blue);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .verification-badge i {
        margin-right: 0.5rem;
    }
    
    .alert-message {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        display: none;
    }
    
    .existing-application {
        background: #fff3cd;
        border: 1px solid #ffeeba;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 2rem;
        color: #856404;
    }
    
    @media (max-width: 768px) {
        .company-apply-section {
            padding: 5rem 0 2rem;
        }
        
        .form-section {
            padding: 1.5rem;
        }
        
        .package-card.recommended::before {
            font-size: 0.6rem;
            right: -35px;
            padding: 0.3rem 2.5rem;
        }
        
        .alert-message {
            min-width: auto;
            left: 20px;
            right: 20px;
        }
    }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Alert Message -->
    <div class="alert-message" id="alertMessage">
        <div class="alert alert-dismissible fade show" role="alert">
            <span id="alertText"></span>
            <button type="button" class="btn-close" onclick="hideAlert()"></button>
        </div>
    </div>
    
    <!-- Company Application Section -->
    <section class="company-apply-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Welcome User -->
                    <div class="mb-4">
                        <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
                        <p class="text-muted">Complete your company profile to start posting jobs.</p>
                    </div>
                    
                    <?php if (!empty($existing_application) && isset($existing_application['status']) && $existing_application['status'] === 'pending'): ?>
                    <div class="existing-application">
                        <i class="fas fa-info-circle me-2"></i>
                        You already have a pending application submitted on 
                        <?php echo isset($existing_application['submitted_at']) ? date('F j, Y', strtotime($existing_application['submitted_at'])) : ''; ?>. 
                        Our team is reviewing it. You'll be notified once verified.
                    </div>
                    <?php endif; ?>
                    
                    <!-- Verification Steps -->
                    <div class="verification-steps">
                        <h2 class="section-heading">Company Verification Process</h2>
                        <p class="lead-text mb-4">Get verified to post paid job listings and connect with talented students</p>
                        
                        <div class="step-indicator">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h5>Submit Company Details</h5>
                                <p>Fill in your company information and upload verification documents</p>
                            </div>
                        </div>
                        
                        <div class="step-indicator">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h5>Verification Review</h5>
                                <p>Our team reviews your application within 24-48 hours</p>
                            </div>
                        </div>
                        
                        <div class="step-indicator">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h5>Choose Job Package</h5>
                                <p>Select a job posting package that fits your hiring needs</p>
                            </div>
                        </div>
                        
                        <div class="step-indicator" style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h5>Start Hiring</h5>
                                <p>Post jobs and connect with verified student candidates</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Information Form -->
                    <form id="companyApplicationForm" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="submit_application">
                        
                        <!-- Company Details Section -->
                        <div class="form-section">
                            <h3 class="section-title">Company Information</h3>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" required 
                                           placeholder="Enter official company name"
                                           value="<?php echo (!empty($existing_application) && isset($existing_application['company_name'])) ? htmlspecialchars($existing_application['company_name']) : ''; ?>">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Company Type</label>
                                    <select class="form-select" name="company_type" required>
                                        <option value="">Select company type</option>
                                        <option value="Startup" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'Startup') ? 'selected' : ''; ?>>Startup</option>
                                        <option value="SME" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'SME') ? 'selected' : ''; ?>>Small & Medium Enterprise</option>
                                        <option value="Corporation" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'Corporation') ? 'selected' : ''; ?>>Corporation</option>
                                        <option value="Non-Profit" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'Non-Profit') ? 'selected' : ''; ?>>Non-Profit Organization</option>
                                        <option value="Government" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'Government') ? 'selected' : ''; ?>>Government Agency</option>
                                        <option value="Educational" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'Educational') ? 'selected' : ''; ?>>Educational Institution</option>
                                        <option value="Other" <?php echo (!empty($existing_application) && isset($existing_application['company_type']) && $existing_application['company_type'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Industry</label>
                                    <select class="form-select" name="industry" required>
                                        <option value="">Select industry</option>
                                        <option value="Technology" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Technology') ? 'selected' : ''; ?>>Technology</option>
                                        <option value="Finance" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Finance') ? 'selected' : ''; ?>>Finance & Banking</option>
                                        <option value="Healthcare" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Healthcare') ? 'selected' : ''; ?>>Healthcare</option>
                                        <option value="Education" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Education') ? 'selected' : ''; ?>>Education</option>
                                        <option value="E-commerce" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'E-commerce') ? 'selected' : ''; ?>>E-commerce</option>
                                        <option value="Marketing" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Marketing') ? 'selected' : ''; ?>>Marketing & Advertising</option>
                                        <option value="Manufacturing" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Manufacturing') ? 'selected' : ''; ?>>Manufacturing</option>
                                        <option value="Consulting" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Consulting') ? 'selected' : ''; ?>>Consulting</option>
                                        <option value="Other" <?php echo (!empty($existing_application) && isset($existing_application['industry']) && $existing_application['industry'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Company Size</label>
                                    <select class="form-select" name="company_size" required>
                                        <option value="">Select company size</option>
                                        <option value="1-10" <?php echo (!empty($existing_application) && isset($existing_application['company_size']) && $existing_application['company_size'] == '1-10') ? 'selected' : ''; ?>>1-10 employees</option>
                                        <option value="11-50" <?php echo (!empty($existing_application) && isset($existing_application['company_size']) && $existing_application['company_size'] == '11-50') ? 'selected' : ''; ?>>11-50 employees</option>
                                        <option value="51-200" <?php echo (!empty($existing_application) && isset($existing_application['company_size']) && $existing_application['company_size'] == '51-200') ? 'selected' : ''; ?>>51-200 employees</option>
                                        <option value="201-500" <?php echo (!empty($existing_application) && isset($existing_application['company_size']) && $existing_application['company_size'] == '201-500') ? 'selected' : ''; ?>>201-500 employees</option>
                                        <option value="501-1000" <?php echo (!empty($existing_application) && isset($existing_application['company_size']) && $existing_application['company_size'] == '501-1000') ? 'selected' : ''; ?>>501-1000 employees</option>
                                        <option value="1000+" <?php echo (!empty($existing_application) && isset($existing_application['company_size']) && $existing_application['company_size'] == '1000+') ? 'selected' : ''; ?>>1000+ employees</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Company Website</label>
                                <input type="url" class="form-control" name="website" required 
                                       placeholder="https://yourcompany.com"
                                       value="<?php echo (!empty($existing_application) && isset($existing_application['website'])) ? htmlspecialchars($existing_application['website']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Company Description</label>
                                <textarea class="form-control" name="description" rows="4" required 
                                          placeholder="Brief description of your company, products/services, and mission"><?php echo (!empty($existing_application) && isset($existing_application['description'])) ? htmlspecialchars($existing_application['description']) : ''; ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Company Address</label>
                                <textarea class="form-control" name="address" rows="3" 
                                          placeholder="Full company address"><?php echo (!empty($existing_application) && isset($existing_application['address'])) ? htmlspecialchars($existing_application['address']) : ''; ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Contact Person Details -->
                        <div class="form-section">
                            <h3 class="section-title">Contact Person Details</h3>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Full Name</label>
                                    <input type="text" class="form-control" name="contact_name" required 
                                           placeholder="Contact person name"
                                           value="<?php echo (!empty($existing_application) && isset($existing_application['contact_name'])) ? htmlspecialchars($existing_application['contact_name']) : ''; ?>">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Position/Title</label>
                                    <input type="text" class="form-control" name="contact_position" required 
                                           placeholder="e.g., HR Manager, Founder"
                                           value="<?php echo (!empty($existing_application) && isset($existing_application['contact_position'])) ? htmlspecialchars($existing_application['contact_position']) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Email Address</label>
                                    <input type="email" class="form-control" name="contact_email" required 
                                           placeholder="official@company.com"
                                           value="<?php 
                                               if (!empty($existing_application) && isset($existing_application['contact_email'])) {
                                                   echo htmlspecialchars($existing_application['contact_email']);
                                               } else {
                                                   echo htmlspecialchars($user_email);
                                               }
                                           ?>">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Phone Number</label>
                                    <input type="tel" class="form-control" name="contact_phone" required 
                                           placeholder="+1 (555) 123-4567"
                                           value="<?php echo (!empty($existing_application) && isset($existing_application['contact_phone'])) ? htmlspecialchars($existing_application['contact_phone']) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Verification Documents -->
                        <div class="form-section">
                            <h3 class="section-title">Verification Documents</h3>
                            <p class="text-muted mb-4">Upload documents for verification. All documents are kept confidential.</p>
                            
                            <div class="mb-4">
                                <label class="form-label required-field">Company Registration Proof</label>
                                <div class="file-upload-area" onclick="document.getElementById('registrationProof').click()">
                                    <i class="fas fa-file-pdf"></i>
                                    <h5>Upload Registration Document</h5>
                                    <p class="text-muted">PDF, JPG, or PNG (Max 5MB)</p>
                                    <input type="file" id="registrationProof" name="registration_proof" 
                                           accept=".pdf,.jpg,.jpeg,.png" style="display: none;" required>
                                    <div id="registrationProofPreview" class="uploaded-file d-none">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span id="registrationProofName"></span>
                                        <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeFile('registrationProof')">Remove</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Tax Identification Document (Optional)</label>
                                <div class="file-upload-area" onclick="document.getElementById('taxDocument').click()">
                                    <i class="fas fa-file-invoice"></i>
                                    <h5>Upload Tax Document</h5>
                                    <p class="text-muted">PDF, JPG, or PNG (Max 5MB)</p>
                                    <input type="file" id="taxDocument" name="tax_document" 
                                           accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                    <div id="taxDocumentPreview" class="uploaded-file d-none">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span id="taxDocumentName"></span>
                                        <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeFile('taxDocument')">Remove</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Additional Documents (Optional)</label>
                                <div class="file-upload-area" onclick="document.getElementById('additionalDocs').click()">
                                    <i class="fas fa-file-archive"></i>
                                    <h5>Upload Additional Documents</h5>
                                    <p class="text-muted">PDF, JPG, or PNG (Max 10MB)</p>
                                    <input type="file" id="additionalDocs" name="additional_docs[]" 
                                           accept=".pdf,.jpg,.jpeg,.png" style="display: none;" multiple>
                                    <div id="additionalDocsPreview" class="uploaded-file d-none">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span id="additionalDocsCount"></span> file(s) selected
                                        <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeFile('additionalDocs')">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Posting Package -->
                        <div class="form-section">
                            <h3 class="section-title">Select Job Posting Package</h3>
                            <p class="text-muted mb-4">Choose a package that fits your hiring needs</p>
                            
                            <div class="row">
                                <?php foreach ($packages as $index => $package): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="package-card <?php echo (isset($package['package_name']) && $package['package_name'] === 'standard') ? 'recommended' : ''; ?>" 
                                         onclick="selectPackage('<?php echo isset($package['package_name']) ? $package['package_name'] : 'standard'; ?>')" 
                                         id="package<?php echo isset($package['package_name']) ? ucfirst($package['package_name']) : 'Standard'; ?>">
                                        <h5><?php echo isset($package['package_name']) ? ucfirst($package['package_name']) : 'Standard'; ?></h5>
                                        <div class="package-price">$<?php echo isset($package['price']) ? number_format($package['price'], 2) : '99.00'; ?></div>
                                        <p class="text-muted">per month</p>
                                        <ul class="package-features">
                                            <li><i class="fas fa-check"></i> <?php echo isset($package['job_posts']) ? $package['job_posts'] : '3'; ?> Active Job Post<?php echo (isset($package['job_posts']) && $package['job_posts'] > 1) ? 's' : ''; ?></li>
                                            <li><i class="fas fa-check"></i> <?php echo isset($package['listing_days']) ? $package['listing_days'] : '30'; ?> Days Listing</li>
                                            <li><i class="fas fa-check"></i> <?php echo (isset($package['applications_limit']) && $package['applications_limit']) ? $package['applications_limit'] . ' Applications Limit' : 'Unlimited Applications'; ?></li>
                                            <li><i class="fas <?php echo (isset($package['has_featured_tag']) && $package['has_featured_tag']) ? 'fa-check' : 'fa-times text-muted'; ?>"></i> Featured Job Tag</li>
                                            <li><i class="fas <?php echo (isset($package['has_priority_support']) && $package['has_priority_support']) ? 'fa-check' : 'fa-times text-muted'; ?>"></i> Priority Support</li>
                                        </ul>
                                        <div class="text-center">
                                            <button type="button" class="btn <?php echo (isset($package['package_name']) && $package['package_name'] === 'standard') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                                                Select <?php echo isset($package['package_name']) ? ucfirst($package['package_name']) : 'Standard'; ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <input type="hidden" name="selected_package" id="selectedPackage" value="standard">
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">
                                    I agree to the <a href="terms.php" class="text-primary">Terms of Service</a> and <a href="privacy.php" class="text-primary">Privacy Policy</a>
                                </label>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted me-2">Already have an account?</span>
                                    <a href="login.php?type=company" class="text-primary">Company Login</a>
                                </div>
                                <button type="submit" class="btn-primary btn-lg" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Sidebar Benefits -->
                <div class="col-lg-4">
                    <div class="verification-badge">
                        <i class="fas fa-shield-alt"></i> Verified Companies Only
                    </div>
                    
                    <div class="company-benefits">
                        <h3 class="text-white mb-4">Benefits for Verified Companies</h3>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="benefit-content">
                                <h5>Access to Student Talent</h5>
                                <p>Connect with 15,000+ verified student candidates</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="benefit-content">
                                <h5>Targeted Job Listings</h5>
                                <p>Post jobs specifically targeting student skills and availability</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="benefit-content">
                                <h5>Performance Analytics</h5>
                                <p>Track applications and candidate engagement metrics</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="benefit-content">
                                <h5>Dedicated Support</h5>
                                <p>Get assistance from our hiring experts</p>
                            </div>
                        </div>
                        
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="benefit-content">
                                <h5>Trust Badge</h5>
                                <p>Display verified status to attract more candidates</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="form-section mt-4">
                        <h4 class="mb-3" style="color: var(--luxury-blue);">Quick Stats</h4>
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <h3 class="text-primary">15K+</h3>
                                <p class="text-muted mb-0">Students</p>
                            </div>
                            <div class="col-6 mb-3">
                                <h3 class="text-primary">85%</h3>
                                <p class="text-muted mb-0">Response Rate</p>
                            </div>
                            <div class="col-6">
                                <h3 class="text-primary">48h</h3>
                                <p class="text-muted mb-0">Avg. Verification</p>
                            </div>
                            <div class="col-6">
                                <h3 class="text-primary">4.8★</h3>
                                <p class="text-muted mb-0">Company Rating</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Support Card -->
                    <div class="form-section mt-4">
                        <div class="text-center">
                            <i class="fas fa-headset fa-3x mb-3" style="color: var(--luxury-blue);"></i>
                            <h5>Need Help?</h5>
                            <p class="text-muted">Our team is here to assist with the verification process</p>
                            <a href="contact.php?type=company" class="btn-outline-primary w-100">
                                <i class="fas fa-envelope me-2"></i>Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php'; ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
    // Package Selection
    let selectedPackage = 'standard';
    
    function selectPackage(packageType) {
        selectedPackage = packageType;
        document.getElementById('selectedPackage').value = packageType;
        
        // Remove selected class from all packages
        document.querySelectorAll('.package-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Add selected class to chosen package
        const selectedCard = document.getElementById('package' + packageType.charAt(0).toUpperCase() + packageType.slice(1));
        if (selectedCard) {
            selectedCard.classList.add('selected');
        }
        
        // Update button styles
        document.querySelectorAll('.package-card .btn').forEach(btn => {
            btn.className = 'btn btn-outline-primary';
        });
        
        const selectedBtn = selectedCard ? selectedCard.querySelector('.btn') : null;
        if (selectedBtn) {
            selectedBtn.className = 'btn btn-primary';
        }
    }
    
    // File Upload Handling
    document.getElementById('registrationProof').addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const fileName = this.files[0].name;
            document.getElementById('registrationProofName').textContent = fileName;
            document.getElementById('registrationProofPreview').classList.remove('d-none');
        }
    });
    
    document.getElementById('taxDocument').addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const fileName = this.files[0].name;
            document.getElementById('taxDocumentName').textContent = fileName;
            document.getElementById('taxDocumentPreview').classList.remove('d-none');
        }
    });
    
    document.getElementById('additionalDocs').addEventListener('change', function(e) {
        if (this.files.length > 0) {
            document.getElementById('additionalDocsCount').textContent = this.files.length;
            document.getElementById('additionalDocsPreview').classList.remove('d-none');
        }
    });
    
    function removeFile(fileType) {
        const input = document.getElementById(fileType);
        const preview = document.getElementById(fileType + 'Preview');
        
        input.value = '';
        preview.classList.add('d-none');
    }
    
    // Show alert message
    function showAlert(message, type = 'success') {
        const alertDiv = document.getElementById('alertMessage');
        const alertText = document.getElementById('alertText');
        const alert = alertDiv.querySelector('.alert');
        
        alert.classList.remove('alert-success', 'alert-danger', 'alert-warning', 'alert-info');
        
        if (type === 'success') {
            alert.classList.add('alert-success');
        } else if (type === 'error') {
            alert.classList.add('alert-danger');
        } else if (type === 'warning') {
            alert.classList.add('alert-warning');
        } else {
            alert.classList.add('alert-info');
        }
        
        alertText.textContent = message;
        alertDiv.style.display = 'block';
        
        // Auto hide after 5 seconds
        setTimeout(hideAlert, 5000);
    }
    
    function hideAlert() {
        document.getElementById('alertMessage').style.display = 'none';
    }
    
    // Form Submission with AJAX
    document.getElementById('companyApplicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Check if registration proof is uploaded
        const regProof = document.getElementById('registrationProof');
        if (regProof.files.length === 0) {
            isValid = false;
            showAlert('Please upload company registration proof', 'error');
            return;
        }
        
        // Check terms
        if (!document.getElementById('termsCheck').checked) {
            isValid = false;
            showAlert('Please agree to the terms and conditions', 'error');
            return;
        }
        
        if (!isValid) {
            showAlert('Please fill in all required fields', 'error');
            return;
        }
        
        // Show loading state
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitBtn.disabled = true;
        
        // Create FormData object for file upload
        const formData = new FormData(this);
        
        // AJAX submission
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                // Optional: redirect to success page
                setTimeout(() => {
                    window.location.href = 'application-success.php?type=company&id=' + data.application_id;
                }, 3000);
            } else {
                showAlert(data.message, 'error');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred. Please try again.', 'error');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
    
    // Initialize with standard package selected
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (!empty($packages)): ?>
        selectPackage('standard');
        <?php endif; ?>
    });
    </script>
</body>
</html>