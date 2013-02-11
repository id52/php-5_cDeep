<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:53:50
         template file:photo/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:photo/index.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'gallery.css','base' => '/css/','type' => 'css'), $this); if ($this->_tpl_vars['Item']):  $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:photo/item.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  endif;  if ($this->_tpl_vars['Post']):  $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:photo/items.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  endif; ?>