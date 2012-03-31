/**
 * JQuery @infoAndFavorites
 *  @author surgesoft
 *  @email surgesoft@gmail.com
 *  @version 0.1
 *  @copyright Copyright (C) 2012 surgesoft All rights reserved.
 *  @license MIT license
 */
(function($){
  
    $.fn.favor = function(options){
    var opts = $.extend({}, $.fn.favor.defaults, options);  
    var $this = $(this);
       $this.each(function()
      {
      var title="";  
      if(opts.title==true)  title = '<a href="/user/'+$(this).attr('data-uid')+'"><b style="color:white;">上传者：'+$(this).attr('data-author')+'</b></a>'; 
      if(opts.style=='favor')
      {
        $(this).css({
display:"inline",
width:240,
height:160,
margin:13,
          });
        }
      $(opts.html).html(title).css({
            opacity:0,
            float:'left',
            width:$(this).width(),
            height:$(this).height(),
            top:$(this).offset().top,
            left:$(this).offset().left
          }).appendTo($(this));
          $(this).hover(function()
          {
          $(this).children('.infoAndFavor').stop().animate({
            opacity: 0.7,
            },opts.speed);
            $('img', this).stop().animate({
                marginLeft:-(opts.zoom),
                marginTop:-(opts.zoom),
              });
          },function()
          {
           $(this).children('.infoAndFavor').stop().animate({
              opacity:0
             },opts.speed);
            $('img', this).stop().animate({
                marginLeft:0,
                marginTop:0,
              });

          });
          if(opts.linkto)
          {
          $(this).click(function()
            {
            window.location.href=$(this).attr('data-url');
            });
          };
 
        
      });
    };

    $.fn.favor.defaults={
      style:'info',
      speed:500,
      zoom:0,
      title:true,
      linkto:true,
      html:'<div class="infoAndFavor"></div>'
    };


    
})(jQuery);
