{loader src='structure.css' type='css' base='/css/admin/' comment='Стили'}
{users}
<script>
{literal}	
function confirmDelete() {
    if (confirm("Сохранить?")) {
	        document.form.submit();
	    } else {
	        
	    }
	}	
{/literal}
</script>	


<div id="container">
<div id="content" class="clearfix nosidebar">

<div class="info">
<h2>Клиенты:</h2>
</div>
		{if $count>1}    
			<div class="pagination-clean">
					<ul>
						  {if $last}
						  <li class="previous"><a href="{$link}?p={$last}{$slink}&orderby={$orderby}&desc={$desc}">&laquo;&nbsp;Назад</a></li>
						  {else}
						  <li class="previous-off">&laquo;&nbsp;Назад</li>
						  {/if}
						  {section name="p" loop=$count}
							{if $cDeep.section.p.iteration==$current}
							<li class="active">{$cDeep.section.p.iteration}</li>
							{else}
							<li><a href="{$link}?p={$cDeep.section.p.iteration}{$slink}&orderby={$orderby}&desc={$desc}">{$cDeep.section.p.iteration}</a></li>
							{/if}
						  {/section}
						  {if $next}
						  <li class="next"><a href="{$link}?p={$next}{$slink}&orderby={$orderby}&desc={$desc}">Далее&nbsp;&raquo;</a></li>
						  {else}
						  <li class="next-off">Далее&nbsp;&raquo;</li>
						  {/if}
					</ul>
			  </div>
		{/if}

<form method='post' name='form' id='form'>
<table class='mytable'>
<thead>
<th><img src="/img/icons/cross.png">
<th>№<a href="?orderby=UID&desc=desc">▼</a><a href="?orderby=UID&desc=asc">▲</a>
<th>Логин<a href="?orderby=Login&desc=desc">▼</a><a href="?orderby=Login&desc=asc">▲</a>
<th>ФИО<a href="?orderby=Name&desc=desc">▼</a><a href="?orderby=Name&desc=asc">▲</a>
<th>Телефон<a href="?orderby=Phone&desc=desc">▼</a><a href="?orderby=Phone&desc=asc">▲</a>
<th>Email<a href="?orderby=Email&desc=desc">▼</a><a href="?orderby=Email&desc=asc">▲</a>
<th>Адрес<a href="?orderby=address&desc=desc">▼</a><a href="?orderby=address&desc=asc">▲</a>
<th>Дата регистрации<a href="?orderby=regtime&desc=desc">▼</a><a href="?orderby=regtime&desc=asc">▲</a>
<th>Посл. вход<a href="?orderby=authtime&desc=desc">▼</a><a href="?orderby=authtime&desc=asc">▲</a>
</thead>
{foreach from=$users item=user}
<tr  class="{cycle values=',alt' name='color123'}">
<td><input id='deleteuser' type='checkbox' name='deleteuser[{$user.UID}]' value='1'></td>
<td>{$user.UID}</td>
<td><a href="/sadm/orders/?uid={$user.UID}">{$user.Login}</a></td>
<td><a href="/sadm/orders/?uid={$user.UID}">{$user.Name}</a></td>
<td>{$user.Phone}</td>
<td><a href="mailto:{$user.Email}">{$user.Email}</a></td>
<td>{$user.address}</td>
<td>{$user.regtime}</td>
<td>{$user.authtime}</td>
</tr>
{/foreach}
</table>



<div class="buttons">
<a href="#" onclick="confirmDelete()">
<img  src='/img/icons/cross.png' >
удалить выбранных
</a>
</div>



</form>
</div>
</div>