{loader src='forms.css' base='/css/' type='css'}
{loader src='jquery.maskedinput-1.3.min.js' base='/js/' type='js'}
{literal}
<script type="text/javascript">
jQuery(function($){
   $("#tel").mask("+7(999)999-9999");
});
</script>
{/literal}
{registration}
{authorization}
<p></p>
		{if !$isauth}
{if $error}
<div id="errorMsg">
<p>Проверьте правильность заполнения полей:</p>
<ul>
{if $erroremail}<li>{$erroremail}</li>{/if}
{if $errorlogin}<li>{$errorlogin}</li>{/if}
{if $errorlogins}<li>{$errorlogins}</li>{/if}
{if $errorpasswords}<li>{$errorpasswords}</li>{/if}
{if $errorpassword}<li>{$errorpassword}</li>{/if}
{if $erroremails}<li>{$erroremails}</li>{/if}
</ul>	
</div>
{/if}
<form method='post'>





	<ul style="margin-left:0;">
		<li>
			<div class="info">
				<h2>Параметры для входа</h2>
				<p>Нужно заполнить оба поля</p>
			</div>
		</li>
		

		{*<li class="clear">
			<div>
			<label class="desc">Логин:</label>
			<input type='text' class="field text full" name='Login' value='{$Login}'>
			<label for="club">Только латинские буквы и цифры</label>
			</div>
		</li>*}
		<li class="leftHalf">
			<div>
			<label class="desc">Email:</label>
			<input type='text' class="field text full" name='Email' value='{$Email}'>
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
		{*<li class="rightHalf">
			<div>
			<label class="desc">Повторите пароль</label>
			<input id="club" class="field text full" type="password" maxlength="255" name="Password2">
			<label for="club">Должен совпадать с указанным в левом поле</label>
			</div>
		</li>*}
		<li class="clear">
			<div class="info">
			<h2>Контактная информация</h2>
			<p>Заполнять не обязательно, но желательно. При оформлении заказа мы все равно спросим.</p>
			</div>
		</li>
		<li class="leftHalf">
			<div>
			<label class="desc">Ваше имя</label>
			<input id="club" class="field text full" type="text" maxlength="255" value='{$Name}' name="Name">
			<label for="club">Ф.И.О.</label>
			</div>
		</li>
		<li class="rightHalf">
			<div>
			<label class="desc">Телефон</label>
			<input id="tel" class="field text full" type="text" maxlength="255" value='{$Phone}' name="Phone">
			<label for="club">мобильный</label>
			</div>
		</li>
		<li class="clear">
			<div>
			<label class="desc">Адрес доставки</label>
			<textarea class="field text full" name='address'>{$address}</textarea>
			<label for="club">и дополнительная контактаная информация если нужно</label>
			</div>
		</li>
		<li class="buttons">
		<input type='submit' name='registration' value='Зарегистрироваться'>
		</li>
		</ul>
		</form>		
		
	{else}
		Вы авторизованы как {$uLogin}
		{/if}
