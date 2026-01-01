@extends('layouts.app')

@section('title', 'ELCK Diocese Newsletter Signup')

@section('styles')
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
    body { 
        font-family: "Noto Serif", serif; 
        scroll-behavior: smooth;
    }
    .material-symbols-outlined { 
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; 
    }
    
    /* Hero section improvements */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .hero-overlay {
        background: linear-gradient(135deg, 
            rgba(0, 0, 0, 0.7) 0%, 
            rgba(0, 0, 0, 0.8) 100%);
    }
    
    /* Improved form container */
    .form-container {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    
    /* Enhanced feature cards */
    .feature-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #10b981, #059669);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }
    
    .feature-card:hover::before {
        transform: scaleX(1);
    }
    
    /* Improved icon styling */
    .feature-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    /* Enhanced button */
    .subscribe-button {
        background: linear-gradient(135deg, #059669, #047857);
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 0.025em;
        position: relative;
        overflow: hidden;
    }
    
    .subscribe-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(5, 150, 105, 0.3);
        background: linear-gradient(135deg, #10b981, #059669);
    }
    
    .subscribe-button:active {
        transform: translateY(0);
    }
    
    /* Improved scripture section */
    .scripture-section {
        background: linear-gradient(135deg, rgba(209, 250, 229, 0.2), rgba(167, 243, 208, 0.1));
        position: relative;
        overflow: hidden;
    }
    
    .scripture-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23059669' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
    }
    
    /* Dark mode improvements */
    .dark .scripture-section {
        background: linear-gradient(135deg, rgba(6, 78, 59, 0.2), rgba(5, 46, 22, 0.1));
    }
    
    /* Typography improvements */
    .hero-title {
        font-size: 3.5rem;
        line-height: 1.1;
        font-weight: 900;
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }
    
    @media (max-width: 768px) {
        .hero-subtitle {
            font-size: 1.125rem;
        }
    }
    
    .section-title {
        font-size: 2.5rem;
        line-height: 1.2;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
    }
    
    .section-subtitle {
        font-size: 1.125rem;
        line-height: 1.6;
        max-width: 42rem;
        margin: 0 auto;
    }
    
    /* Spacing improvements */
    .section-spacing {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }
    
    @media (max-width: 768px) {
        .section-spacing {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }
    
    /* Card content improvements */
    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .card-description {
        font-size: 1rem;
        line-height: 1.6;
    }
    
    /* Form input improvements (except dropdown) */
    .form-input-group:not(select) {
        transition: all 0.2s ease;
    }
    
    .form-input-group:not(select):focus-within {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    
    /* Improved checkbox */
    .checkbox-container {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .checkbox-container input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        margin-top: 0.125rem;
        accent-color: #059669;
    }
    
    .checkbox-label {
        font-size: 0.875rem;
        line-height: 1.5;
        cursor: pointer;
    }
    
    /* Animation for feature cards */
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
    
    .feature-card {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    .feature-card:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .feature-card:nth-child(3) {
        animation-delay: 0.4s;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-[#0d1b0d] text-gray-900 dark:text-gray-100">

    <!-- Hero Section -->
    <section class="hero-section relative w-full bg-center bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC7ox9TEhNh3aHkdC7Y4TGNjAh7Ku3OAVDz8CXCTiyQGaUVae9H3iqRjt3R9ihyAnpYo0o-gqo8rD4BNMU7v6veW_Hhb6b9bZS3_nFebMCE4hm_1DQZ4wS8HcfsMACf87EM8UEpLnGypWDOzdH6mE5wm9fk_tAqRm_Ejj81T6kTXmbPe1PNU0QqK7L_3Ht9iKmZC8PboDEd3XtM9rlmX3GBTwswq2fPmAECaKNQ9PCcJBudNKBcZlrdydNJFxvE1TOenVNEaKVaAgc');">
        <div class="absolute inset-0 hero-overlay"></div>
        
        <div class="relative z-10 w-full px-4 py-12 md:py-24">
            <div class="max-w-6xl mx-auto">
                <!-- Hero Content -->
                <div class="text-center mb-12 md:mb-16">
                    <h1 class="hero-title text-white mb-6">
                        Join Our Spiritual Community
                    </h1>
                    <p class="hero-subtitle text-gray-200 max-w-3xl mx-auto mb-10">
                        Receive weekly sermons, event updates, and spiritual encouragement directly to your inbox.
                    </p>
                    
                    <!-- Stats Row -->
                    <div class="flex flex-wrap justify-center gap-6 mb-12">
                        <div class="flex items-center gap-3 px-4 py-3 bg-white/10 backdrop-blur-sm rounded-lg">
                            <span class="material-symbols-outlined text-green-300">
                                groups
                            </span>
                            <div class="text-left">
                                <div class="text-xl font-bold text-white">1,000+</div>
                                <div class="text-sm text-gray-300">Active Members</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 bg-white/10 backdrop-blur-sm rounded-lg">
                            <span class="material-symbols-outlined text-green-300">
                                schedule
                            </span>
                            <div class="text-left">
                                <div class="text-xl font-bold text-white">Weekly</div>
                                <div class="text-sm text-gray-300">Spiritual Content</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 bg-white/10 backdrop-blur-sm rounded-lg">
                            <span class="material-symbols-outlined text-green-300">
                                church
                            </span>
                            <div class="text-left">
                                <div class="text-xl font-bold text-white">Multiple</div>
                                <div class="text-sm text-gray-300">Parishes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Form -->
                <div class="max-w-2xl mx-auto">
                    <div class="form-container bg-white/95 dark:bg-[#1a2e1a]/95 rounded-2xl p-8 md:p-10 shadow-2xl">
                        <div class="text-center mb-8">
                            
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">
                                Subscribe to Our Newsletter
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Join our growing spiritual family today
                            </p>
                        </div>

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                                    Full Name
                                </label>
                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-green-400 focus-within:border-green-400 transition-all duration-200">
                                    <span class="material-symbols-outlined px-4 text-gray-500 dark:text-gray-400">
                                        name
                                    </span>
                                    <input type="text" 
                                           name="name" 
                                           placeholder="Enter your full name" 
                                           value="{{ old('name') }}" 
                                           class="w-full px-3 py-4 text-gray-900 dark:text-gray-100 bg-transparent border-none focus:ring-0 placeholder-gray-400 dark:placeholder-gray-500 text-base">
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                        Email Address
                                    </label>
                                    <span class="text-xs font-medium text-red-500 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded">Required</span>
                                </div>
                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-green-400 focus-within:border-green-400 transition-all duration-200">
                                    <span class="material-symbols-outlined px-4 text-gray-500 dark:text-gray-400">
                                        Email
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           placeholder="your.email@example.com" 
                                           value="{{ old('email') }}" 
                                           required 
                                           class="w-full px-3 py-4 text-gray-900 dark:text-gray-100 bg-transparent border-none focus:ring-0 placeholder-gray-400 dark:placeholder-gray-500 text-base">
                                </div>
                            </div>

                            <!-- Parish Field - LEFT UNCHANGED -->
                            <div>
    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">Parish (Optional)</label>
    <div class="relative">
        <div class="flex items-center border border-green-700 dark:border-green-500 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-400 bg-white dark:bg-[#1a2e1a]">
            <span class="material-symbols-outlined px-3 text-green-700 dark:text-green-400">church</span>
            <select name="parish" class="w-full px-3 py-2 bg-transparent border-none appearance-none custom-select cursor-pointer focus:ring-0">
                <option value="">Select your congregation</option>
                <option value="othoro" {{ old('parish')=='othoro'?'selected':'' }}>Othoro Parish</option>
                <option value="andiwo" {{ old('parish')=='andiwo'?'selected':'' }}>Andiwo Parish</option>
                <option value="visitor" {{ old('parish')=='visitor'?'selected':'' }}>Visitor / Non-member</option>
            </select>
            
        </div>
    </div>
</div>

<style>
/* Style the dropdown options */
.custom-select {
    color: #197b3b; /* Text color of selected option */
    background-color: #e6f4ed; /* Light complementary background */
}

.custom-select option {
    color: #197b3b; /* Text color of options */
    background-color: #e6f4ed; /* Background color of options */
}

.custom-select option:hover {
    background-color: #d1f0db; /* Slightly darker green on hover */
}
</style>


                            <!-- Terms Agreement -->
                            <div class="checkbox-container p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700">
                                <input type="checkbox" 
                                       name="agree_terms" 
                                       required 
                                       id="termsCheckbox">
                                <label for="termsCheckbox" class="checkbox-label text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">I agree to receive newsletter emails from ELCK Southern Lake Diocese</span>
                                    <span class="block text-gray-500 dark:text-gray-400 mt-1 text-sm">
                                        You can unsubscribe at any time using the link in our emails.
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="subscribe-button w-full text-white font-semibold py-4 rounded-xl text-lg">
                                <span class="flex items-center justify-center gap-3">
                                    <span>Subscribe Now</span>
                                    
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Subscribe Section -->
    <section class="section-spacing px-4 bg-gray-100 dark:bg-[#08110b]">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="section-title text-gray-900 dark:text-white mb-6">
                    Why Subscribe?
                </h2>
                <p class="section-subtitle text-gray-600 dark:text-gray-300">
                    Stay informed about the life, events, and spiritual growth opportunities within our diocese community.
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="feature-card bg-white dark:bg-[#1a2e1a] p-8 rounded-2xl shadow-xl">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0L11.293 0.707 4 8v16h16V8l-7.293-7.293L12 0zm0 2.828L17.172 8H6.828L12 2.828zM6 10h12v12H6V10z"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-gray-900 dark:text-white text-center">Weekly Sermons</h3>
                    <p class="card-description text-gray-600 dark:text-gray-300 text-center">
                        Receive Sunday sermons and spiritual reflections directly in your inbox to guide your daily walk with God.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="feature-card bg-white dark:bg-[#1a2e1a] p-8 rounded-2xl shadow-xl">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm0 16H5V9h14v11z"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-gray-900 dark:text-white text-center">Event Updates</h3>
                    <p class="card-description text-gray-600 dark:text-gray-300 text-center">
                        Never miss church gatherings, synods, youth camps, or fellowship events across our diocese.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card bg-white dark:bg-[#1a2e1a] p-8 rounded-2xl shadow-xl">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11c1.657 0 3-1.343 3-3S17.657 5 16 5s-3 1.343-3 3 1.343 3 3 3zm-8 0c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zm0 2c-2.67 0-8 1.337-8 4v3h16v-3c0-2.663-5.33-4-8-4zm8 0c-.29 0-.62.02-.98.05 1.16.84 1.98 1.97 1.98 3.45v3h6v-3c0-2.663-5.33-4-7-4z"/>
                        </svg>
                    </div>
                    <h3 class="card-title text-gray-900 dark:text-white text-center">Community News</h3>
                    <p class="card-description text-gray-600 dark:text-gray-300 text-center">
                        Inspiring stories and testimonies from our parishes across Southern Lake Diocese.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripture Quote -->
    <section class="scripture-section section-spacing px-4">
        <div class="max-w-4xl mx-auto mt-8" >
            <div class="text-center">
                <blockquote class="text-2xl md:text-3xl font-serif italic text-gray-900 dark:text-white leading-relaxed mb-8 max-w-3xl mx-auto">
                    "How good and pleasant it is when God's people live together in unity!"
                </blockquote>
                
                <div class="flex flex-col items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-px bg-gray-300 dark:bg-gray-600"></div>
                        <cite class="flex items-center gap-3 text-green-700 dark:text-green-400 font-bold text-base uppercase tracking-wider">
                            <span class="material-symbols-outlined">
                                book_2
                            </span>
                            Psalm 133:1
                        </cite>
                        <div class="w-16 h-px bg-gray-300 dark:bg-gray-600"></div>
                    </div>
                    
                    <p class="mt-8 mb-8text-gray-600 dark:text-gray-400 text-lg">
                        Join our unified community in worship, fellowship, and spiritual growth
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add form submission animation
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        // Only add animation if form is valid
        if (form.checkValidity()) {
            submitBtn.innerHTML = `
                <span class="flex items-center justify-center gap-3">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Subscribing...
                </span>
            `;
            submitBtn.disabled = true;
        }
    });
    
    // Add hover effect to feature cards
    const cards = document.querySelectorAll('.feature-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });
});
</script>
@endsection