<section class="py-12 bg-gray-50 font-sans relative">
    {{-- Music Notes Subtle Background --}}
    <div class="absolute inset-0 opacity-5" style="background: url('{{ asset('images/music-notes-bg.png') }}') repeat center center;"></div>

    <div class="relative container mx-auto px-4 md:px-8 space-y-16">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-5xl font-extrabold text-gray-800 mb-3">🎶 Music & Choir Ministry – ELCK</h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                Enhancing worship, expressing faith, and evangelizing through music and choirs in the Evangelical Lutheran Church in Kenya.
            </p>
        </div>

        {{-- Role of Choirs --}}
        <div class="bg-white rounded-2xl shadow-md p-8 flex flex-col md:flex-row items-center gap-6 hover:shadow-lg transition-shadow duration-500">
            <img src="{{ asset('images/ministries/music-1.jpg') }}" alt="Choir Image" class="w-full md:w-1/3 rounded-tl-2xl rounded-tr-2xl md:rounded-tr-none md:rounded-bl-2xl object-cover shadow-lg">
            <div class="md:w-2/3 space-y-4">
                <h3 class="text-3xl font-bold text-gray-800">The Role of Choirs</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li><strong>Enhancement of Worship:</strong> Choirs contextualize services with powerful musical expressions.</li>
                    <li><strong>Theological Expression:</strong> Convey gospel messages in local languages.</li>
                    <li><strong>Evangelism & Outreach:</strong> Performances and albums spread the Gospel widely.</li>
                    <li><strong>Community & Unity:</strong> Fosters unity and draws members together.</li>
                </ul>
            </div>
        </div>

        {{-- Structure of Choirs --}}
        <div class="bg-white rounded-2xl shadow-md p-6 space-y-4">
            <h3 class="text-3xl font-bold text-gray-800">Structure and Notable Choirs</h3>
            <ul class="list-decimal list-inside space-y-2 text-gray-700">
                <li>
                    <strong>Congregational Choirs:</strong> Senior, Youth, and Sunday School Choirs lead weekly worship.
                    <ul class="list-disc list-inside ml-6 text-gray-600">
                        <li>ELCK Evangelical Choir Itierio</li>
                        <li>ELCK MBARA INJILI CHOIR</li>
                        <li>ELCK Springs of Life</li>
                    </ul>
                </li>
                <li>
                    <strong>Diocesan/Regional Choirs:</strong> Larger choirs for special occasions and recordings.
                </li>
                <li>
                    <strong>National Choir:</strong> Mobilized for major national events and conventions.
                </li>
            </ul>
        </div>

        {{-- Join Form Interactive --}}
        <div class="bg-white rounded-2xl p-6 shadow-md text-center space-y-4">
            <h4 class="text-3xl font-bold text-gray-800">Want to Join the Choir?</h4>
            <p class="text-gray-700">Participate in worship and spread joy through music!</p>
            <button onclick="document.getElementById('joinForm').classList.toggle('hidden')" class="px-6 py-3 bg-gray-800 text-white rounded-full hover:bg-gray-900 transition duration-300 shadow-md">
                🎤 Join Now
            </button>

            {{-- Hidden Form --}}
            <div id="joinForm" class="hidden mt-6 bg-gray-50 rounded-xl p-6 shadow-inner">
                <form action="{{ route('ministries.subscribe.post', $ministry ?? 1) }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-3 border rounded-lg" required>
                    <input type="email" name="email" placeholder="Your Email" class="w-full p-3 border rounded-lg" required>
                    <input type="text" name="phone" placeholder="Phone Number" class="w-full p-3 border rounded-lg">
                    <input type="text" name="role" placeholder="Voice/Instrument/Other" class="w-full p-3 border rounded-lg">
                    <textarea name="message" placeholder="Message" class="w-full p-3 border rounded-lg" rows="3"></textarea>
                    <button type="submit" class="w-full bg-gray-800 text-white font-bold py-3 rounded-lg hover:bg-gray-900 transition duration-300">
                        Submit 🎵
                    </button>
                </form>
            </div>
        </div>

        {{-- Footer Scripture --}}
        <div class="bg-white rounded-xl p-6 text-center shadow-inner">
            <blockquote class="text-gray-700 italic font-serif">
                "Let everything that has breath praise the Lord!" — Psalm 150:6
            </blockquote>
        </div>

    </div>
</section>

<script>
    // Toggle join form visibility
    function toggleJoinForm() {
        document.getElementById('joinForm').classList.toggle('hidden');
    }
</script>
