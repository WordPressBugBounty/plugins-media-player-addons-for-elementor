(function($) {
    'use strict';

    function sendRequest(action, $btn, successText) {
        $btn.attr('disabled', true).text('Processing...');
        $.ajax({
            url: allembedInstall.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: action,
                nonce: allembedInstall.nonce
            },
            success: function(response) {
                if (response.success) {
                    $btn.text(successText);
                    setTimeout(() => location.reload(), 500); 
                } else {
                    $btn.text('Error: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                $btn.text('Request failed!');
            }
        });
    }

    $(document).on('click', '#allembed-install-elementor', function(e) {
        e.preventDefault();
        sendRequest('allembed_install_plugin', $(this), 'Installed!');
    });

    $(document).on('click', '#allembed-activate-elementor', function(e) {
        e.preventDefault();
        sendRequest('allembed_activate_plugin', $(this), 'Activated!');
    });

})(jQuery);
