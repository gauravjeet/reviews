(function($, Drupal) {
  Drupal.ajax.prototype.commands.insertVideoPaths = function(ajax, response, status) {
    $(response.selector).val(response.detail);
  };
}(jQuery, Drupal));