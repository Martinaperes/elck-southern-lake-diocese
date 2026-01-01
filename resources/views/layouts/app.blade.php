<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ELCK Southern Lake Diocese') }}</title>

    
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        /* Custom hover and active states */
        .nav-link {
            position: relative;
            color: #4b5563; /* gray-600 */
            transition: color 0.2s ease;
            padding: 0.5rem 0;
        }

        .nav-link:hover {
            color: #197b3b; /* primary green */
        }

        /* Underline effect on hover */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #197b3b;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Active page styling */
        .nav-link.active {
            color: #197b3b;
            font-weight: 600;
        }

        .nav-link.active::after {
            width: 100%;
            background-color: #197b3b;
        }

        /* Mobile active state */
        #navLinks .nav-link.active {
            color: #197b3b;
            font-weight: 600;
            padding-left: 0.5rem;
            border-left: 3px solid #197b3b;
        }

        /* Donate button hover */
        .donate-btn {
            background: linear-gradient(135deg, #197b3b 0%, #146c33 100%);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .donate-btn:hover {
            background: linear-gradient(135deg, #146c33 0%, #197b3b 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25, 123, 59, 0.3);
        }

        /* Footer links hover */
        footer a:hover {
            color: white;
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        /* User dropdown menu */
        #userDropdown {
            min-width: 180px;
            z-index: 1000;
        }

        #userDropdown a:hover {
            background-color: #f3f4f6;
            color: #197b3b;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Mobile menu animation */
        #navLinks {
            transition: max-height 0.3s ease-out;
            max-height: 0;
            overflow: hidden;
        }

        #navLinks:not(.hidden) {
            max-height: 500px;
        }

        /* Logo tagline responsiveness */
        .logo-tagline {
            display: block;
            max-width: 220px;
        }

        @media (max-width: 640px) {
            .logo-tagline {
                font-size: 0.65rem;
                max-width: 180px;
            }
        }

        @media (max-width: 480px) {
            .logo-tagline {
                font-size: 0.6rem;
                max-width: 160px;
                line-height: 1.2;
            }
        }

        @media (max-width: 360px) {
            .logo-tagline {
                font-size: 0.55rem;
                max-width: 140px;
            }
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Skip to main content -->
    <a href="#main-content"
       class="sr-only focus:not-sr-only fixed top-2 left-2 bg-[#197b3b] text-white px-4 py-2 rounded z-50 transition-colors hover:bg-[#146c33]">
        Skip to content
    </a>

    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16 sm:h-20">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 hover:opacity-90 transition-opacity">
                    <img src="{{ asset('images/elck_logo.jpg') }}"
                         alt="ELCK Logo"
                         class="h-9 w-9 sm:h-11 sm:w-11 rounded-full object-cover">

                    <div class="leading-tight">
                        <h1 class="text-sm sm:text-lg font-bold text-gray-900">
                            ELCK Southern Lake Diocese
                        </h1>
                        <p class="text-xs text-gray-500 logo-tagline">
                            To proclaim the Good News of the crucified and resurrected Christ, the only way to salvation.
                        </p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <ul class="hidden lg:flex items-center gap-4 xl:gap-6 text-sm font-medium">
                    <li>
                        <a href="{{ route('home') }}" 
                           class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}" 
                           class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/ministries') }}" 
                           class="nav-link {{ request()->is('ministries') ? 'active' : '' }}">
                            Ministries
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.index') }}"
                           class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}">
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/sermons') }}" 
                           class="nav-link {{ request()->is('sermons*') ? 'active' : '' }}">
                            Sermons
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}" 
                           class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">
                            Gallery
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('donations.give') }}" class="donate-btn">
                            <i class="fas fa-heart mr-1"></i> Give
                        </a>
                    </li>

                    <!-- Auth -->
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="fas fa-user mr-1"></i> Login
                            </a>
                        </li>
                    @else
                        <li class="relative">
                            <button id="userMenuButton"
                                    class="flex items-center gap-2 hover:text-[#197b3b] transition-colors group">
                                @if(Auth::user()->member && Auth::user()->member->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->member->photo) }}"
                                         class="w-8 h-8 rounded-full object-cover border-2 border-transparent group-hover:border-[#197b3b] transition-colors">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-[#197b3b] text-white flex items-center justify-center font-bold text-sm group-hover:bg-[#146c33] transition-colors">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <ul id="userDropdown"
                                class="absolute right-0 mt-3 w-44 bg-white rounded-lg shadow-lg border border-gray-200 hidden transition-all duration-200">
                                <li>
                                    <a href="{{ route('profile.show') }}"
                                       class="block px-4 py-2.5 hover:bg-gray-50 hover:text-[#197b3b] transition-colors">
                                        <i class="fas fa-user-circle mr-2"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2.5 hover:bg-gray-50 hover:text-red-600 transition-colors">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>

                <!-- Mobile Menu Toggle -->
                <button id="menuToggle" class="lg:hidden text-xl text-gray-700 hover:text-[#197b3b] transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <ul id="navLinks"
                class="lg:hidden hidden flex-col gap-3 pb-6 text-sm font-medium border-t border-gray-200 mt-4 pt-4">
                <li>
                    <a href="{{ route('home') }}" 
                       class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('/about') }}" 
                       class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                        <i class="fas fa-info-circle mr-2"></i> About
                    </a>
                </li>
                <li>
                    <a href="{{ url('/ministries') }}" 
                       class="nav-link {{ request()->is('ministries') ? 'active' : '' }}">
                        <i class="fas fa-hands-helping mr-2"></i> Ministries
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}"
                       class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt mr-2"></i> Events
                    </a>
                </li>
                <li>
                    <a href="{{ url('/sermons') }}" 
                       class="nav-link {{ request()->is('sermons*') ? 'active' : '' }}">
                        <i class="fas fa-volume-up mr-2"></i> Sermons
                    </a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}" 
                       class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">
                        <i class="fas fa-images mr-2"></i> Gallery
                    </a>
                </li>
                <li>
                    <a href="{{ route('donations.give') }}" 
                       class="nav-link {{ request()->routeIs('donations.*') ? 'active' : '' }}">
                        <i class="fas fa-heart mr-2"></i> Give
                    </a>
                </li>
                @guest
                    <li>
                        <a href="{{ route('login') }}" 
                           class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                            <i class="fas fa-user mr-2"></i> Login
                        </a>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>

    <main id="main-content" class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-14 grid grid-cols-1 md:grid-cols-4 gap-8 sm:gap-10">
            <div>
                <h3 class="font-bold text-white mb-3 text-lg">
                    ELCK Southern Lake Diocese
                </h3>
                <p class="text-sm text-gray-400">
                    Proclaiming Christ through faith, service, and community outreach.
                </p>
                <div class="mt-4 flex gap-3">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-3 text-base">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" 
                           class="hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-white font-medium' : '' }}">
                            Home
                        </a></li>
                    <li><a href="{{ url('/about') }}" 
                           class="hover:text-white transition-colors {{ request()->is('about') ? 'text-white font-medium' : '' }}">
                            About
                        </a></li>
                    <li><a href="{{ url('/ministries') }}" 
                           class="hover:text-white transition-colors {{ request()->is('ministries') ? 'text-white font-medium' : '' }}">
                            Ministries
                        </a></li>
                    <li><a href="{{ route('events.index') }}"
                           class="hover:text-white transition-colors {{ request()->routeIs('events.*') ? 'text-white font-medium' : '' }}">
                            Events
                        </a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-3 text-base">Resources</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('sermons.index') }}" 
                           class="hover:text-white transition-colors {{ request()->is('sermons*') ? 'text-white font-medium' : '' }}">
                            Sermons
                        </a></li>
                    <li><a href="{{ route('gallery') }}" 
                           class="hover:text-white transition-colors {{ request()->routeIs('gallery') ? 'text-white font-medium' : '' }}">
                            Gallery
                        </a></li>
                    <li><a href="{{ route('newsletter.index') }}" 
                           class="hover:text-white transition-colors {{ request()->routeIs('newsletter.*') ? 'text-white font-medium' : '' }}">
                            Newsletter
                        </a></li>
                    <li><a href="{{ route('donations.give') }}" 
                           class="hover:text-white transition-colors {{ request()->routeIs('donations.*') ? 'text-white font-medium' : '' }}">
                            Give
                        </a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-white mb-3 text-base">Contact</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1"></i>
                        <span>Kenya</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone"></i>
                        <span>+254 716 052 342</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <span>info@elcksld.org</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-clock"></i>
                        <span>Mon - Fri: 8:00 AM - 5:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 text-center py-4 text-xs text-gray-500">
            © {{ date('Y') }} Evangelical Lutheran Church in Kenya - Southern Lake Diocese
        </div>
    </footer>

    <script>
        // Mobile menu toggle with animation
        document.getElementById('menuToggle')?.addEventListener('click', () => {
            const navLinks = document.getElementById('navLinks');
            const icon = document.querySelector('#menuToggle i');
            
            if (navLinks.classList.contains('hidden')) {
                navLinks.classList.remove('hidden');
                navLinks.style.maxHeight = navLinks.scrollHeight + 'px';
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                navLinks.style.maxHeight = '0';
                setTimeout(() => {
                    navLinks.classList.add('hidden');
                }, 300);
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // User dropdown toggle
        const userBtn = document.getElementById('userMenuButton');
        const userDrop = document.getElementById('userDropdown');

        if (userBtn) {
            userBtn.addEventListener('click', e => {
                e.stopPropagation();
                userDrop.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!userBtn.contains(e.target) && !userDrop.contains(e.target)) {
                    userDrop.classList.add('hidden');
                }
            });
        }

        // Close mobile menu when clicking a link
        document.querySelectorAll('#navLinks .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navLinks = document.getElementById('navLinks');
                const icon = document.querySelector('#menuToggle i');
                
                navLinks.style.maxHeight = '0';
                setTimeout(() => {
                    navLinks.classList.add('hidden');
                }, 300);
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
        });

        // Add current year to copyright
        document.addEventListener('DOMContentLoaded', () => {
            const yearSpan = document.getElementById('current-year');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '#!') return;
                
                const targetElement = document.querySelector(href);
                if (targetElement) {
                    e.preventDefault();
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>