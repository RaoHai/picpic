// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
mySettings = {
  nameSpace:          "bbcode", // Useful to prevent multi-instances CSS conflict
  previewParserPath:  "~/sets/bbcode/preview.php",
  markupSet: [
      {name:'加粗', key:'B', openWith:'[b]', closeWith:'[/b]'}, 
      {name:'斜体', key:'I', openWith:'[i]', closeWith:'[/i]'}, 
      {name:'下划线', key:'U', openWith:'[u]', closeWith:'[/u]'}, 
      {separator:'---------------' },
      {name:'图片', key:'P', replaceWith:'[img][![Url]!][/img]'}, 
      {name:'链接', key:'L', openWith:'[url=[![Url]!]]', closeWith:'[/url]', placeHolder:'Your text to link here...'},
      {separator:'---------------' },
      {name:'颜色', openWith:'[color=[![Color]!]]', closeWith:'[/color]', dropMenu: [
          {name:'黄色', openWith:'[color=yellow]', closeWith:'[/color]', className:"col1-1" },
          {name:'橙色', openWith:'[color=orange]', closeWith:'[/color]', className:"col1-2" },
          {name:'红色', openWith:'[color=red]', closeWith:'[/color]', className:"col1-3" },
          {name:'蓝色', openWith:'[color=blue]', closeWith:'[/color]', className:"col2-1" },
          {name:'紫色', openWith:'[color=purple]', closeWith:'[/color]', className:"col2-2" },
          {name:'绿色', openWith:'[color=green]', closeWith:'[/color]', className:"col2-3" },
          {name:'白色', openWith:'[color=white]', closeWith:'[/color]', className:"col3-1" },
          {name:'灰色', openWith:'[color=gray]', closeWith:'[/color]', className:"col3-2" },
          {name:'黑色', openWith:'[color=black]', closeWith:'[/color]', className:"col3-3" }
      ]},
      {name:'字号', key:'S', openWith:'[size=[![Text size]!]]', closeWith:'[/size]', dropMenu :[
          {name:'大', openWith:'[size=200]', closeWith:'[/size]' },
          {name:'中', openWith:'[size=100]', closeWith:'[/size]' },
          {name:'小', openWith:'[size=50]', closeWith:'[/size]' }
      ]},
      {separator:'---------------' },
      {name:'清除', className:"clean", replaceWith:function(h) { return h.selection.replace(/\[(.*?)\]/g, "") } },
      {name:'预览', className:"preview", call:'preview' }
   ]
}