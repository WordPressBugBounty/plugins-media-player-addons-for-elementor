// const playlistItems = document.querySelectorAll(".playlist-item");
// const likeBtns = document.querySelectorAll(".like-btn");
// const audioPlayer = document.getElementById("audioPlayer");
// const volumeRange = document.getElementById("volume-range");
// const progressBar = document.getElementById("progress-bar");
// const playPauseBtn = document.getElementById("playPauseBtn");
// const playPauseIcon = document.getElementById("playPauseIcon");
// const prevBtn = document.getElementById("prevBtn");
// const nextBtn = document.getElementById("nextBtn");
// const shuffleBtn = document.getElementById("shuffleBtn");

// let currentSongIndex = 2;
// let isSongLoaded = false;

// const songs = [
//   "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/SynCole-FeelGood.mp3",
//   "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/HarddopeClarx-Castle.mp3",
//   "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/PlayDead-NEFFEX.mp3",
//   "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/KnowMyself-PatrickPatrikios.mp3",
//   "https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/BesomorphCoopex-Redemption.mp3",
// ];

// playlistItems.forEach((item, index) => {
//   const audio = new Audio(songs[index]);
//   const durationElement = item.querySelector(".duration");

//   audio.addEventListener("loadedmetadata", () => {
//     const minutes = Math.floor(audio.duration / 60);
//     const seconds = Math.floor(audio.duration % 60).toString().padStart(2, "0");
//     durationElement.textContent = `${minutes}:${seconds}`;
//   });
// });

// var swiper = new Swiper(".swiper", {
//   effect: "cards",
//   cardsEffect: {
//     perSlideOffset: 9,
//     perSlideRotate: 3,
//   },
//   grabCursor: true,
//   speed: 700,
//   initialSlide: 2,
// });

// swiper.on("slideChange", () => {
//   const newIndex = swiper.realIndex;
//   if (newIndex !== currentSongIndex) {
//     currentSongIndex = newIndex;
//     loadAndPlaySong(currentSongIndex);
//     updatePlayPauseIcon(true);
//   }
// });

// function updateSwiperToMatchSong(index) {
//   if (swiper.activeIndex !== index) {
//     swiper.slideTo(index);
//   }
// }

// function updatePlaylistHighlight(index) {
//   playlistItems.forEach((item, i) => {
//     if (i === index) {
//       item.classList.add("active-playlist-item");
//     } else {
//       item.classList.remove("active-playlist-item");
//     }
//   });
// }

// function loadAndPlaySong(index) {
//   audioPlayer.src = songs[index];
//   playSong();
//   updatePlaylistHighlight(index);
//   updateSwiperToMatchSong(index);
//   isSongLoaded = true;
// }

// function pauseSong() {
//   audioPlayer.pause();
//   updatePlayPauseIcon(false);
// }

// function playSong() {
//   audioPlayer.play();
//   updatePlayPauseIcon(true);
// }

// function togglePlayPause() {
//   if (!isSongLoaded) {
//     loadAndPlaySong(currentSongIndex);
//     isSongLoaded = true;
//   } else if (audioPlayer.paused) {
//     playSong();
//   } else {
//     pauseSong();
//   }
// }

// function updatePlayPauseIcon(isPlaying) {
//   if (isPlaying) {
//     playPauseIcon.classList.add("fa-pause");
//     playPauseIcon.classList.remove("fa-play");
//   } else {
//     playPauseIcon.classList.add("fa-play");
//     playPauseIcon.classList.remove("fa-pause");
//   }
// }

// function nextSong() {
//   currentSongIndex = (currentSongIndex + 1) % songs.length;
//   loadAndPlaySong(currentSongIndex);
//   swiper.slideTo(currentSongIndex);
// }

// function prevSong() {
//   currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
//   loadAndPlaySong(currentSongIndex);
//   swiper.slideTo(currentSongIndex);
// }

// playlistItems.forEach((item, index) => {
//   item.addEventListener("click", () => {
//     currentSongIndex = index;
//     loadAndPlaySong(index);
//   });
// });

// playPauseBtn.addEventListener("click", togglePlayPause);
// nextBtn.addEventListener("click", nextSong);
// prevBtn.addEventListener("click", prevSong);

// audioPlayer.addEventListener("loadedmetadata", () => {
//   progressBar.max = audioPlayer.duration;
//   console.log(audioPlayer.duration);

//   progressBar.value = audioPlayer.currentTime;

// });

// audioPlayer.addEventListener("timeupdate", () => {
//   if (!audioPlayer.paused) {
//     progressBar.value = audioPlayer.currentTime;
//     console.log(audioPlayer.currentTime);
//   }
// });

