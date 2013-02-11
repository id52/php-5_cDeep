<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:_block/subnodes.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('block', 'menu', 'file:_block/subnodes.tpl.php', 3, false),)), $this); ?>
            <?php if ($this->_tpl_vars['State']['Path']['0']['index'] && ( "/".($this->_tpl_vars['State']['Path']['20']['index']) !== $this->_tpl_vars['State']['Current']['index'] )): ?>
            <?php $this->_tag_stack[] = array('menu', array('start' => $this->_tpl_vars['State']['Current']['index'],'level' => 1,'for' => 'all')); $_block_repeat=true;cDeep_block_menu($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php if ($this->_tpl_vars['Menu']): ?>
            <div id=multi-derevo>
            <ul>
              <?php unset($this->_sections['m']);
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['Menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
              <li <?php if ($this->_sections['m']['last']): ?>class="last"<?php endif; ?>><span><a href="<?php echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['link']; ?>
"><?php if ($this->_tpl_vars['Menu'][$this->_sections['m']['index']]['link'] == $this->_tpl_vars['State']['Current']['index']): ?><em class="marker"></em><?php endif;  echo $this->_tpl_vars['Menu'][$this->_sections['m']['index']]['title']; ?>
</a></span>  </li>
              <?php endfor; endif; ?>
            </ul>
            </div>
            <?php endif; ?>
            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo cDeep_block_menu($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php endif; ?>