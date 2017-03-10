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
     * Hide generator element and show the hidden link after generating document
     * @param  {obj} generator    Generator DOM element
     * @param  {obj} link         Hidden DOM element link
     */
    var activate_link = function(generator, link)
    {
        generator.replaceWith(link);
        link.show();
    }


    /**
     * Reset icons after generating document
     * @param  {obj} icon         DOM element
     * @param  {obj} iconClass    Font awesome icon class
     */
    var reset_icon = function(icon, iconClass)
    {
        icon.attr('class', iconClass);
    }


    /**
     * Automatically generate php documents
     */
    var auto_curl_html = function()
    {
        $('.auto-curl-html').click(function() {

            var endpoint = 'src/app/ajax/curl-html-posting.php';
            var data = {
                'filePath': $(this).attr('data-path'),
                'fileName': $(this).attr('id'),
                'postUrl': $(this).attr('data-url')
            };

            $.ajax({
                url: endpoint,
                type: 'post',
                cache: false,
                dataType: 'json',
                data: data,
                success: function (response) {
                    if ('error' === response.status || 'invalid' === response.status) {
                        $message  = 'An error occurred while fetching/saving the html post...\n'
                        $message += response.message;
                        alert($message);
                    }
                },
                error: function(response) {
                    $message  = 'A error occurred with the request...\n'
                    $message += response.message;
                    alert($message);
                }
            });
        });
    }


    /**
     * Automatically generate php documents
     */
    var auto_generate_php = function()
    {
        $('.auto-generate-php').click(function() {

            var generatorMarkup = $(this);
            var hiddenLinkMarkup = $('[data-ref="' + $(this).attr('id'));

            var icon = $(this).find('i');
            var iconClass = icon.attr('class');
            icon.attr('class', 'fa fa-fw fa-refresh fa-spin');

            var endpoint = 'src/app/ajax/generate-php-document.php';
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
                    setTimeout(function() {activate_link(generatorMarkup, hiddenLinkMarkup)}, 500);
                },
                error: function(response) {
                    $message  = 'A error occurred with the request...\n'
                    $message += response.message;
                    alert($message);
                    icon.attr('class', iconClass);
                }
            });
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
                    setTimeout(function() {reset_icon(icon, iconClass)}, 500);
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
        auto_curl_html();
        auto_generate_php();
        auto_generate_latex();
    }


    // Ya'll want this party started quickly... right?
    init();

});
