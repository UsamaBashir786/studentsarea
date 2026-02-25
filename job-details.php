<?php
// project-details.php
$pageTitle = "Project Details - Build Your Portfolio";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | StudentsArea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/extra.min.css">
    <!-- Prism.js for code syntax highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    <style>
        /* Project Details Page Specific Styles */
        .project-details-page {
            /* padding-top: 100px; */
            min-height: 100vh;
        }
        
        .project-header {
            background: linear-gradient(135deg, var(--luxury-blue-light) 0%, var(--luxury-blue) 100%);
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 20px 20px;
            color: white;
        }
        
        .project-header-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .project-badge {
            display: inline-block;
            padding: 0.4rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-right: 0.8rem;
            margin-bottom: 1rem;
        }
        
        .badge-beginner {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .badge-intermediate {
            background: linear-gradient(135deg, #ffc107, #ffca2c);
            color: #212529;
        }
        
        .badge-advanced {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .badge-category {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .project-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .project-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .project-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .meta-icon {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .meta-text {
            font-size: 1.1rem;
        }
        
        .project-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        /* Main Content Layout */
        .project-content {
            padding-bottom: 5rem;
        }
        
        .main-content {
            background: var(--section-bg);
            border-radius: 12px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .sidebar-card {
            background: var(--section-bg);
            border-radius: 12px;
            padding: 1.8rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }
        
        .sidebar-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        /* Section Styles */
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--luxury-blue);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gold-accent);
        }
        
        .subsection-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin: 2rem 0 1rem;
        }
        
        .body-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #555;
            margin-bottom: 1.5rem;
        }
        
        .body-text ul, .body-text ol {
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .body-text li {
            margin-bottom: 0.5rem;
        }
        
        /* Skills Tags */
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin: 1.5rem 0 2rem;
        }
        
        .skill-tag-large {
            background: rgba(10, 36, 99, 0.08);
            color: var(--luxury-blue);
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(10, 36, 99, 0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        /* Requirements List */
        .requirements-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
        }
        
        .requirements-list li {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
        }
        
        .requirements-list i {
            color: var(--gold-accent);
            margin-top: 0.3rem;
            flex-shrink: 0;
        }
        
        /* Steps */
        .steps-container {
            margin: 2rem 0;
        }
        
        .step-item {
            margin-bottom: 2.5rem;
            position: relative;
            padding-left: 3rem;
        }
        
        .step-number {
            position: absolute;
            left: 0;
            top: 0;
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--luxury-blue-light), var(--luxury-blue));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .step-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.8rem;
        }
        
        /* Code Block */
        .code-block {
            background: #1a1a1a;
            border-radius: 8px;
            overflow: hidden;
            margin: 2rem 0;
        }
        
        .code-header {
            background: #2d2d2d;
            padding: 0.8rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #444;
        }
        
        .code-language {
            color: #ccc;
            font-size: 0.9rem;
            font-family: monospace;
        }
        
        .copy-btn {
            background: #444;
            color: white;
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .copy-btn:hover {
            background: #555;
        }
        
        .code-content {
            padding: 1.5rem;
            overflow-x: auto;
        }
        
        /* Resource Cards */
        .resource-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .resource-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .resource-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--luxury-blue);
        }
        
        .resource-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.5rem;
        }
        
        .resource-desc {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        /* Action Buttons */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            width: 100%;
            text-align: center;
            border: 2px solid transparent;
        }
        
        .btn-download {
            background: linear-gradient(135deg, var(--luxury-blue), var(--luxury-blue-dark));
            color: white;
        }
        
        .btn-download:hover {
            background: linear-gradient(135deg, var(--luxury-blue-light), var(--luxury-blue));
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.3);
        }
        
        .btn-github {
            background: #333;
            color: white;
        }
        
        .btn-github:hover {
            background: #444;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .btn-demo {
            background: linear-gradient(135deg, var(--gold-accent), #8f7d5f);
            color: var(--luxury-blue);
        }
        
        .btn-demo:hover {
            background: linear-gradient(135deg, #8f7d5f, var(--gold-accent));
            color: var(--luxury-blue);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(163, 146, 116, 0.3);
        }
        
        .btn-youtube {
            background: #ff0000;
            color: white;
        }
        
        .btn-youtube:hover {
            background: #cc0000;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }
        
        /* Related Projects */
        .related-projects {
            background: var(--cream-bg);
            padding: 4rem 0;
        }
        
        .project-card-sm {
            background: var(--section-bg);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .project-card-sm:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .project-card-sm h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--luxury-blue);
            margin-bottom: 0.8rem;
        }
        
        .project-card-sm p {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        .project-card-sm .badge {
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .project-details-page {
                /* padding-top: 80px; */
            }
            
            .project-header {
                padding: 3rem 0;
                border-radius: 0 0 15px 15px;
            }
            
            .project-title {
                font-size: 2.5rem;
            }
            
            .main-content {
                padding: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .project-title {
                font-size: 2rem;
            }
            
            .project-subtitle {
                font-size: 1.1rem;
            }
            
            .project-meta {
                flex-direction: column;
                gap: 1rem;
            }
            
            .project-actions {
                flex-direction: column;
            }
            
            .action-btn {
                width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .main-content {
                padding: 1.5rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php' ?>
    
    <!-- Project Details Page -->
    <div class="project-details-page">
        <!-- Project Header -->
        <section class="project-header">
            <div class="container">
                <div class="project-header-content">
                    <!-- Project Badges -->
                    <div>
                        <span class="project-badge badge-beginner">Beginner</span>
                        <span class="project-badge badge-category">Web Development</span>
                        <span class="project-badge badge-category">E-commerce</span>
                    </div>
                    
                    <!-- Project Title -->
                    <h1 class="project-title">E-commerce Landing Page with Shopping Cart</h1>
                    
                    <!-- Project Subtitle -->
                    <p class="project-subtitle">
                        Build a fully responsive e-commerce product landing page with shopping cart functionality, 
                        product filtering, and checkout simulation using vanilla JavaScript.
                    </p>
                    
                    <!-- Project Meta -->
                    <div class="project-meta">
                        <div class="meta-item">
                            <i class="fas fa-clock meta-icon"></i>
                            <span class="meta-text">Estimated: 4-6 hours</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users meta-icon"></i>
                            <span class="meta-text">2,348 students completed</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar meta-icon"></i>
                            <span class="meta-text">Last updated: March 15, 2024</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-star meta-icon"></i>
                            <span class="meta-text">Rating: 4.8/5 (1,024 reviews)</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons (Header) -->
                    <div class="project-actions">
                        <a href="#" class="action-btn btn-download">
                            <i class="fas fa-download"></i> Download Project Files
                        </a>
                        <a href="https://github.com" target="_blank" class="action-btn btn-github">
                            <i class="fab fa-github"></i> View GitHub Repository
                        </a>
                        <a href="#" class="action-btn btn-demo">
                            <i class="fas fa-external-link-alt"></i> Live Demo
                        </a>
                        <a href="https://youtube.com" target="_blank" class="action-btn btn-youtube">
                            <i class="fab fa-youtube"></i> Video Tutorial
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Project Content -->
        <section class="project-content">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <div class="main-content">
                            <!-- Project Overview -->
                            <section class="mb-5">
                                <h2 class="section-title">Project Overview</h2>
                                <p class="body-text">
                                    In this project, you'll build a modern e-commerce landing page from scratch. 
                                    You'll learn how to create a responsive design that works perfectly on all devices, 
                                    implement shopping cart functionality with JavaScript, add product filtering features, 
                                    and simulate a checkout process.
                                </p>
                                <p class="body-text">
                                    This project is perfect for beginners who want to practice HTML, CSS, and JavaScript 
                                    while building something practical that you can add to your portfolio. By the end, 
                                    you'll have a fully functional e-commerce interface that you can customize and extend.
                                </p>
                            </section>
                            
                            <!-- Skills You'll Learn -->
                            <section class="mb-5">
                                <h2 class="section-title">Skills You'll Practice</h2>
                                <div class="skills-container">
                                    <span class="skill-tag-large">
                                        <i class="fab fa-html5"></i> HTML5
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fab fa-css3-alt"></i> CSS3
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fab fa-js-square"></i> JavaScript
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fas fa-mobile-alt"></i> Responsive Design
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fas fa-shopping-cart"></i> E-commerce Logic
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fas fa-sliders-h"></i> DOM Manipulation
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fas fa-palette"></i> UI/UX Design
                                    </span>
                                    <span class="skill-tag-large">
                                        <i class="fas fa-code-branch"></i> Git & Version Control
                                    </span>
                                </div>
                            </section>
                            
                            <!-- Requirements -->
                            <section class="mb-5">
                                <h2 class="section-title">Prerequisites & Requirements</h2>
                                <p class="body-text">
                                    Before starting this project, make sure you have the following:
                                </p>
                                <ul class="requirements-list">
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>Basic understanding of HTML, CSS, and JavaScript</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>A code editor (VS Code, Sublime Text, or similar)</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>Modern web browser (Chrome, Firefox, Edge)</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>Internet connection for accessing resources</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>Git installed (optional, for version control)</span>
                                    </li>
                                </ul>
                            </section>
                            
                            <!-- Project Structure -->
                            <section class="mb-5">
                                <h2 class="section-title">Project Structure</h2>
                                <p class="body-text">
                                    Your project folder should be organized as follows:
                                </p>
                                
                                <div class="code-block">
                                    <div class="code-header">
                                        <span class="code-language">Project Structure</span>
                                        <button class="copy-btn" onclick="copyCode(this)">
                                            <i class="fas fa-copy me-1"></i> Copy
                                        </button>
                                    </div>
                                    <div class="code-content">
                                        <pre><code class="language-bash">
ecommerce-landing-page/
├── index.html          # Main HTML file
├── style.css           # Main CSS file
├── script.js           # Main JavaScript file
├── assets/
│   ├── images/         # Product images and icons
│   ├── fonts/          # Custom fonts (if any)
│   └── icons/          # SVG icons
├── README.md           # Project documentation
└── LICENSE             # Project license (optional)
                                        </code></pre>
                                    </div>
                                </div>
                            </section>
                            
                            <!-- Step-by-Step Instructions -->
                            <section class="mb-5">
                                <h2 class="section-title">Step-by-Step Instructions</h2>
                                
                                <div class="steps-container">
                                    <!-- Step 1 -->
                                    <div class="step-item">
                                        <div class="step-number">1</div>
                                        <h3 class="step-title">Set Up Project Structure</h3>
                                        <p class="body-text">
                                            Create the basic folder structure and files as shown above. 
                                            Start by creating the HTML skeleton with proper semantic tags.
                                        </p>
                                        <div class="code-block">
                                            <div class="code-header">
                                                <span class="code-language">HTML</span>
                                                <button class="copy-btn" onclick="copyCode(this)">
                                                    <i class="fas fa-copy me-1"></i> Copy
                                                </button>
                                            </div>
                                            <div class="code-content">
                                                <pre><code class="language-html">
&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;E-commerce Landing Page&lt;/title&gt;
    &lt;link rel="stylesheet" href="style.css"&gt;
    &lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;!-- Your code here --&gt;
    &lt;script src="script.js"&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
                                                </code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 2 -->
                                    <div class="step-item">
                                        <div class="step-number">2</div>
                                        <h3 class="step-title">Create the Header & Navigation</h3>
                                        <p class="body-text">
                                            Build a responsive navigation bar with logo, menu items, and shopping cart icon.
                                            Make sure it collapses properly on mobile devices.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 3 -->
                                    <div class="step-item">
                                        <div class="step-number">3</div>
                                        <h3 class="step-title">Design the Hero Section</h3>
                                        <p class="body-text">
                                            Create an eye-catching hero section with a headline, product description, 
                                            call-to-action buttons, and a featured product image.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 4 -->
                                    <div class="step-item">
                                        <div class="step-number">4</div>
                                        <h3 class="step-title">Build Product Grid</h3>
                                        <p class="body-text">
                                            Display products in a responsive grid layout. Each product card should include 
                                            an image, title, description, price, and an "Add to Cart" button.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 5 -->
                                    <div class="step-item">
                                        <div class="step-number">5</div>
                                        <h3 class="step-title">Implement Shopping Cart</h3>
                                        <p class="body-text">
                                            Create a shopping cart sidebar that can be toggled open/closed. 
                                            Implement cart functionality using JavaScript to add/remove items, 
                                            update quantities, and calculate totals.
                                        </p>
                                        <div class="code-block">
                                            <div class="code-header">
                                                <span class="code-language">JavaScript</span>
                                                <button class="copy-btn" onclick="copyCode(this)">
                                                    <i class="fas fa-copy me-1"></i> Copy
                                                </button>
                                            </div>
                                            <div class="code-content">
                                                <pre><code class="language-javascript">
// Shopping cart array
let cart = [];

// Add item to cart
function addToCart(productId, productName, price) {
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: price,
            quantity: 1
        });
    }
    
    updateCartDisplay();
    saveCartToLocalStorage();
}

// Update cart display
function updateCartDisplay() {
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');
    
    let totalItems = 0;
    let totalPrice = 0;
    
    cart.forEach(item => {
        totalItems += item.quantity;
        totalPrice += item.price * item.quantity;
    });
    
    cartCount.textContent = totalItems;
    cartTotal.textContent = `$${totalPrice.toFixed(2)}`;
}
                                                </code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 6 -->
                                    <div class="step-item">
                                        <div class="step-number">6</div>
                                        <h3 class="step-title">Add Product Filtering</h3>
                                        <p class="body-text">
                                            Implement filtering functionality to allow users to filter products by category, 
                                            price range, or rating.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 7 -->
                                    <div class="step-item">
                                        <div class="step-number">7</div>
                                        <h3 class="step-title">Create Checkout Form</h3>
                                        <p class="body-text">
                                            Design a checkout form with validation. Include fields for shipping information, 
                                            payment details, and order summary.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 8 -->
                                    <div class="step-item">
                                        <div class="step-number">8</div>
                                        <h3 class="step-title">Make it Responsive</h3>
                                        <p class="body-text">
                                            Use CSS media queries to ensure your landing page looks great on all devices, 
                                            from mobile phones to desktop computers.
                                        </p>
                                        <div class="code-block">
                                            <div class="code-header">
                                                <span class="code-language">CSS</span>
                                                <button class="copy-btn" onclick="copyCode(this)">
                                                    <i class="fas fa-copy me-1"></i> Copy
                                                </button>
                                            </div>
                                            <div class="code-content">
                                                <pre><code class="language-css">
/* Mobile styles */
@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .nav-menu {
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        display: none;
    }
    
    .nav-menu.active {
        display: flex;
    }
}

/* Tablet styles */
@media (min-width: 769px) and (max-width: 1024px) {
    .product-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
}
                                                </code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 9 -->
                                    <div class="step-item">
                                        <div class="step-number">9</div>
                                        <h3 class="step-title">Test & Debug</h3>
                                        <p class="body-text">
                                            Test your application thoroughly. Check for bugs, test responsiveness, 
                                            and ensure all features work correctly.
                                        </p>
                                    </div>
                                    
                                    <!-- Step 10 -->
                                    <div class="step-item">
                                        <div class="step-number">10</div>
                                        <h3 class="step-title">Deploy & Share</h3>
                                        <p class="body-text">
                                            Deploy your project to GitHub Pages or Netlify. Update your portfolio 
                                            and share your achievement on social media!
                                        </p>
                                    </div>
                                </div>
                            </section>
                            
                            <!-- Challenges & Extensions -->
                            <section class="mb-5">
                                <h2 class="section-title">Bonus Challenges</h2>
                                <p class="body-text">
                                    Ready for more? Try these additional challenges to level up your skills:
                                </p>
                                <ul class="requirements-list">
                                    <li>
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Add user authentication system (signup/login)</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Integrate with a real payment gateway (Stripe/PayPal)</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Implement product search functionality</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Add product reviews and ratings system</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Create an admin panel to manage products</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Convert to a React or Vue.js application</span>
                                    </li>
                                </ul>
                            </section>
                            
                            <!-- Submission Guidelines -->
                            <section>
                                <h2 class="section-title">Submission Guidelines</h2>
                                <p class="body-text">
                                    Once you've completed the project, here's what you should submit:
                                </p>
                                <ol class="body-text">
                                    <li>Your complete source code (zip file or GitHub repository link)</li>
                                    <li>Screenshots of your working application</li>
                                    <li>A brief README explaining your implementation</li>
                                    <li>Link to live demo (if deployed)</li>
                                </ol>
                                <p class="body-text">
                                    Submit your project through our platform to get feedback and earn a completion certificate!
                                </p>
                            </section>
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Download Resources -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Project Resources</h3>
                            
                            <a href="#" class="action-btn btn-download">
                                <i class="fas fa-download"></i> Download All Files (ZIP)
                            </a>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fas fa-file-archive"></i>
                                </div>
                                <h4 class="resource-title">Starter Template</h4>
                                <p class="resource-desc">Basic HTML/CSS/JS structure to get you started quickly</p>
                                <a href="#" class="btn-outline-primary btn-sm">Download <i class="fas fa-download ms-1"></i></a>
                            </div>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <h4 class="resource-title">Product Images</h4>
                                <p class="resource-desc">High-quality product images for your e-commerce site</p>
                                <a href="#" class="btn-outline-primary btn-sm">Download <i class="fas fa-download ms-1"></i></a>
                            </div>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fas fa-font"></i>
                                </div>
                                <h4 class="resource-title">Fonts & Icons</h4>
                                <p class="resource-desc">Custom fonts and SVG icons used in the design</p>
                                <a href="#" class="btn-outline-primary btn-sm">Download <i class="fas fa-download ms-1"></i></a>
                            </div>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <h4 class="resource-title">Design Mockups</h4>
                                <p class="resource-desc">Figma/Adobe XD design files for reference</p>
                                <a href="#" class="btn-outline-primary btn-sm">Download <i class="fas fa-download ms-1"></i></a>
                            </div>
                        </div>
                        
                        <!-- Quick Links -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Quick Links</h3>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fab fa-github"></i>
                                </div>
                                <h4 class="resource-title">GitHub Repository</h4>
                                <p class="resource-desc">Complete source code with documentation</p>
                                <a href="https://github.com" target="_blank" class="btn-github btn-sm w-100">
                                    <i class="fab fa-github me-2"></i> View on GitHub
                                </a>
                            </div>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                                <h4 class="resource-title">Live Demo</h4>
                                <p class="resource-desc">See the finished project in action</p>
                                <a href="#" class="btn-demo btn-sm w-100">
                                    <i class="fas fa-external-link-alt me-2"></i> View Live Demo
                                </a>
                            </div>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fab fa-youtube"></i>
                                </div>
                                <h4 class="resource-title">Video Tutorial</h4>
                                <p class="resource-desc">Step-by-step video guide (2.5 hours)</p>
                                <a href="https://youtube.com" target="_blank" class="btn-youtube btn-sm w-100">
                                    <i class="fab fa-youtube me-2"></i> Watch Tutorial
                                </a>
                            </div>
                            
                            <div class="resource-card">
                                <div class="resource-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h4 class="resource-title">Community Support</h4>
                                <p class="resource-desc">Get help from our student community</p>
                                <a href="#" class="btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-comments me-2"></i> Join Discussion
                                </a>
                            </div>
                        </div>
                        
                        <!-- Project Stats -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Project Statistics</h3>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Completion Rate</span>
                                    <span class="fw-bold">78%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Average Time</span>
                                    <span class="fw-bold">5.2 hours</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Student Rating</span>
                                    <span class="fw-bold">4.8/5</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 96%" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="stat-counter" style="font-size: 1.8rem;">2,348</div>
                                        <div class="stat-label" style="font-size: 0.9rem;">Completed</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-counter" style="font-size: 1.8rem;">1,024</div>
                                        <div class="stat-label" style="font-size: 0.9rem;">Reviews</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-counter" style="font-size: 1.8rem;">89%</div>
                                        <div class="stat-label" style="font-size: 0.9rem;">Satisfaction</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Certificate -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">Earn Certificate</h3>
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="fas fa-certificate fa-4x text-warning"></i>
                                </div>
                                <p class="body-text mb-3">
                                    Complete this project and submit your work to earn a verified certificate that you can add to your portfolio and LinkedIn profile.
                                </p>
                                <a href="#" class="btn-primary w-100">
                                    <i class="fas fa-graduation-cap me-2"></i> Start Project for Certificate
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Related Projects -->
        <section class="related-projects">
            <div class="container">
                <h2 class="section-heading text-center mb-5">
                    Related <span style="color: var(--gold-accent);">Projects</span>
                </h2>
                
                <div class="row g-4">
                    <!-- Related Project 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="project-card-sm">
                            <span class="badge bg-primary mb-2">Web Dev</span>
                            <span class="badge bg-warning text-dark mb-2">Intermediate</span>
                            <h4>Weather Dashboard App</h4>
                            <p>Build a weather app with real-time data using API integration.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted"><i class="fas fa-clock me-1"></i> 3-4 hours</span>
                                <a href="#" class="btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Project 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="project-card-sm">
                            <span class="badge bg-primary mb-2">Web Dev</span>
                            <span class="badge bg-success mb-2">Beginner</span>
                            <h4>Personal Portfolio Website</h4>
                            <p>Create a responsive portfolio website to showcase your projects.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted"><i class="fas fa-clock me-1"></i> 2-3 hours</span>
                                <a href="#" class="btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Project 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="project-card-sm">
                            <span class="badge bg-primary mb-2">Web Dev</span>
                            <span class="badge bg-danger mb-2">Advanced</span>
                            <h4>Task Management System</h4>
                            <p>Full-stack task management app with user authentication.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted"><i class="fas fa-clock me-1"></i> 8-10 hours</span>
                                <a href="#" class="btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <a href="projects.php" class="btn-primary btn-lg">
                        <i class="fas fa-project-diagram me-2"></i> Browse All Projects
                    </a>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Include Footer -->
    <?php include 'includes/footer_v1.php' ?>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Prism.js for syntax highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
    
    <script>
    // Copy code functionality
    function copyCode(button) {
        const codeBlock = button.closest('.code-block').querySelector('code');
        const textArea = document.createElement('textarea');
        textArea.value = codeBlock.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Change button text temporarily
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        button.classList.add('bg-success');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('bg-success');
        }, 2000);
    }
    
    // Project completion tracker
    document.addEventListener('DOMContentLoaded', function() {
        // Mark steps as complete when clicked
        const stepItems = document.querySelectorAll('.step-item');
        
        stepItems.forEach(step => {
            step.addEventListener('click', function() {
                this.classList.toggle('completed');
            });
        });
        
        // Download tracking
        const downloadButtons = document.querySelectorAll('.action-btn');
        
        downloadButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const buttonType = this.classList.contains('btn-download') ? 'download' :
                                 this.classList.contains('btn-github') ? 'github' :
                                 this.classList.contains('btn-demo') ? 'demo' : 'youtube';
                
                console.log(`${buttonType} button clicked`);
                // In a real app, you would send this data to your analytics
            });
        });
        
        // Initialize Prism
        if (typeof Prism !== 'undefined') {
            Prism.highlightAll();
        }
    });
    </script>
</body>
</html>