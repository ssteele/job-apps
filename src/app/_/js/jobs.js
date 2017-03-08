$(function() {


    /**
     * Driver function
     */
    var init = function()
    {
        alert_app_count();
        copy_to_clipboard();
        auto_generate();
    };


    /**
     * Count up the number of jobs applied to and alert
     */
    var alert_app_count = function()
    {
        $('#apply_count').click(function() {

            var total = $('.applied-for');
            alert('You have applied to ' + total.length + ' jobs.');

        });
    };


    /**
     * Provide expected asset name to user to copy and use as needed
     */
    var copy_to_clipboard = function()
    {
        $('.copy-to-clipboard').click(function() {

            var path = $(this).attr('id') + '.' + $(this).attr('data-type');
            window.prompt("Copy to clipboard: Ctrl+C, Enter", path);

        });
    };


    /**
     * Automatically generate php documents
     */
    var auto_generate_php = function()
    {
        $('.auto-generate-php').click(function() {
            alert();
        });
    }


    /**
     * Automatically generate latex documents
     */
    var auto_generate_latex = function()
    {
        $('.auto-generate-latex').click(function() {

            var icon = $(this).find('i');
            var iconClass = icon.attr('class');
            icon.attr('class', 'fa fa-fw fa-refresh fa-spin');

            var endpoint = 'src/app/ajax/generate-latex-document.php';
            var data = {
                'filePath': $(this).attr('data-path'),
                'fileName': $(this).attr('id')
            };

            $.ajax({
                url: endpoint,
                type: 'post',
                cache: false,
                dataType: 'json',
                data: data,
                success: function (response) {
                    if ('error' === response.status || 'invalid' === response.status) {
                        $message  = 'An error occurred while generating the document...\n'
                        $message += response.message;
                        alert($message);
                    }
                    icon.attr('class', iconClass);
                },
                error: function(response) {
                    $message  = 'A error occurred with the request...\n'
                    $message += response.message;
                    alert($message);
                    icon.attr('class', iconClass);
                }
            });
        });
    };


    /**
     * Driver for all auto generate functionality
     */
    var auto_generate = function()
    {
        auto_generate_php();
        auto_generate_latex();
    }


    // Ya'll want this party started quickly... right?
    init();

});
