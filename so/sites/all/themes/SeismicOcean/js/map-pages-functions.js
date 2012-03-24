function collapse(item) {
  if (!item.hasClass('active-trail') && !item.hasClass('leaf')){
    item.find('ul:first').hide().addClass('theme-collapsed');
    item.addClass('theme-collapsed');
  }
  if (!item.hasClass('leaf')) {
    item.find('ul:first>li').each(function(index) {
      collapse($(this));      
    });    
  }
}

$(function(){
  $('#map-menu .content ul:first>li').each(function(){
    collapse($(this));
  });
  
  $('div.exp-col').click(function(){
    var element = $(this);
    if ($(this).siblings('ul:first').hasClass('theme-collapsed')){
      $(this).siblings('ul:first').removeClass('theme-collapsed').slideDown(500, function(){
        element.parent('li').removeClass('theme-collapsed');        
      });
    } else {
      $(this).siblings('ul:first').addClass('theme-collapsed').slideUp(500, function(){
        element.parent('li').addClass('theme-collapsed');          
      });
    }       
  });
  
  if ($(location).attr('href').indexOf('#seismic-profile') != -1) {
    $(window)._scrollable();
    $(window).scrollTop(0);
    
    $(window).load(function(){
      $(window).scrollTo('#seismic-profile', 600);
    });
  }
  
  if ($(location).attr('href').indexOf('#oceanographic-profile') != -1) {
    $(window)._scrollable();
    $(window).scrollTop(0);
    
    $(window).load(function(){
      $(window).scrollTo('#oceanographic-profile', 800);
    });
  }
  
  $('#line-profiles a.up').click(function(e){
    e.preventDefault();
    $(window).scrollTo('#navigation', 600, {offset: {top:-20} });
  })
  
});

