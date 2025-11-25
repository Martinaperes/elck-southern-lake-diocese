@extends('layouts.app')

@section('title', 'Join ' . $ministry->name . ' - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 md:px-8 max-w-3xl">
        <div class="bg-white shadow-xl rounded-2xl p-8 md:p-12 relative overflow-hidden">
            {{-- Decorative Background --}}
            <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-200 rounded-bl-full opacity-30"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-200 rounded-tr-full opacity-30"></div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-blue-800 mb-2">{{ $ministry->name }}</h1>
                <p class="text-gray-600 md:text-lg">Fill in the form below to join or get more information about this ministry.</p>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div id="success-msg" class="bg-green-100 text-green-800 border border-green-300 rounded-lg p-4 mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('ministries.subscribe.post', $ministry->slug) }}" method="POST" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Firts Name</label>
        <input type="text" name="first_name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Last Name</label>
        <input type="text" name="last_name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Phone</label>
        <input type="text" name="phone" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Message (optional)</label>
        <textarea name="message" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition">
        Join {{ $ministry->name }}
    </button>
</form>


        </div>
    </div>
</section>

{{-- JavaScript for interactivity --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('subscribeForm');
    const submitBtn = document.getElementById('submitBtn');

    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');

    form.addEventListener('submit', (e) => {
        let valid = true;

        // Reset errors
        document.getElementById('name-error').classList.add('hidden');
        document.getElementById('email-error').classList.add('hidden');

        // Name validation
        if (!nameInput.value.trim()) {
            document.getElementById('name-error').classList.remove('hidden');
            valid = false;
        }

        // Email validation (simple regex)
        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!emailInput.value.trim() || !emailPattern.test(emailInput.value)) {
            document.getElementById('email-error').classList.remove('hidden');
            valid = false;
        }

        if (!valid) {
            e.preventDefault(); // Prevent form submission
        } else {
            // Disable button to prevent multiple submissions
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
        }
    });
});
</script>
@endsection
