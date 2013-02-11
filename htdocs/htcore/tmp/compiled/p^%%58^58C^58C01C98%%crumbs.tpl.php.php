<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:_block/crumbs.tpl.php */ ?>
<?php if ("/".($this->_tpl_vars['State']['Path']['0']['index']) == "/index/"):  else:  if (count ( $this->_tpl_vars['State']['Path'] ) > 0): ?>
                    <div id="globalnav">
                            <a href="/" class="home"><span>Главная</span></a><em>&rarr;</em>
	                    <?php $_from = $this->_tpl_vars['State']['Path']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Crumbs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Crumbs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Page']):
        $this->_foreach['Crumbs']['iteration']++;
?>
		                    <?php if (($this->_foreach['Crumbs']['iteration'] == $this->_foreach['Crumbs']['total'])): ?>
		                      <?php echo $this->_tpl_vars['Page']['Title']; ?>

		                    <?php else: ?>
		                      <a href="/<?php echo $this->_tpl_vars['Page']['index']; ?>
"><?php echo $this->_tpl_vars['Page']['Title']; ?>
</a><em>&rarr;</em>
		                    <?php endif; ?>
	                    <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <?php endif;  endif; ?>