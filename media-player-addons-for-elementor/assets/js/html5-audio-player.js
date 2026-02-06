(function ($) {
    //this is for HTML5 Audio player
    $( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction("frontend/element_ready/Html5AudioPlayer.default", 
            function (scope) {
                initHtml5AudioPlayer(scope);
            }
        );
	} );

    // HTML5 Audio  Player
    initHtml5AudioPlayer($);
    function initHtml5AudioPlayer(scope) {
        const playerElement = $(scope).find(".audio_player");

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
    }
})(jQuery);