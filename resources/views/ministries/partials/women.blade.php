<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 md:px-8 space-y-12">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-4xl font-bold text-pink-700 mb-4">Women's Ministry - ELCK</h2>
            <p class="text-gray-700 max-w-2xl mx-auto">
                Empowering women spiritually, socially, and economically, fostering leadership and service in the church and community.
            </p>
        </div>

        {{-- Overview --}}
        <div class="md:flex md:items-center md:space-x-8 space-y-6 md:space-y-0">
            <div class="md:w-1/2">
                <img src="{{ asset('images/ministries/womens-ministry-1.jpg') }}" alt="Women Ministry" class="rounded-tl-3xl rounded-tr-3xl shadow-lg w-full object-cover">
            </div>
            <div class="md:w-1/2 space-y-4">
                <h3 class="text-2xl font-semibold text-pink-700">Overview</h3>
                <p class="text-gray-700">
                    The Women's Ministry of the Evangelical Lutheran Church in Kenya (ELCK) provides a platform for women of all ages to grow in faith, support one another, and actively participate in church life and community development.
                </p>
            </div>
        </div>

        {{-- Mission & Vision --}}
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-pink-700 mb-2 cursor-pointer" onclick="toggleSection('mission')">
                    Mission <span id="mission-icon" class="inline-block transform transition-transform">▼</span>
                </h3>
                <p id="mission" class="text-gray-700 hidden">
                    To nurture and equip women to live godly lives, serve the church, and make a meaningful impact in society while promoting spiritual growth, leadership, and fellowship.
                </p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-pink-700 mb-2 cursor-pointer" onclick="toggleSection('vision')">
                    Vision <span id="vision-icon" class="inline-block transform transition-transform">▼</span>
                </h3>
                <p id="vision" class="text-gray-700 hidden">
                    A faithful, empowered, and active community of women transforming their families, church, and society through Christian service and leadership.
                </p>
            </div>
        </div>

        {{-- Core Objectives --}}
        <div class="bg-white p-6 rounded-xl shadow space-y-4">
            <h3 class="text-2xl font-semibold text-pink-700 mb-4">Core Objectives</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li><strong>Spiritual Growth:</strong> Encourage women to deepen their relationship with God through prayer, Bible study, and worship.</li>
                <li><strong>Fellowship and Support:</strong> Build strong bonds among women for mutual encouragement, mentorship, and guidance.</li>
                <li><strong>Leadership and Empowerment:</strong> Equip women with leadership skills and opportunities to serve in the church and community.</li>
                <li><strong>Community Outreach:</strong> Engage in charitable activities, including supporting the needy, visiting hospitals, and promoting social justice.</li>
                <li><strong>Skills and Economic Development:</strong> Promote entrepreneurship, vocational training, and self-reliance among women.</li>
            </ul>
        </div>

        {{-- Key Activities --}}
        <div class="bg-pink-50 p-6 rounded-xl shadow space-y-4">
            <h3 class="text-2xl font-semibold text-pink-700">Key Activities</h3>
            <ul class="list-decimal list-inside text-gray-700 space-y-2">
                <li>Bible Study Groups</li>
                <li>Prayer Meetings</li>
                <li>Retreats and Conferences</li>
                <li>Charitable Outreach</li>
                <li>Skills Development Workshops</li>
                <li>Women Choir and Music Ministry</li>
            </ul>
        </div>

        {{-- Motto & Scripture --}}
        <div class="md:flex md:space-x-8 space-y-6 md:space-y-0">
            <div class="md:w-1/2 bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-pink-700 mb-2">Motto</h3>
                <p class="text-gray-700">“Rooted in Christ, Empowered to Serve.”</p>
            </div>
            <div class="md:w-1/2 bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-pink-700 mb-2">Scriptural Foundation</h3>
                <blockquote class="text-gray-700 italic">“She opens her mouth with wisdom, and the teaching of kindness is on her tongue.” — Proverbs 31:26 (ESV)</blockquote>
            </div>
        </div>

    </div>
</section>

{{-- Interactivity --}}
<script>
    function toggleSection(id) {
        const el = document.getElementById(id);
        const icon = document.getElementById(id + '-icon');
        if(el.classList.contains('hidden')) {
            el.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            el.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
</script>
