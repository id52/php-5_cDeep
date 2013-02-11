<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-13 08:38:03
         template file:passport/registration.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:passport/registration.tpl.php', 1, false),array('function', 'registration', 'file:passport/registration.tpl.php', 10, false),array('function', 'authorization', 'file:passport/registration.tpl.php', 11, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'forms.css','base' => '/css/','type' => 'css'), $this); echo cDeep_function_loader(array('src' => 'jquery.maskedinput-1.3.min.js','base' => '/js/','type' => 'js'), $this); echo '
<script type="text/javascript">
jQuery(function($){
   $("#tel").mask("+7(999)999-9999");
});
</script>
';  echo cDeep_function_registration(array(), $this); echo cDeep_function_authorization(array(), $this);?>

<p></p>
		<?php if (! $this->_tpl_vars['isauth']):  if ($this->_tpl_vars['error']): ?>
<div id="errorMsg">
<p>Проверьте правильность заполнения полей:</p>
<ul>
<?php if ($this->_tpl_vars['erroremail']): ?><li><?php echo $this->_tpl_vars['erroremail']; ?>
</li><?php endif;  if ($this->_tpl_vars['errorlogin']): ?><li><?php echo $this->_tpl_vars['errorlogin']; ?>
</li><?php endif;  if ($this->_tpl_vars['errorlogins']): ?><li><?php echo $this->_tpl_vars['errorlogins']; ?>
</li><?php endif;  if ($this->_tpl_vars['errorpasswords']): ?><li><?php echo $this->_tpl_vars['errorpasswords']; ?>
</li><?php endif;  if ($this->_tpl_vars['errorpassword']): ?><li><?php echo $this->_tpl_vars['errorpassword']; ?>
</li><?php endif;  if ($this->_tpl_vars['erroremails']): ?><li><?php echo $this->_tpl_vars['erroremails']; ?>
</li><?php endif; ?>
</ul>	
</div>
<?php endif; ?>
<form method='post'>





	<ul style="margin-left:0;">
		<li>
			<div class="info">
				<h2>Параметры для входа</h2>
				<p>Нужно заполнить оба поля</p>
			</div>
		</li>
		

				<li class="leftHalf">
			<div>
			<label class="desc">Email:</label>
			<input type='text' class="field text full" name='Email' value='<?php echo $this->_tpl_vars['Email']; ?>
'>
			<label for="club">Только латинские буквы и цифры</label>
			</div>
		</li>

		<li class="rightHalf">
			<div>
			<label class="desc">Пароль</label>
			<input id="club" class="field text full" type="password" maxlength="255" name="Password">
			<label for="club">Пароль для входа в систему</label>
			</div>
		</li>
				<li class="clear">
			<div class="info">
			<h2>Контактная информация</h2>
			<p>Заполнять не обязательно, но желательно. При оформлении заказа мы все равно спросим.</p>
			</div>
		</li>
		<li class="leftHalf">
			<div>
			<label class="desc">Ваше имя</label>
			<input id="club" class="field text full" type="text" maxlength="255" value='<?php echo $this->_tpl_vars['Name']; ?>
' name="Name">
			<label for="club">Ф.И.О.</label>
			</div>
		</li>
		<li class="rightHalf">
			<div>
			<label class="desc">Телефон</label>
			<input id="tel" class="field text full" type="text" maxlength="255" value='<?php echo $this->_tpl_vars['Phone']; ?>
' name="Phone">
			<label for="club">мобильный</label>
			</div>
		</li>
		<li class="clear">
			<div>
			<label class="desc">Адрес доставки</label>
			<textarea class="field text full" name='address'><?php echo $this->_tpl_vars['address']; ?>
</textarea>
			<label for="club">и дополнительная контактаная информация если нужно</label>
			</div>
		</li>
		<li class="buttons">
		<input type='submit' name='registration' value='Зарегистрироваться'>
		</li>
		</ul>
		</form>		
		
	<?php else: ?>
		Вы авторизованы как <?php echo $this->_tpl_vars['uLogin']; ?>

		<?php endif; ?>