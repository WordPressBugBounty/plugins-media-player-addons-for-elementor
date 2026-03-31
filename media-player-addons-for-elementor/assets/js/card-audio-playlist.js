(function ($, elementorFrontend) {
    "use strict";

    function initializeAudioPlayer(container) {
        // Main audio element
        const audio = new Audio();
        let isPlaying = false;
        let currentTrackIndex = 0;
        let isShuffled = false;
        let isLooping = false;
        let isMuted = false;
        let savedVolume = 1;

        // Get playlist from data attribute
        const appContainer = container.querySelector('.app-container') || container;
        let tracks = [];

        if (appContainer.dataset.playlist) {
            tracks = JSON.parse(appContainer.dataset.playlist);
            appContainer.removeAttribute('data-playlist');
        }

        if (tracks.length === 0) {
            console.warn('No playlist data found for audio player');
            return;
        }

        // DOM Elements
        const playPauseBtn = container.querySelector("#playPauseBtnPlaylist");
        const seekSlider = container.querySelector("#seekSlider");
        const currentTimeEl = container.querySelector("#currentTime");
        const trackTimeEl = container.querySelector("#trackTime");
        const albumArt = container.querySelector("#albumArt");
        const trackTitle = container.querySelector("#trackTitle");
        const bandName = container.querySelector("#bandName");
        const nextBtn = container.querySelector("#nextBtn");
        const prevBtn = container.querySelector("#prevBtn");
        const shuffleBtn = container.querySelector("#shuffleBtn");
        const loopBtn = container.querySelector("#loopBtn");
        const muteBtn = container.querySelector("#muteBtn");
        const volumeSlider = container.querySelector("#volumeSlider");
        const volumeIndicator = container.querySelector("#volumeIndicator");
        const volumeBar = container.querySelector("#volume-bar");
        const likeBtn = container.querySelector("#likeBtn");

        // Time formatting
        function formatTime(timeInSeconds) {
            if (!timeInSeconds || isNaN(timeInSeconds)) return "00:00";
            const minutes = Math.floor(timeInSeconds / 60);
            const seconds = Math.floor(timeInSeconds % 60);
            return `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
        }

        // Load track function
        function loadTrack(trackIndex) {
            if (trackIndex < 0 || trackIndex >= tracks.length) return;

            currentTrackIndex = trackIndex;
            const track = tracks[trackIndex];

            audio.src = track.src;
            audio.load();

            if (albumArt) albumArt.src = track.albumArt || '';
            if (trackTitle) trackTitle.textContent = track.trackTitle || 'Unknown Track';
            if (bandName) bandName.textContent = track.bandName || 'Unknown Artist';

            // Reset UI
            if (seekSlider) seekSlider.value = 0;
            if (currentTimeEl) currentTimeEl.textContent = "00:00";
        }

        // Update Play/Pause UI
        function updatePlayUI() {
            if (!playPauseBtn) return;
            const icon = isPlaying ? 'ri-pause-line' : 'ri-play-fill';
            playPauseBtn.innerHTML = `<i class="${icon}"></i>`;
        }

        // Toggle Play/Pause
        function togglePlayPause() {
            if (isPlaying) {
                audio.pause();
            } else {
                audio.play().catch(() => {});
            }
        }

        // Play next track
        function playNextTrack() {
            currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
            loadTrack(currentTrackIndex);
            if (isPlaying) audio.play().catch(() => {});
        }

        // Play previous track
        function playPreviousTrack() {
            currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
            loadTrack(currentTrackIndex);
            if (isPlaying) audio.play().catch(() => {});
        }

        // Play next (used in ended event)
        function playNextOrLoop() {
            if (isLooping) {
                audio.currentTime = 0;
                audio.play().catch(() => {});
            } else if (isShuffled) {
                // Simple shuffle: just go next for now (you can improve later)
                playNextTrack();
            } else {
                playNextTrack();
            }
        }

        // Toggle Shuffle
        function toggleShuffle() {
            isShuffled = !isShuffled;
            if (shuffleBtn) shuffleBtn.classList.toggle("active", isShuffled);
        }

        // Toggle Loop
        function toggleLoop() {
            isLooping = !isLooping;
            audio.loop = isLooping;
            if (loopBtn) loopBtn.classList.toggle("active", isLooping);
        }

        // Volume & Mute
        function toggleMute() {
            isMuted = !isMuted;
            if (isMuted) {
                savedVolume = audio.volume;
                audio.volume = 0;
                if (muteBtn) muteBtn.innerHTML = '<i class="ri-volume-mute-line"></i>';
            } else {
                audio.volume = savedVolume;
                if (muteBtn) muteBtn.innerHTML = '<i class="ri-volume-up-line"></i>';
            }
            if (volumeSlider) volumeSlider.value = isMuted ? 0 : savedVolume;
            if (muteBtn) muteBtn.classList.toggle("active", isMuted);
            updateVolumeIndicator();
        }

        function setVolume() {
            if (!isMuted && volumeSlider) {
                audio.volume = parseFloat(volumeSlider.value);
                savedVolume = audio.volume;
            }
            updateVolumeIndicator();
        }

        function updateVolumeIndicator() {
            if (volumeIndicator) {
                const percent = audio.volume * 100;
                volumeIndicator.style.width = `${percent}%`;
            }
        }

        // Like button
        let isLiked = false;
        function toggleLike() {
            isLiked = !isLiked;
            if (likeBtn) {
                if (isLiked) {
                    likeBtn.classList.add("liked");
                    likeBtn.innerHTML = '<i class="fas fa-heart"></i>';
                } else {
                    likeBtn.classList.remove("liked");
                    likeBtn.innerHTML = '<i class="far fa-heart"></i>';
                }
            }
        }

        // ====================== EVENT LISTENERS ======================

        // Play/Pause
        if (playPauseBtn) playPauseBtn.addEventListener("click", togglePlayPause);

        // Audio events
        audio.addEventListener("play", () => {
            isPlaying = true;
            updatePlayUI();
        });

        audio.addEventListener("pause", () => {
            isPlaying = false;
            updatePlayUI();
        });

        audio.addEventListener("ended", playNextOrLoop);

        audio.addEventListener("timeupdate", () => {
            if (!audio.duration) return;

            const currentTime = formatTime(audio.currentTime);
            if (currentTimeEl) currentTimeEl.textContent = currentTime;

            if (seekSlider) {
                seekSlider.value = audio.currentTime;
                const percent = (audio.currentTime / audio.duration) * 100;
                // You can update seekIndicator here if you have one
            }
        });

        audio.addEventListener("loadedmetadata", () => {
            if (seekSlider) seekSlider.max = audio.duration;
            if (trackTimeEl) trackTimeEl.textContent = formatTime(audio.duration);
        });

        // Seek slider
        if (seekSlider) {
            seekSlider.addEventListener("input", () => {
                audio.currentTime = parseFloat(seekSlider.value);
            });
        }

        // Next / Previous
        if (nextBtn) nextBtn.addEventListener("click", playNextTrack);
        if (prevBtn) prevBtn.addEventListener("click", playPreviousTrack);

        // Shuffle & Loop
        if (shuffleBtn) shuffleBtn.addEventListener("click", toggleShuffle);
        if (loopBtn) loopBtn.addEventListener("click", toggleLoop);

        // Volume
        if (muteBtn) muteBtn.addEventListener("click", toggleMute);
        if (volumeSlider) volumeSlider.addEventListener("input", setVolume);

        // Like button
        if (likeBtn) likeBtn.addEventListener("click", toggleLike);

        // ====================== INITIALIZATION ======================
        function init() {
            loadTrack(0);
            if (volumeSlider) volumeSlider.value = savedVolume;
            updateVolumeIndicator();
            updatePlayUI();
        }

        init();
    }

    // ====================== Elementor + Direct Init ======================

    // Elementor Widget Handler
    const audioPlayerHandler = function ($scope) {
        const container = $scope[0] || $scope.find('.audio-player-container')[0];
        if (container) {
            initializeAudioPlayer(container);
        }
    };

    // Direct initialization on document ready (for non-Elementor use)
    $(document).ready(function () {
        document.querySelectorAll('.app-container, .audio-player-container').forEach(container => {
            initializeAudioPlayer(container);
        });
    });

    // Register with Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/card_audio_playlist.default',  // ← Change this to your actual widget name
            audioPlayerHandler
        );
    });

})(jQuery, window.elementorFrontend);