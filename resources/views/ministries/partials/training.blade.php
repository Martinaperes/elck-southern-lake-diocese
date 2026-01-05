{{-- clergy-training.blade.php --}}
@extends('layouts.app')
@section('title','Clergy Training - ELCK Southern Lake')
@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'clergy-and-lay-leader-training')->first();
    }
@endphp

<style>
:root {
    --primary: #1e40af;
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
    background-image: linear-gradient(rgba(30, 64, 175, 0.85), rgba(59, 130, 246, 0.75)), 
                      url('https://images.unsplash.com/photo-1503386435952-d7918b99d4c5?auto=format&fit=crop&w=1600&q=80');
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
                rgba(30, 64, 175, 0.75) 50%, 
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

/* Scholarship badge */
.scholarship-badge {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    font-weight: bold;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
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
                        <i class="fas fa-graduation-cap text-2xl md:text-3xl lg:text-4xl text-white"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 md:mb-3 text-center leading-tight">
                    Clergy Training Ministry
                    <span class="block text-yellow-300 text-lg md:text-xl lg:text-2xl mt-1">(Lutheran School of Theology)</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-blue-100 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Equipping faithful servants for ordained ministry and lay leadership in the Lutheran tradition
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-yellow-400 to-blue-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-yellow-300">150+</div>
                        <div class="text-blue-100 font-medium text-xs md:text-sm">Graduates</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-sky-300">3 Year</div>
                        <div class="text-blue-100 font-medium text-xs md:text-sm">DTh Program</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-blue-300">100%</div>
                        <div class="text-blue-100 font-medium text-xs md:text-sm">Accredited</div>
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
                            The Lutheran School of Theology (LST) forms African Lutherans to be orthodox teachers of the faith and faithful pastors of the Gospel. We equip clergy and lay leaders to serve the church and community with theological depth, spiritual maturity, and practical competence.
                        </p>
                        <div class="bg-gradient-to-r from-blue-50 to-sky-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-blue-600">
                            <p class="text-lg md:text-xl font-semibold text-blue-800 italic">
                                "Equip the saints for the work of ministry, for building up the body of Christ." — Ephesians 4:12
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{asset('images/ministries/clergy-and-lay-leader-training.jpg')}}" 
                                     alt="Theological Seminary" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{asset('images/ministries/literacy3.jpg')}}" 
                                     alt="Bible Study" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Academic Programs
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Program 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-graduation-cap text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Diploma in Theology (DTh)</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Three-year residential program preparing candidates for ordination. Includes comprehensive theological education and supervised vicarage.
                                    </p>
                                    <div class="mt-2 md:mt-3">
                                        <div class="flex items-center text-blue-600 text-sm md:text-base mb-1">
                                            <i class="fas fa-book-open mr-2"></i>
                                            <span class="font-medium">Core Courses:</span>
                                        </div>
                                        <ul class="list-disc list-inside ml-6 text-gray-600 text-sm">
                                            <li>Biblical Studies (Old & New Testament)</li>
                                            <li>Lutheran Doctrine & Confessions</li>
                                            <li>Church History & Systematic Theology</li>
                                            <li>Pastoral Theology & Homiletics</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Program 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-certificate text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Certificate in Evangelistic Training (CET)</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        One-year program equipping lay leaders for evangelism, outreach, and church planting ministries.
                                    </p>
                                    <div class="mt-2 md:mt-3">
                                        <div class="flex items-center text-blue-600 text-sm md:text-base mb-1">
                                            <i class="fas fa-hands-helping mr-2"></i>
                                            <span class="font-medium">Focus Areas:</span>
                                        </div>
                                        <ul class="list-disc list-inside ml-6 text-gray-600 text-sm">
                                            <li>Evangelism Methods & Strategies</li>
                                            <li>Cross-cultural Ministry</li>
                                            <li>Church Planting Fundamentals</li>
                                            <li>Discipleship & Follow-up</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Program 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-users text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Continuing Education</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Short courses, workshops, and seminars for clergy and lay leaders in active ministry.
                                    </p>
                                    <div class="mt-2 md:mt-3">
                                        <div class="flex items-center text-blue-600 text-sm md:text-base mb-1">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            <span class="font-medium">Offerings Include:</span>
                                        </div>
                                        <ul class="list-disc list-inside ml-6 text-gray-600 text-sm">
                                            <li>Pastoral Leadership Development</li>
                                            <li>Biblical Preaching Workshops</li>
                                            <li>Church Administration</li>
                                            <li>Theological Refresher Courses</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Practical Training Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                            Practical Ministry Training
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Training 1 -->
                            <div class="bg-gradient-to-br from-blue-50 to-sky-100 rounded-lg md:rounded-xl p-4 md:p-6 border border-blue-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-hands-praying text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-blue-800">Supervised Vicarage</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    One-year practical internship in a parish under experienced clergy. Includes preaching, teaching, pastoral care, and administration.
                                </p>
                                <div class="text-xs md:text-sm text-blue-600">
                                    <i class="fas fa-clock mr-1"></i> Required for DTh Graduation
                                </div>
                            </div>

                            <!-- Training 2 -->
                            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-yellow-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-yellow-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-seedling text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-yellow-800">Community Service</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Students participate in campus farm work, maintenance, and community outreach to develop servant leadership skills.
                                </p>
                                <div class="text-xs md:text-sm text-yellow-600">
                                    <i class="fas fa-users mr-1"></i> Weekly Campus Service
                                </div>
                            </div>

                            <!-- Training 3 -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-green-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-church text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-green-800">Parish Ministry</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Weekend ministry assignments in local congregations to apply classroom learning in real ministry contexts.
                                </p>
                                <div class="text-xs md:text-sm text-green-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Various ELCK Parishes
                                </div>
                            </div>

                            <!-- Training 4 -->
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-purple-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-purple-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-graduation-cap text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-purple-800">Academic Excellence</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Rigorous academic program accredited for quality assurance and transferability of credits.
                                </p>
                                <div class="text-xs md:text-sm text-purple-600">
                                    <i class="fas fa-award mr-1"></i> Fully Accredited Institution
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-blue-100">
                                Apply for Theological Training
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Explore your calling to ordained ministry or lay leadership. Complete this form to begin your application process.
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
                                            Phone Number *
                                        </label>
                                        <input type="tel" id="phone" name="phone" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                               required>
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="program">
                                            Program of Interest *
                                        </label>
                                        <select id="program" name="program" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                                required>
                                            <option value="">Select program</option>
                                            <option value="Diploma in Theology (DTh)" {{ old('program') == 'Diploma in Theology (DTh)' ? 'selected' : '' }}>Diploma in Theology (DTh)</option>
                                            <option value="Certificate in Evangelistic Training (CET)" {{ old('program') == 'Certificate in Evangelistic Training (CET)' ? 'selected' : '' }}>Certificate in Evangelistic Training (CET)</option>
                                            <option value="Continuing Education" {{ old('program') == 'Continuing Education' ? 'selected' : '' }}>Continuing Education</option>
                                            <option value="Undecided" {{ old('program') == 'Undecided' ? 'selected' : '' }}>Undecided / Seeking Guidance</option>
                                        </select>
                                        @error('program')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="education">
                                            Highest Education *
                                        </label>
                                        <select id="education" name="education" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                                required>
                                            <option value="">Select education level</option>
                                            <option value="High School" {{ old('education') == 'High School' ? 'selected' : '' }}>High School Diploma</option>
                                            <option value="Certificate" {{ old('education') == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                                            <option value="Diploma" {{ old('education') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                            <option value="Bachelor's Degree" {{ old('education') == 'Bachelor\'s Degree' ? 'selected' : '' }}>Bachelor's Degree</option>
                                            <option value="Master's Degree" {{ old('education') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                                            <option value="Other" {{ old('education') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('education')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="current_role">
                                        Current Church Role
                                    </label>
                                    <input type="text" id="current_role" name="current_role" 
                                           class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                           placeholder="e.g., Elder, Sunday School Teacher, Youth Leader"
                                           value="{{ old('current_role') }}">
                                    @error('current_role')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="years_in_ministry">
                                            Years in Ministry
                                        </label>
                                        <select id="years_in_ministry" name="years_in_ministry" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base">
                                            <option value="">Select years</option>
                                            <option value="0-2" {{ old('years_in_ministry') == '0-2' ? 'selected' : '' }}>0-2 years</option>
                                            <option value="3-5" {{ old('years_in_ministry') == '3-5' ? 'selected' : '' }}>3-5 years</option>
                                            <option value="6-10" {{ old('years_in_ministry') == '6-10' ? 'selected' : '' }}>6-10 years</option>
                                            <option value="10+" {{ old('years_in_ministry') == '10+' ? 'selected' : '' }}>10+ years</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="denomination">
                                            Denomination *
                                        </label>
                                        <input type="text" id="denomination" name="denomination" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                               placeholder="e.g., Lutheran, Anglican, Catholic"
                                               value="{{ old('denomination', 'Lutheran') }}"
                                               required>
                                        @error('denomination')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Areas of Interest (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Ordained Ministry" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Ordained Ministry', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Ordained Ministry</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Lay Leadership" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Lay Leadership', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Lay Leadership</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Church Planting" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Church Planting', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Church Planting</span>
                                        </label>
                                        <label class="flex items-center bg-blue-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Theological Education" 
                                                   class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Theological Education', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Theological Education</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="calling_testimony">
                                        Briefly describe your calling to ministry *
                                    </label>
                                    <textarea id="calling_testimony" name="calling_testimony" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm md:text-base"
                                              placeholder="Share how you feel called to ministry and what led you to consider theological training..."
                                              required>{{ old('calling_testimony') }}</textarea>
                                    @error('calling_testimony')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 md:p-5">
                                    <h3 class="font-semibold text-yellow-800 mb-2 text-sm md:text-base">Financial Information</h3>
                                    <p class="text-gray-700 text-sm md:text-base mb-3">
                                        Tuition assistance and scholarships may be available for qualified candidates. Will you require financial assistance?
                                    </p>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="financial_assistance" value="Yes" 
                                                   class="text-yellow-600 focus:ring-yellow-500 h-4 w-4"
                                                   {{ old('financial_assistance') == 'Yes' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Yes, I will need financial assistance</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="financial_assistance" value="No" 
                                                   class="text-yellow-600 focus:ring-yellow-500 h-4 w-4"
                                                   {{ old('financial_assistance') == 'No' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">No, I have financial support</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="financial_assistance" value="Undecided" 
                                                   class="text-yellow-600 focus:ring-yellow-500 h-4 w-4"
                                                   {{ old('financial_assistance') == 'Undecided' ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Not sure / Need more information</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Submit Application
                                    </button>
                                    
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    Note: This is a preliminary application. Successful applicants will be contacted for interviews and required to submit additional documentation including academic transcripts, letters of recommendation, and a medical report.
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
                                    Application Received!
                                </h2>
                                
                                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                                    Thank you for your interest in the <span class="font-semibold text-blue-800">{{ $ministry->name }}</span>. 
                                    Your application has been received and will be reviewed by our admissions committee.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-blue-800 mb-2">Next Steps in the Process</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-blue-500 mt-1 mr-3"></i>
                                                <span>You'll receive an email confirmation with your application reference number</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-blue-500 mt-1 mr-3"></i>
                                                <span>Admissions committee will review your application within 2-3 weeks</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-file-alt text-blue-500 mt-1 mr-3"></i>
                                                <span>If shortlisted, you'll be asked to submit additional documents</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-user-friends text-blue-500 mt-1 mr-3"></i>
                                                <span>Final step: Interview with seminary faculty</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Seminary Events
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
                    
                    <!-- Seminary Dean Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Seminary Dean
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-blue-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Seminary Dean' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Seminary Dean' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-blue-100 to-sky-100 flex items-center justify-center">
                                            <i class="fas fa-user-tie text-3xl md:text-4xl text-blue-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-blue-800">
                                {{ $ministry?->leader_name ?? 'Dr. John Mwangi' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Dean, Lutheran School of Theology
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Dr. Mwangi brings 25 years of theological education experience and pastoral ministry to training the next generation of Lutheran leaders in Africa.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Dean
                            </button>
                        </div>
                    </div>

                    <!-- Academic Calendar -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Academic Calendar
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-blue-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Trimester 1</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Jan 15 - Apr 15, 2025</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-book-open mr-2"></i>
                                    <span>Core Theology Courses</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-yellow-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-yellow-800 text-sm md:text-base">Trimester 2</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>May 15 - Aug 15, 2025</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-hands-praying mr-2"></i>
                                    <span>Pastoral Ministry Courses</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-green-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-green-800 text-sm md:text-base">Trimester 3</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Sep 15 - Dec 15, 2025</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-church mr-2"></i>
                                    <span>Field Education & Vicarage</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Facts</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-graduation-cap mr-3 text-blue-200"></i>
                                <span>Founded: 1985</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-blue-200"></i>
                                <span>Current Students: 120</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-church mr-3 text-blue-200"></i>
                                <span>Faculty: 15 Professors</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-book mr-3 text-blue-200"></i>
                                <span>Library: 20,000+ Volumes</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scholarship Info -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Scholarships Available
                        </h3>
                        <div class="space-y-3">
                            <div class="bg-yellow-50 rounded-lg p-3 border border-yellow-200">
                                <div class="flex items-center mb-2">
                                    <span class="scholarship-badge">Full Scholarship</span>
                                </div>
                                <p class="text-xs md:text-sm text-gray-700">
                                    For exceptional candidates pursuing ordination. Covers tuition, accommodation, and meals.
                                </p>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                                <div class="flex items-center mb-2">
                                    <span class="bg-blue-100 text-blue-800 font-medium px-2 py-1 rounded text-xs">Partial Scholarship</span>
                                </div>
                                <p class="text-xs md:text-sm text-gray-700">
                                    50% tuition assistance for students with demonstrated financial need.
                                </p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3 border border-green-200">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-100 text-green-800 font-medium px-2 py-1 rounded text-xs">Sponsored Programs</span>
                                </div>
                                <p class="text-xs md:text-sm text-gray-700">
                                    Diocese-sponsored training for approved candidates.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Upcoming Seminary Events
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

                    <!-- Admission Requirements -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-blue-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-blue-100">
                            Admission Requirements
                        </h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Minimum KCSE Grade C+ or equivalent</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Letter of recommendation from home church</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Statement of faith & calling testimony</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Medical certificate of fitness</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Successful interview with faculty</span>
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
                    Answering the Call to Ministry?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Begin your theological training journey with the Lutheran School of Theology. Equip yourself for faithful service.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    @if(!$isMember)
                        <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Start Your Application
                        </a>
                    @else
                        <a href="mailto:seminary@elck.org" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                            <i class="fas fa-envelope mr-2"></i>
                            Contact Admissions
                        </a>
                    @endif
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
        
        // Form validation for calling testimony length
        const testimonyField = document.getElementById('calling_testimony');
        if (testimonyField) {
            testimonyField.addEventListener('input', function() {
                const charCount = this.value.length;
                const minChars = 100;
                
                if (charCount < minChars) {
                    this.style.borderColor = '#f87171';
                    this.nextElementSibling?.remove();
                    const warning = document.createElement('p');
                    warning.className = 'text-red-500 text-xs mt-1';
                    warning.textContent = `Please write at least ${minChars} characters (currently ${charCount})`;
                    this.parentNode.insertBefore(warning, this.nextSibling);
                } else {
                    this.style.borderColor = '#60a5fa';
                    this.nextElementSibling?.remove();
                }
            });
        }
    });
</script>
@endsection