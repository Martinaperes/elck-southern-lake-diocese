@extends('layouts.app')

@section('title', $ministry->name . ' - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 md:px-8">

        {{-- Ministry Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-800 mb-3">{{ $ministry->name }}</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover more about the {{ $ministry->name }} — its mission, vision, and how you can get involved.
            </p>
        </div>

        {{-- Dynamic Ministry Content --}}
        @if($ministry->slug == 'youth-ministry')
            @include('ministries.partials.youth')

        @elseif($ministry->slug == 'womens-ministry')
            @include('ministries.partials.women')

        @elseif($ministry->slug == 'mens-ministry')
            @include('ministries.partials.men')

        @elseif($ministry->slug == 'childrens-ministry')
            @include('ministries.partials.sunday')

        @elseif($ministry->slug == 'worship-and-liturgy-ministry')
            @include('ministries.partials.choir')

        @elseif($ministry->slug == 'orphan-and-vulnerable-children-programs')
            @include('ministries.partials.ovc')

        @elseif($ministry->slug == 'relief-and-development-ministry')
            @include('ministries.partials.relief')

        @elseif($ministry->slug == 'elck-malaria-campaign')
            @include('ministries.partials.malaria')

        @elseif($ministry->slug == 'adult-literacy-programs')
            @include('ministries.partials.literacy')

        @elseif($ministry->slug == 'clergy-and-lay-leader-training')
            @include('ministries.partials.training')

        @elseif($ministry->slug == 'evangelism-and-tree-planting-ministry')
            @include('ministries.partials.evangelism')

        @elseif($ministry->slug == 'hiv-and-aids-ministry')
            @include('ministries.partials.hiv')

        @else
            <div class="text-center py-20 text-gray-600">
                <p>Details for this ministry will be added soon.</p>
            </div>
        @endif

        {{-- Related Ministries --}}
        @if(isset($relatedMinistries) && $relatedMinistries->isNotEmpty())
        <div class="mt-20">
            <h2 class="text-3xl font-semibold text-center text-blue-800 mb-8">Explore Other Ministries</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedMinistries as $related)
                    <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition">
                        <img src="{{ asset('images/ministries/' . $related->slug . '.jpg') }}" 
                             alt="{{ $related->name }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $related->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit($related->description, 90, '...') }}
                            </p>
                            <a href="{{ route('ministries.show', $related->slug) }}" 
                               class="text-blue-600 hover:text-blue-800 font-semibold">
                               Learn More →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="mt-8 text-center">
    <a href="{{ route('ministries.subscribe', $ministry->slug) }}" 
       class="inline-block px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-lg hover:bg-yellow-500 transition">
       Join This Ministry
    </a>
</div>

        {{-- Back Button --}}
        <div class="text-center mt-16">
            <a href="{{ route('ministries.index') }}" 
               class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
               ← Back to Ministries
            </a>
        </div>

    </div>
</section>
@endsection
