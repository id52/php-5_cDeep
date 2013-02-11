<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:45:05
         template file:sadm/pages/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/pages/index.tpl.php', 1, false),array('function', 'pages_manager', 'file:sadm/pages/index.tpl.php', 4, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.js, jquery.FCKEditor.js','type' => 'js','base' => '/js/','comment' => 'FCKEditor jplugin'), $this); echo cDeep_function_pages_manager(array('action' => 'Edit'), $this);?>


<div id="secondary">
    <div id="sidebar_content" class="clearfix">
    <h1>Страницы <?php if ($this->_tpl_vars['Page']['readonly'] == 0 && $this->_tpl_vars['Page']['writable'] == 1): ?><a href="add[<?php echo $this->_tpl_vars['Page']['node']; ?>
].xml"><img src="/img/icons/add.png" /> добавить</a><?php endif; ?></h1>
    <div src="tree/list[<?php echo $this->_tpl_vars['Page']['parent']; ?>
].xml"></div>
    </div>
</div>

<hr/>

<div id="container">
  <div id="content" class="clearfix">

<div id="cardconteiner">
<?php echo $this->_tpl_vars['pages_manager']['return']['Status']; ?>

  <div id="headercard">
  <?php if ($this->_tpl_vars['pages_manager']['do'] == 'ADD'): ?>
    <h1>Новая страница</h1>
  <?php elseif ($this->_tpl_vars['Page']['node']): ?>
    <h1><strong><?php echo $this->_tpl_vars['Page']['Title']; ?>
</strong> <?php if ($this->_tpl_vars['Page']['readonly'] == 1): ?> [системная страница. ограниченый доступ]<?php elseif ($this->_tpl_vars['Page']['writable'] != 1): ?>[нет доступа для записи]<?php endif; ?></h1>
  <?php else: ?>
    <h1>Помощь</h1>
  <?php endif; ?>
  </div>  
<?php if ($this->_tpl_vars['Page']['node'] || $this->_tpl_vars['pages_manager']['do'] == 'ADD'): ?>
<form enctype="multipart/form-data" method="post" action=""<?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> onsubmit="return false;"<?php endif; ?>>
<input type="hidden" name="Page[node]" value="<?php echo $this->_tpl_vars['Page']['node']; ?>
">
<input type="hidden" name="Page[parent]" value="<?php echo $this->_tpl_vars['Page']['parent']; ?>
">
<input type="hidden" name="Page[readonly]" value="<?php echo $this->_tpl_vars['Page']['readonly']; ?>
">

   <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:sadm/pages/item.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>

</form>
<?php else:  endif; ?>
</div>
    </div>
</div>