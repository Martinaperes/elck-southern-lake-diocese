<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name', 'ELCK Southern Lake Diocese') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 64px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .active-menu {
            background-color: #3b82f6;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-lg w-64 flex flex-col">
            <!-- Logo -->
            <div class="p-4 border-b">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-church text-blue-600 text-2xl"></i>
                    <span class="sidebar-text text-xl font-bold text-gray-800">
                        ELCK-Southern-lake AdminDashboard
                    </span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <!-- Users -->
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.users.*') ? 'active-menu' : '' }}">
                    <i class="fas fa-users w-6"></i>
                    <span class="sidebar-text">Users</span>
                </a>

                <!-- Ministries -->
                <a href="{{ route('admin.ministries.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.ministries.*') ? 'active-menu' : '' }}">
                    <i class="fas fa-hands-helping w-6"></i>
                    <span class="sidebar-text">Ministries</span>
                </a>

                <!-- Events -->
                <a href="{{ route('admin.events.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.events.*') ? 'active-menu' : '' }}">
                    <i class="fas fa-calendar-alt w-6"></i>
                    <span class="sidebar-text">Events</span>
                </a>

                <!-- Sermons -->
                <a href="{{ route('admin.sermons.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.sermons.*') ? 'active-menu' : '' }}">
                    <i class="fas fa-bible w-6"></i>
                    <span class="sidebar-text">Sermons</span>
                </a>

                <!-- Gallery -->
                <a href="{{ route('admin.gallery.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.gallery.*') ? 'active-menu' : '' }}">
                    <i class="fas fa-images w-6"></i>
                    <span class="sidebar-text">Gallery</span>
                </a>

                <!-- Donations -->
                <a href="{{ route('admin.donations.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 {{ request()->routeIs('admin.donations.*') ? 'active-menu' : '' }}">
                    <i class="fas fa-donate w-6"></i>
                    <span class="sidebar-text">Donations</span>
                </a>

                <!-- Back to Site -->
                <a href="{{ url('/') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 mt-8">
                    <i class="fas fa-arrow-left w-6"></i>
                    <span class="sidebar-text">Back to Site</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="sidebar-text">
                        <div class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-500">Administrator</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-bell text-xl"></i>
                                @if($unreadCount = \App\Models\Notification::where('user_id', auth()->id())->where('read', 0)->count() ?? 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </button>
                        </div>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                <span>{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-circle mr-2"></i>Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js for dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            sidebar.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                mainContent.classList.add('ml-16');
            } else {
                mainContent.classList.remove('ml-16');
            }
        });

        // Auto-hide flash messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.bg-green-100, .bg-red-100');
            flashMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>