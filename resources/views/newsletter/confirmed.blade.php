{{-- resources/views/newsletter/confirmed.blade.php --}}
@extends('layouts.app')

@section('title', 'Subscription Confirmed - ELCK Newsletter')

@section('styles')
<style>
    .confirmation-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 40px;
        text-align: center;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .confirmation-icon {
        font-size: 80px;
        color: #0fbd0f;
        margin-bottom: 20px;
    }
    .scripture-box {
        background-color: #e7f3e7;
        padding: 20px;
        border-radius: 8px;
        margin: 30px 0;
        border-left: 4px solid #197b3b;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark py-12 px-4">
    <div class="confirmation-container">
        <div class="confirmation-icon">
            <span class="material-symbols-outlined text-6xl">check_circle</span>
        </div>
        
        <h1 class="text-3xl font-bold text-brand-dark dark:text-white mb-4">Subscription Confirmed!</h1>
        
        <div class="scripture-box">
            <p class="text-lg italic text-brand-dark">
                "The LORD bless you and keep you; the LORD make his face shine on you and be gracious to you; the LORD turn his face toward you and give you peace."
            </p>
            <p class="mt-2 font-bold text-primary">— Numbers 6:24-26</p>
        </div>
        
        <p class="text-gray-700 dark:text-gray-300 mb-6">
            Thank you, <strong class="text-brand-dark">{{ $subscriber->name ?? 'Beloved in Christ' }}</strong>! 
            Your subscription to the ELCK Southern Lake Diocese newsletter has been confirmed.
        </p>
        
        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg mb-6">
            <p class="text-green-800 dark:text-green-300">
                <strong>Email:</strong> {{ $subscriber->email }}<br>
                <strong>Confirmed:</strong> {{ now()->format('F j, Y') }}
            </p>
        </div>
        
        <p class="text-gray-600 dark:text-gray-400 mb-8">
            You'll start receiving our weekly newsletter with sermons, event updates, and spiritual encouragement in your inbox.
            Your first welcome email should arrive shortly.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 transition">
                <span class="material-symbols-outlined mr-2">home</span>
                Return Home
            </a>
            <a href="{{ route('newsletter') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition">
                <span class="material-symbols-outlined mr-2">mail</span>
                Newsletter Page
            </a>
        </div>
        
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-8">
            Need to make changes to your subscription? <br>
            You can unsubscribe at any time using the link in our emails.
        </p>
    </div>
</div>
@endsection