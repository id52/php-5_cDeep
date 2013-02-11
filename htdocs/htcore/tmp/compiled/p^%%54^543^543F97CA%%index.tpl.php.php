<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:42:41
         template file:catalog/add/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 's_catalog', 'file:catalog/add/index.tpl.php', 7, false),)), $this); ?><html>
<head>
  <title><?php echo $this->_tpl_vars['title']; ?>
</title>
</head>
<body>

  <?php echo cDeep_function_s_catalog(array('action' => 'add','item' => $this->_tpl_vars['State']['Current_item'],'mmid' => 0), $this);?>

  
</body>
</html>