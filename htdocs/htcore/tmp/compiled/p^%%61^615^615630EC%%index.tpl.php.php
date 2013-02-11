<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:vote/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 's_vote', 'file:vote/index.tpl.php', 1, false),array('modifier', 'truncate', 'file:vote/index.tpl.php', 11, false),)), $this); ?><?php echo cDeep_function_s_vote(array(), $this); if ($this->_tpl_vars['Vote']['title']): ?>

<h3><?php echo $this->_tpl_vars['Vote']['title']; ?>
</h3>
<?php if ($this->_tpl_vars['Vote']['voted'] || $this->_tpl_vars['AREQUEST']['1'] == 'results'): ?>



<div id="vote">
<?php $_from = $this->_tpl_vars['Vote']['stat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Question'] => $this->_tpl_vars['Result']):
?>
  <div class="result"><label title="голосов: <?php echo $this->_tpl_vars['Result']['num']; ?>
"><?php echo $this->_tpl_vars['Question']; ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['Result']['percent'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, "") : cDeep_modifier_truncate($_tmp, 4, "")); ?>
%</label><span style="width:<?php echo $this->_tpl_vars['Result']['percent']; ?>
%;"></span></div>
  <img width="<?php echo $this->_tpl_vars['Result']['percent']*2; ?>
" height="12" src="/images/root/vote.gif">
<?php endforeach; endif; unset($_from); ?>
<p>Всего голосов: <?php echo $this->_tpl_vars['Vote']['all']; ?>
</p>           
</div>
<?php else: ?>
<form id="opros" method="POST" action=""><?php $_from = $this->_tpl_vars['Vote']['quest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['q'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['q']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Question']):
        $this->_foreach['q']['iteration']++;
 if ($this->_tpl_vars['Question']): ?>
  <input type="radio" class="field radio" id="q<?php echo $this->_foreach['q']['iteration']; ?>
" name="result" value="<?php echo $this->_tpl_vars['Question']; ?>
" />
    <label class="choice" for="q<?php echo $this->_foreach['q']['iteration']; ?>
"><?php echo $this->_tpl_vars['Question']; ?>
</label>
<?php endif;  endforeach; endif; unset($_from); ?>
    <div class="send">
    <div style="float:left; margin-right:7px;" class="buttons"><img src="/images/button_left.gif" height="24" width="8" /><button type="submit">Ответить</button><img src="/images/button_right.gif" height="24" width="8" /></div></div>
</form>
<?php endif;  endif; ?>