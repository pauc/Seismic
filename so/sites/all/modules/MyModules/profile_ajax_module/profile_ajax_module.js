// $Id$
Drupal.behaviors.profile_ajax_module = function(context) {
  $('#popup').live('click', function(evt){
    OpenLayers.Event.stop(evt,true);
    alert('UACA!!');
  });  
};
