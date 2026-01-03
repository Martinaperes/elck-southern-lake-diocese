@extends('layouts.app')

@section('title','Malaria Campaign Ministry - ELCK Southern Lake')

@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'elck-malaria-campaign')->first();
    }
@endphp

<style>
:root {
    --primary: #00796B;
    --accent: #004D40;
    --highlight: #80CBC4;
    --dark: #00332B;
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
    background-image: linear-gradient(rgba(0, 121, 107, 0.85), rgba(76, 175, 80, 0.75)), 
                      url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=1600&q=80');
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
                rgba(0, 51, 43, 0.85) 0%, 
                rgba(0, 121, 107, 0.75) 50%, 
                rgba(128, 203, 196, 0.65) 100%);
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

/* Malaria specific styles */
.malaria-bg {
    background: linear-gradient(135deg, #E8F5E9 0%, #E0F2F1 50%, #E8F5F5 100%);
}

.bible-verse {
    font-family: 'Georgia', serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

/* Mosquito net animation */
@keyframes netWave {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.net-wave {
    animation: netWave 3s ease-in-out infinite;
}
</style>

@section('content')
<div class="min-h-screen malaria-bg font-sans safe-area-padding">
    
    <!-- Compact Banner Section -->
    <div class="relative hero-header py-8 md:py-12 lg:py-16">
        <!-- Gradient overlay for better text contrast -->
        <div class="absolute inset-0 hero-overlay"></div>
        
        <!-- Decorative elements (hidden on mobile for performance) -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-teal-400 rounded-full opacity-10 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-green-400 rounded-full opacity-10 blur-2xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Back button - moved to top left -->
                <div class="mb-4 md:mb-6">
                    <a href="/ministries" class="inline-flex items-center bg-white/20 backdrop-blur-sm text-teal-600 hover:bg-white/30 px-3 py-2 md:px-4 md:py-2 rounded-lg font-semibold group transition-all duration-200 text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to Ministries
                    </a>
                </div>
                
                <!-- Compact Ministry Icon -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 md:p-4 border-2 border-white/30">
                        <i class="fas fa-shield-virus text-2xl md:text-3xl lg:text-4xl text-white net-wave"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 md:mb-3 text-center leading-tight">
                    Malaria Campaign Ministry
                    <span class="block text-teal-200 text-lg md:text-xl lg:text-2xl mt-1">Prevention • Education • Treatment</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-teal-200 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Combating malaria through proactive prevention, community education, and effective treatment to protect children, pregnant women, and vulnerable communities
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-teal-300 to-green-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-teal-300">10,000+</div>
                        <div class="text-teal-200 font-medium text-xs md:text-sm">Nets Distributed</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-green-300">50+</div>
                        <div class="text-teal-200 font-medium text-xs md:text-sm">Communities Reached</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-teal-200">5 Years</div>
                        <div class="text-teal-200 font-medium text-xs md:text-sm">Of Continuous Campaign</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#E8F5E9"/>
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
                        <h2 class="text-2xl md:text-3xl font-bold text-teal-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-teal-100">
                            Our Mission & Campaign Model
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                            The ELCK Malaria Campaign Ministry is dedicated to combating malaria through a comprehensive approach that combines prevention, education, and treatment. We work to reduce malaria transmission, protect vulnerable populations, and empower communities with knowledge and resources for sustainable health improvement.
                        </p>
                        <div class="bg-gradient-to-r from-teal-50 to-green-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-teal-600">
                            <p class="text-lg md:text-xl font-semibold text-teal-800 italic bible-verse">
                                "He heals the brokenhearted and binds up their wounds." - Psalm 147:3
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{asset ('images/ministries/malaria1.jpg') }}" 
                                     alt="Mosquito Net Distribution" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{asset ('images/ministries/malaria2.jpg') }}"
                                     alt="Community Health Education" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- Campaign Pillars Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-teal-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-teal-100">
                            Three Pillars of Our Campaign
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Pillar 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-teal-100 text-teal-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-shield-alt text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Prevention</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Proactive measures to reduce malaria transmission through distribution of Long-Lasting Insecticidal Nets (LLINs), elimination of mosquito breeding sites, and promotion of proper sanitation and hygiene practices.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-teal-600 text-sm md:text-base">
                                        <i class="fas fa-network-wired mr-2"></i>
                                        <span class="font-medium">LLIN Distribution | Environmental Management | Community-led Initiatives</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pillar 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-teal-100 text-teal-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-graduation-cap text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Education & Awareness</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Leveraging church influence to raise awareness through sermons, workshops, and training sessions. Equipping communities with knowledge about malaria prevention, symptom recognition, and proper net usage.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-teal-600 text-sm md:text-base">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                                        <span class="font-medium">Community Workshops | Clergy Training | Health Volunteer Programs</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pillar 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-teal-100 text-teal-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-hand-holding-medical text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Treatment & Care</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Ensuring timely and effective treatment through ELCK-operated health facilities equipped with Rapid Diagnostic Tests (RDTs) and Artemisinin-based Combination Therapies (ACTs). Providing patient education and follow-up care.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-teal-600 text-sm md:text-base">
                                        <i class="fas fa-hospital mr-2"></i>
                                        <span class="font-medium">Health Facilities | Diagnostic Tests | Antimalarial Drugs | Patient Follow-up</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Program Activities Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-teal-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-teal-100">
                            Key Program Activities
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Activity 1 -->
                            <div class="bg-gradient-to-br from-teal-50 to-green-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-teal-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-teal-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-bed text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-teal-800">Net Distribution Drives</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Regular distribution of insecticide-treated mosquito nets to households with children under five, pregnant women, and vulnerable community members.
                                </p>
                                <div class="text-xs md:text-sm text-teal-600">
                                    <i class="fas fa-calendar mr-1"></i> Seasonal Campaigns | Priority to High-risk Groups
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-green-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-users text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-green-800">Community Health Training</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Training programs for community health volunteers, church leaders, and local educators on malaria prevention, early detection, and response.
                                </p>
                                <div class="text-xs md:text-sm text-green-600">
                                    <i class="fas fa-graduation-cap mr-1"></i> Monthly Workshops | Certification Programs
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-emerald-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-emerald-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-clinic-medical text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-emerald-800">Health Facility Support</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Equipping ELCK clinics and dispensaries with diagnostic tools, medications, and trained personnel for effective malaria case management.
                                </p>
                                <div class="text-xs md:text-sm text-emerald-600">
                                    <i class="fas fa-ambulance mr-1"></i> 24/7 Support | Mobile Clinics | Referral Systems
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-teal-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-cyan-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-handshake text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-cyan-800">Partnership Coordination</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Collaborating with national and international partners to align efforts, share resources, and maximize impact across communities.
                                </p>
                                <div class="text-xs md:text-sm text-cyan-600">
                                    <i class="fas fa-network-wired mr-1"></i> Multi-agency Coordination | Resource Sharing
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-teal-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-teal-100">
                                Join Our Malaria Campaign
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Help us fight malaria and protect vulnerable communities. Whether as a volunteer, donor, or advocate, your support saves lives.
                            </p>
                            
                            <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="first_name">
                                            First Name *
                                        </label>
                                        <input type="text" id="first_name" name="first_name" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="involvement_type">
                                        How would you like to be involved? *
                                    </label>
                                    <select id="involvement_type" name="involvement_type" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base"
                                            required>
                                        <option value="">Select your involvement type</option>
                                        <option value="Volunteer" {{ old('involvement_type') == 'Volunteer' ? 'selected' : '' }}>Field Volunteer</option>
                                        <option value="Health Worker" {{ old('involvement_type') == 'Health Worker' ? 'selected' : '' }}>Health Worker/Professional</option>
                                        <option value="Educator" {{ old('involvement_type') == 'Educator' ? 'selected' : '' }}>Community Educator</option>
                                        <option value="Donor" {{ old('involvement_type') == 'Donor' ? 'selected' : '' }}>Financial Donor/Supporter</option>
                                        <option value="Advocate" {{ old('involvement_type') == 'Advocate' ? 'selected' : '' }}>Awareness Advocate</option>
                                        <option value="Coordinator" {{ old('involvement_type') == 'Coordinator' ? 'selected' : '' }}>Program Coordinator</option>
                                    </select>
                                    @error('involvement_type')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        Specific Skills/Background (Optional)
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select if applicable</option>
                                        <option value="Medical" {{ old('role') == 'Medical' ? 'selected' : '' }}>Medical/Healthcare Background</option>
                                        <option value="Logistics" {{ old('role') == 'Logistics' ? 'selected' : '' }}>Logistics/Supply Chain</option>
                                        <option value="Education" {{ old('role') == 'Education' ? 'selected' : '' }}>Education/Training</option>
                                        <option value="Community" {{ old('role') == 'Community' ? 'selected' : '' }}>Community Mobilization</option>
                                        <option value="Translation" {{ old('role') == 'Translation' ? 'selected' : '' }}>Translation/Interpretation</option>
                                        <option value="Other" {{ old('role') == 'Other' ? 'selected' : '' }}>Other Skills</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Areas of Interest (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-teal-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Net Distribution" 
                                                   class="rounded text-teal-600 focus:ring-teal-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Net Distribution', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Net Distribution</span>
                                        </label>
                                        <label class="flex items-center bg-teal-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Community Education" 
                                                   class="rounded text-teal-600 focus:ring-teal-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Community Education', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Community Education</span>
                                        </label>
                                        <label class="flex items-center bg-teal-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Health Facility Support" 
                                                   class="rounded text-teal-600 focus:ring-teal-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Health Facility Support', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Health Facility Support</span>
                                        </label>
                                        <label class="flex items-center bg-teal-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Fundraising" 
                                                   class="rounded text-teal-600 focus:ring-teal-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Fundraising', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Fundraising & Advocacy</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="availability">
                                        Your Availability (Optional)
                                    </label>
                                    <select id="availability" name="availability" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select availability</option>
                                        <option value="Regular" {{ old('availability') == 'Regular' ? 'selected' : '' }}>Regular (Weekly commitment)</option>
                                        <option value="Seasonal" {{ old('availability') == 'Seasonal' ? 'selected' : '' }}>Seasonal (Campaign periods)</option>
                                        <option value="Occasional" {{ old('availability') == 'Occasional' ? 'selected' : '' }}>Occasional (When needed)</option>
                                        <option value="Remote" {{ old('availability') == 'Remote' ? 'selected' : '' }}>Remote/Online Support</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="message">
                                        Additional Information (Optional)
                                    </label>
                                    <textarea id="message" name="message" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition text-sm md:text-base"
                                              placeholder="Share any relevant experience, questions, or suggestions...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-teal-600 to-green-600 text-white font-semibold rounded-lg hover:from-teal-700 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-shield-virus mr-2"></i>
                                        Join Malaria Campaign
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='{{ route('ministries.index') }}'">
                                        <i class="fas fa-donate mr-2"></i>
                                        Make a Donation
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    * Required fields. Your information will be used solely for ministry coordination and will be kept confidential.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-teal-50 to-green-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                            <div class="text-center">
                                <div class="mb-4 md:mb-6">
                                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-teal-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-3xl md:text-4xl text-teal-600"></i>
                                    </div>
                                </div>
                                
                                <h2 class="text-2xl md:text-3xl font-bold text-teal-900 mb-3 md:mb-4">
                                    You're Already a Campaign Member!
                                </h2>
                                
                                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                                    Welcome to the <span class="font-semibold text-teal-800">{{ $ministry->name ?? 'Malaria Campaign' }}</span> team. 
                                    Thank you for joining us in this life-saving mission.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-teal-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-teal-500 mt-1 mr-3"></i>
                                                <span>Next distribution drive: <strong>First Saturday of next month</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-users text-teal-500 mt-1 mr-3"></i>
                                                <span>Your role: <strong>{{ old('involvement_type', 'Volunteer') }}</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-briefcase text-teal-500 mt-1 mr-3"></i>
                                                <span>Training: <strong>Basic malaria prevention workshop required</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-teal-500 mt-1 mr-3"></i>
                                                <span>You'll receive campaign updates and alerts</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-teal-600 text-white font-semibold rounded-lg hover:bg-teal-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Campaign Events
                                    </a>
                                    <a href="{{ route('ministries.index') }}" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-white text-teal-700 font-semibold rounded-lg hover:bg-teal-50 transition-all duration-200 shadow-lg hover:shadow-xl border border-teal-200 flex items-center justify-center">
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
                        <h3 class="text-lg md:text-xl font-bold text-teal-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-teal-100">
                            Campaign Coordinator
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-teal-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Malaria Campaign Coordinator' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Malaria Campaign Coordinator' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-teal-100 to-green-100 flex items-center justify-center">
                                            <i class="fas fa-user-md text-3xl md:text-4xl text-teal-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-teal-800">
                                {{ $ministry?->leader_name ?? 'Malaria Campaign Coordinator' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Public Health Specialist
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Our coordinator is a public health specialist with extensive experience in malaria prevention programs, community health education, and partnership coordination with national and international health organizations.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Coordinator
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-teal-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-teal-100">
                            Campaign Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-teal-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-teal-800 text-sm md:text-base">Monthly Net Distribution</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>1st Saturday of Month</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Various Communities</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-green-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-green-800 text-sm md:text-base">Volunteer Training</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Every Thursday 5:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Community Hall</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-emerald-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-emerald-800 text-sm md:text-base">Health Education</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Sundays after Service</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Church Premises</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-teal-600 to-green-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Campaign Impact</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-bed mr-3 text-teal-200"></i>
                                <span>Nets Distributed: 10,000+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-teal-200"></i>
                                <span>Communities Reached: 50+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-user-graduate mr-3 text-teal-200"></i>
                                <span>Trained Volunteers: 200+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-heartbeat mr-3 text-teal-200"></i>
                                <span>Malaria Cases Reduced: 40%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-teal-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-teal-100">
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-teal-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4 bible-verse">
                                "I have come that they may have life, and have it to the full."
                            </blockquote>
                            <p class="font-semibold text-teal-600 text-sm md:text-base">— John 10:10 (NIV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-teal-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-teal-100">
                            Upcoming Campaign Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-teal-50 to-green-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-teal-800 text-sm md:text-base">{{ $event->title }}</h4>
                                            @if($event->status)
                                                <span class="event-status status-{{ strtolower($event->status) }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs md:text-sm text-gray-600 mb-1">
                                            <i class="fas fa-calendar-alt mr-2 text-teal-500"></i>
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
                                                <i class="fas fa-clock mr-2 text-teal-500"></i>
                                                <span>{{ $event->time }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($event->location)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2 md:mb-3">
                                                <i class="fas fa-map-marker-alt mr-2 text-teal-500"></i>
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
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-teal-500 text-white text-xs md:text-sm rounded hover:bg-teal-600 transition">
                                                    Register Now
                                                </a>
                                            @elseif($event->slug)
                                                <a href="{{ route('events.show', $event->slug) }}" 
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-teal-500 text-white text-xs md:text-sm rounded hover:bg-teal-600 transition">
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
                                   class="inline-flex items-center text-teal-600 hover:text-teal-700 font-medium text-sm md:text-base">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    View All Events
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 md:py-8">
                                <i class="fas fa-calendar-alt text-2xl md:text-3xl text-gray-300 mb-3 md:mb-4"></i>
                                <p class="text-gray-500 text-sm md:text-base mb-3 md:mb-4">No upcoming events scheduled</p>
                                <a href="{{ route('events.index') }}" 
                                   class="px-3 py-2 md:px-4 md:py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition text-sm md:text-base">
                                    Browse All Events
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Partnerships Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-teal-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-teal-100">
                            Key Partnerships
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-teal-50 rounded-lg">
                                <i class="fas fa-hands-helping text-teal-600 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-teal-800 text-sm">Lutheran Malaria Initiative</h4>
                                    <p class="text-xs text-gray-600">LCMS & Lutheran World Relief</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-globe text-green-600 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-green-800 text-sm">Global Fund</h4>
                                    <p class="text-xs text-gray-600">UN Foundation Partnership</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-emerald-50 rounded-lg">
                                <i class="fas fa-flag text-emerald-600 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-emerald-800 text-sm">Kenya NMCP</h4>
                                    <p class="text-xs text-gray-600">National Malaria Control Programme</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-teal-50 to-green-50 border-t border-teal-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-teal-900 mb-3 md:mb-4">
                    Ready to Fight Malaria?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Join our campaign to protect vulnerable communities from malaria. Your participation saves lives and builds healthier futures.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-shield-virus mr-2"></i>
                        Join the Campaign
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
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-teal-50.to-green-100');
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