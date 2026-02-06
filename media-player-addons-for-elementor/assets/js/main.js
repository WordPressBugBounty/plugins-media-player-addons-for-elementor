(function ($) {
  $(window).on("elementor/frontend/init", function () {

    //this is for HTML5 youtube player
    elementorFrontend.hooks.addAction("frontend/element_ready/YoutubeVideoPlayer.default", 
      function (scope) {
        initYouTubePlayer(scope);
      }
    );

    //this is for vimeo player
    elementorFrontend.hooks.addAction("frontend/element_ready/VemioVideoPlayer.default", 
      function (scope) {
        initVimeoPlayer(scope);
      }
    );

  });

  //Vimeo Player frontend view
  initVimeoPlayer($);
  function initVimeoPlayer(scope) {
    const playerElement = $(scope).find(".vimeo_player");

      let controls = $(playerElement).attr("data-settings");
      controls = JSON.parse(controls);
      autoplay = controls['autoplay'];
      if (autoplay == "yes") {
        autoplay = true;
      } else {
        autoplay = false;
      }
      controls = Object.keys(controls).map((index) => {
        if (controls[index] == "yes") {
          return index;
        }
      });
      const player = new Plyr(playerElement, {
        controls: controls,
        autoplay: autoplay,
        muted: autoplay ?  true : false,
        tooltips: { controls: true },
      });
  }
  
  // YouTube Player frontend view
  initYouTubePlayer($);
  function initYouTubePlayer(scope) {
    const playerElement = $(scope).find(".youtube_player");

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
