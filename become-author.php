<?php
session_start();

// Check if user is logged in (this should be replaced with your actual authentication)
$isLoggedIn = isset($_SESSION['user_id']) ? true : false;
$userName = $isLoggedIn ? ($_SESSION['user_name'] ?? 'User') : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become an Author - StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Your Main CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/become-author.css">
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Notification Container -->
    <div id="notificationContainer"></div>
    
    <!-- Main Content -->
    <div class="become-author-page">
        <div class="container author-container">
            <!-- Progress Steps -->
            <div class="author-progress">
                <div class="progress-steps">
                    <div class="progress-step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Account Setup</div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Expertise & Bio</div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Verification</div>
                    </div>
                    <div class="progress-step" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-label">Complete</div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="author-content">
                <!-- Header -->
                <div class="author-header">
                    <h1>Become an Author</h1>
                    <p>Share your knowledge with the student community. Complete the steps below to start writing.</p>
                </div>
                
                <!-- Step 1: Account Setup -->
                <div class="step-content active" id="step1">
                    <h2 class="step-title">Account Setup</h2>
                    <p class="step-description">Let's set up your author profile. This information will be displayed on your articles.</p>
                    
                    <form id="accountSetupForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fullName">Full Name *</label>
                                    <input type="text" class="form-control-custom" id="fullName" name="fullName" 
                                           value="<?php echo $isLoggedIn ? $userName : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email Address *</label>
                                    <input type="email" class="form-control-custom" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="username">Username *</label>
                                    <input type="text" class="form-control-custom" id="username" name="username" required>
                                    <small class="text-muted">This will be your unique author handle</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="profileImage">Profile Image</label>
                                    <input type="file" class="form-control-custom" id="profileImage" name="profileImage" accept="image/*">
                                    <small class="text-muted">Recommended: 400x400px, JPG/PNG</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="socialLinks">Social Media Links (Optional)</label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control-custom" placeholder="Twitter URL" name="twitter">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control-custom" placeholder="LinkedIn URL" name="linkedin">
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button type="button" class="btn-author btn-author-secondary" disabled>
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button type="submit" class="btn-author btn-author-primary" id="nextStep1">
                                Next Step <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Step 2: Expertise & Bio -->
                <div class="step-content" id="step2">
                    <h2 class="step-title">Expertise & Bio</h2>
                    <p class="step-description">Tell us about your expertise and write a compelling bio for readers.</p>
                    
                    <form id="expertiseForm">
                        <div class="form-group">
                            <label class="form-label">Select Your Expertise Areas *</label>
                            <p class="text-muted mb-3">Choose up to 3 areas you're most experienced in</p>
                            
                            <div class="expertise-grid" id="expertiseGrid">
                                <div class="expertise-card" data-expertise="web_development">
                                    <div class="expertise-icon">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="expertise-name">Web Development</div>
                                </div>
                                
                                <div class="expertise-card" data-expertise="mobile_development">
                                    <div class="expertise-icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="expertise-name">Mobile Development</div>
                                </div>
                                
                                <div class="expertise-card" data-expertise="data_science">
                                    <div class="expertise-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="expertise-name">Data Science</div>
                                </div>
                                
                                <div class="expertise-card" data-expertise="design">
                                    <div class="expertise-icon">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <div class="expertise-name">UI/UX Design</div>
                                </div>
                                
                                <div class="expertise-card" data-expertise="devops">
                                    <div class="expertise-icon">
                                        <i class="fas fa-server"></i>
                                    </div>
                                    <div class="expertise-name">DevOps</div>
                                </div>
                                
                                <div class="expertise-card" data-expertise="cybersecurity">
                                    <div class="expertise-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="expertise-name">Cybersecurity</div>
                                </div>
                            </div>
                            
                            <input type="hidden" id="selectedExpertise" name="expertise">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="authorBio">Author Bio *</label>
                            <textarea class="form-control-custom" id="authorBio" name="bio" rows="4" 
                                      placeholder="Tell readers about your background, experience, and what you're passionate about..." required></textarea>
                            <small class="text-muted">Minimum 150 characters, maximum 500 characters</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="writingStyle">Writing Style & Focus</label>
                            <textarea class="form-control-custom" id="writingStyle" name="writingStyle" rows="3"
                                      placeholder="Describe your writing style and the topics you plan to cover..."></textarea>
                        </div>
                        
                        <div class="action-buttons">
                            <button type="button" class="btn-author btn-author-secondary" id="prevStep2">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button type="submit" class="btn-author btn-author-primary" id="nextStep2">
                                Next Step <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Step 3: Verification -->
                <div class="step-content" id="step3">
                    <h2 class="step-title">Verification</h2>
                    <p class="step-description">Help us verify your identity and expertise to maintain quality content.</p>
                    
                    <form id="verificationForm">
                        <div class="form-group">
                            <label class="form-label">Verification Documents</label>
                            <p class="text-muted mb-3">Upload at least one document to verify your identity or expertise</p>
                            
                            <div class="file-upload-area" id="documentUploadArea">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="file-upload-text">
                                    Drag & drop your files here or click to browse
                                </div>
                                <div class="file-upload-hint">
                                    Supported formats: PDF, JPG, PNG (Max 5MB each)
                                </div>
                                <input type="file" id="verificationDocument" name="verificationDocument" 
                                       accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                            </div>
                            
                            <div id="documentPreview" style="display: none;">
                                <div class="file-preview">
                                    <div class="file-preview-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="file-info">
                                        <div class="file-name" id="documentName"></div>
                                        <div class="file-size" id="documentSize"></div>
                                    </div>
                                    <button type="button" class="btn-author btn-author-secondary btn-sm" onclick="removeDocument()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="portfolioLink">Portfolio Link</label>
                            <input type="url" class="form-control-custom" id="portfolioLink" name="portfolioLink" 
                                   placeholder="https://yourportfolio.com">
                            <small class="text-muted">Link to your GitHub, personal website, or portfolio</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="sampleArticle">Sample Article (Optional)</label>
                            <textarea class="form-control-custom" id="sampleArticle" name="sampleArticle" rows="5"
                                      placeholder="Paste a sample of your writing or article idea..."></textarea>
                        </div>
                        
                        <div class="checkbox-group">
                            <h6>Author Agreement</h6>
                            <div class="checkbox-item">
                                <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                                <label for="agreeTerms">
                                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Content Guidelines</a>
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="agreeOriginal" name="agreeOriginal" required>
                                <label for="agreeOriginal">
                                    I confirm that all submitted content will be original and not plagiarized
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="agreeQuality" name="agreeQuality" required>
                                <label for="agreeQuality">
                                    I agree to maintain high-quality, accurate, and helpful content for students
                                </label>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button type="button" class="btn-author btn-author-secondary" id="prevStep3">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button type="submit" class="btn-author btn-author-primary" id="submitVerification">
                                <span class="submit-text">Submit for Review</span>
                                <span class="loading-text" style="display: none;">
                                    <span class="loading-spinner"></span> Processing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Step 4: Complete -->
                <div class="step-content" id="step4">
                    <div class="success-state">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2 class="success-title">Application Submitted!</h2>
                        <p class="success-message">
                            Thank you for your interest in becoming an author. Our team will review your application 
                            within 2-3 business days. You'll receive an email notification once your application is processed.
                        </p>
                        
                        <div class="action-buttons" style="justify-content: center; border-top: none;">
                            <a href="dashboard.php" class="btn-author btn-author-primary">
                                <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                            </a>
                            <a href="articles.php" class="btn-author btn-author-secondary">
                                <i class="fas fa-book"></i> Browse Articles
                            </a>
                        </div>
                        
                        <div class="mt-4">
                            <h5 class="text-center mb-3">What's Next?</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="text-center">
                                        <div class="step-number mb-2">1</div>
                                        <p>Application Review</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="text-center">
                                        <div class="step-number mb-2">2</div>
                                        <p>Welcome Email</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="text-center">
                                        <div class="step-number mb-2">3</div>
                                        <p>Start Writing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- jQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Check if user is logged in
        <?php if (!$isLoggedIn): ?>
        showNotification('Please login to become an author.', 'error');
        setTimeout(() => {
            window.location.href = 'login.php?redirect=become-author.php';
        }, 2000);
        <?php endif; ?>
        
        // Current step tracking
        let currentStep = 1;
        const totalSteps = 4;
        let formData = {};
        
        // Initialize progress steps
        updateProgressSteps();
        
        // Update progress steps
        function updateProgressSteps() {
            $('.progress-step').removeClass('active completed');
            
            for (let i = 1; i <= currentStep; i++) {
                if (i < currentStep) {
                    $(`.progress-step[data-step="${i}"]`).addClass('completed');
                } else {
                    $(`.progress-step[data-step="${i}"]`).addClass('active');
                }
            }
            
            // Show current step content
            $('.step-content').removeClass('active');
            $(`#step${currentStep}`).addClass('active');
        }
        
        // Go to specific step
        function goToStep(step) {
            if (step >= 1 && step <= totalSteps) {
                currentStep = step;
                updateProgressSteps();
                window.scrollTo(0, 0);
            }
        }
        
        // Show notification
        function showNotification(message, type = 'info') {
            const notification = $(`
                <div class="notification ${type} show">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                        <div>${message}</div>
                    </div>
                </div>
            `);
            
            $('#notificationContainer').append(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
        
        // Step 1: Account Setup
        $('#accountSetupForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const fullName = $('#fullName').val().trim();
            const email = $('#email').val().trim();
            const username = $('#username').val().trim();
            
            if (!fullName || !email || !username) {
                showNotification('Please fill in all required fields.', 'error');
                return;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showNotification('Please enter a valid email address.', 'error');
                return;
            }
            
            // Validate username
            if (username.length < 3) {
                showNotification('Username must be at least 3 characters long.', 'error');
                return;
            }
            
            // Save form data
            formData.step1 = {
                fullName: fullName,
                email: email,
                username: username,
                twitter: $('input[name="twitter"]').val().trim(),
                linkedin: $('input[name="linkedin"]').val().trim(),
                profileImage: $('#profileImage')[0].files[0] || null
            };
            
            // Check username availability
            $('#nextStep1').prop('disabled', true).html('<span class="loading-spinner"></span> Checking...');
            
            $.ajax({
                url: 'ajax/check_username.php',
                type: 'POST',
                data: { username: username },
                success: function(response) {
                    if (response.available) {
                        goToStep(2);
                        showNotification('Account setup completed!', 'success');
                    } else {
                        showNotification('Username is already taken. Please choose another.', 'error');
                    }
                },
                error: function() {
                    showNotification('Error checking username. Please try again.', 'error');
                },
                complete: function() {
                    $('#nextStep1').prop('disabled', false).html('Next Step <i class="fas fa-arrow-right"></i>');
                }
            });
        });
        
        // Step 2: Expertise Selection
        const selectedExpertise = [];
        
        // Handle expertise selection
        $('.expertise-card').on('click', function() {
            const expertise = $(this).data('expertise');
            
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                const index = selectedExpertise.indexOf(expertise);
                if (index > -1) selectedExpertise.splice(index, 1);
            } else {
                if (selectedExpertise.length >= 3) {
                    showNotification('You can select up to 3 expertise areas.', 'info');
                    return;
                }
                $(this).addClass('selected');
                selectedExpertise.push(expertise);
            }
            
            $('#selectedExpertise').val(selectedExpertise.join(','));
        });
        
        // Step 2 form submission
        $('#expertiseForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const expertise = selectedExpertise;
            const bio = $('#authorBio').val().trim();
            
            if (expertise.length === 0) {
                showNotification('Please select at least one expertise area.', 'error');
                return;
            }
            
            if (!bio || bio.length < 150) {
                showNotification('Please write a bio of at least 150 characters.', 'error');
                return;
            }
            
            if (bio.length > 500) {
                showNotification('Bio should not exceed 500 characters.', 'error');
                return;
            }
            
            // Save form data
            formData.step2 = {
                expertise: expertise,
                bio: bio,
                writingStyle: $('#writingStyle').val().trim()
            };
            
            goToStep(3);
            showNotification('Expertise & bio saved!', 'success');
        });
        
        // Step 3: File Upload
        $('#documentUploadArea').on('click', function() {
            $('#verificationDocument').click();
        });
        
        $('#verificationDocument').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showNotification('File size should not exceed 5MB.', 'error');
                    $(this).val('');
                    return;
                }
                
                // Check file type
                const validTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    showNotification('Please upload PDF, JPG, or PNG files only.', 'error');
                    $(this).val('');
                    return;
                }
                
                // Show preview
                $('#documentName').text(file.name);
                $('#documentSize').text(formatFileSize(file.size));
                $('#documentPreview').show();
            }
        });
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        window.removeDocument = function() {
            $('#verificationDocument').val('');
            $('#documentPreview').hide();
        };
        
        // Drag and drop for file upload
        $('#documentUploadArea').on('dragover', function(e) {
            e.preventDefault();
            $(this).css({
                'border-color': 'var(--primary-color)',
                'background': 'rgba(10, 36, 99, 0.05)'
            });
        });
        
        $('#documentUploadArea').on('dragleave', function(e) {
            e.preventDefault();
            $(this).css({
                'border-color': 'var(--border-color)',
                'background': '#f8f9fa'
            });
        });
        
        $('#documentUploadArea').on('drop', function(e) {
            e.preventDefault();
            $(this).css({
                'border-color': 'var(--border-color)',
                'background': '#f8f9fa'
            });
            
            const file = e.originalEvent.dataTransfer.files[0];
            if (file) {
                $('#verificationDocument')[0].files = e.originalEvent.dataTransfer.files;
                $('#verificationDocument').trigger('change');
            }
        });
        
        // Step 3 form submission (Final submission)
        $('#verificationForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const document = $('#verificationDocument')[0].files[0];
            const agreeTerms = $('#agreeTerms').is(':checked');
            const agreeOriginal = $('#agreeOriginal').is(':checked');
            const agreeQuality = $('#agreeQuality').is(':checked');
            
            if (!document) {
                showNotification('Please upload a verification document.', 'error');
                return;
            }
            
            if (!agreeTerms || !agreeOriginal || !agreeQuality) {
                showNotification('Please agree to all terms and conditions.', 'error');
                return;
            }
            
            // Prepare form data for AJAX submission
            const submitData = new FormData();
            
            // Add all collected form data
            submitData.append('step1', JSON.stringify(formData.step1));
            submitData.append('step2', JSON.stringify(formData.step2));
            submitData.append('portfolioLink', $('#portfolioLink').val().trim());
            submitData.append('sampleArticle', $('#sampleArticle').val().trim());
            submitData.append('agreeTerms', agreeTerms);
            submitData.append('agreeOriginal', agreeOriginal);
            submitData.append('agreeQuality', agreeQuality);
            
            // Add file
            submitData.append('verificationDocument', document);
            
            // Show loading state
            const submitBtn = $('#submitVerification');
            submitBtn.prop('disabled', true);
            submitBtn.find('.submit-text').hide();
            submitBtn.find('.loading-text').show();
            
            // AJAX submission
            $.ajax({
                url: 'ajax/submit_author_application.php',
                type: 'POST',
                data: submitData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Mark step 3 as completed
                        $('.progress-step[data-step="3"]').addClass('completed');
                        
                        // Go to step 4 (success)
                        goToStep(4);
                        
                        // Show success message
                        showNotification(response.message || 'Application submitted successfully!', 'success');
                        
                        // Store application ID if provided
                        if (response.applicationId) {
                            localStorage.setItem('authorApplicationId', response.applicationId);
                        }
                    } else {
                        showNotification(response.message || 'Error submitting application. Please try again.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    showNotification('Network error. Please check your connection and try again.', 'error');
                    console.error('AJAX Error:', error);
                },
                complete: function() {
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.submit-text').show();
                    submitBtn.find('.loading-text').hide();
                }
            });
        });
        
        // Navigation buttons
        $('#prevStep2').on('click', function() {
            goToStep(1);
        });
        
        $('#prevStep3').on('click', function() {
            goToStep(2);
        });
        
        // Auto-save form data on input change
        $('input, textarea').on('blur', function() {
            const step = currentStep;
            const fieldName = $(this).attr('name');
            const value = $(this).val();
            
            if (fieldName && step) {
                if (!formData[`step${step}`]) {
                    formData[`step${step}`] = {};
                }
                formData[`step${step}`][fieldName] = value;
                
                // Auto-save to localStorage
                localStorage.setItem('authorApplicationData', JSON.stringify(formData));
            }
        });
        
        // Load saved data from localStorage
        const savedData = localStorage.getItem('authorApplicationData');
        if (savedData) {
            try {
                const parsedData = JSON.parse(savedData);
                formData = parsedData;
                
                // Populate form fields if available
                if (formData.step1) {
                    $('#fullName').val(formData.step1.fullName || '');
                    $('#email').val(formData.step1.email || '');
                    $('#username').val(formData.step1.username || '');
                    $('input[name="twitter"]').val(formData.step1.twitter || '');
                    $('input[name="linkedin"]').val(formData.step1.linkedin || '');
                }
                
                if (formData.step2) {
                    $('#authorBio').val(formData.step2.bio || '');
                    $('#writingStyle').val(formData.step2.writingStyle || '');
                    
                    // Restore expertise selection
                    if (formData.step2.expertise && Array.isArray(formData.step2.expertise)) {
                        formData.step2.expertise.forEach(expertise => {
                            $(`.expertise-card[data-expertise="${expertise}"]`).addClass('selected');
                            if (!selectedExpertise.includes(expertise)) {
                                selectedExpertise.push(expertise);
                            }
                        });
                        $('#selectedExpertise').val(selectedExpertise.join(','));
                    }
                }
                
                if (formData.step3) {
                    $('#portfolioLink').val(formData.step3.portfolioLink || '');
                    $('#sampleArticle').val(formData.step3.sampleArticle || '');
                }
            } catch (e) {
                console.error('Error loading saved data:', e);
            }
        }
        
        // Clear saved data when application is complete
        $('body').on('click', 'a[href="dashboard.php"], a[href="articles.php"]', function() {
            localStorage.removeItem('authorApplicationData');
        });
    });
    </script>
</body>
</html>