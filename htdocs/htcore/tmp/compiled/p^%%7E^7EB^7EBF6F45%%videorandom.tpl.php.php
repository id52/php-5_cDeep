<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:32:02
         template file:photo/videorandom.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'video_viewer', 'file:photo/videorandom.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_video_viewer(array('action' => 'videoRandom'), $this); if ($this->_tpl_vars['videos']['0']['id']): ?>
	<?php $_from = $this->_tpl_vars['videos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['video']):
?>
		<div class="player">
		<a href="/photo/<?php echo $this->_tpl_vars['video']['gid']; ?>
.xml#video<?php echo $this->_tpl_vars['video']['id']; ?>
">
			<img src='/zoom/235x0/upload/photo/<?php echo $this->_tpl_vars['video']['image']; ?>
' border="0" alt="">
		</a>
		</div>
	<?php endforeach; endif; unset($_from); ?>
	<div class="description">
		<?php echo $this->_tpl_vars['video']['Description']; ?>

	</div>
<?php endif; ?>


