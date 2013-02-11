<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$State.Current.Topic}</title>


{loader src='admin/forms.css, admin/structure.css' type='css' base='/css/' comment='Стили для каркаса админки'}

{loader src='adm_interface.js' type='js' comment='для селектов'}
{loader src='jquery.js, jquery-ui.js, jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ядро, поддержка JFrame и JForm'}
{loader src='jquery.uldnd.js,' type='js' comment='Перетаскивание пунктов всписке'}

{loader src='jquery.bettertip.js' type='js' comment='BetterTip' base='/js/bettertip/'}
{loader src='jquery.bettertip.css' type='css' base='/js/bettertip/' comment='Стили для подсказок админки'}


{loader action='print' comment='Вывод блока'}

<link href="/css/admin/structure.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/admin/screen.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/forms.css" type="text/css" rel="stylesheet" media="all" />









<!--[if lt IE 7]>
<![if gte IE 5.5]>
<script type="text/javascript" src="/js/jquery.fixPNG.js"></script> 
<![endif]>
<![endif]-->

</head> 
<body>
<div id="admin_cdeep">
<div id="masthead-wrapper">
  <div id="masthead">
    <div id="logo"></div>
  </div>
</div>
<div id="wrapper">
  <div id="globalnav">
    <h3>{$State.Current.Topic}</h3>
    <p>
    <a href="/">Сайт</a> &rarr;
    {section loop=$State.Path name='p'}
     {if $cDeep.section.p.last}
     <strong>{$State.Path[p].Title}</strong>
     {else}
     <a href="/{$State.Path[p].index}">{$State.Path[p].Title}</a> &rarr;
     {/if}
    {/section}
    </p>
  </div>
  <div id="user">
    <p>
    Вы вошли как <strong>{$cDeep.session.AUTH.Login} ({$cDeep.session.AUTH.Name} {$cDeep.session.AUTH.Surname})</strong> | <a href="?event[SysAuth]=Exit" onClick="eraseCookie('foo')">Выйти</a></p>
  </div>
  <hr/> 
  <div id="navbar" class="clearfix">
    <ul>
    {menu start='/sadm'}
  {section loop=$Menu name='m'}<li><a href="{$Menu[m].link}"><span class="ico ico_{$Menu[m].id} iePNG"></span>{$Menu[m].title}</a></li>{/section}
  {/menu}
    </ul>
<!--<form id="search" action="">
      <input name="search" id="search-query" type="text" title="Search" />
      <input name="submit" type="image" src="img/search.png" />
    </form> 
--> </div>

  <hr/>
  
  <div id="content-wrapper" class="clearfix">