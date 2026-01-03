@extends('layouts.app')

@section('title','Sunday School Ministry - ELCK Southern Lake')

@php
    use App\Models\Ministry;
    // Safety check for all variables
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'childrens-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #8B4513;
    --accent: #D2691E;
    --highlight: #FFD700;
    --dark: #2F4F4F;
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
    background-image: linear-gradient(rgba(139, 69, 19, 0.85), rgba(255, 215, 0, 0.75)), 
                      url('https://images.unsplash.com/photo-1516627145497-ae695305cf2e?auto=format&fit=crop&w=1600&q=80');
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
                rgba(47, 79, 79, 0.85) 0%, 
                rgba(139, 69, 19, 0.75) 50%, 
                rgba(255, 215, 0, 0.65) 100%);
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

/* Sunday School specific styles */
.sunday-school-bg {
    background: linear-gradient(135deg, #F5F5DC 0%, #FFF8DC 50%, #FAF0E6 100%);
}

.bible-verse {
    font-family: 'Georgia', serif;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}
</style>

@section('content')
<div class="min-h-screen sunday-school-bg font-sans safe-area-padding">
    
    <!-- Compact Banner Section -->
    <div class="relative hero-header py-8 md:py-12 lg:py-16">
        <!-- Gradient overlay for better text contrast -->
        <div class="absolute inset-0 hero-overlay"></div>
        
        <!-- Decorative elements (hidden on mobile for performance) -->
        <div class="absolute inset-0 overflow-hidden hidden md:block">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-amber-400 rounded-full opacity-10 blur-2xl"></div>
            <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-yellow-400 rounded-full opacity-10 blur-2xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Back button - moved to top left -->
                <div class="mb-4 md:mb-6">
                    <a href="/ministries" class="inline-flex items-center bg-white/20 backdrop-blur-sm text-amber-600 hover:bg-white/30 px-3 py-2 md:px-4 md:py-2 rounded-lg font-semibold group transition-all duration-200 text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to Ministries
                    </a>
                </div>
                
                <!-- Compact Ministry Icon -->
                <div class="flex items-center justify-center mb-3 md:mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 md:p-4 border-2 border-white/30">
                        <i class="fas fa-book-bible text-2xl md:text-3xl lg:text-4xl text-white"></i>
                    </div>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-black mb-2 md:mb-3 text-center leading-tight">
                    Sunday School Ministry
                    <span class="block text-yellow-300 text-lg md:text-xl lg:text-2xl mt-1">(All Ages Welcome)</span>
                </h1>
                
                <!-- Tagline -->
                <p class="text-sm md:text-base lg:text-lg text-amber-500 mb-4 md:mb-6 leading-relaxed text-center max-w-2xl mx-auto px-2">
                    Growing in God's Word together - From toddlers to adults, we learn, fellowship, and apply biblical truths
                </p>
                
                <!-- Divider -->
                <div class="h-1 w-20 md:w-24 bg-gradient-to-r from-yellow-300 to-amber-400 rounded-full mx-auto mb-4 md:mb-6"></div>
                
                <!-- Compact Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3 max-w-xl mx-auto mt-4 md:mt-6 px-2">
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-yellow-300">300+</div>
                        <div class="text-amber-500 font-medium text-xs md:text-sm">Regular Attendees</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-amber-300">Weekly</div>
                        <div class="text-amber-500 font-medium text-xs md:text-sm">Bible Study</div>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg md:rounded-xl p-2 md:p-3 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <div class="text-xl md:text-2xl font-bold text-yellow-300">8 Age Groups</div>
                        <div class="text-amber-500 font-medium text-xs md:text-sm">Tailored Classes</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Smaller Wave divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 40L1440 0V40H0Z" fill="#F5F5DC"/>
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
                        <h2 class="text-2xl md:text-3xl font-bold text-amber-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-amber-100">
                            Our Mission
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                            The Sunday School Ministry exists to provide systematic Bible teaching for all ages, fostering spiritual growth, biblical literacy, and Christian fellowship. We aim to equip believers with God's Word for everyday living and develop strong foundations of faith from childhood through adulthood.
                        </p>
                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg md:rounded-xl p-4 md:p-6 border-l-4 border-amber-600">
                            <p class="text-lg md:text-xl font-semibold text-amber-800 italic bible-verse">
                                "Your word is a lamp to my feet and a light to my path." - Psalm 119:105
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=800&q=80" 
                                     alt="Adult Sunday School" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-lg md:rounded-xl overflow-hidden shadow-md">
                                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80" 
                                     alt="Children's Sunday School" 
                                     class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-amber-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-amber-100">
                            Core Objectives
                        </h2>
                        
                        <div class="space-y-4 md:space-y-6">
                            <!-- Objective 1 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-amber-100 text-amber-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-book-bible text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Biblical Literacy</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Systematic study of the Bible from Genesis to Revelation, helping believers understand Scripture in its historical and theological context.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-amber-600 text-sm md:text-base">
                                        <i class="fas fa-scroll mr-2"></i>
                                        <span class="font-medium">Book-by-Book Studies | Topical Lessons | Life Application</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 2 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-amber-100 text-amber-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-users text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Age-Appropriate Teaching</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Tailored lessons for different age groups, ensuring everyone from toddlers to seniors receives Bible teaching relevant to their stage of life.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-amber-600 text-sm md:text-base">
                                        <i class="fas fa-child mr-2"></i>
                                        <span class="font-medium">Nursery to Senior Adult Classes | Interactive Learning</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 3 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-amber-100 text-amber-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-hands-praying text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Spiritual Formation</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Developing Christian character, prayer life, and spiritual disciplines through Bible study, discussion, and practical application.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-amber-600 text-sm md:text-base">
                                        <i class="fas fa-heart mr-2"></i>
                                        <span class="font-medium">Character Development | Prayer Training | Discipleship</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 4 -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-amber-100 text-amber-800 rounded-lg md:rounded-xl p-3 md:p-4 text-center">
                                        <i class="fas fa-handshake text-2xl md:text-3xl mb-2 md:mb-3"></i>
                                        <h4 class="font-bold text-base md:text-lg">Christian Fellowship</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700 text-sm md:text-base">
                                        Building meaningful relationships within the body of Christ through shared study, prayer, and mutual encouragement.
                                    </p>
                                    <div class="mt-2 md:mt-3 flex items-center text-amber-600 text-sm md:text-base">
                                        <i class="fas fa-comments mr-2"></i>
                                        <span class="font-medium">Small Group Discussions | Prayer Partners | Fellowship Events</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Age Groups Section -->
                    <section class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-amber-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-amber-100">
                            Age Group Classes
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Class 1 -->
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-blue-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-baby text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-blue-800">Nursery (0-3 years)</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Safe, loving care with simple Bible stories, songs, and playtime. Introduction to God's love through caregivers.
                                </p>
                                <div class="text-xs md:text-sm text-blue-600">
                                    <i class="fas fa-clock mr-1"></i> Sundays 9:00 AM | Nursery Room
                                </div>
                            </div>

                            <!-- Class 2 -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-green-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-child text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-green-800">Pre-school (4-5 years)</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Interactive Bible stories, crafts, songs, and basic Bible memory verses. Learning through play and creative activities.
                                </p>
                                <div class="text-xs md:text-sm text-green-600">
                                    <i class="fas fa-clock mr-1"></i> Sundays 9:00 AM | Room 101
                                </div>
                            </div>

                            <!-- Class 3 -->
                            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-yellow-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-yellow-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-user-graduate text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-yellow-800">Children (6-12 years)</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    Age-appropriate Bible lessons, memory work, games, and activities. Building foundational Bible knowledge.
                                </p>
                                <div class="text-xs md:text-sm text-yellow-600">
                                    <i class="fas fa-clock mr-1"></i> Sundays 9:00 AM | Rooms 201-203
                                </div>
                            </div>

                            <!-- Class 4 -->
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg md:rounded-xl p-4 md:p-6 border border-purple-200">
                                <div class="flex items-center mb-3 md:mb-4">
                                    <div class="bg-purple-500 text-white rounded-full p-2 md:p-3 mr-3 md:mr-4">
                                        <i class="fas fa-users text-sm md:text-base"></i>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-purple-800">Youth & Adults</h3>
                                </div>
                                <p class="text-gray-700 text-sm md:text-base mb-3 md:mb-4">
                                    In-depth Bible study, discussion groups, and life application. Separate classes for teens, young adults, and adults.
                                </p>
                                <div class="text-xs md:text-sm text-purple-600">
                                    <i class="fas fa-clock mr-1"></i> Sundays 9:00 AM | Various Rooms
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-amber-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-amber-100">
                                Join Sunday School
                            </h2>
                            <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                                Whether you're new to the Bible or have been studying for years, there's a place for you in Sunday School.
                            </p>
                            
                            <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="first_name">
                                            First Name *
                                        </label>
                                        <input type="text" id="first_name" name="first_name" 
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
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
                                               class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                                               placeholder="Your phone number"
                                               value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="age_group">
                                        Your Age Group *
                                    </label>
                                    <select id="age_group" name="age_group" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                                            required>
                                        <option value="">Select age group</option>
                                        <option value="Nursery (0-3)" {{ old('age_group') == 'Nursery (0-3)' ? 'selected' : '' }}>Nursery (0-3 years)</option>
                                        <option value="Pre-school (4-5)" {{ old('age_group') == 'Pre-school (4-5)' ? 'selected' : '' }}>Pre-school (4-5 years)</option>
                                        <option value="Children (6-12)" {{ old('age_group') == 'Children (6-12)' ? 'selected' : '' }}>Children (6-12 years)</option>
                                        <option value="Youth (13-18)" {{ old('age_group') == 'Youth (13-18)' ? 'selected' : '' }}>Youth (13-18 years)</option>
                                        <option value="Young Adults (19-35)" {{ old('age_group') == 'Young Adults (19-35)' ? 'selected' : '' }}>Young Adults (19-35)</option>
                                        <option value="Adults (36-59)" {{ old('age_group') == 'Adults (36-59)' ? 'selected' : '' }}>Adults (36-59 years)</option>
                                        <option value="Seniors (60+)" {{ old('age_group') == 'Seniors (60+)' ? 'selected' : '' }}>Seniors (60+ years)</option>
                                    </select>
                                    @error('age_group')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        How would you like to participate?
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base">
                                        <option value="">Select participation type (optional)</option>
                                        <option value="Attendee" {{ old('role') == 'Attendee' ? 'selected' : '' }}>Regular Attendee</option>
                                        <option value="Teacher" {{ old('role') == 'Teacher' ? 'selected' : '' }}>Sunday School Teacher</option>
                                        <option value="Helper" {{ old('role') == 'Helper' ? 'selected' : '' }}>Classroom Helper</option>
                                        <option value="Curriculum" {{ old('role') == 'Curriculum' ? 'selected' : '' }}>Curriculum Development</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">
                                        Areas of Interest (Select all that apply)
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <label class="flex items-center bg-amber-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Bible Book Studies" 
                                                   class="rounded text-amber-600 focus:ring-amber-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Bible Book Studies', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Bible Book Studies</span>
                                        </label>
                                        <label class="flex items-center bg-amber-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Topical Studies" 
                                                   class="rounded text-amber-600 focus:ring-amber-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Topical Studies', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Topical Studies</span>
                                        </label>
                                        <label class="flex items-center bg-amber-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Children's Ministry" 
                                                   class="rounded text-amber-600 focus:ring-amber-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Children\'s Ministry', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Children's Ministry</span>
                                        </label>
                                        <label class="flex items-center bg-amber-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Small Group Discussion" 
                                                   class="rounded text-amber-600 focus:ring-amber-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Small Group Discussion', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Small Group Discussion</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="message">
                                        Tell us about yourself (Optional)
                                    </label>
                                    <textarea id="message" name="message" rows="3"
                                              class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition text-sm md:text-base"
                                              placeholder="What are you hoping to gain from Sunday School? Any previous Bible study experience?...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                                    <button type="submit" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-semibold rounded-lg hover:from-amber-700 hover:to-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                                        <i class="fas fa-book-open mr-2"></i>
                                        Join Sunday School
                                    </button>
                                    <button type="button" 
                                            class="px-6 py-3 md:px-8 md:py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                            onclick="window.location.href='{{ route('ministries.index') }}'">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                                        Volunteer to Teach
                                    </button>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-4">
                                    By joining, you agree to receive updates about Sunday School schedule changes, special events, and study materials.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Show membership confirmation for existing members -->
                        <section class="bg-gradient-to-r from-amber-50 to-yellow-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                            <div class="text-center">
                                <div class="mb-4 md:mb-6">
                                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-amber-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-3xl md:text-4xl text-amber-600"></i>
                                    </div>
                                </div>
                                
                                <h2 class="text-2xl md:text-3xl font-bold text-amber-900 mb-3 md:mb-4">
                                    You're Already a Member!
                                </h2>
                                
                                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                                    Welcome to the <span class="font-semibold text-amber-800">{{ $ministry->name ?? 'Sunday School' }}</span> family! 
                                    We're excited to have you studying God's Word with us.
                                </p>
                                
                                <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                                    <div class="bg-white rounded-lg p-4 md:p-5">
                                        <h3 class="font-semibold text-amber-800 mb-2">Next Steps</h3>
                                        <ul class="text-left space-y-2 text-gray-600">
                                            <li class="flex items-start">
                                                <i class="fas fa-calendar-check text-amber-500 mt-1 mr-3"></i>
                                                <span>Join us this <strong>Sunday at 9:00 AM</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-book text-amber-500 mt-1 mr-3"></i>
                                                <span>Current study: <strong>Book of Romans</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-users text-amber-500 mt-1 mr-3"></i>
                                                <span>Your class: <strong>{{ old('age_group', 'Check with coordinator') }}</strong></span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-envelope text-amber-500 mt-1 mr-3"></i>
                                                <span>You'll receive weekly lesson previews</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                                    <a href="#events" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-amber-600 text-white font-semibold rounded-lg hover:bg-amber-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        View Upcoming Events
                                    </a>
                                    <a href="{{ route('ministries.index') }}" 
                                       class="px-6 py-3 md:px-8 md:py-3 bg-white text-amber-700 font-semibold rounded-lg hover:bg-amber-50 transition-all duration-200 shadow-lg hover:shadow-xl border border-amber-200 flex items-center justify-center">
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
                        <h3 class="text-lg md:text-xl font-bold text-amber-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-amber-100">
                            Sunday School Superintendent
                        </h3>
                        
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-amber-100">
                                    @if($ministry && $ministry->leader_image)
                                        @if(Str::startsWith($ministry->leader_image, ['http://', 'https://']))
                                            <img 
                                                src="{{ $ministry->leader_image }}" 
                                                alt="{{ $ministry->leader_name ?? 'Sunday School Superintendent' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ asset('storage/' . $ministry->leader_image) }}" 
                                                alt="{{ $ministry->leader_name ?? 'Sunday School Superintendent' }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                    @else
                                        <!-- Default placeholder if no image -->
                                        <div class="w-full h-full bg-gradient-to-r from-amber-100 to-yellow-100 flex items-center justify-center">
                                            <i class="fas fa-user-graduate text-3xl md:text-4xl text-amber-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-base md:text-lg font-bold text-amber-800">
                                {{ $ministry?->leader_name ?? 'Sunday School Superintendent' }}
                            </h4>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                Sunday School Ministry Director
                            </p>
                            
                            <p class="text-gray-700 text-xs md:text-sm mb-3 md:mb-4">
                                {{ $ministry?->leader_bio ?? 'Our superintendent is dedicated to providing quality Bible education for all ages and equipping teachers for effective ministry.' }}
                            </p>
                            
                            <button class="w-full px-3 py-2 md:px-4 md:py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition font-medium text-sm md:text-base">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Superintendent
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-amber-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-amber-100">
                            Weekly Schedule
                        </h3>
                        <div class="space-y-3 md:space-y-4">
                            <div class="border-l-4 border-amber-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-amber-800 text-sm md:text-base">All Sunday School Classes</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 10:15 AM</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Various Classrooms</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-blue-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Teachers' Meeting</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>1st Sunday of Month</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Fellowship Hall</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-green-500 pl-3 md:pl-4 py-2">
                                <h4 class="font-bold text-green-800 text-sm md:text-base">Curriculum Planning</h4>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Quarterly | By Appointment</span>
                                </div>
                                <div class="flex items-center text-xs md:text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Church Office</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-amber-600 to-yellow-600 rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 text-white">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Quick Info</h3>
                        <div class="space-y-2 md:space-y-3">
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-users mr-3 text-amber-200"></i>
                                <span>Total Enrollment: 300+</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-chalkboard-teacher mr-3 text-amber-200"></i>
                                <span>Teachers: 25 volunteers</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-calendar-alt mr-3 text-amber-200"></i>
                                <span>Every Sunday: 9:00 AM</span>
                            </div>
                            <div class="flex items-center text-sm md:text-base">
                                <i class="fas fa-graduation-cap mr-3 text-amber-200"></i>
                                <span>8 Age-specific classes</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-amber-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-amber-100">
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-quote-right text-2xl md:text-3xl text-amber-300"></i>
                            </div>
                            <blockquote class="text-base md:text-lg italic text-gray-700 mb-3 md:mb-4 bible-verse">
                                "All Scripture is breathed out by God and profitable for teaching, for reproof, for correction, and for training in righteousness, that the man of God may be complete, equipped for every good work."
                            </blockquote>
                            <p class="font-semibold text-amber-600 text-sm md:text-base">— 2 Timothy 3:16-17 (ESV)</p>
                        </div>
                    </div>

                    <!-- DYNAMIC Upcoming Events -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-amber-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-amber-100">
                            Upcoming Sunday School Events
                        </h3>
                        
                        @if(!empty($upcomingEvents) && $upcomingEvents->isNotEmpty())
                            <div class="space-y-3 md:space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bg-gradient-to-r from-amber-50 to-yellow-100 rounded-lg md:rounded-xl p-3 md:p-4 hover:shadow-md transition-all duration-200">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-amber-800 text-sm md:text-base">{{ $event->title }}</h4>
                                            @if($event->status)
                                                <span class="event-status status-{{ strtolower($event->status) }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs md:text-sm text-gray-600 mb-1">
                                            <i class="fas fa-calendar-alt mr-2 text-amber-500"></i>
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
                                                <i class="fas fa-clock mr-2 text-amber-500"></i>
                                                <span>{{ $event->time }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($event->location)
                                            <div class="flex items-center text-xs md:text-sm text-gray-600 mb-2 md:mb-3">
                                                <i class="fas fa-map-marker-alt mr-2 text-amber-500"></i>
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
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-amber-500 text-white text-xs md:text-sm rounded hover:bg-amber-600 transition">
                                                    Register Now
                                                </a>
                                            @elseif($event->slug)
                                                <a href="{{ route('events.show', $event->slug) }}" 
                                                   class="px-2 py-1 md:px-3 md:py-1 bg-amber-500 text-white text-xs md:text-sm rounded hover:bg-amber-600 transition">
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
                                   class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium text-sm md:text-base">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    View All Events
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 md:py-8">
                                <i class="fas fa-calendar-alt text-2xl md:text-3xl text-gray-300 mb-3 md:mb-4"></i>
                                <p class="text-gray-500 text-sm md:text-base mb-3 md:mb-4">No upcoming events scheduled</p>
                                <a href="{{ route('events.index') }}" 
                                   class="px-3 py-2 md:px-4 md:py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition text-sm md:text-base">
                                    Browse All Events
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Current Study Card -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-amber-900 mb-3 md:mb-4 pb-2 md:pb-3 border-b border-amber-100">
                            Current Curriculum
                        </h3>
                        <div class="text-center">
                            <div class="mb-3 md:mb-4">
                                <i class="fas fa-book-open text-2xl md:text-3xl text-amber-400"></i>
                            </div>
                            <h4 class="text-base md:text-lg font-bold text-amber-800 mb-2">Book of Romans</h4>
                            <p class="text-gray-600 text-sm md:text-base mb-3 md:mb-4">
                                A study on righteousness, faith, and God's plan of salvation
                            </p>
                            <div class="text-xs md:text-sm text-amber-600">
                                <i class="fas fa-calendar mr-1"></i> January - March 2024
                            </div>
                            <a href="#" class="inline-block mt-3 px-3 py-1 md:px-4 md:py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition text-xs md:text-sm">
                                Download Study Guide
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simplified CTA Section -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-t border-amber-100 py-10 md:py-12">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-amber-900 mb-3 md:mb-4">
                    Ready to Study God's Word?
                </h2>
                <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">
                    Join a Sunday School class that fits your age and stage of life. Grow in knowledge and fellowship.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="#join" class="inline-flex items-center justify-center px-6 py-3 md:px-7 md:py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-book-open mr-2"></i>
                        Join Sunday School
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
        const eventCards = document.querySelectorAll('.bg-gradient-to-r.from-amber-50.to-yellow-100');
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