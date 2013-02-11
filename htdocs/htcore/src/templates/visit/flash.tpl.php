{loader src='uni-form.css, default.uni-form.css' base='/css/' type='css'}
{loader src='jquery.js, uni-form.jquery.js, jquery.placeholder.js' type='js' comment='JQuery'}

{feedback action="flash"}

{*
Представьтесь пожалуйста (инпут: ФИО или название компании)
Как с вами связаться? (маленькая textarea: телефон или e-mail)*
Какую flash анимацию вы хотите заказать? (выпадающий список)
	Flash баннер
	Анимированную шапку для сайта
	Другое
Сценарий или пожелания по анимации (textarea - чуть больше по размерам чем в п.2)
Реквизиты вашей компании (textrarea: потребуются для заключения договора)
Дополнительная информация, которую вы хотите нам сообщить.
*}

<h3>Форма заказа</h3>

<form id="sendmessage" method="POST" class="uniForm" enctype="multipart/form-data">

{if $form.Error.EMPTY}
    <div id="errorMsg">Не заполнены обязательные поля, отмеченные звездочкой. Заполните, пожалуйста.</div>
{/if}
{if $form.Added}
    <div id="okMsg">Спасибо, ваше сообщение отправлено. В ближайшее время наш менеджер свяжется с вами для уточнения деталей.</div>
{else}
<div class="hilight">
 <fieldset class="inlineLabels">
    <div class="ctrlHolder">
      <label class="label" for="">
        Представьтесь, пожалуйста
      </label>
      <input type="text" name="form[Name]" class="textInput" value="{$form.Form.Name}" placeholder="Иванов Иван Иваннович ОАО «Фирма»"/>
      <p class="formHint">
        Ваше Ф.И.О или название компании
      </p>
    </div>
  <div class="ctrlHolder">
    <label for="">
      <em>*</em>
      Ваши контактные данные
    </label>
    <textarea type="text" name="form[email]" rows=3>{$form.Form.email}</textarea>
    <p class="formHint">
      Телефон или E-mail
    </p>
  </div>

    <div class="ctrlHolder">
      <label class="label" for="">
        Какую flash анимацию вы хотите заказать?
      </label>
      <select name="form[serviceType]" class="selectInput">
        <option {if $form.Form.serviceType == 0}selected=selected{/if} value="0">Flash баннер</option>
        <option {if $form.Form.serviceType == 1}selected=selected{/if} value="1">Анимированную шапку для сайта</option>
        <option {if $form.Form.serviceType == 2}selected=selected{/if} value="2">Другое</option>
      </select>
    </div>
  
  <div class="ctrlHolder">
    <label for="">
      Сценарий или пожелания по анимации
    </label>
    <textarea type="text" name="form[about]" class="textInput"/>{$form.Form.about}</textarea>
  </div>
    <div class="ctrlHolder">
    <label for="">
      Реквизиты вашей компании
    </label>
    <textarea type="text" name="form[contacts]"  rows=4>{$form.Form.contacts}</textarea>
    <p class="formHint">
    Потребуются для заключения договора
    </p>
  </div>
    <div class="ctrlHolder">
    <label for="">
      Дополнительная информация, которую вы хотите нам сообщить
    </label>
    <textarea type="text" name="form[details]" rows=4>{$form.Form.details}</textarea>
  </div>
  
  <div class="ctrlHolder buttons">
    <input id="FeedSite" type="text"  class="textInput" name="form[site]" value="www.example.com - очистите содержимое этого поля для отправки сообщения" />
    <BUTTON class="positive" type="submit">
      <img src="/img/icons/tick.png" class=png />Отправить!
    </BUTTON>
  </div>
  </fieldset>
  </div>
</form>
<script>{literal}
$("#FeedSite").attr("value", "").css({display: "none"});
{/literal}</script>
{/if}