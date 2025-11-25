@extends('layouts.app')

@section('title', 'HIV and AIDS Ministry - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50 font-sans">
    <div class="container mx-auto px-4 md:px-8 space-y-12">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-red-700 mb-3">🩺 HIV & AIDS Ministry – ELCK</h2>
            <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
                Compassionate care, education, and advocacy for those affected by HIV/AIDS.
            </p>
        </div>

        {{-- Theological & Missional Foundation --}}
        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition duration-500">
            <h3 class="text-3xl font-bold text-red-600 mb-4">🤝 Theological & Missional Foundation</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li><strong>Breaking the Silence & Stigma:</strong> Creating a healing community where PLHIV are accepted.</li>
                <li><strong>Gospel of Hope:</strong> Sharing a message of life and hope amidst the epidemic.</li>
                <li><strong>Holistic Care:</strong> Addressing spiritual, physical, and socio-economic needs.</li>
            </ul>
        </div>

        {{-- Core Program Areas Accordion --}}
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition duration-500">
            <h3 class="text-3xl font-bold text-red-600 mb-4">🏥 Core Program Areas</h3>
            
            <button onclick="toggleAccordion('prevention')" class="w-full text-left px-4 py-3 bg-red-100 rounded-md mb-2 hover:bg-red-200 transition duration-300 font-semibold">
                1️⃣ Prevention & Education
            </button>
            <div id="prevention" class="hidden px-4 py-3 text-gray-700 border-l-4 border-red-400 mb-2">
                <ul class="list-disc list-inside">
                    <li>Awareness campaigns targeting youth and adults.</li>
                    <li>Encouraging behavioral change through Lutheran ethics.</li>
                    <li>Support for effective prevention methods.</li>
                </ul>
            </div>

            <button onclick="toggleAccordion('care')" class="w-full text-left px-4 py-3 bg-red-100 rounded-md mb-2 hover:bg-red-200 transition duration-300 font-semibold">
                2️⃣ Care & Support
            </button>
            <div id="care" class="hidden px-4 py-3 text-gray-700 border-l-4 border-red-400 mb-2">
                <ul class="list-disc list-inside">
                    <li>Home-based care and emotional support for PLHIV and families.</li>
                    <li>Pastoral and professional counseling for testing, disclosure, and treatment adherence.</li>
                    <li>Support groups to reduce isolation and stigma.</li>
                </ul>
            </div>

            <button onclick="toggleAccordion('advocacy')" class="w-full text-left px-4 py-3 bg-red-100 rounded-md mb-2 hover:bg-red-200 transition duration-300 font-semibold">
                3️⃣ Advocacy & Justice
            </button>
            <div id="advocacy" class="hidden px-4 py-3 text-gray-700 border-l-4 border-red-400 mb-2">
                <ul class="list-disc list-inside">
                    <li>Advocating for access to treatment, housing, and education.</li>
                    <li>Linking HIV response with livelihood programs like tree planting.</li>
                    <li>Fighting poverty to enhance health and social outcomes.</li>
                </ul>
            </div>

            <button onclick="toggleAccordion('institutional')" class="w-full text-left px-4 py-3 bg-red-100 rounded-md hover:bg-red-200 transition duration-300 font-semibold">
                4️⃣ Church Institutional Response
            </button>
            <div id="institutional" class="hidden px-4 py-3 text-gray-700 border-l-4 border-red-400 mb-2">
                <ul class="list-disc list-inside">
                    <li>Training clergy and lay leaders to speak openly and accurately about HIV/AIDS.</li>
                    <li>Developing liturgy and educational resources for Sunday school, confirmation, and worship.</li>
                </ul>
            </div>
        </div>

        {{-- Partnerships --}}
        <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition duration-500">
            <h3 class="text-3xl font-bold text-red-600 mb-4">🌐 Partnerships</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Global Lutheran Bodies: Lutheran World Federation (LWF), ELCA, and others for resources and capacity building.</li>
                <li>Ecumenical & Government Partners: CHAK, NASCOP, and other agencies for technical support and advocacy.</li>
            </ul>
        </div>

        {{-- Footer Scripture --}}
        <div class="bg-white rounded-xl p-6 text-center shadow-inner">
            <blockquote class="text-gray-700 italic font-serif">
                "Bear one another's burdens, and so fulfill the law of Christ." — Galatians 6:2
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
