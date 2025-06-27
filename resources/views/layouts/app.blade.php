<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LibraryHub - Perpustakaan Digital')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        
        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
        }
        
        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary)) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 0.8rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand .logo-icon {
            font-size: 1.8rem;
            margin-right: 10px;
            color: var(--accent);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .navbar-brand .logo-text {
            background: linear-gradient(45deg, #ffffff, var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-link {
            font-weight: 500;
            color: rgba(255,255,255,0.85) !important;
            padding: 0.6rem 1rem;
            margin: 0 0.2rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.1);
        }
        
        .nav-link.active {
            color: #fff !important;
            background: rgba(255,255,255,0.15);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: var(--accent);
            border-radius: 3px;
        }
        
        .nav-icon {
            margin-right: 6px;
            font-size: 1rem;
        }
        
        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            animation: fadeIn 0.2s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .dropdown-item {
            padding: 0.7rem 1.2rem;
            color: var(--text-dark);
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(46, 125, 50, 0.1);
            color: var(--primary);
            transform: translateX(5px);
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }
        
        /* Content Area */
        .content {
            flex: 1 0 auto;
            padding: 2rem 0;
        }
        
        /* Page Headers */
        .page-header {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .page-header h2 {
            font-weight: 600;
            color: var(--primary-dark);
            position: relative;
            display: inline-block;
            margin-bottom: 0.5rem;
        }
        
        .page-header h2::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            height: 4px;
            width: 60px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .page-header p {
            color: #6c757d;
            max-width: 700px;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: linear-gradient(45deg, var(--primary), var(--primary-light));
            color: white;
            border-bottom: none;
            border-radius: 12px 12px 0 0 !important;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Buttons */
        .btn {
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--primary-light));
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        
        .btn-success {
            background: linear-gradient(45deg, #218838, #28a745);
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .btn-success:hover {
            background: linear-gradient(45deg, #1e7e34, #218838);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        
        /* Tables */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
        
        .table th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f2f2f2;
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,0.02);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(46,125,50,0.05);
        }
        
        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            box-shadow: none;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(46,125,50,0.25);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #495057;
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .alert-dismissible .btn-close {
            padding: 1.25rem;
        }
        
        /* Badges */
        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
            border-radius: 6px;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: var(--text-light);
            padding: 3rem 0 2rem;
            margin-top: auto;
        }
        
        .footer h5 {
            color: var(--accent);
            font-weight: 600;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            height: 3px;
            width: 30px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .footer p {
            color: rgba(255,255,255,0.7);
            line-height: 1.6;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.7rem;
            transition: all 0.3s;
        }
        
        .footer-links li:hover {
            transform: translateX(5px);
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .footer-links a::before {
            content: "\f105";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 8px;
            color: var(--accent);
            font-size: 0.8rem;
        }
        
        .footer-links a:hover {
            color: var(--accent);
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            color: var(--text-light);
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: var(--accent);
            color: var(--primary-dark);
            transform: translateY(-3px);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: var(--primary-dark);
                border-radius: 10px;
                padding: 1rem;
                margin-top: 0.5rem;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            
            .navbar-nav .nav-link {
                padding: 0.8rem 1rem;
                margin: 0.2rem 0;
            }
            
            .dropdown-menu {
                background: rgba(255,255,255,0.05);
                border: none;
                box-shadow: none;
            }
            
            .dropdown-item {
                color: rgba(255,255,255,0.85);
            }
            
            .dropdown-item:hover {
                background: rgba(255,255,255,0.1);
                color: #fff;
            }
        }
        
        @media (max-width: 767.98px) {
            .content {
                padding: 1.5rem 0;
            }
            
            .card-header {
                padding: 1rem;
            }
            
            .card-body {
                padding: 1.2rem;
            }
            
            .table th, .table td {
                padding: 0.75rem;
            }
            
            .footer {
                padding: 2rem 0 1rem;
                text-align: center;
            }
            
            .footer h5::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer-links li {
                margin-bottom: 0.5rem;
            }
            
            .footer-links a::before {
                display: none;
            }
            
            .social-icons {
                justify-content: center;
                margin-top: 1rem;
            }
        }
        
        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        .slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }
        
        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ auth()->check() ? (Auth::user()->role === 'admin' ? route('dashboard') : route('user.dashboard')) : url('/') }}">
                <span class="logo-icon"><i class="fas fa-book-open"></i></span>
                <span class="logo-text">LibraryHub</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                                    <i class="fas fa-chart-line nav-icon"></i>Dasbor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" 
                           href="{{ route('books.index') }}">
                                    <i class="fas fa-book-open nav-icon"></i>Koleksi Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" 
                           href="{{ route('categories.index') }}">
                                    <i class="fas fa-bookmark nav-icon"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}" 
                           href="{{ route('members.index') }}">
                                    <i class="fas fa-user-graduate nav-icon"></i>Anggota
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}" 
                           href="{{ route('loans.index') }}">
                                    <i class="fas fa-book-reader nav-icon"></i>Sirkulasi
                                </a>
                            </li>
                        @elseif(Auth::user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-book-open nav-icon"></i>Beranda
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.loans.*') ? 'active' : '' }}" 
                                   href="{{ route('user.loans.index') }}">
                                    <i class="fas fa-bookmark nav-icon"></i>Buku Saya
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fas fa-book-open nav-icon"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                <i class="fas fa-landmark nav-icon"></i>Tentang Perpustakaan
                            </a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" 
                               data-bs-toggle="dropdown">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                         style="width: 32px; height: 32px;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <div class="dropdown-header py-2">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <p class="text-muted mb-0 small">{{ Auth::user()->email }}</p>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user-circle"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        <span class="logo-icon me-2"><i class="fas fa-book-open"></i></span>
                        <h5 class="mb-0">LibraryHub</h5>
                    </div>
                    <p class="mb-4">Perpustakaan digital modern yang memudahkan akses literasi dan pengelolaan koleksi buku.</p>
                    <div class="social-icons">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Navigasi</h5>
                    <ul class="footer-links">
                        <li class="mb-2"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}">Tentang Perpustakaan</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="mb-4">Informasi Kontak</h5>
                    <ul class="footer-links">
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                <span>perpustakaan@libraryhub.com</span>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone me-2 text-primary"></i>
                                <span>+62 895-3234-49220</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-3" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} LibraryHub - Perpustakaan Digital</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    @stack('scripts')
</body>
</html>
