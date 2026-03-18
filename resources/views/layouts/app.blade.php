<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcoRecycle') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: #646cff;
            --primary-hover: #535bf2;
            --dark-color: #213547;
            --light-color: #ffffff;
            --gray-color: #666666;
            --accent-color: #ff3b30;
            --success-color: #34c759;
            --footer-bg: #f9fafb;
            --footer-text: #666666;
            --footer-heading: #213547;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            height: 70px;
            display: flex;
            align-items: center;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--dark-color) !important;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
            padding: 0.5rem 0;
        }

        .navbar-brand i {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-right: 0.5rem;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: var(--dark-color) !important;
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0.9;
            height: 40px;
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            color: var(--primary-color);
        }

        .nav-link span {
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: -0.01em;
        }

        .nav-link:hover {
            background: rgba(100, 108, 255, 0.1);
            color: var(--primary-color) !important;
            opacity: 1;
            transform: translateY(-1px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(100, 108, 255, 0.2);
            height: 40px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(100, 108, 255, 0.3);
        }

        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 4rem 0 2rem;
            font-size: 0.9rem;
        }

        .footer-brand h3 {
            font-weight: 700;
            color: var(--footer-heading);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
        }

        .footer-brand p {
            color: var(--footer-text);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .footer h4 {
            color: var(--footer-heading);
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            letter-spacing: -0.01em;
        }

        .footer a {
            color: var(--footer-text) !important;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.95rem;
            opacity: 0.8;
        }

        .footer a:hover {
            color: var(--primary-color) !important;
            opacity: 1;
        }

        .social-links {
            margin-top: 2rem;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: rgba(100, 108, 255, 0.1);
            color: var(--primary-color);
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .social-link:hover {
            background: rgba(100, 108, 255, 0.2);
            transform: translateY(-2px);
            opacity: 1;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            min-width: 220px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--dark-color);
            border-radius: 8px;
            transition: all 0.2s ease;
            height: 40px;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: var(--primary-color);
            font-size: 1rem;
        }

        .dropdown-item:hover {
            background-color: rgba(100, 108, 255, 0.1);
            color: var(--primary-color);
        }

        .footer-divider {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .footer-bottom {
            color: var(--footer-text);
            font-size: 0.85rem;
        }

        .footer-bottom a {
            color: var(--footer-text);
            text-decoration: none;
            transition: color 0.3s ease;
            opacity: 0.8;
        }

        .footer-bottom a:hover {
            color: var(--primary-color);
            opacity: 1;
        }

        .contact-info i {
            color: var(--primary-color);
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
        }

        .contact-info span {
            color: var(--footer-text);
            opacity: 0.8;
        }

        .navbar-toggler {
            border: none;
            padding: 0.4rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            background: rgba(100, 108, 255, 0.1);
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                margin-top: 0.5rem;
            }

            .navbar-nav {
                gap: 0.5rem;
            }

            .nav-link {
                padding: 0.6rem 0.8rem !important;
                height: 45px;
            }

            .nav-link i {
                font-size: 1rem;
            }

            .nav-link span {
                font-size: 0.95rem;
            }

            .btn-primary {
                height: 45px;
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-recycle text-primary me-2"></i>
                EcoRecycle
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Main Navigation -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('location-finder') }}">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Recycling Centers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('educational-resources.index') }}">
                            <i class="fas fa-book-open"></i>
                            <span>Resources</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            <i class="fas fa-info-circle"></i>
                            <span>About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">
                            <i class="fas fa-envelope"></i>
                            <span>Contact</span>
                        </a>
                    </li>

                    <!-- User Navigation -->
                    @guest
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('device-credits.index') }}">
                                        <i class="fas fa-coins"></i>
                                        <span>Device Credits</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('recycling-history.index') }}">
                                        <i class="fas fa-history"></i>
                                        <span>Recycling History</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-brand">
                        <h3 class="text-dark mb-3">
                            <i class="fas fa-recycle text-primary me-2"></i>
                            EcoRecycle
                        </h3>
                        <p class="text-dark">Making e-waste recycling accessible and rewarding for everyone. Join us in creating a sustainable future.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h4 class="text-dark mb-3">Quick Links</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="text-dark text-decoration-none">Home</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('about') }}" class="text-dark text-decoration-none">About</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('location-finder') }}" class="text-dark text-decoration-none">Find Recycling Center</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('educational-resources.index') }}" class="text-dark text-decoration-none">Resources</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('contact') }}" class="text-dark text-decoration-none">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h4 class="text-dark mb-3">Support</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#faq" class="text-dark text-decoration-none">FAQ</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-dark text-decoration-none">Device Recycling</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-dark text-decoration-none">Pickup Service</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-dark text-decoration-none">Reward Points</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4 class="text-dark mb-3">Contact Us</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span class="text-dark">123 Eco Street, Green City, India - 500001</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <span class="text-dark">+91 123 456 7890</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <span class="text-dark">info@ecorecycle.com</span>
                        </li>
                    </ul>
                    <div class="social-links mt-3">
                        <a href="#" class="social-link me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link me-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-dark mb-0">&copy; {{ date('Y') }} EcoRecycle. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-dark text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-dark text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <script>
        // Toastify configuration
        function showToast(message, type = 'success') {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: type === 'success' ? '#28a745' : '#dc3545',
                stopOnFocus: true,
                onClick: function() {}
            }).showToast();
        }

        // Show success message if exists
        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif

        // Show error message if exists
        @if(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    </script>
</body>
</html>
