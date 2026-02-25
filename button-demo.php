<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button & Section Demo - StudentsArea</title>
    
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
            <h1 class="section-title text-white">Button & Section Demo</h1>
            <p class="section-subtitle">See all available button styles and section layouts</p>
        </div>
    </section>
    
    <!-- Button Styles Demo -->
    <section class="section section-secondary">
        <div class="container">
            <h2 class="section-title text-center">Button Styles</h2>
            <p class="section-subtitle text-center">Reusable button classes for your entire website</p>
            
            <!-- Primary Buttons -->
            <div class="mb-5">
                <h4 class="mb-3" style="color: var(--luxury-blue);">Primary Buttons</h4>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#" class="btn-primary">Primary Button</a>
                    <a href="#" class="btn-primary btn-sm">Small Primary</a>
                    <a href="#" class="btn-primary btn-lg">Large Primary</a>
                </div>
                <pre class="mt-3 p-3" style="background: #f5f5f5; border-radius: 4px;"><code>&lt;a href="#" class="btn-primary"&gt;Primary Button&lt;/a&gt;
&lt;a href="#" class="btn-primary btn-sm"&gt;Small Primary&lt;/a&gt;
&lt;a href="#" class="btn-primary btn-lg"&gt;Large Primary&lt;/a&gt;</code></pre>
            </div>
            
            <!-- Secondary Buttons -->
            <div class="mb-5">
                <h4 class="mb-3" style="color: var(--luxury-blue);">Secondary Buttons (Gold)</h4>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#" class="btn-secondary">Secondary Button</a>
                    <a href="#" class="btn-secondary btn-sm">Small Secondary</a>
                    <a href="#" class="btn-secondary btn-lg">Large Secondary</a>
                </div>
                <pre class="mt-3 p-3" style="background: #f5f5f5; border-radius: 4px;"><code>&lt;a href="#" class="btn-secondary"&gt;Secondary Button&lt;/a&gt;
&lt;a href="#" class="btn-secondary btn-sm"&gt;Small Secondary&lt;/a&gt;
&lt;a href="#" class="btn-secondary btn-lg"&gt;Large Secondary&lt;/a&gt;</code></pre>
            </div>
            
            <!-- Outline Buttons -->
            <div class="mb-5">
                <h4 class="mb-3" style="color: var(--luxury-blue);">Outline Buttons</h4>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#" class="btn-outline-primary">Outline Primary</a>
                    <a href="#" class="btn-outline-secondary">Outline Secondary</a>
                    <a href="#" class="btn-outline-primary btn-sm">Small Outline</a>
                    <a href="#" class="btn-outline-primary btn-lg">Large Outline</a>
                </div>
                <pre class="mt-3 p-3" style="background: #f5f5f5; border-radius: 4px;"><code>&lt;a href="#" class="btn-outline-primary"&gt;Outline Primary&lt;/a&gt;
&lt;a href="#" class="btn-outline-secondary"&gt;Outline Secondary&lt;/a&gt;</code></pre>
            </div>
            
            <!-- Light Buttons -->
            <div class="mb-5">
                <h4 class="mb-3" style="color: var(--luxury-blue);">Light Buttons (For Dark Backgrounds)</h4>
                <div class="p-4" style="background: var(--luxury-blue); border-radius: 8px;">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn-light">Light Button</a>
                        <a href="#" class="btn-light btn-sm">Small Light</a>
                        <a href="#" class="btn-light btn-lg">Large Light</a>
                    </div>
                </div>
                <pre class="mt-3 p-3" style="background: #f5f5f5; border-radius: 4px;"><code>&lt;a href="#" class="btn-light"&gt;Light Button&lt;/a&gt;</code></pre>
            </div>
        </div>
    </section>
    
    <!-- Section Styles Demo -->
    <section class="section section-cream">
        <div class="container">
            <h2 class="section-title text-center">Section Layouts</h2>
            <p class="section-subtitle text-center">Pre-styled section classes for consistent design</p>
            
            <!-- Section Classes Code -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card-custom text-center" style="background: var(--luxury-blue); color: white;">
                        <h4 class="mb-3" style="color: var(--gold-accent);">Primary Section</h4>
                        <p style="color: rgba(255,255,255,0.9);">Dark blue background with white text</p>
                        <code style="background: rgba(0,0,0,0.2); padding: 0.5rem; display: block; border-radius: 4px;">section-primary</code>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom text-center">
                        <h4 class="mb-3" style="color: var(--luxury-blue);">Secondary Section</h4>
                        <p>White background with dark text</p>
                        <code style="background: #f5f5f5; padding: 0.5rem; display: block; border-radius: 4px;">section-secondary</code>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom text-center" style="background: var(--cream-bg);">
                        <h4 class="mb-3" style="color: var(--luxury-blue);">Cream Section</h4>
                        <p>Cream background with dark text</p>
                        <code style="background: white; padding: 0.5rem; display: block; border-radius: 4px;">section-cream</code>
                    </div>
                </div>
            </div>
            
            <!-- Usage Example -->
            <div class="mt-5">
                <h4 class="mb-3" style="color: var(--luxury-blue);">Section Usage Example</h4>
                <pre class="p-3" style="background: #f5f5f5; border-radius: 4px;"><code>&lt;section class="section section-primary"&gt;
    &lt;div class="container"&gt;
        &lt;h2 class="section-title text-white"&gt;Section Title&lt;/h2&gt;
        &lt;p class="section-subtitle"&gt;Section subtitle text&lt;/p&gt;
        &lt;!-- Your content here --&gt;
    &lt;/div&gt;
