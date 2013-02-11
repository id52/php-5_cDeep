{loader src='uni-form.css, default.uni-form.css' base='/css/' type='css'}
{loader src='jquery.js, uni-form.jquery.js, jquery.placeholder.js' type='js' comment='JQuery'}

{feedback action="adv"}

{*
Представьтесь пожалуйста (инпут: ФИО или название компании)
Как с вами связаться? (маленькая textarea: телефон или e-mail)*
Какую услугу по продвижению вы хотите заказать? (вножественный выбор)
	Регистрация сайта в Томских каталогах
	Автоматическая регистрация в 13000 каталогах
	Баннерная реклама на yavtomske.ru
	Поисковая реклама на Яндексе
Адрес вашего сайта (input)
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
        Какую услугу по продвижению вы хотите заказать?
      </label>
      <ul>
      <li>
        <label for="form[serviceType][reg]" class="inlineLabel">
          <input id="form[serviceType][reg]" name="form[serviceType][reg]" {if $form.Form.serviceType.reg  == "Регистрация сайта в Томских каталогах"}  checked=checked{/if}  value="Регистрация сайта в Томских каталогах" type="checkbox"/> Регистрация сайта в Томских каталогах</label>
      </li>
      <li>
        <label for="form[serviceType][autoreg]" class="inlineLabel">
          <input id="form[serviceType][autoreg]" name="form[serviceType][autoreg]" {if $form.Form.serviceType.autoreg  == "Автоматическая регистрация в 13000 каталогах"}  checked=checked{/if}  value="Автоматическая регистрация в 13000 каталогах" type="checkbox"/> Автоматическая регистрация в 13000 каталогах</label>
      </li> 
      <li>
        <label for="form[serviceType][banner]" class="inlineLabel">
          <input id="form[serviceType][banner]" name="form[serviceType][banner]" {if $form.Form.serviceType.banner  == "Баннерная реклама на yavtomske.ru"}  checked=checked{/if}  value="Баннерная реклама на yavtomske.ru" type="checkbox"/> Баннерная реклама на yavtomske.ru</label>
      </li>
      <li>
        <label for="form[serviceType][direct]" class="inlineLabel">
          <input id="form[serviceType][direct]" name="form[serviceType][direct]" {if $form.Form.serviceType.direct  == "Поисковая реклама на Яндексе"}  checked=checked{/if}  value="Поисковая реклама на Яндексе" type="checkbox"/> Поисковая реклама на Яндексе</label>
      </li> 
    </ul>
    </div>
  
  <div class="ctrlHolder">
    <label for="">
      Адрес вашего сайта
    </label>
    <input type="text" name="form[www]" class="textInput" value="{$form.Form.www}"/>
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