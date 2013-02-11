<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 08:36:57
         template file:sadm/faq/list/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'a_faq', 'file:sadm/faq/list/index.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_a_faq(array('tpl' => "file:sadm/faq/list/faq.tpl.php",'items_on_page' => 5,'on_date' => 0,'num_items' => 15,'print_form' => true,'faqId' => $this->_tpl_vars['State']['Current_item']), $this);?>
