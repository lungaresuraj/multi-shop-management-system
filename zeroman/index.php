<?php
require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEROMAN - Multi-Shop Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 20px 0;
        }

        .navbar-brand {
            color: white !important;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .nav-link {
            color: white !important;
            margin: 0 15px;
            font-weight: 500;
        }

        .btn-outline-light {
            border-radius: 50px;
            padding: 10px 30px;
        }

        .hero-section {
            padding: 100px 0;
            color: white;
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 40px;
            color: #667eea;
            margin-bottom: 20px;
        }

        .stats-section {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 60px 0;
            color: white;
            border-radius: 20px;
            margin: 50px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 16px;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }
            
            .navbar-nav {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-store me-2"></i>ZEROMAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-3" href="login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light ms-3" href="register.php">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Multi-Shop Management System</h1>
                    <p class="hero-subtitle">Manage multiple shops, inventory, sales, and employees from a single platform. Streamline your business operations with ZEROMAN.</p>
                    <div class="d-flex gap-3">
                        <a href="register.php" class="btn btn-light btn-lg">
                            <i class="fas fa-rocket me-2"></i>Get Started
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-play me-2"></i>Watch Demo
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400" alt="Dashboard Preview" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <div class="container">
        <div class="stats-section">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Active Shops</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Products</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Customers</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">100K+</div>
                        <div class="stat-label">Transactions</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center text-white mb-5">
                <h2 class="display-5 fw-bold">Why Choose ZEROMAN?</h2>
                <p class="lead">Complete solution for multi-shop management</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <h4>Multi-Shop Management</h4>
                        <p>Manage multiple shops from a single dashboard. Add, delete, and monitor all shops efficiently.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <h4>Inventory Control</h4>
                        <p>Track products, manage stock levels, and get low stock alerts for each shop individually.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Sales Analytics</h4>
                        <p>Real-time sales reports, profit analysis, and business insights for better decision making.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Customer Management</h4>
                        <p>Maintain customer database, purchase history, and loyalty programs for each shop.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h4>Billing System</h4>
                        <p>Generate professional invoices, manage payments, and track transactions seamlessly.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Secure & Reliable</h4>
                        <p>Role-based access control, encrypted data, and regular backups for your peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-6 fw-bold text-white mb-4">About ZEROMAN</h2>
                    <p class="text-white-50 mb-4">ZEROMAN is a comprehensive multi-shop management system designed to streamline operations for businesses with multiple retail locations. Our platform provides real-time visibility into inventory, sales, and customer data across all your shops.</p>
                    <ul class="list-unstyled text-white">
                        <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Centralized management</li>
                        <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Real-time synchronization</li>
                        <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Scalable architecture</li>
                        <li class="mb-3"><i class="fas fa-check-circle me-2"></i> 24/7 support</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white p-5 rounded-4">
                        <h4 class="mb-4">Get Started Today</h4>
                        <p class="text-muted mb-4">Join thousands of businesses that trust ZEROMAN for their multi-shop management needs.</p>
                        <a href="register.php" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-rocket me-2"></i>Register Your Shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">ZEROMAN</h5>
                    <p class="text-white-50">Professional multi-shop management system for modern businesses.</p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6 class="mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="#features" class="text-white-50 text-decoration-none">Features</a></li>
                        <li><a href="#about" class="text-white-50 text-decoration-none">About</a></li>
                        <li><a href="#contact" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6 class="mb-3">Contact Info</h6>
                    <ul class="list-unstyled text-white-50">
                        <li><i class="fas fa-envelope me-2"></i> info@zeroman.com</li>
                        <li><i class="fas fa-phone me-2"></i> +1 234 567 8900</li>
                        <li><i class="fas fa-map-marker me-2"></i> 123 Business Ave, Suite 100</li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6 class="mb-3">Follow Us</h6>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="text-white-50">
            <div class="text-center text-white-50">
                <small>&copy; 2024 ZEROMAN. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>