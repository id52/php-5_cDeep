{loader src='forms.css, catalog.css' type='css' base='/css/'}

{address}
<form method="post" action="/{$location}/catalog/cart/send/" id='formCartSent' onsubmit="submitCartForm();return false;">
<input type="hidden" name="send" value="true">
<ul>
{*s_catalog_cart action='send'*}
{*
<li id="errorLi">
       <div id="errorMsg">              

              {if $Faq.action.emptyName}
              <p>Пожалуйста заполните поле <strong>Ф.И.О. заказчика</strong> </p>
              {/if}
              {if $Faq.action.emptyQuestion}
              <p>Вы не ввели <strong>Контактный Телефон</strong> </p>
              {/if}
              {if $Faq.action.emptyCode}
              <p>Неверен <strong>Контактный e-mail</strong></p>
              {/if}
       </div>
    </li>
*}
<li>
<div class="info"><h2>Ваши данные</h2></div>
</li>
<li><label class="desc">Ф.И.О. заказчика<span color="req">*</span></label>
<input class="field text full" type="text" name="fio" value=""></li>

<li><label class="desc">Контактный Телефон<span color="req">*</span></label>
<input class="field text full"  type="text" name="phone" value=""></li>

<li><label class="desc">Контактный e-mail<span color="req">*</span></label>
<input class="field text full"  type="text" name="email" value=""></li>

<li class="buttons"><button class="positive" type="submit"><img src="/img/icons/tick.png"/></>отправьте заказ</button></li>
</ul>
</form>