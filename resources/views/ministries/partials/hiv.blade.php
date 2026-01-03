@extends('layouts.app')

@section('title','HIV & AIDS Ministry - ELCK Southern Lake')

@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'hiv-and-aids-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #DC2626;
    --accent: #B91C1C;
    --highlight: #FEE2E2;
    --dark: #991B1B;
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
    background-image: linear-gradient(rgba(220, 38, 38, 0.85), rgba(185, 28, 28, 0.75)), 
                      url('https://images.unsplash.com/photo-1586773860418-dc22f8b874bc?auto=format&fit=crop&w=1600&q=80');
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
                rgba(153, 27, 27, 0.85) 0%, 
                rgba(220, 38, 38, 0.75) 50%, 
                rgba(254, 226, 226, 0.65) 100%);
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

/* HIV/AIDS specific styles */
.hiv-bg {
    background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 50%, #FECACA 100%);
}

.bible-verse {
    font-family: 'Georgia', serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

/* Ribbon animation */
@keyframes ribbonWave {
    0%, 100% { transform: translateX(0) rotate(0deg); }
    50% { transform: translateX(5px) rotate(2deg); }
}

.ribbon-wave {
    animation: ribbonWave 3s ease-in-out infinite;
}
</style>

@section('content')
<div class="min-h-screen hiv-bg font-sans safe-area-padding">
    
    <!-- Compact Banner Section -->
    <div class="relative hero-header py-8 md:py-12 lg:py-16">
        <!-- Gradient overlay for better text contrast -->
        <div class="absolute inset-0 hero-overlay"></div>
        
        <!-- Decorative elements (hidden on mobile for performance) -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-red-400 rounded-full opacity-10 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-pink-400 rounded-full opacity-10 blur-2xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Back button - moved to top left -->
                <div class="mb-4 md:mb-6">
                    <a href="/ministries" class="inline-flex items-center bg-white/20 backdrop-blur-sm text-red-600 hover:bg-white/30 px-3 py-2 md:px-4 md:py-2 rounded-lg font-semibold group transition-all duration-200 text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to Ministries
                    </a>
                </div>
                
                <!-- Compact Ministry Icon -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 md:p-4 border-2 border-white/30">
                        <i class="fas fa-heartbeat text-2xl md:text-3xl lg:text-4xl text-white ribbon-wave"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 md:mb-3 text-center leading-tight">
                    HIV & AIDS Ministry
                    <span class="block text-red-200 text-lg md:text-xl lg:text-2xl mt-1">Compassion, Care, and Hope</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-red-200 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Providing compassionate care, education, and support to those affected by HIV/AIDS while breaking stigma with love and understanding
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-red-300 to-pink-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-red-300">500+</div>
                        <div class="text-red-200 font-medium text-xs md:text-sm">Individuals Supported</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-pink-300">Weekly</div>
                        <div class="text-red-200 font-medium text-xs md:text-sm">Support Groups</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-red-200">24/7</div>
                        <div class="text-red-200 font-medium text-xs md:text-sm">Crisis Support</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#FEF2F2"/>
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
                        <h2 class="text-2xl md:text-3xl font-bold text-red-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-red-100">
                            Our Mission & Theological Foundation
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                            The HIV & AIDS Ministry exists to provide compassionate care, education, and advocacy for those affected by HIV/AIDS. We operate from a foundation of Christian love, breaking the silence and stigma surrounding HIV/AIDS while offering hope, support, and holistic care.
                        </p>
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-red-600">
                            <p class="text-lg md:text-xl font-semibold text-red-800 italic bible-verse">
                                "Bear one another's burdens, and so fulfill the law of Christ." - Galatians 6:2
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80" 
                                     alt="HIV/AIDS Education" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?auto=format&fit=crop&w=800&q=80" 
                                     alt="Support Group Meeting" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- Core Objectives Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-red-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-red-100">
                            Core Objectives
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Objective 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-red-100 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-graduation-cap text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Prevention & Education</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Comprehensive HIV/AIDS education and prevention programs targeting youth and adults through awareness campaigns, behavioral change initiatives, and promoting effective prevention methods.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-red-600 text-sm md:text-base">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                                        <span class="font-medium">Awareness Campaigns | Youth Education | Community Workshops</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-red-100 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-hands-helping text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Care & Support</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Holistic support including home-based care, emotional support, pastoral counseling, and practical assistance for PLHIV (People Living with HIV) and their families.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-red-600 text-sm md:text-base">
                                        <i class="fas fa-home mr-2"></i>
                                        <span class="font-medium">Home-based Care | Counseling | Support Groups | Practical Assistance</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-red-100 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-gavel text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Advocacy & Justice</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Advocating for the rights of PLHIV, fighting stigma and discrimination, and ensuring access to treatment, housing, education, and livelihood opportunities.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-red-600 text-sm md:text-base">
                                        <i class="fas fa-balance-scale mr-2"></i>
                                        <span class="font-medium">Rights Advocacy | Stigma Reduction | Access to Treatment | Policy Engagement</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 4 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-red-100 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-church text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Church Response</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Equipping churches and religious leaders with accurate information and resources to address HIV/AIDS within faith communities through training, liturgy development, and theological reflection.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-red-600 text-sm md:text-base">
                                        <i class="fas fa-users mr-2"></i>
                                        <span class="font-medium">Clergy Training | Educational Resources | Liturgy Development | Faith-based Response</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Program Areas Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-red-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-red-100">
                            Key Program Areas
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Program 1 -->
                            <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-red-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-red-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-shield-alt text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-red-800">Prevention Education</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    School-based programs, community workshops, and media campaigns promoting HIV prevention, testing, and healthy behaviors.
                                </p>
                                <div class="text-xs md:text-sm text-red-600">
                                    <i class="fas fa-users mr-1"></i> Targets: Youth, High-risk Groups, General Public
                                </div>
                            </div>

                            <!-- Program 2 -->
                            <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-pink-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-pink-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-heart text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-pink-800">Support Services</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Weekly support groups, counseling services, nutritional support, and assistance with medication adherence and healthcare access.
                                </p>
                                <div class="text-xs md:text-sm text-pink-600">
                                    <i class="fas fa-calendar mr-1"></i> Weekly Support Groups | Daily Counseling
                                </div>
                            </div>

                            <!-- Program 3 -->
                            <div class="bg-gradient-to-br from-rose-50 to-red-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-rose-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-rose-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-handshake text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-rose-800">Advocacy Network</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Legal advocacy, policy engagement, stigma reduction campaigns, and partnerships with healthcare providers and government agencies.
                                </p>
                                <div class="text-xs md:text-sm text-rose-600">
                                    <i class="fas fa-network-wired mr-1"></i> National & Local Partnerships
                                </div>
                            </div>

                            <!-- Program 4 -->
                            <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-red-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-orange-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-leaf text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-orange-800">Livelihood Programs</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Income-generating activities, vocational training, and sustainable livelihood programs to address poverty and improve quality of life.
                                </p>
                                <div class="text-xs md:text-sm text-orange-600">
                                    <i class="fas fa-seedling mr-1"></i> Integrated with Tree Planting & Agriculture
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-red-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-red-100">
                                Join Our Compassionate Community
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Whether you want to volunteer, need support, or simply want to learn more about HIV/AIDS, we welcome you with open arms and compassionate hearts.
                            </p>
                            
                            <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="first_name">
                                            First Name *
                                        </label>
                                        <input type="text" id="first_name" name="first_name" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                               required>
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="participation_type">
                                        How would you like to participate? *
                                    </label>
                                    <select id="participation_type" name="participation_type" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base"
                                            required>
                                        <option value="">Select your participation type</option>
                                        <option value="Volunteer" {{ old('participation_type') == 'Volunteer' ? 'selected' : '' }}>Volunteer (Provide support)</option>
                                        <option value="Supporter" {{ old('participation_type') == 'Supporter' ? 'selected' : '' }}>Supporter (Need support/PLHIV)</option>
                                        <option value="Advocate" {{ old('participation_type') == 'Advocate' ? 'selected' : '' }}>Advocate (Raise awareness)</option>
                                        <option value="Educator" {{ old('participation_type') == 'Educator' ? 'selected' : '' }}>Educator (Teach/prevent)</option>
                                        <option value="Donor" {{ old('participation_type') == 'Donor' ? 'selected' : '' }}>Donor (Financial support)</option>
                                    </select>
                                    @error('participation_type')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        Specific Area of Interest (Optional)
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select area of interest</option>
                                        <option value="Counseling" {{ old('role') == 'Counseling' ? 'selected' : '' }}>Counseling & Emotional Support</option>
                                        <option value="Education" {{ old('role') == 'Education' ? 'selected' : '' }}>HIV/AIDS Education</option>
                                        <option value="Advocacy" {{ old('role') == 'Advocacy' ? 'selected' : '' }}>Rights Advocacy</option>
                                        <option value="Fundraising" {{ old('role') == 'Fundraising' ? 'selected' : '' }}>Fundraising & Events</option>
                                        <option value="Medical Support" {{ old('role') == 'Medical Support' ? 'selected' : '' }}>Medical & Healthcare Support</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Areas of Interest (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-red-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="HIV Prevention Education" 
                                                   class="rounded text-red-600 focus:ring-red-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('HIV Prevention Education', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">HIV Prevention Education</span>
                                        </label>
                                        <label class="flex items-center bg-red-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Support Groups" 
                                                   class="rounded text-red-600 focus:ring-red-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Support Groups', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Support Groups</span>
                                        </label>
                                        <label class="flex items-center bg-red-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Stigma Reduction" 
                                                   class="rounded text-red-600 focus:ring-red-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Stigma Reduction', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Stigma Reduction</span>
                                        </label>
                                        <label class="flex items-center bg-red-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Livelihood Programs" 
                                                   class="rounded text-red-600 focus:ring-red-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Livelihood Programs', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Livelihood Programs</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="message">
                                        Your Message (Optional)
                                    </label>
                                    <textarea id="message" name="message" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition text-sm md:text-base"
                                              placeholder="Share your story, ask questions, or tell us how you'd like to help...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="bg-red-50 rounded-lg p-4 md:p-5">
                                    <h4 class="font-bold text-red-800 mb-2 text-sm md:text-base">Confidentiality Notice</h4>
                                    <p class="text-gray-700 text-xs md:text-sm mb-3">
                                        All information shared with us is kept strictly confidential. We respect your privacy and adhere to the highest standards of confidentiality in all our work.
                                    </p>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="confidentiality" value="1" 
                                               class="rounded text-red-600 focus:ring-red-500 h-4 w-4"
                                               required>
                                        <span class="ml-2 text-gray-700 text-xs md:text-sm">I understand and agree to the confidentiality policy *</span>
                                    </label>
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white font-semibold rounded-lg hover:from-red-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-heart mr-2"></i>
                                        Join HIV/AIDS Ministry
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='{{ route('ministries.index') }}'">
                                        <i class="fas fa-hands-helping mr-2"></i>
                                        Need Immediate Support?
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    * Required fields. Your information will be handled with utmost confidentiality and used only for ministry purposes.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-red-50 to-pink-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                            <div class="text-center">
                                <div class="mb-4 md:mb-6">
                                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-3xl md:text-4xl text-red-600"></i>
                                    </div>
                                </div>
                                
                                <h2 class="text-2xl md:text-3xl font-bold text-red-900 mb-3 md:mb-4">
                                    You're Already a Member!
                                </h2>
                                
                                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                                    Welcome to the <span class="font-semibold text-red-800">{{ $ministry->name ?? 'HIV & AIDS Ministry' }}</span> family. 
                                    Thank you for joining us in this compassionate mission.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-red-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-red-500 mt-1 mr-3"></i>
                                                <span>Next support group: <strong>Wednesday 6:00 PM</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-users text-red-500 mt-1 mr-3"></i>
                                                <span>Your participation: <strong>{{ old('participation_type', 'Volunteer') }}</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-shield-alt text-red-500 mt-1 mr-3"></i>
                                                <span>Confidentiality: <strong>Your privacy is protected</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-red-500 mt-1 mr-3"></i>
                                                <span>You'll receive confidential updates</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Support Groups
                                    </a>
                                    <a href="{{ route('ministries.index') }}" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-white text-red-700 font-semibold rounded-lg hover:bg-red-50 transition-all duration-200 shadow-lg hover:shadow-xl border border-red-200 flex items-center justify-center">
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
                        <h3 class="text-lg md:text-xl font-bold text-red-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-red-100">
                            Ministry Coordinator
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-red-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'HIV/AIDS Ministry Coordinator' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'HIV/AIDS Ministry Coordinator' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-red-100 to-pink-100 flex items-center justify-center">
                                            <i class="fas fa-user-nurse text-3xl md:text-4xl text-red-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-red-800">
                                {{ $ministry?->leader_name ?? 'HIV/AIDS Ministry Coordinator' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Certified Counselor & Ministry Director
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Our coordinator is a certified counselor with extensive experience in HIV/AIDS care, stigma reduction, and community health education, dedicated to compassionate service.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Confidential Contact
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-red-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-red-100">
                            Support Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-red-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-red-800 text-sm md:text-base">General Support Group</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Wednesdays 6:00 PM - 8:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Room 205 (Confidential)</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-pink-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-pink-800 text-sm md:text-base">Youth Education Session</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Saturdays 10:00 AM - 12:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Youth Center</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-rose-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-rose-800 text-sm md:text-base">Counseling Appointments</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>By Appointment Only</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Confidential Office</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-red-600 to-pink-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Info</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-red-200"></i>
                                <span>Active Members: 80+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-heart mr-3 text-red-200"></i>
                                <span>Weekly Support: 5 Groups</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-shield-alt mr-3 text-red-200"></i>
                                <span>Confidentiality: 100%</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-hand-holding-heart mr-3 text-red-200"></i>
                                <span>Years Serving: 15+</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-red-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-red-100">
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-red-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4 bible-verse">
                                "He heals the brokenhearted and binds up their wounds."
                            </blockquote>
                            <p class="font-semibold text-red-600 text-sm md:text-base">— Psalm 147:3 (ESV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-red-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-red-100">
                            Upcoming HIV/AIDS Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-red-50 to-pink-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-red-800 text-sm md:text-base">{{ $event->title }}</h4>
                                            @if($event->status)
                                                <span class="event-status status-{{ strtolower($event->status) }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs md:text-sm text-gray-600 mb-1">
                                            <i class="fas fa-calendar-alt mr-2 text-red-500"></i>
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
                                                <i class="fas fa-clock mr-2 text-red-500"></i>
                                                <span>{{ $event->time }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($event->location)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2 md:mb-3">
                                                <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
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
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-red-500 text-white text-xs md:text-sm rounded hover:bg-red-600 transition">
                                                    Register Now
                                                </a>
                                            @elseif($event->slug)
                                                <a href="{{ route('events.show', $event->slug) }}" 
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-red-500 text-white text-xs md:text-sm rounded hover:bg-red-600 transition">
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
                                   class="inline-flex items-center text-red-600 hover:text-red-700 font-medium text-sm md:text-base">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    View All Events
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 md:py-8">
                                <i class="fas fa-calendar-alt text-2xl md:text-3xl text-gray-300 mb-3 md:mb-4"></i>
                                <p class="text-gray-500 text-sm md:text-base mb-3 md:mb-4">No upcoming events scheduled</p>
                                <a href="{{ route('events.index') }}" 
                                   class="px-3 py-2 md:px-4 md:py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm md:text-base">
                                    Browse All Events
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Confidentiality Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-red-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-red-100">
                            Our Commitment
                        </h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-lock text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">100% confidentiality guaranteed</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-user-shield text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Trained professional counselors</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-heart text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Non-judgmental, compassionate care</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-hands text-green-500 mt-0.5 md:mt-1 mr-2 md:mr-3"></i>
                                <span class="text-xs md:text-sm text-gray-700">Free services for all participants</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 border-t border-red-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-red-900 mb-3 md:mb-4">
                    Need Support or Want to Help?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Whether you're affected by HIV/AIDS or want to support those who are, we're here with compassion and confidentiality.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-heart mr-2"></i>
                        Join Our Ministry
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
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-red-50.to-pink-100');
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