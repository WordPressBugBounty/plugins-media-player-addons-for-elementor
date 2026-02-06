(function ($) {
    $(window).on("elementor/frontend/init", function () {
        // this is a dPlayer
        elementorFrontend.hooks.addAction("frontend/element_ready/dPlayer.default", 
            function (scope) {
                initDPlayer(scope);
            }
        );
    });
    
    // dPayer Frontend View
    initDPlayer($);
    function initDPlayer(scope) {
        const playerElement = $(scope).find("#dplayer");

        let settings = $(playerElement).attr("data-settings");
        settings = JSON.parse(settings);

        let subtitleUrl = "";
        if (typeof settings.dplayer_upload != "undefined") {
            subtitleUrl = settings.dplayer_upload.url;
        }
        //for multiple quality
        const video_d_list = settings.video_d_list;
        let newVideiList = [];
        if (settings.choose_v_source === "yes") {
            newVideiList = video_d_list.map((item) => {
            const video = {};
            video.name = item.video_d_size;
            video.type = "auto";
            if (item.src_v_type == "link") {
                video.url = item.video_v_link;
            } else {
                video.url = item.video_v_upload.url;
            }

            return video;
            });
        } else {
            if (settings.srrc_type == "liink") {
            single_video = settings.videoos_link;
            } else {
            single_video = settings.videoos_upload.url;
            }
            newVideiList = [
            {
                url: single_video,
                type: "auto",
            },
            ];
        }
        
        const options = {
    //    container: document.getElementById("dplayer"),
            container:  playerElement[0],
            theme: settings.player_theme,
            lang: "en",
            screenshot: true,
            hotkey: true,
            preload: "auto",
            volume: 0.7,
            mutex: true,
            video: {
            quality: newVideiList,
            defaultQuality: 0,
            },
            subtitle: {
            url: subtitleUrl,
            type: "webvtt",
            fontSize: settings.p_font,
            bottom: "10%",
            color: settings.sub_d_bg,
            },
        };

        if (settings.custom_banner_d === "true") {
            options.video.thumbnails = settings.banner.url;
            options.video.pic = settings.banner.url;
        }

        if (settings.custom_logo_d === "true") {
            options.logo = settings.d_logo.url;
        }

        if (settings.auto_play === "yes") {
            options.autoplay = true;
        }
        if (settings.video_loop === "yes") {
            options.loop = true;
        }

        const dp = new DPlayer(options);
    }
})(jQuery);