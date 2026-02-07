// (function ($, elementorFrontend) {
//     "use strict";

//     function initializeClassicAudioPlaylist() {
//         const audio = document.getElementById('audio');
//         const playPauseBtn = document.getElementById('playPause');
//         const prevBtn = document.getElementById('prev');
//         const nextBtn = document.getElementById('next');
//         const rewindBtn = document.getElementById('rewind');
//         const forwardBtn = document.getElementById('forward');
//         const progressContainer = document.getElementById('progressContainer');
//         const progressTooltip = document.getElementById('progressTooltip');
//         const progress = document.getElementById('progress');
//         const titleEl = document.getElementById('title');
//         const artistEl = document.getElementById('artist');
//         const albumArt = document.getElementById('albumArt');
//         const currentTimeEl = document.getElementById('currentTime');
//         const durationEl = document.getElementById('duration');
//         const playlistEl = document.getElementById('playlist');
//         const shuffleBtn = document.getElementById('shuffle');
//         const repeatBtn = document.getElementById('repeat');
//         const volumeSlider = document.getElementById('volume');
//         const volumeIcon = document.getElementById('volumeIcon');

//         const SEEK_TIME = 5;
//         let currentSong = 0;
//         let isPlaying = false;
//         let isShuffle = false;
//         let repeatMode = 0;
//         let isMuted = false;
//         let previousVolume = 1;

//         const playlistItems = document.querySelectorAll('.playlist-item');

//         function formatTime(seconds) {
//             const mins = Math.floor(seconds / 60);
//             const secs = Math.floor(seconds % 60);
//             return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
//         }

//         function updateVolumeIcon() {
//             if (isMuted || audio.volume === 0) {
//                 volumeIcon.className = 'ri-volume-mute-line volume-icon';
//             } else {
//                 volumeIcon.className = 'ri-volume-up-line volume-icon';
//             }
//         }

//         // Update volume slider gradient fill
//         function updateVolumeFill() {
//             const percent = (volumeSlider.value * 100) + '%';
//             volumeSlider.style.setProperty('--volume-percent', percent);
//         }

//         function loadSong(index) {
//             currentSong = index;
//             const item = playlistItems[index];

//             const title = item.querySelector('h4').textContent;
//             const artist = item.querySelector('p').textContent;
//             const cover = item.querySelector('img').src;
//             const audioSrc = item.getAttribute('data-audio');

//             titleEl.textContent = title;
//             artistEl.textContent = artist;
//             albumArt.querySelector('img').src = cover;
//             audio.src = audioSrc;
//             audio.load();

//             playlistItems.forEach((el, i) => {
//                 el.classList.toggle('active', i === index);
//                 const right = el.querySelector('.playlist-item-right');
//                 let wave = right.querySelector('.playlist-sound-wave');
//                 if (i === index) {
//                     if (!wave) {
//                         const duration = right.querySelector('.playlist-item-duration');
//                         right.insertBefore(document.createElement('div'), duration);
//                         const newWave = right.children[0];
//                         newWave.className = 'playlist-sound-wave';
//                         newWave.innerHTML = `
// 								<span></span><span></span><span></span><span></span><span></span>
// 							`;
//                     }
//                 } else if (wave) {
//                     wave.remove();
//                 }
//             });

//             if (isPlaying) audio.play();
//         }

//         audio.addEventListener('loadedmetadata', () => {
//             const realDuration = formatTime(audio.duration);
//             durationEl.textContent = realDuration;
//             if (playlistItems[currentSong]) {
//                 playlistItems[currentSong].querySelector('.playlist-item-duration').textContent = realDuration;
//             }
//         });

//         function playSong() {
//             audio.play();
//             isPlaying = true;
//             playPauseBtn.innerHTML = '<i class="ri-pause-line"></i>';
//             document.querySelector('.player').classList.add('playing');
//         }

//         function pauseSong() {
//             audio.pause();
//             isPlaying = false;
//             playPauseBtn.innerHTML = '<i class="ri-play-line"></i>';
//             document.querySelector('.player').classList.remove('playing');
//         }

//         function togglePlayPause() {
//             if (isPlaying) {
//                 pauseSong();
//             } else {
//                 playSong();
//             }
//         }

