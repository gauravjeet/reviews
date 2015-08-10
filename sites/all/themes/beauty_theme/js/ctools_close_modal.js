Drupal.behaviors.corporateclean = {
  attach: function(context, settings) {

    // Close Ctools when clicked outside of it.
    jQuery('#modalBackdrop').click(function() {
      Drupal.CTools.Modal.dismiss();
    });
  }
}