$(function() {

    var aide = {};
    var recording = false;


    /**
     * Driver function
     */
    var init = function() {

        get_aide_meta();
        cycle_li_answers();
        toggle_answer();
        toggle_hide_all();
        queue_recording_controls();

    };


    /**
     * Get interview answer meta
     */
    var get_aide_meta = function() {

        $.ajax({
            cache: false,
            async: false,
            url: "_/js/aide.json",
            datatype: "json",
            success: function(meta) {
                if (typeof(meta) !== 'object') {
                    meta = $.parseJSON(meta);
                }
                aide = meta;
            },
            error: function(meta) {
                console.log(meta);
                alert('Error parsing JSON');
            }
        });

    };


    /**
     * Template for JSON supplied interview answers
     * @param  {string} prop    Class property
     * @return {string}         Aide HTML markup
     */
    var render_aide_meta = function(prop) {

        var output = aide[prop].li;

        if ( ! aide[prop].ul ) return output;

        output += '<ul>';

        for (var i in aide[prop].ul) {
            output += '<li>' + aide[prop].ul[i].li + '</li>';
        }

        output += '</ul>';

        return output;

    };


    /**
     * Fill in JSON supplied interview answers
     */
    var cycle_li_answers = function() {

        var li_answers = $('.answer > ul > li');
        $.each(li_answers, function(i, a) {

            var c = $(a).attr('class');
            if (c in aide) {

                var markup = render_aide_meta(c);
                $('.' + c).html(markup);

            } else {
                $('.' + c).html('<span class="alert">NEED TO ADD JSON ENTRY FOR: ' + c + '</span>');
            }

        });

    };


    /**
     * Record questions and answers asked
     * @param  {object} t    Passed in jQuery object
     */
    function log_answer(t) {

        if (recording) {

            var c = t.attr('class').replace(/ (not-)?asked/, '');

            $('#summary > ol').append(
                '<li class="toggle-aide">' + c +
                    '<ul class="hidden">' +
                        '<li>' + t.html() + '</li>' +
                    '</ul>' +
                '</li>'
            );

        }

        // Mark as answered
        t.addClass('grayed-out');

    }


    /**
     * Show or hide answers on question click
     */
    var toggle_answer = function() {

        // Mark answers as answered and log
        $('.block > ul > li, .answer > ul > li').click(function() {
            log_answer($(this));
        });

        // Open and close accordions
        $('.title').click(function() {
            $(this).parent().find('.answer').toggleClass('hidden');
        });

    };


    /**
     * Close all accordions
     */
    var toggle_hide_all = function() {

        $('.close').click(function() {
            $('.generic .answer').addClass('hidden');
        });

    };


    /**
     * Turn recording on or off
     * @param  {bool} r    On if true; Off if false
     */
    var toggle_recording = function(r) {

        $('#start').toggleClass('hidden');
        $('#stop').toggleClass('hidden');

        recording = r;

    };


    /**
     * Allow the user to easily copy interview aide summary
     */
    var queue_copy_answers = function() {

        // Escape double-quotes for easy insertion into interview file
        var report = $('#summary').html().replace(/"/g, '\\"');

        $('#copy-answers').click(function() {
            window.prompt("Copy to clipboard: Ctrl+C, Enter", report);
        });

    };


    /**
     * Drive events following stop click
     */
    var queue_stop_recording = function() {

        $('#stop').click(function() {

            toggle_recording(false);

            // Enqueue copy answers functionality
            $('#summary').after('<button id="copy-answers">Copy to clipboard</button>');
            queue_copy_answers();

            // Show the report
            $('#report').toggleClass('hidden');

        });

    };


    /**
     * Drive events following start click
     */
    var queue_start_recording = function() {

        $('#start').click(function() {

            toggle_recording(true);

            // Unmark answered answers
            $('.block > ul > li').removeClass('grayed-out');
            $('.answer > ul > li').removeClass('grayed-out');

            // Prep the summary div
            var s = $('#summary');

            s.html('');
            s.append('<ol></ol>');

            // Ensure the report is hidden
            $('#report').addClass('hidden');

            // Remove old copy button
            $('#copy-answers').remove();

        });

    };


    /**
     * Enqueue recording start and stop
     */
    var queue_recording_controls = function() {

        queue_start_recording();
        queue_stop_recording();

    };


    // Here we go!
    init();

});
