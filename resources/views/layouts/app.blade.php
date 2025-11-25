<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ELCK Southern Lake Diocese') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-gray-50">

    <!-- Skip to main content -->
    <a href="#main-content" class="skip-link sr-only focus:not-sr-only">Skip to main content</a>

    <!-- Navbar -->
    <header class="bg-white shadow">
        <nav class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/elck_logo.jpg') }}" alt="ELCK Logo" class="h-10 w-10 object-cover rounded-full">
                <div class="text-lg font-bold">
                    <div>ELCK Southern Lake Diocese</div>
                    <div class="text-sm font-normal text-gray-500">Serving with Faith & Compassion</div>
                </div>
            </a>

            <!-- Desktop Links -->
            <ul class="hidden md:flex items-center space-x-4">
                <li><a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ url('/about') }}" class="nav-link"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="{{ url('/ministries') }}" class="nav-link"><i class="fas fa-hands-praying"></i> Ministries</a></li>
                <li><a href="{{ url('/events') }}" class="nav-link"><i class="fas fa-calendar-alt"></i> Events</a></li>
                <li><a href="{{ url('/sermons') }}" class="nav-link"><i class="fas fa-book-bible"></i> Sermons</a></li>
                <li><a href="{{ route('gallery') }}" class="nav-link"><i class="fas fa-images"></i> Gallery</a></li>
                <li><a href="{{ route('donations.give') }}" class="nav-link donate-btn"><i class="fas fa-heart"></i> Give</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link"><i class="fas fa-envelope"></i> Contact</a></li>

                @guest
                    <li><a href="{{ route('login') }}" class="nav-link"><i class="fas fa-user"></i> Login/Register</a></li>
                @else
                    <li class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                            @if(Auth::user()->member && Auth::user()->member->photo)
                                <img src="{{ asset('storage/' . Auth::user()->member->photo) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    {{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                                </div>
                            @endif
                            <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-1"></i>
                        </button>

                        <!-- Dropdown -->
                        <ul id="userDropdown" class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-lg hidden">
                            <li>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

            <!-- Mobile menu button -->
            <button id="menuToggle" class="md:hidden focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <ul id="navLinks" class="md:hidden hidden flex-col space-y-2 px-6 pb-4">
            <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li><a href="{{ url('/about') }}" class="nav-link">About</a></li>
            <li><a href="{{ url('/ministries') }}" class="nav-link">Ministries</a></li>
            <li><a href="{{ url('/events') }}" class="nav-link">Events</a></li>
            <li><a href="{{ url('/sermons') }}" class="nav-link">Sermons</a></li>
            <li><a href="{{ route('gallery') }}" class="nav-link">Gallery</a></li>
            <li><a href="{{ route('donations.give') }}" class="nav-link">Give</a></li>
            <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
            @guest
                <li><a href="{{ route('login') }}" class="nav-link">Login/Register</a></li>
            @endguest
        </ul>
    </header>

    <!-- Page Content -->
    <main id="main-content" class="container mx-auto py-6 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-12">
        <div class="container mx-auto py-8 px-6 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <h3 class="font-bold text-lg mb-2">ELCK Southern Lake Diocese</h3>
                <p class="text-gray-600">Serving communities with faith, hope, and love through the teachings of Jesus Christ.</p>
                <div class="flex space-x-2 mt-2">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-bold mb-2">Quick Links</h4>
                <ul class="text-gray-600">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('ministries') }}">Ministries</a></li>
                    <li><a href="{{ url('events') }}">Events</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-2">Resources</h4>
                <ul class="text-gray-600">
                    <li><a href="{{ route('sermons.index') }}">Sermons</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="#">Prayer Requests</a></li>
                    <li><a href="{{ route('newsletter.index') }}">Newsletter</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-2">Contact Us</h4>
                <address class="text-gray-600">
                    <p><i class="fas fa-map-marker-alt"></i> Diocese Office, Kenya</p>
                    <p><i class="fas fa-phone"></i> +254 716052342</p>
                    <p><i class="fas fa-envelope"></i> info@elcksld.org</p>
                </address>
            </div>
        </div>
        <div class="bg-gray-100 text-center py-4 mt-6">
            &copy; {{ date('Y') }} Evangelical Lutheran Church in Kenya - Southern Lake Diocese. All Rights Reserved.
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('hidden');
        });

        // User dropdown toggle
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');
        if(userMenuButton){
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', () => userDropdown.classList.add('hidden'));
            document.addEventListener('keydown', (e) => {
                if(e.key === 'Escape') userDropdown.classList.add('hidden');
            });
        }
    </script>

</body>
</html>
