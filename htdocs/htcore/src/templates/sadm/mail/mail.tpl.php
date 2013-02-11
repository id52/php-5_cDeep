<div id="container">
  <div id="content" class="nosidebar clearfix">
{registry target='Exchange.Send'}
<form method="POST" style="width:300px;">
<input type="hidden" name="action" value="chmail">
<ul>
	<li><div class="info">
    	<h2>Настройки сайта</h2>
    </div></li>
	<li>
		<label class="desc">email, куда будут приходить письма с сайта</label>
		<div><input class="text full" type="text" name="registry[Exchange.Send.rEmail]" value="{$registry.rEmail}" size="40"></div>
	</li>


{settings}

<li>
<label class='desc'>Название сайта в заголовке окна браузера. &#60;title&#62;</label>
<div><input class="text full" type='text' name='sitename' value='{$sitename}'></div>
</li>
<li><div class="info">

    	<h2>Настройки робокассы</h2>
		
		<p>
		<a href="http://robokassa.ru/">http://robokassa.ru/</a>
		</p>
		
		<label class='desc' for='mrh_login'>mrh_login</label>
		<input class="text full" type='text' id='mrh_login' name='mrh_login' value='{$mrh_login}'>
		
		<label class='desc' for='mrh_pass1'>mrh_pass1</label>
		<input class="text full" type='text' id='mrh_pass1' name='mrh_pass1' value='{$mrh_pass1}'>
		
		<label class='desc' for='inv_desc'>inv_desc</label>
		<input class="text full" type='text' id='inv_desc'  name='inv_desc' value='{$inv_desc}'>
		
		<label class='desc' for='shp_item'>shp_item</label>
		<input class="text full" type='text' id='shp_item' name='shp_item' value='{$shp_item}'>
		
		<label class='desc' for='in_curr'>in_curr</label>
		<input class="text full" type='text' id='in_curr'  name='in_curr' value='{$in_curr}'>
		
		<label class='desc' for='culture'>culture</label>
		<input class="text full" type='text' id='culture'  name='culture' value='{$culture}'>
		
		<label class='desc' for='mrh_pass2'>mrh_pass2</label>
		<input class="text full" type='text' id='mrh_pass2' name='mrh_pass2' value='{$mrh_pass2}'>
		

    </div></li>

	
	
<li><div class="info">
<h2>СМС</h2>
Время на сервере: {$time|rusdate:'d m y h i'}<br>
Время на компе: 
{literal}
<script>
	var date = new Date();
	var month="";
	var hour="";
	var minute="";

	switch(date.getMonth())
	{
		case 0:month="Января";
		  break;
		case 1:month="Февряля";
		  break;
		case 2:month="Марта";
		  break;
		case 3:month="Апреля";
		  break;
		case 4:month="Мая";
		  break;
		case 5:month="Июня";
		  break;
		case 6:month="Июля";
		  break;
		case 7:month="Авгста";
		  break;
		case 8:month="Сентября";
		  break;
		case 9:month="Октября";
		  break;
		case 10:month="Ноября";
		  break;
		case 11:month="Декабря";
		  break;
	};

	hour=date.getHours();
	minute=date.getMinutes();
	
	if(hour<10) hour="0"+hour;
	if(minute<10) minute="0"+minute;
	
	var t=date.getDate()+" "+month+" "+date.getFullYear()+" "+hour+":"+minute;
	document.write(t);
</script>
{/literal}
<br>
<p>Уведомлять меня по СМС о следующих событиях:</p>
<input type="checkbox" name="neworder" value="neworder" {if $neworder}checked{/if}>Новый заказ<br>
<input type="checkbox" name="newquestion" value="newquestion" {if $newquestion}checked{/if}>Новый вопрос<br>
<input type="checkbox" name="clientstatus" value="clientstatus" {if $clientstatus}checked{/if}>Уведомлять клиента о смене статуса заказа<br>
</div></li>


{*<li><label class="desc">Процент для корректировки</label></li>
<li><input class="text full" type="text" name="percent" value="{$percent}" size="40"></li>*}



<li><div class="info">
<h2>zoom</h2>
	<p>Доступно на сервере:</p>
	<ul>
	{if $magicwand}<li>magicwand (используется по умолчанию)</li>{/if}
	{if $gd2}<li>gd2</li>{/if}<br>
	</ul>
	<label class='desc' for='quality'>Качество сжатия</label>
	<input class="text full" type='text' id='quality'  name='quality' value='{$quality}'>
</li>


	
<li class='buttons'><button class="positive" name='submit' value='Сохранить' type="submit"><img src="/img/icons/tick.png"/>Сохранить</button></li>
</ul>

</form>
</div>



</div>

