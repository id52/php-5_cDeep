<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:45:06
         template file:sadm/pages/tree.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'pages_manager', 'file:sadm/pages/tree.tpl.php', 1, false),array('modifier', 'htmlall', 'file:sadm/pages/tree.tpl.php', 34, false),)), $this); ?><?php echo cDeep_function_pages_manager(array('action' => 'List'), $this);?>

<style>
<?php echo '
.DragClass { background-color: #fff0f0; }
'; ?>

</style>
<script>
<?php echo '
$("#treemenu").ulDnD({
    onDragClass: "DragClass",
    onDrop: function(table, row) {
            Img = new Image(1,1);
            Img.src = \'/backend.xml?faction=SortMenu&\'+$.ulDnD.serialize();
        }
});

function removePage(Node, Title)
{
  if(confirm(\'Удалить безвозвратно страницу "\'+Title+\'" ?\'))
  {
        Img = new Image(1,1);
        Img.src = \'remove[\'+Node+\'].xml\';
    $(\'.PageNode\'+Node).fadeOut();
  }
}
'; ?>

</script>
<ul class="menu" id="treemenu">
        <li class="nodrag nodrop">
        <?php if ($this->_tpl_vars['Pages']['UP']): ?>
            <a href="tree/list[<?php echo $this->_tpl_vars['Pages']['UP']['parent']; ?>
].xml" title='Выше, к <?php echo $this->_tpl_vars['Pages']['UP']['Title']; ?>
'>
                <img src="/img/icons/folder_go.png" />
            </a>
            <a class="delete" href="add[<?php echo $this->_tpl_vars['Pages']['UP']['node']; ?>
].xml" target="_top" title='Добавить подстраницу в <?php echo ((is_array($_tmp=$this->_tpl_vars['Pages']['UP']['Title'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
'>
                <img src="/img/icons/page_add.png" />
            </a>            
            <a class="name" href="tree/list[<?php echo $this->_tpl_vars['Pages']['UP']['parent']; ?>
].xml" title='Выше, к <?php echo ((is_array($_tmp=$this->_tpl_vars['Pages']['UP']['Title'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
'>&larr; <?php echo $this->_tpl_vars['Pages']['UP']['Title']; ?>
</a>
        <?php endif; ?>
        </li>
<?php $_from = $this->_tpl_vars['Pages']['List']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p'] => $this->_tpl_vars['Page']):
?>
        <li id="sort[]=<?php echo $this->_tpl_vars['Page']['node']; ?>
" class="PageNode<?php echo $this->_tpl_vars['Page']['node']; ?>
">
          <?php if ($this->_tpl_vars['Page']['subnodes']): ?>
            <a class="delete" href="tree/list[<?php echo $this->_tpl_vars['Page']['node']; ?>
].xml" title='Внутрь'>
                <img src="/img/icons/folder.png" />
            </a>
            <?php else: ?>
            <a class="delete" href="javascript: void(0);" target="_top" onclick="return removePage(<?php echo $this->_tpl_vars['Page']['node']; ?>
, '<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['Title'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
')" title='Удалить'>
                <img src="/img/icons/cross.png" />
            </a>
            <?php endif; ?>
            <a class="delete" href="add[<?php echo $this->_tpl_vars['Page']['node']; ?>
].xml" target="_top" title='Добавить подстраницу'>
                <img src="/img/icons/page_add.png" />
            </a>
            <a class="name" href="property[<?php echo $this->_tpl_vars['Page']['node']; ?>
].xml" target="_top"><img src="/img/icons/page_gear.png" /><?php echo $this->_tpl_vars['Page']['Title']; ?>
</a>
        </li>
<?php endforeach; endif; unset($_from); ?>
</ul>