<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:passport/authorization.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:passport/authorization.tpl.php', 1, false),array('function', 'authorization', 'file:passport/authorization.tpl.php', 2, false),array('function', 'address', 'file:passport/authorization.tpl.php', 3, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'forms.css','base' => '/css/','type' => 'css'), $this); echo cDeep_function_authorization(array(), $this); echo cDeep_function_address(array(), $this); if (! $this->_tpl_vars['uLogin']):  echo $this->_tpl_vars['wrongloginorpassword']; ?>

<form method='post'>
<ul>
<li>
	<div>
	<label class="desc">Email</label>
	<input type='text' class="field text full" name='Login'>
	</div>
</li>
<li>
	<div>
	<label class="desc">Пароль</label>
	<input type='password' name='Password' class="field text full">
	</div>
</li>
<li>
<input type='submit' name='authorization' value='Войти' class="button2">
</li>
<li>
<a href="/cabinet/registration/">Регистрация</a><br>
<a href="/cabinet/forgotpassword/">Забыли пароль?</a>
</li>
</ul>
</form>
<?php endif;  if ($this->_tpl_vars['uLogin']): ?>
<b><?php echo $this->_tpl_vars['uName']; ?>
</b><br>(<?php echo $this->_tpl_vars['uLogin']; ?>
)<br><br>
Редактировать <a href="/cabinet/profile/">личные данные</a>.<br>
Посмотреть <a href="/cabinet/orders/">мои заказы</a>.

<br><br>
<form method='post'>
<input type='submit' name='quit' value='Выйти'>
</form>
<?php endif; ?>

