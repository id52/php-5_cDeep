<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:45:46
         template file:photo/items.tpl.php */ ?>
	<?php $_from = $this->_tpl_vars['Post']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pItem']):
?>
    <div class="photopost">
    <?php if ($this->_tpl_vars['pItem']['photo']): ?>
       <a href="<?php echo $this->_tpl_vars['State']['Current']['index'];  echo $this->_tpl_vars['pItem']['id']; ?>
.xml" class='postimg' >
           <img src='/zoom/100x100/upload/photo/<?php echo $this->_tpl_vars['pItem']['photo']; ?>
' align="left">
       </a>
	   <div class="descpost" style="margin-left:120px; ">
    <?php else: ?>
		<div class="descpost"><?php endif; ?>
		<h3><?php echo $this->_tpl_vars['pItem']['fio']; ?>
</h3>
	    <?php echo $this->_tpl_vars['pItem']['post']; ?>

	    <a href="<?php echo $this->_tpl_vars['State']['Current']['index'];  echo $this->_tpl_vars['pItem']['id']; ?>
.xml">смотреть альбом&rarr;</a>
		</div>
    </div>
	<div style="clear:both; height: 10px;"></div>
    <?php endforeach; endif; unset($_from); ?>