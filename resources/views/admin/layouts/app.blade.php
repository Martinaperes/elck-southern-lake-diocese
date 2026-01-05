<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ELCK Diocese Admin')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#197b3b",
                        "background-light": "#f6f8f7",
                        "background-dark": "#0a0f0c",
                        "surface-dark": "#122017",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    
    <!-- Additional Styles -->
    <style>
        body {
            min-height: max(884px, 100dvh);
            padding-bottom: 6rem; /* Space for bottom nav */
        }
        .pb-safe {
            padding-bottom: env(safe-area-inset-bottom);
        }
    </style>
    
    @stack('styles') <!-- For page-specific styles -->
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-white overflow-x-hidden">
    <!-- Header -->
    <header class="sticky top-0 z-30 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-md border-b border-black/5 dark:border-white/5">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="size-10 rounded-full bg-cover bg-center border border-white/10" style="background-image: url('{{ Auth::user()->avatar_url ?? 'https://via.placeholder.com/150' }}');" data-alt="Portrait of the administrator">
                    </div>
                    <div class="absolute bottom-0 right-0 size-3 bg-primary rounded-full border-2 border-background-dark"></div>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-medium leading-none mb-1">Welcome back,</span>
                    <h2 class="text-base font-bold leading-none tracking-tight">{{ Auth::user()->name ?? 'Admin' }}</h2>
                </div>
            </div>
            <button class="relative flex items-center justify-center size-10 rounded-full bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-white hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[24px]">notifications</span>
                <span class="absolute top-2.5 right-2.5 size-2 bg-red-500 rounded-full border border-background-dark"></span>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content') <!-- This is where your page content will go -->
    </main>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-white/90 dark:bg-[#0f1612]/90 backdrop-blur-lg border-t border-slate-200 dark:border-white/5 pb-safe">
        <div class="flex items-center justify-around h-16 px-2">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
                <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.dashboard') ? 'font-variation-settings-\'FILL\'-1' : '' }}">dashboard</span>
                <span class="text-[10px] font-medium">Overview</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.users.*') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
                <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.users.*') ? 'font-variation-settings-\'FILL\'-1' : '' }}">groups</span>
                <span class="text-[10px] font-medium">Members</span>
            </a>
            
            <a href="{{ route('admin.events.index') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.events.*') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
                <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.events.*') ? 'font-variation-settings-\'FILL\'-1' : '' }}">calendar_today</span>
                <span class="text-[10px] font-medium">Calendar</span>
            </a>
            
            <a href="#" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('#') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
                <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('#') ? 'font-variation-settings-\'FILL\'-1' : '' }}">settings</span>
                <span class="text-[10px] font-medium">Settings</span>
            </a>
        </div>
        <!-- Safe Area Spacer for iOS Home Indicator -->
        <div class="h-4 w-full"></div>
    </nav>

    <!-- Scripts -->
    @stack('scripts') <!-- For page-specific scripts -->
</body>
</html>