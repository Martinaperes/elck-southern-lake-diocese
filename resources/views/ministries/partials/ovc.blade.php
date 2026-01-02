@extends('layouts.app')

@php
    use App\Models\Ministry;

    // Safety defaults
    $isMember = $isMember ?? false;
    $upcomingEvents = $upcomingEvents ?? collect();
    $userEmail = $userEmail ?? null;
    $ministry = $ministry ?? null;

    if (!$ministry) {
        $ministry = Ministry::where('slug', 'orphan-and-vulnerable-children-programs')->first();
    }
@endphp

@section('title', 'OVC Ministry - ' . config('app.name'))

@section('content')
<section class="py-12 bg-green-50 font-sans">
    <div class="container mx-auto px-4 md:px-8 space-y-12">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-green-700 mb-3">🏡 OVC Ministry – ELCK</h2>
            <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
                Caring for Orphans and Vulnerable Children with love, education, and holistic development.
            </p>
        </div>

        {{-- Projects --}}
        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition duration-500 flex flex-col md:flex-row items-center gap-6">
            <img src="{{ asset('images/ministries/ovc-project24.jpg') }}" alt="Project 24" class="w-full md:w-1/3 rounded-xl shadow-lg">
            <div class="md:w-2/3">
                <h3 class="text-3xl font-bold text-green-600 mb-4">1️⃣ Project 24 / Christ's Care for Children: Kenya</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Provides safe residential care through boarding facilities across Kenya.</li>
                    <li>Ensures holistic development: education, basic needs, spiritual nurturing.</li>
                    <li>Practical life skills training including farming, cooking, and maintenance.</li>
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition duration-500 flex flex-col md:flex-row-reverse items-center gap-6">
            <img src="{{ asset('images/ministries/ovc-pangani.jpeg') }}" alt="Pangani Lutheran Children Centre" class="w-full md:w-1/3 rounded-xl shadow-lg">
            <div class="md:w-2/3">
                <h3 class="text-3xl font-bold text-green-600 mb-4">2️⃣ Pangani Lutheran Children Centre (PLCC)</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Rescue and rehabilitation of girls living on the streets.</li>
                    <li>Christian education and life skills for reintegration.</li>
                    <li>Family reunification or long-term accommodation for those in need.</li>
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition duration-500 flex flex-col md:flex-row items-center gap-6">
            <img src="{{ asset('images/ministries/ovc-community.jpg') }}" alt="Community Support" class="w-full md:w-1/3 rounded-xl shadow-lg">
            <div class="md:w-2/3">
                <h3 class="text-3xl font-bold text-green-600 mb-4">3️⃣ Community-Based Support (Local Congregations)</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Mobilizing congregations to support OVC households, especially with ill caregivers.</li>
                    <li>Education subsidies, nutritional programs, and income-generating initiatives.</li>
                    <li>Counseling and mentorship for coping with trauma and HIV/AIDS impact.</li>
                </ul>
            </div>
        </div>

        {{-- Accordions --}}
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition duration-500">
            <h3 class="text-3xl font-bold text-green-600 mb-4">🌟 Holistic Care Areas</h3>

            @php
                $accordionItems = [
                    'spiritual' => 'The Evangelical Lutheran Church Southern-lake diocese fosters spiritual growth by integrating rigorous sacramental teaching with practical community support and leadership training. Through local parishes and specialized ministries like the Women’s Work Centers, the church ensures that the Gospel is both preached and lived out in daily life. This holistic approach empowers believers to deepen their faith while simultaneously addressing the physical and social needs of their neighbors.',
                    'educational' => 'The Evangelical Lutheran Church of Kenya- Southern lake Diocese provides extensive educational support by operating a network of primary and secondary schools that prioritize access for vulnerable children and orphans. Through initiatives like Project 24, the church offers full sponsorships and boarding facilities that ensure students receive both academic instruction and essential life skills training. Additionally, the church invests in higher education and specialized vocational centers to empower people with disabilities and train the next generation of community leaders.',
                    'physical' => 'The Evangelical Lutheran Church of Kenya- Southern lake Diocese provides essential physical and nutritional care by operating several health dispensaries and community clinics that offer affordable medical services and maternal care. Through its specialized schools and Project 24 boarding sites, the church ensures that vulnerable children receive consistent, balanced meals to support their physical development and academic focus. Additionally, the church’s "Diakonia" departments lead emergency relief efforts, distributing food and clean water to families affected by droughts or floods to ensure survival and long-term health.',
                    'socioeconomic' => 'The Evangelical Lutheran Church of Kenya- Southern lake Diocese promotes socio-economic empowerment by establishing micro-savings groups and vocational training programs that provide members with the capital and skills needed for financial independence. By teaching sustainable agricultural practices and providing livestock to rural families, the church helps communities build resilient livelihoods that can withstand economic and environmental shocks. Furthermore, through targeted advocacy against harmful cultural practices and support for women’s enterprises, the ELCK ensures that social dignity and economic opportunity are accessible to all its members.'
                ];
            @endphp

            @foreach($accordionItems as $key => $content)
                <button onclick="toggleAccordion('{{ $key }}')" class="w-full text-left px-4 py-3 bg-green-100 rounded-md mb-2 hover:bg-green-200 transition duration-300 font-semibold">
                    {{ ucfirst($key) }}
                </button>
                <div id="{{ $key }}" class="hidden px-4 py-3 text-gray-700 border-l-4 border-green-400 mb-2">
                    {{ $content }}
                </div>
            @endforeach
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('info'))
            <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg">
                {{ session('info') }}
            </div>
        @endif

        {{-- Join Form OR Welcome Back --}}
        @if(!$isMember)
            <section id="join" class="bg-white rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 lg:p-8">
                <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b-2 border-green-100">
                    🙋 Join the OVC Ministry
                </h2>
                <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6">
                    If you feel called to support or serve in caring for Orphans and Vulnerable Children, fill out the form below.
                </p>

                <form action="{{ route('ministries.subscribe.post', $ministry) }}" method="POST" class="space-y-4 md:space-y-6">
                    @csrf

                    {{-- First & Last Name --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label for="first_name" class="block text-gray-700 font-medium mb-2 text-sm md:text-base">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                   value="{{ old('first_name', auth()->user()->first_name ?? '') }}">
                            @error('first_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-gray-700 font-medium mb-2 text-sm md:text-base">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                   value="{{ old('last_name', auth()->user()->last_name ?? '') }}">
                            @error('last_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Email & Phone --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2 text-sm md:text-base">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                   value="{{ old('email', auth()->user()->email ?? '') }}">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-2 text-sm md:text-base">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                   value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="block text-gray-700 font-medium mb-2 text-sm md:text-base">Role / Area of Service *</label>
                        <select id="role" name="role" required
                                class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base">
                            <option value="">Select a role</option>
                            <option value="Caregiver" {{ old('role')=='Caregiver'?'selected':'' }}>Caregiver</option>
                            <option value="Mentor" {{ old('role')=='Mentor'?'selected':'' }}>Mentor / Tutor</option>
                            <option value="Support Staff" {{ old('role')=='Support Staff'?'selected':'' }}>Support Staff</option>
                            <option value="Fundraising" {{ old('role')=='Fundraising'?'selected':'' }}>Fundraising & Outreach</option>
                        </select>
                        @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Interests --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-3 text-sm md:text-base">Areas of Interest (Select all that apply)</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @php $ovcInterests = ['Childcare','Education Support','Community Outreach','Fundraising']; @endphp
                            @foreach($ovcInterests as $interest)
                                <label class="flex items-center bg-green-50 p-3 rounded-lg cursor-pointer">
                                    <input type="checkbox" name="interests[]" value="{{ $interest }}"
                                           class="rounded text-green-600 focus:ring-green-500 h-4 w-4"
                                           {{ is_array(old('interests')) && in_array($interest, old('interests'))?'checked':'' }}>
                                    <span class="ml-2 text-gray-700 text-sm md:text-base">{{ $interest }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label for="message" class="block text-gray-700 font-medium mb-2 text-sm md:text-base">Tell us about yourself (Optional)</label>
                        <textarea id="message" name="message" rows="3"
                                  class="w-full px-3 py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition text-sm md:text-base"
                                  placeholder="Any experience, skills, or notes">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Submit --}}
                    <div class="flex flex-col md:flex-row gap-3 md:gap-4">
                        <button type="submit"
                                class="px-6 py-3 md:px-8 md:py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base">
                            <i class="fas fa-user-plus mr-2"></i> Join OVC Ministry
                        </button>
                        <button type="button"
                                class="px-6 py-3 md:px-8 md:py-3 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center text-sm md:text-base"
                                onclick="window.location.href='#contact'">
                            <i class="fas fa-hands-helping mr-2"></i> Volunteer as Leader
                        </button>
                    </div>
                </form>
            </section>
        @else
            {{-- Welcome Back --}}
            <section class="bg-gradient-to-r from-green-50 to-emerald-100 rounded-xl md:rounded-2xl shadow-lg p-6 md:p-8 lg:p-10">
                <div class="text-center">
                    <div class="mb-4 md:mb-6">
                        <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-3xl md:text-4xl text-green-600"></i>
                        </div>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-green-900 mb-3 md:mb-4">Welcome Back!</h2>
                    <p class="text-gray-700 text-base md:text-lg mb-4 md:mb-6 max-w-2xl mx-auto">
                        You are already a member of the <span class="font-semibold text-green-800">{{ $ministry->name }}</span> ministry. Thank you for serving!
                    </p>
                    <a href="#events" class="px-6 py-3 md:px-8 md:py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                        <i class="fas fa-calendar-alt mr-2"></i> View Upcoming Events
                    </a>
                </div>
            </section>
        @endif

        {{-- Footer Scripture --}}
        <div class="bg-white rounded-xl p-6 text-center shadow-inner">
            <blockquote class="text-gray-700 italic font-serif">
                "Truly I tell you, whatever you did for one of the least of these brothers and sisters of mine, you did for me." — Matthew 25:40
            </blockquote>
        </div>
    </div>
</section>

<script>
    function toggleAccordion(id) {
        const element = document.getElementById(id);
        element.classList.toggle('hidden');
    }
</script>
@endsection
