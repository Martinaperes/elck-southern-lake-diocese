@extends('layouts.app')

@section('title', 'Men\'s Ministry - Mercer Church')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Banner Section -->
    <div class="relative bg-gradient-to-r from-[#1e3a8a] to-blue-700 py-20 md:py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute -right-24 -top-24 w-96 h-96 bg-blue-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-indigo-500 rounded-full opacity-20 blur-3xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-8">
            <div class="max-w-4xl">
                <div class="mb-6">
                    <a href="/ministries" class="inline-flex items-center text-blue-200 hover:text-white font-semibold group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to All Ministries
                    </a>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    Men's Ministry
                </h1>
                <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                    Building godly men through faith, fellowship, and service
                </p>
                <div class="h-2 w-32 bg-gradient-to-r from-blue-300 to-indigo-400 rounded-full"></div>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L1440 0V120H0Z" fill="#f9fafb"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 md:px-8 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Mission Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-blue-900 mb-6 pb-4 border-b-2 border-blue-100">
                            Our Mission
                        </h2>
                        <p class="text-gray-700 text-lg mb-6">
                            Our Men's Ministry is dedicated to spiritually nurturing and equipping men to lead in their families, church, and communities. We believe in creating a brotherhood where men can grow in faith, build authentic relationships, and discover their God-given purpose.
                        </p>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border-l-4 border-blue-600">
                            <p class="text-xl font-semibold text-blue-800 italic">
                                "To build strong men rooted in God's Word, committed to their families, and engaged in transforming their communities through Christ-like leadership and service."
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/mens-fellowship-1.jpg') }}" 
                                     alt="Men's Fellowship Meeting" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/mens-bible-study.jpg') }}" 
                                     alt="Men's Bible Study" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-blue-900 mb-6 pb-4 border-b-2 border-blue-100">
                            What We Do
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Activity 1 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-bible text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Bible Study</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Deep dive into scripture every Saturday morning. We explore practical applications of God's Word for men in today's world, focusing on leadership, integrity, and spiritual growth.
                                    </p>
                                    <div class="mt-3 flex items-center text-blue-600">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span class="font-medium">Every Saturday | 9:00 AM - 11:00 AM</span>
                                        <span class="mx-3">•</span>
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        <span class="font-medium">Fellowship Hall</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-users text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Sports & Fellowship</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Building brotherhood through sports activities and social events. Monthly basketball games, fishing trips, and men's breakfasts to strengthen relationships.
                                    </p>
                                    <div class="mt-3 flex items-center text-blue-600">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <span class="font-medium">1st Saturday Monthly | Various Times</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-hands-helping text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Community Service</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Monthly service projects helping our neighbors. From home repairs for elderly members to community clean-ups and food drives.
                                    </p>
                                    <div class="mt-3 flex items-center text-blue-600">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        <span class="font-medium">3rd Saturday Monthly | 8:00 AM - 12:00 PM</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-blue-100 text-blue-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-graduation-cap text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Leadership Training</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Workshops on leadership, financial stewardship, marriage, and parenting. Equipping men to lead effectively at home, work, and church.
                                    </p>
                                    <div class="mt-3 flex items-center text-blue-600">
                                        <i class="fas fa-calendar-star mr-2"></i>
                                        <span class="font-medium">Quarterly | Saturday Workshops</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Get Involved Form -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-blue-900 mb-6 pb-4 border-b-2 border-blue-100">
                            Get Involved
                        </h2>
                        <p class="text-gray-700 mb-6">
                            Interested in joining or volunteering? Send us a message and we'll help you get connected.
                        </p>
                        
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="fullName">
                                        Full Name
                                    </label>
                                    <input type="text" id="fullName" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                           placeholder="Your name">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="email">
                                        Email Address
                                    </label>
                                    <input type="email" id="email" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                           placeholder="Your email">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-3">
                                    I'm interested in...
                                </label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-gray-700">Joining the Ministry</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-gray-700">Volunteering for Service Projects</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-gray-700">Attending Leadership Training</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-gray-700">Mentorship Program</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="message">
                                    Message
                                </label>
                                <textarea id="message" rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                          placeholder="How can we help you?"></textarea>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </form>
                    </section>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">
                    
                    <!-- Ministry Leader Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-4 pb-3 border-b border-blue-100">
                            Ministry Leader
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-blue-100">
                                    <img src="{{ asset('images/leaders/mens-leader.jpg') }}" 
                                         alt="Ministry Leader" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <h4 class="text-lg font-bold text-blue-800">Bro. James Kiprono</h4>
                            <p class="text-gray-600 mb-4">Men's Ministry Coordinator</p>
                            <p class="text-gray-700 text-sm mb-4">
                                Bro. James has been serving the men of Mercer Church for over 8 years with a passion for mentorship and discipleship.
                            </p>
                            <button class="w-full px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition font-medium">
                                <i class="fas fa-envelope mr-2"></i>Contact Leader
                            </button>
                        </div>
                    </div>

                    <!-- Upcoming Events Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-4 pb-3 border-b border-blue-100">
                            Upcoming Events
                        </h3>
                        <div class="space-y-4">
                            <!-- Event 1 -->
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <h4 class="font-bold text-blue-800">Annual Men's Retreat</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>October 18-20, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Mountain View Retreat Center</span>
                                </div>
                                <button class="mt-2 px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                    Register Now
                                </button>
                            </div>
                            
                            <!-- Event 2 -->
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <h4 class="font-bold text-blue-800">Men's Breakfast</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>November 2, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>8:00 AM</span>
                                </div>
                            </div>
                            
                            <!-- Event 3 -->
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <h4 class="font-bold text-blue-800">Community Service Day</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>November 16, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>8:00 AM - 12:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Quick Info</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-3 text-blue-200"></i>
                                <span>Active Members: 85+</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-blue-200"></i>
                                <span>Meets: Every Saturday</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-3 text-blue-200"></i>
                                <span>Time: 9:00 AM - 11:00 AM</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-blue-200"></i>
                                <span>Location: Fellowship Hall</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-4 pb-3 border-b border-blue-100">
                            Our Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-quote-right text-3xl text-blue-300"></i>
                            </div>
                            <blockquote class="text-lg italic text-gray-700 mb-4">
                                "Be watchful, stand firm in the faith, act like men, be strong."
                            </blockquote>
                            <p class="font-semibold text-blue-600">— 1 Corinthians 16:13 (ESV)</p>
                        </div>
                    </div>

                    <!-- Gallery Preview -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-4 pb-3 border-b border-blue-100">
                            Gallery
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/mens-retreat.jpg') }}" 
                                     alt="Men's Retreat" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/mens-service.jpg') }}" 
                                     alt="Service Project" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/mens-worship.jpg') }}" 
                                     alt="Men's Worship" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/mens-sports.jpg') }}" 
                                     alt="Sports Fellowship" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                        </div>
                        <button class="w-full mt-4 px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition font-medium">
                            <i class="fas fa-images mr-2"></i>View Full Gallery
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-t border-blue-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6">
                    Ready to Join Our Brotherhood?
                </h2>
                <p class="text-gray-600 mb-8 text-lg">
                    You don't have to walk your faith journey alone. Join other men committed to growing in Christ and making a difference.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#get-involved" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-user-plus mr-3"></i>
                        Join Next Meeting
                    </a>
                    <a href="/ministries" class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-700 hover:text-blue-800 font-semibold rounded-xl shadow-lg hover:shadow-xl border border-blue-200 transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-arrow-left mr-3"></i>
                        Back to Ministries
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* Add smooth scrolling for anchor links */
    html {
        scroll-behavior: smooth;
    }
    
    /* Style for the form section anchor */
    #get-involved {
        scroll-margin-top: 100px;
    }
</style>

<script>
    // Form submission handling
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                
                // Basic validation
                if (!data.fullName || !data.email || !data.message) {
                    alert('Please fill in all required fields.');
                    return;
                }
                
                // Here you would typically send the data to your server
                // For now, just show a success message
                alert('Thank you for your interest in Men\'s Ministry! We will contact you soon.');
                form.reset();
            });
        }
        
        // Smooth scroll to get involved form
        const joinButtons = document.querySelectorAll('a[href="#get-involved"]');
        joinButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector('#get-involved');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });
</script>
@endsection