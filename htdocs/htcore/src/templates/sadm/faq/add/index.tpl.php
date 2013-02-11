{a_faq tpl="file:empty.tpl.php" items_on_page=5 on_date=0 num_items=15 print_form=true faqId=$State.Current_item}

<form method="POST" action="/sadm/faq/add/{$Faq.questions.0.fid|default:0}.xml">
<ul>
<li>
    <div class="info">
        <h2>Редактирование</h2>
        <p>Сообщение пользователя: <strong>{if $Faq.questions.0.email}<a href="mailto:{$Faq.questions.0.email}">{$Faq.questions.0.Name}</a>{else}{$Faq.questions.0.Name}{/if}</strong> ip[{$Faq.questions.0.ip}]</p>
		<p>email: <a href="mailto:{$Faq.questions.0.email}">{$Faq.questions.0.email}</a></p>
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
<label class="desc">Категория</label>
<div><select name='category'>
{foreach from=$categories item=category}
	<option value='{$category.id}' {if $Faq.questions.0.category==$category.id}selected{/if}>{$category.name}</option>
{/foreach}
{if !$Faq.questions.0.category}
	<option selected disabled>Без категории</option>
{/if}
</select>
</div>
</li>
<li class="rightHalf">
	<label class="desc">Дата</label>
    <div>
    <input id="inputDate"  name="date" class="text" value="{$Faq.questions.0.date}">
    {literal}
	<script>
  var now = new Date();
  $(document).ready(function(){
  	$('#inputDate').datepicker(
  		$.extend({},
  		$.datepicker.regional["ru"],
  		{ 
  			showStatus: true,
  			showOn: "both",
  			buttonImage: "/img/icons/calendar.png",
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


{if $Faq.questions.0.publish}
		<li>
			<label class="desc">Отображать на сайте </label>
			<input id="inputEn" 
					name="enabled" 
					class="checkbox" type="checkbox" 
					{if $Faq.questions.0.enabled}checked{/if}            
					value="1"  />
			<label class="choice" for="inputEn">Включить. Пользователь разрешил публиковать вопрос и ответ на сайте.</label> 
		</li>
{else}
<p><span style="color:red;">Пользователь запретил публиковать вопрос и ответ на сайте</span>
<br><b>Вы можете ответить пользователю двумя способами:</b>
<ol>
<li>1) Заполните поле "Ваш ответ" и нажмите кнопку "Применить". Ответ будет отправлен пользователю на email.</li>
<li>2) Можете самостоятельно отправить пользователю email с ответом удобным для вас способом (например с вашего email). Email пользователя: <a href="mailto:{$Faq.questions.0.email}">{$Faq.questions.0.email}</a></li>
</ol>
</p>
{/if}


<li class="buttons">
        <span> 
        <button type="submit" name="ok" class="positive "><img src="/images/admin/tick.png" alt="" /> Применить</button> 
       </span>
        <span> 
        <a href="/sadm/faq/list/" name="cancel" class="negative "><img src="/images/admin/cross.png" alt="" /> Назад</a> 
       </span>  
</li>
</ul>
</form>

<div id="email" style="visibility:hidden">{$email}</div>
<div id="question" style="visibility:hidden">{$question}</div>
<div id="answer" style="visibility:hidden">{$answer}</div>
{if $email}
{literal}
	<script>
		email=document.getElementById('email').innerHTML;
		question=document.getElementById('question').innerHTML;
		answer=document.getElementById('answer').innerHTML;
		

	function sendmail()
	{
		if (confirm("Отправить пользователю ответ на email?")) 
		{
			$.post("/sadm/faq/email/",{'email':email, 'question':question, 'answer':answer});
		};
	};
	sendmail();
	
    </script>
{/literal}  
{/if}

{literal}
<script>
    $('textarea').fck({height: {/literal}{$height|default:200}{literal}, ToolbarSet:'Basic'});
</script>
{/literal}







