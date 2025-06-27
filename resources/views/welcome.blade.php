<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LibraryHub - Perpustakaan Digital Modern</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <style>
            :root {
                --primary: #1e5631;
                --primary-light: #2e7d32;
                --primary-dark: #1b4332;
                --secondary: #f8f9fa;
                --accent: #ffc107;
                --text-light: #f8f9fa;
                --text-dark: #212529;
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                color: var(--text-dark);
                background-color: #f9f9f9;
            }
            
            .hero {
                position: relative;
                background: linear-gradient(135deg, rgba(30, 86, 49, 0.95), rgba(27, 67, 50, 0.95)), 
                            url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;
                min-height: 100vh;
                display: flex;
                align-items: center;
                color: var(--text-light);
                overflow: hidden;
            }
            
            .hero::after {
                content: '';
                position: absolute;
                bottom: -50px;
                left: 0;
                width: 100%;
                height: 100px;
                background: #f9f9f9;
                clip-path: ellipse(50% 50% at 50% 50%);
            }
            
            .hero-content {
                position: relative;
                z-index: 2;
            }
            
            .logo-large {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 1.5rem;
                display: flex;
                align-items: center;
            }
            
            .logo-icon {
                font-size: 3rem;
                margin-right: 15px;
                color: var(--accent);
            }
            
            .logo-text {
                background: linear-gradient(45deg, #ffffff, var(--accent));
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .hero-subtitle {
                font-size: 1.5rem;
                font-weight: 300;
                margin-bottom: 2rem;
                max-width: 600px;
            }
            
            .btn-hero {
                padding: 12px 30px;
                font-size: 1.1rem;
                font-weight: 500;
                border-radius: 50px;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            }
            
            .btn-primary {
                background: var(--accent);
                color: var(--primary-dark);
                border: none;
            }
            
            .btn-primary:hover {
                background: #ffce3a;
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            }
            
            .btn-outline-light {
                border: 2px solid #fff;
                color: #fff;
            }
            
            .btn-outline-light:hover {
                background: rgba(255,255,255,0.1);
                transform: translateY(-3px);
            }
            
            .floating-books {
                position: absolute;
                right: -100px;
                top: 50%;
                transform: translateY(-50%);
                width: 600px;
                height: 600px;
                z-index: 1;
            }
            
            .book {
                position: absolute;
                width: 120px;
                height: 180px;
                border-radius: 5px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                animation: float 6s ease-in-out infinite;
            }
            
            .book-1 {
                background: #fff;
                top: 20%;
                left: 20%;
                transform: rotate(-15deg);
                animation-delay: 0s;
            }
            
            .book-2 {
                background: var(--accent);
                top: 40%;
                left: 35%;
                transform: rotate(10deg);
                animation-delay: 1s;
            }
            
            .book-3 {
                background: var(--primary-light);
                top: 60%;
                left: 25%;
                transform: rotate(-5deg);
                animation-delay: 2s;
            }
            
            @keyframes float {
                0% { transform: translateY(0) rotate(var(--rotate)); }
                50% { transform: translateY(-20px) rotate(var(--rotate)); }
                100% { transform: translateY(0) rotate(var(--rotate)); }
            }
            
            .book-1 { --rotate: -15deg; }
            .book-2 { --rotate: 10deg; }
            .book-3 { --rotate: -5deg; }
            
            .navbar {
                background: transparent;
                transition: all 0.3s ease;
                padding: 1rem 2rem;
            }
            
            .navbar.scrolled {
                background: var(--primary);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                padding: 0.8rem 2rem;
            }
            
            .nav-link {
                color: rgba(255,255,255,0.85) !important;
                font-weight: 500;
                padding: 0.5rem 1rem;
                margin: 0 0.2rem;
                border-radius: 4px;
                transition: all 0.3s ease;
            }
            
            .nav-link:hover {
                color: #fff !important;
                background: rgba(255,255,255,0.1);
            }
            
            .nav-link.btn-nav {
                background: var(--accent);
                color: var(--primary-dark) !important;
                padding: 0.5rem 1.5rem;
                border-radius: 50px;
                margin-left: 1rem;
            }
            
            .nav-link.btn-nav:hover {
                background: #ffce3a;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            }

            .book-card {
                transition: transform 0.3s ease;
                border-radius: 10px;
                overflow: hidden;
            }

            .book-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            }

            .book-image-container {
                height: 200px;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f8f9fa;
            }

            .book-image {
                max-height: 100%;
                object-fit: contain;
            }

            .category-card {
                transition: transform 0.3s ease;
                border-radius: 10px;
                background-color: #f8f9fa;
            }

            .category-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                background-color: #e9ecef;
            }

            /* Tambahan style untuk hero features */
            .hero-features {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            
            .feature-item {
                background: rgba(255, 255, 255, 0.15);
                padding: 8px 15px;
                border-radius: 50px;
                display: inline-flex;
                align-items: center;
                width: fit-content;
                backdrop-filter: blur(5px);
                font-size: 0.9rem;
                font-weight: 500;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <span class="logo-icon"><i class="fas fa-book-open"></i></span>
                    <span class="logo-text">LibraryHub</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fas fa-book-open nav-icon"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">
                                <i class="fas fa-landmark nav-icon"></i> Tentang Perpustakaan
                            </a>
                        </li>
                    @auth
                            <li class="nav-item">
                                <a class="nav-link btn-nav" href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}">
                                    <i class="fas fa-chart-line me-1"></i> Dasbor
                                </a>
                            </li>
                    @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn-nav" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i> Daftar
                                </a>
                            </li>
                    @endauth
                    </ul>
                </div>
                </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero">
            <div class="container hero-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="logo-large">
                            <span class="logo-icon"><i class="fas fa-book-open"></i></span>
                            <span class="logo-text">LibraryHub</span>
                        </div>
                        <h2 class="hero-subtitle">Perpustakaan digital modern untuk memudahkan akses literasi dan pengelolaan koleksi buku.</h2>
                        <div class="mt-5 d-flex flex-wrap gap-3">
                            @auth
                                <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}" class="btn btn-hero btn-primary">
                                    <i class="fas fa-chart-line me-2"></i>Akses Dasbor
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-hero btn-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-hero btn-outline-light">
                                    <i class="fas fa-user-plus me-2"></i>Daftar Keanggotaan
                                </a>
                            @endauth
                        </div>
                        <div class="mt-4 hero-features">
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Akses koleksi buku digital</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Peminjaman buku yang mudah</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Katalog buku yang lengkap</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 position-relative d-none d-lg-block">
                        <div class="floating-books">
                            <div class="book book-1"></div>
                            <div class="book book-2"></div>
                            <div class="book book-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        </script>
    </body>
</html>
