<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 08:36:57
         template file:sadm/faq/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/faq/index.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.js,jquery.form.js,jquery.jframe.js','type' => 'js','comment' => 'JQuery ����, ��������� JFrame � JForm'), $this); echo cDeep_function_loader(array('src' => 'jquery.FCKEditor.js','type' => 'js','base' => '/js/','comment' => 'FCKEditor jplugin'), $this); echo cDeep_function_loader(array('src' => 'datepicker.css','type' => 'css','base' => '/css/','comment' => '�����'), $this); echo cDeep_function_loader(array('src' => 'ui.core.js,effects.core.js,effects.drop.js,ui.sortable.js,ui.draggable.js,ui.droppable.js,ui.datepicker.js,i18n/ui.datepicker-ru.js','type' => 'js','base' => '/js/ui/','comment' => 'UI'), $this);?>


<div id="container" class="nosidebar">
			<?php if ($this->_tpl_vars['State']['Current_item'] > 0): ?>
			<div id="content" class="clearfix nosidebar" src="/sadm/faq/add/<?php echo $this->_tpl_vars['State']['Current_item']; ?>
.html"></div>
			<?php else: ?>
			<div id="content" class="clearfix nosidebar" src="/sadm/faq/list/"></div>
			<?php endif; ?>
</div>