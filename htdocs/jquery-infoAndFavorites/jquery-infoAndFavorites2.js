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
      var curimg = $(this);
      var title="";  
      if(opts.title==true)  title = '<a href="/user/'+$(this).attr('data-uid')+'"><b style="color:white;">上传者：'+$(this).attr('data-author')+'</b></a>'; 
          $(this).css({
              margin:opts.border/2,
              float:'left',
              display:'none',
          });
          if(opts.width>0) var twidth = opts.width; else var twidth =$(this).width();
          if(opts.height>0) var theight = opts.height;else var theight = $(this).height();
          var imgpath = "url("+$(this).attr('src')+")";
          if(opts.border){
          var thiscss ={
          float:'left',
          overflow:'hidden',
          margin:opts.margin,
          width:twidth+opts.border,
          height:theight+opts.border*3,
          'border-radius': '4px',
          'background-color': 'white',
          'box-shadow': '0 1px 5px #252525',
          '-webkit-box-shadow': '0 1px 5px #252525',
          '-moz-box-shadow': '0 1px 5px #252525'
         };
         }else{
         var thiscss={
          float:'left',
          overflow:'hidden',
          'text-decoration': 'none',
          margin:opts.margin,
          width:twidth+opts.border,
          height:theight+opts.border*3,
};
         }
       var frame = $('<div></div>').css(thiscss);
       var frameinner = $('<div></div>').css({
            float:'left',
            'background-image': imgpath,
            margin:opts.border/2
           });
       $(this).wrap(frameinner).parent().wrap(frame);
       var linkurl = $(opts.link).attr({
           'href':$(this).attr('data-url'),
           'title':$(this).attr('title')
           });
       var infodiv = $(opts.html).html(title).css({
            opacity:0,
            float:'left',
            position:'relative',
            width:twidth,
            height:theight,
            top:0,//-$(this).height()-opts.border/2,
          }).hover(function()
          {
         $(this).stop().animate({
            opacity: 0.7,
            },opts.speed);
         },function()
          {
           $(this).stop().animate({
              opacity:0
             },opts.speed);
         
          }).appendTo($(this).parent()).wrap(linkurl);
          if(opts.border){
            if(curimg.attr('data-like')==1)
                opts.banner="<div class='unlike' title='取消收藏'></div>";
            else
              opts.banner="<div class='like' title='添加收藏'></div>";
          $(opts.banner).css({
            height:opts.border*3,
            'margin-left':10,
            'margin-top':-8,
            float:"left"
              }).click(function(){
                  if($(this).attr('like')==1){
                    $(this).attr('like',0);
                    $(this).removeClass('unlike');
                    $(this).addClass('like');
                  }
                  else
                  {
                    $(this).attr('like',1);
                    $(this).removeClass('like');
                    $(this).addClass('unlike');

                  }
                }).appendTo($(this).parent().parent()).attr('like',curimg.attr('data-like'));
          };
          if(opts.linkto)
          {
          infodiv.click(function()
            {
            window.location.href=$this.attr('data-url');
            });
          };
        
      });
    };

    $.fn.favor.defaults={
      style:'info',
      width:300,
      height:200,
      speed:500,
      zoom:0,
      border:10,
      margin:0,
      title:true,
      linkto:true,
      link:"<a></a>",
      html:'<div class="infoAndFavor"></div>',
      banner:'<div></div>'
    };


    
})(jQuery);
