(function ($, elementorFrontend) {
    "use strict";

    function initializeClassicVideoPlaylist(container) {
        // Core variables
        const video = container.querySelector('#main-video');
        const player = container.querySelector('#player');
        const centerToggle = container.querySelector('#center-toggle');
        const playPauseBtn = container.querySelector('#play-pause-btn');
        const progressBar = container.querySelector('#video-progress-bar');
        const progressCont = container.querySelector('#progress-container');
        const currentTime = container.querySelector('#current-time');
        const durationEl = container.querySelector('#duration');
        const muteBtn = container.querySelector('#mute-btn');
        const volumeCont = container.querySelector('#volume-slider');
        const volumeFill = container.querySelector('#volume-fill');
        const fullscreenBtn = container.querySelector('#fullscreen-btn');
        const autoplayToggle = container.querySelector('#autoplay-toggle');
        const loopBtn = container.querySelector('#loop-btn');
        const overlay = container.querySelector('.overlay');
        const tooltip = container.querySelector('#progress-tooltip');
        const items = container.querySelectorAll('#playlist li');

        let autoplayEnabled = true;
        let loopEnabled = false;
        let lastVolume = 0.7;

        // Time formatting
        function formatTime(s) {
            const m = Math.floor(s / 60);
            const sec = Math.floor(s % 60);
            return `${m.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
        }

        // Play / Pause UI
        function updatePlayUI() {
            const isPlaying = !video.paused && !video.ended;
            centerToggle.innerHTML = isPlaying ? '<i class="ri-pause-fill"></i>' : '<i class="ri-play-fill"></i>';
            centerToggle.classList.toggle('hidden', isPlaying);
            playPauseBtn.innerHTML = isPlaying ? '<i class="ri-pause-fill"></i>' : '<i class="ri-play-fill"></i>';
            player.classList.toggle('playing', isPlaying);
        }

        // Fullscreen UI
        function updateFullscreenUI() {
            const isFullscreen = document.fullscreenElement === player;
            fullscreenBtn.innerHTML = isFullscreen ? '<i class="ri-fullscreen-exit-fill"></i>' : '<i class="ri-fullscreen-fill"></i>';
        }

        // Volume UI
        function updateVolumeUI() {
            // video.muted = false;
            if (video.muted) {
                volumeFill.style.width = '0%';
                muteBtn.innerHTML = '<i class="ri-volume-mute-fill"></i>';
            } else {
                volumeFill.style.width = (video.volume * 100) + '%';
                muteBtn.innerHTML = '<i class="ri-volume-up-fill"></i>';
            }
        }
        // Event listeners
        video.addEventListener('play', updatePlayUI);
        video.addEventListener('pause', updatePlayUI);
        video.addEventListener('ended', updatePlayUI);
        video.addEventListener('volumechange', updateVolumeUI);
        document.addEventListener('fullscreenchange', updateFullscreenUI);

        video.addEventListener('timeupdate', () => {
            if (!video.duration) return;
            const pct = (video.currentTime / video.duration) * 100;
            progressBar.style.width = pct + '%';
            currentTime.textContent = formatTime(video.currentTime);
        });

        video.addEventListener('loadedmetadata', () => {
            durationEl.textContent = formatTime(video.duration || 0);
        });

        // Play/Pause
        const togglePlay = () => {
            if (video.paused) video.play().catch(() => { });
            else video.pause();
        };

        centerToggle.addEventListener('click', e => {
            e.stopPropagation();
            togglePlay();
        });

        player.addEventListener('click', e => {
            if (e.target.closest('.custom-controls') || e.target.closest('.center-control')) return;
            togglePlay();
        });

        playPauseBtn.addEventListener('click', togglePlay);

        // Volume & Mute
        volumeCont.addEventListener('click', e => {
            const rect = volumeCont.getBoundingClientRect();
            const pos = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
            lastVolume = pos;
            video.volume = pos;
            video.muted = false;
        });

        muteBtn.addEventListener('click', () => {
            if (video.muted) {
                video.muted = false;
                video.volume = lastVolume || 0.7;
            } else {
                lastVolume = video.volume;
                video.muted = true;
            }
        });

        // Progress tooltip
        progressCont.addEventListener('mousemove', (e) => {
            if (!video.duration) return;
            const rect = progressCont.getBoundingClientRect();
            const mouseX = e.clientX - rect.left;
            const percent = mouseX / rect.width;
            const clamped = Math.max(0, Math.min(1, percent));
            const time = clamped * video.duration;

            tooltip.textContent = formatTime(time);
            tooltip.style.left = `${mouseX}px`;
            tooltip.style.opacity = '1';
        });

        progressCont.addEventListener('mouseleave', () => {
            tooltip.style.opacity = '0';
        });

        // Seek
        progressCont.addEventListener('click', e => {
            const rect = progressCont.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            video.currentTime = pos * (video.duration || 0);
        });

        // Fullscreen
        fullscreenBtn.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                player.requestFullscreen().catch(() => { });
            } else {
                document.exitFullscreen();
            }
        });

        // Loop toggle with ri-memories-line
        loopBtn.addEventListener('click', () => {
            loopEnabled = !loopEnabled;
            video.loop = loopEnabled;
            loopBtn.classList.toggle('active', loopEnabled);
        });

        // Autoplay toggle
        autoplayToggle.addEventListener('change', () => {
            autoplayEnabled = autoplayToggle.checked;
        });

        // Video ended → autoplay next if enabled
        video.addEventListener('ended', () => {
            if (autoplayEnabled) {
                const currentLi = document.querySelector('#playlist li.active');
                let nextLi = currentLi.nextElementSibling;
                if (!nextLi) nextLi = document.querySelector('#playlist li:first-child');
                if (nextLi) nextLi.click();
            }
        });

        // Add these lines inside your <script>

        // Function to update tooltip text
        function updateAutoplayTooltip() {
            const container = document.getElementById('autoplay-container');
            if (autoplayEnabled) {
                container.setAttribute('data-tooltip', container.getAttribute('data-tooltip-on'));
            } else {
                container.setAttribute('data-tooltip', container.getAttribute('data-tooltip-off'));
            }
        }

        // Run once at start
        updateAutoplayTooltip();

        // Update when toggle changes
        autoplayToggle.addEventListener('change', () => {
            autoplayEnabled = autoplayToggle.checked;
            updateAutoplayTooltip();
        });

        // Playlist item click
        items.forEach(li => {
            li.addEventListener('click', () => {
                items.forEach(i => i.classList.remove('active'));
                li.classList.add('active');

                const src = li.dataset.src;
                const wasPlaying = !video.paused;

                video.src = src;
                video.load();

                video.loop = loopEnabled;

                if (autoplayEnabled || wasPlaying) {
                    video.muted = true;
                    video.play().catch(() => { });
                }

                overlay.textContent = li.querySelector('.title').textContent;

                progressBar.style.width = '0%';
                currentTime.textContent = '00:00';
                if (!autoplayEnabled) {
                    video.muted = false;
                }
                video.volume = lastVolume || 0.7;
                updatePlayUI();
                updateVolumeUI();
            });
        });

        // Initial setup
        if (items.length > 0) {
            overlay.textContent = items[0].querySelector('.title').textContent;

            autoplayToggle.checked = autoplayEnabled;

            video.volume = lastVolume;
            updateVolumeUI();

            if (autoplayEnabled) {
                video.muted = true;
                video.play().catch(() => { });
            }
        }

        // ────────────────────────────────────────────────
        // Dynamically load and display duration for each playlist item
        // ────────────────────────────────────────────────
        function loadPlaylistItemDurations() {
            if (items.length === 0) return;

            // Create one reusable hidden video element
            const tempVideo = document.createElement('video');
            tempVideo.preload = 'metadata';    
            tempVideo.muted = true;            
            tempVideo.style.display = 'none';
            document.body.appendChild(tempVideo); 

            let currentIndex = 0;

            function loadNext() {
                if (currentIndex >= items.length) {
                    // All done → clean up
                    document.body.removeChild(tempVideo);
                    return;
                }

                const li = items[currentIndex];
                const src = li.dataset.src;
                const durationSpan = li.querySelector('.duration');

                if (!src || !durationSpan) {
                    durationSpan.textContent = '--:--';
                    currentIndex++;
                    loadNext();
                    return;
                }

                // Handle successful metadata load
                const onLoadedMetadata = () => {
                    if (!isNaN(tempVideo.duration) && tempVideo.duration > 0) {
                        durationSpan.textContent = formatTime(tempVideo.duration);
                    } else {
                        durationSpan.textContent = '--:--';
                    }
                    cleanupAndNext();
                };

                // Handle errors (invalid src, CORS, no duration, etc.)
                const onError = () => {
                    durationSpan.textContent = '--:--';
                    cleanupAndNext();
                };

                const cleanupAndNext = () => {
                    tempVideo.removeEventListener('loadedmetadata', onLoadedMetadata);
                    tempVideo.removeEventListener('error', onError);
                    currentIndex++;
                    loadNext();
                };

                tempVideo.addEventListener('loadedmetadata', onLoadedMetadata);
                tempVideo.addEventListener('error', onError);

                // Start loading this video's metadata
                tempVideo.src = src;
                tempVideo.load();
            }
            loadNext();
        }
        loadPlaylistItemDurations();

    }

    // Elementor handler
    const classicVideoPlaylistHandler = function ($scope) {
        const container = $scope.find('.container-video-playlist')[0];
        if (container && container.querySelector('.main-video')) {
            initializeClassicVideoPlaylist(container);
        }
    };

    $(document).ready(function () {
        $('.container-video-playlist').each(function () {
            if (this.querySelector('.main-video')) {
                initializeClassicVideoPlaylist('.container-video-playlist');
            }
        });
    });

    // Register with Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/classic_video_player_playlist.default',
            classicVideoPlaylistHandler
        );
    });

})(jQuery, window.elementorFrontend);