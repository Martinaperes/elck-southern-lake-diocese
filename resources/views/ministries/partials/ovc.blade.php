@extends('layouts.app')

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

        {{-- Project 24 --}}
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

        {{-- Pangani Lutheran Children Centre --}}
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

        {{-- Community-Based Support --}}
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

        {{-- Interactive Accordion: Holistic Care Areas --}}
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition duration-500">
            <h3 class="text-3xl font-bold text-green-600 mb-4">🌟 Holistic Care Areas</h3>

            <button onclick="toggleAccordion('spiritual')" class="w-full text-left px-4 py-3 bg-green-100 rounded-md mb-2 hover:bg-green-200 transition duration-300 font-semibold">
                Spiritual Nurturing
            </button>
            <div id="spiritual" class="hidden px-4 py-3 text-gray-700 border-l-4 border-green-400 mb-2">
                Daily devotions, Bible study, catechesis, and participation in church activities.
            </div>

            <button onclick="toggleAccordion('educational')" class="w-full text-left px-4 py-3 bg-green-100 rounded-md mb-2 hover:bg-green-200 transition duration-300 font-semibold">
                Educational Support
            </button>
            <div id="educational" class="hidden px-4 py-3 text-gray-700 border-l-4 border-green-400 mb-2">
                School enrollment, fees, uniforms, books, and exam support to prevent dropouts.
            </div>

            <button onclick="toggleAccordion('physical')" class="w-full text-left px-4 py-3 bg-green-100 rounded-md mb-2 hover:bg-green-200 transition duration-300 font-semibold">
                Physical & Nutritional Care
            </button>
            <div id="physical" class="hidden px-4 py-3 text-gray-700 border-l-4 border-green-400 mb-2">
                Feeding programs, medical care, hygiene support, and safe housing.
            </div>

            <button onclick="toggleAccordion('socioeconomic')" class="w-full text-left px-4 py-3 bg-green-100 rounded-md hover:bg-green-200 transition duration-300 font-semibold">
                Socio-Economic Empowerment
            </button>
            <div id="socioeconomic" class="hidden px-4 py-3 text-gray-700 border-l-4 border-green-400 mb-2">
                Skills training, small income-generating initiatives, and mentorship for self-sufficiency.
            </div>
        </div>

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
