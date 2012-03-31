/**
 * JQuery @complete Plugin
 *  @author surgesoft
 *  @email surgesoft@gmail.com
 *  @version 0.1
 *  @copyright Copyright (C) 2012 surgesoft All rights reserved.
 *  @license MIT license
 */
(function($){
    var trie={},
        end={},
        keepEnd={},
        endings=[0],
        tips=[],
        comps=[],
        enter=[];
        cPosi=0

    $.fn.atcomplete = function(options){
    /**
     * 构造函数，取得json数据并进行数据结构封装
     *
     */
    $this = $(this);
     var opts = $.extend({}, $.fn.atcomplete.defaults, options);    
    /**
     * 请求获取关键词列表的JSON
     * 不知是否有其他实现方法
     *
     */
     $.getJSON(opts.datasource,0,function(data){
      $.fn.atcomplete.compdata = data;
      $.fn.atcomplete.Trietree(data);
      bind($this,opts);
      constructDiv(opts);
      //$.fn.atcomplete.findWord('PH',trie,0);
      //console.log(tips);
       });
 };
  /**
   * 分析关键词列表
   * 因为内容补全的开头字符是一定的，不需要关键词匹配，所以自动机的S唯一
   * 所以只需要构建一个DFA就可以匹配。
   * 这里采用Trie树
   */
   print = function(str)
   {
    document.write(str);
   };

  /**
   * 构造一个Trie树
   * credit to John Resig
   *  http://ejohn.org/blog/javascript-trie-performance-analysis/  
   *
   */
$.fn.atcomplete.Trietree= function patternMatchingTree(data)
  {
    for(var i=0;i<data.length;i++)
    {
      var word=data[i],letters=word.split(''),cur=trie;
      for(var j=0;j<letters.length;j++)
      {
        var letter = letters[j],pos = cur[letter];
        if(pos == null)
          cur = cur[letter] = j===letters.length-1?0:{};
        else if(pos===0){
          cur = cur[letter] = {$:0};
        }else{
          cur = cur[letter];
        }
      }
    }

  }
  /**
   * 在Trie树中查找单词
   *
   */
  $.fn.atcomplete.findWord=function findword(words,cur,i)
  {
      if(i>=words.length) return;
      //console.log(words[i],i);
      
      var letter = words[i].toUpperCase();
      var letter2 = words[i].toLowerCase();
      if(typeof(cur[letter])==='object')
      {
        enter.push(letter);
       //console.log('enter',enter);
        if(i==words.length-1) dig(enter.join(''),cur[letter]);
        findword(words,cur[letter],i+1);
 
      }
      else if(typeof(cur[letter2])==='object')
      {
        enter.push(letter2);
        if(i==words.length-1) dig(enter.join(''),cur[letter2]);
        findword(words,cur[letter2],i+1);
 
      }


    
  }
/**
 * 将当前分支下的单词压入tips数组中
 *
 */
function dig( word, cur ) {
	for ( var node in cur ) {
		var val = cur[ node ];

		if ( node === "$" ) {
			tips.push( word );
		} else if ( val === 0 ) {
			tips.push( word + node );
		} else {
			dig( word + node, typeof val === "number" ?
				end[ val ] :
				val );
		}
	}
}
 /**
  * 构造弹出层
  *
  */ 
function constructDiv(opts)
{
  //console.log(opts.html.dropdown); 
  $(opts.html.dropdown)
    .html(opts.html.suggestions)
    .css('display','none')
    .appendTo(opts.renderto);
}

  /**
   *
   * 事件绑定
   */
  function bind(obj,opts)
  {
    obj.bind('keyup keydown',function(e){
        var pos = $.fn.atcomplete.getCursorPosition(obj);
        var currentinput = obj.val().substring(pos-1,pos);
        //console.log(currentinput);
        if(currentinput==opts.completeMark)
        {
          cPosi = pos;
        }
        else if(currentinput==' ')
        {
           cPosi = 0;
        }
        if(cPosi>0 && cPosi<pos)
        {
          var word = obj.val().substring(cPosi,pos);
         // console.log(word);
          tips=[];
          comps=[];
          enter=[];

          $.fn.atcomplete.findWord(word,trie,0);
          //console.log('enter',enter.toString());
          //console.log('tips',tips.toString());
          //console.log('comps',comps.toString());
          if(tips.length>0){
              $('#suggestions').html("");
            //$('<div></div>').html(tips.toString()).appendTo(document.body);
            for(var i=0;i<tips.length;i++)
            {
               $('<li></li>').html("<a>"+tips[i]+"</a>")
                 .attr('key',tips[i]+" ")
                 .bind('click',function()
                     {
                      $.fn.atcomplete.insertIntoCursor(pos,obj,$(this).attr('key'));
                      $('#dropdown').css('display','none');
                       cPosi = 0;
                     })
                  .bind('mouseover',function()
                      {
                        $(this).addClass('cur');
                      })
                  .bind('mouseout',function()
                      {
                        $(this).removeClass('cur');
                      })
                 .appendTo($('#suggestions'));

            }
           var p = kingwolfofsky.getInputPositon(obj);
            $('#dropdown').css({'display':'inherit',
                              'top':p.bottom,
                              'left':p.left
                });
            
          }else
          {
            $('#dropdown').css('display','none');
          }
        }else
        {
             $('#dropdown').css('display','none');

        }
        });
    obj.bind('click',function(){
          // $.fn.atcomplete.insertIntoCursor(obj,'123');
       // console.log(kingwolfofsky.getInputPositon(obj));
       // alert(kingwolfofsky.getInputPositon(obj).left);
        });
  };

    //默认配置
   $.fn.atcomplete.compdata=[];
   $.fn.atcomplete.defaults={
       completeMark : '@',
       maxLineNum  : 5,
       datasource : './data.json',
       renderto    : $(document.body),
       html:{
dropdown: "<div id='dropdown' style='position: absolute;border:1px solid grey;font-size:13px; display:none;'></div>",
        suggestions: "<li><a>想用@提到谁</a></li><ul id='suggestions'></ul>"
       }
   };

  /**
   * 获取当前光标所在位置
   * Credit to Maximilian Ruta via stackoverflow.com
   * http://stackoverflow.com/questions/1891444/how-can-i-get-cursor-position-in-a-textarea/8999941#8999941
   */
  $.fn.atcomplete.getCursorPosition=function(object){
    var el = object.get(0);
    var pos=0;

    if('selectionStart' in el) {
      pos = el.selectionStart;
    } else if('selection' in document) {
      el.focus();
      var Sel = document.selection.createRange();
      var SelLength = document.selection.createRange().text.length;
      Sel.moveStart('character', -el.value.length);
      pos = Sel.text.length - SelLength;
    }
 //  console.log(pos);
    return pos;

  };
  $.fn.atcomplete.insertIntoCursor = function (pos,object,text)
  {
      var str = object.val();
      //var font = str.substring(0,cPosi);
      var font = str.substr(0,cPosi);
      var back = str.substr(pos);
      //var back = str.substring(pos,str.length);
     // alert(back);
      object.val(font + text + back);
      var el = object.get(0);
      if('selectionStart' in el)
      {
         el.focus();

        el.selectionStart = cPosi + text.length;
        el.selectionEnd = cPosi + text.length;
      }else if('selection' in document){
        el.focus();
        var Sel = document.selection.createRange();
        Sel.moveStart('character',-object.val().length);
        Sel.moveStart('character',cPosi + text.length);
        Sel.moveEnd('character',0);
        Sel.select();
      }
     // console.log(font,back);
      //object.val(object.val().substring());
  };
/**
 * 获取光标的像素位置
 * Credit to kingwolfofsky
 * http://blog.csdn.net/kingwolfofsky/article/details/6586029
 * author 
 *
 */
var kingwolfofsky = {
    /**
    * 获取输入光标在页面中的坐标
    * @param		{HTMLElement}	输入框元素        
    * @return		{Object}		返回left和top,bottom
    */
    getInputPositon: function (elem) {
        if (document.selection) {   //IE Support
            elem.focus();
            var Sel = document.selection.createRange();
            return {
                left: Sel.boundingLeft,
                top: Sel.boundingTop,
                bottom: Sel.boundingTop + Sel.boundingHeight
            };
        } else {
            elem = elem.get(0);
            var that = this;
            var cloneDiv = '{$clone_div}', cloneLeft = '{$cloneLeft}', cloneFocus = '{$cloneFocus}', cloneRight = '{$cloneRight}';
            var none = '<span style="white-space:pre-wrap;"> </span>';
            var div = elem[cloneDiv] || document.createElement('div'), focus = elem[cloneFocus] || document.createElement('span');
            var text = elem[cloneLeft] || document.createElement('span');
            var offset = that._offset(elem), index = this._getFocus(elem), focusOffset = { left: 0, top: 0 };

            if (!elem[cloneDiv]) {
                elem[cloneDiv] = div, elem[cloneFocus] = focus;
                elem[cloneLeft] = text;
                div.appendChild(text);
                div.appendChild(focus);
                document.body.appendChild(div);
                focus.innerHTML = '|';
                focus.style.cssText = 'display:inline-block;width:0px;overflow:hidden;z-index:-100;word-wrap:break-word;word-break:break-all;';
                div.className = this._cloneStyle(elem);
                div.style.cssText = 'visibility:hidden;display:inline-block;position:absolute;z-index:-100;word-wrap:break-word;word-break:break-all;overflow:hidden;';
            };
            div.style.left = this._offset(elem).left + "px";
            div.style.top = this._offset(elem).top + "px";
            var strTmp = elem.value.substring(0, index).replace(/</g, '<').replace(/>/g, '>').replace(/\n/g, '<br/>').replace(/\s/g, none);
            text.innerHTML = strTmp;

            focus.style.display = 'inline-block';
            try { focusOffset = this._offset(focus); } catch (e) { };
            focus.style.display = 'none';
            return {
                left: focusOffset.left,
                top: focusOffset.top,
                bottom: focusOffset.bottom
            };
        }
    },

    // 克隆元素样式并返回类
    _cloneStyle: function (elem, cache) {
        if (!cache && elem['${cloneName}']) return elem['${cloneName}'];
        var className, name, rstyle = /^(number|string)$/;
        var rname = /^(content|outline|outlineWidth)$/; //Opera: content; IE8:outline && outlineWidth
        var cssText = [], sStyle = elem.style;

        for (name in sStyle) {
            if (!rname.test(name)) {
                val = this._getStyle(elem, name);
                if (val !== '' && rstyle.test(typeof val)) { // Firefox 4
                    name = name.replace(/([A-Z])/g, "-$1").toLowerCase();
                    cssText.push(name);
                    cssText.push(':');
                    cssText.push(val);
                    cssText.push(';');
                };
            };
        };
        cssText = cssText.join('');
        elem['${cloneName}'] = className = 'clone' + (new Date).getTime();
        this._addHeadStyle('.' + className + '{' + cssText + '}');
        return className;
    },

    // 向页头插入样式
    _addHeadStyle: function (content) {
        var style = this._style[document];
        if (!style) {
            style = this._style[document] = document.createElement('style');
            document.getElementsByTagName('head')[0].appendChild(style);
        };
        style.styleSheet && (style.styleSheet.cssText += content) || style.appendChild(document.createTextNode(content));
    },
    _style: {},

    // 获取最终样式
    _getStyle: 'getComputedStyle' in window ? function (elem, name) {
        return getComputedStyle(elem, null)[name];
    } : function (elem, name) {
        return elem.currentStyle[name];
    },

    // 获取光标在文本框的位置
    _getFocus: function (elem) {
        var index = 0;
        if (document.selection) {// IE Support
            elem.focus();
            var Sel = document.selection.createRange();
            if (elem.nodeName === 'TEXTAREA') {//textarea
                var Sel2 = Sel.duplicate();
                Sel2.moveToElementText(elem);
                var index = -1;
                while (Sel2.inRange(Sel)) {
                    Sel2.moveStart('character');
                    index++;
                };
            }
            else if (elem.nodeName === 'INPUT') {// input
                Sel.moveStart('character', -elem.value.length);
                index = Sel.text.length;
            }
        }
        else if (elem.selectionStart || elem.selectionStart == '0') { // Firefox support
            index = elem.selectionStart;
        }
        return (index);
    },

    // 获取元素在页面中位置
    _offset: function (elem) {
        var box = elem.getBoundingClientRect(), doc = elem.ownerDocument, body = doc.body, docElem = doc.documentElement;
        var clientTop = docElem.clientTop || body.clientTop || 0, clientLeft = docElem.clientLeft || body.clientLeft || 0;
        var top = box.top + (self.pageYOffset || docElem.scrollTop) - clientTop, left = box.left + (self.pageXOffset || docElem.scrollLeft) - clientLeft;
        return {
            left: left,
            top: top,
            right: left + box.width,
            bottom: top + box.height
        };
    }
};

})(jQuery);

