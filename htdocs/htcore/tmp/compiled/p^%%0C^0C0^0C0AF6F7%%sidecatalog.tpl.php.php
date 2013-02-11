<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:_block/sidecatalog.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 's_catalog', 'file:_block/sidecatalog.tpl.php', 17, false),array('function', 'address', 'file:_block/sidecatalog.tpl.php', 23, false),)), $this); ?>
                      <?php $_from = $this->_tpl_vars['State']['Item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Crumbs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Crumbs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['Crumbs']['iteration']++;
?>
                       
                      <?php if (! ($this->_foreach['Crumbs']['iteration'] == $this->_foreach['Crumbs']['total'])): ?>
                      <?php $this->assign('lnk', ($this->_tpl_vars['lnk']).($this->_tpl_vars['i'])."/"); ?>
                      <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>

                      <?php if ($this->_tpl_vars['State']['Current_item'] && $this->_tpl_vars['State']['Current']['index'] == "/catalog/"): ?>
                        <!--li class="firstli">&larr; <a  href="/catalog/<?php echo $this->_tpl_vars['lnk']; ?>
">назад</a></li-->
					    <?php $this->assign('tree_root', $this->_tpl_vars['State']['Current_item']); ?>
					  <?php else: ?>
					    <?php $this->assign('tree_root', ''); ?>
                      <?php endif; ?>
					  
                  
                  <?php echo cDeep_function_s_catalog(array('action' => 'sidemenu','group' => $this->_tpl_vars['tree_root'],'mmid' => 0), $this);?>

                                      <!--li class="<?php if (($this->_foreach['cat']['iteration'] <= 1) && ! $this->_tpl_vars['State']['Current_item']): ?>firstli<?php endif; ?>"><a href="/catalog/<?php echo $this->_tpl_vars['CatLink'];  echo $this->_tpl_vars['catItem']['mid']; ?>
/"><?php echo $this->_tpl_vars['catItem']['mname']; ?>
</a></li-->  
                  

<?php echo cDeep_function_address(array(), $this);?>
				  

<div class="leftmenu">
<ul>

	<?php unset($this->_sections['u1']);
$this->_sections['u1']['name'] = 'u1';
$this->_sections['u1']['loop'] = is_array($_loop=$this->_tpl_vars['ur1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u1']['show'] = true;
$this->_sections['u1']['max'] = $this->_sections['u1']['loop'];
$this->_sections['u1']['step'] = 1;
$this->_sections['u1']['start'] = $this->_sections['u1']['step'] > 0 ? 0 : $this->_sections['u1']['loop']-1;
if ($this->_sections['u1']['show']) {
    $this->_sections['u1']['total'] = $this->_sections['u1']['loop'];
    if ($this->_sections['u1']['total'] == 0)
        $this->_sections['u1']['show'] = false;
} else
    $this->_sections['u1']['total'] = 0;
if ($this->_sections['u1']['show']):

            for ($this->_sections['u1']['index'] = $this->_sections['u1']['start'], $this->_sections['u1']['iteration'] = 1;
                 $this->_sections['u1']['iteration'] <= $this->_sections['u1']['total'];
                 $this->_sections['u1']['index'] += $this->_sections['u1']['step'], $this->_sections['u1']['iteration']++):
$this->_sections['u1']['rownum'] = $this->_sections['u1']['iteration'];
$this->_sections['u1']['index_prev'] = $this->_sections['u1']['index'] - $this->_sections['u1']['step'];
$this->_sections['u1']['index_next'] = $this->_sections['u1']['index'] + $this->_sections['u1']['step'];
$this->_sections['u1']['first']      = ($this->_sections['u1']['iteration'] == 1);
$this->_sections['u1']['last']       = ($this->_sections['u1']['iteration'] == $this->_sections['u1']['total']);
?>
	<?php if ($this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['active']): ?>
		<li class='active'><a  href="/catalog/<?php echo $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mid']; ?>
/"><?php echo $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mname']; ?>
</a></li>
		<ul>
		<?php unset($this->_sections['u2']);
$this->_sections['u2']['name'] = 'u2';
$this->_sections['u2']['loop'] = is_array($_loop=$this->_tpl_vars['ur2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u2']['show'] = true;
$this->_sections['u2']['max'] = $this->_sections['u2']['loop'];
$this->_sections['u2']['step'] = 1;
$this->_sections['u2']['start'] = $this->_sections['u2']['step'] > 0 ? 0 : $this->_sections['u2']['loop']-1;
if ($this->_sections['u2']['show']) {
    $this->_sections['u2']['total'] = $this->_sections['u2']['loop'];
    if ($this->_sections['u2']['total'] == 0)
        $this->_sections['u2']['show'] = false;
} else
    $this->_sections['u2']['total'] = 0;
if ($this->_sections['u2']['show']):

            for ($this->_sections['u2']['index'] = $this->_sections['u2']['start'], $this->_sections['u2']['iteration'] = 1;
                 $this->_sections['u2']['iteration'] <= $this->_sections['u2']['total'];
                 $this->_sections['u2']['index'] += $this->_sections['u2']['step'], $this->_sections['u2']['iteration']++):
$this->_sections['u2']['rownum'] = $this->_sections['u2']['iteration'];
$this->_sections['u2']['index_prev'] = $this->_sections['u2']['index'] - $this->_sections['u2']['step'];
$this->_sections['u2']['index_next'] = $this->_sections['u2']['index'] + $this->_sections['u2']['step'];
$this->_sections['u2']['first']      = ($this->_sections['u2']['iteration'] == 1);
$this->_sections['u2']['last']       = ($this->_sections['u2']['iteration'] == $this->_sections['u2']['total']);
?>
			<?php if ($this->_tpl_vars['ur2'][$this->_sections['u2']['index']]['mgid'] == $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mid']): ?>
				<?php if ($this->_tpl_vars['ur2'][$this->_sections['u2']['index']]['active']): ?>
					<li class='active'><a href="/catalog/<?php echo $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mid']; ?>
/<?php echo $this->_tpl_vars['ur2'][$this->_sections['u2']['index']]['mid']; ?>
/"><?php echo $this->_tpl_vars['ur2'][$this->_sections['u2']['index']]['mname']; ?>
</a></li>
				<?php else: ?>
					<li><a href="/catalog/<?php echo $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mid']; ?>
/<?php echo $this->_tpl_vars['ur2'][$this->_sections['u2']['index']]['mid']; ?>
/"><?php echo $this->_tpl_vars['ur2'][$this->_sections['u2']['index']]['mname']; ?>
</a></li>
				<?php endif; ?>
			<?php else: ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</ul>
	<?php else: ?>
		<li><a  href="/catalog/<?php echo $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mid']; ?>
/"><?php echo $this->_tpl_vars['ur1'][$this->_sections['u1']['index']]['mname']; ?>
</a></li> 
	<?php endif; ?>
	<?php endfor; endif; ?>
</ul>
</div><!-- /leftmenu -->




























	  