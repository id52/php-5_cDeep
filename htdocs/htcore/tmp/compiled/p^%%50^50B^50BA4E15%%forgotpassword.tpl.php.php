<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-13 08:38:28
         template file:passport/forgotpassword.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'forgotpassword', 'file:passport/forgotpassword.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_forgotpassword(array(), $this); if (! $this->_tpl_vars['sended']): ?>
<form method='post'>
Введите email:
<input type='text' name='Email'>
<input type='submit' name='recover' value='Восстановить'>
</form>
<?php endif; ?>