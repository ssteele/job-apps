$(function() {


    /**
     * Driver function
     */
    var init = function() {

        alert_app_count();
        copy_to_clipboard();

    };


    /**
     * Count up the number of jobs applied to and alert
     */
    var alert_app_count = function() {

        $('#apply_count').click(function() {

            var total = $('.applied-for');
            alert('You have applied to ' + total.length + ' jobs.');

        });

    };


    var copy_to_clipboard = function() {

        $('.copy-to-clipboard').click(function() {

            var path = $(this).attr('id');
            window.prompt("Copy to clipboard: Ctrl+C, Enter", path);

        });

    };


    // Ya'll want this party started quickly... right?
    init();

});
