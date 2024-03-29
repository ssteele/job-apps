$(function() {

  var hideInfoPanel = function() {
    var infoPanelEl = $('#info-panel');
    infoPanelEl.fadeOut();
  };

  var showInfoPanel = function(text) {
    var infoPanelTextEl = $('#info-panel span');
    infoPanelTextEl.text(text);
    var infoPanelEl = $('#info-panel');
    infoPanelEl.fadeIn();
    setTimeout(hideInfoPanel, 3000);
  };

  /**
   * Count up the number of jobs applied to and inform
   */
  var infoAppCount = function() {
    $('#apply-count').click(
    function() {
      var total = $('.applied-for').length;
      showInfoPanel(`You have applied to ${total} jobs`);
    })
  };

  /**
   * Count up the number of job potentials and inform
   */
  var infoPotentialCount = function() {
    $('#potential-count').click(
    function() {
      var total = $('.potential:visible').length
      showInfoPanel(`You have ${total} potential jobs`);
    })
  };

  /**
   * Inform contact info: recruiter, network
   */
  var infoContact = function() {
    $('.contact').click(
    function(e) {
      var name = e.target.textContent || e.target.parentElement.textContent;
      if (name) {
        showInfoPanel(name);
      }
    })
  };

  /**
   * Provide expected asset name to user to copy and use as needed
   */
  var copyToClipboard = function() {
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
  var activateLink = function(generator, link) {
    generator.replaceWith(link);
    link.show();
  };

  /**
   * Reset icons after generating document
   * @param  {obj} icon         DOM element
   * @param  {obj} iconClass    Font awesome icon class
   */
  var resetIcon = function(icon, iconClass) {
    icon.attr('class', iconClass);
  };

  /**
   * Global var: shift key press status
   * @type {bool}    True if shift key depressed, false otherwise
   */
  var isShiftKeyPressed = false;

  /**
   * Listen to shift key to allow for extended front-end functionality
   */
  var listenToShiftKey = function() {
    $(document).on('keyup keydown', function(e) {
      isShiftKeyPressed = e.shiftKey;
    });
  };

  /**
   * Automatically generate php documents
   */
  var autoCurlHtml = function() {
    $('.auto-curl-html').click(function() {

      var generatorMarkup = $(this);
      var hiddenLinkMarkup = $('.unabridged-view [data-ref="' + $(this).attr('id'));

      var icon = $(this).find('i');
      var iconClass = icon.attr('class');
      icon.attr('class', 'fa fa-fw fa-refresh fa-spin');

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
            var message  = 'An error occurred while fetching/saving the HTML post...\n';
            message += response.message;
            alert(message);
          }
          setTimeout(function() {resetIcon(icon, iconClass)}, 500);
        },
        error: function(response) {
          var message  = 'A error occurred with the request...\n';
          message += response.message;
          alert(message);
          icon.attr('class', iconClass);
        }
      });
    });
  };

  /**
   * Automatically generate php documents
   */
  var autoGeneratePhp = function() {
    $('.auto-generate-php').click(function() {

      var generatorMarkup = $(this);
      var hiddenLinkMarkup = $('.unabridged-view [data-ref="' + $(this).attr('id'));

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
            var message  = 'An error occurred while generating the PHP document...\n';
            message += response.message;
            alert(message);
          }
          setTimeout(function() {activateLink(generatorMarkup, hiddenLinkMarkup)}, 500);
        },
        error: function(response) {
          var message  = 'A error occurred with the request...\n';
          message += response.message;
          alert(message);
          icon.attr('class', iconClass);
        }
      });
    });
  };

  /**
   * Automatically generate latex documents
   */
  var autoGenerateLatex = function() {
    $('.auto-generate-latex').click(function() {

      var icon = $(this).find('i');
      var iconClass = icon.attr('class');
      icon.attr('class', 'fa fa-fw fa-refresh fa-spin');

      var endpoint;
      var data = {
        'filePath': $(this).attr('data-path'),
        'fileName': $(this).attr('id')
      };

      if (! isShiftKeyPressed) {
        endpoint = 'src/app/ajax/generate-latex-document.php';

        $.ajax({
          url: endpoint,
          type: 'post',
          cache: false,
          dataType: 'json',
          data: data,
          success: function (response) {
            if ('error' === response.status || 'invalid' === response.status) {
              var message  = 'An error occurred while generating the LaTeX document...\n';
              message += response.message;
              alert(message);
            }
            setTimeout(function() {resetIcon(icon, iconClass)}, 500);
          },
          error: function(response) {
            var message  = 'A error occurred with the request...\n';
            message += response.message;
            alert(message);
            icon.attr('class', iconClass);
          }
        });
      } else {
        endpoint = 'src/app/ajax/copy-text-document.php';

        $.ajax({
          url: endpoint,
          type: 'post',
          cache: false,
          dataType: 'json',
          data: data,
          success: function (response) {
            if ('error' === response.status || 'invalid' === response.status) {
              var message  = 'An error occurred while copying the text document...\n';
              message += response.message;
              alert(message);
            }
            setTimeout(function() {resetIcon(icon, iconClass)}, 500);
          },
          error: function(response) {
            var message  = 'A error occurred with the request...\n';
            message += response.message;
            alert(message);
            icon.attr('class', iconClass);
          }
        });
      }
    });
  };

  /**
   * Driver for all auto generate functionality
   */
  var autoGenerate = function() {
    listenToShiftKey();
    autoCurlHtml();
    autoGeneratePhp();
    autoGenerateLatex();
  };

  /**
   * Driver function
   */
  var init = function() {
    infoAppCount();
    infoPotentialCount();
    infoContact();
    copyToClipboard();
    autoGenerate();
  };

  // Initialize
  init();
});
