@extends('layouts.app')

@section('title', 'Choir & Music Ministry - Mercer Church')

@section('content')
<div class="min-h-screen bg-gray-50 font-sans relative">
    
    <!-- Music Notes Background -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute top-10 right-10 text-blue-300 text-6xl opacity-30">♪</div>
        <div class="absolute bottom-20 left-10 text-purple-300 text-6xl opacity-30">♫</div>
        <div class="absolute top-1/2 left-1/4 text-pink-300 text-6xl opacity-30">♬</div>
        <div class="absolute bottom-10 right-1/3 text-indigo-300 text-6xl opacity-30">𝄞</div>
    </div>

    <!-- Banner Section -->
    <div class="relative bg-gradient-to-r from-purple-800 to-indigo-700 py-20 md:py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute -right-24 -top-24 w-96 h-96 bg-purple-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-indigo-500 rounded-full opacity-20 blur-3xl"></div>
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
                        <i class="fas fa-music text-4xl text-white"></i>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-center">
                    Music & Choir Ministry
                </h1>
                <p class="text-xl text-purple-100 mb-8 leading-relaxed text-center">
                    Enhancing worship, expressing faith, and evangelizing through music and choirs
                </p>
                <div class="h-2 w-32 bg-gradient-to-r from-purple-300 to-indigo-400 rounded-full mx-auto"></div>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L1440 0V120H0Z" fill="#f9fafb"/>
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
                            Our Music & Choir Ministry is dedicated to leading God's people in worship through music, song, and creative arts. We believe that music is a powerful tool for spiritual expression, evangelism, and community building in the Evangelical Lutheran Church in Kenya.
                        </p>
                        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-6 border-l-4 border-purple-600">
                            <p class="text-xl font-semibold text-purple-800 italic">
                                "To enhance worship experiences, express theological truths through music, and spread the Gospel through choral performances and recordings."
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/choir-performance.jpg') }}" 
                                     alt="Choir Performance" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/choir-rehearsal.jpg') }}" 
                                     alt="Choir Rehearsal" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- What We Do Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            The Role of Our Choirs
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Role 1 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-church text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Enhancement of Worship</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Leading congregational singing and providing special music for worship services. Our choirs contextualize services with powerful musical expressions that uplift and inspire.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <span class="font-medium">Every Sunday Service | Special Holiday Programs</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Role 2 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-book-bible text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Theological Expression</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Conveying gospel messages through music in local languages. Our songs teach biblical truths and help worshippers engage with Scripture on a deeper emotional level.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-music mr-2"></i>
                                        <span class="font-medium">Traditional & Contemporary Christian Music</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Role 3 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-bullhorn text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Evangelism & Outreach</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Performing at community events, weddings, and funerals. Recording albums and participating in radio programs to spread the Gospel beyond our church walls.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-microphone-alt mr-2"></i>
                                        <span class="font-medium">Community Concerts | Radio Broadcasts | Album Recordings</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Role 4 -->
                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                <div class="md:w-1/4">
                                    <div class="bg-purple-100 text-purple-800 rounded-xl p-4 text-center">
                                        <i class="fas fa-users text-3xl mb-3"></i>
                                        <h4 class="font-bold text-lg">Community & Unity</h4>
                                    </div>
                                </div>
                                <div class="md:w-3/4">
                                    <p class="text-gray-700">
                                        Fostering fellowship among members across different age groups and backgrounds. Our choir ministry builds strong relationships and creates a sense of family.
                                    </p>
                                    <div class="mt-3 flex items-center text-purple-600">
                                        <i class="fas fa-heart mr-2"></i>
                                        <span class="font-medium">Multi-generational Participation | Fellowship Events</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Structure Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            Structure and Notable Choirs
                        </h2>
                        
                        <div class="space-y-8">
                            <!-- Congregational Choirs -->
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6">
                                <h3 class="text-xl font-bold text-purple-800 mb-4 flex items-center">
                                    <i class="fas fa-users mr-3"></i>
                                    Congregational Choirs
                                </h3>
                                <p class="text-gray-700 mb-4">
                                    Senior, Youth, and Sunday School Choirs lead weekly worship services and special programs.
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <h4 class="font-bold text-purple-700 mb-2">ELCK Evangelical Choir Itierio</h4>
                                        <p class="text-sm text-gray-600">Senior choir specializing in traditional hymns</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <h4 class="font-bold text-purple-700 mb-2">ELCK MBARA INJILI CHOIR</h4>
                                        <p class="text-sm text-gray-600">Youth choir focusing on contemporary worship</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <h4 class="font-bold text-purple-700 mb-2">ELCK Springs of Life</h4>
                                        <p class="text-sm text-gray-600">Children's choir for ages 6-12</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <h4 class="font-bold text-purple-700 mb-2">Praise & Worship Team</h4>
                                        <p class="text-sm text-gray-600">Band and vocalists for contemporary services</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Diocesan/Regional Choirs -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                                <h3 class="text-xl font-bold text-indigo-800 mb-4 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-3"></i>
                                    Diocesan/Regional Choirs
                                </h3>
                                <p class="text-gray-700 mb-4">
                                    Larger ensembles assembled for special diocesan events, conferences, and recording projects.
                                </p>
                                <div class="flex items-center text-indigo-600">
                                    <i class="fas fa-calendar-star mr-2"></i>
                                    <span class="font-medium">Performs at: Diocesan Conferences | Ordinations | Special Celebrations</span>
                                </div>
                            </div>

                            <!-- National Choir -->
                            <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-6">
                                <h3 class="text-xl font-bold text-red-800 mb-4 flex items-center">
                                    <i class="fas fa-flag mr-3"></i>
                                    National Choir
                                </h3>
                                <p class="text-gray-700 mb-4">
                                    Elite vocalists mobilized for major national events, conventions, and international church gatherings.
                                </p>
                                <div class="flex items-center text-red-600">
                                    <i class="fas fa-globe mr-2"></i>
                                    <span class="font-medium">Represents ELCK at national and international events</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Get Involved Form -->
                    <section id="get-involved" class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-purple-900 mb-6 pb-4 border-b-2 border-purple-100">
                            Join Our Music Ministry
                        </h2>
                        <p class="text-gray-700 mb-6">
                            Interested in sharing your musical gifts? Whether you sing or play an instrument, there's a place for you in our music ministry.
                        </p>
                        
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="fullName">
                                        Full Name
                                    </label>
                                    <input type="text" id="fullName" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                           placeholder="Your name">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="email">
                                        Email Address
                                    </label>
                                    <input type="email" id="email" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                           placeholder="Your email">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="phone">
                                        Phone Number
                                    </label>
                                    <input type="tel" id="phone" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                           placeholder="Your phone number">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="voicePart">
                                        Voice Part / Instrument
                                    </label>
                                    <select id="voicePart" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
                                        <option value="">Select your area...</option>
                                        <option value="soprano">Soprano</option>
                                        <option value="alto">Alto</option>
                                        <option value="tenor">Tenor</option>
                                        <option value="bass">Bass</option>
                                        <option value="piano">Piano/Keyboard</option>
                                        <option value="guitar">Guitar</option>
                                        <option value="drums">Drums</option>
                                        <option value="other">Other Instrument</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-3">
                                    I'm interested in...
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Adult Choir</span>
                                    </label>
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Youth Choir</span>
                                    </label>
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Praise Band</span>
                                    </label>
                                    <label class="flex items-center bg-purple-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-gray-700">Sound/Technical Team</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="message">
                                    Musical Experience / Message
                                </label>
                                <textarea id="message" rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition"
                                          placeholder="Tell us about your musical background or any message..."></textarea>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Submit Application
                            </button>
                        </form>
                    </section>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">
                    
                    <!-- Ministry Leader Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Music Director
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-purple-100">
                                    <img src="{{ asset('images/leaders/choir-director.jpg') }}" 
                                         alt="Music Director" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <h4 class="text-lg font-bold text-purple-800">Sis. Grace Mwangi</h4>
                            <p class="text-gray-600 mb-4">Director of Music Ministries</p>
                            <p class="text-gray-700 text-sm mb-4">
                                Sis. Grace holds a degree in Music Education and has directed church choirs for over 15 years. She specializes in vocal training and choral arrangement.
                            </p>
                            <button class="w-full px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition font-medium">
                                <i class="fas fa-envelope mr-2"></i>Contact Director
                            </button>
                        </div>
                    </div>

                    <!-- Rehearsal Schedule -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Rehearsal Schedule
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-purple-500 pl-4 py-2">
                                <h4 class="font-bold text-purple-800">Adult Choir</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Every Wednesday</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>6:00 PM - 8:00 PM</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-pink-500 pl-4 py-2">
                                <h4 class="font-bold text-pink-800">Youth Choir</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Every Friday</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>4:00 PM - 6:00 PM</span>
                                </div>
                            </div>
                            
                            <div class="border-l-4 border-indigo-500 pl-4 py-2">
                                <h4 class="font-bold text-indigo-800">Praise Band</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Every Saturday</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>10:00 AM - 12:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Quick Info</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-3 text-purple-200"></i>
                                <span>Total Members: 120+</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-microphone-alt mr-3 text-purple-200"></i>
                                <span>4 Choir Groups</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-guitar mr-3 text-purple-200"></i>
                                <span>Praise Band: 8 Members</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-compact-disc mr-3 text-purple-200"></i>
                                <span>Albums Recorded: 3</span>
                            </div>
                        </div>
                    </div>

                    <!-- Scripture Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Key Scripture
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-quote-right text-3xl text-purple-300"></i>
                            </div>
                            <blockquote class="text-lg italic text-gray-700 mb-4">
                                "Let everything that has breath praise the Lord!"
                            </blockquote>
                            <p class="font-semibold text-purple-600">— Psalm 150:6 (ESV)</p>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Upcoming Events
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-4">
                                <h4 class="font-bold text-purple-800">Christmas Cantata</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>December 15, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>7:00 PM</span>
                                </div>
                                <button class="mt-2 px-3 py-1 bg-purple-600 text-white text-sm rounded hover:bg-purple-700 transition">
                                    Reserve Seat
                                </button>
                            </div>
                            
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4">
                                <h4 class="font-bold text-indigo-800">Choir Workshop</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>November 23, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 3:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Preview -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-purple-900 mb-4 pb-3 border-b border-purple-100">
                            Gallery
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/choir-concert.jpg') }}" 
                                     alt="Choir Concert" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/band-rehearsal.jpg') }}" 
                                     alt="Band Rehearsal" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/choir-recording.jpg') }}" 
                                     alt="Recording Session" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/choir-fellowship.jpg') }}" 
                                     alt="Choir Fellowship" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                        </div>
                        <button class="w-full mt-4 px-4 py-2 border border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition font-medium">
                            <i class="fas fa-images mr-2"></i>View Full Gallery
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-t border-purple-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-purple-900 mb-6">
                    Ready to Make a Joyful Noise?
                </h2>
                <p class="text-gray-600 mb-8 text-lg">
                    Your musical gifts can be a powerful tool for worship and evangelism. Join us in praising God through music!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#get-involved" class="inline-flex items-center justify-center px-8 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-music mr-3"></i>
                        Join Our Choir
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
    
    /* Music note animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .music-note {
        animation: float 3s ease-in-out infinite;
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
                if (!data.fullName || !data.email) {
                    alert('Please fill in all required fields.');
                    return;
                }
                
                // Here you would typically send the data to your server
                // For now, just show a success message
                alert('Thank you for your interest in our Music & Choir Ministry! We will contact you soon for an audition.');
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