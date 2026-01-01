@extends('layouts.app')

@section('title', 'Our Ministries')

@section('content')
<div class="min-h-screen">

    <!-- Banner Section -->
   <!-- ================================
 BANNER SECTION – OUR MINISTRIES
================================ -->
<div class="relative py-28 bg-[#197b3b] overflow-hidden">
    <!-- Background illustration image -->
    <div class="absolute inset-0">
        <img
            src="{{ asset('images/banners/ministries-banner.jpg') }}"
            alt="Our Ministries"
            class="w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- Content -->
    <div class="relative container mx-auto px-6 text-center max-w-4xl">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
            Our Ministries
        </h1>

        <p class="text-lg md:text-xl text-emerald-100 mb-10 leading-relaxed">
            Serving God, Serving People. Explore the diverse ways the ELCK
            Southern Lake Diocese is working to transform lives and
            communities through faith and action.
        </p>

        <a href="#ministries-grid"
           class="inline-flex items-center justify-center px-8 py-4
                  bg-green-600 hover:bg-green-700 text-white font-semibold
                  rounded-xl shadow-lg transition-all duration-200
                  transform hover:-translate-y-1">
            Get Involved
        </a>
    </div>
</div>

<!--Bible verse-->
<section class="bg-white py-12">
    <div class="container mx-auto px-6 text-center max-w-3xl">
        <div class="inline-flex items-center justify-center mb-4">
            <span class="w-12 h-1 bg-[#197b3b] rounded-full"></span>
        </div>

        <p class="text-lg md:text-xl font-semibold text-gray-800 leading-relaxed mb-3">
            “For even the Son of Man came not to be served but 
            to serve,and to give his life as ransom for many.”
        </p>

        <p class="text-[#197b3b] font-bold tracking-wide">
            — Mark 10:45
        </p>
    </div>

    <!-- Ministry Filter Tabs -->
    <div class="sticky top-0 z-10 bg-white shadow-lg shadow-emerald-50/50 border-b border-emerald-100">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-wrap gap-2 md:gap-4 py-4">
                <button class="filter-btn px-6 py-3 rounded-xl font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 active-tab" 
                        data-filter="all">
                    All Ministries
                </button>
                @foreach(['Youth', 'Women', 'Men', 'Children', 'Worship', 'Outreach',  'Evangelism'] as $ministry)
                <button class="filter-btn px-6 py-3 rounded-xl font-semibold text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200" 
                        data-filter="{{ strtolower($ministry) }}">
                    {{ $ministry }} Ministry
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Ministries Grid -->
    <div class="container mx-auto px-4 md:px-8 py-12">
        <div id="ministries-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Youth Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="youth">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/youth-ministry.jpg') }}" 
                         alt="Youth Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-emerald-700 font-semibold shadow-lg">
                            Youth Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/youth-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-emerald-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Youth Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Empowering the next generation with faith, fellowship, and purpose. Our youth ministry focuses on spiritual growth through engaging activities, Bible studies, and community service.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-users text-emerald-500 mr-2"></i>
                        <span class="text-sm">Ages 13-25</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-calendar text-emerald-500 mr-2"></i>
                        <span class="text-sm">Fridays 6 PM</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'youth') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Women's Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="women">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/womens-ministry.jpg') }}" 
                         alt="Women's Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-rose-700 font-semibold shadow-lg">
                            Women's Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/womens-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-rose-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Women's Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        A sisterhood dedicated to supporting women in their spiritual journey through Bible studies, prayer groups, and fellowship events that nurture faith and friendship.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-hands-praying text-rose-500 mr-2"></i>
                        <span class="text-sm">Prayer Meetings</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-book text-rose-500 mr-2"></i>
                        <span class="text-sm">Weekly Studies</span>
                    </div>
                    <a href="{{ route('ministries.partials','women') }}" class="inline-flex items-center text-rose-600 hover:text-rose-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Worship Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="worship">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/worship-and-liturgy-ministry.jpg') }}" 
                         alt="Worship Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-purple-700 font-semibold shadow-lg">
                            Worship Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/worship-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-purple-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Worship Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Leading the congregation in worship through music, song, and creative arts. Our team helps create an atmosphere where people can connect with God through praise.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-music text-purple-500 mr-2"></i>
                        <span class="text-sm">Choir & Band</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-microphone text-purple-500 mr-2"></i>
                        <span class="text-sm">Sound Team</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'choir') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Outreach Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="outreach">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/orphan-and-vulnerable-children-programs.jpg') }}" 
                         alt="Outreach Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-orange-700 font-semibold shadow-lg">
                            Outreach Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/outreach-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-orange-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Outreach Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Serving our community through practical acts of love and compassion. Food drives, neighborhood cleanups, and support programs to show God's love in action.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-hands-helping text-orange-500 mr-2"></i>
                        <span class="text-sm">Community Service</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-heart text-orange-500 mr-2"></i>
                        <span class="text-sm">Missions</span>
                    </div>
                    <a href="{{ route('ministries.partials','ovc') }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Children's Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="children">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/childrens-ministry.jpg') }}" 
                         alt="Children's Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-blue-700 font-semibold shadow-lg">
                            Children's Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/childrens-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Children's Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Nurturing young hearts with age-appropriate Bible lessons, fun activities, and foundational teachings to help children grow in their relationship with God.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-child text-blue-500 mr-2"></i>
                        <span class="text-sm">Ages 3-12</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-gamepad text-blue-500 mr-2"></i>
                        <span class="text-sm">Fun Activities</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'sunday') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>


            <!-- Evangelism Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="evangelism">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/evangelism-and-tree-planting-ministry.jpg') }}" 
                         alt="Evangelism Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-orange-700 font-semibold shadow-lg">
                            Evangelism Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/evangelism-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-orange-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Evangelism Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Spreading the Gospel message to our community and beyond. Through street evangelism, door-to-door outreach, and evangelistic events, we share God's love with everyone.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-cross text-orange-500 mr-2"></i>
                        <span class="text-sm">Street Outreach</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-bible text-orange-500 mr-2"></i>
                        <span class="text-sm">Gospel Sharing</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'evangelism') }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- HIV Drive Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="hiv_drive">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/hiv-and-aids-ministry.jpg') }}" 
                         alt="HIV Drive Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-red-700 font-semibold shadow-lg">
                            HIV Drive
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/hiv-drive.jpg')))
                    <div class="absolute top-4 right-4 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">HIV Drive Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Providing education, testing, and support for HIV prevention and care. We work to reduce stigma and provide resources for those affected by HIV/AIDS in our community.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-heartbeat text-red-500 mr-2"></i>
                        <span class="text-sm">Free Testing</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-hand-holding-medical text-red-500 mr-2"></i>
                        <span class="text-sm">Support Groups</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'hiv') }}" class="inline-flex items-center text-red-600 hover:text-red-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Malaria Drive Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="malaria_drive">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/malaria1.jpg') }}" 
                         alt="Malaria Drive Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-amber-700 font-semibold shadow-lg">
                            Malaria Drive
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/malaria-drive.jpg')))
                    <div class="absolute top-4 right-4 bg-amber-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Malaria Drive Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Fighting malaria through education, prevention, and treatment. We distribute mosquito nets, provide education on prevention, and support treatment for affected families.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-bug text-amber-500 mr-2"></i>
                        <span class="text-sm">Net Distribution</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-stethoscope text-amber-500 mr-2"></i>
                        <span class="text-sm">Treatment Support</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'malaria') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Relief Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="relief">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/relief-and-development-ministry.jpg') }}" 
                         alt="Relief Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-teal-700 font-semibold shadow-lg">
                            Relief Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/relief-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-teal-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Relief Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Providing emergency assistance and disaster relief to those in need. We offer food, clothing, shelter, and support during crises and challenging times.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-hands-helping text-teal-500 mr-2"></i>
                        <span class="text-sm">Emergency Response</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-home text-teal-500 mr-2"></i>
                        <span class="text-sm">Shelter Support</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'relief') }}" class="inline-flex items-center text-teal-600 hover:text-teal-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Clergy Training Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="clergy_training">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/ministries/clergy-and-lay-leader-training.jpg') }}" 
                         alt="Clergy Training Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-indigo-700 font-semibold shadow-lg">
                            Clergy Training
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/clergy-training.jpg')))
                    <div class="absolute top-4 right-4 bg-indigo-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Clergy Training Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Equipping and training church leaders for effective ministry. Through seminars, mentorship programs, and theological education, we develop strong spiritual leaders.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-graduation-cap text-indigo-500 mr-2"></i>
                        <span class="text-sm">Leadership Training</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-book-bible text-indigo-500 mr-2"></i>
                        <span class="text-sm">Theological Studies</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'training') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Men's Ministry Example -->
            <div class="ministry-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl" 
                 data-category="men">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/gallery/mens-ministry.jpg') }}" 
                         alt="Men's Ministry"
                         class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-block px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-indigo-700 font-semibold shadow-lg">
                            Men's Ministry
                        </span>
                    </div>
                    @if(file_exists(public_path('images/gallery/mens-ministry.jpg')))
                    <div class="absolute top-4 right-4 bg-indigo-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Men's Ministry</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Strengthening men in their faith journey through fellowship, accountability, and service. Building godly character and leadership in homes, church, and community.
                    </p>
                    <div class="flex items-center text-gray-500 mb-6">
                        <i class="fas fa-users text-indigo-500 mr-2"></i>
                        <span class="text-sm">Saturday Mornings</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-dumbbell text-indigo-500 mr-2"></i>
                        <span class="text-sm">Men's Fellowship</span>
                    </div>
                    <a href="{{ route('ministries.partials', 'men') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold group">
                        Learn More
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- No Results Message -->
        <div id="no-results" class="hidden text-center py-16">
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-12 border-2 border-dashed border-emerald-200">
                <i class="fas fa-search text-emerald-300 text-6xl mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-700 mb-3">No Ministries Found</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                    We couldn't find any ministries matching your selection. Try choosing a different category.
                </p>
                <button class="filter-btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold rounded-lg shadow-lg transition-all duration-200"
                        data-filter="all">
                    Show All Ministries
                </button>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-t border-emerald-100 py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                    Want to Join a Ministry?
                </h2>
                <p class="text-gray-600 mb-8 text-lg">
                    There's a place for everyone to serve and grow. Connect with us to find the ministry that fits your gifts and passions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-[#197b3b] to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-user-plus mr-3"></i>
                        Join a Ministry Team
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-700 hover:text-emerald-800 font-semibold rounded-xl shadow-lg hover:shadow-xl border border-emerald-200 transition-all duration-200 transform hover:-translate-y-1">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        View Event Calendar
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .active-tab {
        background: linear-gradient(135deg, #197b3b, #22c55e);
        color: white;
        box-shadow: 0 4px 12px rgba(25, 123, 59, 0.2);
    }

    .ministry-card {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .ministry-card.hidden {
        opacity: 0;
        transform: translateY(20px);
        pointer-events: none;
        position: absolute;
        visibility: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const ministryCards = document.querySelectorAll('.ministry-card');
        const noResults = document.getElementById('no-results');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active-tab');
                    btn.classList.remove('bg-emerald-100');
                    btn.classList.remove('text-emerald-700');
                });
                
                this.classList.add('active-tab');
                this.classList.add('bg-emerald-100');
                this.classList.add('text-emerald-700');
                
                // Get filter value
                const filterValue = this.getAttribute('data-filter');
                
                // Filter cards
                let visibleCount = 0;
                ministryCards.forEach(card => {
                    if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });
                
                // Show/hide no results message
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
                
                // Smooth scroll to top of grid
                document.getElementById('ministries-grid').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
        
        // Add hover effects to all filter buttons except active one
        filterButtons.forEach(button => {
            if (!button.classList.contains('active-tab')) {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'transform 0.2s ease';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }
        });
    });
</script>
@endsection