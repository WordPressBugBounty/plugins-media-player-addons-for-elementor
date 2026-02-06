( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	// Make sure you run this code under Elementor.

	// Video Playlist
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bplayer-vdo-playlist.default', 
			function (scope) {
				initVideoPlayerPlaylist(scope);
			}
		 );
	} );

	initVideoPlayerPlaylist($);
	function initVideoPlayerPlaylist(scope) {
		let plyerId = $(scope).find('#video-play-list-app');
		let plyer_opt = $(plyerId).data('settings');

		console.log(plyer_opt);
		const songs = plyer_opt.media_source || {};
		//console.log('songs', songs)

		const playlist = songs.map(item => {
			const video = {
				src: item.track_source.url,
				poster: item.track_poster.url,
				name: item.track_title,
				artist:item.track_artist_name,
				//lyric: item.track_lyrics,
				album: item.track_album,
				type: 'video'
			}
			return video;
		});
		let player = new cplayer({
			element: plyerId[0],
			// element: document.getElementById('app'),
			playlist,
			dark: plyer_opt?.dark_mode,
			big: true,
			zoomOutKana: true,
			shadowDom: true,
		})
	}
	

} )( jQuery );


