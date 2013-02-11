<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 08:36:57
         template file:paging.tpl.php */ ?>
<?php if ($this->_tpl_vars['Page']['count'] > 1): ?>    

    <div class="pagination-clean">
            <ul>
                  <?php if ($this->_tpl_vars['Page']['last']): ?>
                  <li class="previous"><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_tpl_vars['Page']['last'];  echo $this->_tpl_vars['slink']; ?>
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
"><?php echo $this->_sections['p']['iteration']; ?>
</a></li>
                    <?php endif; ?>
                  <?php endfor; endif; ?>
                  <?php if ($this->_tpl_vars['Page']['next']): ?>
                  <li class="next"><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_tpl_vars['Page']['next'];  echo $this->_tpl_vars['slink']; ?>
">Далее&nbsp;&raquo;</a></li>
                  <?php else: ?>
                  <li class="next-off">Далее&nbsp;&raquo;</li>
                  <?php endif; ?>
            </ul>
      </div>
<?php endif; ?>