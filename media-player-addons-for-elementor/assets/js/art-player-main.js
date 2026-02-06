(function ($) {
    $(window).on("elementor/frontend/init", function () {
        // this is a art player
        elementorFrontend.hooks.addAction("frontend/element_ready/artvideoplayer.default", 
        function (scope) {
            initArtVideoPlayer(scope);
        }
        );
    });
    
    // Art Payer Frontend View
    initArtVideoPlayer($);
    function initArtVideoPlayer( scope ) {
        const playerElement = $(scope).find(".artplayer-app");

        let settings = $(playerElement).attr("data-settings");
        let controls = $(playerElement).data("controls");
        const id = $(playerElement).attr("id");

        settings = JSON.parse(settings);

        const { multiple_quality } = controls;

        Object.keys(controls).map((index) => {
            if (controls[index] == "yes") {
            controls[index] = true;
            } else {
            controls[index] = false;
            }
        });

        //for single video
        let single_video = "";
        if (settings.srrc_type == "liink") {
            single_video = settings.vxideoos_link;
        } else {
            single_video = settings.vxideoos_upload.url;
        }

        //for subtitle
        const subtitle = {
            color: settings.sub_bg,
        };
        if (settings.sxrc_typed === "linkks") {
            subtitle.url = settings.sxubtitle_link;
        } else {
            subtitle.url = settings.sxubtitle_upload.url;
        }

        //for multiple quality
        const video_list = settings.vxideo_list;
        let newVideiList = [];
        if (multiple_quality == "yes") {
            newVideiList = video_list.map((item) => {
            const video = {};
            video.name = item.vxideo_size;
            if (item.sxrc_type == "link") {
                video.url = item.vxideoos_link;
            } else {
                video.url = item.vxideoos_upload.url;
            }

            return video;
            });

            if (newVideiList.length > 0) {
            single_video = newVideiList[0].url;
            }
        }

        const player = new Artplayer({
            container: "#" + id,
            url: `${single_video}`,
            poster: `${settings.bar_img.url}`,
            volume: 0.5,
            isLive: false,
            muted: controls.vd_muted,
            autoplay: controls.vd_auto_p,
            pip: controls.vd_pip,
            autoSize: true,
            autoMini: true,
            screenshot: controls.vd_camera,
            setting: controls.vd_settings,
            loop: true,
            flip: true,
            rotate: true,
            playbackRate: true,
            aspectRatio: true,
            fullscreen: controls.vd_full_screen,
            fullscreenWeb: controls.vd_full_web,
            subtitleOffset: true,
            miniProgressBar: true,
            localVideo: true,
            localSubtitle: true,
            networkMonitor: false,
            mutex: true,
            light: true,
            backdrop: true,
            theme: `${settings.vd_color}`,

            lang: navigator.language.toLowerCase(),
            moreVideoAttr: {
            crossOrigin: "anonymous",
            },
            contextmenu: [
            {
                html: "Custom menu",
                click: function (contextmenu) {
                console.info("You clicked on the custom menu");
                contextmenu.show = false;
                },
            },
            ],

            quality: newVideiList,
            subtitle: {
            url: `${subtitle.url}`,
            style: {
                color: `${subtitle.color}`,
            },
            encoding: "utf-8",
            bilingual: true,
            },

            icons: {
            state: `<img src="${settings.video_album_poster.url}">`,
            },
        });
    }
})(jQuery);