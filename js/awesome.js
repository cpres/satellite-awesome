/* 
 * Satellite Portrait JS
 * @author C- Pres
 * @site http://c-pr.es/satellite
 *
 */

jQuery(document).ready(function($) {
  
  slidePerson = function(e) {
    e.preventDefault();

    if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
      $(this).attr('data-toggled','on');
      $(this).find($('.ppl-caption')).fadeIn('fast');
    } else {
      $(this).attr('data-toggled','off');
      $(this).find($('.ppl-caption')).fadeOut('slow');
    }
    
  }
  slideAway = function () {
    $(this).find($('.ppl-caption')).fadeOut('slow');
    $(this).attr('data-toggled','off');
  }
  
  $('.people-slide').each( function() {
    $(this).on( "tap click", slidePerson );
    $(this).hover( slidePerson, slideAway );
  });
  
});