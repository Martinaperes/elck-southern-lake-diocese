@extends('admin.layouts.app')

@section('content')
<div class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white min-h-screen flex flex-col">
    <!-- TopAppBar -->
    <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="flex items-center p-4 justify-between max-w-xl mx-auto w-full">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.newsletter.campaigns') }}" class="text-slate-600 dark:text-slate-400 p-1">
                    <span class="material-symbols-outlined">close</span>
                </a>
                <h2 class="text-lg font-bold leading-tight tracking-tight">Compose Newsletter</h2>
            </div>
            <div class="flex items-center gap-4">
                <button type="button" onclick="previewCampaign()" class="text-primary text-sm font-bold tracking-wide uppercase">Preview</button>
            </div>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto max-w-xl mx-auto w-full pb-32">
        <form action="{{ route('admin.newsletter.store') }}" method="POST" enctype="multipart/form-data" id="campaignForm">
            @csrf
            
            <!-- ActionsBar (Secondary Actions) -->
            <div class="px-4 pt-6 pb-2">
                <div class="flex gap-4">
                    <button type="button" onclick="saveAsDraft()" 
                            class="flex items-center gap-2 bg-slate-100 dark:bg-slate-800/50 hover:bg-slate-200 dark:hover:bg-slate-800 px-4 py-2 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">save</span>
                        <span class="text-sm font-medium">Quick Save Draft</span>
                    </button>
                    
                    <button type="button" onclick="document.getElementById('featured_image').click()" 
                            class="flex items-center gap-2 bg-slate-100 dark:bg-slate-800/50 hover:bg-slate-200 dark:hover:bg-slate-800 px-4 py-2 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">attach_file</span>
                        <span class="text-sm font-medium">Add Media</span>
                    </button>
                </div>
            </div>

            <!-- Form Section -->
            <div class="space-y-2">
                <!-- TextField: Subject -->
                <div class="px-4 py-3">
                    <label class="flex flex-col w-full">
                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-1.5 ml-1">Subject *</p>
                        <input type="text" name="subject" id="subject"
                               class="form-input flex w-full rounded-xl text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/50 h-14 placeholder:text-slate-400 dark:placeholder:text-slate-600 px-4 text-base" 
                               placeholder="e.g., Monthly Diocese Update" 
                               value="{{ old('subject') }}" 
                               required/>
                        @error('subject')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <!-- TextField: Excerpt -->
                <div class="px-4 py-3">
                    <label class="flex flex-col w-full">
                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-1.5 ml-1">Brief Summary</p>
                        <textarea name="excerpt" id="excerpt" rows="2"
                                  class="form-input flex w-full rounded-xl text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/50 placeholder:text-slate-400 dark:placeholder:text-slate-600 px-4 py-3 text-base"
                                  placeholder="A brief summary that appears in email preview">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <!-- TextField: Category -->
                <div class="px-4 py-3">
                    <label class="flex flex-col w-full">
                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-1.5 ml-1">Category</p>
                        <input type="text" name="category" id="category"
                               class="form-input flex w-full rounded-xl text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/50 h-14 placeholder:text-slate-400 dark:placeholder:text-slate-600 px-4 text-base" 
                               placeholder="e.g., Weekly Update, Announcement" 
                               value="{{ old('category') }}"/>
                    </label>
                </div>

                <!-- Send Options -->
                <div class="px-4 py-3">
                    <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-1.5 ml-1">Send Options</p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 p-3 bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl">
                            <input type="radio" id="send_draft" name="send_option" value="draft" checked
                                   class="w-4 h-4 text-primary border-slate-300 focus:ring-primary dark:focus:ring-primary dark:border-slate-600">
                            <label for="send_draft" class="flex-1">
                                <p class="font-medium text-slate-900 dark:text-white">Save as Draft</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Save and edit later</p>
                            </label>
                        </div>

                        <div class="flex items-center gap-3 p-3 bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl">
                            <input type="radio" id="send_now" name="send_option" value="now"
                                   class="w-4 h-4 text-primary border-slate-300 focus:ring-primary dark:focus:ring-primary dark:border-slate-600">
                            <label for="send_now" class="flex-1">
                                <p class="font-medium text-slate-900 dark:text-white">Send Immediately</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    {{ \App\Models\NewsletterSubscriber::where('is_active', true)->count() }} active subscribers
                                </p>
                            </label>
                        </div>

                        <div class="flex items-center gap-3 p-3 bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl">
                            <input type="radio" id="send_schedule" name="send_option" value="schedule"
                                   class="w-4 h-4 text-primary border-slate-300 focus:ring-primary dark:focus:ring-primary dark:border-slate-600">
                            <label for="send_schedule" class="flex-1">
                                <p class="font-medium text-slate-900 dark:text-white">Schedule for Later</p>
                            </label>
                        </div>

                        <!-- Schedule Date Field -->
                        <div id="scheduleField" class="p-3 bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl" style="display: none;">
                            <label class="flex flex-col w-full">
                                <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-1.5 ml-1">Schedule Date & Time</p>
                                <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                                       class="form-input flex w-full rounded-lg text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 h-12 px-3" 
                                       min="{{ date('Y-m-d\TH:i') }}"/>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Featured Image Upload -->
                <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden" onchange="previewImage(event)">
                
                <div class="px-4 py-3">
                    <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-1.5 ml-1">Featured Image</p>
                    <div id="imageDropzone" 
                         class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-xl p-8 text-center hover:border-primary dark:hover:border-primary transition-colors cursor-pointer"
                         onclick="document.getElementById('featured_image').click()">
                        <div id="imagePreview" class="space-y-3">
                            <span class="material-symbols-outlined text-4xl text-slate-400">image</span>
                            <div>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">Tap to add image</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG up to 2MB</p>
                                <p class="text-xs text-slate-400 mt-1">Recommended: 1200×630px</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Toggle -->
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl">
                        <div>
                            <p class="font-medium text-slate-900 dark:text-white">Featured Campaign</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Highlight this campaign</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                                   class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                </div>

                <!-- Rich Text Editor -->
                <div class="px-4 pt-4">
                    <p class="text-slate-600 dark:text-slate-400 text-sm font-medium pb-2 ml-1">Content *</p>
                    <div class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden bg-white dark:bg-slate-900/50">
                        <!-- Toolbar -->
                        <div class="flex items-center gap-1 p-2 bg-slate-50 dark:bg-slate-800/40 border-b border-slate-200 dark:border-slate-700 overflow-x-auto no-scrollbar">
                            <button type="button" onclick="formatText('bold')" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                                <span class="material-symbols-outlined text-[20px]">format_bold</span>
                            </button>
                            <button type="button" onclick="formatText('italic')" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                                <span class="material-symbols-outlined text-[20px]">format_italic</span>
                            </button>
                            <button type="button" onclick="formatText('unordered-list')" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                                <span class="material-symbols-outlined text-[20px]">format_list_bulleted</span>
                            </button>
                            <button type="button" onclick="insertLink()" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                                <span class="material-symbols-outlined text-[20px]">link</span>
                            </button>
                            <div class="w-px h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>
                            <button type="button" onclick="document.getElementById('featured_image').click()" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                                <span class="material-symbols-outlined text-[20px]">image</span>
                            </button>
                        </div>
                        
                        <!-- Editor Area -->
                        <textarea name="content" id="content" 
                                  class="w-full min-h-[300px] p-4 bg-transparent border-none focus:ring-0 text-base leading-relaxed text-slate-800 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-600 resize-none"
                                  placeholder="Grace and peace to you... Start typing your newsletter content here." 
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                        <p class="px-4 pb-4 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- MAIN SUBMIT BUTTON (INSIDE THE FORM, BEFORE CLOSING) -->
                <div class="px-4 py-6 mt-8">
                    <div class="bg-gradient-to-r from-primary/10 to-emerald-100 dark:from-primary/5 dark:to-emerald-900/10 border border-primary/20 dark:border-primary/10 rounded-xl p-4">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-2">Ready to Publish?</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                            Choose your publishing option below. Your newsletter will be saved automatically.
                        </p>
                        
                        <div class="space-y-3">
                            <!-- Draft Option -->
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">draft</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-white">Save as Draft</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Save for later editing</p>
                                    </div>
                                </div>
                                <button type="submit" name="action" value="draft" 
                                        class="px-4 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-300 rounded-lg text-sm font-medium transition-colors">
                                    Save Draft
                                </button>
                            </div>
                            
                            <!-- Send Now Option -->
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">send</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-white">Send Immediately</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Send to {{ \App\Models\NewsletterSubscriber::where('is_active', true)->count() }} subscribers</p>
                                    </div>
                                </div>
                                <button type="submit" name="action" value="send" 
                                        class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium transition-colors"
                                        onclick="return confirm('Send this newsletter to all active subscribers?')">
                                    Send Now
                                </button>
                            </div>
                            
                            <!-- Schedule Option -->
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-amber-600 dark:text-amber-400">schedule</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-white">Schedule</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Set a date and time</p>
                                    </div>
                                </div>
                                <button type="button" onclick="showScheduleModal()" 
                                        class="px-4 py-2 bg-amber-100 dark:bg-amber-900/30 hover:bg-amber-200 dark:hover:bg-amber-900/50 text-amber-800 dark:text-amber-300 rounded-lg text-sm font-medium transition-colors">
                                    Schedule
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- Schedule Modal (Hidden by default) -->
    <div id="scheduleModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white dark:bg-slate-800 rounded-xl w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Schedule Newsletter</h3>
                <button type="button" onclick="hideScheduleModal()" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Select Date & Time
                </label>
                <input type="datetime-local" id="modal_scheduled_at" 
                       class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg"
                       min="{{ date('Y-m-d\TH:i') }}">
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="hideScheduleModal()" 
                        class="flex-1 py-3 px-4 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-300 rounded-lg font-medium">
                    Cancel
                </button>
                <button type="button" onclick="submitScheduled()" 
                        class="flex-1 py-3 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg font-medium">
                    Schedule Newsletter
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Handle send option changes
    document.querySelectorAll('input[name="send_option"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const scheduleField = document.getElementById('scheduleField');
            scheduleField.style.display = this.value === 'schedule' ? 'block' : 'none';
        });
    });
    
    // Function for "Quick Save Draft" button (top)
    function saveAsDraft() {
        // Set the send option to draft
        document.getElementById('send_draft').checked = true;
        
        // Show loading indicator
        const button = document.querySelector('[onclick="saveAsDraft()"]');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">refresh</span><span class="text-sm font-medium">Saving...</span>';
        button.disabled = true;
        
        // Submit the form
        setTimeout(() => {
            document.getElementById('campaignForm').submit();
        }, 500);
    }
    
    // Schedule Modal Functions
    function showScheduleModal() {
        document.getElementById('scheduleModal').classList.remove('hidden');
    }
    
    function hideScheduleModal() {
        document.getElementById('scheduleModal').classList.add('hidden');
    }
    
    function submitScheduled() {
        const scheduleInput = document.getElementById('modal_scheduled_at');
        const mainScheduleInput = document.getElementById('scheduled_at');
        
        if (!scheduleInput.value) {
            alert('Please select a date and time');
            return;
        }
        
        // Set the schedule value
        mainScheduleInput.value = scheduleInput.value;
        
        // Set the send option to schedule
        document.getElementById('send_schedule').checked = true;
        
        // Submit the form
        document.getElementById('campaignForm').submit();
    }
    
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
        document.getElementById('featured_image').value = '';
        document.getElementById('imagePreview').innerHTML = `
            <span class="material-symbols-outlined text-4xl text-slate-400">image</span>
            <div>
                <p class="text-sm font-medium text-slate-900 dark:text-white">Tap to add image</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG up to 2MB</p>
                <p class="text-xs text-slate-400 mt-1">Recommended: 1200×630px</p>
            </div>
        `;
    }
    
    // Simple text formatting
    function formatText(command) {
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);
        
        let formattedText = selectedText;
        
        switch(command) {
            case 'bold':
                formattedText = `<strong>${selectedText}</strong>`;
                break;
            case 'italic':
                formattedText = `<em>${selectedText}</em>`;
                break;
            case 'unordered-list':
                formattedText = `<ul>\n  <li>${selectedText}</li>\n</ul>`;
                break;
        }
        
        textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
        textarea.focus();
        textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
    }
    
    function insertLink() {
        const url = prompt('Enter URL:');
        if (url) {
            const text = prompt('Enter link text:', url);
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            
            const linkText = text || selectedText || url;
            const link = `<a href="${url}" target="_blank">${linkText}</a>`;
            
            textarea.value = textarea.value.substring(0, start) + link + textarea.value.substring(end);
        }
    }
    
    function previewCampaign() {
        // Store form data temporarily for preview
        const form = document.getElementById('campaignForm');
        const formData = new FormData(form);
        
        // You could send this via AJAX to a preview endpoint
        // For now, show a simple alert
        alert('Preview functionality would show how your newsletter will look.');
    }
    
    // Form validation
    document.getElementById('campaignForm').addEventListener('submit', function(e) {
        const subject = document.getElementById('subject').value;
        const content = document.getElementById('content').value;
        
        if (!subject.trim() || !content.trim()) {
            e.preventDefault();
            alert('Please fill in the required fields: Subject and Content');
            return false;
        }
        
        // Show loading state for whichever button was clicked
        const submitter = e.submitter;
        if (submitter) {
            const originalHTML = submitter.innerHTML;
            submitter.innerHTML = '<span class="material-symbols-outlined animate-spin">refresh</span> Processing...';
            submitter.disabled = true;
            
            // Re-enable after 5 seconds if submission fails
            setTimeout(() => {
                submitter.innerHTML = originalHTML;
                submitter.disabled = false;
            }, 5000);
        }
    });
</script>
@endpush

@push('styles')
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    
    .form-input:focus {
        border-color: #197b3b !important;
        box-shadow: 0 0 0 1px #197b3b !important;
    }
    
    body {
        font-family: 'Public Sans', sans-serif;
        -webkit-tap-highlight-color: transparent;
    }
    
    /* Hide scrollbar for toolbar */
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    
    /* Smooth animations */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    /* Ensure main content has enough padding at bottom */
    main {
        padding-bottom: 120px !important;
    }
</style>
@endpush
@endsection