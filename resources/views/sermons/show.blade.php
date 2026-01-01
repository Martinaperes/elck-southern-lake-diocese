{{-- resources/views/sermons/show.blade.php --}}
@extends('layouts.app')

@section('content')
<main class="flex-1">
    <div class="px-4 md:px-10 lg:px-40 py-10 bg-white dark:bg-surface-dark border-b border-border-light dark:border-gray-800">
        <div class="max-w-[1200px] mx-auto">
            <nav class="flex items-center gap-2 text-sm text-text-muted dark:text-gray-400 mb-6 font-sans">
                <a href="{{ route('sermons.index') }}" class="hover:text-primary transition-colors">Sermons</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-text-main dark:text-white">{{ $sermon->title }}</span>
            </nav>
            
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-2/3">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2 text-primary font-bold text-sm uppercase tracking-wider">
                            <span class="material-symbols-outlined text-lg">calendar_today</span>
                            <span>{{ $sermon->sermon_date->format('F d, Y') }}</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em] text-text-main dark:text-white">
                            {{ $sermon->title }}
                        </h1>
                        <div class="flex items-center gap-4 text-sm text-text-muted dark:text-gray-400 font-sans">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined">person</span>
                                {{ $sermon->preacher }}
                            </span>
                            @if($sermon->duration_formatted)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined">schedule</span>
                                    {{ $sermon->duration_formatted }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        @if($sermon->formatted_scriptures)
                            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl border border-emerald-200 dark:border-emerald-800">
                                <h3 class="text-lg font-bold text-text-main dark:text-white mb-2">Scripture References</h3>
                                <p class="text-emerald-800 dark:text-emerald-300 font-sans">{{ $sermon->formatted_scriptures }}</p>
                            </div>
                        @endif
                        
                        <div class="prose prose-lg max-w-none dark:prose-invert">
                            @if($sermon->description)
                                <h3 class="text-xl font-bold mb-4">Message Summary</h3>
                                <p class="text-text-muted dark:text-gray-300 leading-relaxed font-sans">
                                    {{ $sermon->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/3">
                    <div class="sticky top-24">
                        {{-- Media Player --}}
                        <div class="bg-white dark:bg-surface-dark rounded-xl border border-border-light dark:border-gray-700 p-6 shadow-sm mb-6">
                            <h3 class="text-lg font-bold mb-4 text-text-main dark:text-white">Listen or Watch</h3>
                            <div class="space-y-4">
                                @if($sermon->video_url)
                                    <button class="w-full flex items-center justify-center gap-3 rounded-lg h-14 bg-primary text-white text-base font-bold hover:bg-primary-hover transition-colors shadow-sm"
                                            onclick="showSermonModal('{{ $sermon->video_url }}', '{{ $sermon->title }}')">
                                        <span class="material-symbols-outlined">play_circle</span>
                                        <span>Watch Video</span>
                                    </button>
                                @endif
                                
                                @if($sermon->audio_url)
                                    <button class="w-full flex items-center justify-center gap-3 rounded-lg h-14 bg-background-alt dark:bg-gray-700 text-text-main dark:text-white text-base font-bold hover:bg-[#e8e6e1] dark:hover:bg-gray-600 transition-colors border border-border-light dark:border-gray-600"
                                            onclick="playAudio('{{ $sermon->audio_url }}', '{{ $sermon->title }}', '{{ $sermon->preacher }}')">
                                        <span class="material-symbols-outlined">headphones</span>
                                        <span>Listen Audio</span>
                                    </button>
                                @endif
                                
                                @if($sermon->document_url)
                                    <a href="{{ $sermon->document_url }}" target="_blank" 
                                       class="w-full flex items-center justify-center gap-3 rounded-lg h-14 bg-background-alt dark:bg-gray-700 text-text-main dark:text-white text-base font-bold hover:bg-[#e8e6e1] dark:hover:bg-gray-600 transition-colors border border-border-light dark:border-gray-600">
                                        <span class="material-symbols-outlined">download</span>
                                        <span>Download PDF</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Related Sermons --}}
                        @if($relatedSermons && $relatedSermons->count() > 0)
                            <div class="bg-white dark:bg-surface-dark rounded-xl border border-border-light dark:border-gray-700 p-6 shadow-sm">
                                <h3 class="text-lg font-bold mb-4 text-text-main dark:text-white">Related Messages</h3>
                                <div class="space-y-4">
                                    @foreach($relatedSermons as $related)
                                        <a href="{{ route('sermons.show', $related) }}" class="block group">
                                            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-background-alt dark:hover:bg-gray-800 transition-colors">
                                                <div class="size-12 bg-emerald-100 dark:bg-emerald-900/30 rounded flex items-center justify-center shrink-0">
                                                    <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">
                                                        {{ $related->video_url ? 'videocam' : ($related->audio_url ? 'headphones' : 'description') }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-bold text-text-main dark:text-white group-hover:text-primary transition-colors">
                                                        {{ Str::limit($related->title, 40) }}
                                                    </h4>
                                                    <p class="text-xs text-text-muted dark:text-gray-400 font-sans mt-1">
                                                        {{ $related->sermon_date->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close !text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="aspect-video w-full">
                    <iframe id="sermonVideo" class="w-full h-full rounded-lg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="mt-4 text-white">
                    <h3 id="videoTitle" class="text-xl font-bold"></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Audio Player (Fixed at Bottom) -->
<div id="audioPlayer" class="hidden fixed bottom-0 left-0 w-full bg-white dark:bg-surface-dark border-t border-border-light dark:border-gray-800 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] transform translate-y-full transition-transform z-50">
    <div class="px-4 md:px-10 lg:px-40 py-3">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-[#197b3b] rounded flex items-center justify-center">
                    <span class="material-symbols-outlined text-white">headphones</span>
                </div>
                <div class="hidden sm:block">
                    <p id="audioTitle" class="text-sm font-bold text-text-main dark:text-white">Now Playing</p>
                    <p id="audioPreacher" class="text-xs text-text-muted dark:text-gray-400"></p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-gray-500 hover:text-primary transition-colors" onclick="skipAudio(-15)">
                    <span class="material-symbols-outlined">replay_15</span>
                </button>
                <button id="playPauseBtn" class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center hover:bg-primary-hover shadow-sm transition-colors" onclick="toggleAudio()">
                    <span class="material-symbols-outlined" id="playPauseIcon">play_arrow</span>
                </button>
                <button class="text-gray-500 hover:text-primary transition-colors" onclick="skipAudio(15)">
                    <span class="material-symbols-outlined">forward_15</span>
                </button>
            </div>
            <div class="hidden md:flex items-center gap-2 w-32">
                <span class="material-symbols-outlined text-xs text-gray-400">volume_up</span>
                <input type="range" min="0" max="1" step="0.1" value="0.7" 
                       class="w-full h-1 bg-gray-200 rounded-full appearance-none [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-primary"
                       oninput="setVolume(this.value)" id="volumeSlider">
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .font-sans {
        font-family: "Noto Sans", sans-serif;
    }
</style>
@endpush

@push('scripts')
<script>
    // Audio player functionality
    let audioPlayer = null;
    let currentAudioUrl = '';
    let currentAudioTitle = '';
    let currentAudioPreacher = '';
    let isPlaying = false;

    function playAudio(url, title, preacher = '') {
        currentAudioUrl = url;
        currentAudioTitle = title;
        currentAudioPreacher = preacher;
        
        // Initialize or reuse audio player
        if (!audioPlayer) {
            audioPlayer = new Audio();
            audioPlayer.addEventListener('ended', () => {
                isPlaying = false;
                updatePlayPauseIcon();
            });
        }
        
        audioPlayer.src = url;
        audioPlayer.load();
        
        // Update UI
        document.getElementById('audioTitle').textContent = title;
        document.getElementById('audioPreacher').textContent = preacher;
        
        // Show audio player
        const playerElement = document.getElementById('audioPlayer');
        playerElement.classList.remove('hidden');
        playerElement.classList.remove('translate-y-full');
        playerElement.classList.add('translate-y-0');
        
        // Play audio
        audioPlayer.play();
        isPlaying = true;
        updatePlayPauseIcon();
    }

    function toggleAudio() {
        if (!audioPlayer) return;
        
        if (isPlaying) {
            audioPlayer.pause();
        } else {
            audioPlayer.play();
        }
        isPlaying = !isPlaying;
        updatePlayPauseIcon();
    }

    function updatePlayPauseIcon() {
        const icon = document.getElementById('playPauseIcon');
        const btn = document.getElementById('playPauseBtn');
        if (isPlaying) {
            icon.textContent = 'pause';
            btn.classList.add('bg-primary-hover');
        } else {
            icon.textContent = 'play_arrow';
            btn.classList.remove('bg-primary-hover');
        }
    }

    function skipAudio(seconds) {
        if (!audioPlayer) return;
        audioPlayer.currentTime += seconds;
    }

    function setVolume(value) {
        if (audioPlayer) {
            audioPlayer.volume = value;
        }
    }

    // Video modal functionality
    function showSermonModal(videoUrl, title) {
        const modal = new bootstrap.Modal(document.getElementById('videoModal'));
        const videoFrame = document.getElementById('sermonVideo');
        const titleElement = document.getElementById('videoTitle');
        
        // Extract video ID from URL (for YouTube, Vimeo, etc.)
        let embedUrl = videoUrl;
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            let videoId = videoUrl.split('v=')[1];
            if (!videoId && videoUrl.includes('youtu.be')) {
                videoId = videoUrl.split('youtu.be/')[1];
            }
            if (videoId) {
                videoId = videoId.split('&')[0]; // Remove additional parameters
                embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            }
        }
        
        videoFrame.src = embedUrl;
        titleElement.textContent = title;
        modal.show();
    }

    // Close video modal when hidden
    document.addEventListener('DOMContentLoaded', function() {
        const videoModal = document.getElementById('videoModal');
        if (videoModal) {
            videoModal.addEventListener('hidden.bs.modal', function () {
                const videoFrame = document.getElementById('sermonVideo');
                videoFrame.src = '';
            });
        }
    });
</script>
@endpush