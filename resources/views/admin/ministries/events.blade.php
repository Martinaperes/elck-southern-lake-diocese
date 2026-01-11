@extends('admin.layouts.app')

@section('title', $ministry->name . ' - Events')

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

    @if($errors->any())
        <div class="mb-4 bg-red-900 bg-opacity-10 border border-red-900 text-red-900 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.ministries.show', $ministry) }}" 
                   class="inline-flex items-center px-4 py-2 text-black hover:text-[#197b3b] bg-white border border-black hover:border-[#197b3b] rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Ministry
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $ministry->name }} - Events</h1>
                    <p class="text-gray-300 mt-1">Manage ministry events and registrations</p>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-4 md:mt-0">
                <button type="button"
                        onclick="openCreateEventModal()"
                        class="inline-flex items-center px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Create Event
                </button>
                <button type="button"
                        onclick="openRegisterForEventModal()"
                        class="inline-flex items-center px-6 py-3 bg-black hover:bg-gray-900 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register for Event
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-alt text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Events</p>
                    <p class="text-2xl font-bold text-black">{{ $events->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Upcoming Events</p>
                    <p class="text-2xl font-bold text-black">{{ $upcomingEvents->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-users text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Registrations</p>
                    <p class="text-2xl font-bold text-black">
                        {{ $events->sum('registrations_count') }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-[#197b3b] bg-opacity-10 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-chart-line text-[#197b3b] text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-black">
                        {{ $events->where('start_time', '>=', now()->startOfMonth())->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events Section -->
    @if($upcomingEvents->count() > 0)
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
        <div class="bg-[#197b3b] px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Upcoming Events</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($upcomingEvents as $event)
                <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 hover:border-[#197b3b]">
                    @if($event->poster)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ Storage::url($event->poster) }}" 
                                 alt="{{ $event->title }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                    
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-black text-lg truncate">{{ $event->title }}</h3>
                            @php
                                $badgeClass = 'bg-[#197b3b] bg-opacity-10 text-[#197b3b] border border-[#197b3b] border-opacity-20';
                                if($event->event_type === 'service') {
                                    $badgeClass = 'bg-black bg-opacity-10 text-black border border-black border-opacity-20';
                                } elseif($event->event_type === 'conference') {
                                    $badgeClass = 'bg-[#197b3b] bg-opacity-20 text-[#197b3b] border border-[#197b3b] border-opacity-30';
                                } elseif($event->event_type === 'workshop') {
                                    $badgeClass = 'bg-gray-800 bg-opacity-10 text-gray-800 border border-gray-800 border-opacity-20';
                                }
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">
                                {{ ucfirst($event->event_type) }}
                            </span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-700">
                                <i class="far fa-clock mr-2 text-[#197b3b]"></i>
                                {{ $event->start_time->format('M d, Y h:i A') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-map-marker-alt mr-2 text-[#197b3b]"></i>
                                {{ $event->location ?? 'TBA' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-users mr-2 text-[#197b3b]"></i>
                                {{ $event->registrations_count ?? 0 }} registered
                            </div>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.events.registrations', $event) }}"
                               class="flex-1 text-center px-3 py-2 bg-[#197b3b] hover:bg-[#15632f] text-white text-sm font-medium rounded-lg transition-colors">
                                View Registrations
                            </a>
                            <button type="button"
                                    onclick="openEditEventModal({{ $event->id }})"
                                    class="px-3 py-2 bg-black hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Events Table -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="bg-black px-6 py-4">
            <h2 class="text-xl font-semibold text-white">All Events</h2>
        </div>
        
        <div class="p-6">
            @if($events->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Events Found</h3>
                    <p class="text-gray-500 mb-6">This ministry doesn't have any events yet.</p>
                    <button type="button"
                            onclick="openCreateEventModal()"
                            class="inline-flex items-center px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Create First Event
                    </button>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Event
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Date & Time
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Location
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Registrations
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($events as $event)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($event->poster)
                                            <img src="{{ Storage::url($event->poster) }}" 
                                                 alt="{{ $event->title }}"
                                                 class="w-12 h-12 object-cover rounded-lg mr-3 border border-gray-200">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-3 border border-gray-200">
                                                <i class="fas fa-calendar-alt text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold text-black">{{ $event->title }}</div>
                                            <div class="text-sm text-gray-600 truncate max-w-xs">{{ $event->description ? \Illuminate\Support\Str::limit($event->description, 50) : 'No description' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-black">{{ $event->start_time->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-600">{{ $event->start_time->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $badgeClass = 'bg-[#197b3b] bg-opacity-10 text-[#197b3b] border border-[#197b3b] border-opacity-20';
                                        if($event->event_type === 'service') {
                                            $badgeClass = 'bg-black bg-opacity-10 text-black border border-black border-opacity-20';
                                        } elseif($event->event_type === 'conference') {
                                            $badgeClass = 'bg-[#197b3b] bg-opacity-20 text-[#197b3b] border border-[#197b3b] border-opacity-30';
                                        } elseif($event->event_type === 'workshop') {
                                            $badgeClass = 'bg-gray-800 bg-opacity-10 text-gray-800 border border-gray-800 border-opacity-20';
                                        }
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                        {{ ucfirst($event->event_type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                    {{ $event->location ?? 'TBA' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-black">{{ $event->registrations_count ?? 0 }}</div>
                                    <div class="text-xs text-gray-600">registrations</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($event->start_time->isPast())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-900 bg-opacity-10 text-red-900 border border-red-900 border-opacity-20">
                                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                                            Completed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#197b3b] bg-opacity-10 text-[#197b3b] border border-[#197b3b] border-opacity-20">
                                            <i class="fas fa-clock mr-1 text-xs"></i>
                                            Upcoming
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.events.registrations', $event) }}"
                                           class="text-[#197b3b] hover:text-[#15632f] transition-colors"
                                           title="View Registrations">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <button type="button"
                                                onclick="openEditEventModal({{ $event->id }})"
                                                class="text-black hover:text-gray-800 transition-colors"
                                                title="Edit Event">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.events.destroy', $event) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this event? This will also delete all registrations.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-900 hover:text-red-700 transition-colors"
                                                    title="Delete Event">
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
                    {{ $events->links() }}
                </div>
                
                <!-- Results Count -->
                <div class="mt-4 text-sm text-gray-600">
                    Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} events
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Create Event Modal -->
<div id="createEventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-black">Create New Event for {{ $ministry->name }}</h3>
            <button type="button" onclick="closeCreateEventModal()" class="text-gray-500 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Scrollable Content Area -->
        <div class="flex-grow overflow-y-auto pr-2 mb-4">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="createEventForm">
                @csrf
                <input type="hidden" name="ministry_id" value="{{ $ministry->id }}">
                
                <div class="space-y-6">
                    <!-- Event Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Event Title *
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                               placeholder="e.g., Youth Sunday Service, Leadership Meeting">
                    </div>
                    
                    <!-- Event Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                  placeholder="Describe the event purpose, agenda, etc..."></textarea>
                    </div>
                    
                    <!-- Date & Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Start Date & Time *
                            </label>
                            <input type="datetime-local" 
                                   name="start_time" 
                                   id="start_time"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                        </div>
                        
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                                End Date & Time (Optional)
                            </label>
                            <input type="datetime-local" 
                                   name="end_time" 
                                   id="end_time"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                        </div>
                    </div>
                    
                    <!-- Location & Type -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Location *
                            </label>
                            <input type="text" 
                                   name="location" 
                                   id="location"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                   placeholder="e.g., Main Sanctuary, Conference Room">
                        </div>
                        
                        <div>
                            <label for="event_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Event Type *
                            </label>
                            <select name="event_type" 
                                    id="event_type"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                                <option value="">Select Type</option>
                                <option value="service">Church Service</option>
                                <option value="meeting">Meeting</option>
                                <option value="conference">Conference</option>
                                <option value="workshop">Workshop</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Poster Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Event Poster (Optional)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-[#197b3b] transition-colors cursor-pointer"
                             onclick="document.getElementById('poster').click()">
                            <input type="file" 
                                   name="poster" 
                                   id="poster"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewPosterImage(this)">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-xl mb-2"></i>
                            <p class="text-gray-600 text-sm">Click to upload poster</p>
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF, WEBP (Max 5MB)</p>
                        </div>
                        
                        <!-- Poster Preview -->
                        <div id="posterPreview" class="hidden mt-4">
                            <div class="relative max-w-xs mx-auto">
                                <img id="posterPreviewImage" 
                                     class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                <button type="button" 
                                        onclick="removePosterPreview()"
                                        class="absolute top-2 right-2 bg-red-900 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-800 transition-colors text-xs">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 text-center">Poster preview</p>
                        </div>
                    </div>
                    
                    <!-- Event Visibility -->
                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <input type="checkbox" 
                               name="is_public" 
                               id="is_public"
                               value="1"
                               checked
                               class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                        <div class="ml-3">
                            <label for="is_public" class="text-sm font-medium text-gray-700">
                                Public Event
                            </label>
                            <p class="text-xs text-gray-500">Visible to all members on the website</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Buttons at Bottom -->
        <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeCreateEventModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        form="createEventForm"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Create Event
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Register for Event Modal -->
<div id="registerForEventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-black">Register Ministry for Event</h3>
            <button type="button" onclick="closeRegisterForEventModal()" class="text-gray-500 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Scrollable Content Area -->
        <div class="flex-grow overflow-y-auto pr-2 mb-4">
            <form action="{{ route('admin.ministries.register-for-event', $ministry) }}" method="POST" id="registerForEventForm">
                @csrf
                
                <div class="space-y-6">
                    <!-- Event Selection -->
                    <div>
                        <label for="event_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Event *
                        </label>
                        <select name="event_id" 
                                id="event_id"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                            <option value="">Select an event...</option>
                            @foreach(\App\Models\Event::where('start_time', '>=', now())->orderBy('start_time')->get() as $availableEvent)
                                <option value="{{ $availableEvent->id }}">
                                    {{ $availableEvent->title }} - {{ $availableEvent->start_time->format('M d, Y h:i A') }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            All active ministry members will be registered for this event
                        </p>
                    </div>
                    
                    <!-- Guest Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="number_of_guests" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of Guests (Optional)
                            </label>
                            <input type="number" 
                                   name="number_of_guests" 
                                   id="number_of_guests"
                                   min="0"
                                   value="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                            <p class="mt-1 text-sm text-gray-500">Additional guests per member</p>
                        </div>
                    </div>
                    
                    <!-- Special Requirements -->
                    <div>
                        <label for="special_requirements" class="block text-sm font-medium text-gray-700 mb-2">
                            Special Requirements (Optional)
                        </label>
                        <textarea name="special_requirements" 
                                  id="special_requirements" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                  placeholder="Any special requirements for the ministry..."></textarea>
                    </div>
                    
                    <!-- Summary -->
                    <div class="p-4 bg-[#197b3b] bg-opacity-5 border border-[#197b3b] border-opacity-20 rounded-lg">
                        <h4 class="font-medium text-[#197b3b] mb-2">Registration Summary</h4>
                        <div class="space-y-1 text-sm text-[#197b3b]">
                            <div class="flex justify-between">
                                <span>Ministry:</span>
                                <span class="font-medium">{{ $ministry->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Active Members:</span>
                                <span class="font-medium">{{ $ministry->members()->where('is_active', true)->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Will be registered:</span>
                                <span class="font-medium">{{ $ministry->members()->where('is_active', true)->count() }} members</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Buttons at Bottom -->
        <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <button type="button"
                        onclick="closeRegisterForEventModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        form="registerForEventForm"
                        class="px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register Ministry
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Event Modal (Now a proper modal) -->
<div id="editEventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-4 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-black">Edit Event</h3>
            <button type="button" onclick="closeEditEventModal()" class="text-gray-500 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Form will be loaded here via AJAX -->
        <div id="editEventContent" class="flex-grow overflow-y-auto pr-2 mb-4">
            <!-- Content loaded via JavaScript -->
        </div>
        
        <!-- Buttons will be added via JavaScript -->
    </div>
</div>

<script>
// Modal Functions
function openCreateEventModal() {
    document.getElementById('createEventModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    // Set default datetime to now
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    document.getElementById('start_time').value = `${year}-${month}-${day}T${hours}:${minutes}`;
}

function closeCreateEventModal() {
    document.getElementById('createEventModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function openRegisterForEventModal() {
    document.getElementById('registerForEventModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeRegisterForEventModal() {
    document.getElementById('registerForEventModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function openEditEventModal(eventId) {
    // Show loading state
    document.getElementById('editEventContent').innerHTML = `
        <div class="flex items-center justify-center h-32">
            <i class="fas fa-spinner fa-spin text-gray-400 text-xl"></i>
            <span class="ml-2 text-gray-600">Loading event details...</span>
        </div>
    `;
    
    // Load event data via AJAX
    fetch(`/admin/events/${eventId}/ajax-edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Build the edit form
                const formHtml = `
                    <form action="/admin/events/${eventId}" method="POST" enctype="multipart/form-data" id="editEventForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Event Title -->
                            <div>
                                <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Event Title *
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="edit_title"
                                       value="${escapeHtml(data.event.title)}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                       placeholder="e.g., Youth Sunday Service, Leadership Meeting">
                            </div>
                            
                            <!-- Event Description -->
                            <div>
                                <label for="edit_description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="edit_description" 
                                          rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                          placeholder="Describe the event purpose, agenda, etc...">${escapeHtml(data.event.description || '')}</textarea>
                            </div>
                            
                            <!-- Date & Time -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="edit_start_time" class="block text-sm font-medium text-gray-700 mb-2">
                                        Start Date & Time *
                                    </label>
                                    <input type="datetime-local" 
                                           name="start_time" 
                                           id="edit_start_time"
                                           value="${data.event.start_time_formatted}"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                                </div>
                                
                                <div>
                                    <label for="edit_end_time" class="block text-sm font-medium text-gray-700 mb-2">
                                        End Date & Time (Optional)
                                    </label>
                                    <input type="datetime-local" 
                                           name="end_time" 
                                           id="edit_end_time"
                                           value="${data.event.end_time_formatted || ''}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                                </div>
                            </div>
                            
                            <!-- Location & Type -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="edit_location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Location *
                                    </label>
                                    <input type="text" 
                                           name="location" 
                                           id="edit_location"
                                           value="${escapeHtml(data.event.location || '')}"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black"
                                           placeholder="e.g., Main Sanctuary, Conference Room">
                                </div>
                                
                                <div>
                                    <label for="edit_event_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Event Type *
                                    </label>
                                    <select name="event_type" 
                                            id="edit_event_type"
                                            required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#197b3b] focus:border-[#197b3b] transition-colors text-black">
                                        <option value="">Select Type</option>
                                        <option value="service" ${data.event.event_type === 'service' ? 'selected' : ''}>Church Service</option>
                                        <option value="meeting" ${data.event.event_type === 'meeting' ? 'selected' : ''}>Meeting</option>
                                        <option value="conference" ${data.event.event_type === 'conference' ? 'selected' : ''}>Conference</option>
                                        <option value="workshop" ${data.event.event_type === 'workshop' ? 'selected' : ''}>Workshop</option>
                                        <option value="other" ${data.event.event_type === 'other' ? 'selected' : ''}>Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Current Poster -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Poster
                                </label>
                                ${data.event.poster ? `
                                <div class="mb-3">
                                    <img src="/storage/${data.event.poster}" 
                                         alt="Current poster"
                                         class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                    <p class="text-xs text-gray-500 mt-1 text-center">Current poster</p>
                                </div>
                                ` : '<p class="text-gray-500 text-sm">No poster uploaded</p>'}
                                
                                <!-- New Poster Upload -->
                                <div class="mt-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Upload New Poster (Optional)
                                    </label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-[#197b3b] transition-colors cursor-pointer"
                                         onclick="document.getElementById('edit_poster').click()">
                                        <input type="file" 
                                               name="poster" 
                                               id="edit_poster"
                                               accept="image/*"
                                               class="hidden"
                                               onchange="previewEditPosterImage(this)">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-xl mb-2"></i>
                                        <p class="text-gray-600 text-sm">Click to upload new poster</p>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF, WEBP (Max 5MB)</p>
                                    </div>
                                    
                                    <!-- Edit Poster Preview -->
                                    <div id="editPosterPreview" class="hidden mt-4">
                                        <div class="relative max-w-xs mx-auto">
                                            <img id="editPosterPreviewImage" 
                                                 class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                            <button type="button" 
                                                    onclick="removeEditPosterPreview()"
                                                    class="absolute top-2 right-2 bg-red-900 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-800 transition-colors text-xs">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2 text-center">New poster preview</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Event Visibility -->
                            <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <input type="checkbox" 
                                       name="is_public" 
                                       id="edit_is_public"
                                       value="1"
                                       ${data.event.is_public ? 'checked' : ''}
                                       class="w-4 h-4 text-[#197b3b] border-gray-300 rounded focus:ring-[#197b3b] focus:ring-2">
                                <div class="ml-3">
                                    <label for="edit_is_public" class="text-sm font-medium text-gray-700">
                                        Public Event
                                    </label>
                                    <p class="text-xs text-gray-500">Visible to all members on the website</p>
                                </div>
                            </div>
                        </div>
                    </form>
                `;
                
                document.getElementById('editEventContent').innerHTML = formHtml;
                
                // Add buttons at bottom
                const buttonsHtml = `
                    <div class="flex-shrink-0 pt-4 mt-4 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                    onclick="closeEditEventModal()"
                                    class="px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium rounded-lg transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                    form="editEventForm"
                                    class="px-6 py-3 bg-[#197b3b] hover:bg-[#15632f] text-white font-semibold rounded-lg shadow-md transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update Event
                            </button>
                        </div>
                    </div>
                `;
                
                // Insert buttons after the form container
                const modalContainer = document.getElementById('editEventModal').querySelector('.flex-col');
                modalContainer.insertAdjacentHTML('beforeend', buttonsHtml);
                
                // Show the modal
                document.getElementById('editEventModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                
            } else {
                throw new Error(data.message || 'Failed to load event');
            }
        })
        .catch(error => {
            console.error('Error loading event:', error);
            document.getElementById('editEventContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-3"></i>
                    <p class="text-red-600">Error loading event details</p>
                    <p class="text-gray-500 text-sm mt-1">${error.message}</p>
                </div>
            `;
            document.getElementById('editEventModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
}

function closeEditEventModal() {
    document.getElementById('editEventModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    // Reset content for next time
    document.getElementById('editEventContent').innerHTML = '';
    // Remove buttons if they exist
    const buttons = document.querySelector('#editEventModal .flex-col > .flex-shrink-0');
    if (buttons) {
        buttons.remove();
    }
}

// Helper function to escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Image Preview Functions for Create Modal
function previewPosterImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('posterPreviewImage').src = e.target.result;
            document.getElementById('posterPreview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removePosterPreview() {
    document.getElementById('poster').value = '';
    document.getElementById('posterPreview').classList.add('hidden');
}

// Image Preview Functions for Edit Modal
function previewEditPosterImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('editPosterPreviewImage');
            const container = document.getElementById('editPosterPreview');
            if (preview && container) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeEditPosterPreview() {
    const input = document.getElementById('edit_poster');
    const container = document.getElementById('editPosterPreview');
    if (input && container) {
        input.value = '';
        container.classList.add('hidden');
    }
}

// Form Validation
document.getElementById('createEventForm')?.addEventListener('submit', function(e) {
    const title = document.getElementById('title').value;
    const startTime = document.getElementById('start_time').value;
    const location = document.getElementById('location').value;
    const eventType = document.getElementById('event_type').value;
    
    if (!title.trim()) {
        e.preventDefault();
        alert('Please enter an event title.');
        document.getElementById('title').focus();
        return false;
    }
    
    if (!startTime) {
        e.preventDefault();
        alert('Please select a start date and time.');
        document.getElementById('start_time').focus();
        return false;
    }
    
    if (!location.trim()) {
        e.preventDefault();
        alert('Please enter a location.');
        document.getElementById('location').focus();
        return false;
    }
    
    if (!eventType) {
        e.preventDefault();
        alert('Please select an event type.');
        document.getElementById('event_type').focus();
        return false;
    }
    
    // Show loading indicator
    const submitBtn = document.querySelector('[form="createEventForm"]');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
        submitBtn.disabled = true;
    }
    
    return true;
});

document.getElementById('registerForEventForm')?.addEventListener('submit', function(e) {
    const eventId = document.getElementById('event_id').value;
    
    if (!eventId) {
        e.preventDefault();
        alert('Please select an event.');
        document.getElementById('event_id').focus();
        return false;
    }
    
    // Show loading indicator
    const submitBtn = document.querySelector('[form="registerForEventForm"]');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Registering...';
        submitBtn.disabled = true;
    }
    
    return true;
});

// Edit form validation (will be attached dynamically)
document.addEventListener('submit', function(e) {
    if (e.target.id === 'editEventForm') {
        const title = document.getElementById('edit_title')?.value;
        const startTime = document.getElementById('edit_start_time')?.value;
        const location = document.getElementById('edit_location')?.value;
        const eventType = document.getElementById('edit_event_type')?.value;
        
        if (!title?.trim()) {
            e.preventDefault();
            alert('Please enter an event title.');
            document.getElementById('edit_title')?.focus();
            return false;
        }
        
        if (!startTime) {
            e.preventDefault();
            alert('Please select a start date and time.');
            document.getElementById('edit_start_time')?.focus();
            return false;
        }
        
        if (!location?.trim()) {
            e.preventDefault();
            alert('Please enter a location.');
            document.getElementById('edit_location')?.focus();
            return false;
        }
        
        if (!eventType) {
            e.preventDefault();
            alert('Please select an event type.');
            document.getElementById('edit_event_type')?.focus();
            return false;
        }
        
        // Show loading indicator
        const submitBtn = document.querySelector('[form="editEventForm"]');
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.disabled = true;
        }
        
        return true;
    }
});

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCreateEventModal();
        closeRegisterForEventModal();
        closeEditEventModal();
    }
});

// Close modals when clicking outside
const modals = document.querySelectorAll('.fixed.inset-0');
modals.forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            if (this.id === 'createEventModal') {
                closeCreateEventModal();
            } else if (this.id === 'registerForEventModal') {
                closeRegisterForEventModal();
            } else if (this.id === 'editEventModal') {
                closeEditEventModal();
            }
        }
    });
});

// Initialize date inputs
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date for event creation
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    document.getElementById('start_time').min = `${year}-${month}-${day}T${hours}:${minutes}`;
});
</script>

<style>
.fixed.inset-0 {
    backdrop-filter: blur(4px);
}

.hover\:scale-105:hover {
    transform: scale(1.05);
}

.transition-transform {
    transition-property: transform;
}
</style>
@endsection