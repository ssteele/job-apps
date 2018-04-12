$(function() {

    var recording = false;


    /**
     * Driver function
     */
    var init = function()
    {
        getGeneralQuestions();
        toggleAnswer();
        toggleHideAll();
        queueRecordingControls();
    };


    /**
     * Get general interview questions and answers
     */
    var getGeneralQuestions = function()
    {
        var generalQuestionsAnswers = $.ajax({
            cache: false,
            url: '/src/jobs/interview-aide/json/general-question-answer.json',
            datatype: 'json'
        });

        generalQuestionsAnswers.done(function(questionsAnswers) {
            if (typeof(questionsAnswers) !== 'object') {
                questionsAnswers = $.parseJSON(questionsAnswers);
            }
        });

        generalQuestionsAnswers.fail(function(questionsAnswers) {
            console.log(questionsAnswers);
            alert('Error parsing JSON');
        });

        generalQuestionsAnswers.then(function(questionsAnswers) {
            cycleLiAnswers(questionsAnswers);
        });
    };


    /**
     * Template for JSON supplied interview questions and answers
     * @param  {string} answer    Class property
     * @return {string}           Aide HTML markup
     */
    var renderGeneralQuestions = function(answer)
    {
        var output = answer.li;

        if (! answer.ul) return output;

        output += '<ul>';

        for (var i in answer.ul) {
            output += '<li>' + answer.ul[i].li + '</li>';
        }

        output += '</ul>';

        return output;
    };


    /**
     * Fill in JSON supplied interview answers
     */
    var cycleLiAnswers = function(questionsAnswers)
    {
        var liAnswers = $('.answer > ul > li');
        $.each(liAnswers, function(i, a) {

            var question = $(a).attr('class');
            if (question in questionsAnswers) {

                var answer = questionsAnswers[question];
                var markup = renderGeneralQuestions(answer);
                $('.' + question).html(markup);

            } else {
                $('.' + question).html('<span class="alert">NEED TO ADD JSON ENTRY FOR: ' + question + '</span>');
            }

        });
    };


    /**
     * Record questions and answers asked
     * @param  {object} t    Passed in jQuery object
     */
    function logAnswer(t)
    {
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

        // Mark it (and similar questions in other sections) as answered
        var selector = t.attr('class');
        var spaceIndex = selector.indexOf(' ');
        if (-1 !== spaceIndex) {
            selector = selector.substr(0, spaceIndex);
        }

        $('li.' + selector).addClass('grayed-out');
    }


    /**
     * Show or hide answers on question click
     */
    var toggleAnswer = function()
    {
        // Mark answers as answered and log
        $('.block > ul > li, .answer > ul > li').click(function() {
            logAnswer($(this));
        });

        // Open and close accordions
        $('.title').click(function() {
            $(this).parent().find('.answer').toggleClass('hidden');
        });
    };


    /**
     * Close all accordions
     */
    var toggleHideAll = function()
    {
        $('.close').click(function() {
            $('.topics .answer').addClass('hidden');
        });
    };


    /**
     * Turn recording on or off
     * @param  {bool} r    On if true; Off if false
     */
    var toggleRecording = function(r)
    {
        $('#start').toggleClass('hidden');
        $('#stop').toggleClass('hidden');

        recording = r;
    };


    /**
     * Drive events following stop click
     */
    var queueStopRecording = function()
    {
        $('#stop').click(function() {

            toggleRecording(false);

            // Escape double-quotes and tags for easy insertion into interview file
            var markup = $('#summary').html().replace(/"/g, '\\"').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            $('#summary-markup').html(markup);

            // Show the report
            $('#report').toggleClass('hidden');

        });
    };


    /**
     * Drive events following start click
     */
    var queueStartRecording = function()
    {
        $('#start').click(function() {

            toggleRecording(true);

            // Unmark answered answers
            $('.block > ul > li').removeClass('grayed-out');
            $('.answer > ul > li').removeClass('grayed-out');

            // Prep the summary div
            var s = $('#summary');

            s.html('');
            s.append('<ol></ol>');

            // Ensure the report is hidden
            $('#report').addClass('hidden');

        });
    };


    /**
     * Enqueue recording start and stop
     */
    var queueRecordingControls = function()
    {
        queueStartRecording();
        queueStopRecording();
    };


    // Here we go!
    init();

});
