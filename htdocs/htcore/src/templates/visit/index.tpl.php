{loader src='uni-form.css, default.uni-form.css' base='/css/' type='css'}



{feedback action="visit"}
<form id="sendmessage" method="POST" class="uniForm">
{if $form.Error}
    <div id="errorMsg">
	{if $form.Error.EMPTY}<p>Вы не наполнели обязательные поля, отмеченные звездочкой. Без этого форма не может быть отправлена</p>{/if}
	{if $form.Error.send}<p>{$form.Error.send}</p>{/if}
	</div>
{/if}
{if $form.Added}
    <div id="okMsg">Ваш вопрос отправлен главе администрации.</div>
{else}
<div class="hilight">

<fieldset class="inlineLabels">



    <div class="ctrlHolder">
      <label class="label" for="">
        <em>*</em>Ваше имя
      </label>
      <input type="text" name="form[Name]" class="textInput" value="{$form.Form.Name}" placeholder=""/><p class="formHint">Обязательное поле</p></div>
   <div class="ctrlHolder">
      <label class="label" for="">
        Компания
      </label>
      <input type="text" name="form[company]" class="textInput" value="{$form.Form.company}" placeholder=""/></div>
     <div class="ctrlHolder">
      <label class="label" for="">
        Должность
      </label>
      <input type="text" name="form[dolj]" class="textInput" value="{$form.Form.dolj}" placeholder=""/></div>
     <div class="ctrlHolder">
      <label class="label" for="">
        <em>*</em>E-mail
      </label>
      <input type="text" name="form[contacts]" class="textInput" value="{$form.Form.contacts}" placeholder=""/><p class="formHint">Обязательное поле</p></div>
     <div class="ctrlHolder">
      <label class="label" for="">
        Телефон
      </label>
      <input type="text" name="form[tel]" class="textInput" value="{$form.Form.tel}" placeholder=""/></div>
    <div class="ctrlHolder">
    <label for="">
      <em>*</em>Ваши вопросы
    </label>
    <textarea type="text" name="form[details]" rows=4>{$form.Form.details}</textarea>
  </div>

  <div class="ctrlHolder buttonHolder">
    <input id="FeedSite" type="text"  class="textInput" name="form[site]" value="www.example.com - очистите содержимое этого поля для отправки сообщения" />
        <p class="label">&nbsp;</p><button name="ok1" type="submit">
          Отправить
        </button>
  </div>
  </fieldset>
</div>
  {/if}
</form>
<script type='text/javascript' src='/js/feedback.js'></script>