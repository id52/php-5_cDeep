<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:32:02
         template file:photo/photorandom.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'video_viewer', 'file:photo/photorandom.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_video_viewer(array('action' => 'photoRandom'), $this);?>

		
		<div class="gallery">
            	<div class="c_title">Наша<br /><span>фотогалерея <a href="/photo/">все фотoграфии</a></span></div>
				<?php $_from = $this->_tpl_vars['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
					<div class="foto">
					<a href="/photo/<?php echo $this->_tpl_vars['photo']['gid']; ?>
.xml">
							<img src="/zoom/235x0/upload/photo/<?php echo $this->_tpl_vars['photo']['src']; ?>
" border="0" alt="" />
						</a>
					</div>
				<?php endforeach; endif; unset($_from); ?>
            </div>
			
			