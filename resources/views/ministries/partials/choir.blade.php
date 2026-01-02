@extends('layouts.app')

@php
use App\Models\Ministry;

$isMember = $isMember ?? false;
$upcomingEvents = $upcomingEvents ?? collect();
$userEmail = $userEmail ?? null;
$ministry = $ministry ?? null;

if (!$ministry) {
    $ministry = Ministry::where('slug', 'ovc-ministry')->first();
}
@endphp

@section('title', 'OVC Ministry - Mercer Church')

@section('content')
<div class="min-h-screen bg-gray-50 font-sans relative">

    <!-- Banner Section -->
    <div class="relative bg-gradient-to-r from-yellow-700 to-orange-600 py-20 md:py-24">
        <div class="relative container mx-auto px-4 md:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-6">
                    <a href="/ministries" class="inline-flex items-center text-yellow-200 hover:text-white font-semibold group">
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
                    OVC Ministry
                </h1>
                <p class="text-xl text-yellow-100 mb-8 leading-relaxed text-center">
                    Supporting, mentoring, and providing care for orphans and vulnerable children.
                </p>
                <div class="h-2 w-32 bg-gradient-to-r from-yellow-300 to-orange-400 rounded-full mx-auto"></div>
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
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Mission Section -->
                <section class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-yellow-900 mb-6 pb-4 border-b-2 border-yellow-100">Our Mission</h2>
                    <p class="text-gray-700 text-lg mb-6">
                        The OVC Ministry is dedicated to providing holistic care, mentorship, and support to orphans and vulnerable children. We aim to empower children to achieve their full potential spiritually, emotionally, and academically.
                    </p>
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-6 border-l-4 border-yellow-600">
                        <p class="text-xl font-semibold text-yellow-800 italic">
                            "To nurture, educate, and guide children with love and dedication, giving them hope and opportunities for a better future."
                        </p>
                    </div>
                </section>

                <!-- What We Do Section -->
                <section class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-yellow-900 mb-6 pb-4 border-b-2 border-yellow-100">Our Roles</h2>
                    <div class="space-y-6">

                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            <div class="md:w-1/4">
                                <div class="bg-yellow-100 text-yellow-800 rounded-xl p-4 text-center">
                                    <i class="fas fa-hand-holding-heart text-3xl mb-3"></i>
                                    <h4 class="font-bold text-lg">Care & Support</h4>
                                </div>
                            </div>
                            <div class="md:w-3/4">
                                <p class="text-gray-700">Providing basic needs, counseling, mentorship, and safe environments for children to thrive.</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            <div class="md:w-1/4">
                                <div class="bg-yellow-100 text-yellow-800 rounded-xl p-4 text-center">
                                    <i class="fas fa-book-reader text-3xl mb-3"></i>
                                    <h4 class="font-bold text-lg">Education & Mentorship</h4>
                                </div>
                            </div>
                            <div class="md:w-3/4">
                                <p class="text-gray-700">Supporting academic growth through scholarships, tutoring, and mentorship programs.</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            <div class="md:w-1/4">
                                <div class="bg-yellow-100 text-yellow-800 rounded-xl p-4 text-center">
                                    <i class="fas fa-hands-helping text-3xl mb-3"></i>
                                    <h4 class="font-bold text-lg">Community Engagement</h4>
                                </div>
                            </div>
                            <div class="md:w-3/4">
                                <p class="text-gray-700">Collaborating with families, churches, and organizations to create a supportive network for children.</p>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Join Form -->
                @if(!$isMember)
                <section id="join" class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-yellow-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-yellow-100">
                        Join OVC Ministry
                    </h2>
                    <p class="text-gray-700 text-base md:text-lg mb-6">
                        Volunteer your time, mentorship, or resources to support vulnerable children.
                    </p>
                    <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="first_name">First Name *</label>
                                <input type="text" id="first_name" name="first_name" required
                                       class="input w-full px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="last_name">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" required
                                       class="input w-full px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="input w-full px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="role">Role (Optional)</label>
                            <input type="text" id="role" name="role" placeholder="Mentor, Volunteer, Sponsor" 
                                   class="input w-full px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>
                        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-orange-700 transition shadow-lg flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Join OVC Ministry
                        </button>
                    </form>
                </section>
                @endif
            </div>

            <!-- Right Column Sidebar -->
            <div class="space-y-8">

                <!-- Ministry Leader Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-yellow-900 mb-4 pb-3 border-b border-yellow-100">
                        OVC Ministry Leader
                    </h3>
                    <div class="text-center">
                        <div class="mb-4">
                            <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 border-yellow-100">
                                @if($ministry && $ministry->leader_image)
                                    @if(Str::startsWith($ministry->leader_image, ['http://','https://']))
                                        <img src="{{ $ministry->leader_image }}" alt="{{ $ministry->leader_name ?? 'OVC Leader' }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $ministry->leader_image) }}" alt="{{ $ministry->leader_name ?? 'OVC Leader' }}" class="w-full h-full object-cover">
                                    @endif
                                @else
                                    <div class="w-full h-full bg-gradient-to-r from-yellow-100 to-orange-100 flex items-center justify-center">
                                        <i class="fas fa-user text-3xl md:text-4xl text-yellow-400"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h4 class="text-base md:text-lg font-bold text-yellow-800">{{ $ministry?->leader_name ?? 'OVC Leader' }}</h4>
                        <p class="text-gray-600 mb-4">Director of OVC Ministry</p>
                        <button class="w-full px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition font-medium">
                            <i class="fas fa-envelope mr-2"></i> Contact Leader
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
