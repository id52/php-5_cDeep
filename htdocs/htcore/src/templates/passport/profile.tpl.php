{loader src='forms.css' type='css' base='/css/'}
{loader src='jquery.maskedinput-1.3.min.js' base='/js/' type='js'}
{literal}
<script type="text/javascript">
jQuery(function($){
   $("#tel").mask("+7(999)999-9999");
});
</script>
{/literal}
{authorization}
{profile}

{if $uLogin}



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
{if $erroremptypasswords}<li>{$erroremptypasswords}</li>{/if}
</ul>	
</div>
{/if}


<font color=vodka>
{if $alertpasswords}Пароль изменён{/if}
</font>

	<form method='post'>
	<ul>
		<li class="clear">
			<div class="info">
			<h2>Контактная информация</h2>
			</div>
		</li>
		<!--li class="clear">
			<div>
			<label class="desc">Логин:</label>
			<input type='text' disabled=disabled class="field text full" name='Login' value='{$Login}'>
			<label for="club">нельзя сменить</label>
			</div>
		</li-->
		<li>
			<div>
			<label class="desc">Email:</label>
			<input type='text' class="field text full" name='Email' value='{$Email}'>
			<label for="club">только латинские буквы и цифры</label>
			</div>
		</li>
		<li class="leftHalf">
			<div>
			<label class="desc">Ваше имя</label>
			<input id="club" class="field text full" type="text"  maxlength="255" value='{$Name}' name="Name">
			<label for="club">Ф.И.О.</label>
			</div>
		</li>
		<li class="rightHalf">
			<div>
			<label class="desc">Телефон</label>
			<input id="tel" class="field text full" type="text"  maxlength="255" value='{$Phone}' name="Phone">
			<label for="club">мобильный, для оперативной связи</label>
			</div>
		</li>
		<li class="clear">
			<div>
			<label class="desc">Адрес доставки</label>
			<textarea class="field text full" name='address'>{$address}</textarea>
			</div>
		</li>
		<li>
			<input type='submit' name='profile' value='Сохранить'>
		</form>
		<form method='post'>
		<input type='hidden' class="field text full" name='Email' value='{$Email}'>
		<input id="club" class="field text full" type="hidden"  maxlength="255" value='{$Name}' name="Name">
		<input id="club" class="field text full" type="hidden"  maxlength="255" value='{$Phone}' name="Phone">
		<input type='hidden' name='address' value='{$address}'>
		
		<li>
			<div class="info">
				<h2>Сменить пароль</h2>
			</div>
		</li>
		<li>
			<div>
			<label class="desc">Старый пароль</label>
			<input id="club" class="field text full" type="password"  maxlength="255" name="Password">
			<label for="club">который вы ввели при входе в личный кабинет</label>
			</div>
		</li>
		<li class="leftHalf">
			<div>
			<label class="desc">Новый пароль</label>
			<input id="club" class="field text full" type="password"  maxlength="255" name="Password1">
			<label for="club">новый пароль для входа в личный кабинет</label>
			</div>
		</li>
		<li class="rightHalf">
			<div>
			<label class="desc">Повторите новый пароль</label>
			<input id="club" class="field text full" type="password"  maxlength="255" name="Password2">
			<label for="club">должен совпадать с указанным в левом поле</label>
			</div>
		</li>
		<li class="clear">
			<input type='submit' name='changepassword' value='Сохранить'>
		<li>
		</ul>
	</form>
{else}
Страница доступна только для авторизованного пользователя
{/if}