//         playlistItems.forEach((item, index) => {
//             item.addEventListener('click', () => {
//                 if (index === currentSong) {
//                     togglePlayPause();
//                 } else {
//                     loadSong(index);
//                     playSong();
//                 }
//             });
//         });

//         rewindBtn.addEventListener('click', () => {
//             audio.currentTime = Math.max(0, audio.currentTime - SEEK_TIME);
//         });

//         forwardBtn.addEventListener('click', () => {
//             audio.currentTime = Math.min(audio.duration, audio.currentTime + SEEK_TIME);
//         });

//         volumeIcon.addEventListener('click', () => {
//             if (isMuted) {
//                 audio.volume = previousVolume;
//                 volumeSlider.value = previousVolume;
//                 isMuted = false;
//             } else {
//                 previousVolume = audio.volume;
//                 audio.volume = 0;
//                 volumeSlider.value = 0;
//                 isMuted = true;
//             }
//             updateVolumeIcon();
//             updateVolumeFill();
//         });

//         volumeSlider.addEventListener('input', () => {
//             audio.volume = volumeSlider.value;
//             isMuted = false;
//             updateVolumeIcon();
//             updateVolumeFill();
//         });

//         playPauseBtn.addEventListener('click', togglePlayPause);

//         prevBtn.addEventListener('click', () => {
//             currentSong = (currentSong - 1 + playlistItems.length) % playlistItems.length;
//             loadSong(currentSong);
//             playSong();
//         });

//         nextBtn.addEventListener('click', () => {
//             currentSong = (currentSong + 1) % playlistItems.length;
//             loadSong(currentSong);
//             playSong();
//         });

//         shuffleBtn.addEventListener('click', () => {
//             isShuffle = !isShuffle;
//             shuffleBtn.style.color = isShuffle ? '#F7F7F7' : '#32364394';
//             shuffleBtn.style.background = isShuffle ? 'linear-gradient(90deg, #6a5acd, #00d4ff)' : 'rgba(255, 255, 255, 0.1)';
//         });

//         repeatBtn.addEventListener('click', () => {
//             repeatMode = (repeatMode + 1) % 3;
//             const icons = ['ri-repeat-line', 'ri-repeat-one-line', 'ri-repeat-2-line'];
//             repeatBtn.innerHTML = `<i class="${icons[repeatMode]}"></i>`;
//             repeatBtn.style.color = repeatMode === 0 ? '#32364394' : '#F7F7F7';
//             repeatBtn.style.background = repeatMode === 0 ? 'rgba(255, 255, 255, 0.1)' : 'linear-gradient(90deg, #6a5acd, #00d4ff)';
//             repeatBtn.title = ['Repeat: Off', 'Repeat: One', 'Repeat: All'][repeatMode];
//         });

//         // Progress bar click to seek
//         progressContainer.addEventListener('click', (e) => {
//             const rect = progressContainer.getBoundingClientRect();
//             const width = rect.width;
//             const clickX = e.clientX - rect.left;
//             audio.currentTime = (clickX / width) * audio.duration;
//         });

//         // Tooltip on hover
//         progressContainer.addEventListener('mousemove', (e) => {
//             const rect = progressContainer.getBoundingClientRect();
//             const width = rect.width;
//             const hoverX = e.clientX - rect.left;
//             const hoverTime = (hoverX / width) * audio.duration;
//             progressTooltip.textContent = formatTime(hoverTime || 0);

//             const tooltipWidth = progressTooltip.offsetWidth;
//             let leftPos = hoverX;
//             if (leftPos < tooltipWidth / 2) leftPos = tooltipWidth / 2;
//             if (leftPos > width - tooltipWidth / 2) leftPos = width - tooltipWidth / 2;
//             progressTooltip.style.left = `${leftPos}px`;
//         });
//         progressContainer.addEventListener('mouseleave', () => {
//             progressTooltip.style.opacity = '0';
//         });

//         progressContainer.addEventListener('mouseenter', () => {
//             progressTooltip.style.opacity = '1';
//         });

