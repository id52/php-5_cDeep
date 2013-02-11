<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:34:46
         template file:catalog/info.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:catalog/info.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'catalog_info.css','type' => 'css','base' => '/css/'), $this); echo cDeep_function_loader(array('src' => 'highslide-with-gallery.js','base' => '/js/highslide/','type' => 'js','comment' => 'Highslide'), $this); echo cDeep_function_loader(array('src' => 'highslide.css','base' => '/js/highslide/','type' => 'css'), $this); echo '
<script type="text/javascript">
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


<h2><?php echo $this->_tpl_vars['Group']['mname']; ?>
</h2>
<?php unset($this->_sections['i']);
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['Item']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['max'] = (int)1;
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<h1><?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mname']; ?>
</h1>
            <div class="item-content_wrap">
                <div class="item-content">
                    <div class="item-price">
                        <form action="">
                            <p>
                                <span>Цена: <b><?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mprice']; ?>
</b> руб.</span>
                                                                <a href="/catalog/add/<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mid']; ?>
.html?<?php echo $this->_tpl_vars['cat_link']; ?>
&count=1" target="hf" id="link_qty_item_<?php echo $this->_sections['i']['index']; ?>
" title="В корзину"><img src="/images/ico_buy.png" width="23" height="21"></a>
                            </p>
                        </form>
                    </div>
                   <?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mcomponents']; ?>

                    <div class="submenu-list">
					
					

					<?php if ($this->_tpl_vars['group1']): ?>
						<div class="submenu">
                            <h3>Паспорта:</h3>
                            <ul>
                             <?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['group'] == '1'): ?>
							 <li><a href="/upload/catalog/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['src']; ?>
"><?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?></a></li>
                            <?php endif; ?>
							<?php endfor; endif; ?>   
                            </ul>
                        </div>
					<?php endif; ?>
						
						
					<?php if ($this->_tpl_vars['group2']): ?>	
						<div class="submenu">
                            <h3>Технические данные:</h3>
                            <ul>
                             <?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['group'] == '2'): ?>
							 <li><a href="/upload/catalog/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['src']; ?>
"><?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?></a></li>
                            <?php endif; ?>
							<?php endfor; endif; ?>   
                            </ul>
                        </div>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['group3']): ?>
                        <div class="submenu submenu-last">
                            <h3>Сертификаты:</h3>
                            <ul>
                             <?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['group'] == '3'): ?>
							 <li><a href="/upload/catalog/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['src']; ?>
"><?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?></a></li>
                            <?php endif; ?>
							<?php endfor; endif; ?>   
                            </ul>
                        </div>
					<?php endif; ?>
						
						
                    </div>
                </div>
            </div>
            <div class="item-sidebar">
                				<ul class="photo-list">
                    <li class="item">
                        <?php if ($this->_tpl_vars['Item'][$this->_sections['i']['index']]['ismain']): ?><p class="label">Новинка</p><?php endif; ?>
                        <?php if ($this->_tpl_vars['Item'][$this->_sections['i']['index']]['mprewiev']): ?>
						<a href="<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mprewiev']; ?>
" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/149x0/<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mprewiev']; ?>
" title="<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mname']; ?>
" alt="<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mname']; ?>
" />
						<?php else: ?>
						<img  src="/zoom3/149x161/ffffff/images/nophoto.gif" title="<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mname']; ?>
" alt="<?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mname']; ?>
" />
						<?php endif; ?>
                            <span class="item-data">
                                  <?php if ($this->_tpl_vars['Item'][$this->_sections['i']['index']]['mprewiev']): ?><ins class="zoom"></ins><?php endif; ?>
                                <span><?php echo $this->_tpl_vars['Item'][$this->_sections['i']['index']]['mname']; ?>
</span>
                            </span>
                        </a>
                    </li>
                    </ul>
										<ul class="photo-list">
					<?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['ext'] == 'jpg'): ?>
					<li class="item">
                        <a  onclick="return hs.expand(this)" href="/upload/catalog/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['src']; ?>
" class="photo-gallery" title="<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?>">
                            <img src="/zoom/149x0/upload/catalog/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['src']; ?>
" alt="<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?>" />
                            <span class="item-data">
                                <ins class="zoom"></ins>
                                <span><?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']):  echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name'];  else: ?>Рис.<?php echo $this->_sections['img']['index']+1;  endif; ?></span>
                            </span>
                        </a>
                    </li>
                    <?php endif; ?>
					<?php endfor; endif; ?>
					</ul>
				
										<ul class="photo-list">
					<?php unset($this->_sections['img']);
$this->_sections['img']['loop'] = is_array($_loop=$this->_tpl_vars['Photo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<?php if ($this->_tpl_vars['Photo'][$this->_sections['img']['index']]['ext'] == 'flv' || $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['ext'] == 'mp4'): ?>
					<li class="item video">

					<a href='/catalog/video/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['id']; ?>
'  class="move" onclick="return hs.htmlExpand(this, width: 440, outlineType: 'rounded-white', wrapperClassName: 'draggable-header', objectType: 'iframe')" >
                            <img src="/zoom3/149x149/ffffff/upload/<?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['image']; ?>
">
                            <span class="item-data">
                                <ins class="play"><img src="/upload/play.png" width="100%" alt="Посмотреть видео"></ins>
								
                                <span><?php echo $this->_tpl_vars['Photo'][$this->_sections['img']['index']]['Name']; ?>
</span>
                            </span>
                        </a>
						
                    </li>
					<?php endif; ?>
					<?php endfor; endif; ?>		
					
					
                </ul>
			</div>



	
<?php endfor; endif; ?>


	
		
		
		
	