(function ($) {
    const makeDialog = () => {
        if (window.fsUpgradeDialog) return window.fsUpgradeDialog;

        window.fsUpgradeDialog = elementorCommon.dialogsManager.createWidget('confirm', {
            id: 'fs-upgrade-dialog',
            headerMessage: FS_Lock.title || 'Unlock Pro',
            message: FS_Lock.message || 'This feature is available in Pro.',
            position: { my: 'center center', at: 'center center' },

            // 👇 Prevent the “open then instantly close” behavior
            hide: {
                onOutsideClick: false,
                onBackgroundClick: false,
                onEscKeyPress: false,
            },

            strings: {
                confirm: FS_Lock.confirm || 'Upgrade',
                cancel: FS_Lock.cancel || 'Close'
            },
            onConfirm: () => window.open(FS_Lock.upgradeUrl, '_blank')
        });

        return window.fsUpgradeDialog;
    };

    // One handler that fully swallows the event and opens the dialog a tick later
    const intercept = (e) => {
        e.preventDefault();
        e.stopPropagation();
        if (e.stopImmediatePropagation) e.stopImmediatePropagation();

        const dlg = makeDialog();
        setTimeout(() => dlg.show(), 0); // defer so mouseup can’t hit the overlay
        return false;
    };

    const selectors = [
        '.elementor-control.fs-locked .elementor-control-input :input',
        '.elementor-control.fs-locked .elementor-switch',
        '.elementor-control.fs-locked .elementor-choices label',
        '.elementor-control.fs-locked .wp-picker-container',
        '.elementor-control.fs-locked .noUi-handle',
        '.elementor-control.fs-locked .elementor-button',
        '.elementor-control.fs-locked .elementor-control-content',
        '.elementor-control.fs-locked .elementor-control-media',
        '.elementor-control.fs-locked .elementor-control-input-wrapper',
        '.fs-locked .elementor-control-content .elementor-control-raw-html',
        '.fs-locked .elementor-control-dynamic-switcher-wrapper'
    ].join(',');


    // Bind on 'click' (not mousedown) to avoid overlay click on mouseup
    $(document)
        .on('click', selectors, intercept)
        .on('keydown change input', selectors, function (e) {
            // revert any accidental input change, then show dialog
            if (this && (this.type === 'checkbox' || this.type === 'radio')) this.checked = !this.checked;
            if (this && (this.tagName === 'INPUT' || this.tagName === 'SELECT' || this.tagName === 'TEXTAREA')) {
                this.value = this.defaultValue;
            }
            intercept(e);
        });

    // Block WP color picker before it opens
    $(document).on('wpcolorpicker:beforecreate', function (e) {
        const t = e && e.target;
        if (t && $(t).closest('.elementor-control').hasClass('fs-locked')) intercept(e);
    });
})(jQuery);