//         audio.addEventListener('timeupdate', () => {
//             if (audio.duration) {
//                 const progressPercent = (audio.currentTime / audio.duration) * 100;
//                 progress.style.width = `${progressPercent}%`;
//                 currentTimeEl.textContent = formatTime(audio.currentTime);
//                 durationEl.textContent = formatTime(audio.duration);
//             }
//         });

//         audio.addEventListener('ended', () => {
//             if (repeatMode === 1) {
//                 audio.currentTime = 0;
//                 playSong();
//                 return;
//             }

//             let nextIndex;
//             if (isShuffle && playlistItems.length > 1) {
//                 do {
//                     nextIndex = Math.floor(Math.random() * playlistItems.length);
//                 } while (nextIndex === currentSong);
//             } else {
//                 nextIndex = (currentSong + 1) % playlistItems.length;
//             }

//             if (repeatMode === 0 && !isShuffle && currentSong === playlistItems.length - 1) {
//                 pauseSong();
//                 return;
//             }

//             loadSong(nextIndex);
//             playSong();
//         });
//         function preloadAllDurations() {
//             playlistItems.forEach((item, index) => {
//                 const tempAudio = new Audio(item.getAttribute('data-audio'));
//                 tempAudio.addEventListener('loadedmetadata', () => {
//                     const realDuration = formatTime(tempAudio.duration);
//                     item.querySelector('.playlist-item-duration').textContent = realDuration;
//                 });
//             });
//         }

//         updateVolumeIcon();
//         updateVolumeFill();
//         loadSong(0);
//         preloadAllDurations();
//     }

//     const classicAudioPlaylistHandler = function ($scope) {
//         if ($scope.find('#audio').length) {
//             initializeClassicAudioPlaylist();
//         }
//     };

//     $(window).on('elementor/frontend/init', function () {
//         elementorFrontend.hooks.addAction('frontend/element_ready/classic-audio-playlist.default', classicAudioPlaylistHandler);
//     });

//     initializeClassicAudioPlaylist();

// })(jQuery, window.elementorFrontend);

