@extends('layouts.app')

@section('title','Evangelism Ministry - ELCK Southern Lake')

@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'evangelism-and-tree-planting-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #3B82F6;
    --accent: #1D4ED8;
    --highlight: #60A5FA;
    --dark: #1E40AF;
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
    background-image: linear-gradient(rgba(59, 130, 246, 0.85), rgba(37, 99, 235, 0.75)), 
                      url('https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=1600&q=80');
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
                rgba(30, 64, 175, 0.85) 0%, 
                rgba(59, 130, 246, 0.75) 50%, 
                rgba(96, 165, 250, 0.65) 100%);
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

/* Evangelism specific styles */
.evangelism-bg {
    background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #E0F2FE 100%);
}

.bible-verse {
    font-family: 'Georgia', serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

/* Cross animation */
@keyframes crossGlow {
    0%, 100% { filter: drop-shadow(0 0 5px rgba(59, 130, 246, 0.5)); }
    50% { filter: drop-shadow(0 0 15px rgba(59, 130, 246, 0.8)); }
}

.cross-glow {
    animation: crossGlow 2s ease-in-out infinite;
}
</style>

@section('content')
<div class="min-h-screen evangelism-bg font-sans safe-area-padding">
    
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
                    <a href="/ministries" class="inline-flex items-center bg-white/20 backdrop-blur-sm text-blue-600 hover:bg-white/30 px-3 py-2 md:px-4 md:py-2 rounded-lg font-semibold group transition-all duration-200 text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to Ministries
                    </a>
                </div>
                
                <!-- Compact Ministry Icon -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 md:p-4 border-2 border-white/30">
                        <i class="fas fa-cross text-2xl md:text-3xl lg:text-4xl text-white cross-glow"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 md:mb-3 text-center leading-tight">
                    Evangelism Ministry
                    <span class="block text-blue-200 text-lg md:text-xl lg:text-2xl mt-1">Sharing the Good News</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-blue-200 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Proclaiming the Gospel of Jesus Christ to all people, making disciples who transform communities with God's love
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-blue-300 to-indigo-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-blue-300">50+</div>
                        <div class="text-blue-200 font-medium text-xs md:text-sm">Outreach Teams</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-indigo-300">Monthly</div>
                        <div class="text-blue-200 font-medium text-xs md:text-sm">Mission Trips</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-cyan-300">1000+</div>
                        <div class="text-blue-200 font-medium text-xs md:text-sm">Lives Touched</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#EFF6FF"/>
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
                            The Evangelism Ministry exists to fulfill the Great Commission by sharing the Gospel of Jesus Christ with all people, making disciples, and equipping believers to be effective witnesses in their communities and beyond. We seek to reach the lost, restore the broken, and revive the Church through the power of the Holy Spirit.
                        </p>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-blue-600">
                            <p class="text-lg md:text-xl font-semibold text-blue-800 italic bible-verse">
                                "Go therefore and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit." - Matthew 28:19
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=800&q=80" 
                                     alt="Street Evangelism" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" 
                                     alt="Community Outreach" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Core Objectives
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Objective 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-bullhorn text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Gospel Proclamation</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Sharing the message of salvation through Jesus Christ in relevant and culturally appropriate ways through various outreach methods.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-street-view mr-2"></i>
                                        <span class="font-medium">Street Evangelism | Door-to-Door | Public Preaching</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-user-graduate text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Discipleship Training</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Equipping believers with biblical knowledge, evangelism skills, and spiritual disciplines to effectively share their faith and make disciples.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                                        <span class="font-medium">Training Workshops | Mentorship Programs | Resource Development</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-hands-helping text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Community Engagement</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Demonstrating God's love through practical service, meeting physical needs as a bridge to sharing spiritual truth.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-heart mr-2"></i>
                                        <span class="font-medium">Service Projects | Medical Missions | Social Outreach</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 4 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-globe text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Cross-Cultural Missions</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Extending evangelistic efforts to unreached people groups and supporting mission work locally, nationally, and internationally.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-blue-600 text-sm md:text-base">
                                        <i class="fas fa-plane mr-2"></i>
                                        <span class="font-medium">Mission Trips | Partnership Development | Cultural Training</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Outreach Methods Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Outreach Methods
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Method 1 -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-blue-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-street-view text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-blue-800">Street Evangelism</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Engaging people in public spaces with the Gospel through one-on-one conversations, tract distribution, and open-air preaching.
                                </p>
                                <div class="text-xs md:text-sm text-blue-600">
                                    <i class="fas fa-calendar mr-1"></i> Every Saturday 10:00 AM | City Center
                                </div>
                            </div>

                            <!-- Method 2 -->
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-indigo-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-indigo-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-home text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-indigo-800">Home Visitation</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Visiting homes in our community to build relationships, pray with families, and share the love of Christ in personal settings.
                                </p>
                                <div class="text-xs md:text-sm text-indigo-600">
                                    <i class="fas fa-clock mr-1"></i> Weekdays by Appointment | Various Neighborhoods
                                </div>
                            </div>

                            <!-- Method 3 -->
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-purple-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-purple-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-heartbeat text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-purple-800">Medical Missions</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Providing free medical care and health education while sharing the Gospel with patients and their families.
                                </p>
                                <div class="text-xs md:text-sm text-purple-600">
                                    <i class="fas fa-calendar-alt mr-1"></i> Monthly | Rural Communities
                                </div>
                            </div>

                            <!-- Method 4 -->
                            <div class="bg-gradient-to-br from-violet-50 to-blue-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-violet-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-violet-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-laptop text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-violet-800">Digital Evangelism</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Using social media, websites, and online platforms to reach people with the Gospel message in the digital space.
                                </p>
                                <div class="text-xs md:text-sm text-violet-600">
                                    <i class="fas fa-globe mr-1"></i> 24/7 | Online Platforms
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                                Join the Evangelism Team
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Answer the call to share the Good News. Whether you're an experienced evangelist or new to sharing your faith, there's a place for you.
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
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="experience">
                                        Evangelism Experience *
                                    </label>
                                    <select id="experience" name="experience_level" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                            required>
                                        <option value="">Select your experience level</option>
                                        <option value="Beginner" {{ old('experience_level') == 'Beginner' ? 'selected' : '' }}>Beginner (New to evangelism)</option>
                                        <option value="Some Experience" {{ old('experience_level') == 'Some Experience' ? 'selected' : '' }}>Some Experience</option>
                                        <option value="Experienced" {{ old('experience_level') == 'Experienced' ? 'selected' : '' }}>Experienced</option>
                                        <option value="Leader" {{ old('experience_level') == 'Leader' ? 'selected' : '' }}>Leader/Trainer</option>
                                    </select>
                                    @error('experience_level')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        Preferred Outreach Method
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select preferred method (optional)</option>
                                        <option value="Street Evangelism" {{ old('role') == 'Street Evangelism' ? 'selected' : '' }}>Street Evangelism</option>
                                        <option value="Home Visitation" {{ old('role') == 'Home Visitation' ? 'selected' : '' }}>Home Visitation</option>
                                        <option value="Medical Missions" {{ old('role') == 'Medical Missions' ? 'selected' : '' }}>Medical Missions</option>
                                        <option value="Digital Evangelism" {{ old('role') == 'Digital Evangelism' ? 'selected' : '' }}>Digital Evangelism</option>
                                        <option value="All Methods" {{ old('role') == 'All Methods' ? 'selected' : '' }}>All Methods</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Training Interests (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Sharing Your Testimony" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Sharing Your Testimony', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Sharing Your Testimony</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Gospel Presentation" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Gospel Presentation', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Gospel Presentation</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Answering Questions" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Answering Questions', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Answering Questions</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Follow-up Discipleship" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Follow-up Discipleship', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Follow-up Discipleship</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="testimony">
                                        Your Testimony (Optional)
                                    </label>
                                    <textarea id="testimony" name="testimony" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                              placeholder="Briefly share how you came to know Christ...">{{ old('testimony') }}</textarea>
                                    @error('testimony')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-cross mr-2"></i>
                                        Join Evangelism Team
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='{{ route('ministries.index') }}'">
                                        <i class="fas fa-hands-helping mr-2"></i>
                                        Volunteer for Missions
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    By joining, you agree to participate in evangelism training and commit to regular outreach activities as able.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-blue-50 to-indigo-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
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
                                    Welcome to the <span class="font-semibold text-blue-800">{{ $ministry->name ?? 'Evangelism Ministry' }}</span> team! 
                                    We're excited to partner with you in sharing the Gospel.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-blue-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-blue-500 mt-1 mr-3"></i>
                                                <span>Next outreach: <strong>Saturday 10:00 AM</strong> at City Center</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-book text-blue-500 mt-1 mr-3"></i>
                                                <span>Required training: <strong>Basic Evangelism Workshop</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-users text-blue-500 mt-1 mr-3"></i>
                                                <span>Your team: <strong>{{ old('role', 'Street Evangelism') }}</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-blue-500 mt-1 mr-3"></i>
                                                <span>You'll receive weekly outreach updates</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Upcoming Outreaches
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
                            Evangelism Director
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-blue-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Evangelism Director' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Evangelism Director' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                                            <i class="fas fa-user text-3xl md:text-4xl text-blue-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-blue-800">
                                {{ $ministry?->leader_name ?? 'Evangelism Director' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Evangelism Ministry Director
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Our director has extensive experience in evangelism training, cross-cultural missions, and church planting, with a passion for reaching the lost with the Gospel.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Director
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Weekly Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-blue-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Street Evangelism</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Saturdays 10:00 AM - 1:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>City Center</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-indigo-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-indigo-800 text-sm md:text-base">Training Workshop</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Thursdays 6:00 PM - 8:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Fellowship Hall</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-purple-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-purple-800 text-sm md:text-base">Prayer Meeting</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Mondays 7:00 PM - 8:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Prayer Room</span>
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
                                <span>Active Members: 150+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-cross mr-3 text-blue-200"></i>
                                <span>Monthly Conversions: 20+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-calendar-alt mr-3 text-blue-200"></i>
                                <span>Weekly Outreach: Saturdays</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-globe mr-3 text-blue-200"></i>
                                <span>Mission Fields: 5 Countries</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-blue-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4 bible-verse">
                                "How beautiful are the feet of those who preach the good news!"
                            </blockquote>
                            <p class="font-semibold text-blue-600 text-sm md:text-base">— Romans 10:15 (ESV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Upcoming Evangelism Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
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

                
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-t border-blue-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-blue-900 mb-3 md:mb-4">
                    Ready to Share the Good News?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Join us in fulfilling the Great Commission. Be equipped to share your faith and make disciples.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-cross mr-2"></i>
                        Join Evangelism Team
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
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-blue-50.to-indigo-100');
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