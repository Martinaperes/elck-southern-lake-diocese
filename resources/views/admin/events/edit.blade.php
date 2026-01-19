@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 bg-background-light dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 p-4">
        <div class="flex items-center">
            <a href="{{ route('admin.events.index') }}" class="mr-4">
                <span class="material-symbols-outlined text-primary">arrow_back</span>
            </a>
            <h1 class="text-xl font-bold text-slate-900 dark:text-white">Edit Event: {{ $event->title }}</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-6 pb-24">
        @csrf
        @method('PUT')
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Event Title -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Event Title *</label>
            <input type="text" name="title" required
                   class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                   placeholder="Enter event title" 
                   value="{{ old('title', $event->title) }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Type -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Event Type *</label>
            <select name="event_type" required
                    class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white">
                <option value="service" {{ old('event_type', $event->event_type) == 'service' ? 'selected' : '' }}>Church Service</option>
                <option value="meeting" {{ old('event_type', $event->event_type) == 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="conference" {{ old('event_type', $event->event_type) == 'conference' ? 'selected' : '' }}>Conference</option>
                <option value="workshop" {{ old('event_type', $event->event_type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="other" {{ old('event_type', $event->event_type) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('event_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date & Time -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Start Date *</label>
                <input type="date" name="start_date" required
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('start_date', $event->start_time->format('Y-m-d')) }}">
                @error('start_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Start Time *</label>
                <input type="time" name="start_time" required
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('start_time', $event->start_time->format('H:i')) }}">
                @error('start_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">End Date</label>
                <input type="date" name="end_date"
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('end_date', $event->end_time ? $event->end_time->format('Y-m-d') : '') }}">
                @error('end_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">End Time</label>
                <input type="time" name="end_time"
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('end_time', $event->end_time ? $event->end_time->format('H:i') : '') }}">
                @error('end_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Location *</label>
            <input type="text" name="location" required
                   class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                   placeholder="Enter location" 
                   value="{{ old('location', $event->location) }}">
            @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ministry -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Ministry (Optional)</label>
            <select name="ministry_id"
                    class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white">
                <option value="">Select Ministry</option>
                @foreach($ministries as $ministry)
                    <option value="{{ $ministry->id }}" 
                        {{ old('ministry_id', $event->ministry_id) == $ministry->id ? 'selected' : '' }}>
                        {{ $ministry->name }}
                    </option>
                @endforeach
            </select>
            @error('ministry_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                      placeholder="Event description...">{{ old('description', $event->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Current Poster -->
        @if($event->poster)
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Current Poster</label>
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $event->poster) }}" 
                         alt="{{ $event->title }} poster" 
                         class="w-32 h-32 object-cover rounded-lg">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="remove_poster" value="1" class="mr-2">
                            <span class="text-sm text-slate-600 dark:text-slate-400">Remove current poster</span>
                        </label>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            Check this to remove the current poster
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- New Poster -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                {{ $event->poster ? 'Replace Poster' : 'Poster (Optional)' }}
            </label>
            <input type="file" name="poster" accept="image/*"
                   class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg">
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Max file size: 5MB. Allowed formats: JPG, PNG, GIF, WebP
                @if($event->poster)
                    <br>Leave empty to keep current poster
                @endif
            </p>
            @error('poster')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Settings -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-slate-900 dark:text-white">Public Event</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Visible to all members</p>
                </div>
                <input type="hidden" name="is_public" value="0">
                <input type="checkbox" name="is_public" value="1" 
                       {{ old('is_public', $event->is_public) ? 'checked' : '' }}
                       class="h-5 w-5 rounded border-slate-300 text-primary">
            </div>
            @error('is_public')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-800">
            <div class="flex space-x-3">
                <a href="{{ route('admin.events.index') }}" 
                   class="px-6 py-3 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    Cancel
                </a>
                
                <button type="button" 
                        onclick="if(confirm('Are you sure you want to delete this event?')) { document.getElementById('delete-form').submit(); }"
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete Event
                </button>
            </div>
            
            <button type="submit" 
                    class="px-6 py-3 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Update Event
            </button>
        </div>
    </form>

    <!-- Delete Form (Hidden) -->
    <form id="delete-form" action="{{ route('admin.events.destroy', $event) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
// File size validation
document.querySelector('input[name="poster"]')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const maxSize = 5 * 1024 * 1024; // 5MB in bytes
    
    if (file && file.size > maxSize) {
        alert('File is too large! Maximum size is 5MB.');
        e.target.value = '';
    }
});
</script>
@endsection