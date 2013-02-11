<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:47
         template file:sadm/_block/header.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/_block/header.tpl.php', 8, false),array('block', 'menu', 'file:sadm/_block/header.tpl.php', 67, false),)), $this); ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['State']['Current']['Topic']; ?>
</title>


<?php echo cDeep_function_loader(array('src' => 'admin/forms.css, admin/structure.css','type' => 'css','base' => '/css/','comment' => 'Стили для каркаса админки'), $this); echo cDeep_function_loader(array('src' => 'adm_interface.js','type' => 'js','comment' => 'для селектов'), $this); echo cDeep_function_loader(array('src' => 'jquery.js, jquery-ui.js, jquery.form.js,jquery.jframe.js','type' => 'js','comment' => 'JQuery ядро, поддержка JFrame и JForm'), $this); echo cDeep_function_loader(array('src' => 'jquery.uldnd.js,','type' => 'js','comment' => 'Перетаскивание пунктов всписке'), $this); echo cDeep_function_loader(array('src' => 'jquery.bettertip.js','type' => 'js','comment' => 'BetterTip','base' => '/js/bettertip/'), $this); echo cDeep_function_loader(array('src' => 'jquery.bettertip.css','type' => 'css','base' => '/js/bettertip/','comment' => 'Стили для подсказок админки'), $this); echo cDeep_function_loader(array('action' => 'print','comment' => 'Вывод блока'), $this);?>


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
    <h3><?php echo $this->_tpl_vars['State']['Current']['Topic']; ?>
</h3>
    <p>
    <a href="/">Сайт</a> &rarr;
    <?php unset($this->_sections['p']);
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['State']['Path']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
     <?php if ($this->_sections['p']['last']): ?>
     <strong><?php echo $this->_tpl_vars['State']['Path'][$this->_sections['p']['index']]['Title']; ?>
</strong>
     <?php else: ?>
     <a href="/<?php echo $this->_tpl_vars['State']['Path'][$this->_sections['p']['index']]['index']; ?>
"><?php echo $this->_tpl_vars['State']['Path'][$this->_sections['p']['index']]['Title']; ?>
</a> &rarr;
     <?php endif; ?>
    <?php endfor; endif; ?>
    </p>
  </div>
  <div id="user">
    <p>
    Вы вошли как <strong><?php echo $_SESSION['AUTH']['Login']; ?>
 (<?php echo $_SESSION['AUTH']['Name']; ?>
 <?php echo $_SESSION['AUTH']['Surname']; ?>
)</strong> | <a href="?event[SysAuth]=Exit" onClick="eraseCookie('foo')">Выйти</a></p>
  </div>
  <hr/> 
  <div id="navbar" class="clearfix">
    <ul>
    <?php $this->_tag_stack[] = array('menu', array('start' => '/sadm')); $_block_repeat=true;cDeep_block_menu($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <?php unset($this->_sections['m']);
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['Menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?><li><a href="<?php echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['link']; ?>
"><span class="ico ico_<?php echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['id']; ?>
 iePNG"></span><?php echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['title']; ?>
</a></li><?php endfor; endif; ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo cDeep_block_menu($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </ul>
<!--<form id="search" action="">
      <input name="search" id="search-query" type="text" title="Search" />
      <input name="submit" type="image" src="img/search.png" />
    </form> 
--> </div>

  <hr/>
  
  <div id="content-wrapper" class="clearfix">