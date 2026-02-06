jQuery(window).on('elementor:init', function() {
    // When Elementor editor is ready
    const lockWidget = () => {
        jQuery('#elementor-panel-category-b_pro_widgets .elementor-element').each(function() {
            const $widget = jQuery(this);

            if (!$widget.hasClass('locked-widget')) {
                $widget.addClass('locked-widget');

                // Disable drag
                $widget.attr('draggable', false);

                // Add a PRO badge
                const title = $widget.find('.elementor-element-title-wrapper, .elementor-element-title, .title');
                if (title.find('.pro-badge').length === 0) {
                    title.append('<span class="pro-badge">PRO</span>');
                }
            }
        });
    };

    setInterval(lockWidget, 1500); // recheck (Elementor loads dynamically)
});

//Prevent drag or open and show upgrade notice
// jQuery(document).on('mousedown', '.locked-widget', function(e) {
//     e.preventDefault();
//     e.stopPropagation();
//     if (typeof elementor !== 'undefined' && elementor.notifications) {
//         elementor.notifications.showToast({
//             message: 'This widget is available in the Pro version. Upgrade to unlock!',
//             time: 3000
//         });
//     } else {
//         alert('This widget is available in the Pro version. Upgrade to unlock!');
//     }
// });


/* assets/modal.js */
(function ($, elementor) {
    'use strict';

    // Wait until the panel is ready
    $(document).on('mousedown', '.locked-widget', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // ------------------------------------------------------------------
        // 1. Build the modal HTML (exactly the same style Elementor Pro uses)
        // ------------------------------------------------------------------
        const modalHTML = `
        <div id="my-locked-widget-modal" class="elementor-modal elementor-modal-pro">
            <div class="elementor-modal__overlay"></div>
            <div class="elementor-modal__content">
                <div class="elementor-modal__header">
                    <h3> ${elementor.translate('Media Player Addons Pro Feature')}</h3>
                    <button class="elementor-modal__close" aria-label="Close">×</button>
                </div>
                <div class="elementor-modal__body">
                    <p style="font-size:16px; line-height:1.5;">
                        Use <strong>${MyLockedWidget.widgetName}'s</strong> dozens more pro features to extend your toolbox and build sites faster and better.
                    </p>
                    <div style="text-align:center; margin:20px 0;">
                        <!-- replace the URL above with your own image if you want -->
                    </div>
                </div>
                <div class="elementor-modal__footer">
                    <a href="${MyLockedWidget.upgradeUrl}" target="_blank" class="elementor-button elementor-button-success">
                        ${elementor.translate('Upgrade to Pro')}
                    </a>
                </div>
            </div>
        </div>`;

        // ------------------------------------------------------------------
        // 2. Insert modal (only once)
        // ------------------------------------------------------------------
        if (!$('#my-locked-widget-modal').length) {
            $('body').append(modalHTML);
        }

        // ------------------------------------------------------------------
        // 3. Open it
        // ------------------------------------------------------------------
        $('#my-locked-widget-modal')
            .addClass('elementor-modal-open')
            .show();

        // ------------------------------------------------------------------
        // 4. Close handlers
        // ------------------------------------------------------------------
        $('#my-locked-widget-modal .elementor-modal__close, #my-locked-widget-modal .elementor-modal__overlay').on('click', function () {
            $('#my-locked-widget-modal').removeClass('elementor-modal-open').hide();
        });

        // Close with ESC
        $(document).on('keyup.myLockedModal', function (ev) {
            if (ev.key === 'Escape') {
                $('#my-locked-widget-modal .elementor-modal__close').trigger('click');
            }
        });
    });

})(jQuery, elementor);