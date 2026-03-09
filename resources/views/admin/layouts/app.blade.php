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
    <!-- Awesome font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            <!-- Notification Bell & Dropdown -->
            <div class="relative" id="notification-container">
                <button id="notification-btn" class="relative flex items-center justify-center size-10 rounded-full bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-white hover:bg-slate-200 dark:hover:bg-white/10 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <span class="material-symbols-outlined text-[24px]">notifications</span>
                    <span class="absolute top-2.5 right-2.5 size-2 bg-red-500 rounded-full border border-white dark:border-background-dark animate-pulse"></span>
                </button>
                
                <!-- Notification Dropdown Menu -->
                <div id="notification-menu" class="absolute right-0 mt-2 w-80 bg-white dark:bg-surface-dark border border-slate-200 dark:border-white/10 rounded-xl shadow-2xl opacity-0 invisible transform scale-95 transition-all duration-200 origin-top-right z-50">
                    <div class="p-4 border-b border-slate-100 dark:border-white/5 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 dark:text-white">Notifications</h3>
                        <span class="text-xs bg-primary/10 text-primary font-semibold px-2 py-1 rounded-md">2 New</span>
                    </div>
                    
                    <div class="max-h-[300px] overflow-y-auto divide-y divide-slate-100 dark:divide-white/5">
                        <!-- Item 1 -->
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors cursor-pointer flex gap-3">
                            <div class="size-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[16px]">person_add</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800 dark:text-white leading-tight">New user registration</p>
                                <p class="text-xs text-slate-500 mt-1">Owen Mumbo just joined.</p>
                                <p class="text-[10px] text-slate-400 mt-1">2 hours ago</p>
                            </div>
                        </div>
                        
                        <!-- Item 2 -->
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors cursor-pointer flex gap-3">
                            <div class="size-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[16px]">payments</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800 dark:text-white leading-tight">New Tithe Received</p>
                                <p class="text-xs text-slate-500 mt-1">KES 5,000 via M-Pesa</p>
                                <p class="text-[10px] text-slate-400 mt-1">5 hours ago</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 text-center border-t border-slate-100 dark:border-white/5">
                        <a href="#" class="text-sm text-primary font-medium hover:underline">Mark all as read</a>
                    </div>
                </div>
            </div>
            <!-- End Notifications -->
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content') <!-- This is where your page content will go -->
    </main>

    <!-- Bottom Navigation -->
   <nav class="fixed bottom-0 left-0 right-0 z-50 bg-white/90 dark:bg-[#0f1612]/90 backdrop-blur-lg border-t border-slate-200 dark:border-white/5 pb-safe">
    <div class="flex items-center justify-around h-16 px-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.dashboard') ? 'font-variation-settings-\'FILL\'-1' : '' }}">dashboard</span>
            <span class="text-[10px] font-medium">Home</span>
        </a>
        
        <!-- Members -->
        <a href="{{ route('admin.members.index') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.members.*') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.members.*') ? 'font-variation-settings-\'FILL\'-1' : '' }}">groups</span>
            <span class="text-[10px] font-medium">Members</span>
        </a>
        
        <!-- MINISTRIES -->
        <a href="{{ route('admin.ministries.index') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.ministries.*') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.ministries.*') ? 'font-variation-settings-\'FILL\'-1' : '' }}">diversity_3</span>
            <span class="text-[10px] font-medium">Ministries</span>
        </a>
        
        <!-- SERMONS -->
        <a href="{{ route('admin.sermons.index') }}" class="flex flex-1 flex-col items-center justify-center gap-1 h-full {{ request()->routeIs('admin.sermons.*') ? 'text-primary' : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary' }} transition-colors">
            <span class="material-symbols-outlined text-[24px] {{ request()->routeIs('admin.sermons.*') ? 'font-variation-settings-\'FILL\'-1' : '' }}">book</span>
            <span class="text-[10px] font-medium">Sermons</span>
        </a>
        
        <!-- More Button -->
        <button id="more-button" class="flex flex-1 flex-col items-center justify-center gap-1 h-full text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[24px]">more_horiz</span>
            <span class="text-[10px] font-medium">More</span>
        </button>
    </div>
    <!-- Safe Area Spacer for iOS Home Indicator -->
    <div class="h-4 w-full"></div>
</nav>

<!-- More Menu Overlay -->
<div id="more-overlay" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm hidden transition-opacity duration-300">
    <div class="absolute bottom-0 left-0 right-0 bg-white dark:bg-[#0f1612] rounded-t-2xl shadow-2xl transform transition-transform duration-300 translate-y-full" id="more-menu">
        <!-- Close button -->
        <div class="flex justify-center pt-4 pb-2">
            <div class="h-1 w-12 bg-slate-300 dark:bg-slate-600 rounded-full"></div>
        </div>
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-200 dark:border-white/5">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Quick Access</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tap any icon to navigate</p>
        </div>
        
        <!-- Icons Grid -->
        <div class="p-6 grid grid-cols-4 gap-4">
            <!-- NEWSLETTER -->
            <a href="{{ route('admin.newsletter.campaigns') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/5 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">campaign</span>
                <span class="text-xs font-medium mt-2 text-slate-700 dark:text-slate-300">Newsletter</span>
            </a>
            
            <!-- Events/Calendar -->
            <a href="{{ route('admin.events.index') }}" 
   class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/5 transition-all hover:scale-105 active:scale-95">
    <span class="material-symbols-outlined text-[32px] text-primary">calendar_today</span>
    <span class="text-xs font-medium mt-2 text-slate-700 dark:text-slate-300">Events</span>
