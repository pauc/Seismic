$(function(){
  if ($('body').hasClass('node-type-biblio')){
    $('td.biblio-field-contents-url a').attr('target', '_blank');
    $('td.biblio-field-contents-doi a').attr('target', '_blank');    
  }
});