(function ($, elementorFrontend) {
    "use strict";

    /**
     * Initialize a single Classic Audio Playlist instance
     * @param {HTMLElement} container - The .classic-playlist-container element
     */
    function initializeClassicAudioPlaylist(container) {
        // Scoped elements
        const audio = container.querySelector('.audio');
        const playPauseBtn = container.querySelector('.play-pause');
        const prevBtn = container.querySelector('.prev');
        const nextBtn = container.querySelector('.next');
        const rewindBtn = container.querySelector('.rewind');
        const forwardBtn = container.querySelector('.forward');
        const progressContainer = container.querySelector('.progress-container');
        const progressTooltip = container.querySelector('.progress-tooltip');
        const progress = container.querySelector('.progress');
        const titleEl = container.querySelector('.title');
        const artistEl = container.querySelector('.artist');
        const albumArtImg = container.querySelector('.album-art img');
        const currentTimeEl = container.querySelector('.currentTime');
        const durationEl = container.querySelector('.duration');
        const playlistEl = container.querySelector('.playlist');
        const shuffleBtn = container.querySelector('.shuffle');
        const repeatBtn = container.querySelector('.repeat');
        const volumeSlider = container.querySelector('.volume-slider');
        const volumeIcon = container.querySelector('.volume-icon');
        const playerEl = container.querySelector('.player');
        const colorActive = playPauseBtn.getAttribute('data-color') || '#F7F7F7';
        const backgroundActive = playPauseBtn.getAttribute('data-background') || 'linear-gradient(90deg, #6a5acd, #00d4ff);';

        const SEEK_TIME = 5;

        let currentSong = 0;
        let isPlaying = false;
        let isShuffle = false;
        let repeatMode = 0; // 0: off, 1: repeat one, 2: repeat all
        let isMuted = false;
        let previousVolume = 1;

        const playlistItems = container.querySelectorAll('.playlist-item');

        // Utility: Format time in mm:ss
        function formatTime(seconds) {
            if (isNaN(seconds)) return '0:00';
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
        }

        // Update volume icon
        function updateVolumeIcon() {
            if (isMuted || audio.volume === 0) {
                volumeIcon.className = 'ri-volume-mute-line volume-icon';
            } else {
                volumeIcon.className = 'ri-volume-up-line volume-icon';
            }
        }

        // Update volume slider fill (CSS custom property)
        function updateVolumeFill() {
            const percent = (volumeSlider.value * 100) + '%';
            volumeSlider.style.setProperty('--volume-percent', percent);
        }

        // Load a song by index
        function loadSong(index) {
            currentSong = index;
            const item = playlistItems[index];

            const title = item.querySelector('h4').textContent;
            const artist = item.querySelector('p').textContent;
            const cover = item.querySelector('img').src;
            const audioSrc = item.getAttribute('data-audio');

            titleEl.textContent = title;
            artistEl.textContent = artist;
            albumArtImg.src = cover;
            audio.src = audioSrc;
            audio.load();

            // Update active class and sound wave
            playlistItems.forEach((el, i) => {
                el.classList.toggle('active', i === index);

                const right = el.querySelector('.playlist-item-right');
                let wave = right.querySelector('.playlist-sound-wave');

                if (i === index) {
                    if (!wave) {
                        const durationSpan = right.querySelector('.playlist-item-duration');
                        const newWave = document.createElement('div');
                        newWave.className = 'playlist-sound-wave';
                        newWave.innerHTML = `<span></span><span></span><span></span><span></span><span></span>`;
                        right.insertBefore(newWave, durationSpan);
                    }
                } else {
                    if (wave) wave.remove();
                }
            });

            if (isPlaying) audio.play();
        }

        // Play song
        function playSong() {
            audio.play();
            isPlaying = true;
            playPauseBtn.innerHTML = '<i class="ri-pause-line"></i>';
            playerEl.classList.add('playing');
        }

        // Pause song
        function pauseSong() {
            audio.pause();
            isPlaying = false;
            playPauseBtn.innerHTML = '<i class="ri-play-line"></i>';
            playerEl.classList.remove('playing');
        }

        // Toggle play/pause
        function togglePlayPause() {
            if (isPlaying) {
                pauseSong();
            } else {
                playSong();
            }
        }

        // Event Listeners
        if (playPauseBtn) playPauseBtn.addEventListener('click', togglePlayPause);

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                currentSong = (currentSong - 1 + playlistItems.length) % playlistItems.length;
                loadSong(currentSong);
                playSong();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                currentSong = (currentSong + 1) % playlistItems.length;
                loadSong(currentSong);
                playSong();
            });
        }

        if (rewindBtn) {
            rewindBtn.addEventListener('click', () => {
                audio.currentTime = Math.max(0, audio.currentTime - SEEK_TIME);
            });
        }

        if (forwardBtn) {
            forwardBtn.addEventListener('click', () => {
                audio.currentTime = Math.min(audio.duration || 0, audio.currentTime + SEEK_TIME);
            });
        }

        // Volume controls
        if (volumeIcon) {
            volumeIcon.addEventListener('click', () => {
                if (isMuted) {
                    audio.volume = previousVolume;
                    volumeSlider.value = previousVolume;
                    isMuted = false;
                } else {
                    previousVolume = audio.volume;
                    audio.volume = 0;
                    volumeSlider.value = 0;
                    isMuted = true;
                }
                updateVolumeIcon();
                updateVolumeFill();
            });
        }

        if (volumeSlider) {
            volumeSlider.addEventListener('input', () => {
                audio.volume = volumeSlider.value;
                isMuted = false;
                updateVolumeIcon();
                updateVolumeFill();
            });
        }

        // Shuffle
        if (shuffleBtn) {
            shuffleBtn.addEventListener('click', () => {
                isShuffle = !isShuffle;
                shuffleBtn.style.color = isShuffle ? colorActive : '#32364394';
                shuffleBtn.style.background = isShuffle
                    ? backgroundActive
                    : 'rgba(255, 255, 255, 0.1)';
            });
        }

        // Repeat
        if (repeatBtn) {
            repeatBtn.addEventListener('click', () => {
                repeatMode = (repeatMode + 1) % 3;
                const icons = ['ri-repeat-line', 'ri-repeat-one-line', 'ri-repeat-2-line'];
                const titles = ['Repeat: Off', 'Repeat: One', 'Repeat: All'];
                repeatBtn.innerHTML = `<i class="${icons[repeatMode]}"></i>`;
                repeatBtn.title = titles[repeatMode];
                repeatBtn.style.color = repeatMode === 0 ? '#32364394' : colorActive;
                repeatBtn.style.background = repeatMode === 0
                    ? 'rgba(255, 255, 255, 0.1)'
                    : backgroundActive;
            });
        }

        // Progress bar seek
        if (progressContainer) {
            progressContainer.addEventListener('click', (e) => {
                const rect = progressContainer.getBoundingClientRect();
                const width = rect.width;
                const clickX = e.clientX - rect.left;
                audio.currentTime = (clickX / width) * (audio.duration || 0);
            });

            // Tooltip on hover
            progressContainer.addEventListener('mousemove', (e) => {
                const rect = progressContainer.getBoundingClientRect();
                const width = rect.width;
                const hoverX = e.clientX - rect.left;
                const hoverTime = (hoverX / width) * (audio.duration || 0);
                progressTooltip.textContent = formatTime(hoverTime);
                progressTooltip.style.opacity = '1';

                const tooltipWidth = progressTooltip.offsetWidth || 60;
                let leftPos = hoverX - tooltipWidth / 2;
                leftPos = Math.max(0, Math.min(width - tooltipWidth, leftPos));
                progressTooltip.style.left = `${leftPos}px`;
            });

            progressContainer.addEventListener('mouseenter', () => {
                progressTooltip.style.opacity = '1';
            });

            progressContainer.addEventListener('mouseleave', () => {
                progressTooltip.style.opacity = '0';
            });
        }

        // Time update
        audio.addEventListener('timeupdate', () => {
            if (audio.duration) {
                const progressPercent = (audio.currentTime / audio.duration) * 100;
                progress.style.width = `${progressPercent}%`;
                if (currentTimeEl) currentTimeEl.textContent = formatTime(audio.currentTime);
                if (durationEl) durationEl.textContent = formatTime(audio.duration);
            }
        });

        // Metadata loaded → update duration
        audio.addEventListener('loadedmetadata', () => {
            if (durationEl) durationEl.textContent = formatTime(audio.duration);
            if (playlistItems[currentSong]) {
                playlistItems[currentSong].querySelector('.playlist-item-duration').textContent = formatTime(audio.duration);
            }
        });

        // Song ended → next
        audio.addEventListener('ended', () => {
            if (repeatMode === 1) { // Repeat one
                audio.currentTime = 0;
                playSong();
                return;
            }

            let nextIndex;
            if (isShuffle && playlistItems.length > 1) {
                do {
                    nextIndex = Math.floor(Math.random() * playlistItems.length);
                } while (nextIndex === currentSong);
            } else {
                nextIndex = (currentSong + 1) % playlistItems.length;
            }

            // If repeat all is off and it's the last song → stop
            if (repeatMode === 0 && !isShuffle && currentSong === playlistItems.length - 1) {
                pauseSong();
                return;
            }

            loadSong(nextIndex);
            playSong();
        });

        // Click on playlist item
        playlistItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                if (index === currentSong) {
                    togglePlayPause();
                } else {
                    loadSong(index);
                    playSong();
                }
            });
        });

        // Preload all track durations
        function preloadAllDurations() {
            playlistItems.forEach((item, index) => {
                const tempAudio = new Audio(item.getAttribute('data-audio'));
                tempAudio.addEventListener('loadedmetadata', () => {
                    const realDuration = formatTime(tempAudio.duration);
                    item.querySelector('.playlist-item-duration').textContent = realDuration;
                });
            });
        }

        // Initial setup
        updateVolumeIcon();
        updateVolumeFill();
        loadSong(0);
        preloadAllDurations();
    }

    // Elementor handler
    const classicAudioPlaylistHandler = function ($scope) {
        const container = $scope.find('.classic-playlist-container')[0];
        if (container && container.querySelector('.audio')) {
            initializeClassicAudioPlaylist(container);
        }
    };

    $(document).ready(function () {
        $('.classic-playlist-container').each(function () {
            if (this.querySelector('.audio')) {
                initializeClassicAudioPlaylist(this);
            }
        });
    });

    // Register with Elementor
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/classic-audio-playlist.default',
            classicAudioPlaylistHandler
        );
    });

})(jQuery, window.elementorFrontend);