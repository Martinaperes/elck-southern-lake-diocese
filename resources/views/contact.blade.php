@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-blue-700 mb-4 text-center">Contact Us</h1>
    <p class="text-center mb-8 text-gray-600">
        We'd love to hear from you. Please send us a message below.
    </p>

    <form action="#" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Full Name</label>
            <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700">Message</label>
            <textarea name="message" rows="5" class="w-full border rounded-lg px-3 py-2" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Send Message
        </button>
    </form>
</div>
@endsection
