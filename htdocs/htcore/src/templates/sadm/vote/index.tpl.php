{include file="sadm/header.tpl.php"}
{a_vote id=$State.Current_item}


{literal}
<script>
function confirm_delete(id)
{

	if(confirm("Удалить?"))
	{
		$.get(id+".xml?action=rmQuest");
		$('#vote'+id).remove();
		
	};
};
</script>
{/literal}


<div id="secondary">
    <div id="sidebar_content" class="clearfix">
    <h3>Опросы <a href="new.xml"><img src="/images/admin/tag_blue.png" alt="добавить"/>добавить</a></h3>
		{a_vote}
        <ul id="opros">
        {foreach from=$Votes item="V"}
        	<li id=vote{$V.id}>
			<a class="name" href="{$V.id}.xml">
			{if $State.Current_item==$V.id}<i>{/if}
			
			{if $V.enabled}<span style="font-size:14px;">{/if}
			{$V.title}
			{if $V.enabled}</span>{/if}
			{if $State.Current_item==$V.id}</i>{/if}
			</a>
	
			<img onclick="confirm_delete({$V.id})" src="/images/admin/cross.png" />
		
			</li>
        {/foreach}

        </ul>
	</div>
</div>

<hr/>
{literal}

<script>
function clearfield(field)
{
	if(confirm("Удалить?"))
	{
		document.getElementById(field).value = '';
		document.getElementById('qform').submit();
		return false;
	};
}
</script>

{/literal}
<div id="container">
  <div id="content" class="clearfix">
        <div class="info">
          <h2>{$topic}</h2>
        </div>  
<form method="POST" id="qform">
<ul>
   	<li>
    <label class="desc">Тема опроса</label>
    <div>
	<input type="text" class="field text medium" id="first" name="title" value="{$Vote.title}" />
    <label>Ваш вопрос к посетителям сайта</label>
    </div>
    <span>
	<input type="checkbox" class="field text checkbox" id="active" name="enabled" value="1" {if $Vote.enabled} checked="checked"{/if} />
    <label class="choice" for="active">Активный опрос</label>
    </span>    
   	</li>
   	<li>
    <label class="desc">Варианты ответов</label>

    
    {foreach from=$Vote.quest key="Quest" item="Stat" name="q"}
    <div class="left half">    
   	<input type="text" class="field text full" id="q{$cDeep.foreach.q.iteration}" name="quest[]" value="{$Quest}" />
    <label>Вариант ответа номер {$cDeep.foreach.q.iteration}, набрал {$Stat} голосов</label></div>
	<a class="delete" href="#" onclick="return clearfield('q{$cDeep.foreach.q.iteration}');"><img src="/images/admin/delete.png" /></a><br class="clear" />   
	{/foreach}
    <div class="left half">    
   	<input type="text" class="field text full" id="third" name="quest[]" value="" />
        	
    <label>Новый</label></div>
	<br class="clear" />
    </li>
   	<li class="buttons">
   	<button type="submit"><img src="/images/admin/add.png" /> Добавить | Сохранить</button>
	</li>
</form>
    </div>
</div>
{include file="sadm/footer.tpl.php"} 
    