jQuery(document).ready(function($) {
    function closePanel() {
        $('#bpt-panel').removeClass('open');
        $('#bpt-tab').show();
    }

    $('#bpt-tab').on('click', function() {
        $('#bpt-panel').addClass('open');
        $(this).hide();
    });

    $('#bpt-close').on('click', function() {
        closePanel();
    });

    $(document).on('click', function(e) {
        if ($('#bpt-panel').hasClass('open') && !$(e.target).closest('#bpt-panel, #bpt-tab').length) {
            closePanel();
        }
    });
});