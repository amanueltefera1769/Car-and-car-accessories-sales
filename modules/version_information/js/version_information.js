/**
 * @file
 * Contains all javascript for Version Information.
 */

(function ($, Drupal) {

  $('.toolbar-icon-version-information').on('click', function (e, data) {
    if ($('.version-information-container').length && (!data || !data.reload)) {
      $('#drupal-off-canvas').dialog('close');
      e.stopImmediatePropagation();
      e.preventDefault();
    }
  });

  $(document).ready(function () {
    $(window).on({
      'dialog:beforecreate': function (event, dialog, $element, settings) {
        if ($element.find('.version-information-container').length) {
          $('.toolbar-icon-version-information').addClass('sidebar-open');
          settings.dialogClass += ' ui-dialog-off-canvas';
        }
      },
      'dialog:beforeclose': function (event, dialog, $element) {
        if ($element.find('.version-information-container').length) {
          $('.toolbar-icon-version-information').removeClass('sidebar-open');
        }
      }
    });
  });

})(jQuery, Drupal);
