@extends('admin.layouts.app')

@section('title', 'Sermons Management')

@section('content')
<div class="p-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-4 bg-[#197b3b] bg-opacity-10 border border-[#197b3b] text-[#197b3b] px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-900 bg-opacity-10 border border-red-900 text-red-900 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">Sermons Management</h1>
                <p class="text-gray-300 mt-1">Upload and manage sermons, scriptures, and spiritual content</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <a href="{{ route('admin.sermons.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Upload Sermon
                </a>
                <button type="button"
                        onclick="openScriptureModal()"
                        class="inline-flex items-center px-6 py-3 bg-black hover:bg-gray-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-bible mr-2"></i>
                    Add Scripture
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-church text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Sermons</p>
                    <p class="text-2xl font-bold text-black">{{ $totalSermons }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-broadcast-tower text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Published</p>
                    <p class="text-2xl font-bold text-black">{{ $publishedSermons }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-user-tie text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Unique Preachers</p>
                    <p class="text-2xl font-bold text-black">{{ $uniquePreachers ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-alt text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-black">{{ $thisMonthSermons }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Current Scripture of the Week (Using featured field) -->
@if(isset($currentWeekScripture) && $currentWeekScripture)
<div class="bg-gradient-to-r from-yellow-50 to-yellow-100 border border-yellow-200 rounded-2xl shadow-lg mb-8 overflow-hidden">
    <div class="px-6 py-4 bg-yellow-500">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-yellow-900">
                <i class="fas fa-star mr-2"></i>Current Scripture of the Week
            </h2>
            <span class="text-sm bg-yellow-800 text-yellow-100 px-3 py-1 rounded-full">
                For Spiritual Nourishment
            </span>
        </div>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <h3 class="font-bold text-yellow-800 text-2xl mb-2">
                    {{ $currentWeekScripture->title }}
                </h3>
                
                <div class="mb-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm font-medium">
                            <i class="fas fa-bible mr-1"></i>
                            {{ $currentWeekScripture->formatted_scriptures }}
                        </span>
                    </div>
                    
                    @if($currentWeekScripture->description)
                    <div class="bg-white p-4 rounded-lg border border-yellow-200 mb-4">
                        <p class="text-gray-800">{{ $currentWeekScripture->description }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="flex space-x-4">
                    @if($currentWeekScripture->video_url)
                    <a href="{{ $currentWeekScripture->video_url }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                        <i class="fab fa-youtube mr-2"></i> Watch Video
                    </a>
                    @endif
                    
                    @if($currentWeekScripture->audio_url)
                    <a href="{{ $currentWeekScripture->audio_url }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-headphones mr-2"></i> Listen Audio
                    </a>
                    @endif
                    
                    @if($currentWeekScripture->document_url)
                    <a href="{{ $currentWeekScripture->document_url }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i> View Notes
                    </a>
                    @endif
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-600">Preacher</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $currentWeekScripture->preacher }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Date</p>
                    <p class="text-gray-900">{{ $currentWeekScripture->sermon_date->format('F j, Y') }}</p>
                </div>
                
                @if($currentWeekScripture->duration_minutes)
                <div>
                    <p class="text-sm text-gray-600">Duration</p>
                    <p class="text-gray-900">{{ $currentWeekScripture->duration_formatted }}</p>
                </div>
                @endif
                
                <div class="pt-4">
                    <form action="{{ route('admin.sermons.toggle-featured', $currentWeekScripture) }}" 
                          method="POST" 
                          class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors">
                            <i class="fas fa-star mr-2"></i>
                            Remove from Featured
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.sermons.edit', $currentWeekScripture) }}"
                       class="inline-flex items-center px-4 py-2 ml-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

    <!-- Current Week's Sermon -->
    @php
        $currentWeekSermon = \App\Models\Sermon::isCurrentWeek()->published()->first();
    @endphp
    
    @if($currentWeekSermon)
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
        <div class="bg-[#197b3b] px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-star mr-2"></i>This Week's Sermon
                </h2>
                <span class="text-sm bg-white bg-opacity-20 px-3 py-1 rounded-full">
                    Featured
                </span>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Media Preview -->
                <div class="lg:col-span-2">
                    @if($currentWeekSermon->video_url)
                        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-black">
                            <iframe src="{{ $currentWeekSermon->video_url }}" 
                                    class="w-full h-full"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    @elseif($currentWeekSermon->audio_url)
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <div class="flex items-center justify-center">
                                <div class="w-24 h-24 bg-[#197b3b] bg-opacity-10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-headphones-alt text-[#197b3b] text-3xl"></i>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <audio controls class="w-full">
                                    <source src="{{ $currentWeekSermon->audio_url }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-12 text-center border border-gray-200">
                            <i class="fas fa-bible text-gray-300 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700">Scripture Focus</h3>
                        </div>
                    @endif
                </div>
                
                <!-- Sermon Details -->
                <div>
                    <h3 class="font-bold text-black text-2xl mb-2">{{ $currentWeekSermon->title }}</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Preacher</p>
                            <p class="text-lg font-semibold text-black">{{ $currentWeekSermon->preacher }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600">Date</p>
                            <p class="text-black">{{ $currentWeekSermon->sermon_date->format('F j, Y') }}</p>
                        </div>
                        
                        @if($currentWeekSermon->scripture_references)
                        <div>
                            <p class="text-sm text-gray-600">Scripture References</p>
                            <p class="text-black font-medium">{{ $currentWeekSermon->formatted_scriptures }}</p>
                        </div>
                        @endif
                        
                        @if($currentWeekSermon->duration_minutes)
                        <div>
                            <p class="text-sm text-gray-600">Duration</p>
                            <p class="text-black">{{ $currentWeekSermon->duration_formatted }}</p>
                        </div>
                        @endif
                        
                        <div class="pt-4">
                            <a href="{{ route('admin.sermons.show', $currentWeekSermon) }}"
                               class="inline-flex items-center px-4 py-2 bg-black hover:bg-gray-800 text-white font-medium rounded-lg transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Search and Filter Bar -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <!-- Search Box -->
            <div class="flex-1">
                <div class="relative max-w-md">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search sermons by title, preacher, or scripture..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                           onkeyup="filterSermons()">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <!-- Filter Buttons -->
            <div class="flex space-x-3">
                <select id="statusFilter" 
                        class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] text-black"
                        onchange="filterSermons()">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                
                <button onclick="resetFilters()"
                        class="px-4 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    <i class="fas fa-redo-alt mr-2"></i> Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Sermons Table -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-black to-gray-800 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">All Sermons</h2>
        </div>
        
        <div class="p-6">
            @if($sermons->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-bible text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Sermons Found</h3>
                    <p class="text-gray-500 mb-6">You haven't uploaded any sermons yet.</p>
                    <a href="{{ route('admin.sermons.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Upload First Sermon
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Sermon
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Preacher & Date
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Scriptures
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Media
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="sermonsTableBody">
                            @foreach($sermons as $sermon)
                            <tr class="sermon-row hover:bg-gray-50 transition-colors"
                                data-title="{{ strtolower($sermon->title) }}"
                                data-preacher="{{ strtolower($sermon->preacher) }}"
                                data-scriptures="{{ strtolower($sermon->scripture_references ?? '') }}"
                                data-status="{{ $sermon->is_published ? 'published' : 'draft' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#197b3b] to-green-700 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-church text-white"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-black">{{ $sermon->title }}</div>
                                            <div class="text-sm text-gray-500 truncate max-w-xs">
                                                {{ $sermon->description ? \Illuminate\Support\Str::limit($sermon->description, 50) : 'No description' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-black">{{ $sermon->preacher }}</div>
                                    <div class="text-sm text-gray-500">{{ $sermon->sermon_date->format('M d, Y') }}</div>
                                    @if($sermon->duration_minutes)
                                    <div class="text-xs text-gray-400">{{ $sermon->duration_formatted }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-black">
                                        @if($sermon->scripture_references)
                                            {{ \Illuminate\Support\Str::limit($sermon->formatted_scriptures, 40) }}
                                        @else
                                            <span class="text-gray-400">No scriptures</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        @if($sermon->video_url)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-video mr-1"></i> Video
                                            </span>
                                        @endif
                                        @if($sermon->audio_url)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-headphones mr-1"></i> Audio
                                            </span>
                                        @endif
                                        @if($sermon->document_url)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-file-alt mr-1"></i> Document
                                            </span>
                                        @endif
                                        @if(!$sermon->video_url && !$sermon->audio_url && !$sermon->document_url)
                                            <span class="text-gray-400 text-xs">No media</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($sermon->is_published)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#197b3b] bg-opacity-10 text-[#197b3b] border border-[#197b3b] border-opacity-20">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                <i class="fas fa-pencil-alt mr-1 text-xs"></i>
                                                Draft
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.sermons.show', $sermon) }}"
                                           class="text-[#197b3b] hover:text-[#15632f] transition-colors"
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.sermons.edit', $sermon) }}"
                                           class="text-black hover:text-gray-800 transition-colors"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Publish/Unpublish Toggle -->
<form action="{{ route('admin.sermons.toggle-publish', $sermon) }}" 
      method="POST" 
      class="inline"
      onsubmit="return confirm('{{ $sermon->is_published ? 'Unpublish this sermon? It will be hidden from members.' : 'Publish this sermon? It will be visible to members.' }}')">
    @csrf
    <button type="submit"
            class="text-yellow-600 hover:text-yellow-800 transition-colors"
            title="{{ $sermon->is_published ? 'Unpublish' : 'Publish' }}">
        <i class="fas {{ $sermon->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
    </button>
</form>
                                        
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.sermons.destroy', $sermon) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this sermon? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-900 hover:text-red-700 transition-colors"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $sermons->links() }}
                </div>
                
                <!-- Results Count -->
                <div class="mt-4 text-sm text-gray-500">
                    Showing {{ $sermons->firstItem() }} to {{ $sermons->lastItem() }} of {{ $sermons->total() }} sermons
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Quick Scripture Modal -->
<div id="scriptureModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-black">Add Scripture Focus</h3>
            <button type="button" onclick="closeScriptureModal()" class="text-gray-500 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Scrollable Content Area -->
        <div class="flex-grow overflow-y-auto pr-2 mb-4">
            <form id="quickSermonForm" method="POST" action="{{ route('admin.sermons.store') }}">
                @csrf
                <div class="space-y-6">
                    <!-- Scripture Focus Title -->
                    <div>
                        <label for="quick_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Scripture Title *
                        </label>
                        <input type="text" 
                               name="title" 
                               id="quick_title"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="e.g., Faith in Difficult Times">
                    </div>
                    
                    <!-- Scripture References -->
                    <div>
                        <label for="quick_scripture_references" class="block text-sm font-medium text-gray-700 mb-2">
                            Scripture References *
                        </label>
                        <input type="text" 
                               name="scripture_references" 
                               id="quick_scripture_references"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="e.g., Romans 8:28, Philippians 4:13, Jeremiah 29:11">
                        <p class="mt-1 text-xs text-gray-500">Separate multiple scriptures with commas</p>
                    </div>
                    
                    <!-- Preacher -->
                    <div>
                        <label for="quick_preacher" class="block text-sm font-medium text-gray-700 mb-2">
                            Shared By
                        </label>
                        <input type="text" 
                               name="preacher" 
                               id="quick_preacher"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="e.g., Pastor John, Ministry Leader">
                    </div>
                    
                    <!-- Description -->
                    <div>
                        <label for="quick_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Reflection/Notes
                        </label>
                        <textarea name="description" 
                                  id="quick_description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                  placeholder="Share insights or reflections on this scripture..."></textarea>
                    </div>
                    
                    <!-- Quick Publish -->
                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <input type="checkbox" 
                               name="is_published" 
                               id="quick_is_published"
                               value="1"
                               checked
                               class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                        <div class="ml-3">
                            <label for="quick_is_published" class="text-sm font-medium text-gray-700">
                                Publish Immediately
                            </label>
                            <p class="text-xs text-gray-500">Visible to members on the website</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Buttons at Bottom -->
        <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeScriptureModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        form="quickSermonForm"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-bible mr-2"></i>
                    Save Scripture
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Scripture Modal Functions
function openScriptureModal() {
    document.getElementById('scriptureModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    // Set today's date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('quick_sermon_date').value = today;
}

function closeScriptureModal() {
    document.getElementById('scriptureModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Filter Functions
function filterSermons() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.sermon-row');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const title = row.getAttribute('data-title');
        const preacher = row.getAttribute('data-preacher');
        const scriptures = row.getAttribute('data-scriptures');
        const status = row.getAttribute('data-status');
        
        const matchesSearch = !searchTerm || 
                             title.includes(searchTerm) || 
                             preacher.includes(searchTerm) || 
                             scriptures.includes(searchTerm);
        
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filterSermons();
}

// Quick form validation
document.getElementById('quickSermonForm')?.addEventListener('submit', function(e) {
    const title = document.getElementById('quick_title').value;
    const scriptures = document.getElementById('quick_scripture_references').value;
    
    if (!title.trim()) {
        e.preventDefault();
        alert('Please enter a scripture title.');
        document.getElementById('quick_title').focus();
        return false;
    }
    
    if (!scriptures.trim()) {
        e.preventDefault();
        alert('Please enter at least one scripture reference.');
        document.getElementById('quick_scripture_references').focus();
        return false;
    }
    
    // Show loading indicator
    const submitBtn = document.querySelector('[form="quickSermonForm"]');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
        submitBtn.disabled = true;
    }
    
    return true;
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeScriptureModal();
    }
});

// Close modals when clicking outside
const modals = document.querySelectorAll('.fixed.inset-0');
modals.forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            if (this.id === 'scriptureModal') {
                closeScriptureModal();
            }
        }
    });
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus search if there's a search parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search')) {
        document.getElementById('searchInput').value = urlParams.get('search');
        filterSermons();
    }
    
    if (urlParams.has('status')) {
        document.getElementById('statusFilter').value = urlParams.get('status');
        filterSermons();
    }
});
</script>

<style>
.fixed.inset-0 {
    backdrop-filter: blur(4px);
}

.aspect-w-16 {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
}

.aspect-w-16 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>
@endsection