<section class="py-12 bg-green-50 font-sans relative">
    {{-- Tree Pattern Subtle Background --}}
    <div class="absolute inset-0 opacity-5" style="background: url('{{ asset('images/tree-pattern.png') }}') repeat center center;"></div>

    <div class="relative container mx-auto px-4 md:px-8 space-y-16">

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-5xl font-extrabold text-green-800 mb-3">🌿 Evangelism & Tree Planting Ministry – ELCK</h2>
            <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
                Combining holistic evangelism with environmental stewardship to spread the Gospel and care for God's creation.
            </p>
        </div>

        {{-- Integration Section --}}
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6 hover:shadow-lg transition-shadow duration-500">
            <h3 class="text-3xl font-bold text-green-800 mb-4">🌿 Why Combine Evangelism and Tree Planting?</h3>
            <p class="text-gray-700">This ministry integrates spiritual and physical needs, showing faith in action. Planting trees is a symbolic and practical way to demonstrate the "seed of the Gospel."</p>
            
            <table class="w-full text-left border-collapse mt-6">
                <thead>
                    <tr class="bg-green-100">
                        <th class="p-3 border">Component</th>
                        <th class="p-3 border">Focus & Theology</th>
                        <th class="p-3 border">Practical Application</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-green-50 transition">
                        <td class="p-3 border font-semibold">Evangelism</td>
                        <td class="p-3 border">Spiritual Life: Proclaiming the Word, teaching Catechism, leading to faith</td>
                        <td class="p-3 border">Tree planting events serve as platforms for outreach and discipleship</td>
                    </tr>
                    <tr class="hover:bg-green-50 transition">
                        <td class="p-3 border font-semibold">Tree Planting</td>
                        <td class="p-3 border">Creation Stewardship: Caring for God’s creation, addressing climate and soil issues</td>
                        <td class="p-3 border">Congregations organize planting days with youth; indigenous and fruit trees for conservation and income</td>
                    </tr>
                    <tr class="hover:bg-green-50 transition">
                        <td class="p-3 border font-semibold">Synergy</td>
                        <td class="p-3 border">Holistic Witness: Faith expressed in improving life here and now</td>
                        <td class="p-3 border">Sustainability benefits: food, shade, rainfall, income; symbolizing Gospel seeds</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Operations --}}
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-4 hover:shadow-lg transition-shadow duration-500">
            <h3 class="text-3xl font-bold text-green-800">🌳 How the Ministry Operates</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li><strong>Congregational Initiative:</strong> Local parishes coordinate planting drives, especially during rainy seasons.</li>
                <li><strong>Youth Engagement:</strong> Youth participate for purpose, skills, and practical faith application.</li>
                <li><strong>Partnerships:</strong> ELCK collaborates with Lutheran bodies and NGOs for resources, projects, and evangelism.</li>
                <li><strong>Disaster Response:</strong> Tree planting mitigates flooding, erosion, and aids recovery.</li>
            </ul>
        </div>

        {{-- Theological Foundation --}}
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-4 hover:shadow-lg transition-shadow duration-500">
            <h3 class="text-3xl font-bold text-green-800">📜 Theological Foundation</h3>
            <p class="text-gray-700">Rooted in the Lutheran understanding of the "Two Kingdoms" and vocation, caring for creation is an expression of Christian love and service.</p>
            <blockquote class="italic text-gray-600 border-l-4 border-green-400 pl-4 mt-4">
                "The earth is the Lord's, and everything in it." — Psalm 24:1
            </blockquote>
        </div>

        {{-- Join Form --}}
        <div class="bg-white rounded-2xl p-6 shadow-md text-center space-y-4">
            <h4 class="text-3xl font-bold text-green-800">Join Our Evangelism & Tree Planting Initiatives</h4>
            <p class="text-gray-700">Participate in spreading the Gospel and caring for creation!</p>
            <button onclick="document.getElementById('joinForm').classList.toggle('hidden')" class="px-6 py-3 bg-green-700 text-white rounded-full hover:bg-green-800 transition duration-300 shadow-md">
                🌱 Join Now
            </button>

            {{-- Hidden Form --}}
            <div id="joinForm" class="hidden mt-6 bg-green-50 rounded-xl p-6 shadow-inner">
                <form action="{{ route('ministries.subscribe.post', $ministry ?? 1) }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-3 border rounded-lg" required>
                    <input type="email" name="email" placeholder="Your Email" class="w-full p-3 border rounded-lg" required>
                    <input type="text" name="phone" placeholder="Phone Number" class="w-full p-3 border rounded-lg">
                    <input type="text" name="role" placeholder="Volunteer Role" class="w-full p-3 border rounded-lg">
                    <textarea name="message" placeholder="Message" class="w-full p-3 border rounded-lg" rows="3"></textarea>
                    <button type="submit" class="w-full bg-green-700 text-white font-bold py-3 rounded-lg hover:bg-green-800 transition duration-300">
                        Submit 🌿
                    </button>
                </form>
            </div>
        </div>

        {{-- Footer Scripture --}}
        <div class="bg-white rounded-xl p-6 text-center shadow-inner">
            <blockquote class="text-gray-700 italic font-serif">
                "Go therefore and make disciples of all nations, baptizing them..." — Matthew 28:19
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
