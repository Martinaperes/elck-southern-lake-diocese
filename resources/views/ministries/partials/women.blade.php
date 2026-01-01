@extends('layouts.app')
@section('title','Women\'s Ministry - ELCK Southern Lake')

@php
    use App\Models\Ministry;
    use App\Models\MinistryMember;
    
  $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
     $ministry = $ministry ?? null;
    if (!$ministry) {
        $ministry = Ministry::where('slug', 'womens-ministry')->first();
    }
@endphp

<style>
:root {
    --primary: #9333ea; /* Purple - feminine color */
    --accent: #ec4899; /* Pink accent */
    --highlight: #fbbf24; /* Gold highlight */
    --dark: #4c1d95; /* Dark purple */
    --light: #faf5ff; /* Light purple background */
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

/* Feminine hero header */
.hero-header {
    background-image:  url('https://images.pexels.com/photos/1181438/pexels-photo-1181438.jpeg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
}

@media (max-width: 768px) {
    .hero-header {
        background-attachment: scroll;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
}



/* Animation for interactive elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
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
    background-color: #9333ea;
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
    border-radius: 12px;
}

/* Touch-friendly button sizes on mobile */
@media (max-width: 640px) {
    button, 
    .btn-like,
    a[role="button"] {
        min-height: 48px;
        min-width: 48px;
        padding: 0.75rem 1.5rem;
    }
    
    input, 
    select, 
    textarea {
        font-size: 16px;
        padding: 0.875rem;
    }
    
    .mobile-stack {
        flex-direction: column;
    }
    
    .mobile-center {
        text-align: center;
    }
}

/* Modern card design */
.modern-card {
    background: white;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
    border: 1px solid rgba(147, 51, 234, 0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px -15px rgba(147, 51, 234, 0.15);
}

/* Improved form inputs */
.form-input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
    transform: translateY(-1px);
}

/* Feminine button styles */
.btn-feminine {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-feminine:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(147, 51, 234, 0.3);
    color: white;
}

.btn-secondary {
    background: white;
    color: var(--primary);
    padding: 0.75rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    border: 2px solid var(--primary);
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-secondary:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

/* Grid improvements */
.grid-responsive {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr));
    gap: 1.5rem;
}

/* Event cards */
.event-card {
    background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
    border-radius: 16px;
    padding: 1.25rem;
    border-left: 4px solid var(--primary);
    transition: all 0.3s ease;
    cursor: pointer;
}

.event-card:hover {
    transform: translateX(5px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Loading animation */
@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

/* Success animation */
@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.success-pulse {
    animation: successPulse 2s ease-in-out infinite;
}
</style>

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-pink-50 font-sans">
    
    <!-- Enhanced Hero Section -->
    <section class="relative hero-header py-12 md:py-20 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 hero-overlay"></div>
        
        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <!-- Back button -->
                <div class="mb-6 md:mb-8">
                    <a href="{{ route('ministries.index') }}" 
                       class="inline-flex items-center bg-white/90 backdrop-blur-sm text-purple-800 hover:bg-white px-4 py-3 rounded-2xl font-semibold group transition-all duration-300 shadow-lg hover:shadow-xl fade-in-up">
                        <i class="fas fa-arrow-left mr-3 text-purple-600 group-hover:translate-x-1 transition-transform"></i>
                        <span class="text-sm md:text-base">All Ministries</span>
                    </a>
                </div>
                
                <!-- Ministry Identity -->
                <div class="text-center mb-8 md:mb-12 fade-in-up">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 md:mb-4">
                        Women's Ministry
                        <span class="block text-pink-200 text-xl md:text-2xl lg:text-3xl mt-2 font-normal">
                            Sisterhood in Christ
                        </span>
                    </h1>
                    
                    <p class="text-lg md:text-xl text-purple-100 mb-6 md:mb-8 max-w-3xl mx-auto leading-relaxed px-4">
                        A vibrant community where women of all ages find spiritual growth, authentic relationships, and purposeful service in God's love.
                    </p>
                    
                    <!-- Animated divider -->
                    <div class="h-1.5 w-24 md:w-32 bg-gradient-to-r from-pink-300 via-purple-400 to-purple-500 rounded-full mx-auto mb-6 md:mb-8"></div>
                    
                    <!-- Interactive Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 max-w-2xl mx-auto">
                        <div class="bg-white/15 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/20 hover:bg-white/25 transition-all duration-300 hover:scale-105">
                            <div class="text-2xl md:text-3xl font-bold text-pink-300">300+</div>
                            <div class="text-purple-100 text-xs md:text-sm font-medium mt-1">Active Women</div>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/20 hover:bg-white/25 transition-all duration-300 hover:scale-105">
                            <div class="text-2xl md:text-3xl font-bold text-purple-300">Monthly</div>
                            <div class="text-purple-100 text-xs md:text-sm font-medium mt-1">Gatherings</div>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/20 hover:bg-white/25 transition-all duration-300 hover:scale-105">
                            <div class="text-2xl md:text-3xl font-bold text-yellow-300">12+</div>
                            <div class="text-purple-100 text-xs md:text-sm font-medium mt-1">Small Groups</div>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/20 hover:bg-white/25 transition-all duration-300 hover:scale-105">
                            <div class="text-2xl md:text-3xl font-bold text-teal-300">Year-Round</div>
                            <div class="text-purple-100 text-xs md:text-sm font-medium mt-1">Outreach</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Curved divider -->
        <div class="absolute bottom-0 left-0 right-0 transform translate-y-1">
            <svg class="w-full" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 60L60 45C120 30 240 0 360 0C480 0 600 30 720 37.5C840 45 960 30 1080 22.5C1200 15 1320 15 1380 15L1440 15V60H0Z" fill="#faf5ff"/>
            </svg>
        </div>
    </section>

    <!-- Notifications Section -->
    @if(session('success') || session('info') || $errors->any())
    <div class="container mx-auto px-4 md:px-6 lg:px-8 mt-8">
        <div class="max-w-4xl mx-auto space-y-4">
            @if(session('success'))
                <div class="modern-card bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 animate-slide-down">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-lg p-2">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.style.display='none'" 
                                class="text-green-600 hover:text-green-800">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="modern-card bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 animate-slide-down">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-lg p-2">
                                <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-blue-800">{{ session('info') }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.style.display='none'" 
                                class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="modern-card bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 animate-slide-down">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-100 rounded-lg p-2">
                                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-red-800">Please fix the following:</p>
                            </div>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.style.display='none'" 
                                class="text-red-600 hover:text-red-800">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    <ul class="space-y-1 ml-12">
                        @foreach($errors->all() as $error)
                            <li class="text-red-700 text-sm flex items-center">
                                <i class="fas fa-circle text-xs mr-2"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="container mx-auto px-4 md:px-6 lg:px-8 py-8 md:py-12">
        <div class="max-w-7xl mx-auto">
            <!-- Responsive Layout -->
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Primary Content -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Mission Section -->
                    <section class="modern-card">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl md:text-3xl font-bold text-purple-900">
                                Our Mission & Vision
                            </h2>
                            <div class="hidden md:block">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                                    <i class="fas fa-heart mr-1"></i> Heart-Centered
                                </span>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                The ELCK Women's Ministry creates a nurturing space where women of all ages can grow spiritually, build authentic relationships, discover their God-given purpose, and serve their families and communities with love and wisdom.
                            </p>
                            
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border-l-4 border-purple-500">
                                <div class="flex items-start">
                                    <i class="fas fa-quote-left text-purple-400 text-2xl mr-4 mt-1"></i>
                                    <div>
                                        <p class="text-xl font-semibold text-purple-800 italic mb-2">
                                            "Empowering women to walk confidently in their faith, embrace their unique calling, and impact generations through Christ's love."
                                        </p>
                                        <div class="flex items-center mt-4">
                                            <div class="h-px flex-1 bg-purple-200"></div>
                                            <span class="mx-4 text-purple-600 font-medium">Proverbs 31:25</span>
                                            <div class="h-px flex-1 bg-purple-200"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Image Gallery -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                                <div class="relative rounded-2xl overflow-hidden group">
                                    <img src="https://images.pexels.com/photos/6860408/pexels-photo-6860408.jpeg" 
                                         alt="Women's Bible Study"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                        <span class="text-white font-semibold">Bible Study Fellowship</span>
                                    </div>
                                </div>
                                <div class="relative rounded-2xl overflow-hidden group">
                                    <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&w=800&q=80" 
                                         alt="Women's Fellowship"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                        <span class="text-white font-semibold">Authentic Sisterhood</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Core Focus Areas -->
                    <section class="modern-card">
                        <h2 class="text-2xl md:text-3xl font-bold text-purple-900 mb-8">
                            Our Core Focus Areas
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            @php
                                $focusAreas = [
                                    [
                                        'icon' => 'book-bible',
                                        'title' => 'Spiritual Growth',
                                        'color' => 'purple',
                                        'description' => 'Deepening faith through Bible study, prayer, and discipleship tailored for women.',
                                        'features' => ['Women\'s Bible Studies', 'Prayer Circles', 'Spiritual Mentorship']
                                    ],
                                    [
                                        'icon' => 'hands-holding-heart',
                                        'title' => 'Authentic Community',
                                        'color' => 'pink',
                                        'description' => 'Building genuine sisterhood through shared experiences and supportive relationships.',
                                        'features' => ['Small Groups', 'Mentor-Mentee', 'Fellowship Events']
                                    ],
                                    [
                                        'icon' => 'hands-helping',
                                        'title' => 'Purposeful Service',
                                        'color' => 'teal',
                                        'description' => 'Empowering women to serve in their families, church, and community.',
                                        'features' => ['Outreach Programs', 'Hospitality Teams', 'Mission Projects']
                                    ],
                                    [
                                        'icon' => 'person-chalkboard',
                                        'title' => 'Personal Development',
                                        'color' => 'yellow',
                                        'description' => 'Growing in wisdom, leadership, and practical life skills.',
                                        'features' => ['Leadership Training', 'Life Skills Workshops', 'Health & Wellness']
                                    ]
                                ];
                            @endphp
                            
                            @foreach($focusAreas as $area)
                                <div class="bg-gradient-to-br from-{{ $area['color'] }}-50 to-white rounded-xl p-5 border border-{{ $area['color'] }}-100 hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-start mb-4">
                                        <div class="bg-{{ $area['color'] }}-100 text-{{ $area['color'] }}-700 rounded-xl p-3 mr-4">
                                            <i class="fas fa-{{ $area['icon'] }} text-lg"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $area['title'] }}</h3>
                                    </div>
                                    <p class="text-gray-600 mb-4">{{ $area['description'] }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($area['features'] as $feature)
                                            <span class="px-3 py-1 bg-{{ $area['color'] }}-100 text-{{ $area['color'] }}-800 rounded-full text-xs font-medium">
                                                {{ $feature }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Activities Section -->
                    <section class="modern-card">
                        <h2 class="text-2xl md:text-3xl font-bold text-purple-900 mb-6">
                            Monthly Activities & Events
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Activity 1 -->
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-5 border border-purple-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-purple-500 text-white rounded-xl p-3 mr-4">
                                        <i class="fas fa-book-open text-lg"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-purple-800">Women's Bible Study</h3>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    Weekly in-depth Bible study exploring God's Word and its application to women's lives today.
                                </p>
                                <div class="text-sm text-purple-600">
                                    <i class="fas fa-clock mr-2"></i> Tuesdays 10:00 AM | Church Parlor
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-5 border border-pink-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-pink-500 text-white rounded-xl p-3 mr-4">
                                        <i class="fas fa-mug-hot text-lg"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-pink-800">Coffee & Conversation</h3>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    Monthly casual gathering for fellowship, sharing, and building authentic relationships.
                                </p>
                                <div class="text-sm text-pink-600">
                                    <i class="fas fa-clock mr-2"></i> 1st Saturday | 9:00 AM | Fellowship Hall
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-xl p-5 border border-teal-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-teal-500 text-white rounded-xl p-3 mr-4">
                                        <i class="fas fa-hands-praying text-lg"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-teal-800">Prayer Warriors</h3>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    Intercessory prayer group meeting weekly to pray for families, church, and community needs.
                                </p>
                                <div class="text-sm text-teal-600">
                                    <i class="fas fa-clock mr-2"></i> Thursdays 7:00 PM | Prayer Room
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-5 border border-yellow-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-yellow-500 text-white rounded-xl p-3 mr-4">
                                        <i class="fas fa-hand-holding-heart text-lg"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-yellow-800">Service Projects</h3>
                                </div>
                                <p class="text-gray-600 mb-4">
                                    Monthly outreach programs serving local shelters, hospitals, and community organizations.
                                </p>
                                <div class="text-sm text-yellow-600">
                                    <i class="fas fa-calendar mr-2"></i> 3rd Saturday | Various Locations
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Join Form - Only show if user is not already a member -->
                    @if(!$isMember)
                        <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-pink-500 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-pink-100">
                                Join Our Sisterhood Community
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
                                
                                <!-- Life Stage (using SELECT like Youth Ministry's age_group) -->
<div>
    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="life_stage">
        Your Life Stage *
    </label>
    <select id="life_stage" name="life_stage" 
            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition text-sm md:text-base"
            required>
        <option value="">Select life stage</option>
        <option value="Young Adult (18-30)" {{ old('life_stage') == 'Young Adult (18-30)' ? 'selected' : '' }}>Young Adult (18-30 years)</option>
        <option value="Mother & Family (31-50)" {{ old('life_stage') == 'Mother & Family (31-50)' ? 'selected' : '' }}>Mother & Family (31-50 years)</option>
        <option value="Seasoned & Senior (51+)" {{ old('life_stage') == 'Seasoned & Senior (51+)' ? 'selected' : '' }}>Seasoned & Senior (51+ years)</option>
    </select>
    @error('life_stage')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
                                
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2 text-sm md:text-base" for="role">
                                        What role would you like to have?
                                    </label>
                                    <select id="role" name="role" 
                                            class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-100 focus:border-pink-400 outline-none transition text-sm md:text-base">
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
                                        <label class="flex items-center bg-pink-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Sunday Youth Service" 
                                                   class="rounded text-purple-600 focus:ring-pink-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Sunday Youth Service', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Saturday Women Service</span>
                                        </label>
                                        <label class="flex items-center bg-pink-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Friday Game Nights" 
                                                   class="rounded text-purple-600 focus:ring-pink-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Friday Game Nights', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Friday Game Nights</span>
                                        </label>
                                        <label class="flex items-center bg-pink-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Small Group Bible Study" 
                                                   class="rounded text-purple-600 focus:ring-pink-500 h-4 w-4"
                                                   {{ is_array(old('interests')) && in_array('Small Group Bible Study', old('interests')) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 text-sm md:text-base">Small Group Bible Study</span>
                                        </label>
                                        <label class="flex items-center bg-pink-50 p-3 rounded-lg cursor-pointer">
                                            <input type="checkbox" name="interests[]" value="Service & Mission Trips" 
                                                   class="rounded text-purple-600 focus:ring-pink-500 h-4 w-4"
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
                                
                                <!-- Hidden field for ministry_id -->
                                <input type="hidden" name="ministry_id" value="{{ $ministry->id }}">
                                
                                <!-- Submit Buttons -->
                                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                    <button type="submit" 
                                            class="btn-feminine flex-1 py-4 text-base">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Join Sisterhood</span>
                                    </button>
                                    <a href="#contact" 
                                       class="btn-secondary flex-1 py-4 text-base no-underline">
                                        <i class="fas fa-question-circle"></i>
                                        <span>Learn More</span>
                                    </a>
                                </div>
                                
                                <p class="text-xs text-gray-500 text-center mt-6">
                                    Your information is confidential. You'll receive ministry updates and can unsubscribe anytime.
                                </p>
                            </form>
                        </section>
                    @else
                        <!-- Membership Confirmation - Same as Youth Ministry -->
                        <section class="modern-card bg-gradient-to-r from-purple-50 to-pink-100 border-purple-300 success-pulse">
                            <div class="text-center py-8 md:py-12">
                                <div class="w-20 h-20 md:w-24 md:h-24 mx-auto bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                                    <i class="fas fa-check text-3xl md:text-4xl text-purple-600"></i>
                                </div>
                                
                                <h2 class="text-2xl md:text-3xl font-bold text-purple-900 mb-4">
                                    Welcome Sister! 🎀
                                </h2>
                                
                                <p class="text-gray-700 text-lg mb-8 max-w-2xl mx-auto">
                                    You're already part of the <span class="font-semibold text-purple-800">{{ $ministry->name }}</span> sisterhood!
                                    We're blessed to have you with us.
                                </p>
                                
                                <div class="grid md:grid-cols-3 gap-4 mb-8 max-w-3xl mx-auto">
                                    <div class="bg-white rounded-xl p-4">
                                        <div class="text-purple-600 mb-2">
                                            <i class="fas fa-calendar-check text-xl"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Stay Connected</h4>
                                        <p class="text-sm text-gray-600">Check upcoming women's events</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-4">
                                        <div class="text-purple-600 mb-2">
                                            <i class="fas fa-users text-xl"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Find Community</h4>
                                        <p class="text-sm text-gray-600">Join a small group that fits you</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-4">
                                        <div class="text-purple-600 mb-2">
                                            <i class="fas fa-hands-praying text-xl"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Pray Together</h4>
                                        <p class="text-sm text-gray-600">Thursday prayer meetings at 7PM</p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="#events" 
                                       class="btn-feminine px-8">
                                        <i class="fas fa-calendar-alt"></i>
                                        View Events
                                    </a>
                                    <a href="{{ route('ministries.index') }}" 
                                       class="btn-secondary px-8 no-underline">
                                        <i class="fas fa-church"></i>
                                        Explore Ministries
                                    </a>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">
                    
                    <!-- Leader Profile -->
                    <div class="modern-card">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            <i class="fas fa-user-tie mr-2 text-purple-600"></i>
                            Ministry Director
                        </h3>
                        
                        <div class="text-center">
                            <div class="relative w-32 h-32 mx-auto mb-4">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full blur-lg opacity-30"></div>
                                <div class="relative w-full h-full rounded-full overflow-hidden border-4 border-white shadow-lg">
                                    @if($ministry && $ministry->leader_image)
                                        <img src="{{ Str::startsWith($ministry->leader_image, ['http://', 'https://']) ? $ministry->leader_image : asset('storage/' . $ministry->leader_image) }}" 
                                             alt="{{ $ministry->leader_name ?? 'Women\'s Ministry Director' }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center">
                                            <i class="fas fa-user text-4xl text-purple-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <h4 class="text-lg font-bold text-purple-800 mb-1">
                                {{ $ministry?->leader_name ?? 'Women\'s Ministry Director' }}
                            </h4>
                            <p class="text-gray-600 text-sm mb-4">Ministry Coordinator</p>
                            <p class="text-gray-700 text-sm mb-6">
                                {{ $ministry?->leader_bio ?? 'Passionate about empowering women to discover their identity in Christ and build authentic relationships.' }}
                            </p>
                            
                            <button class="btn-feminine w-full py-3 text-sm">
                                <i class="fas fa-envelope mr-2"></i>
                                Contact Director
                            </button>
                        </div>
                    </div>

                    <!-- Weekly Schedule -->
                    <div class="modern-card">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            <i class="fas fa-calendar-alt mr-2 text-purple-600"></i>
                            Regular Schedule
                        </h3>
                        <div class="space-y-3">
                            @foreach([
                                ['day' => 'Tuesday', 'time' => '10:00 AM', 'event' => 'Bible Study', 'location' => 'Church Parlor', 'color' => 'purple'],
                                ['day' => 'Thursday', 'time' => '7:00 PM', 'event' => 'Prayer Meeting', 'location' => 'Prayer Room', 'color' => 'pink'],
                                ['day' => '1st Saturday', 'time' => '9:00 AM', 'event' => 'Coffee Fellowship', 'location' => 'Fellowship Hall', 'color' => 'yellow'],
                                ['day' => '3rd Saturday', 'time' => '10:00 AM', 'event' => 'Service Project', 'location' => 'Various', 'color' => 'teal']
                            ] as $schedule)
                                <div class="flex items-start p-3 rounded-lg bg-{{ $schedule['color'] }}-50 hover:bg-{{ $schedule['color'] }}-100 transition">
                                    <div class="flex-shrink-0 bg-{{ $schedule['color'] }}-100 text-{{ $schedule['color'] }}-800 rounded-lg p-2 mr-3">
                                        <i class="fas fa-{{ $schedule['color'] == 'purple' ? 'book-open' : ($schedule['color'] == 'pink' ? 'pray' : ($schedule['color'] == 'yellow' ? 'mug-hot' : 'hands-helping')) }}"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">{{ $schedule['day'] }} {{ $schedule['event'] }}</h4>
                                        <div class="flex items-center text-xs text-gray-600 mt-1">
                                            <i class="fas fa-clock mr-1"></i>
                                            <span class="mr-3">{{ $schedule['time'] }}</span>
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            <span>{{ $schedule['location'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="modern-card bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                        <h3 class="text-xl font-bold mb-4">Women's Ministry at a Glance</h3>
                        <div class="space-y-3">
                            @foreach([
                                ['icon' => 'users', 'label' => 'Active Members', 'value' => '300+'],
                                ['icon' => 'hands-praying', 'label' => 'Prayer Groups', 'value' => '6 Active'],
                                ['icon' => 'book-bible', 'label' => 'Bible Studies', 'value' => 'Weekly'],
                                ['icon' => 'heart', 'label' => 'Service Hours', 'value' => '2000+ hrs/yr']
                            ] as $stat)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-white/20 rounded-lg p-2 mr-3">
                                        <i class="fas fa-{{ $stat['icon'] }} text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm opacity-90">{{ $stat['label'] }}</div>
                                        <div class="font-semibold">{{ $stat['value'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Events Section -->
                    <div class="modern-card">
                        <div class="flex items-center justify-between mb-4 pb-3 border-b border-purple-100">
                            <h3 class="text-xl font-bold text-purple-900">
                                <i class="fas fa-calendar-star mr-2 text-purple-600"></i>
                                Upcoming Events
                            </h3>
                            <a href="{{ route('events.index') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                View All
                            </a>
                        </div>
                        
                        @if($upcomingEvents->isNotEmpty())
                            <div class="space-y-3">
                                @foreach($upcomingEvents->take(3) as $event)
                                    <div class="event-card">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-semibold text-gray-800">{{ Str::limit($event->title, 30) }}</h4>
                                            @if($event->status)
                                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full font-medium">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs text-gray-600 mb-1">
                                            <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>
                                            <span>{{ \Carbon\Carbon::parse($event->start_date)->format('M j') }}</span>
                                        </div>
                                        
                                        @if($event->location)
                                            <div class="flex items-center text-xs text-gray-600 mb-3">
                                                <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                                                <span class="truncate">{{ $event->location }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="flex justify-between items-center">
                                            <a href="{{ $event->registration_link ?? route('events.show', $event->slug) }}" 
                                               class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center">
                                                Details
                                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                            </a>
                                            @if($event->is_featured)
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                                    <i class="fas fa-star mr-1"></i>Featured
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-gray-300 mb-3">
                                    <i class="fas fa-calendar-plus text-3xl"></i>
                                </div>
                                <p class="text-gray-500 text-sm">Women's events coming soon</p>
                            </div>
                        @endif
                    </div>

                    <!-- Scripture Card -->
                    <div class="modern-card">
                        <h3 class="text-xl font-bold text-purple-900 mb-4">
                            <i class="fas fa-book-bible mr-2 text-purple-600"></i>
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-quote-right text-3xl text-purple-300"></i>
                            </div>
                            <blockquote class="text-lg italic text-gray-700 mb-4 leading-relaxed">
                                "She is clothed with strength and dignity; she can laugh at the days to come. She speaks with wisdom, and faithful instruction is on her tongue."
                            </blockquote>
                            <p class="font-semibold text-purple-600">— Proverbs 31:25-26 (NIV)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Final CTA -->
    <section class="bg-gradient-to-r from-purple-50 to-pink-50 border-t border-purple-100 py-12 md:py-16">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-purple-900 mb-4">
                    Find Your Place in Our Sisterhood
                </h2>
                <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                    Whether you're seeking spiritual growth, authentic friendships, or opportunities to serve, there's a place for you here.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#join" 
                       class="btn-feminine px-8 py-3 text-base">
                        <i class="fas fa-user-plus mr-2"></i>
                        Join Our Ministry
                    </a>
                    
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll with offset for fixed headers
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Form input enhancements
        const formInputs = document.querySelectorAll('.form-input');
        formInputs.forEach(input => {
            // Add floating label effect
            const parent = input.parentElement;
            if (parent.querySelector('label')) {
                const label = parent.querySelector('label');
                input.addEventListener('focus', () => {
                    label.classList.add('text-purple-600');
                });
                input.addEventListener('blur', () => {
                    if (!input.value) {
                        label.classList.remove('text-purple-600');
                    }
                });
            }
            
            // Auto-resize textareas
            if (input.tagName === 'TEXTAREA') {
                input.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            }
        });
        
        // Add loading states to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                    submitButton.disabled = true;
                }
            });
        });
        
        // Mobile menu improvements
        if (window.innerWidth <= 768) {
            // Ensure mobile touch targets are adequate
            document.querySelectorAll('button, a').forEach(el => {
                if (getComputedStyle(el).display === 'inline-block' || 
                    getComputedStyle(el).display === 'inline') {
                    el.style.minHeight = '44px';
                    el.style.minWidth = '44px';
                }
            });
        }
        
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);
        
        // Observe modern cards
        document.querySelectorAll('.modern-card').forEach(card => {
            observer.observe(card);
        });
        
        // Auto-hide notifications
        setTimeout(() => {
            document.querySelectorAll('.animate-slide-down').forEach(notification => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-10px)';
                setTimeout(() => notification.remove(), 300);
            });
        }, 5000);
        
        // Image lazy loading
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (img.complete) {
                img.classList.add('loaded');
            } else {
                img.addEventListener('load', () => {
                    img.classList.add('loaded');
                });
            }
        });
        
        // Success animation for membership confirmation
        const successCard = document.querySelector('.success-pulse');
        if (successCard) {
            successCard.addEventListener('animationiteration', function() {
                this.style.animationDuration = '3s';
            });
        }
    });
    
    // Handle mobile viewport adjustments
    function adjustViewportForMobile() {
        if (window.innerWidth <= 768) {
            const viewport = document.querySelector('meta[name="viewport"]');
            if (viewport) {
                viewport.content = 'width=device-width, initial-scale=1, maximum-scale=5';
            }
        }
    }
    
    window.addEventListener('resize', adjustViewportForMobile);
    adjustViewportForMobile();
</script>
@endsection