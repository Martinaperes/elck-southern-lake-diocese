{{-- mens-ministry.blade.php --}}
@extends('layouts.app')
@section('title','Men\'s Ministry - ELCK Southern Lake')
@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'mens-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #1e3a8a;
    --accent: #0c4a6e;
    --highlight: #f59e0b;
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
    background-image: url('https://images.pexels.com/photos/8957587/pexels-photo-8957587.jpeg');
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
                rgba(30, 58, 138, 0.75) 50%, 
                rgba(59, 130, 246, 0.65) 100%);
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
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-sky-50 font-sans safe-area-padding">
    
    <!-- Compact Banner Section -->
    <div class="relative hero-header py-8 md:py-12 lg:py-16">
        <!-- Gradient overlay for better text contrast -->
        <div class="absolute inset-0 hero-overlay"></div>
        
        <!-- Decorative elements (hidden on mobile for performance) -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-blue-400 rounded-full opacity-10 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-indigo-400 rounded-full opacity-10 blur-2xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Back button - moved to top left -->
                <div class="mb-4 md:mb-6">
                    <a href="/ministries" class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 px-3 py-2 md:px-4 md:py-2 rounded-lg font-semibold group transition-all duration-200 text-sm md:text-base">
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
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 md:mb-3 text-center leading-tight">
                    Men's Ministry
                    <span class="block text-yellow-300 text-lg md:text-xl lg:text-2xl mt-1">(Building Godly Men)</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-blue-100 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Equipping men to lead with integrity, serve with passion, and grow in faith together
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-yellow-400 to-blue-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-yellow-300">85+</div>
                        <div class="text-blue-100 font-medium text-xs md:text-sm">Active Members</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-sky-300">Weekly</div>
                        <div class="text-blue-100 font-medium text-xs md:text-sm">Bible Study</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-blue-300">Monthly</div>
                        <div class="text-blue-100 font-medium text-xs md:text-sm">Service Projects</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#eff6ff"/>
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
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Our Mission
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                            The ELCK Men's Ministry is dedicated to spiritually nurturing and equipping men to lead in their families, church, and communities. We create a brotherhood where men can grow in faith, build authentic relationships, and discover their God-given purpose through Christ-centered fellowship and service.
                        </p>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-blue-600">
                            <p class="text-lg md:text-xl font-semibold text-blue-800 italic">
                                "Be watchful, stand firm in the faith, act like men, be strong." — 1 Corinthians 16:13 (ESV)
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/mens-ministry-1.jpg')}}" 
                                     alt="Men's Fellowship" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/mens-ministry.jpg')}}" 
                                     alt="Men's Bible Study" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Core Activities
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Activity 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-bible text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Men's Bible Study</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Weekly deep dive into Scripture exploring practical applications for men in today's world. We focus on leadership, integrity, spiritual discipline, and godly character.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <span class="font-medium">Every Saturday | 9:00 AM - 11:00 AM | Fellowship Hall</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-hands-helping text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Service Projects</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Monthly hands-on service to our community. We assist elderly members with home repairs, participate in environmental clean-ups, organize food drives, and support church maintenance.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        <span class="font-medium">3rd Saturday Monthly | Various Community Locations</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-users text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Brotherhood Fellowship</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Building authentic relationships through sports, outings, and social events. Monthly basketball games, fishing trips, and men's breakfasts strengthen our brotherhood.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-volleyball-ball mr-2"></i>
                                        <span class="font-medium">1st Saturday Monthly | Sports & Social Activities</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-graduation-cap text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Leadership Training</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Quarterly workshops on leadership, financial stewardship, marriage enrichment, and parenting. Equipping men to lead effectively at home, work, and in the church.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                                        <span class="font-medium">Quarterly | Saturday Workshops | Special Guests</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Events & Programs Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Featured Programs
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Program 1 -->
                            <div class="bg-gradient-to-br from-blue-50 to-sky-100 rounded-lg md:rounded-xl p-4 md:p-6 border border-blue-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-campground text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-blue-800">Annual Men's Retreat</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Three-day spiritual getaway with worship, teaching, outdoor activities, and deep fellowship. A life-changing experience for spiritual renewal.
                                </p>
                                <div class="text-xs md:text-sm text-blue-600">
                                    <i class="fas fa-calendar-alt mr-1"></i> October 18-20, 2024 | Mountain View Retreat Center
                                </div>
                            </div>

                            <!-- Program 2 -->
                            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-yellow-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-yellow-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-user-graduate text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-yellow-800">Mentorship Program</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Pairing younger men with seasoned mentors for discipleship, accountability, and growth in faith and life skills.
                                </p>
                                <div class="text-xs md:text-sm text-yellow-600">
                                    <i class="fas fa-handshake mr-1"></i> Year-round | One-on-One Mentoring
                                </div>
                            </div>

                            <!-- Program 3 -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-green-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-home text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-green-800">Family Leadership Series</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Monthly sessions focusing on being godly husbands, fathers, and leaders in the home. Practical biblical teaching for family life.
                                </p>
                                <div class="text-xs md:text-sm text-green-600">
                                    <i class="fas fa-home-heart mr-1"></i> Monthly | Family-focused Teaching
                                </div>
                            </div>

                            <!-- Program 4 -->
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-purple-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-purple-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-briefcase text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-purple-800">Business & Ethics Forum</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Discussions on integrating faith with work, ethical business practices, and being Christian witnesses in professional settings.
                                </p>
                                <div class="text-xs md:text-sm text-purple-600">
                                    <i class="fas fa-building mr-1"></i> Bi-monthly | Professional Development
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                                Join Our Brotherhood
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Become part of a community of men committed to growing in faith, serving others, and building authentic relationships.
                            </p>
                            
                            <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="first_name">
                                            First Name *
                                        </label>
                                        <input type="text" id="first_name" name="first_name" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="age_group">
                                            Age Group *
                                        </label>
                                        <select id="age_group" name="age_group" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                                required>
                                            <option value="">Select age group</option>
                                            <option value="18-25" {{ old('age_group') == '18-25' ? 'selected' : '' }}>18-25 years (Young Adults)</option>
                                            <option value="26-35" {{ old('age_group') == '26-35' ? 'selected' : '' }}>26-35 years</option>
                                            <option value="36-50" {{ old('age_group') == '36-50' ? 'selected' : '' }}>36-50 years</option>
                                            <option value="51-65" {{ old('age_group') == '51-65' ? 'selected' : '' }}>51-65 years</option>
                                            <option value="66+" {{ old('age_group') == '66+' ? 'selected' : '' }}>66+ years (Seniors)</option>
                                        </select>
                                        @error('age_group')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="marital_status">
                                            Marital Status
                                        </label>
                                        <select id="marital_status" name="marital_status" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base">
                                            <option value="">Select marital status</option>
                                            <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                            <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                            <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                            <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="occupation">
                                        Occupation
                                    </label>
                                    <input type="text" id="occupation" name="occupation" 
                                           class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                           placeholder="e.g., Teacher, Engineer, Business Owner, Student"
                                           value="{{ old('occupation') }}">
                                    @error('occupation')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        What role are you interested in?
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select a role (optional)</option>
                                        <option value="Regular Member" {{ old('role') == 'Regular Member' ? 'selected' : '' }}>Regular Member</option>
                                        <option value="Bible Study Leader" {{ old('role') == 'Bible Study Leader' ? 'selected' : '' }}>Bible Study Leader</option>
                                        <option value="Service Project Volunteer" {{ old('role') == 'Service Project Volunteer' ? 'selected' : '' }}>Service Project Volunteer</option>
                                        <option value="Mentor" {{ old('role') == 'Mentor' ? 'selected' : '' }}>Mentor</option>
                                        <option value="Event Coordinator" {{ old('role') == 'Event Coordinator' ? 'selected' : '' }}>Event Coordinator</option>
                                        <option value="Prayer Coordinator" {{ old('role') == 'Prayer Coordinator' ? 'selected' : '' }}>Prayer Coordinator</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Areas of Interest (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Saturday Bible Study" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Saturday Bible Study', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Saturday Bible Study</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Service Projects" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Service Projects', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Service Projects</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Sports & Fellowship" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Sports & Fellowship', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Sports & Fellowship</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Leadership Training" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Leadership Training', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Leadership Training</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Mentorship Program" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Mentorship Program', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Mentorship Program</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Annual Men's Retreat" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Annual Men\'s Retreat', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Annual Men's Retreat</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="message">
                                        Tell us about yourself (Optional)
                                    </label>
                                    <textarea id="message" name="message" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                              placeholder="What are you hoping to gain from the Men's Ministry? Any specific prayer requests?...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Join Men's Ministry
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='#contact'">
                                        <i class="fas fa-hands-helping mr-2"></i>
                                        Volunteer as Leader
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    By joining, you agree to receive updates about men's ministry events and activities. Your information will be kept confidential.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-blue-50 to-sky-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                            <div class="text-center">
                                <div class="mb-4 md:mb-6">
                                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-3xl md:text-4xl text-blue-600"></i>
                                    </div>
                                </div>
                                
                                <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-3 md:mb-4">
                                    You're Already a Member!
                                </h2>
                                
                                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                                    Welcome to the <span class="font-semibold text-blue-800">{{ $ministry->name }}</span> brotherhood! 
                                    We're excited to have you as part of our community of men growing together in Christ.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-blue-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-blue-500 mt-1 mr-3"></i>
                                                <span>Join our next <a href="#events" class="text-blue-600 hover:text-blue-800">Saturday Bible Study</a>: <strong>9:00 AM</strong> at Fellowship Hall</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-users text-blue-500 mt-1 mr-3"></i>
                                                <span>Check our upcoming <a href="#events" class="text-blue-600 hover:text-blue-800">service projects</a> and events</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-blue-500 mt-1 mr-3"></i>
                                                <span>You'll receive email updates about ministry activities</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Upcoming Events
                                    </a>
                                    <a href="{{ route('ministries.index') }}" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl border border-blue-200 flex items-center justify-center">
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
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Men's Ministry Leader
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-blue-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Men\'s Leader' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Men\'s Leader' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-blue-100 to-sky-100 flex items-center justify-center">
                                            <i class="fas fa-user text-3xl md:text-4xl text-blue-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-blue-800">
                                {{ $ministry?->leader_name ?? 'Bro. James Kiprono' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Men's Ministry Coordinator
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'With over 8 years of service, Bro. James is passionate about mentoring men, building authentic brotherhood, and equipping men to lead in their families and communities.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Leader
                            </button>
                        </div>
                    </div>

                    <!-- Weekly Schedule -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Weekly Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-blue-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Saturday Bible Study</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 11:00 AM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Fellowship Hall</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-yellow-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-yellow-800 text-sm md:text-base">Prayer Breakfast</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Tuesday 6:30 AM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Church Kitchen</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-green-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-green-800 text-sm md:text-base">Small Groups</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Thursday 7:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Various Homes</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Info</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-blue-200"></i>
                                <span>Active Members: 85+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-user-friends mr-3 text-blue-200"></i>
                                <span>Age Range: 18+ years</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-calendar-alt mr-3 text-blue-200"></i>
                                <span>Main Meeting: Saturday 9AM</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-hands-helping mr-3 text-blue-200"></i>
                                <span>Service: Monthly Projects</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Our Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-blue-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4">
                                "Be watchful, stand firm in the faith, act like men, be strong."
                            </blockquote>
                            <p class="font-semibold text-blue-600 text-sm md:text-base">— 1 Corinthians 16:13 (ESV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Upcoming Men's Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-blue-50 to-sky-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-blue-800 text-sm md:text-base">{{ $event->title }}</h4>
                                            @if($event->status)
                                                <span class="event-status status-{{ strtolower($event->status) }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs md:text-sm text-gray-600 mb-1">
                                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                                            @if($event->date && $event->end_date)
                                                @if($event->date == $event->end_date)
                                                    <span>{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                                                @else
                                                    <span>{{ \Carbon\Carbon::parse($event->date)->format('F j') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y') }}</span>
                                                @endif
                                            @elseif($event->date)
                                                <span>{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                                            @endif
                                        </div>
                                        
                                        @if($event->time)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2">
                                                <i class="fas fa-clock mr-2 text-blue-500"></i>
                                                <span>{{ $event->time }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($event->location)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2 md:mb-3">
                                                <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
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
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-blue-500 text-white text-xs md:text-sm rounded hover:bg-blue-600 transition">
                                                    Register Now
                                                </a>
                                            @elseif($event->slug)
                                                <a href="{{ route('events.show', $event->slug) }}" 
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-blue-500 text-white text-xs md:text-sm rounded hover:bg-blue-600 transition">
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
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm md:text-base">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    View All Events
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 md:py-8">
                                <i class="fas fa-calendar-alt text-2xl md:text-3xl text-gray-300 mb-3 md:mb-4"></i>
                                <p class="text-gray-500 text-sm md:text-base mb-3 md:mb-4">No upcoming events scheduled</p>
                                <a href="{{ route('events.index') }}" 
                                   class="px-3 py-2 md:px-4 md:py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm md:text-base">
                                    Browse All Events
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Monthly Focus -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Monthly Focus
                        </h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-bullseye text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700"><strong>November:</strong> Family Leadership & Parenting</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-bullseye text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700"><strong>December:</strong> Financial Stewardship</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-bullseye text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700"><strong>January:</strong> Spiritual Disciplines & Prayer Life</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-bullseye text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700"><strong>February:</strong> Marriage & Relationships</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-blue-50 to-sky-50 border-t border-blue-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-blue-900 mb-3 md:mb-4">
                    Ready to Grow with Other Men?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Join a brotherhood committed to faith, integrity, and service. Together we grow stronger in Christ.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-user-plus mr-2"></i>
                        Join Men's Ministry
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Form submission handling
    document.addEventListener('DOMContentLoaded', function() {
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
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-blue-50.to-sky-100');
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