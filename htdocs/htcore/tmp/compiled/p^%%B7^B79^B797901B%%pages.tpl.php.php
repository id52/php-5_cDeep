<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:18
         template file:sadm/pages.tpl.php */ ?>
<?php if ($this->_tpl_vars['Pages']['count'] > 1): ?>
<div class="pagination-clean"> 
<ul> 
<?php if ($this->_tpl_vars['Pages']['prev']): ?><li class="pages_previous"><a href="?p=<?php echo $this->_tpl_vars['Pages']['prev']; ?>
">←&nbsp;Назад</a></li><?php else: ?><li class="pages_previous-off">←&nbsp;Назад</li><?php endif;  unset($this->_sections['Page']);
$this->_sections['Page']['loop'] = is_array($_loop=$this->_tpl_vars['Pages']['count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Page']['name'] = 'Page';
$this->_sections['Page']['show'] = true;
$this->_sections['Page']['max'] = $this->_sections['Page']['loop'];
$this->_sections['Page']['step'] = 1;
$this->_sections['Page']['start'] = $this->_sections['Page']['step'] > 0 ? 0 : $this->_sections['Page']['loop']-1;
if ($this->_sections['Page']['show']) {
    $this->_sections['Page']['total'] = $this->_sections['Page']['loop'];
    if ($this->_sections['Page']['total'] == 0)
        $this->_sections['Page']['show'] = false;
} else
    $this->_sections['Page']['total'] = 0;
if ($this->_sections['Page']['show']):

            for ($this->_sections['Page']['index'] = $this->_sections['Page']['start'], $this->_sections['Page']['iteration'] = 1;
                 $this->_sections['Page']['iteration'] <= $this->_sections['Page']['total'];
                 $this->_sections['Page']['index'] += $this->_sections['Page']['step'], $this->_sections['Page']['iteration']++):
$this->_sections['Page']['rownum'] = $this->_sections['Page']['iteration'];
$this->_sections['Page']['index_prev'] = $this->_sections['Page']['index'] - $this->_sections['Page']['step'];
$this->_sections['Page']['index_next'] = $this->_sections['Page']['index'] + $this->_sections['Page']['step'];
$this->_sections['Page']['first']      = ($this->_sections['Page']['iteration'] == 1);
$this->_sections['Page']['last']       = ($this->_sections['Page']['iteration'] == $this->_sections['Page']['total']);
 if ($this->_sections['Page']['iteration'] == $this->_tpl_vars['Pages']['current']): ?><li class="pages_active"><?php echo $this->_sections['Page']['iteration']; ?>
</li><?php else: ?><li><a href="?p=<?php echo $this->_sections['Page']['iteration']; ?>
"><?php echo $this->_sections['Page']['iteration']; ?>
</a></li><?php endif;  endfor; endif;  if ($this->_tpl_vars['Pages']['next']): ?><li class="pages_next"><a href="?p=<?php echo $this->_tpl_vars['Pages']['next']; ?>
">Вперед&nbsp;→</a></li><?php else: ?><li class="pages_next-off">Вперед&nbsp;→</li><?php endif; ?>
</ul>
</div>
<?php endif; ?>
<!--PAGES-->