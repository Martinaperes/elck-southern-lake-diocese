@extends('layouts.app')

@section('title', 'Training Ministry - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50 font-sans relative">
    <div class="container mx-auto px-4 md:px-8 space-y-16">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-5xl font-extrabold text-blue-800 mb-3">🎓 Training Ministry – ELCK</h2>
            <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
                Equipping clergy and lay leaders to faithfully serve the church and community.
            </p>
        </div>

        {{-- Clergy Training Section --}}
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6 hover:shadow-lg transition-shadow duration-500">
            <h3 class="text-3xl font-bold text-blue-800">🧑‍🎓 Clergy Training: Lutheran School of Theology (LST)</h3>
            <p class="text-gray-700">The LST forms African Lutherans to be orthodox teachers of the faith and faithful pastors of the Gospel.</p>
            
            <ul class="list-disc list-inside text-gray-700 space-y-2 mt-4">
                <li><strong>Focus:</strong> Biblical studies, Lutheran doctrine, Church History, Pastoral Theology.</li>
                <li><strong>Program Offerings:</strong>
                    <ul class="list-decimal list-inside ml-6 mt-2">
                        <li>Diploma in Theology (DTh) – preparation for ordination including vicarage.</li>
                        <li>Certificate in Evangelistic Training (CET) – equips individuals for outreach and evangelism.</li>
                    </ul>
                </li>
                <li><strong>Practical Training:</strong> Students participate in farm work and campus service alongside academics to prepare for real-world ministry.</li>
                <li><strong>Accreditation:</strong> Ensures rigorous and transferable theological education.</li>
            </ul>
        </div>

        {{-- Lay Leaders Section --}}
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6 hover:shadow-lg transition-shadow duration-500">
            <h3 class="text-3xl font-bold text-blue-800">🧑‍🤝‍🧑 Lay Leader Training</h3>
            <p class="text-gray-700">Lay leaders are the backbone of the church, serving in evangelism, Sunday school, choirs, and other ministries.</p>

            <ul class="list-disc list-inside text-gray-700 space-y-2 mt-4">
                <li><strong>Empowerment for Service:</strong> Equips non-ordained members to serve effectively in various leadership roles.</li>
                <li><strong>Programs:</strong>
                    <ul class="list-decimal list-inside ml-6 mt-2">
                        <li>Local Church Training: Workshops on discipleship, governance, and Bible leadership.</li>
                        <li>Diocesan Events: Regional retreats and events focusing on leadership and governance.</li>
                        <li>Specialized Ministry Training: Choir directors, evangelism teams, Sunday school teachers.</li>
                    </ul>
                </li>
                <li><strong>Emphasis on Vocation:</strong> All believers are called to serve their neighbor, in church, family, and society.</li>
            </ul>
        </div>

        {{-- Interactive Accordion for More Details --}}
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition duration-500">
            <h3 class="text-3xl font-bold text-blue-800 mb-4">ℹ️ Learn More About Vicarage & Internships</h3>
            <button onclick="toggleAccordion()" class="px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition duration-300 shadow-md">
                Click to Expand
            </button>
            <div id="accordionContent" class="hidden mt-4 text-gray-700 space-y-2">
                <p>The vicarage is a supervised internship for pastoral candidates where they apply theological knowledge in real congregational ministry. Candidates participate in preaching, teaching, pastoral care, and community outreach under experienced clergy.</p>
                <p>This hands-on training ensures that newly ordained pastors are both spiritually and practically prepared for ministry across ELCK parishes.</p>
            </div>
        </div>

        {{-- Footer Scripture --}}
        <div class="bg-white rounded-xl p-6 text-center shadow-inner">
            <blockquote class="text-gray-700 italic font-serif">
                "Equip the saints for the work of ministry, for building up the body of Christ." — Ephesians 4:12
            </blockquote>
        </div>
    </div>
</section>

<script>
    function toggleAccordion() {
        const content = document.getElementById('accordionContent');
        content.classList.toggle('hidden');
    }
</script>
@endsection
