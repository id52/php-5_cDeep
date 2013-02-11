<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:34:42
         template file:catalog/catalog.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:catalog/catalog.tpl.php', 1, false),array('function', 's_catalog', 'file:catalog/catalog.tpl.php', 6, false),array('modifier', 'default', 'file:catalog/catalog.tpl.php', 77, false),array('modifier', 'htmlall', 'file:catalog/catalog.tpl.php', 84, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.format.1.02.js','type' => 'js','base' => "/js/"), $this); echo cDeep_function_loader(array('src' => 'catalog.css,navigation.css, gallery.css, tables.css','type' => 'css','base' => '/css/'), $this); $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:catalog/jscripts.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  if ($_REQUEST['search']): ?>
  <?php echo cDeep_function_s_catalog(array('action' => 'search','group' => $this->_tpl_vars['State']['Current_item'],'mmid' => 0,'max' => 100), $this);?>

  
<?php else: ?>
        <?php echo cDeep_function_s_catalog(array('action' => 'item','group' => $this->_tpl_vars['State']['Current_item'],'mmid' => 0,'max' => 100), $this);?>

    
    <?php if ($this->_tpl_vars['Item']): ?>
	<?php else: ?>
	<?php ob_start(); ?>
  
    <?php if ($this->_tpl_vars['Items']): ?>

	<?php echo '
<script>

