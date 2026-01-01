{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Contact Us - ELCK Southern Lake Diocese')

@section('styles')
<style>
    .contact-hero {
        background-image: linear-gradient(rgba(16, 34, 22, 0.85) 0%, rgba(16, 34, 22, 0.92) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBQ1CtiyKsX0MKbCT29kiG5_hpJ-mOBMN2zQ_iQoWtaaa6XYDQFwnvRKJkgaLQf2fpIXV-dqqSWv2iSRorm8zfBHi00ckVGIIlAopkXvoSd88GK0aT8GLoyJeFqtbmyoyafwKvfzVs0XvqW11URp9OP9q2EY7LDZ5Yn6NpSIT8GWLT5d4F45vozN89QCwcrJWwxXxS4HXEfHNSaBDjEt-JUTnKUWVHBnavB-1FVFdKr9YEMOVl3dJYNHg7fZGBbvzVDpqDwo7FmpYI");
        background-position: center 30%;
        background-size: cover;
        position: relative;
        overflow: hidden;
    }
    
    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(25, 123, 59, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .contact-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(229, 231, 235, 0.5);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
        backdrop-filter: blur(10px);
    }
    
    .dark .contact-card {
        background: linear-gradient(135deg, rgba(31, 41, 55, 0.9) 0%, rgba(31, 41, 55, 0.7) 100%);
        border-color: rgba(55, 65, 81, 0.5);
    }
    
    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: rgba(25, 123, 59, 0.3);
    }
    
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(25, 123, 59, 0.1);
    }
    
    .social-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .social-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .social-btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .map-overlay {
        animation: fadeInUp 0.8s ease-out 0.5s both;
    }
    
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
    
    .floating-icon {
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    .success-message {
        animation: slideDown 0.5s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .pulse-ring {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(25, 123, 59, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(25, 123, 59, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(25, 123, 59, 0);
        }
    }
</style>
@endsection

@section('content')
<!-- Enhanced Hero Section -->
<section class="contact-hero relative">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Dark overlay for better contrast -->
    <div class="absolute inset-0 bg-black/50"></div>
    
    <div class="relative min-h-[400px] sm:min-h-[450px] lg:min-h-[520px] flex flex-col items-center justify-center px-4 py-12 sm:py-16">
        <div class="text-center max-w-4xl mx-auto relative z-10">
            <div class="floating-icon inline-block mb-6">
                <div class="p-4 rounded-2xl bg-white/20 backdrop-blur-sm border border-white/30 shadow-xl">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                <span class="block">We're Here</span>
                <span class="text-emerald-200 bg-gradient-to-r from-emerald-200 to-emerald-100 bg-clip-text text-transparent drop-shadow-md">To Listen & Serve</span>
            </h1>
            
            <p class="text-gray-100 text-lg sm:text-xl md:text-2xl max-w-3xl mx-auto mb-8 leading-relaxed drop-shadow">
                Reach out for prayer, questions, or to connect with our community. Your message matters to us.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <div class="pulse-ring inline-flex items-center gap-3 px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full border border-white/30 shadow-lg">
                    <div class="w-2 h-2 bg-emerald-300 rounded-full animate-pulse shadow-lg"></div>
                    <span class="text-white font-medium drop-shadow">Typically respond within 24 hours</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto">
        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="success-message mb-8 p-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl shadow-lg">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-emerald-900 dark:text-emerald-100">Message Sent Successfully!</h3>
                    <p class="text-emerald-700 dark:text-emerald-300 mt-1">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-8 p-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl shadow-lg">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-red-900 dark:text-red-100">Please fix the following errors:</h3>
                    <ul class="mt-2 text-red-700 dark:text-red-300 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Contact Information -->
            <div class="space-y-10">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                        Get in Touch
                        <span class="block text-emerald-600 dark:text-emerald-400 text-2xl mt-2">We'd love to hear from you</span>
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                        Whether you have questions about our ministries, need pastoral care, or want to get involved, our team is here to help you every step of the way.
                    </p>
                </div>

                <!-- Contact Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Address -->
                    <div class="contact-card group p-6 rounded-2xl">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Visit Our Headquarters</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    ELCK Southern Lake Diocese HQ<br>
                                    P.O. Box 1234 - 40100<br>
                                    Kisumu, Kenya
                                </p>
                                <button class="mt-4 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-medium text-sm inline-flex items-center gap-2 group/btn">
                                    Get Directions
                                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="contact-card group p-6 rounded-2xl">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Call Us Directly</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    <a href="tel:+254716052342" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors text-base font-medium block">
                                        +254 716 052 342
                                    </a>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block">
                                        Monday - Friday: 8:00 AM - 5:00 PM
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-card group p-6 rounded-2xl">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Email Us</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    <a href="mailto:info@elcksld.org" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors text-base font-medium block">
                                        info@elcksld.org
                                    </a>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block">
                                        For general inquiries
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div class="contact-card group p-6 rounded-2xl">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Office Hours</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                    Monday - Friday: 8:00 AM - 5:00 PM<br>
                                    Saturday: 9:00 AM - 1:00 PM<br>
                                    Sunday: Worship Services Only
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 sm:p-10 lg:p-12">
                <div class="mb-10">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Send Us a Message</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Fill out the form below and we'll get back to you as soon as possible.
                    </p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Name & Phone -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Full Name *
                            </label>
                            <input type="text" name="name" required
                                   class="form-input w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-3.5 text-gray-900 dark:text-white placeholder-gray-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-800 transition-all duration-200"
                                   placeholder="John Doe">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" name="phone"
                                   class="form-input w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-3.5 text-gray-900 dark:text-white placeholder-gray-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-800 transition-all duration-200"
                                   placeholder="+254 XXX XXX XXX">
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address *
                        </label>
                        <input type="email" name="email" required
                               class="form-input w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-3.5 text-gray-900 dark:text-white placeholder-gray-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-800 transition-all duration-200"
                               placeholder="john@example.com">
                    </div>
                    
                    <!-- Inquiry Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            How can we help you? *
                        </label>
                        <div class="relative">
                            <select name="inquiry_type" required
                                    class="form-input appearance-none w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-3.5 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-800 transition-all duration-200 cursor-pointer">
                                <option value="" disabled selected>Select an option</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Prayer Request">Prayer Request</option>
                                <option value="Pastoral Care">Pastoral Care</option>
                                <option value="Donations & Tithes">Donations & Tithes</option>
                                <option value="Events">Events & Programs</option>
                                <option value="Membership">Membership</option>
                                <option value="Volunteering">Volunteering</option>
                                <option value="Technical Support">Technical Support</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Your Message *
                        </label>
                        <textarea name="message" rows="5" required
                                  class="form-input w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-3.5 text-gray-900 dark:text-white placeholder-gray-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-800 transition-all duration-200 resize-none"
                                  placeholder="Tell us how we can serve you..."></textarea>
                    </div>
                    
                    <!-- Newsletter -->
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="newsletter" name="newsletter" value="1"
                               class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500">
                        <label for="newsletter" class="text-sm text-gray-600 dark:text-gray-300">
                            Subscribe to our newsletter for spiritual insights and updates
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full group relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 px-8 py-4 text-lg font-bold text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                        <span class="relative z-10 flex items-center justify-center gap-3">
                            Send Message
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </span>
                        <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/20 to-transparent group-hover:translate-x-full transition-transform duration-1000"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Map Section -->
<section class="relative overflow-hidden bg-gray-900">
    <div class="absolute inset-0">
        <div class="w-full h-full bg-cover bg-center opacity-20"
             style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB1ft5V_Bq4egsjvkYs-ii1YU4tV8Vk93G4B_ZSthl36U4ZN4F3dEzHanFgtEjt-Get3rsuXbl2qRiClHUWmgaE46pRruUmQbo9hHR8D46MnUFSyPtHEvF7JciOCH33f66mmlixh-4kWDVr9cF5F84H_7b8IAKQmnJ-01dzYd5Hb-E9HqCx1NJvzTbRoEOPSXrfe4sYWmqe7I_V5HGRU_uGjyELZdXQflxqtBUGFOiqdaAswHMP5N9yahQbaeM52IjI2YhC24Pqxlc")'></div>
    </div>
    
    <div class="relative py-16 sm:py-20 lg:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                    Find Your Way Here
                </h2>
                <p class="text-emerald-200 text-lg sm:text-xl max-w-3xl mx-auto">
                    Located in the heart of Kisumu, easily accessible from all directions
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Map Placeholder -->
                <div class="lg:col-span-2">
                    <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white/10 h-[400px] lg:h-[500px] relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/20 to-gray-900/40"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="inline-block p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <p class="text-white text-lg font-medium">ELCK Southern Lake Diocese HQ</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Directions Info -->
                <div class="map-overlay">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 h-full">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Getting Here</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">By Road</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                                        Located 5km from Kisumu CBD along Kisumu-Busia Road
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">Public Transport</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                                        Matatus available from Kisumu Bus Park to Milimani Estate
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">Parking</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                                        Ample secure parking available within the compound
                                    </p>
                                </div>
                            </div>
                            
                            <button class="w-full mt-8 group relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 px-6 py-3.5 font-bold text-white shadow-lg transition-all duration-300">
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    Open in Maps
                                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                Join Our Online Community
            </h2>
            <p class="text-gray-600 dark:text-gray-300 text-lg sm:text-xl max-w-3xl mx-auto">
                Stay connected with daily inspiration, event updates, and community stories
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Facebook -->
            <a href="#" class="social-btn group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 p-8 text-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Facebook</h3>
                    <p class="text-blue-100 text-sm">Daily devotionals & community updates</p>
                </div>
            </a>
            
            <!-- Instagram -->
            <a href="#" class="social-btn group relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-600 to-purple-600 p-8 text-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Instagram</h3>
                    <p class="text-pink-100 text-sm">Visual stories & testimonies</p>
                </div>
            </a>
            
            <!-- YouTube -->
            <a href="#" class="social-btn group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-600 to-red-700 p-8 text-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">YouTube</h3>
                    <p class="text-red-100 text-sm">Sermons & worship services</p>
                </div>
            </a>
            
            <!-- Twitter -->
            <a href="#" class="social-btn group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-400 to-blue-500 p-8 text-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Twitter</h3>
                    <p class="text-blue-100 text-sm">Quick updates & announcements</p>
                </div>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const requiredFields = contactForm.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showMessage('Please fill in all required fields.', 'error');
            }
        });
    }
    
    // Form input animations
    const formInputs = document.querySelectorAll('.form-input');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-emerald-200', 'dark:ring-emerald-800');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-emerald-200', 'dark:ring-emerald-800');
        });
    });
    
    // Button hover effects
    const buttons = document.querySelectorAll('button, .social-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    function showMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-2xl ${
            type === 'error' ? 'bg-red-500 text-white' : 'bg-emerald-500 text-white'
        }`;
        messageDiv.textContent = message;
        document.body.appendChild(messageDiv);
        
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
});
</script>
@endsection