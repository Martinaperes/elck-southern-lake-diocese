@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 bg-background-light dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 p-4">
        <div class="flex items-center">
            <a href="{{ route('admin.events.index') }}" class="mr-4">
                <span class="material-symbols-outlined text-primary">arrow_back</span>
            </a>
            <h1 class="text-xl font-bold text-slate-900 dark:text-white">Schedule New Event</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-6 pb-24">
        @csrf
        
        <!-- Event Title -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Event Title *</label>
            <input type="text" name="title" required
                   class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                   placeholder="Enter event title" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Type -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Event Type *</label>
            <select name="event_type" required
                    class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white">
                <option value="service" {{ old('event_type') == 'service' ? 'selected' : '' }}>Church Service</option>
                <option value="meeting" {{ old('event_type') == 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="conference" {{ old('event_type') == 'conference' ? 'selected' : '' }}>Conference</option>
                <option value="workshop" {{ old('event_type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="other" {{ old('event_type') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <!-- Date & Time -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Start Date *</label>
                <input type="date" name="start_date" required
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('start_date', date('Y-m-d')) }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Start Time *</label>
                <input type="time" name="start_time" required
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('start_time', '09:00') }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">End Date</label>
                <input type="date" name="end_date"
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('end_date') }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">End Time</label>
                <input type="time" name="end_time"
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('end_time') }}">
            </div>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Location *</label>
            <input type="text" name="location" required
                   class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                   placeholder="Enter location" value="{{ old('location') }}">
        </div>

        <!-- Ministry -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Ministry (Optional)</label>
            <select name="ministry_id"
                    class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white">
                <option value="">Select Ministry</option>
                @foreach($ministries as $ministry)
                    <option value="{{ $ministry->id }}" {{ old('ministry_id') == $ministry->id ? 'selected' : '' }}>
                        {{ $ministry->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white"
                      placeholder="Event description...">{{ old('description') }}</textarea>
        </div>

        <!-- Poster -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Poster (Optional)</label>
            <input type="file" name="poster" accept="image/*"
                   class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-slate-700 rounded-lg">
        </div>

        <!-- Settings -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-slate-900 dark:text-white">Public Event</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Visible to all members</p>
                </div>
                <input type="checkbox" name="is_public" value="1" 
       {{ old('is_public', true) ? 'checked' : '' }}
       class="h-5 w-5 rounded border-slate-300 text-primary">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit" 
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">calendar_add_on</span>
                Save Event
            </button>
        </div>
    </form>
</div>
@endsection