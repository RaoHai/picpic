/**
 * JQuery @ajaxtip Plugin
 *  @author surgesoft
 *  @email surgesoft@gmail.com
 *  @version 0.1
 *  @copyright Copyright (C) 2012 surgesoft All rights reserved.
 *  @license MIT license
 */
(function($){
  
    $.fn.ajaxtip = function(options){
      var opts = $.extend({}, $.fn.ajaxtip.defaults, options);  
      var $this = $(this);
      options.html.css({
          display:"none"
        })
      $this.bind('mouseenter',function(e)
        {
          var x = $(e.currentTarget).offset().top;
          var y = $(e.currentTarget).offset().left;
          if(typeof(options.x)=="undefined") options.x=0;
          if(typeof(options.y)=="undefined") options.y=0;
          $.getJSON(opts.datasource,{'id':$(this).attr("data-id")},function(data){
              options.html.html(data);
            });
          options.html.css({
              display:"block",
              top:x-$(this).height()+options.x,
              left:y+$(this).width()+options.y,
            });
        });
      $this.bind('mouseout',function()
        {
          options.html.css(
            {
              display:"none"
            })
        });
    };

     $.fn.ajaxtip.defaults={
       x : 0,
       y  : 0,
       datasource : './data.php',
       html:{
dropdown: "<div id='dropdown' style='position: absolute;border:1px solid grey;font-size:13px; display:none;'></div>",
        suggestions: "<li><a>想用@提到谁</a></li><ul id='suggestions'></ul>"
       }
   };


    
})(jQuery);