</a>
            
            <!-- Gallery -->
            <a href="{{ route('admin.gallery.index') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/5 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">photo_library</span>
                <span class="text-xs font-medium mt-2 text-slate-700 dark:text-slate-300">Gallery</span>
            </a>
            
            <!-- Donations -->
            <a href="{{ route('admin.reports.donations') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/5 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">volunteer_activism</span>
                <span class="text-xs font-medium mt-2 text-slate-700 dark:text-slate-300">Donations</span>
            </a>
            
            <!-- Reports -->
            <a href="{{ route('admin.reports.index') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/5 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">insights</span>
                <span class="text-xs font-medium mt-2 text-slate-700 dark:text-slate-300">Reports</span>
            </a>
            
            <!-- Settings -->
            <a href="{{ route('admin.settings.index') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/5 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">settings</span>
                <span class="text-xs font-medium mt-2 text-slate-700 dark:text-slate-300">Settings</span>
            </a>
            
            <!-- Quick Add Member -->
            <a href="{{ route('admin.members.create') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-primary/10 hover:bg-primary/20 border border-primary/20 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">person_add</span>
                <span class="text-xs font-medium mt-2 text-primary">Add Member</span>
            </a>
            
            <!-- Quick Add Sermon -->
            <a href="{{ route('admin.sermons.create') }}" 
               class="flex flex-col items-center justify-center p-4 rounded-xl bg-primary/10 hover:bg-primary/20 border border-primary/20 transition-all hover:scale-105 active:scale-95">
                <span class="material-symbols-outlined text-[32px] text-primary">add_circle</span>
                <span class="text-xs font-medium mt-2 text-primary">Add Sermon</span>
            </a>
        </div>
        
        <!-- Close Area -->
        <div class="p-6 border-t border-slate-200 dark:border-white/5">
            <button id="close-more" class="w-full py-3 bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
                Close
            </button>
        </div>
        
        <!-- Bottom safe area -->
        <div class="h-4 w-full bg-white dark:bg-[#0f1612]"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const moreButton = document.getElementById('more-button');
    const moreOverlay = document.getElementById('more-overlay');
    const moreMenu = document.getElementById('more-menu');
    const closeMore = document.getElementById('close-more');
    
    // Open more menu
    moreButton.addEventListener('click', function() {
        moreOverlay.classList.remove('hidden');
        // Trigger reflow
        moreOverlay.offsetHeight;
        moreOverlay.classList.add('opacity-100');
        moreMenu.classList.remove('translate-y-full');
    });
    
    // Close more menu
    function closeMoreMenu() {
        moreOverlay.classList.remove('opacity-100');
        moreOverlay.classList.add('opacity-0');
        moreMenu.classList.add('translate-y-full');
        
        setTimeout(() => {
            moreOverlay.classList.add('hidden');
        }, 300);
    }
    
    closeMore.addEventListener('click', closeMoreMenu);
    
    // Close when clicking overlay
    moreOverlay.addEventListener('click', function(e) {
        if (e.target === moreOverlay) {
            closeMoreMenu();
        }
    });
    
    // Close with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !moreOverlay.classList.contains('hidden')) {
            closeMoreMenu();
        }
    });
    
    // Add click effect to menu items
    const menuItems = moreMenu.querySelectorAll('a');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Add a quick feedback effect
            this.classList.add('scale-95');
            setTimeout(() => {
                this.classList.remove('scale-95');
            }, 150);
            
            // Close menu after a short delay
            setTimeout(() => {
                closeMoreMenu();
            }, 200);
        });
    });

    // Notification dropdown logic
    const notifBtn = document.getElementById('notification-btn');
    const notifMenu = document.getElementById('notification-menu');

    if (notifBtn && notifMenu) {
        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isVisible = !notifMenu.classList.contains('invisible');
            
            if (isVisible) {
                closeNotifMenu();
            } else {
                notifMenu.classList.remove('invisible', 'opacity-0', 'scale-95');
                notifMenu.classList.add('opacity-100', 'scale-100');
            }
        });

        function closeNotifMenu() {
            notifMenu.classList.remove('opacity-100', 'scale-100');
            notifMenu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                notifMenu.classList.add('invisible');
            }, 200); // match duration
        }

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!notifMenu.contains(e.target) && e.target !== notifBtn) {
                closeNotifMenu();
            }
        });

        // Close on Escape route
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeNotifMenu();
            }
        });
    }
});
</script>

    <!-- Scripts -->
    @stack('scripts') <!-- For page-specific scripts -->
</body>
</html>