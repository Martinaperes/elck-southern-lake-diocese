<section class="py-12 bg-gradient-to-b from-yellow-50 to-pink-50 font-sans">
    <div class="container mx-auto px-4 md:px-8 space-y-16">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-5xl font-extrabold text-purple-700 mb-3 animate-bounce">Sunday School Ministry – ELCK</h2>
            <p class="text-lg md:text-xl text-pink-600 max-w-3xl mx-auto font-mono">
                Nurturing children and young learners in the Christian faith with fun, safe, and interactive activities.
            </p>
        </div>

        {{-- Overview Section --}}
        <div class="bg-gradient-to-r from-blue-200 via-blue-100 to-blue-300 rounded-3xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-6 hover:scale-105 transition-transform duration-500">
            <img src="{{ asset('images/ministries/sunday-school-1.jpg') }}" alt="Sunday School" class="w-full md:w-1/3 rounded-tl-3xl rounded-tr-3xl md:rounded-tr-none md:rounded-bl-3xl object-cover shadow-lg">
            <div class="md:w-2/3 space-y-4">
                <h3 class="text-3xl font-bold text-indigo-800 font-serif">Overview</h3>
                <p class="text-gray-800 font-light text-lg">
                    The Sunday School Ministry provides children with a safe, engaging, and spiritually enriching environment where they can learn about God’s love, biblical teachings, and Christian values.
                </p>
                <button onclick="toggleSection('coreObjectives')" class="px-5 py-2 bg-pink-500 text-white font-semibold rounded-full hover:bg-pink-600 transition duration-300 shadow-md">
                    Show Core Objectives
                </button>
            </div>
        </div>

        {{-- Collapsible Core Objectives --}}
        <div id="coreObjectives" class="hidden bg-gradient-to-r from-green-100 via-green-50 to-green-200 rounded-xl shadow-md p-6 space-y-3">
            <h4 class="text-2xl font-bold text-green-800 font-serif">Core Objectives</h4>
            <ul class="list-decimal list-inside space-y-2 text-green-900 font-mono">
                <li><strong>Biblical Education:</strong> Fun and engaging Bible lessons for different age groups.</li>
                <li><strong>Spiritual Formation:</strong> Prayer, worship, and personal relationship with God.</li>
                <li><strong>Moral Development:</strong> Teach values like honesty, kindness, and respect.</li>
                <li><strong>Active Participation:</strong> Children participate in church and community activities.</li>
                <li><strong>Creative Expression:</strong> Songs, drama, art, and interactive games to learn about God.</li>
            </ul>
        </div>

        {{-- Key Activities --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $activities = [
                    ['title'=>'Bible Classes & Storytelling', 'desc'=>'Sessions for different age groups teaching Bible stories and lessons.', 'color'=>'bg-yellow-200 hover:bg-yellow-300'],
                    ['title'=>'Prayer & Worship', 'desc'=>'Tailored prayer and worship sessions for children.', 'color'=>'bg-pink-200 hover:bg-pink-300'],
                    ['title'=>'Choir, Drama & Arts', 'desc'=>'Engage children in music, drama, and arts creatively.', 'color'=>'bg-purple-200 hover:bg-purple-300'],
                    ['title'=>'Annual Events', 'desc'=>'Easter, Christmas plays, and Vacation Bible Schools.', 'color'=>'bg-green-200 hover:bg-green-300'],
                    ['title'=>'Mentorship & Counseling', 'desc'=>'Guidance for moral and spiritual growth.', 'color'=>'bg-blue-200 hover:bg-blue-300'],
                ];
            @endphp

            @foreach($activities as $activity)
                <div class="rounded-2xl p-6 shadow-lg cursor-pointer transition-transform duration-300 {{ $activity['color'] }}" onclick="showActivity('{{ Str::slug($activity['title']) }}')">
                    <h5 class="font-bold text-xl text-gray-800 mb-1 font-serif">{{ $activity['title'] }}</h5>
                    <p class="text-gray-700 mt-1 text-sm hidden" id="{{ Str::slug($activity['title']) }}">{{ $activity['desc'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Motto & Scripture --}}
        <div class="bg-gradient-to-r from-pink-100 via-yellow-50 to-blue-100 rounded-xl p-6 text-center space-y-4 shadow-inner">
            <h4 class="text-3xl font-bold text-red-700 font-serif">Motto</h4>
            <p class="italic text-blue-900 font-mono">“Training Children in the Ways of the Lord.”</p>
            <blockquote class="text-gray-700 italic border-l-8 border-red-500 pl-4">
                “Train up a child in the way he should go; even when he is old he will not depart from it.” — Proverbs 22:6
            </blockquote>
        </div>

    </div>
</section>

{{-- JavaScript --}}
<script>
    function toggleSection(id) {
        document.getElementById(id).classList.toggle('hidden');
    }

    function showActivity(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    }
</script>
