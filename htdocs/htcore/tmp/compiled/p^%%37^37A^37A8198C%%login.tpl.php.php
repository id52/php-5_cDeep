<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:43
         template file:sadm/login.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/login.tpl.php', 8, false),)), $this); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<link href="/css/admin/forms.css" rel="stylesheet" type="text/css">
<link href="/css/admin/structure.css" rel="stylesheet" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Войти в систему управления сайтом</title>
<?php echo cDeep_function_loader(array('action' => 'print','comment' => 'Вывод блока'), $this);?>

</head>
<!--[if lte IE 6]><link href="/css/ie6.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
<!--[if lte IE 7]><link href="/css/ie7.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
<!--[if lt IE 7]>
<![if gte IE 5.5]>
<script type="text/javascript" src="/js/fixpng.js"></script>
<![endif]>
<![endif]-->


<?php echo '
<style>
html{
	background:url(/img/bg_admin.jpg) repeat-x top #010101 !important;
}
</style>
'; ?>

<body>
<?php if ($this->_tpl_vars['Dispatcher']['SysAuth']['Auth'] == 'AUTH_FAILED'): ?>
<center><div id="errorMsg" style="width: 400px;">
<h2>Неудачная попытка входа</h2>
<ol>
	<li>Проверьте правильность логина/пароля и повторите ввод.</li>
</ol>
</div></center>
<?php endif; ?>
<div id="loginwindow">
<div class="frame">
<form enctype="multipart/form-data" method="post" class="loginform">
<input type="hidden" name="event[SysAuth]" value="Auth">
  <ul>
  
      <li>
      <div class="info">
        <h2>Сайт</h2>
        <p>Система управления сайтом</p>
      </div>
    </li>
  <li>
  
  <label class="desc">Логин:</label>
  <div>
    <input id="login" 
           name="SysAuth[Auth][Login]" 
           class="field text full" 
           type="text" 
	       tabindex="1"
           maxlength="255"
           value=""/>
  </div>
  
  </li><li>
  
  <label class="desc">Пароль:</label>
  <div>
    <input id="pass" 
      class="field text full"
      name="SysAuth[Auth][Passwd]" 
      tabindex="2"
      type="password" 
      maxlength="255" 
      value="" /> 
  </div>
    
  </li> 
   
   <li class="buttons">
        <span> 
        <button type="submit" name="ok" class="positive "><img src="/img/icons/lock.png" alt="" /> Войти</button> 
       </span>

        <span> 
        <a href="/" name="cancel" class="negative "><img src="/img/icons/cross.png" class="iePNG" alt="" /> Отменить</a> 
       </span>

    </li>
    </ul>
</form>
</div>
</div>
</body>
</html>