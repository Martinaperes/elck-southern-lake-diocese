{{-- resources/views/newsletter/unsubscribed.blade.php --}}
@extends('layouts.app')

@section('title', 'Unsubscribed - ELCK Newsletter')

@section('styles')
<style>
    .unsubscribe-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 40px;
        text-align: center;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .unsubscribe-icon {
        font-size: 80px;
        color: #666;
        margin-bottom: 20px;
    }
    .message-box {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 30px 0;
        border: 1px solid #e9ecef;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark py-12 px-4">
    <div class="unsubscribe-container">
        <div class="unsubscribe-icon">
            <span class="material-symbols-outlined text-6xl">cancel</span>
        </div>
        
        <h1 class="text-3xl font-bold text-brand-dark dark:text-white mb-4">Unsubscribed Successfully</h1>
        
        <div class="message-box">
            <p class="text-lg text-gray-700 dark:text-gray-300">
                You have been unsubscribed from the ELCK Southern Lake Diocese newsletter.
            </p>
            
            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-800 rounded">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <strong>Email:</strong> {{ $subscriber->email }}<br>
                    <strong>Unsubscribed:</strong> {{ now()->format('F j, Y \a\t g:i A') }}
                </p>
            </div>
        </div>
        
        <p class="text-gray-600 dark:text-gray-400 mb-6">
            We're sorry to see you go. You will no longer receive newsletter emails from us.
        </p>
        
        <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
            <h3 class="font-bold text-blue-800 dark:text-blue-300 mb-2">Changed your mind?</h3>
            <p class="text-sm text-blue-700 dark:text-blue-400 mb-4">
                You can resubscribe at any time by visiting our newsletter page.
            </p>
            <a href="{{ route('newsletter') }}" class="inline-flex items-center text-primary hover:underline">
                <span class="material-symbols-outlined mr-1">replay</span>
                Resubscribe
            </a>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 bg-brand-dark text-white rounded-lg hover:bg-opacity-90 transition">
                <span class="material-symbols-outlined mr-2">home</span>
                Return to Homepage
            </a>
        </div>
        
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-8">
            If you have any feedback about our newsletter, please <a href="{{ route('contact') }}" class="text-primary hover:underline">contact us</a>.
        </p>
    </div>
</div>
@endsection