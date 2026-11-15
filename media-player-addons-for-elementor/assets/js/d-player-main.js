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
        
        const hexColorRe = /^#[0-9a-fA-F]{3,6}$/;
        const safeTheme  = hexColorRe.test(settings.player_theme)  ? settings.player_theme  : '#b7daff';
        const safeColor  = hexColorRe.test(settings.sub_d_bg)      ? settings.sub_d_bg      : '#ffffff';
        const safeFontSz = (typeof settings.p_font === 'object' && Number.isInteger(settings.p_font.size))
            ? settings.p_font.size + 'px'
            : '16px';

        const options = {
    //    container: document.getElementById("dplayer"),
            container:  playerElement[0],
            theme: safeTheme,
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
            fontSize: safeFontSz,
            bottom: "10%",
            color: safeColor,
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