&lt;/section&gt;</code></pre>
            </div>
        </div>
    </section>
    
    <!-- Card Demo Section -->
    <section class="section section-secondary">
        <div class="container">
            <h2 class="section-title text-center">Card Components</h2>
            <p class="section-subtitle text-center">Reusable card styles with hover effects</p>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card-custom">
                        <i class="fas fa-rocket fa-3x mb-3" style="color: var(--luxury-blue);"></i>
                        <h3 class="card-title">Fast Performance</h3>
                        <p class="card-text">Lightning-fast load times and smooth interactions for the best user experience.</p>
                        <a href="#" class="btn-primary mt-3">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom">
                        <i class="fas fa-lock fa-3x mb-3" style="color: var(--luxury-blue);"></i>
                        <h3 class="card-title">Secure & Safe</h3>
                        <p class="card-text">Your data is protected with industry-standard encryption and security measures.</p>
                        <a href="#" class="btn-outline-primary mt-3">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom">
                        <i class="fas fa-headset fa-3x mb-3" style="color: var(--luxury-blue);"></i>
                        <h3 class="card-title">24/7 Support</h3>
                        <p class="card-text">Our dedicated support team is always ready to help you succeed.</p>
                        <a href="#" class="btn-secondary mt-3">Contact Us</a>
                    </div>
                </div>
            </div>
            
            <!-- Card Code -->
            <div class="mt-4">
                <h4 class="mb-3" style="color: var(--luxury-blue);">Card Usage Example</h4>
                <pre class="p-3" style="background: #f5f5f5; border-radius: 4px;"><code>&lt;div class="card-custom"&gt;
    &lt;i class="fas fa-icon fa-3x mb-3" style="color: var(--luxury-blue);"&gt;&lt;/i&gt;
    &lt;h3 class="card-title"&gt;Card Title&lt;/h3&gt;
    &lt;p class="card-text"&gt;Card description text goes here.&lt;/p&gt;
    &lt;a href="#" class="btn-primary mt-3"&gt;Button&lt;/a&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>
    </section>
    
    <!-- Color Palette Section -->
    <section class="section section-cream">
        <div class="container">
            <h2 class="section-title text-center">Color Palette</h2>
            <p class="section-subtitle text-center">CSS variables used throughout the design</p>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="p-4 text-center" style="background: var(--luxury-blue); color: white; border-radius: 8px;">
                        <h4 class="mb-2">Luxury Blue</h4>
                        <p class="mb-2">#0a2463</p>
                        <code style="background: rgba(255,255,255,0.2); padding: 0.5rem; display: block; border-radius: 4px;">var(--luxury-blue)</code>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 text-center" style="background: var(--gold-accent); color: var(--luxury-blue); border-radius: 8px;">
                        <h4 class="mb-2">Gold Accent</h4>
                        <p class="mb-2">#a39274</p>
                        <code style="background: rgba(0,0,0,0.1); padding: 0.5rem; display: block; border-radius: 4px;">var(--gold-accent)</code>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 text-center" style="background: var(--cream-bg); border: 1px solid var(--border-light); border-radius: 8px;">
                        <h4 class="mb-2">Cream Background</h4>
                        <p class="mb-2">#f0f2f5</p>
                        <code style="background: white; padding: 0.5rem; display: block; border-radius: 4px;">var(--cream-bg)</code>
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
</body>
</html>