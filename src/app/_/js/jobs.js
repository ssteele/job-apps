$(function() {

  /**
   * Count up the number of jobs applied to and alert
   */
  var alertAppCount = function() {
    $('#apply-count').click(function() {
      var total = $('.applied-for')
      alert('You have applied to ' + total.length + ' jobs.')
    })
  }

  /**
   * Count up the number of job potentials and alert
   */
  var alertPotentialCount = function() {
    $('#potential-count').click(function() {
      var total = $('.potential:visible')
      alert('You have ' + total.length + ' potential jobs.')
    })
  }

  /**
   * Provide expected asset name to user to copy and use as needed
   */
  var copyToClipboard = function() {
    $('.copy-to-clipboard').click(function() {
      var path = $(this).attr('id') + '.' + $(this).attr('data-type')
      window.prompt("Copy to clipboard: Ctrl+C, Enter", path)
    })
  }

  /**
   * Hide generator element and show the hidden link after generating document
   * @param  {obj} generator    Generator DOM element
   * @param  {obj} link         Hidden DOM element link
   */
  var activateLink = function(generator, link) {
    generator.replaceWith(link)
    link.show()
  }

  /**
   * Reset icons after generating document
   * @param  {obj} icon         DOM element
   * @param  {obj} iconClass    Font awesome icon class
   */
  var resetIcon = function(icon, iconClass) {
    icon.attr('class', iconClass)
  }

  /**
   * Automatically generate php documents
   */
  var autoCurlHtml = function() {
    $('.auto-curl-html').click(function() {

      var generatorMarkup = $(this)
      var hiddenLinkMarkup = $('[data-ref="' + $(this).attr('id'))

      var icon = $(this).find('i')
      icon.attr('class', 'fa fa-fw fa-refresh fa-spin icon-too-wide')

      var endpoint = 'src/app/ajax/curl-html-posting.php'
      var data = {
        'filePath': $(this).attr('data-path'),
        'fileName': $(this).attr('id'),
        'postUrl': $(this).attr('data-url')
      }

      $.ajax({
        url: endpoint,
        type: 'post',
        cache: false,
        dataType: 'json',
        data: data,
        success: function (response) {
          if ('error' === response.status || 'invalid' === response.status) {
            var message  = 'An error occurred while fetching/saving the html post...\n'
            message += response.message
            alert(message)
          }
          setTimeout(function() {activateLink(generatorMarkup, hiddenLinkMarkup)}, 500)
        },
        error: function(response) {
          var message  = 'A error occurred with the request...\n'
          message += response.message
          alert(message)
        }
      })
    })
  }

  /**
   * Automatically generate php documents
   */
  var autoGeneratePhp = function() {
    $('.auto-generate-php').click(function() {

      var generatorMarkup = $(this)
      var hiddenLinkMarkup = $('[data-ref="' + $(this).attr('id'))

      var icon = $(this).find('i')
      var iconClass = icon.attr('class')
      icon.attr('class', 'fa fa-fw fa-refresh fa-spin icon-too-wide')

      var endpoint = 'src/app/ajax/generate-php-document.php'
      var data = {
        'filePath': $(this).attr('data-path'),
        'fileName': $(this).attr('id')
      }

      $.ajax({
        url: endpoint,
        type: 'post',
        cache: false,
        dataType: 'json',
        data: data,
        success: function (response) {
          if ('error' === response.status || 'invalid' === response.status) {
            var message  = 'An error occurred while generating the document...\n'
            message += response.message
            alert(message)
          }
          setTimeout(function() {activateLink(generatorMarkup, hiddenLinkMarkup)}, 500)
        },
        error: function(response) {
          var message  = 'A error occurred with the request...\n'
          message += response.message
          alert(message)
          icon.attr('class', iconClass)
        }
      })
    })
  }

  /**
   * Automatically generate latex documents
   */
  var autoGenerateLatex = function() {
    $('.auto-generate-latex').click(function() {

      var icon = $(this).find('i')
      var iconClass = icon.attr('class')
      icon.attr('class', 'fa fa-fw fa-refresh fa-spin icon-too-wide')

      var endpoint = 'src/app/ajax/generate-latex-document.php'
      var data = {
        'filePath': $(this).attr('data-path'),
        'fileName': $(this).attr('id')
      }

      $.ajax({
        url: endpoint,
        type: 'post',
        cache: false,
        dataType: 'json',
        data: data,
        success: function (response) {
          if ('error' === response.status || 'invalid' === response.status) {
            var message  = 'An error occurred while generating the document...\n'
            message += response.message
            alert(message)
          }
          setTimeout(function() {resetIcon(icon, iconClass)}, 500)
        },
        error: function(response) {
          var message  = 'A error occurred with the request...\n'
          message += response.message
          alert(message)
          icon.attr('class', iconClass)
        }
      })
    })
  }


  /**
   * Driver for all auto generate functionality
   */
  var autoGenerate = function() {
    autoCurlHtml()
    autoGeneratePhp()
    autoGenerateLatex()
  }

  /**
   * Driver function
   */
  var init = function() {
    alertAppCount()
    alertPotentialCount()
    copyToClipboard()
    autoGenerate()
  }

  // Initialize
  init()

})
