@extends('layouts.app')

@section('title', 'ELCK Newsletter')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-green-50 dark:from-[#0d1b0d] dark:to-[#051405] text-gray-900 dark:text-gray-100 p-6 lg:p-12">

    <div class="max-w-6xl mx-auto">

        <!-- Welcome Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-4 leading-tight">
                Welcome to the ELCK Newsletter
            </h1>
            <p class="text-lg md:text-xl text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                Stay informed, encouraged, and spiritually nourished by our latest updates, sermons, and events.
            </p>
        </div>

        <!-- Dynamic Newsletter Sections -->
        <div class="space-y-12">
            @foreach($sections as $section)
            <div class="p-8 bg-white/90 dark:bg-[#1a2e1a]/90 rounded-3xl shadow-lg border border-green-200/30 dark:border-green-700/30">
                <h2 class="text-2xl md:text-3xl font-bold text-green-800 dark:text-green-300 mb-4">
                    {{ $section->title }}
                </h2>

                @if($section->image)
    <img 
        src="{{ Str::startsWith($section->image, ['http://','https://']) ? $section->image : asset('storage/' . $section->image) }}" 
        alt="{{ $section->title }}" 
        class="rounded-xl mb-4 w-full object-cover h-64">
@endif


                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg mb-4">
                    {!! nl2br(e($section->content)) !!}
                </p>

                @if($section->link)
                    <a href="{{ $section->link }}" class="inline-block mt-2 text-white font-semibold py-2 px-4 rounded-lg bg-[#197b3b] hover:bg-green-700 transition">
                        Read More
                    </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
