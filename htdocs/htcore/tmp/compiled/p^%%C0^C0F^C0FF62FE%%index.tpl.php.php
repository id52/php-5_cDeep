<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:22
         template file:sadm/catalog/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/catalog/index.tpl.php', 1, false),array('function', 'a_catalog', 'file:sadm/catalog/index.tpl.php', 6, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.js,jquery.form.js,jquery.jframe.js','type' => 'js','comment' => 'JQuery ядро, поддержка JFrame и JForm'), $this); echo cDeep_function_loader(array('src' => 'jquery.FCKEditor.js','type' => 'js','base' => '/js/','comment' => 'FCKEditor jplugin'), $this); echo cDeep_function_loader(array('src' => 'catalog.css','type' => 'css','base' => '/css/admin/','comment' => 'Стили'), $this); echo cDeep_function_a_catalog(array('action' => 'Edit','item' => $this->_tpl_vars['State']['Current_item']), $this);?>

<hr/> 
<div id="secondary">
	<div id="sidebar_content">
	    <div src="tree/list[<?php echo $this->_tpl_vars['Item']['mgid']; ?>
].xml?current=<?php echo $this->_tpl_vars['Item']['mid']; ?>
"></div>
	</div>
</div>

<hr/>
<div id="container">
  <div id="content" class="clearfix">
  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:sadm/catalog/item/index.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
  </div>
</div>