
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