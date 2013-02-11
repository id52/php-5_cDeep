<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:18
         template file:sadm/news/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/news/index.tpl.php', 1, false),array('function', 'news_manager', 'file:sadm/news/index.tpl.php', 3, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.js,jquery.form.js,jquery.jframe.js','type' => 'js','comment' => 'JQuery ядро, поддержка JFrame и JForm'), $this); echo cDeep_function_news_manager(array('action' => 'List'), $this); if ($this->_tpl_vars['news_manager']['do'] == 'PROPERTY'): ?>	<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/news/item.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  else: ?>	<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/news/list.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  endif; ?><br class="clear" />