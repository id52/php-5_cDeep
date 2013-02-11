<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:22
         template file:sadm/catalog/tree/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'a_catalog', 'file:sadm/catalog/tree/index.tpl.php', 1, false),array('modifier', 'default', 'file:sadm/catalog/tree/index.tpl.php', 26, false),array('modifier', 'htmlall', 'file:sadm/catalog/tree/index.tpl.php', 68, false),)), $this); ?><?php echo cDeep_function_a_catalog(array('action' => 'List','item' => $this->_tpl_vars['State']['Current_item']), $this); if ($this->_tpl_vars['Items']['Main']): ?>
<div style="padding:1.5em 1em .5em 1.5em;">
<ul class="menu">
<?php $_from = $this->_tpl_vars['Items']['List']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p'] => $this->_tpl_vars['Item']):
?>
        <li >
            <?php if ($this->_tpl_vars['Item']['is_group']): ?>
                <img src="/img/icons/folder.png" class="delete" />
            <?php else: ?>
                <img src="/img/icons/page_gear.png" class="delete"/>
            <?php endif; ?>
            <a class="name" href="/sadm/catalog/property[<?php echo $this->_tpl_vars['Item']['mid']; ?>
].xml" target="_top"><?php echo $this->_tpl_vars['Item']['mname']; ?>
</a>
        </li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php else: ?>
<script>
<?php echo '

$(".menu").ulDnD({
    onDragClass: "DragClass",
    onDrop: function(table, row) {
            Img = new Image(1,1);
            Img.src = \'/sadm/catalog/tree/sort[';  echo ((is_array($_tmp=@$this->_tpl_vars['Items']['UP']['mid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0));  echo '].xml?a&\'+$.ulDnD.serialize();
        }
});

function listdelete(u,t)
{
  if(confirm(\'Вы действительно желаете \'+t+\' ?\'))
  {
    $(\'.Itemmid\'+u).fadeOut();
    
    Img = new Image(1,1);
    Img.src = "/sadm/catalog/tree/remove["+u+"].xml";
  }
}
'; ?>

</script>

<style>
<?php echo '
.DragClass { background-color: #fff0f0; }
'; ?>

</style>


<ul class="menu">
        <?php if ($this->_tpl_vars['Items']['UP']): ?>
        <li class="nodrag nodrop">
            <a href="/sadm/catalog/tree/list[<?php echo $this->_tpl_vars['Items']['UP']['parent']; ?>
].xml?current=<?php echo $this->_tpl_vars['Items']['Current']; ?>
" title='Выше, к <?php echo $this->_tpl_vars['Items']['UP']['Title']; ?>
'>
                <img src="/img/icons/folder_go.png" />
            </a>
            <a class="name" href="/sadm/catalog/property[<?php echo $this->_tpl_vars['Items']['UP']['mid']; ?>
].xml" target="_top">
			<img src="/img/icons/page_gear.png" />← <?php if ($this->_tpl_vars['Items']['Current'] == $this->_tpl_vars['Items']['UP']['mid']): ?> <strong><?php echo $this->_tpl_vars['Items']['UP']['Title']; ?>
</strong><?php else:  echo $this->_tpl_vars['Items']['UP']['Title'];  endif; ?></a>
        </li>
		<?php endif;  $_from = $this->_tpl_vars['Items']['List']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p'] => $this->_tpl_vars['Item']):
?>
        <li id="sort[]=<?php echo $this->_tpl_vars['Item']['mid']; ?>
" class="Itemmid<?php echo $this->_tpl_vars['Item']['mid']; ?>
">
            		
          <?php if ($this->_tpl_vars['Item']['is_group']): ?>
            <a class="delete" href="/sadm/catalog/tree/list[<?php echo $this->_tpl_vars['Item']['mid']; ?>
].xml?current=<?php echo $this->_tpl_vars['Items']['Current']; ?>
" title='Внутрь'>
                <img src="/img/icons/folder.png" />
            </a>
            <?php else: ?>
            <a class="delete" href="javascript: void(0);" target="_top" onclick="return listdelete(<?php echo $this->_tpl_vars['Item']['mid']; ?>
, '<?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['Title'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
')" title='Удалить'>
                <img src="/img/icons/cross.png" />
            </a>
            <?php endif; ?>
            <a class="name" href="/sadm/catalog/property[<?php echo $this->_tpl_vars['Item']['mid']; ?>
].xml" target="_top"><img src="/img/icons/page_gear.png" /><?php if ($this->_tpl_vars['Items']['Current'] == $this->_tpl_vars['Item']['mid']): ?><strong><?php echo $this->_tpl_vars['Item']['mname']; ?>
</strong><?php else:  echo $this->_tpl_vars['Item']['mname'];  endif; ?></a>
        </li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>