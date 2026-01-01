@extends('layouts.app')

@section('title', 'Children\'s Ministry - Mercer Church')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-yellow-50 to-pink-50 font-sans">
    
    <!-- Banner Section -->
    <div class="relative bg-gradient-to-r from-purple-600 to-pink-500 py-20 md:py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute -right-24 -top-24 w-96 h-96 bg-purple-400 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-pink-400 rounded-full opacity-20 blur-3xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-8">
            <div class="max-w-4xl">
                <div class="mb-6">
                    <a href="/ministries" class="inline-flex items-center text-purple-200 hover:text-white font-semibold group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to All Ministries
                    </a>
                </div>
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <i class="fas fa-child text-4xl text-white"></i>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-center">
                    Children's Ministry
                </h1>
                <p class="text-xl text-purple-100 mb-8 leading-relaxed text-center">
                    Nurturing children and young learners in the Christian faith with fun, safe, and interactive activities
                </p>
                <div class="h-2 w-32 bg-gradient-to-r from-yellow-300 to-pink-400 rounded-full mx-auto"></div>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L1440 0V120H0Z" fill="#fef3c7"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative container mx-auto px-4 md:px-8 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Mission Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            Our Mission
                        </h2>
                        <p class="text-gray-700 text-lg mb-6">
                            Our Children's Ministry is dedicated to providing children with a safe, engaging, and spiritually enriching environment where they can learn about God's love, biblical teachings, and Christian values in age-appropriate ways.
                        </p>
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border-l-4 border-purple-600">
                            <p class="text-xl font-semibold text-purple-800 italic">
                                "Training children in the ways of the Lord through love, laughter, and learning."
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/children-class.jpg') }}" 
                                     alt="Children's Bible Class" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/children-play.jpg') }}" 
                                     alt="Children Playing" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            Core Objectives
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Objective 1 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-book-bible text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Biblical Education</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Fun and engaging Bible lessons tailored for different age groups. We use stories, games, and activities to teach children about God's love and biblical principles.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-users mr-2"></i>
                                        <span class="font-medium">Age Groups: 3-5, 6-8, 9-12 years</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 2 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-pray text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Spiritual Formation</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Age-appropriate prayer and worship sessions that help children develop a personal relationship with God. We teach simple prayers, worship songs, and gratitude practices.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-music mr-2"></i>
                                        <span class="font-medium">Children's Worship | Prayer Circles | Devotional Time</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 3 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-heart text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Moral Development</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Teaching Christian values like honesty, kindness, respect, forgiveness, and love through stories, role-playing, and practical examples from daily life.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-star mr-2"></i>
                                        <span class="font-medium">Character Building | Values Education | Life Skills</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Objective 4 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-hands-helping text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Active Participation</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Encouraging children to participate in church and community activities. Children's choir, drama presentations, and service projects suitable for their age.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        <span class="font-medium">Monthly Service Projects | Church Presentations | Community Events</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Activities Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            Key Activities
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Activity 1 -->
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 border border-yellow-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-yellow-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-yellow-800">Bible Classes & Storytelling</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Interactive Bible story sessions for different age groups using visual aids, puppets, and storytelling techniques that make biblical lessons come alive.
                                </p>
                                <div class="text-sm text-yellow-600">
                                    <i class="fas fa-clock mr-1"></i> Sundays 9:00 AM | Age-specific groups
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-6 border border-pink-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-pink-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-music"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-pink-800">Choir, Drama & Arts</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Creative expression through children's choir, biblical drama presentations, arts and crafts projects that reinforce biblical lessons and stories.
                                </p>
                                <div class="text-sm text-pink-600">
                                    <i class="fas fa-clock mr-1"></i> Saturdays 10:00 AM | All ages welcome
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-calendar-star"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-green-800">Annual Events</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Special holiday programs including Easter egg hunts, Christmas pageants, Vacation Bible School (VBS), and children's day celebrations.
                                </p>
                                <div class="text-sm text-green-600">
                                    <i class="fas fa-calendar-alt mr-1"></i> Seasonal events throughout the year
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-blue-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-blue-800">Mentorship & Counseling</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    One-on-one guidance for children facing challenges, plus support for parents on raising children with strong Christian values and character.
                                </p>
                                <div class="text-sm text-blue-600">
                                    <i class="fas fa-handshake mr-1"></i> By appointment | Trained counselors
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Get Involved Form -->
                    <section id="get-involved" class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            Register Your Child
                        </h2>
                        <p class="text-gray-700 mb-6">
                            Enroll your child in our Sunday School program or volunteer to help nurture the next generation in faith.
                        </p>
                        
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="childName">
                                        Child's Name
                                    </label>
                                    <input type="text" id="childName" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                           placeholder="Your child's name">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="childAge">
                                        Child's Age
                                    </label>
                                    <select id="childAge" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
                                        <option value="">Select age group</option>
                                        <option value="3-5">3-5 years (Pre-school)</option>
                                        <option value="6-8">6-8 years (Early Elementary)</option>
                                        <option value="9-12">9-12 years (Upper Elementary)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="parentName">
                                        Parent/Guardian Name
                                    </label>
                                    <input type="text" id="parentName" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                           placeholder="Your name">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="parentEmail">
                                        Parent Email
                                    </label>
                                    <input type="email" id="parentEmail" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                           placeholder="Your email">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-3">
                                    Areas of Interest
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Sunday School Classes</span>
                                    </label>
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Children's Choir</span>
                                    </label>
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Arts & Crafts</span>
                                    </label>
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Vacation Bible School</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="specialNeeds">
                                    Special Needs / Allergies / Notes
                                </label>
                                <textarea id="specialNeeds" rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                          placeholder="Any special considerations we should know about..."></textarea>
                            </div>
                            
                            <div class="flex flex-col md:flex-row gap-4">
                                <button type="submit" 
                                        class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                    <i class="fas fa-child mr-2"></i>
                                    Register Child
                                </button>
                                <button type="button" 
                                        class="px-8 py-3 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                    <i class="fas fa-hands-helping mr-2"></i>
                                    Volunteer to Help
                                </button>
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">
                    
                    <!-- Ministry Leader Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Ministry Coordinator
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-purple-100">
                                    <img src="{{ asset('images/leaders/children-leader.jpg') }}" 
                                         alt="Children's Ministry Leader" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <h4 class="text-lg font-bold text-purple-800">Sis. Sarah Njeri</h4>
                            <p class="text-gray-600 mb-4">Children's Ministry Director</p>
                            <p class="text-gray-700 text-sm mb-4">
                                Sis. Sarah has over 10 years of experience in early childhood education and Christian ministry. She holds a degree in Child Development.
                            </p>
                            <button class="w-full px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition font-medium">
                                <i class="fas fa-envelope mr-2"></i>Contact Coordinator
                            </button>
                        </div>
                    </div>

                    <!-- Schedule Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Sunday School Schedule
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-purple-500 pl-4 py-2">
                                <h4 class="font-bold text-purple-800">Pre-school (3-5 years)</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 10:30 AM</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Room 101 - Noah's Ark Room</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-pink-500 pl-4 py-2">
                                <h4 class="font-bold text-pink-800">Early Elementary (6-8 years)</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 10:30 AM</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Room 102 - David's Den</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-yellow-500 pl-4 py-2">
                                <h4 class="font-bold text-yellow-800">Upper Elementary (9-12 years)</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 10:30 AM</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Room 103 - Daniel's Room</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Quick Info</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-child mr-3 text-purple-200"></i>
                                <span>Children Enrolled: 150+</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-3 text-purple-200"></i>
                                <span>Volunteer Teachers: 25</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-purple-200"></i>
                                <span>Meets: Every Sunday</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-3 text-purple-200"></i>
                                <span>Time: 9:00 AM - 10:30 AM</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Our Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-quote-right text-3xl text-purple-300"></i>
                            </div>
                            <blockquote class="text-lg italic text-gray-700 mb-4">
                                "Train up a child in the way he should go; even when he is old he will not depart from it."
                            </blockquote>
                            <p class="font-semibold text-purple-600">— Proverbs 22:6 (ESV)</p>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Upcoming Events
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl p-4">
                                <h4 class="font-bold text-yellow-800">Vacation Bible School</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>December 26-30, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 12:00 PM</span>
                                </div>
                                <button class="mt-2 px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition">
                                    Register Now
                                </button>
                            </div>
                            
                            <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-xl p-4">
                                <h4 class="font-bold text-red-800">Christmas Pageant</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>December 15, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>6:00 PM</span>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-4">
                                <h4 class="font-bold text-green-800">Easter Egg Hunt</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>March 30, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>10:00 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Safety Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Safety & Security
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-sm text-gray-700">All volunteers background checked</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-sm text-gray-700">Secure check-in/check-out system</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-sm text-gray-700">First aid certified staff</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-sm text-gray-700">Age-appropriate facilities</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border-t border-purple-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-purple-900 mb-6">
                    Ready to Nurture Young Faith?
                </h2>
                <p class="text-gray-600 mb-8 text-lg">
                    Help us shape the next generation of believers through fun, faith-filled learning experiences.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#get-involved" class="inline-flex items-center justify-center px-8 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-child mr-3"></i>
                        Register Your Child
                    </a>
                    <a href="/ministries" class="inline-flex items-center justify-center px-8 py-4 bg-white text-purple-700 hover:text-purple-800 font-semibold rounded-xl shadow-lg hover:shadow-xl border border-purple-200 transition-all duration-200 transform hover:-translate-y-1">
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
    
    /* Animation for children's elements */
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .bounce-once {
        animation: bounce 1s ease-in-out;
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
                if (!data.childName || !data.childAge || !data.parentName || !data.parentEmail) {
                    alert('Please fill in all required fields.');
                    return;
                }
                
                // Here you would typically send the data to your server
                // For now, just show a success message
                alert('Thank you for registering your child! We will contact you soon with more information.');
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
        
        // Add bounce animation to certain elements
        const animatedElements = document.querySelectorAll('.hover\\:scale-105');
        animatedElements.forEach(el => {
            el.addEventListener('mouseenter', function() {
                this.classList.add('bounce-once');
            });
            
            el.addEventListener('animationend', function() {
                this.classList.remove('bounce-once');
            });
        });
    });
</script>
@endsection