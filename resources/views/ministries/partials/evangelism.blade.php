@extends('layouts.app')

@section('title', 'Evangelism & Tree Planting Ministry - Mercer Church')

@section('content')
<div class="min-h-screen bg-green-50 font-sans relative">
    
    <!-- Tree Pattern Background -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute top-20 left-10 text-green-300 text-6xl opacity-30">🌿</div>
        <div class="absolute bottom-20 right-10 text-green-300 text-6xl opacity-30">🌳</div>
        <div class="absolute top-1/3 right-1/4 text-green-300 text-6xl opacity-30">🌲</div>
        <div class="absolute bottom-1/3 left-1/4 text-green-300 text-6xl opacity-30">🍃</div>
    </div>

    <!-- Banner Section -->
    <div class="relative bg-gradient-to-r from-green-700 to-emerald-600 py-20 md:py-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute -right-24 -top-24 w-96 h-96 bg-green-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-emerald-500 rounded-full opacity-20 blur-3xl"></div>
        </div>
        
        <div class="relative container mx-auto px-4 md:px-8">
            <div class="max-w-4xl">
                <div class="mb-6">
                    <a href="/ministries" class="inline-flex items-center text-green-200 hover:text-white font-semibold group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Back to All Ministries
                    </a>
                </div>
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                        <i class="fas fa-seedling text-4xl text-white"></i>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 text-center">
                    Evangelism & Tree Planting Ministry
                </h1>
                <p class="text-xl text-green-100 mb-8 leading-relaxed text-center">
                    Combining holistic evangelism with environmental stewardship to spread the Gospel and care for God's creation
                </p>
                <div class="h-2 w-32 bg-gradient-to-r from-green-300 to-emerald-400 rounded-full mx-auto"></div>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L1440 0V120H0Z" fill="#f0fdf4"/>
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
                        <h2 class="text-3xl font-bold text-green-900 mb-6 pb-4 border-b-2 border-green-100">
                            Our Mission
                        </h2>
                        <p class="text-gray-700 text-lg mb-6">
                            Our Evangelism & Tree Planting Ministry integrates spiritual outreach with environmental stewardship, demonstrating faith in action by spreading the Gospel while caring for God's creation through sustainable tree planting initiatives.
                        </p>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border-l-4 border-green-600">
                            <p class="text-xl font-semibold text-green-800 italic">
                                "Planting seeds of faith and trees of life for a sustainable future in Christ."
                            </p>
                        </div>
                        
                        <!-- Image Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/tree-planting-1.jpg') }}" 
                                     alt="Tree Planting Event" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/ministries/evangelism-outreach.jpg') }}" 
                                     alt="Evangelism Outreach" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                    </section>

                    <!-- Integration Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-green-900 mb-6 pb-4 border-b-2 border-green-100">
                            Why Combine Evangelism and Tree Planting?
                        </h2>
                        <p class="text-gray-700 text-lg mb-6">
                            This ministry integrates spiritual and physical needs, showing faith in action. Planting trees is a symbolic and practical way to demonstrate the "seed of the Gospel" taking root in hearts and communities.
                        </p>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gradient-to-r from-green-100 to-emerald-100">
                                        <th class="p-4 border border-green-300 font-bold text-green-900">Component</th>
                                        <th class="p-4 border border-green-300 font-bold text-green-900">Focus & Theology</th>
                                        <th class="p-4 border border-green-300 font-bold text-green-900">Practical Application</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-green-50 transition-colors">
                                        <td class="p-4 border border-green-300 font-semibold text-green-800">Evangelism</td>
                                        <td class="p-4 border border-green-300 text-gray-700">
                                            Spiritual Life: Proclaiming the Word, teaching Catechism, leading to faith through Christ's salvation
                                        </td>
                                        <td class="p-4 border border-green-300 text-gray-700">
                                            Tree planting events serve as platforms for outreach, discipleship, and community engagement
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-green-50 transition-colors">
                                        <td class="p-4 border border-green-300 font-semibold text-green-800">Tree Planting</td>
                                        <td class="p-4 border border-green-300 text-gray-700">
                                            Creation Stewardship: Caring for God's creation, addressing climate change, soil conservation, and environmental sustainability
                                        </td>
                                        <td class="p-4 border border-green-300 text-gray-700">
                                            Planting indigenous and fruit trees for conservation, income generation, and environmental restoration
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-green-50 transition-colors">
                                        <td class="p-4 border border-green-300 font-semibold text-green-800">Synergy</td>
                                        <td class="p-4 border border-green-300 text-gray-700">
                                            Holistic Witness: Faith expressed in improving life here and now, demonstrating God's love through practical action
                                        </td>
                                        <td class="p-4 border border-green-300 text-gray-700">
                                            Sustainability benefits: food security, shade, rainfall improvement, income sources; symbolizing Gospel seeds growing into faith
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- Operations Section -->
                    <section class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-green-900 mb-6 pb-4 border-b-2 border-green-100">
                            How the Ministry Operates
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Operation 1 -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-church"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-green-800">Congregational Initiative</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Local parishes coordinate planting drives, especially during rainy seasons, involving entire church communities in environmental stewardship.
                                </p>
                                <div class="text-sm text-green-600">
                                    <i class="fas fa-calendar mr-1"></i> Seasonal Planting | Community-wide Participation
                                </div>
                            </div>

                            <!-- Operation 2 -->
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-6 border border-emerald-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-emerald-800">Youth Engagement</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Youth participate for purpose, skills development, and practical faith application, nurturing the next generation of environmental stewards.
                                </p>
                                <div class="text-sm text-emerald-600">
                                    <i class="fas fa-graduation-cap mr-1"></i> Leadership Training | Skill Development
                                </div>
                            </div>

                            <!-- Operation 3 -->
                            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-xl p-6 border border-teal-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-teal-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-teal-800">Partnerships</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Collaborating with Lutheran bodies, NGOs, and environmental organizations for resources, expertise, and large-scale projects.
                                </p>
                                <div class="text-sm text-teal-600">
                                    <i class="fas fa-network-wired mr-1"></i> Resource Sharing | Joint Projects
                                </div>
                            </div>

                            <!-- Operation 4 -->
                            <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border border-cyan-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-cyan-500 text-white rounded-full p-3 mr-4">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-cyan-800">Disaster Response</h3>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Tree planting mitigates flooding, soil erosion, and aids in environmental recovery after natural disasters.
                                </p>
                                <div class="text-sm text-cyan-600">
                                    <i class="fas fa-shield-alt mr-1"></i> Climate Resilience | Environmental Recovery
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Get Involved Form -->
                    <section id="get-involved" class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-green-900 mb-6 pb-4 border-b-2 border-green-100">
                            Join Our Green Mission
                        </h2>
                        <p class="text-gray-700 mb-6">
                            Become part of our dual mission to spread the Gospel and care for God's creation through practical environmental action.
                        </p>
                        
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="fullName">
                                        Full Name
                                    </label>
                                    <input type="text" id="fullName" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                           placeholder="Your name">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="email">
                                        Email Address
                                    </label>
                                    <input type="email" id="email" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                           placeholder="Your email">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="phone">
                                        Phone Number
                                    </label>
                                    <input type="tel" id="phone" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                           placeholder="Your phone number">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2" for="role">
                                        Preferred Role
                                    </label>
                                    <select id="role" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                                        <option value="">Select your interest...</option>
                                        <option value="evangelism">Evangelism/Outreach</option>
                                        <option value="tree_planting">Tree Planting Team</option>
                                        <option value="youth_leader">Youth Group Leader</option>
                                        <option value="community">Community Mobilizer</option>
                                        <option value="both">Both Evangelism & Tree Planting</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-3">
                                    Areas of Interest
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="flex items-center bg-green-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-gray-700">Evangelism Outreach</span>
                                    </label>
                                    <label class="flex items-center bg-green-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-gray-700">Tree Planting Events</span>
                                    </label>
                                    <label class="flex items-center bg-green-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-gray-700">Youth Environmental Clubs</span>
                                    </label>
                                    <label class="flex items-center bg-green-50 p-3 rounded-lg">
                                        <input type="checkbox" class="rounded text-green-600 focus:ring-green-500">
                                        <span class="ml-2 text-gray-700">Disaster Response</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="message">
                                    Why are you interested in joining?
                                </label>
                                <textarea id="message" rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                          placeholder="Share your passion for evangelism and/or environmental care..."></textarea>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <i class="fas fa-seedling mr-2"></i>
                                Join Our Green Mission
                            </button>
                        </form>
                    </section>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-8">
                    
                    <!-- Ministry Leader Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-green-900 mb-4 pb-3 border-b border-green-100">
                            Ministry Coordinator
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-green-100">
                                    <img src="{{ asset('images/leaders/evangelism-leader.jpg') }}" 
                                         alt="Ministry Coordinator" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <h4 class="text-lg font-bold text-green-800">Bro. David Kimutai</h4>
                            <p class="text-gray-600 mb-4">Coordinator, Evangelism & Tree Planting</p>
                            <p class="text-gray-700 text-sm mb-4">
                                Bro. David combines theological training with environmental science expertise, having led community development projects for 8+ years.
                            </p>
                            <button class="w-full px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition font-medium">
                                <i class="fas fa-envelope mr-2"></i>Contact Coordinator
                            </button>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-green-900 mb-4 pb-3 border-b border-green-100">
                            Upcoming Events
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4">
                                <h4 class="font-bold text-green-800">Community Tree Planting</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>November 23, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>8:00 AM - 12:00 PM</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>River Valley Community</span>
                                </div>
                                <button class="mt-2 px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                                    Join Event
                                </button>
                            </div>
                            
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl p-4">
                                <h4 class="font-bold text-emerald-800">Evangelism Training</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>November 30, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>9:00 AM - 3:00 PM</span>
                                </div>
                                <button class="mt-2 px-3 py-1 bg-emerald-600 text-white text-sm rounded hover:bg-emerald-700 transition">
                                    Register Now
                                </button>
                            </div>
                            
                            <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-xl p-4">
                                <h4 class="font-bold text-teal-800">Youth Environmental Camp</h4>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>December 14-15, 2024</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Mountain View Campsite</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Our Impact</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-tree mr-3 text-green-200"></i>
                                <span>Trees Planted: 5,000+</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-3 text-green-200"></i>
                                <span>Active Volunteers: 200+</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-church mr-3 text-green-200"></i>
                                <span>Communities Reached: 25+</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-hand-holding-heart mr-3 text-green-200"></i>
                                <span>Disaster Responses: 12</span>
                            </div>
                        </div>
                    </div>

                    <!-- Theological Foundation -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-green-900 mb-4 pb-3 border-b border-green-100">
                            Theological Foundation
                        </h3>
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-bible text-3xl text-green-300"></i>
                            </div>
                            <p class="text-gray-700 mb-4 text-sm">
                                Rooted in the Lutheran understanding of the "Two Kingdoms" and vocation, caring for creation is an expression of Christian love and service to both God and neighbor.
                            </p>
                            <blockquote class="text-lg italic text-gray-700 mb-4">
                                "The earth is the Lord's, and everything in it."
                            </blockquote>
                            <p class="font-semibold text-green-600">— Psalm 24:1 (ESV)</p>
                        </div>
                    </div>

                    <!-- Tree Species -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-green-900 mb-4 pb-3 border-b border-green-100">
                            Tree Species We Plant
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-leaf text-green-500 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Indigenous Trees</h4>
                                    <p class="text-xs text-gray-600">Acacia, Olive, Cedar for ecosystem restoration</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-apple-alt text-red-400 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Fruit Trees</h4>
                                    <p class="text-xs text-gray-600">Mango, Avocado, Orange for food security</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-blue-400 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-gray-800">Conservation Trees</h4>
                                    <p class="text-xs text-gray-600">Bamboo, Eucalyptus for soil protection</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Preview -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-green-900 mb-4 pb-3 border-b border-green-100">
                            Gallery
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/tree-planting-community.jpg') }}" 
                                     alt="Community Planting" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/evangelism-training.jpg') }}" 
                                     alt="Evangelism Training" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/youth-planting.jpg') }}" 
                                     alt="Youth Planting" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="rounded-lg overflow-hidden">
                                <img src="{{ asset('images/ministries/fruit-tree-harvest.jpg') }}" 
                                     alt="Fruit Harvest" 
                                     class="w-full h-32 object-cover hover:scale-110 transition-transform duration-300">
                            </div>
                        </div>
                        <button class="w-full mt-4 px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 transition font-medium">
                            <i class="fas fa-images mr-2"></i>View Full Gallery
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-t border-green-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <div class="mb-6">
                    <i class="fas fa-hands-praying text-5xl text-green-600 mb-4"></i>
                    <h2 class="text-3xl md:text-4xl font-bold text-green-900 mb-6">
                        Plant Faith, Grow Hope, Harvest Love
                    </h2>
                </div>
                <p class="text-gray-600 mb-8 text-lg">
                    Join us in this unique ministry that combines spiritual transformation with environmental restoration. Together, we can make a lasting impact for Christ and creation.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#get-involved" class="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-seedling mr-3"></i>
                        Join Our Mission
                    </a>
                    <a href="/ministries" class="inline-flex items-center justify-center px-8 py-4 bg-white text-green-700 hover:text-green-800 font-semibold rounded-xl shadow-lg hover:shadow-xl border border-green-200 transition-all duration-200 transform hover:-translate-y-1">
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
    
    /* Growth animation for tree elements */
    @keyframes grow {
        0% { transform: scale(0.9); }
        100% { transform: scale(1); }
    }
    
    .growth-animation {
        animation: grow 0.5s ease-out;
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
                alert('Thank you for your interest in our Evangelism & Tree Planting Ministry! We will contact you soon about upcoming events.');
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
        
        // Add growth animation to tree-related images
        const treeImages = document.querySelectorAll('img[alt*="tree"], img[alt*="plant"]');
        treeImages.forEach(img => {
            img.addEventListener('mouseenter', function() {
                this.classList.add('growth-animation');
            });
            
            img.addEventListener('animationend', function() {
                this.classList.remove('growth-animation');
            });
        });
    });
</script>
@endsection