{loader src='catalog.css,forms.css, tables.css' type='css' base='/css/'}
{loader src='jquery.maskedinput-1.3.min.js' base='/js/' type='js'}
{literal}
<script type="text/javascript">
jQuery(function($){
   $("#tel").mask("+7(999)999-9999");
});
</script>
{/literal}
{authorization}
{orders_client}
{address}




{if $error}
<div id="errorMsg">
<p>Проверьте правильность заполнения полей:</p>
<ul>
{if $errorform}<li>{$errorform}</li>{/if}
{if $erroremails}<li>{$erroremails}</li>{/if}
{if $erroremail}<li>{$erroremail}</li>{/if}
{if $errorlogin}<li>{$errorlogin}</li>{/if}
{if $errorlogins}<li>{$errorlogins}</li>{/if}
{if $errorpasswords}<li>{$errorpasswords}</li>{/if}
{if $errorpassword}<li>{$errorpassword}</li>{/if}
{if $errorphone}<li>Введите <b>номер телефона</b>, он нужен нашим менеджерам и курьерам для связи по вопросам доставки</li>{/if}
{if $errorname}<li>Укажите ваше <b>имя</b></li>{/if}
{if $erroraddress}<li>Вы забыли указать <b>адрес доставки</b></li>{/if}

</ul>	
</div>
{/if}


<form method="post" id="formCartSent">
<!--input type="hidden" name="action" value="send"-->
<ul>


{*if !$isauth}
<li>
<div class="info">
<h2>Я уже покупал</h2>
<p>У меня уже есть пароль от личного кабинета и я хочу <a href="#" onclick="{literal}document.getElementById('auth').style.display = 'block';{/literal}">войти</a></p>
</div>
</li>


<div id='auth' style="display: none; background-color:#fff;">
<form method='post'>
<ul>
<li>
			<div class="left full">
			<span>
			<label class="desc">Email</label>
			<input id="club" class="field text full" type='text' name='Login'>
			</span>
			<span>
			<label class="desc">Пароль</label>
			<input id="club" class="field text full" type='password' name='Password'>
			</span>
			<span style="margin-top:22px;">
			<input type='submit' name='authorization' value='Войти'>	
			</span>
			<span style="margin-top:18px; margin-left:20px;"><a href="/cabinet/registration/">Регистрация</a>&nbsp;&nbsp;&nbsp;
			<a href="/cabinet/forgotpassword/">Забыли пароль?</a>
			</span>
			</div>
		</li>
		<li class="clear"></li>
</ul>
</form>

</div>
{/if*}


<li>	
<div class="info">

<h2>{if !$isauth}{else}Контактная информация{/if}</h2>
</div>
</li>


<li><label class="desc">Контактное лицо <span class="req"></span></label>
<div>
            <input class="text full"  type="text" name="uName"  value="{$uName}">
            <label>Фамилия Имя Отчество</label>
</div>
</li>
<li><label class="desc">Телефон <span class="req"></span></label>
<div>
            <input class="text full"  type="text" id="tel" name="uPhone"  value="{$uPhone}">
            <label>мобильный, для оперативной связи</label>
</div>
</li>
<li><label class="desc">E-mail</label>
<div>
            <input class="text full"  type="text" name="uEmail"  value="{$uEmail}">
            <label>Для связи по вопросам доставки и уведомлений о состоянии заказа</label>
</div>
</li>

<li><label class="desc">Адрес доставки</label>
<div>		<textarea class="text full" name='uaddress' value='{$uaddress}'>{$uaddress}</textarea></td></tr>
           
            <label>и дополнительная контактаная информация если нужно</label>
</div>
</li>

	{if !$isauth}
				<input type='hidden' name='registration' value='true'>
				<!--li><label class="desc">Логин</label>
				<div>
							<input class="text full" type='text' name='uLogin' value='{$uLogin}'>
							<label>Только латинские буквы и цифры. Мы создадим для вас личный кабинет, в котором будут храниться все ваши заказы. Для входа в него и потребуется логин.</label>
				</div>
				</li-->
				
				<li><label class="desc">Пароль</label>
				<div>
							<input class="text full" type='password' name='uPassword'>
							<label>Пароль для входа в личный кабинет</label>
				</div>
				</li>
				
				<!--li><label class="desc">Повторите пароль</label>
				<div>
							<input class="text full" type='password' name='uPassword2'>
							<label>Должен совпадать с указанным выше</label>
				</div>
				</li-->

	{/if}


<li class="buttons">
 <!--Учтите что все поля отмеченные <span class="req">*</span> обязательны для заполенения.-->
<button class="positive" type="submit" value='sended'><img src="/img/icons/tick.png"/>Отправить заказ!</button>

</li>
</ul>

</form>