@extends('layouts.app')
@section('title','Youth Ministry - ELCK Southern Lake')
@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
     $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'youth-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #197b3b;
    --accent: #032119;
    --highlight: #ffd166;
    --dark: #0f172a;
}

/* Base responsive styles */
html {
    scroll-behavior: smooth;
}

/* Responsive typography */
h1 {
    font-size: clamp(1.75rem, 4vw, 3rem);
}

h2 {
    font-size: clamp(1.5rem, 3.5vw, 2.25rem);
}

h3 {
    font-size: clamp(1.25rem, 3vw, 1.75rem);
}

/* Compact hero header */
.hero-header {
    background-image: linear-gradient(rgba(25, 123, 59, 0.85), rgba(6, 214, 160, 0.75)), 
                      url('https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1600&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
}

@media (max-width: 768px) {
    .hero-header {
        background-attachment: scroll;
    }
}

/* Overlay for better text readability */
.hero-overlay {
    background: linear-gradient(135deg, 
                rgba(15, 23, 42, 0.85) 0%, 
                rgba(25, 123, 59, 0.75) 50%, 
                rgba(6, 214, 160, 0.65) 100%);
}

/* Animation for interactive elements */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.bounce-once {
    animation: bounce 1s ease-in-out;
}

#join {
    scroll-margin-top: 80px;
}

@media (max-width: 640px) {
    #join {
        scroll-margin-top: 60px;
    }
}

/* Event status styles */
.event-status {
    font-size: 0.75rem;
    padding: 2px 8px;
    border-radius: 12px;
    display: inline-block;
}

.status-upcoming {
    background-color: #3b82f6;
    color: white;
}

.status-ongoing {
    background-color: #f59e0b;
    color: white;
}

.status-completed {
    background-color: #6b7280;
    color: white;
}

/* Responsive image handling */
.responsive-image {
    width: 100%;
    height: auto;
    max-width: 100%;
}

/* Touch-friendly button sizes on mobile */
@media (max-width: 640px) {
    button, 
    .btn-like,
    a[role="button"] {
        min-height: 44px;
        min-width: 44px;
    }
    
    input, 
    select, 
    textarea {
        font-size: 16px;
    }
}

/* Prevent horizontal overflow */
.container {
    max-width: 100%;
    overflow-x: hidden;
}

/* Responsive grid adjustments */
@media (max-width: 1024px) {
    .lg\:grid-cols-3 {
        grid-template-columns: 1fr;
    }
    
    .lg\:col-span-2 {
        grid-column: span 1;
    }
}

/* Safe area insets for modern mobile devices */
.safe-area-padding {
    padding-left: env(safe-area-inset-left, 1rem);
    padding-right: env(safe-area-inset-right, 1rem);
}

