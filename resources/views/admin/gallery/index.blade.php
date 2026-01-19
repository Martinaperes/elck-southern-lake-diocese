@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 bg-background-dark border-b border-white/10 p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="mr-4 text-white">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
                <h1 class="text-lg font-bold text-white leading-tight tracking-tight">Media Gallery</h1>
            </div>
            <div class="flex items-center space-x-2">
                <!-- Search Bar -->
                <form action="{{ route('admin.gallery.index') }}" method="GET" class="flex-1 max-w-xs">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-white/50 text-[20px]">search</span>
                        </div>
                        <input type="text" name="search" 
                               value="{{ request('search') }}"
                               class="pl-10 pr-4 py-2 w-full rounded-lg bg-white/10 border-0 text-white placeholder:text-white/40 text-sm focus:ring-0 focus:outline-none"
                               placeholder="Search gallery images...">
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories Filter Chips -->
        @php
            $categories = ['All', 'Youth', 'Sunday Service', 'Outreach', 'Missions', 'Conferences'];
        @endphp
        <div class="flex gap-2 mt-4 overflow-x-auto hide-scrollbar">
            @foreach($categories as $category)
                <a href="{{ route('admin.gallery.index', ['category' => $category == 'All' ? '' : strtolower($category)]) }}"
                   class="flex h-8 shrink-0 items-center justify-center rounded-full px-4 border transition-colors
                          {{ (request('category') == strtolower($category) || ($category == 'All' && !request('category'))) 
                             ? 'bg-primary text-white border-primary' 
                             : 'bg-white/10 text-white/80 border-white/5 hover:bg-white/20' }}">
                    <p class="text-xs font-medium leading-normal">{{ $category }}</p>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="p-4">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Total Images</p>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $totalGalleries }}</h3>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">
                            photo_library
                        </span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl p-4 shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Active</p>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $activeGalleries }}</h3>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">
                            check_circle
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Grid -->
    @if($galleries->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 px-4">
            <div class="w-24 h-24 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-600">
                    photo_library
                </span>
            </div>
            <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-2">No Images Yet</h3>
            <p class="text-slate-600 dark:text-slate-400 text-center mb-6">
                Start building your gallery by adding some images
            </p>
            <a href="{{ route('admin.gallery.create') }}" 
               class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 shadow-lg shadow-primary/20 flex items-center">
                <span class="material-symbols-outlined mr-2">add</span>
                Add First Image
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 gap-3 p-4">
            @foreach($galleries as $gallery)
                <div class="relative group aspect-[4/5] rounded-xl overflow-hidden shadow-lg bg-white/5 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                    <!-- Image -->
                    <div class="absolute inset-0 bg-cover bg-center" 
                         style="background-image: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 50%), url('{{ asset($gallery->image_url) }}');">
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="absolute top-2 left-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            {{ $gallery->is_active 
                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' 
                                : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                            {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="absolute top-2 right-2 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}" 
                           class="size-8 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center hover:bg-primary transition-colors border border-white/10">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>
                        
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" 
                              onsubmit="return confirm('Delete this image?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="size-8 rounded-full bg-black/40 backdrop-blur-md text-red-400 flex items-center justify-center hover:bg-red-900 transition-colors border border-white/10">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Image Info -->
                    <div class="absolute bottom-3 left-3 right-3">
                        <p class="text-white text-sm font-bold truncate">{{ $gallery->title }}</p>
                        <p class="text-white/60 text-[10px] uppercase tracking-wider font-medium">
                            {{ $gallery->created_at->format('M d, Y') }}
                        </p>
                        @if($gallery->description)
                            <p class="text-white/70 text-xs mt-1 truncate">{{ $gallery->description }}</p>
                        @endif
                    </div>
                    
                    <!-- Toggle Active Button -->
                    <form action="{{ route('admin.gallery.toggle-active', $gallery) }}" method="POST" class="absolute bottom-2 right-2">
                        @csrf
                        <button type="submit" 
                                class="size-8 rounded-full bg-black/40 backdrop-blur-md flex items-center justify-center border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-[18px] 
                                {{ $gallery->is_active ? 'text-green-400' : 'text-slate-400' }}">
                                {{ $gallery->is_active ? 'toggle_on' : 'toggle_off' }}
                            </span>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($galleries->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                {{ $galleries->links() }}
            </div>
        @endif
    @endif
</div>

<!-- Floating Action Button -->
<a href="{{ route('admin.gallery.create') }}" 
   class="fixed bottom-6 right-6 z-50 flex size-14 items-center justify-center rounded-full bg-primary text-white shadow-xl shadow-primary/20 hover:bg-primary/90 active:scale-95 transition-transform">
    <span class="material-symbols-outlined text-[32px]">add</span>
</a>

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection