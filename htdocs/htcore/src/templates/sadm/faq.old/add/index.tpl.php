{a_faq tpl="file:empty.tpl.php" items_on_page=5 on_date=0 num_items=15 print_form=true faqId=$State.Current_item}

<form method="POST" action="/sadm/faq/add/{$Faq.questions.0.fid|default:0}.xml">
<ul>
<li>
    <div class="info">
        <h2>Редактирование</h2>
        <p>Сообщение пользователя: <strong>{$Faq.questions.0.Name}</strong>&nbsp;<strong>{if $Faq.questions.0.email}<a href="mailto:{$Faq.questions.0.email}">{$Faq.questions.0.email}</a>{else}e-mail не указан{/if}</strong> ip[{$Faq.questions.0.ip}]</p>
    </div>
    <input type="hidden" name="action" value="Update">
    <input type="hidden" name="fid" value="{$Faq.questions.0.fid}">
</li>
<li class="leftHalf">
	<label class="desc">Имя</label>
    <div>
    <input  name="Name" class="text full" value="{$Faq.questions.0.Name}">
    </div>
</li>
<li class="rightHalf">
	<label class="desc">Дата</label>
    <div>
    <input id="inputDate"  name="date" class="text" value="{$Faq.questions.0.date}">
    {literal}
	<script>
  $(document).ready(function(){
  	$('#inputDate').datepicker(
  		$.extend({},
  		$.datepicker.regional["ru"],
  		{ 
  			showStatus: true,
  			showOn: "both",
  			buttonImage: "/img/icons/calendar.png",
			dateFormat:"yy-mm-dd",
  			buttonImageOnly: true
  		}
  	));
  });
    </script>
    {/literal}    
    </div>
</li>

<li class="clear">
	<label class="desc">Вопрос пользователя</label>
    <textarea name="Question" class="textarea full" rows="10">{$Faq.questions.0.Question}</textarea>
</li>
<li>
	<label class="desc">Ваш ответ</label>
	<textarea name="Answer" class="textarea full" rows="10">{$Faq.questions.0.Answer}</textarea>
</li>
<li>
    <label class="desc">Отображать на сайте</label>
    <input id="inputEn" 
            name="enabled" 
            class="checkbox" type="checkbox" 
            {if $Faq.questions.0.enabled}checked{/if}            
            value="1"  />
    <label class="choice" for="inputEn">Включить</label> 
</li>

<li class="buttons">
        <span> 
        <button type="submit" name="ok" class="positive "><img src="/img/icons/tick.png" alt="" /> Применить</button> 
       </span>
        <span> 
        <a href="/sadm/faq/list/" name="cancel" class="negative "><img src="/img/icons/cross.png" alt="" /> Назад</a> 
       </span>  
</li>
</ul>
</form>

{literal}
<script>
    $('textarea').fck({height: {/literal}{$height|default:200}{literal}, ToolbarSet:'Basic'});
</script>
{/literal}
