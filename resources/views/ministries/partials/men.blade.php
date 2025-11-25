<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 md:px-8 space-y-12">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-4xl font-extrabold text-blue-900 mb-4">Men's Ministry - ELCK</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Dedicated to spiritually nurturing and equipping men to lead in their families, church, and communities.
            </p>
        </div>

        {{-- Overview Card --}}
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col md:flex-row items-center gap-8 hover:shadow-2xl transition duration-300">
            <img src="{{ asset('images/ministries/mens-ministry-1.jpg') }}" alt="Men's Ministry" class="w-full md:w-1/3 rounded-tl-2xl rounded-tr-2xl md:rounded-tr-none md:rounded-bl-2xl object-cover">
            <div class="md:w-2/3 space-y-4">
                <h3 class="text-2xl font-bold text-blue-800">Overview</h3>
                <p class="text-gray-700">The Men's Ministry of ELCK provides a platform for men to grow in faith, character, and service, fostering godly leadership and accountability.</p>
                <button onclick="toggleSection('objectives')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Show Core Objectives</button>
            </div>
        </div>

        {{-- Collapsible Section --}}
        <div id="objectives" class="hidden bg-white rounded-xl shadow-md p-6 space-y-4">
            <h4 class="text-xl font-semibold text-blue-800">Core Objectives</h4>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Spiritual Growth through Bible study, prayer, and worship.</li>
                <li>Leadership Development in church, family, and society.</li>
                <li>Fellowship and Brotherhood for mentorship and encouragement.</li>
                <li>Community Service through outreach and social projects.</li>
                <li>Personal Development promoting skills, moral integrity, and responsible citizenship.</li>
            </ul>
        </div>

        {{-- Key Activities with Tabs --}}
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h4 class="text-xl font-bold text-blue-800 mb-4">Key Activities</h4>
            <div class="flex flex-wrap gap-2 mb-4">
                <button class="activity-tab px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" data-target="bible">Bible & Prayer</button>
                <button class="activity-tab px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" data-target="fellowship">Fellowship & Retreats</button>
                <button class="activity-tab px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" data-target="skills">Leadership & Skills</button>
                <button class="activity-tab px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" data-target="community">Community Outreach</button>
            </div>
            <div class="activity-content space-y-2">
                <div id="bible" class="hidden text-gray-700">Weekly Bible study and prayer meetings focused on spiritual growth and discipleship.</div>
                <div id="fellowship" class="hidden text-gray-700">Men’s fellowships, retreats, and mentorship programs to strengthen bonds and leadership.</div>
                <div id="skills" class="hidden text-gray-700">Workshops on leadership, personal development, and vocational skills.</div>
                <div id="community" class="hidden text-gray-700">Engagement in community outreach projects and social service initiatives.</div>
            </div>
        </div>

        {{-- Motto & Scripture --}}
        <div class="bg-blue-50 rounded-xl p-6 text-center space-y-4">
            <h4 class="text-2xl font-bold text-blue-800">Motto</h4>
            <p class="italic text-gray-700">“Strong in Faith, Steadfast in Service.”</p>
            <blockquote class="text-gray-600 italic border-l-4 border-blue-600 pl-4">
                “Be watchful, stand firm in the faith, act like men, be strong.” — 1 Corinthians 16:13
            </blockquote>
        </div>

    </div>
</section>

{{-- JavaScript --}}
<script>
    function toggleSection(id) {
        const section = document.getElementById(id);
        section.classList.toggle('hidden');
    }

    const tabs = document.querySelectorAll('.activity-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.target;
            document.querySelectorAll('.activity-content > div').forEach(div => div.classList.add('hidden'));
            document.getElementById(target).classList.remove('hidden');
        });
    });
</script>
