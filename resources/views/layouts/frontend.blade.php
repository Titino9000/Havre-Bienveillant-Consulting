<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Havre Bienveillant Consultant (HBC) Ltd')</title>
    
    <!-- Meta tags for SEO -->
    <meta name="description" content="HBC Ltd offre un accompagnement psychosocial professionnel et bienveillant aux individus et aux institutions éducatives.">
    
    @if(app()->environment('staging', 'local'))
    <!-- Prevent indexing on staging environments -->
    <meta name="robots" content="noindex, nofollow">
    @endif
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{asset('assets/frontend/images/logos/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/frontend/images/logos/favicon.png')}}">
    
    <!-- Bootstrap CSS (for grid and basic layout utilities) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.1.0/css/flag-icons.min.css" rel="stylesheet">
    
    <!-- Custom Premium CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <style>
        /* Premium Dropdown Styles */
        .dropdown-hover:hover > .dropdown-menu {
            display: block;
            margin-top: 0;
        }
        .custom-dropdown-menu {
            animation: dropdownFadeUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border-radius: 12px !important;
            padding: 8px !important;
            min-width: 220px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08) !important;
            margin-top: 0 !important; /* Fixed gap issue */
            border-top: 3px solid var(--primary) !important;
        }
        .custom-dropdown-item {
            transition: all 0.2s ease;
            color: #333;
            font-size: 0.95rem;
            border-radius: 8px;
        }
        .custom-dropdown-item:hover, .custom-dropdown-item.active {
            background-color: var(--bg-light);
            color: var(--primary) !important;
            padding-left: 20px !important;
            font-weight: 600;
        }
        @keyframes dropdownFadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Active Nav Link Styles */
        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
            font-weight: 700 !important;
            position: relative;
        }
        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }
        
        /* Footer Enhancements */
        .footer-link-hover {
            color: rgba(255, 255, 255, 0.6) !important;
            transition: all 0.3s ease;
        }
        .footer-link-hover:hover {
            color: white !important;
            transform: translateX(5px);
        }
        .social-icon-btn:hover {
            background-color: var(--secondary) !important;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="bg-white shadow-sm fixed-top" id="mainHeader">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light py-2">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <img src="{{ asset('assets/frontend/images/logos/logo-landscape.webp') }}" alt="HBC Logo" style="height: 80px;">
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link dropdown-toggle fw-semibold px-3 {{ request()->routeIs('services') || request()->is('schools') || request()->is('ngos') ? 'active' : '' }}" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Services') }}
                            </a>
                            <ul class="dropdown-menu border-0 custom-dropdown-menu" aria-labelledby="servicesDropdown">
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item mb-1 {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">{{ __('All Services') }}</a></li>
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item mb-1 {{ request()->is('schools') ? 'active' : '' }}" href="/schools">{{ __('For Schools') }}</a></li>
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item {{ request()->is('ngos') ? 'active' : '' }}" href="/ngos">{{ __('For NGOs') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">{{ __('About Us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 {{ request()->routeIs('approach') ? 'active' : '' }}" href="{{ route('approach') }}">{{ __('Our Approach') }}</a>
                        </li>
                        <li class="nav-item dropdown dropdown-hover position-relative">
                            <a class="nav-link dropdown-toggle fw-semibold px-3 {{ request()->routeIs('resources') || request()->routeIs('faq') ? 'active' : '' }}" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Resources') }}
                            </a>
                            <ul class="dropdown-menu border-0 custom-dropdown-menu" aria-labelledby="resourcesDropdown">
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item mb-1 {{ request()->routeIs('resources') ? 'active' : '' }}" href="{{ route('resources') }}">{{ __('Knowledge Hub') }}</a></li>
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">{{ __('FAQ') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ strtoupper(app()->getLocale()) }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu border-0" aria-labelledby="langDropdown" style="min-width: 160px;">
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item mb-1 {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('set-locale', 'en') }}"><span class="fi fi-gb me-2 rounded"></span>English (EN)</a></li>
                                <li><a class="dropdown-item py-2 px-3 fw-medium custom-dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}" href="{{ route('set-locale', 'fr') }}"><span class="fi fi-fr me-2 rounded"></span>Français (FR)</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('contact') }}" class="btn-premium btn-sm">Get in touch</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer class="position-relative pt-5 pb-4 mt-5" style="background-color: var(--primary-dark); color: rgba(255, 255, 255, 0.8); overflow: hidden;">
        <!-- Background Pattern -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 0.03; background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <!-- Top decorative wave or border -->
        <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, var(--secondary), var(--accent));"></div>

        <div class="container position-relative z-1 pt-4">
            <div class="row gy-5">
                <!-- Brand & About -->
                <div class="col-lg-4 col-md-6 pe-lg-5">
                    <a class="navbar-brand d-inline-block mb-4" href="{{ route('home') }}">
                        <img src="{{ asset('assets/frontend/images/logos/logo-landscape.webp') }}" alt="HBC Logo" style="height: 65px; filter: brightness(0) invert(1);">
                    </a>
                    <p class="mb-4" style="line-height: 1.8; font-size: 0.95rem;">
                        {{ __('Havre Bienveillant Consultant Ltd is dedicated to promoting mental health, emotional wellbeing, and positive human development through professional counseling, training, and psychosocial support.') }}
                    </p>
                    <!-- Social Links -->
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); color: white; transition: all 0.3s ease; text-decoration: none;">
                            <i class="bx bxl-facebook fs-5"></i>
                        </a>
                        <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); color: white; transition: all 0.3s ease; text-decoration: none;">
                            <i class="bx bxl-twitter fs-5"></i>
                        </a>
                        <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); color: white; transition: all 0.3s ease; text-decoration: none;">
                            <i class="bx bxl-linkedin fs-5"></i>
                        </a>
                        <a href="#" class="social-icon-btn d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: rgba(255,255,255,0.1); color: white; transition: all 0.3s ease; text-decoration: none;">
                            <i class="bx bxl-instagram fs-5"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white fw-bold mb-4 position-relative pb-2" style="display: inline-block;">
                        {{ __('Explore') }}
                        <span class="position-absolute bottom-0 start-0 w-50" style="height: 3px; border-radius: 2px; background-color: var(--secondary);"></span>
                    </h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-3"><a href="{{ route('home') }}" class="text-decoration-none footer-link-hover d-inline-flex align-items-center"><i class="bx bx-chevron-right text-secondary me-1"></i> {{ __('Home') }}</a></li>
                        <li class="mb-3"><a href="{{ route('about') }}" class="text-decoration-none footer-link-hover d-inline-flex align-items-center"><i class="bx bx-chevron-right text-secondary me-1"></i> {{ __('About Us') }}</a></li>
                        <li class="mb-3"><a href="{{ route('services') }}" class="text-decoration-none footer-link-hover d-inline-flex align-items-center"><i class="bx bx-chevron-right text-secondary me-1"></i> {{ __('Services') }}</a></li>
                        <li class="mb-3"><a href="{{ route('resources') }}" class="text-decoration-none footer-link-hover d-inline-flex align-items-center"><i class="bx bx-chevron-right text-secondary me-1"></i> {{ __('Resources') }}</a></li>
                        <li class="mb-3"><a href="{{ route('contact') }}" class="text-decoration-none footer-link-hover d-inline-flex align-items-center"><i class="bx bx-chevron-right text-secondary me-1"></i> {{ __('Contact') }}</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 position-relative pb-2" style="display: inline-block;">
                        {{ __('Get in Touch') }}
                        <span class="position-absolute bottom-0 start-0 w-50" style="height: 3px; border-radius: 2px; background-color: var(--secondary);"></span>
                    </h5>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-4 align-items-start">
                            <div class="rounded bg-white bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center">
                                <i class="bx bx-map fs-5 text-white"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold text-white mb-1">{{ __('Location') }}</span>
                                <span style="font-size: 0.9rem;">KG 139 Avenue 1, Building 1<br>Kimironko, Kigali</span>
                            </div>
                        </li>
                        <li class="d-flex mb-4 align-items-start">
                            <div class="rounded bg-white bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center">
                                <i class="bx bx-phone fs-5 text-white"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold text-white mb-1">{{ __('Phone') }}</span>
                                <span style="font-size: 0.9rem;">+250 788 585 656</span>
                            </div>
                        </li>
                        <li class="d-flex mb-2 align-items-start">
                            <div class="rounded bg-white bg-opacity-10 p-2 me-3 d-flex align-items-center justify-content-center">
                                <i class="bx bx-envelope fs-5 text-white"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold text-white mb-1">{{ __('Email') }}</span>
                                <span style="font-size: 0.9rem;"><a href="mailto:havrebienveillant@gmail.com" class="text-decoration-none footer-link-hover text-white-50">havrebienveillant@gmail.com</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Office Hours -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-4 position-relative pb-2" style="display: inline-block;">
                        {{ __('Office Hours') }}
                        <span class="position-absolute bottom-0 start-0 w-50" style="height: 3px; border-radius: 2px; background-color: var(--secondary);"></span>
                    </h5>
                    <div class="bg-white bg-opacity-10 rounded-4 p-4 mt-2">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-3 pb-3 border-bottom border-white border-opacity-25">
                                <span class="fw-medium text-white">{{ __('Monday – Friday') }}</span>
                                <span>8:00 AM – 5:00 PM</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span class="fw-medium text-white">{{ __('Saturday') }}</span>
                                <span class="text-secondary fw-bold">{{ __('By Appointment') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <hr class="mt-5 mb-4 border-white border-opacity-25">
            
            <div class="row align-items-center pb-2">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 small" style="color: rgba(255,255,255,0.6);">
                        © {{ date('Y') }} Havre Bienveillant Consultant Ltd. {{ __('All Rights Reserved.') }}
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 small" style="color: rgba(255,255,255,0.6);">
                        {{ __('Developed by') }} <a href="#" class="text-white fw-bold text-decoration-none footer-link-hover">RYZHATECH LTD</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>   <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script for sticky header -->
    <script>
        window.addEventListener('scroll', function() {
            var header = document.getElementById('mainHeader');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
