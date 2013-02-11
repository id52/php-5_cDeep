<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:45:50
         template file:photo/item.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:photo/item.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'highslide-with-gallery.js','base' => '/js/highslide/','type' => 'js','comment' => 'Highslide'), $this); echo cDeep_function_loader(array('src' => 'highslide.css','base' => '/js/highslide/','type' => 'css'), $this); echo '
<script type="text/javascript">

//////////////////////////////



hs.graphicsDir = \'/js/highslide/graphics/\';
hs.align = \'center\';
hs.transitions = [\'expand\', \'crossfade\'];
hs.outlineType = \'rounded-white\';
hs.fadeInOut = true;
//hs.dimmingOpacity = 0.75;

// Add the controlbar
hs.addSlideshow({
	//slideshowGroup: \'group1\',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: \'fit\',
	overlayOptions: {
		opacity: 0.75,
		position: \'bottom center\',
		hideOnMouseOut: true
	}
});


</script>
'; ?>

<h2><?php echo $this->_tpl_vars['Item']['fio']; ?>
</h2>
<div id="gallery">
<div class="floats">
	<?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Item']['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['img']['name'] = 'img';
$this->_sections['img']['show'] = true;
$this->_sections['img']['max'] = $this->_sections['img']['loop'];
$this->_sections['img']['step'] = 1;
$this->_sections['img']['start'] = $this->_sections['img']['step'] > 0 ? 0 : $this->_sections['img']['loop']-1;
if ($this->_sections['img']['show']) {
    $this->_sections['img']['total'] = $this->_sections['img']['loop'];
    if ($this->_sections['img']['total'] == 0)
        $this->_sections['img']['show'] = false;
} else
    $this->_sections['img']['total'] = 0;
if ($this->_sections['img']['show']):

            for ($this->_sections['img']['index'] = $this->_sections['img']['start'], $this->_sections['img']['iteration'] = 1;
                 $this->_sections['img']['iteration'] <= $this->_sections['img']['total'];
                 $this->_sections['img']['index'] += $this->_sections['img']['step'], $this->_sections['img']['iteration']++):
$this->_sections['img']['rownum'] = $this->_sections['img']['iteration'];
$this->_sections['img']['index_prev'] = $this->_sections['img']['index'] - $this->_sections['img']['step'];
$this->_sections['img']['index_next'] = $this->_sections['img']['index'] + $this->_sections['img']['step'];
$this->_sections['img']['first']      = ($this->_sections['img']['iteration'] == 1);
$this->_sections['img']['last']       = ($this->_sections['img']['iteration'] == $this->_sections['img']['total']);
?>
	<?php if ($this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['ext'] != 'flv' && $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['ext'] != 'mp4'): ?>
    <div class="left">
        <div class="r">
			
				<a onclick="return hs.expand(this)" href="/upload/photo/<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['src']; ?>
" title="<?php if ($this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?>">
					<img src="/zoom/190x190/upload/photo/<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['src']; ?>
" alt="<?php if ($this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?>"/>
				</a>
			

			<div class="highslide-caption">
			
				<?php if ($this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name']): ?>
					<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name']; ?>

				<?php else: ?>
					Рис.<?php echo $this->_sections['img']['index']+1; ?>

				<?php endif; ?>
			
			</div>
			<br />
            <p>
			
				<?php if ($this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name']): ?>
					<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Name']; ?>

				<?php else: ?>
					Рис.<?php echo $this->_sections['img']['index']+1; ?>

				<?php endif; ?>
				&nbsp;<em><?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['Description']; ?>
</em></p>
			
        </div>

		
		
        <div class="min"></div>

    </div>
<?php endif; ?>	
	<?php endfor; else: ?>
    <?php endif; ?>   
</div>

<?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Item']['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['img']['name'] = 'img';
$this->_sections['img']['show'] = true;
$this->_sections['img']['max'] = $this->_sections['img']['loop'];
$this->_sections['img']['step'] = 1;
$this->_sections['img']['start'] = $this->_sections['img']['step'] > 0 ? 0 : $this->_sections['img']['loop']-1;
if ($this->_sections['img']['show']) {
    $this->_sections['img']['total'] = $this->_sections['img']['loop'];
    if ($this->_sections['img']['total'] == 0)
        $this->_sections['img']['show'] = false;
} else
    $this->_sections['img']['total'] = 0;
if ($this->_sections['img']['show']):

            for ($this->_sections['img']['index'] = $this->_sections['img']['start'], $this->_sections['img']['iteration'] = 1;
                 $this->_sections['img']['iteration'] <= $this->_sections['img']['total'];
                 $this->_sections['img']['index'] += $this->_sections['img']['step'], $this->_sections['img']['iteration']++):
$this->_sections['img']['rownum'] = $this->_sections['img']['iteration'];
$this->_sections['img']['index_prev'] = $this->_sections['img']['index'] - $this->_sections['img']['step'];
$this->_sections['img']['index_next'] = $this->_sections['img']['index'] + $this->_sections['img']['step'];
$this->_sections['img']['first']      = ($this->_sections['img']['iteration'] == 1);
$this->_sections['img']['last']       = ($this->_sections['img']['iteration'] == $this->_sections['img']['total']);
?>
		<?php if ($this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['ext'] == 'flv' || $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['ext'] == 'mp4'): ?>
		<a name="video<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['id']; ?>
">
				<embed src="/js/player-4.1.60.swf"
				flashvars="file=/upload/photo/<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['src']; ?>
&image=/upload/photo/<?php echo $this->_tpl_vars['Item']['Photo'][$this->_sections['img']['index']]['image']; ?>
&width=500&height=400"
				width="500"
				height="400"
				autostart="false"
				allowfullscreen="true"
				allowfullscreen="true"
				streamer="lighttpd"
				showstop="true"
				showdownload="true"
				backcolor="0x333333
				overstretch="true"
				linkfromdisplay="false"
				>
				</embed>
			<?php endif; ?>
	
<?php endfor; endif; ?>
</div>















