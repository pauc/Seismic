function collapse(item) {
  if (!item.hasClass('active-trail') && !item.hasClass('leaf')){
    item.find('ul:first').hide().addClass('theme-collapsed');
    item.addClass('theme-collapsed');
  }
  if (!item.hasClass('active') && !item.hasClass('leaf')) {
    item.find('ul:first>li').each(function(index) {
      collapse($(this));      
    });    
  }
}

/*
 * Funció temporal per provar disparador des de popup d'openlayers, esborrar
 */
function mostra(num) {
  alert("Diu que " + num);
  return false;
}

$(function(){
  $('#map-menu .content ul:first>li').each(function(){
    collapse($(this));
  });
  
  $('div.exp-col').click(function(){
    var element = $(this);
    if ($(this).siblings('ul:first').hasClass('theme-collapsed')){
      $(this).siblings('ul:first').removeClass('theme-collapsed').slideDown(500);
      $(this).parent('li').removeClass('theme-collapsed');
    } else {
      $(this).siblings('ul:first').addClass('theme-collapsed').slideUp(500, function(){
        element.parent('li').addClass('theme-collapsed');          
      });
    }       
  });
});

