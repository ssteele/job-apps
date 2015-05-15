$(function() {

    /**
     * Driver function
     */
    var init = function() {

        toggle_interview_answers();

    };


    /**
     * Show and hide interview aide questions asked
     */
    var toggle_interview_answers = function() {

        // All answers
        $('.aide h3').click(function() {
            $(this).parent().find('.toggle-aide > ul').toggleClass('hidden');
        });

        // Individual answers
        $('.toggle-aide').click(function() {
            $(this).find('> ul').toggleClass('hidden');
        });

    };


    // Let's do it!
    init();

});