// progressBar.addEventListener("input", () => {
//   audioPlayer.currentTime = progressBar.value;
// });

// progressBar.addEventListener("change", () => {
//   playSong();
// });

// volumeRange.addEventListener("input", () => {
//   var newVolume = volumeRange.value;
//   audioPlayer.volume = newVolume / 100;
// });

// audioPlayer.addEventListener("ended", nextSong);

// shuffleBtn.addEventListener("click", () => {
//   const randomIndex = Math.floor(Math.random() * songs.length);

//   if (randomIndex !== currentSongIndex) {
//     currentSongIndex = randomIndex;
//     loadAndPlaySong(currentSongIndex);
//   } else {
//     const nextRandomIndex = (randomIndex + 1) % songs.length;
//     currentSongIndex = nextRandomIndex;
//     loadAndPlaySong(currentSongIndex);
//   }
// });

// likeBtns.forEach((likeBtn) => {
//   likeBtn.addEventListener("click", (e) => {
//     e.stopPropagation();
//     likeBtn.classList.toggle("fa-regular");
//     likeBtn.classList.toggle("fa-solid");
//   });
// });


// function formatTime(seconds) {
//   if (isNaN(seconds)) return "00:00";
//   const mins = Math.floor(seconds / 60);
//   const secs = Math.floor(seconds % 60).toString().padStart(2, "0");
//   return `${mins.toString().padStart(2, "0")}:${secs}`;
// }

// const currentTimeEl = document.getElementById("current-time");
// const totalDurationEl = document.getElementById("total-duration");

// audioPlayer.addEventListener("loadedmetadata", () => {
//   progressBar.max = audioPlayer.duration;
//   totalDurationEl.textContent = formatTime(audioPlayer.duration);
// });

// audioPlayer.addEventListener("timeupdate", () => {
//   progressBar.value = audioPlayer.currentTime;
//   currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
// });

