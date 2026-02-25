<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Page Header -->
    <section class="section section-primary">
        <div class="container text-center">
            <h1 class="section-title text-white">Browse Our Courses</h1>
            <p class="section-subtitle">Discover courses that match your interests and goals</p>
        </div>
    </section>
    
    <!-- Courses Grid -->
    <section class="section section-cream">
        <div class="container">
            <div class="row">
                <!-- Course Card 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom">
                        <div style="background: var(--luxury-blue-light); height: 200px; border-radius: 8px 8px 0 0; margin: -2rem -2rem 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-laptop-code fa-4x text-white"></i>
                        </div>
                        <h3 class="card-title">Web Development</h3>
                        <p class="card-text">Master modern web development with HTML, CSS, JavaScript, and popular frameworks.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="color: var(--gold-accent); font-weight: 600;">$49.99</span>
                            <a href="#" class="btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom">
                        <div style="background: var(--luxury-blue-light); height: 200px; border-radius: 8px 8px 0 0; margin: -2rem -2rem 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-line fa-4x text-white"></i>
                        </div>
                        <h3 class="card-title">Data Science</h3>
                        <p class="card-text">Learn data analysis, visualization, and machine learning techniques from experts.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="color: var(--gold-accent); font-weight: 600;">$59.99</span>
                            <a href="#" class="btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom">
                        <div style="background: var(--luxury-blue-light); height: 200px; border-radius: 8px 8px 0 0; margin: -2rem -2rem 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-palette fa-4x text-white"></i>
                        </div>
                        <h3 class="card-title">Graphic Design</h3>
                        <p class="card-text">Develop your creative skills with industry-standard design tools and techniques.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="color: var(--gold-accent); font-weight: 600;">$44.99</span>
                            <a href="#" class="btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 4 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom">
                        <div style="background: var(--luxury-blue-light); height: 200px; border-radius: 8px 8px 0 0; margin: -2rem -2rem 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bullhorn fa-4x text-white"></i>
                        </div>
                        <h3 class="card-title">Digital Marketing</h3>
                        <p class="card-text">Master SEO, social media, content marketing, and digital advertising strategies.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="color: var(--gold-accent); font-weight: 600;">$39.99</span>
                            <a href="#" class="btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 5 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom">
                        <div style="background: var(--luxury-blue-light); height: 200px; border-radius: 8px 8px 0 0; margin: -2rem -2rem 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-mobile-alt fa-4x text-white"></i>
                        </div>
                        <h3 class="card-title">Mobile App Development</h3>
                        <p class="card-text">Build native iOS and Android apps using Swift, Kotlin, and cross-platform frameworks.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="color: var(--gold-accent); font-weight: 600;">$54.99</span>
                            <a href="#" class="btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 6 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom">
                        <div style="background: var(--luxury-blue-light); height: 200px; border-radius: 8px 8px 0 0; margin: -2rem -2rem 1.5rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shield-alt fa-4x text-white"></i>
                        </div>
                        <h3 class="card-title">Cybersecurity</h3>
                        <p class="card-text">Learn ethical hacking, network security, and how to protect digital infrastructure.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="color: var(--gold-accent); font-weight: 600;">$64.99</span>
                            <a href="#" class="btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-5">
                <a href="#" class="btn-outline-primary btn-lg">Load More Courses</a>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="section section-primary">
        <div class="container text-center">
            <h2 class="section-title text-white">Can't Find What You're Looking For?</h2>
            <p class="section-subtitle">Request a course or contact our team for custom learning solutions</p>
            <div class="mt-4">
                <a href="#" class="btn-secondary btn-lg me-3">Request Course</a>
                <a href="#" class="btn-light btn-lg">Contact Us</a>
            </div>
        </div>
    </section>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v2.php' ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.min.js"></script>
</body>
</html>