@extends('admin.layouts.app')

@section('content')
<div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
    
    <!-- TopAppBar -->
    <div class="flex items-center bg-background-light dark:bg-background-dark p-4 pb-2 justify-between sticky top-0 z-10 border-b border-slate-200 dark:border-slate-800">
        <a href="{{ route('admin.events.index') }}" class="text-primary flex size-12 shrink-0 items-center justify-start cursor-pointer">
            <span class="material-symbols-outlined !text-white">arrow_back_ios</span>
        </a>
        <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] flex-1 text-center pr-12">Schedule New Event</h2>
    </div>

    <!-- Main Form -->
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-1 p-4 overflow-y-auto pb-32" id="eventForm">
        @csrf
        
        <!-- Event Title -->
        <div class="flex flex-col gap-2 py-3">
            <label class="flex flex-col min-w-40 flex-1">
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Event Title *</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg group">
                    <input type="text" name="title" required
                           class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-1 focus:ring-primary border border-slate-300 dark:border-[#3d5245] bg-white dark:bg-[#1c2620] h-14 placeholder:text-slate-400 dark:placeholder:text-[#9eb7a8] p-[15px] rounded-r-none border-r-0 pr-2 text-base font-normal leading-normal" 
                           placeholder="Enter event title" value="{{ old('title') }}"/>
                    <div class="text-[#9eb7a8] flex border border-slate-300 dark:border-[#3d5245] bg-white dark:bg-[#1c2620] items-center justify-center pr-[15px] rounded-r-lg border-l-0">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>
        </div>

        <!-- Event Type -->
        <div class="flex flex-col gap-2 py-3">
            <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Event Type *</p>
            <div class="grid grid-cols-3 gap-2">
                @foreach(['service' => 'Church Service', 'meeting' => 'Meeting', 'conference' => 'Conference', 'workshop' => 'Workshop', 'other' => 'Other'] as $value => $label)
                <label class="relative">
                    <input type="radio" name="event_type" value="{{ $value }}" 
                           {{ old('event_type', 'service') == $value ? 'checked' : '' }}
                           class="sr-only peer" required>
                    <div class="p-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-[#3d5245] rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/10">
                        <span class="material-symbols-outlined block mx-auto mb-1">
                            @switch($value)
                                @case('service') event_available @break
                                @case('meeting') groups @break
                                @case('conference') conference_room @break
                                @case('workshop') construction @break
                                @default event
                            @endswitch
                        </span>
                        <span class="text-sm">{{ $label }}</span>
                    </div>
                </label>
                @endforeach
            </div>
            @error('event_type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Start Date & Time -->
        <div class="grid grid-cols-2 gap-3 py-3">
            <div>
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Start Date *</p>
                <input type="date" name="start_date" required
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-[#3d5245] rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('start_date', date('Y-m-d')) }}">
            </div>
            <div>
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Start Time *</p>
                <input type="time" name="start_time" required
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-[#3d5245] rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('start_time', '09:00') }}">
            </div>
        </div>

        <!-- End Date & Time -->
        <div class="grid grid-cols-2 gap-3 py-3">
            <div>
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">End Date</p>
                <input type="date" name="end_date"
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-[#3d5245] rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('end_date') }}">
            </div>
            <div>
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">End Time</p>
                <input type="time" name="end_time"
                       class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-[#3d5245] rounded-lg text-slate-900 dark:text-white"
                       value="{{ old('end_time') }}">
            </div>
        </div>

        <!-- Location -->
        <div class="flex flex-col gap-2 py-3">
            <label class="flex flex-col min-w-40 flex-1">
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Location *</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <input type="text" name="location" required
                           class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-1 focus:ring-primary border border-slate-300 dark:border-[#3d5245] bg-white dark:bg-[#1c2620] h-14 placeholder:text-slate-400 dark:placeholder:text-[#9eb7a8] p-[15px] rounded-r-none border-r-0 pr-2 text-base font-normal leading-normal" 
                           placeholder="Enter event location" value="{{ old('location') }}"/>
                    <div class="text-primary flex border border-slate-300 dark:border-[#3d5245] bg-white dark:bg-[#1c2620] items-center justify-center pr-[15px] rounded-r-lg border-l-0">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                </div>
                @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>
        </div>

        <!-- Ministry Selection -->
        <div class="flex flex-col gap-2 py-3">
            <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Ministry (Optional)</p>
            <select name="ministry_id" class="w-full px-4 py-3 bg-white dark:bg-[#1c2620] border border-slate-300 dark:border-[#3d5245] rounded-lg text-slate-900 dark:text-white">
                <option value="">Select Ministry</option>
                @foreach($ministries as $ministry)
                <option value="{{ $ministry->id }}" {{ old('ministry_id') == $ministry->id ? 'selected' : '' }}>
                    {{ $ministry->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div class="flex flex-col gap-2 py-3">
            <label class="flex flex-col min-w-40 flex-1">
                <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Description</p>
                <div class="flex w-full flex-1 items-stretch rounded-lg">
                    <textarea name="description" rows="4"
                              class="form-textarea flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-1 focus:ring-primary border border-slate-300 dark:border-[#3d5245] bg-white dark:bg-[#1c2620] placeholder:text-slate-400 dark:placeholder:text-[#9eb7a8] p-[15px] text-base font-normal leading-normal"
                              placeholder="Add event details and agenda...">{{ old('description') }}</textarea>
                </div>
            </label>
        </div>

        <!-- Poster Upload -->
        <div class="flex flex-col gap-2 py-3">
            <p class="text-slate-700 dark:text-white text-base font-medium leading-normal pb-2">Event Poster (Optional)</p>
            <div class="border-2 border-dashed border-slate-300 dark:border-[#3d5245] rounded-lg p-8 text-center cursor-pointer" onclick="document.getElementById('poster').click()">
                <input type="file" name="poster" id="poster" accept="image/*" class="hidden" onchange="previewImage(event)">
                <div id="imagePreview" class="space-y-3">
                    <span class="material-symbols-outlined text-4xl text-slate-400">image</span>
                    <div>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">Tap to add poster</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG up to 5MB</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="space-y-4 py-3">
            <!-- Public Event Toggle -->
            <div class="flex items-center justify-between px-1">
                <div class="flex flex-col">
                    <p class="text-slate-900 dark:text-white text-base font-medium">Public Event</p>
                    <p class="text-slate-500 dark:text-slate-400 text-xs">Visible to all members</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_public" value="1" 
                           {{ old('is_public', true) ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>

            <!-- Notify Members Toggle -->
            <div class="flex items-center justify-between px-1">
                <div class="flex flex-col">
                    <p class="text-slate-900 dark:text-white text-base font-medium">Notify All Members</p>
                    <p class="text-slate-500 dark:text-slate-400 text-xs">Send notification on save</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="notify_members" value="1" 
                           {{ old('notify_members') ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 dark:bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
        </div>

        <!-- Spacer for scroll -->
        <div class="h-10"></div>
    </form>

    <!-- Save Event Button -->
    <div class="fixed bottom-0 left-0 right-0 p-4 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-t border-slate-200 dark:border-slate-800 z-20">
        <button type="submit" form="eventForm" 
                class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
            <span class="material-symbols-outlined !text-white">calendar_add_on</span>
            Save Event
        </button>
    </div>
</div>

@push('scripts')
<script>
    // Combine date and time inputs into datetime fields
    const form = document.getElementById('eventForm');
    
    form.addEventListener('submit', function(e) {
        // Combine start date and time
        const startDate = document.querySelector('input[name="start_date"]').value;
        const startTime = document.querySelector('input[name="start_time"]').value;
        if (startDate && startTime) {
            const startInput = document.createElement('input');
            startInput.type = 'hidden';
            startInput.name = 'start_time';
            startInput.value = `${startDate}T${startTime}`;
            form.appendChild(startInput);
        }
        
        // Combine end date and time if provided
        const endDate = document.querySelector('input[name="end_date"]').value;
        const endTime = document.querySelector('input[name="end_time"]').value;
        if (endDate && endTime) {
            const endInput = document.createElement('input');
            endInput.type = 'hidden';
            endInput.name = 'end_time';
            endInput.value = `${endDate}T${endTime}`;
            form.appendChild(endInput);
        }
    });
    
    // Image preview
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="relative">
                        <img src="${e.target.result}" class="w-full h-48 object-cover rounded-lg">
                        <button type="button" onclick="removeImage()" 
                                class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                    <p class="text-xs text-slate-500">${input.files[0].name}</p>
                `;
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function removeImage() {
        document.getElementById('poster').value = '';
        document.getElementById('imagePreview').innerHTML = `
            <span class="material-symbols-outlined text-4xl text-slate-400">image</span>
            <div>
                <p class="text-sm font-medium text-slate-900 dark:text-white">Tap to add poster</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG up to 5MB</p>
            </div>
        `;
    }
    
    // Set tomorrow as default end date
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    document.querySelector('input[name="end_date"]').value = tomorrow.toISOString().split('T')[0];
    document.querySelector('input[name="end_time"]').value = '17:00';
</script>
@endpush

@push('styles')
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        color: #197b3b;
    }
    .form-input:focus {
        border-color: #197b3b !important;
        box-shadow: 0 0 0 1px #197b3b !important;
    }
</style>
@endpush
@endsection