(function ($) {
    const initPlayer = function ($scope) {
        try {
            const widgetElement = $scope[0];

            // Check for critical DOM elements
            const playlistContainer = widgetElement.querySelector(".playlist-container");
            const audioPlayer = widgetElement.querySelector("#audioPlayer");
            const playlistItems = widgetElement.querySelectorAll(".playlist-item");
            const playPauseBtn = widgetElement.querySelector("#playPauseBtn");
            const playPauseIcon = widgetElement.querySelector("#playPauseIcon");
            const prevBtn = widgetElement.querySelector("#prevBtn");
            const nextBtn = widgetElement.querySelector("#nextBtn");
            const shuffleBtn = widgetElement.querySelector("#shuffleBtn");
            const progressBar = widgetElement.querySelector("#progress-bar");
            const volumeRange = widgetElement.querySelector("#volume-range");
            const currentTimeEl = widgetElement.querySelector("#current-time");
            const totalDurationEl = widgetElement.querySelector("#total-duration");

            if (!audioPlayer || !playlistItems.length || !playPauseBtn) {
                console.error("Required elements missing:", {
                    audioPlayer: !!audioPlayer,
                    playlistItems: playlistItems.length,
                    playPauseBtn: !!playPauseBtn
                });
                return;
            }

            console.log(JSON.parse(playlistContainer.dataset.playlistSongs));

            const songs = JSON.parse(playlistContainer.dataset.playlistSongs);

            console.log(songs);
            

            let currentSongIndex = 0;
            let isSongLoaded = false;

            // Initialize Swiper
            const swiperElement = widgetElement.querySelector(".swiper");
            if (!swiperElement) {
                console.error("Swiper container (.swiper) not found.");
                return;
            }
            const swiper = new Swiper(swiperElement, {
                effect: "cards",
                grabCursor: true,
                speed: 700,
                initialSlide: 2,
            });

            // Set song durations
            playlistItems.forEach((item, index) => {
                const audio = new Audio(songs[index]);
                const durationElement = item.querySelector(".duration");
                audio.addEventListener("loadedmetadata", () => {
                    const minutes = Math.floor(audio.duration / 60);
                    const seconds = Math.floor(audio.duration % 60).toString().padStart(2, "0");
                    durationElement.textContent = `${minutes}:${seconds}`;
                });
            });

            swiper.on("slideChange", () => {
                const newIndex = swiper.realIndex;
                if (newIndex !== currentSongIndex) {
                    currentSongIndex = newIndex;
                    loadAndPlaySong(currentSongIndex);
                    updatePlayPauseIcon(true);
                }
            });

            function updateSwiperToMatchSong(index) {
                if (swiper.activeIndex !== index) {
                    swiper.slideTo(index);
                }
            }

            function updatePlaylistHighlight(index) {
                playlistItems.forEach((item, i) => {
                    if (i === index) {
                        item.classList.add("active-playlist-item");
                    } else {
                        item.classList.remove("active-playlist-item");
                    }
                });
            }

            function loadAndPlaySong(index) {
                audioPlayer.src = songs[index];
                playSong();
                updatePlaylistHighlight(index);
                updateSwiperToMatchSong(index);
                isSongLoaded = true;
            }

            function pauseSong() {
                audioPlayer.pause();
                updatePlayPauseIcon(false);
            }

            function playSong() {
                audioPlayer.play();
                updatePlayPauseIcon(true);
            }

            function togglePlayPause() {
                if (!isSongLoaded) {
                    loadAndPlaySong(currentSongIndex);
                    isSongLoaded = true;
                } else if (audioPlayer.paused) {
                    playSong();
                } else {
                    pauseSong();
                }
            }

            function updatePlayPauseIcon(isPlaying) {
                if (isPlaying) {
                    playPauseIcon.classList.add("fa-pause");
                    playPauseIcon.classList.remove("fa-play");
                } else {
                    playPauseIcon.classList.add("fa-play");
                    playPauseIcon.classList.remove("fa-pause");
                }
            }

            function nextSong() {
                currentSongIndex = (currentSongIndex + 1) % songs.length;
                loadAndPlaySong(currentSongIndex);
                swiper.slideTo(currentSongIndex);
            }

            function prevSong() {
                currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
                loadAndPlaySong(currentSongIndex);
                swiper.slideTo(currentSongIndex);
            }

            playlistItems.forEach((item, index) => {
                item.addEventListener("click", () => {
                    currentSongIndex = index;
                    loadAndPlaySong(index);
                });
            });

            playPauseBtn.addEventListener("click", togglePlayPause);
            nextBtn.addEventListener("click", nextSong);
            prevBtn.addEventListener("click", prevSong);

            audioPlayer.addEventListener("loadedmetadata", () => {
                progressBar.max = audioPlayer.duration;
                console.log(audioPlayer.duration);

                progressBar.value = audioPlayer.currentTime;

            });

            audioPlayer.addEventListener("timeupdate", () => {
                if (!audioPlayer.paused) {
                    progressBar.value = audioPlayer.currentTime;
                    console.log(audioPlayer.currentTime);
                }
            });

            progressBar.addEventListener("input", () => {
                audioPlayer.currentTime = progressBar.value;
            });

            progressBar.addEventListener("change", () => {
                playSong();
            });

            volumeRange.addEventListener("input", () => {
                var newVolume = volumeRange.value;
                audioPlayer.volume = newVolume / 100;
            });

            audioPlayer.addEventListener("ended", nextSong);

            shuffleBtn.addEventListener("click", () => {
                const randomIndex = Math.floor(Math.random() * songs.length);

                if (randomIndex !== currentSongIndex) {
                    currentSongIndex = randomIndex;
                    loadAndPlaySong(currentSongIndex);
                } else {
                    const nextRandomIndex = (randomIndex + 1) % songs.length;
                    currentSongIndex = nextRandomIndex;
                    loadAndPlaySong(currentSongIndex);
                }
            });

            const likeBtns = widgetElement.querySelectorAll(".like-btn");
            likeBtns.forEach((likeBtn) => {
                likeBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    likeBtn.classList.toggle("fa-regular");
                    likeBtn.classList.toggle("fa-solid");
                });
            });


            function formatTime(seconds) {
                if (isNaN(seconds)) return "00:00";
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60).toString().padStart(2, "0");
                return `${mins.toString().padStart(2, "0")}:${secs}`;
            }

            audioPlayer.addEventListener("loadedmetadata", () => {
                progressBar.max = audioPlayer.duration;
                totalDurationEl.textContent = formatTime(audioPlayer.duration);
            });

            audioPlayer.addEventListener("timeupdate", () => {
                progressBar.value = audioPlayer.currentTime;
                currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
            });
        } catch (error) {
            console.error("Error initializing audio player:", error);
        }
    };

    // Elementor hook
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/advance-audio-playlist",
            initPlayer
        );
    });

    // Initialize on page load for non-Elementor contexts
    $(document).ready(function () {
        $('.playlist-wrapper').each(function () {
            initPlayer($(this));
        });
    });
})(jQuery);
