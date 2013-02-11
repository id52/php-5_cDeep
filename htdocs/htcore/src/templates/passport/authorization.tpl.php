{loader src='forms.css' base='/css/' type='css'}
{authorization}
{address}


{if !$uLogin}
{$wrongloginorpassword}
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
{/if}

{if $uLogin}
<b>{$uName}</b><br>({$uLogin})<br><br>
Редактировать <a href="/cabinet/profile/">личные данные</a>.<br>
Посмотреть <a href="/cabinet/orders/">мои заказы</a>.

<br><br>
<form method='post'>
<input type='submit' name='quit' value='Выйти'>
</form>
{/if}


