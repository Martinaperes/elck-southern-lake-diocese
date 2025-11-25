@extends('layouts.app')

@section('content')
<section class="font-sans antialiased">

    <!-- Hero Section with Background Image -->
    <section class="hero bg-cover bg-center bg-no-repeat py-8 md:py-20 relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-0"></div>
        <div class="hero-content container mx-auto px-4 md:px-6 text-center relative z-10">
            <h1 class="text-2xl md:text-4xl lg:text-6xl font-bold mb-3 md:mb-6 text-white">Our Ministries</h1>
            <p class="text-base md:text-xl lg:text-2xl mb-4 md:mb-8 max-w-3xl mx-auto text-white">
                Serving God through various ministries that spread the Gospel and serve our community
            </p>
            <div class="w-20 md:w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>
    </section>

    <!-- Filter Buttons -->
    <div class="container mx-auto px-4 md:px-6 py-8 flex flex-wrap justify-center gap-3">
        <button class="filter-btn px-5 py-2.5 bg-blue-600 text-white border border-blue-600 rounded-lg transition-all duration-300 hover:bg-blue-700 active" data-filter="all">All</button>
        <button class="filter-btn px-5 py-2.5 bg-white border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:border-blue-500" data-filter="youth">Youth</button>
        <button class="filter-btn px-5 py-2.5 bg-white border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:border-blue-500" data-filter="worship">Worship</button>
        <button class="filter-btn px-5 py-2.5 bg-white border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:border-blue-500" data-filter="children">Children</button>
        <button class="filter-btn px-5 py-2.5 bg-white border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:border-blue-500" data-filter="adults">Adults</button>
        <button class="filter-btn px-5 py-2.5 bg-white border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:border-blue-500" data-filter="outreach">Outreach</button>
        <button class="filter-btn px-5 py-2.5 bg-white border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:border-blue-500" data-filter="training">Training</button>
    </div>

    <!-- Ministries Grid -->
    <div class="ministries-grid container mx-auto px-4 md:px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pb-12" id="ministries-container">
        @forelse($ministries as $ministry)
            <div class="ministry-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300" data-category="{{ strtolower($ministry->category) }}">
                <div class="ministry-image h-48 overflow-hidden p-4">
                    <img src="{{ asset('images/gallery/' . $ministry->image_url) }}" alt="{{ $ministry->name }}" class="w-full h-full object-cover rounded-lg">
                </div>
                <div class="p-5 md:p-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">{{ $ministry->name }}</h3>
                    <p class="text-gray-600 text-sm md:text-base mb-4 line-clamp-3">
                        {{ $ministry->description }}
                    </p>
                    <div class="text-xs md:text-sm text-gray-500 space-y-2 mb-4">
                        @if($ministry->leader_name)
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2 text-blue-500 w-4"></i>
                                <span>Leader: {{ $ministry->leader_name }}</span>
                            </div>
                        @endif
                        @if($ministry->meeting_schedule)
                            <div class="flex items-center">
                                <i class="fas fa-calendar mr-2 text-green-500 w-4"></i>
                                <span>{{ $ministry->meeting_schedule }}</span>
                            </div>
                        @endif
                        @if($ministry->contact_email)
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-2 text-purple-500 w-4"></i>
                                <span>{{ $ministry->contact_email }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle mr-1 text-green-500" style="font-size: 6px;"></i> Active
                        </span>
                        <a href="{{ route('ministries.show', $ministry->slug) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-xs md:text-sm transition-all duration-300 hover:bg-blue-700">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">No ministries found.</p>
            </div>
        @endforelse
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const ministries = document.querySelectorAll('.ministry-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(b => {
                b.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-600');
                b.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
            });
            
            // Add active class to clicked button
            btn.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-600');
            btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');

            const filter = btn.dataset.filter.toLowerCase();

            ministries.forEach(ministry => {
                const category = ministry.dataset.category.toLowerCase();
                if (filter === 'all' || category === filter) {
                    ministry.style.display = 'block';
                } else {
                    ministry.style.display = 'none';
                }
            });
        });
    });
});
</script>

<style>
/* Add this to your CSS file or in a style tag */
.hero {
    background-image: url('{{ asset("images/ministries-banner.jpg") }}');
    /* Fallback gradient if image doesn't load */
    background: linear-gradient(135deg, rgba(30, 58, 138, 0.8), rgba(107, 33, 168, 0.8)), 
                url('{{ asset("images/ministries-banner.jpg") }}') center/cover;
}

/* Ensure smooth transitions for the filtering */
.ministry-card {
    transition: all 0.3s ease;
}

/* Active state for filter buttons */
.filter-btn.active {
    background-color: #2563eb;
    color: white;
    border-color: #2563eb;
}
</style>
@endsection