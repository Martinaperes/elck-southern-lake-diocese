@extends('layouts.app')

@section('title','Relief & Development Ministry - ELCK Southern Lake')

@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'relief-and-development-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #2A5934;
    --accent: #74B49B;
    --highlight: #F0B67F;
    --dark: #1E3A28;
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
    background-image: linear-gradient(rgba(42, 89, 52, 0.85), rgba(116, 180, 155, 0.75)), 
                      url('https://images.unsplash.com/photo-1553531384-397c80973a0b?auto=format&fit=crop&w=1600&q=80');
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
                rgba(30, 58, 40, 0.85) 0%, 
                rgba(42, 89, 52, 0.75) 50%, 
                rgba(116, 180, 155, 0.65) 100%);
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

/* Relief specific styles */
.relief-bg {
    background: linear-gradient(135deg, #F4F7F9 0%, #E8F4EA 50%, #F0F7F4 100%);
}

.bible-verse {
    font-family: 'Georgia', serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

/* Handshake animation */
@keyframes handshake {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-10deg); }
    75% { transform: rotate(10deg); }
}

.handshake-animation {
    animation: handshake 2s ease-in-out infinite;
}
</style>

@section('content')
<div class="min-h-screen relief-bg font-sans safe-area-padding">
    
    <!-- Compact Banner Section -->
    <div class="relative hero-header py-8 md:py-12 lg:py-16">
        <!-- Gradient overlay for better text contrast -->
        <div class="absolute inset-0 hero-overlay"></div>
        
        <!-- Decorative elements (hidden on mobile for performance) -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-green-400 rounded-full opacity-10 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-teal-400 rounded-full opacity-10 blur-2xl"></div>
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
                        <i class="fas fa-hands-helping text-2xl md:text-3xl lg:text-4xl text-white handshake-animation"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2 md:mb-3 text-center leading-tight">
                    Relief & Development Ministry
                    <span class="block text-green-200 text-lg md:text-xl lg:text-2xl mt-1">Emergency Response • Sustainable Development</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-green-200 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Serving communities in need through emergency response and sustainable development initiatives that transform lives and build resilient communities
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-green-300 to-teal-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-green-300">50+</div>
                        <div class="text-green-200 font-medium text-xs md:text-sm">Emergency Responses</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-teal-300">100,000+</div>
                        <div class="text-green-200 font-medium text-xs md:text-sm">Lives Impacted</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-green-200">25 Years</div>
                        <div class="text-green-200 font-medium text-xs md:text-sm">Of Faithful Service</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#F4F7F9"/>
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
                            Our Mission & Approach
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                            The Relief & Development Ministry combines emergency humanitarian response with long-term sustainable development to serve communities in need. We respond to crises with compassion while building resilience through programs that address root causes of poverty and vulnerability.
                        </p>
                        <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-green-600">
                            <p class="text-lg md:text-xl font-semibold text-green-800 italic bible-verse">
                                "For I was hungry and you gave me something to eat, I was thirsty and you gave me something to drink, I was a stranger and you invited me in." - Matthew 25:35
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset ('images/ministries/relief1.jpg') }}"
                                     alt="Emergency Relief Distribution" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset ('images/ministries/relief2.jpg') }}" 
                                     alt="Sustainable Development Project" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- Dual Focus Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                            Our Dual Focus: Relief & Development
                        </h2>
                        
                        <div class="space-y-6 md:space-y-8">
                            <!-- Relief Focus -->
                            <div>
                                <div class="flex items-center mb-4 md:mb-6">
                                    <div class="bg-red-100 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4">
                                        <i class="fas fa-first-aid text-xl md:text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl md:text-2xl font-bold text-red-800 ml-4">🚨 Emergency Relief</h3>
                                </div>
                                
                                <div class="space-y-4 md:space-y-6">
                                    <!-- Relief 1 -->
                                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                        <div class="md:w-1/4">
                                            <div class="bg-red-50 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                                <i class="fas fa-cloud-showers-heavy text-xl md:text-2xl mb-2"></i>
                                                <h4 class="font-bold text-base md:text-lg">Disaster Response</h4>
                                            </div>
                                        </div>
                                        <div class="md:w-3/4">
                                            <p class="text-gray-700 text-sm md:text-base">
                                                Immediate support during droughts, floods, and other natural disasters. Rapid deployment of emergency teams and supplies to affected communities.
                                            </p>
                                            <div class="mt-2 md:mt-3 flex items-center text-red-600 text-sm md:text-base">
                                                <i class="fas fa-truck mr-2"></i>
                                                <span class="font-medium">Food Distribution | Shelter Provision | Emergency Medical Care</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Relief 2 -->
                                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                        <div class="md:w-1/4">
                                            <div class="bg-red-50 text-red-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                                <i class="fas fa-people-carry text-xl md:text-2xl mb-2"></i>
                                                <h4 class="font-bold text-base md:text-lg">Refugee Assistance</h4>
                                            </div>
                                        </div>
                                        <div class="md:w-3/4">
                                            <p class="text-gray-700 text-sm md:text-base">
                                                Partnering with Lutheran World Federation (LWF) to provide essential services to refugees in Kakuma and Dadaab camps. Addressing immediate needs and protecting human dignity.
                                            </p>
                                            <div class="mt-2 md:mt-3 flex items-center text-red-600 text-sm md:text-base">
                                                <i class="fas fa-campground mr-2"></i>
                                                <span class="font-medium">Essential Services | Protection | Psychosocial Support</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Development Focus -->
                            <div>
                                <div class="flex items-center mb-4 md:mb-6">
                                    <div class="bg-green-100 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4">
                                        <i class="fas fa-seedling text-xl md:text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl md:text-2xl font-bold text-green-800 ml-4">🛠️ Sustainable Development</h3>
                                </div>
                                
                                <div class="space-y-4 md:space-y-6">
                                    <!-- Development 1 -->
                                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                        <div class="md:w-1/4">
                                            <div class="bg-green-50 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                                <i class="fas fa-tractor text-xl md:text-2xl mb-2"></i>
                                                <h4 class="font-bold text-base md:text-lg">Food Security & Livelihoods</h4>
                                            </div>
                                        </div>
                                        <div class="md:w-3/4">
                                            <p class="text-gray-700 text-sm md:text-base">
                                                Climate-smart agriculture, drought-resistant crops, cooperative strengthening, and animal husbandry projects to build sustainable economic growth.
                                            </p>
                                            <div class="mt-2 md:mt-3 flex items-center text-green-600 text-sm md:text-base">
                                                <i class="fas fa-water mr-2"></i>
                                                <span class="font-medium">Climate Adaptation | Cooperative Development | Value Chain Enhancement</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Development 2 -->
                                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                        <div class="md:w-1/4">
                                            <div class="bg-green-50 text-green-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                                <i class="fas fa-heartbeat text-xl md:text-2xl mb-2"></i>
                                                <h4 class="font-bold text-base md:text-lg">Health & Wellness</h4>
                                            </div>
                                        </div>
                                        <div class="md:w-3/4">
                                            <p class="text-gray-700 text-sm md:text-base">
                                                Community health programs, malaria prevention, Water, Sanitation & Hygiene (WASH) initiatives, and empowerment programs for women and youth.
                                            </p>
                                            <div class="mt-2 md:mt-3 flex items-center text-green-600 text-sm md:text-base">
                                                <i class="fas fa-hand-holding-water mr-2"></i>
                                                <span class="font-medium">WASH Programs | Health Clinics | Skills Training | Microfinance</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Program Areas Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                            Key Program Areas
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Program 1 -->
                            <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-red-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-red-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-box text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-red-800">Emergency Aid Distribution</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Rapid deployment of food, shelter, blankets, soap, mosquito nets, and other essentials to disaster-affected communities.
                                </p>
                                <div class="text-xs md:text-sm text-red-600">
                                    <i class="fas fa-clock mr-1"></i> 24/7 Emergency Response
                                </div>
                            </div>

                            <!-- Program 2 -->
                            <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-green-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-leaf text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-green-800">Agricultural Development</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Promoting sustainable farming practices, drought-resistant crops, and market access for smallholder farmers.
                                </p>
                                <div class="text-xs md:text-sm text-green-600">
                                    <i class="fas fa-seedling mr-1"></i> Climate-Smart Agriculture
                                </div>
                            </div>

                            <!-- Program 3 -->
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-blue-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-hand-holding-water text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-blue-800">WASH Programs</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Improving access to clean water, sanitation facilities, and hygiene education to prevent waterborne diseases.
                                </p>
                                <div class="text-xs md:text-sm text-blue-600">
                                    <i class="fas fa-tint mr-1"></i> Water, Sanitation & Hygiene
                                </div>
                            </div>

                            <!-- Program 4 -->
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-purple-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-purple-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-user-graduate text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-purple-800">Livelihood Empowerment</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Skills training, microfinance initiatives, and cooperative development for women, youth, and vulnerable groups.
                                </p>
                                <div class="text-xs md:text-sm text-purple-600">
                                    <i class="fas fa-hands-helping mr-1"></i> Economic Empowerment
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                                Join Our Relief & Development Team
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Be part of transforming lives through emergency response and sustainable development. Your skills and compassion can make a real difference.
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
                                            Phone Number *
                                        </label>
                                        <input type="tel" id="phone" name="phone" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                               required>
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="area_of_focus">
                                        Primary Area of Interest *
                                    </label>
                                    <select id="area_of_focus" name="area_of_focus" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                            required>
                                        <option value="">Select your primary interest</option>
                                        <option value="Emergency Relief" {{ old('area_of_focus') == 'Emergency Relief' ? 'selected' : '' }}>Emergency Relief & Response</option>
                                        <option value="Food Security" {{ old('area_of_focus') == 'Food Security' ? 'selected' : '' }}>Food Security & Agriculture</option>
                                        <option value="WASH" {{ old('area_of_focus') == 'WASH' ? 'selected' : '' }}>Water, Sanitation & Hygiene (WASH)</option>
                                        <option value="Livelihoods" {{ old('area_of_focus') == 'Livelihoods' ? 'selected' : '' }}>Livelihoods & Economic Empowerment</option>
                                        <option value="Health" {{ old('area_of_focus') == 'Health' ? 'selected' : '' }}>Health & Wellness Programs</option>
                                        <option value="All Areas" {{ old('area_of_focus') == 'All Areas' ? 'selected' : '' }}>All Areas of Relief & Development</option>
                                    </select>
                                    @error('area_of_focus')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        Specific Skills/Background (Optional)
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select if applicable</option>
                                        <option value="Medical" {{ old('role') == 'Medical' ? 'selected' : '' }}>Medical/Healthcare</option>
                                        <option value="Logistics" {{ old('role') == 'Logistics' ? 'selected' : '' }}>Logistics & Supply Chain</option>
                                        <option value="Agriculture" {{ old('role') == 'Agriculture' ? 'selected' : '' }}>Agriculture & Farming</option>
                                        <option value="Engineering" {{ old('role') == 'Engineering' ? 'selected' : '' }}>Engineering/Construction</option>
                                        <option value="Education" {{ old('role') == 'Education' ? 'selected' : '' }}>Education & Training</option>
                                        <option value="Administration" {{ old('role') == 'Administration' ? 'selected' : '' }}>Administration & Coordination</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Volunteer Preferences (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Emergency Response Team" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Emergency Response Team', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Emergency Response Team</span>
                                        </label>
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Field Work" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Field Work', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Field Work & Community Visits</span>
                                        </label>
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Training" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Training', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Training & Capacity Building</span>
                                        </label>
                                        <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Fundraising" 
                                                   class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Fundraising', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Fundraising & Resource Mobilization</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="availability">
                                            Availability *
                                        </label>
                                        <select id="availability" name="availability" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                                required>
                                            <option value="">Select your availability</option>
                                            <option value="Emergency Only" {{ old('availability') == 'Emergency Only' ? 'selected' : '' }}>Emergency Response Only</option>
                                            <option value="Regular" {{ old('availability') == 'Regular' ? 'selected' : '' }}>Regular (Weekly commitment)</option>
                                            <option value="Seasonal" {{ old('availability') == 'Seasonal' ? 'selected' : '' }}>Seasonal (Project periods)</option>
                                            <option value="On-call" {{ old('availability') == 'On-call' ? 'selected' : '' }}>On-call (When needed)</option>
                                        </select>
                                        @error('availability')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="experience">
                                            Previous Experience (Optional)
                                        </label>
                                        <select id="experience" name="experience" 
                                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base">
                                            <option value="">Select experience level</option>
                                            <option value="None" {{ old('experience') == 'None' ? 'selected' : '' }}>No previous experience</option>
                                            <option value="Some" {{ old('experience') == 'Some' ? 'selected' : '' }}>Some volunteer experience</option>
                                            <option value="Experienced" {{ old('experience') == 'Experienced' ? 'selected' : '' }}>Experienced volunteer</option>
                                            <option value="Professional" {{ old('experience') == 'Professional' ? 'selected' : '' }}>Professional experience in field</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="message">
                                        Why are you interested in joining? (Optional)
                                    </label>
                                    <textarea id="message" name="message" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                              placeholder="Share your motivation, relevant experience, or specific interests...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white font-semibold rounded-lg hover:from-green-700 hover:to-teal-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-hands-helping mr-2"></i>
                                        Join Relief & Development
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='{{ route('ministries.index') }}'">
                                        <i class="fas fa-donate mr-2"></i>
                                        Support Emergency Fund
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    * Required fields. Emergency response volunteers may be called upon at short notice. Training will be provided.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-green-50 to-teal-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
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
                                    Welcome to the <span class="font-semibold text-green-800">{{ $ministry->name ?? 'Relief & Development Ministry' }}</span> team. 
                                    Thank you for joining us in serving communities in need.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-green-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-green-500 mt-1 mr-3"></i>
                                                <span>Next volunteer training: <strong>Next Saturday 9:00 AM</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-briefcase text-green-500 mt-1 mr-3"></i>
                                                <span>Your focus area: <strong>{{ old('area_of_focus', 'Emergency Relief') }}</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-phone text-green-500 mt-1 mr-3"></i>
                                                <span>Keep phone on for <strong>emergency alerts</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-green-500 mt-1 mr-3"></i>
                                                <span>You'll receive regular updates and alerts</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Upcoming Projects
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
                            Ministry Director
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-green-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Relief & Development Director' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Relief & Development Director' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-green-100 to-teal-100 flex items-center justify-center">
                                            <i class="fas fa-user-tie text-3xl md:text-4xl text-green-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-green-800">
                                {{ $ministry?->leader_name ?? 'Relief & Development Director' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Humanitarian Specialist
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Our director has over 20 years of experience in humanitarian response and sustainable development, having worked with international organizations on disaster relief, refugee assistance, and community development projects across Africa.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Director
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Program Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-red-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-red-800 text-sm md:text-base">Emergency Response Team</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>On-call 24/7</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-phone mr-2"></i>
                                    <span>Emergency Hotline Active</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-green-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-green-800 text-sm md:text-base">Volunteer Training</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Saturdays 9:00 AM - 12:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Ministry Office</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-blue-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Field Projects</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Weekdays 8:00 AM - 5:00 PM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Various Project Sites</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Impact</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-home mr-3 text-green-200"></i>
                                <span>Communities Served: 200+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-green-200"></i>
                                <span>Volunteers: 500+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-seedling mr-3 text-green-200"></i>
                                <span>Development Projects: 50+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-hand-holding-heart mr-3 text-green-200"></i>
                                <span>Emergency Responses: 100+</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-green-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4 bible-verse">
                                "Speak up for those who cannot speak for themselves, for the rights of all who are destitute."
                            </blockquote>
                            <p class="font-semibold text-green-600 text-sm md:text-base">— Proverbs 31:8 (NIV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Upcoming Relief Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-green-50 to-teal-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
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

                    <!-- Partnerships Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-green-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-green-100">
                            Key Partnerships
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <i class="fas fa-globe-africa text-blue-600 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-blue-800 text-sm">Lutheran World Federation</h4>
                                    <p class="text-xs text-gray-600">Emergency Response & Development</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                                <i class="fas fa-hands-helping text-purple-600 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-purple-800 text-sm">Lutheran World Relief</h4>
                                    <p class="text-xs text-gray-600">Agriculture & Climate Programs</p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                <i class="fas fa-alliance text-red-600 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-red-800 text-sm">ACT Alliance</h4>
                                    <p class="text-xs text-gray-600">Global Humanitarian Collaboration</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-green-50 to-teal-50 border-t border-green-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-green-900 mb-3 md:mb-4">
                    Ready to Serve Communities in Need?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Join us in providing emergency relief and building sustainable development. Your compassion transforms lives.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-hands-helping mr-2"></i>
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
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-green-50.to-teal-100');
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