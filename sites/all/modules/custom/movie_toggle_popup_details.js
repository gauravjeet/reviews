Drupal.behaviors.corporateclean = {
  attach: function(context, settings) {

    // Close Ctools when clicked outside of it.
    jQuery('#modalBackdrop').click(function() {
      Drupal.CTools.Modal.dismiss();
    });

    jQuery('.movie-trailer').click(function() {

      // Animate movie trailer.
      jQuery('#movie-trailer-field').find('#mediafront_osm_presets').css('height', '0px').css('width', '0px');
      jQuery('#movie-details').hide('fadeOut');
      jQuery('#movie-trailer-field').show('fadeIn');

      jQuery('#movie-trailer-field').find('#mediafront_osm_presets').animate({
        height: "325",
        width: "615",
        left: "5"
      }, 1000, function() {

        // Next, animate movie options.
        jQuery('.movie-options').css('left', '75px').css('top', '310px');
        jQuery('.movie-options').animate({
          left: "220",
          top: '340'
        }, 500);
      });

      // Toggle movie details and trailer.
      jQuery(this).addClass('trailer-processed');
    });
  }
}