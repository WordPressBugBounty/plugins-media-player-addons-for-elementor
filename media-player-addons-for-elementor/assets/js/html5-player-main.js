(function ($) {
	$( window ).on( 'elementor/frontend/init', function() {
		//this is for HTML5 VIDEO player
        elementorFrontend.hooks.addAction("frontend/element_ready/Html5VideoPlayer.default", 
            function (scope) {
                initHtml5VideoPlayer(scope);
            }
        );
	} );

    // HTML5 Video  Player
    initHtml5VideoPlayer($);
    function initHtml5VideoPlayer(scope) {
        const playerElement = $(scope).find("video");
        let controls = $(playerElement).attr("data-settings");
        controls = JSON.parse(controls);
        controls = Object.keys(controls).map((index) => {
            if (controls[index] == "yes") {
            return index;
            }
        });
        const player = new Plyr(playerElement, {
            controls: controls,
            tooltips: { controls: true },
        });

        if (Hls.isSupported() && player.source.includes(".m3u8")) {
            const hls = new Hls();
            hls.loadSource(player.source);
            hls.attachMedia(playerElement[0]);

            player.on("languagechange", () => {
            setTimeout(() => (hls.subtitleTrack = player.currentTrack), 50);
            });
        }
    }
})(jQuery);
