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
    }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Company Application Section -->
    <section class="company-apply-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
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
                    <form id="companyApplicationForm">
                        <!-- Company Details Section -->
                        <div class="form-section">
                            <h3 class="section-title">Company Information</h3>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" required placeholder="Enter official company name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Company Type</label>
                                    <select class="form-select" name="company_type" required>
                                        <option value="">Select company type</option>
                                        <option value="Startup">Startup</option>
                                        <option value="SME">Small & Medium Enterprise</option>
                                        <option value="Corporation">Corporation</option>
                                        <option value="Non-Profit">Non-Profit Organization</option>
                                        <option value="Government">Government Agency</option>
                                        <option value="Educational">Educational Institution</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Industry</label>
                                    <select class="form-select" name="industry" required>
                                        <option value="">Select industry</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Finance">Finance & Banking</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Education">Education</option>
                                        <option value="E-commerce">E-commerce</option>
                                        <option value="Marketing">Marketing & Advertising</option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Consulting">Consulting</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Company Size</label>
                                    <select class="form-select" name="company_size" required>
                                        <option value="">Select company size</option>
                                        <option value="1-10">1-10 employees</option>
                                        <option value="11-50">11-50 employees</option>
                                        <option value="51-200">51-200 employees</option>
                                        <option value="201-500">201-500 employees</option>
                                        <option value="501-1000">501-1000 employees</option>
                                        <option value="1000+">1000+ employees</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Company Website</label>
                                <input type="url" class="form-control" name="website" required placeholder="https://yourcompany.com">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required-field">Company Description</label>
                                <textarea class="form-control" name="description" rows="4" required placeholder="Brief description of your company, products/services, and mission"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Company Address</label>
                                <textarea class="form-control" name="address" rows="3" placeholder="Full company address"></textarea>
                            </div>
                        </div>
                        
                        <!-- Contact Person Details -->
                        <div class="form-section">
                            <h3 class="section-title">Contact Person Details</h3>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Full Name</label>
                                    <input type="text" class="form-control" name="contact_name" required placeholder="Contact person name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Position/Title</label>
                                    <input type="text" class="form-control" name="contact_position" required placeholder="e.g., HR Manager, Founder">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Email Address</label>
                                    <input type="email" class="form-control" name="contact_email" required placeholder="official@company.com">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required-field">Phone Number</label>
                                    <input type="tel" class="form-control" name="contact_phone" required placeholder="+1 (555) 123-4567">
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
                                    <input type="file" id="registrationProof" name="registration_proof" accept=".pdf,.jpg,.jpeg,.png" style="display: none;" required>
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
                                    <input type="file" id="taxDocument" name="tax_document" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
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
                                    <input type="file" id="additionalDocs" name="additional_docs" accept=".pdf,.jpg,.jpeg,.png" style="display: none;" multiple>
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
                                <div class="col-md-4 mb-4">
                                    <div class="package-card" onclick="selectPackage('basic')" id="packageBasic">
                                        <h5>Basic</h5>
                                        <div class="package-price">$49</div>
                                        <p class="text-muted">per month</p>
                                        <ul class="package-features">
                                            <li><i class="fas fa-check"></i> 1 Active Job Post</li>
                                            <li><i class="fas fa-check"></i> 30 Days Listing</li>
                                            <li><i class="fas fa-check"></i> Basic Company Profile</li>
                                            <li><i class="fas fa-check"></i> 50 Applications Limit</li>
                                            <li><i class="fas fa-times text-muted"></i> Featured Job Tag</li>
                                            <li><i class="fas fa-times text-muted"></i> Priority Support</li>
                                        </ul>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-primary">Select Basic</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="package-card recommended" onclick="selectPackage('standard')" id="packageStandard">
                                        <h5>Standard</h5>
                                        <div class="package-price">$99</div>
                                        <p class="text-muted">per month</p>
                                        <ul class="package-features">
                                            <li><i class="fas fa-check"></i> 3 Active Job Posts</li>
                                            <li><i class="fas fa-check"></i> 45 Days Listing</li>
                                            <li><i class="fas fa-check"></i> Enhanced Company Profile</li>
                                            <li><i class="fas fa-check"></i> 150 Applications Limit</li>
                                            <li><i class="fas fa-check"></i> Featured Job Tag</li>
                                            <li><i class="fas fa-times text-muted"></i> Priority Support</li>
                                        </ul>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary">Select Standard</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="package-card" onclick="selectPackage('premium')" id="packagePremium">
                                        <h5>Premium</h5>
                                        <div class="package-price">$199</div>
                                        <p class="text-muted">per month</p>
                                        <ul class="package-features">
                                            <li><i class="fas fa-check"></i> 10 Active Job Posts</li>
                                            <li><i class="fas fa-check"></i> 60 Days Listing</li>
                                            <li><i class="fas fa-check"></i> Premium Company Profile</li>
                                            <li><i class="fas fa-check"></i> Unlimited Applications</li>
                                            <li><i class="fas fa-check"></i> Featured Job Tag</li>
                                            <li><i class="fas fa-check"></i> Priority Support</li>
                                        </ul>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-primary">Select Premium</button>
                                        </div>
                                    </div>
                                </div>
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
                                <button type="submit" class="btn-primary btn-lg">
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
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.min.js"></script>
    
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
        selectedCard.classList.add('selected');
        
        // Update button styles
        document.querySelectorAll('.package-card .btn').forEach(btn => {
            btn.className = 'btn btn-outline-primary';
        });
        
        const selectedBtn = selectedCard.querySelector('.btn');
        selectedBtn.className = 'btn btn-primary';
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
    
    // Form Submission
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
        
        if (!isValid) {
            alert('Please fill in all required fields.');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitBtn.disabled = true;
        
        // Simulate form submission (in real implementation, this would be AJAX)
        setTimeout(() => {
            alert('Application submitted successfully! Our team will review your application within 24-48 hours. You will receive a confirmation email shortly.');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            // In real implementation, redirect to confirmation page
            // window.location.href = 'application-success.php';
        }, 2000);
    });
    
    // Initialize with standard package selected
    document.addEventListener('DOMContentLoaded', function() {
        selectPackage('standard');
    });
    </script>
</body>
</html>