function selectenable()
{
	alert(document.getElementById("myselect").options.length);
	if(document.getElementById("myselect").options.length==5)//0
	document.getElementById(\'aaa\').style.display = \'none\';
	alert(\'5\');
};	
function select(mid)
{
	for (i=0;i<document.getElementById("select"+mid).options.length;i++)
	{
		if (document.getElementById("select"+mid).options[i].selected==true)
		{
			document.getElementById("href"+mid).href=document.getElementById("href"+mid).href+"&size="+document.getElementById("select"+mid).options[i].value;
			//document.getElementById("href"+mid).style.display = \'block\';
			document.getElementById("href"+mid).style.visibility = \'visible\';
		}
	}
};
</script>
';  if ($this->_tpl_vars['Page']['count'] > 1): ?>    
    <div class="pagination-clean">
            <ul>
                  <?php if ($this->_tpl_vars['Page']['last']): ?>
                  <li class="previous"><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_tpl_vars['Page']['last'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
">&laquo;&nbsp;Назад</a></li>
                  <?php else: ?>
                  <li class="previous-off">&laquo;&nbsp;Назад</li>
                  <?php endif; ?>
                  <?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['Page']['count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
				  
                    <?php if ($this->_sections['p']['iteration'] == $this->_tpl_vars['Page']['current']): ?>
                    <li class="active"><?php echo $this->_sections['p']['iteration']; ?>
</li>
                    <?php else: ?>
                    <li><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_sections['p']['iteration'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
"><?php echo $this->_sections['p']['iteration']; ?>
</a></li>
                    <?php endif; ?>
                  <?php endfor; endif; ?>
                  <?php if ($this->_tpl_vars['Page']['next']): ?>
                  <li class="next"><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_tpl_vars['Page']['next'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
">Далее&nbsp;&raquo;</a></li>
                  <?php else: ?>
                  <li class="next-off">Далее&nbsp;&raquo;</li>
                  <?php endif; ?>
            </ul>
      </div>
<?php endif; ?>

<div class="sorting">
	<a href="?orderby=mprice&desc=desc">▼</a>цена<a href="?orderby=mprice&desc=asc">▲</a>
	<a href="?orderby=mname&desc=desc">▼</a>название<a href="?orderby=mname&desc=asc">▲</a>
</div>

<div class="prods_small">
	<?php unset($this->_sections['mi']);
$this->_sections['mi']['loop'] = is_array($_loop=$this->_tpl_vars['Items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mi']['name'] = 'mi';
$this->_sections['mi']['show'] = true;
$this->_sections['mi']['max'] = $this->_sections['mi']['loop'];
$this->_sections['mi']['step'] = 1;
$this->_sections['mi']['start'] = $this->_sections['mi']['step'] > 0 ? 0 : $this->_sections['mi']['loop']-1;
if ($this->_sections['mi']['show']) {
    $this->_sections['mi']['total'] = $this->_sections['mi']['loop'];
    if ($this->_sections['mi']['total'] == 0)
        $this->_sections['mi']['show'] = false;
} else
    $this->_sections['mi']['total'] = 0;
if ($this->_sections['mi']['show']):

            for ($this->_sections['mi']['index'] = $this->_sections['mi']['start'], $this->_sections['mi']['iteration'] = 1;
                 $this->_sections['mi']['iteration'] <= $this->_sections['mi']['total'];
                 $this->_sections['mi']['index'] += $this->_sections['mi']['step'], $this->_sections['mi']['iteration']++):
$this->_sections['mi']['rownum'] = $this->_sections['mi']['iteration'];
$this->_sections['mi']['index_prev'] = $this->_sections['mi']['index'] - $this->_sections['mi']['step'];
$this->_sections['mi']['index_next'] = $this->_sections['mi']['index'] + $this->_sections['mi']['step'];
$this->_sections['mi']['first']      = ($this->_sections['mi']['iteration'] == 1);
$this->_sections['mi']['last']       = ($this->_sections['mi']['iteration'] == $this->_sections['mi']['total']);
?>
	<div class="item clear">
					<div class="pic">
						<a href="item[<?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mid']; ?>
].xml"><img width="54" height="54" alt="prod_small" src="/zoom3/54x54/ffffff/<?php echo ((is_array($_tmp=@$this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mprewiev'])) ? $this->_run_mod_handler('default', true, $_tmp, '/images/nophoto.gif') : cDeep_modifier_default($_tmp, '/images/nophoto.gif')); ?>
"></a>
					</div>
					<div class="text">
						<h4><a href="item[<?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mid']; ?>
].xml"><?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mname']; ?>
</a></h4>
						<div class="info2">
							ЦЕНА: <b><?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mprice']; ?>
</b> РУБ.
							<a href="/catalog/add/<?php echo $this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mid']; ?>
.html?<?php echo $this->_tpl_vars['cat_link']; ?>
&count=1" target="hf" id="link_qty_item_<?php echo $this->_sections['mi']['index']; ?>
" 
		title="<?php echo ((is_array($_tmp=$this->_tpl_vars['Items'][$this->_sections['mi']['index']]['mname'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
" class="buy"></a>
						</div>
					</div>
				</div>
	   <?php endfor; endif; ?>
</div>
    <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:paging.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
    <?php else: ?>
	       <?php endif; ?>
    <?php $this->_cDeep_vars['capture']['products'] = ob_get_contents();  $this->assign('products', ob_get_contents());ob_end_clean(); ?>  
    
	
		<?php echo cDeep_function_s_catalog(array('action' => 'selfgroup','group' => $this->_tpl_vars['State']['Current_item'],'mmid' => 0), $this);?>

        <?php if ($this->_tpl_vars['Groups']['mname']): ?>
            <?php if ($this->_tpl_vars['Groups']['mimage']): ?>
			     <img src="/zoom/480x355/<?php echo $this->_tpl_vars['Groups']['mimage']; ?>
" align=left/>
			<?php endif; ?>
            <h2><?php echo $this->_tpl_vars['Groups']['mname']; ?>
</h2>
            <?php if ($this->_tpl_vars['Groups']['mcomponents']): ?>
                <?php echo $this->_tpl_vars['Groups']['mcomponents']; ?>

            <?php else:  endif; ?>
        <?php else: ?>
           <h2><?php echo $this->_tpl_vars['topic']; ?>
</h2>
		<?php endif; ?>
		


  		
		<?php echo cDeep_function_s_catalog(array('action' => 'group','group' => $this->_tpl_vars['State']['Current_item'],'mmid' => 0), $this);?>

		<?php if ($this->_tpl_vars['Groups']): ?>

        
<div class="newprods clear">
		<?php unset($this->_sections['mi']);
$this->_sections['mi']['loop'] = is_array($_loop=$this->_tpl_vars['Groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mi']['name'] = 'mi';
$this->_sections['mi']['show'] = true;
$this->_sections['mi']['max'] = $this->_sections['mi']['loop'];
$this->_sections['mi']['step'] = 1;
$this->_sections['mi']['start'] = $this->_sections['mi']['step'] > 0 ? 0 : $this->_sections['mi']['loop']-1;
if ($this->_sections['mi']['show']) {
    $this->_sections['mi']['total'] = $this->_sections['mi']['loop'];
    if ($this->_sections['mi']['total'] == 0)
        $this->_sections['mi']['show'] = false;
} else
    $this->_sections['mi']['total'] = 0;
if ($this->_sections['mi']['show']):

            for ($this->_sections['mi']['index'] = $this->_sections['mi']['start'], $this->_sections['mi']['iteration'] = 1;
                 $this->_sections['mi']['iteration'] <= $this->_sections['mi']['total'];
                 $this->_sections['mi']['index'] += $this->_sections['mi']['step'], $this->_sections['mi']['iteration']++):
$this->_sections['mi']['rownum'] = $this->_sections['mi']['iteration'];
$this->_sections['mi']['index_prev'] = $this->_sections['mi']['index'] - $this->_sections['mi']['step'];
$this->_sections['mi']['index_next'] = $this->_sections['mi']['index'] + $this->_sections['mi']['step'];
$this->_sections['mi']['first']      = ($this->_sections['mi']['iteration'] == 1);
$this->_sections['mi']['last']       = ($this->_sections['mi']['iteration'] == $this->_sections['mi']['total']);
?>
	<div class="item" style="width:231px; float:left; margin-right:10px;">
		<p class="title"><a href="<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mid']; ?>
/"><?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mname']; ?>
</a></p>
		<p class="pic">
			<a href="<?php echo $this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mid']; ?>
/"><img width="163" src="/zoom/163x0/<?php echo ((is_array($_tmp=@$this->_tpl_vars['Groups'][$this->_sections['mi']['index']]['mprewiev'])) ? $this->_run_mod_handler('default', true, $_tmp, '/images/nophoto2.gif') : cDeep_modifier_default($_tmp, '/images/nophoto2.gif')); ?>
"></a>
		</p>
		</div>
		<?php endfor; endif; ?>
</div>
		
		
		<?php endif; ?>
    <?php endif; ?>
    <?php echo $this->_tpl_vars['products'];  endif; ?>