/* Responsive line-clamp for better text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 640px) {
    .line-clamp-2 {
        -webkit-line-clamp: 3;
    }
}
</style>
@section('content')
<div class="min-h-screen bg-gradient-to-b from-green-50 to-emerald-50 font-sans safe-area-padding">
    
    <!-- Compact Banner Section -->
    <div class="relative hero-header py-8 md:py-12 lg:py-16">
        <!-- Gradient overlay for better text contrast -->
        <div class="absolute inset-0 hero-overlay"></div>
        
        <!-- Decorative elements (hidden on mobile for performance) -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-green-400 rounded-full opacity-10 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-emerald-400 rounded-full opacity-10 blur-2xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Back button - moved to top left -->
                <div class="mb-4 md:mb-6">
                    <a href="/ministries" class="inline-flex items-center bg-white/20 backdrop-blur-sm text-green-600 hover:bg-white/30 px-3 py-2 md:px-4 md:py-2 rounded-lg font-semibold group transition-all duration-200 text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to Ministries
                    </a>
                </div>
                
                <!-- Compact Ministry Icon -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 md:p-4 border-2 border-white/30">
                        <i class="fas fa-users text-2xl md:text-3xl lg:text-4xl text-white"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-black mb-2 md:mb-3 text-center leading-tight">
                    Youth Ministry
                    <span class="block text-yellow-300 text-lg md:text-xl lg:text-2xl mt-1">(Ages 13-25)</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-green-500 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Where young hearts grow in faith, build authentic connections, and discover their purpose in Christ
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-yellow-300 to-green-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-yellow-300">500+</div>
                        <div class="text-green-500 font-medium text-xs md:text-sm">Active Youth</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-cyan-300">Weekly</div>
                        <div class="text-green-500 font-medium text-xs md:text-sm">Fellowship</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-green-300">Year-Round</div>
                        <div class="text-green-500 font-medium text-xs md:text-sm">Activities</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#ecfdf5"/>
            </svg>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="container mx-auto px-4 md:px-6 lg:px-8 mt-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button type="button" onclick="this.parentElement.parentElement.style.display='none'" 
                                class="inline-flex text-green-700 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="container mx-auto px-4 md:px-6 lg:px-8 mt-6">
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('info') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button type="button" onclick="this.parentElement.parentElement.style.display='none'" 
                                class="inline-flex text-blue-700 hover:text-blue-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mx-auto px-4 md:px-6 lg:px-8 mt-6">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">Please fix the following errors:</p>
                        <ul class="mt-1 text-sm list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-auto pl-3">
                        <button type="button" onclick="this.parentElement.parentElement.style.display='none'" 
                                class="inline-flex text-red-700 hover:text-red-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="relative container mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-6 md:py-10">
        <div class="max-w-6xl mx-auto">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-6 md:space-y-8">
                    
                    <!-- Mission Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                            Our Mission
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                            The ELCK Youth Ministry creates a safe and vibrant space for young people to grow in their faith, build meaningful friendships, discover their purpose in Christ, and serve God and their community with passion and commitment.
                        </p>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-green-600">
                            <p class="text-lg md:text-xl font-semibold text-green-800 italic">
                                "Empowering the next generation to live out their faith boldly and make a difference in the world."
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80" 
                                     alt="Youth Worship" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80" 
                                     alt="Youth Fellowship" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                            Core Objectives
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Objective 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-green-100 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-cross text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Spiritual Growth</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Deepening faith through biblical teaching, prayer, worship, and discipleship. We help youth develop a personal relationship with God and understand their identity in Christ.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-green-600 text-sm md:text-base">
                                        <i class="fas fa-bible mr-2"></i>
                                        <span class="font-medium">Bible Studies | Prayer Groups | Discipleship Programs</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-green-100 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-users text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Authentic Community</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Building genuine friendships and supportive relationships in a safe, inclusive environment where youth can be themselves and grow together.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-green-600 text-sm md:text-base">
                                        <i class="fas fa-heart mr-2"></i>
                                        <span class="font-medium">Small Groups | Mentorship | Fellowship Events</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-green-100 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-hands-helping text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Purposeful Service</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Equipping youth to serve God and others through local and global missions, community outreach, and leadership development opportunities.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-green-600 text-sm md:text-base">
                                        <i class="fas fa-globe mr-2"></i>
                                        <span class="font-medium">Mission Trips | Community Service | Leadership Training</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 4 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-green-100 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-gamepad text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Engaging Activities</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Creating fun, relevant experiences through games, outings, creative arts, and technology that connect faith with everyday life.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-green-600 text-sm md:text-base">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        <span class="font-medium">Game Nights | Retreats | Creative Worship | Sports</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Activities Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                            Key Activities
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Activity 1 -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-lg md:rounded-xl p-4 md:p-6 border border-green-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-fire text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-green-800">Youth Worship Nights</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Dynamic worship experiences with contemporary music, testimonies, and relevant messages that speak to youth culture and challenges.
                                </p>
                                <div class="text-xs md:text-sm text-green-600">
                                    <i class="fas fa-clock mr-1"></i> Sundays 6:00 PM | Youth Chapel
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-blue-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-gamepad text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-blue-800">Friday Game Nights</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Fun-filled evenings with video games, board games, sports, and fellowship in a safe, supervised environment.
                                </p>
                                <div class="text-xs md:text-sm text-blue-600">
                                    <i class="fas fa-clock mr-1"></i> Fridays 7:00 PM | Youth Center
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-yellow-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-yellow-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-campground text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-yellow-800">Annual Youth Camp</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Life-changing weekend retreat with worship, teaching, outdoor activities, and deep connections with God and peers.
                                </p>
                                <div class="text-xs md:text-sm text-yellow-600">
                                    <i class="fas fa-calendar-alt mr-1"></i> December 15-17, 2024
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-purple-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-purple-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-hands text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-purple-800">Service Projects</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Monthly opportunities to serve the community through outreach, environmental projects, and supporting local ministries.
                                </p>
                                <div class="text-xs md:text-sm text-purple-600">
                                    <i class="fas fa-handshake mr-1"></i> Monthly | Various Locations
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                                Join Our Youth Community
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Come as you are. Whether you're exploring faith or growing in it, you belong here.
                            </p>
                            
                            <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="first_name">
                                            First Name *
                                        </label>
                                        <input type="text" id="first_name" name="first_name" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your first name"
                                               value="{{ old('first_name', auth()->user()->first_name ?? '') }}"
                                               required>
                                        @error('first_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="last_name">
                                            Last Name *
                                        </label>
                                        <input type="text" id="last_name" name="last_name" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your last name"
                                               value="{{ old('last_name', auth()->user()->last_name ?? '') }}"
                                               required>
                                        @error('last_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="email">
                                            Email Address *
                                        </label>
                                        <input type="email" id="email" name="email" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                               placeholder="your.email@example.com"
                                               value="{{ old('email', auth()->user()->email ?? '') }}"
                                               required>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="phone">
                                            Phone Number
                                        </label>
                                        <input type="tel" id="phone" name="phone" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="youthAge">
                                        Your Age Group *
                                    </label>
                                    <select id="youthAge" name="age_group" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                            required>
                                        <option value="">Select age group</option>
                                        <option value="13-15" {{ old('age_group') == '13-15' ? 'selected' : '' }}>13-15 years (Junior High)</option>
                                        <option value="16-18" {{ old('age_group') == '16-18' ? 'selected' : '' }}>16-18 years (Senior High)</option>
                                        <option value="19-25" {{ old('age_group') == '19-25' ? 'selected' : '' }}>19-25 years (Young Adults)</option>
                                    </select>
                                    @error('age_group')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        What role would you like to have?
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select a role (optional)</option>
                                        <option value="Member" {{ old('role') == 'Member' ? 'selected' : '' }}>Regular Member</option>
                                        <option value="Volunteer" {{ old('role') == 'Volunteer' ? 'selected' : '' }}>Volunteer</option>
                                        <option value="Worship Team" {{ old('role') == 'Worship Team' ? 'selected' : '' }}>Worship Team</option>
                                        <option value="Small Group Leader" {{ old('role') == 'Small Group Leader' ? 'selected' : '' }}>Small Group Leader</option>
                                        <option value="Event Coordinator" {{ old('role') == 'Event Coordinator' ? 'selected' : '' }}>Event Coordinator</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Areas of Interest (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Sunday Youth Service" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Sunday Youth Service', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Sunday Youth Service</span>
                                        </label>
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Friday Game Nights" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Friday Game Nights', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Friday Game Nights</span>
                                        </label>
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Small Group Bible Study" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Small Group Bible Study', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Small Group Bible Study</span>
                                        </label>
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Service & Mission Trips" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Service & Mission Trips', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Service & Mission Trips</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="message">
                                        Tell us about yourself (Optional)
                                    </label>
                                    <textarea id="message" name="message" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                              placeholder="What brings you to our youth ministry? Any hobbies or interests?...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Join Youth Ministry
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='#contact'">
                                        <i class="fas fa-hands-helping mr-2"></i>
                                        Volunteer as Leader
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    By joining, you agree to receive updates about youth ministry events and activities.
                                    You can unsubscribe at any time.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-green-50 to-emerald-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                            <div class="text-center">
                                <div class="mb-4 md:mb-6">
                                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-3xl md:text-4xl text-green-600"></i>
                                    </div>
                                </div>
                                
                                <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-3 md:mb-4">
                                    You're Already a Member!
                                </h2>
                                
                                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                                    Welcome to the <span class="font-semibold text-green-800">{{ $ministry->name }}</span> family! 
                                    We're excited to have you as part of our community.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-green-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-green-500 mt-1 mr-3"></i>
                                                <span>Check our <a href="#events" class="text-green-600 hover:text-green-800">upcoming events</a></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-users text-green-500 mt-1 mr-3"></i>
                                                <span>Join our next gathering: <strong>Sunday 6:00 PM</strong> at Youth Chapel</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-green-500 mt-1 mr-3"></i>
                                                <span>You'll receive email updates about ministry activities</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Upcoming Events
                                    </a>
                                    <a href="{{ route('ministries.index') }}" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-white text-green-700 font-semibold rounded-lg hover:bg-green-50 transition-all duration-200 shadow-lg hover:shadow-xl border border-green-200 flex items-center justify-center">
                                        <i class="fas fa-church mr-2"></i>
                                        Explore Other Ministries
                                    </a>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6 md:space-y-8">
                    
                    <!-- Ministry Leader Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Youth Ministry Leader
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-green-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Youth Leader' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Youth Leader' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center">
                                            <i class="fas fa-user text-3xl md:text-4xl text-green-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-green-800">
                                {{ $ministry?->leader_name ?? 'Youth Pastor' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Youth Ministry Director
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Our youth pastor is passionate about guiding young people in their faith journey and helping them discover their purpose in Christ.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Leader
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Weekly Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-green-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-green-800 text-sm md:text-base">Sunday Youth Service</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>6:00 PM - 8:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Youth Chapel</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-blue-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Friday Game Night</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>7:00 PM - 10:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Youth Center</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-yellow-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-yellow-800 text-sm md:text-base">Bible Study (Small Groups)</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Wednesday 5:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Various Homes</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Info</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-green-200"></i>
                                <span>Youth Members: 500+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-user-friends mr-3 text-green-200"></i>
                                <span>Age Range: 13-25 years</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-calendar-alt mr-3 text-green-200"></i>
                                <span>Main Service: Sunday 6PM</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-volleyball-ball mr-3 text-green-200"></i>
                                <span>Activities: Weekly</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Our Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-green-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4">
                                "Don't let anyone look down on you because you are young, but set an example for the believers in speech, in conduct, in love, in faith and in purity."
                            </blockquote>
                            <p class="font-semibold text-green-600 text-sm md:text-base">— 1 Timothy 4:12 (NIV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Upcoming Youth Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-green-800 text-sm md:text-base">{{ $event->title }}</h4>
                                            @if($event->status)
                                                <span class="event-status status-{{ strtolower($event->status) }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs md:text-sm text-gray-600 mb-1">
                                            <i class="fas fa-calendar-alt mr-2 text-green-500"></i>
                                            @if($event->start_date && $event->end_date)
                                                @if($event->start_date == $event->end_date)
                                                    <span>{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</span>
                                                @else
                                                    <span>{{ \Carbon\Carbon::parse($event->start_date)->format('F j') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y') }}</span>
                                                @endif
                                            @elseif($event->start_date)
                                                <span>{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</span>
                                            @endif
                                        </div>
                                        
                                        @if($event->time)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2">
                                                <i class="fas fa-clock mr-2 text-green-500"></i>
                                                <span>{{ $event->time }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($event->location)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2 md:mb-3">
                                                <i class="fas fa-map-marker-alt mr-2 text-green-500"></i>
                                                <span class="truncate">{{ $event->location }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($event->excerpt)
                                            <p class="text-xs md:text-sm text-gray-700 mb-2 md:mb-3 line-clamp-2">
                                                {{ $event->excerpt }}
                                            </p>
                                        @endif
                                        
                                        <div class="flex justify-between items-center">
                                            @if($event->registration_link)
                                                <a href="{{ $event->registration_link }}" 
                                                   target="_blank"
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-green-500 text-white text-xs md:text-sm rounded hover:bg-green-600 transition">
                                                    Register Now
                                                </a>
                                            @elseif($event->slug)
                                                <a href="{{ route('events.show', $event->slug) }}" 
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-green-500 text-white text-xs md:text-sm rounded hover:bg-green-600 transition">
                                                    View Details
                                                </a>
                                            @endif
                                            
                                            @if($event->is_featured)
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                                    <i class="fas fa-star mr-1"></i>Featured
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- View All Events Link -->
                            <div class="mt-4 md:mt-6 text-center">
                                <a href="{{ route('events.index') }}" 
                                   class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm md:text-base">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    View All Events
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 md:py-8">
                                <i class="fas fa-calendar-alt text-2xl md:text-3xl text-gray-300 mb-3 md:mb-4"></i>
                                <p class="text-gray-500 text-sm md:text-base mb-3 md:mb-4">No upcoming events scheduled</p>
                                <a href="{{ route('events.index') }}" 
                                   class="px-3 py-2 md:px-4 md:py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition text-sm md:text-base">
                                    Browse All Events
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Safety Info -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Our Commitment
                        </h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Safe and inclusive environment for all</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Trained and vetted youth leaders</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Age-appropriate teaching and activities</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Open communication with parents</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-t border-green-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-green-900 mb-3 md:mb-4">
                    Ready to Grow with Us?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Join a community where you can be yourself, grow in faith, and make lifelong friends.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-user-plus mr-2"></i>
                        Join Youth Ministry
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Form submission handling - Updated
    document.addEventListener('DOMContentLoaded', function() {
        // Remove old form submission handling since we now have proper form submission
        
        // Smooth scroll to join form
        const joinButtons = document.querySelectorAll('a[href="#join"]');
        joinButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector('#join');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        // Add bounce animation to interactive elements
        const animatedElements = document.querySelectorAll('.hover\\:scale-105');
        animatedElements.forEach(el => {
            el.addEventListener('mouseenter', function() {
                this.classList.add('bounce-once');
            });
            
            el.addEventListener('animationend', function() {
                this.classList.remove('bounce-once');
            });
        });
        
        // Event card hover effects
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-green-50.to-emerald-100');
        eventCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('transform', '-translate-y-1', 'shadow-md');
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('transform', '-translate-y-1', 'shadow-md');
            });
        });
        
        // Prevent zoom on iOS when focusing inputs
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                if (window.innerWidth <= 768) {
                    this.style.fontSize = '16px';
                }
            });
            
            input.addEventListener('blur', function() {
                this.style.fontSize = '';
            });
        });
        
        // Handle touch events for mobile
        document.addEventListener('touchstart', function() {}, {passive: true});
        
        // Auto-hide success messages after 5 seconds
        setTimeout(function() {
            const successMessages = document.querySelectorAll('.bg-green-100');
            successMessages.forEach(message => {
                message.style.display = 'none';
            });
        }, 5000);
    });
</script>
@endsection