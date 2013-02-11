<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 14:08:22
         template file:sadm/photo/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/photo/index.tpl.php', 1, false),array('function', 'video_manager', 'file:sadm/photo/index.tpl.php', 2, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.js,jquery.form.js,jquery.jframe.js','type' => 'js','comment' => 'JQuery ядро, поддержка JFrame и JForm'), $this); echo cDeep_function_video_manager(array('action' => 'List'), $this); if ($this->_tpl_vars['video_manager']['do'] == 'PROPERTY'): ?>  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/photo/item.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  else: ?>  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/photo/list.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  endif; ?><br class="clear" />