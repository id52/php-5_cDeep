	{loader src='structure.css' type='css' base='/css/admin/' comment='Стили'}
{loader src='highslide.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{literal}
<script type="text/javascript">
	hs.graphicsDir = '/js/highslide/graphics/';
	hs.wrapperClassName = 'wide-border';
</script>
{/literal}
<div id="container">
<div id="content" class="clearfix nosidebar">
{orders_admin}	

{if $State.Current_item}
	<a href='/sadm/orders/?p={$current}'>Все заказы</a>
	<div class="info">
<h2>Заказ:</h2>
</div>
{else}
<div class="info">
<h2>Заказы:</h2>
</div>
		{if $count>1}    
			<div class="pagination-clean">
					<ul>
						  {if $last}
						  <li class="previous"><a href="{$link}?uid={$uid}&p={$last}{$slink}&orderby={$orderby}&desc={$desc}">&laquo;&nbsp;Назад</a></li>
						  {else}
						  <li class="previous-off">&laquo;&nbsp;Назад</li>
						  {/if}
						  {section name="p" loop=$count}
							{if $cDeep.section.p.iteration==$current}
							<li class="active">{$cDeep.section.p.iteration}</li>
							{else}
							<li><a href="{$link}?uid={$uid}&p={$cDeep.section.p.iteration}{$slink}&orderby={$orderby}&desc={$desc}">{$cDeep.section.p.iteration}</a></li>
							{/if}
						  {/section}
						  {if $next}
						  <li class="next"><a href="{$link}?uid={$uid}&p={$next}{$slink}&orderby={$orderby}&desc={$desc}">Далее&nbsp;&raquo;</a></li>
						  {else}
						  <li class="next-off">Далее&nbsp;&raquo;</li>
						  {/if}
					</ul>
			  </div>
		{/if}
	{/if}

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
	
<form name=form method=post id=form>
<table class='mytable'>
<thead>
<tr>
{*if !$State.Current_item*}<th><img src="/img/icons/cross.png">{*/if*}
<th>№ <a href="?orderby=id&desc=desc">▼</a><a href="?orderby=id&desc=asc">▲</a>
<th>Имя <a href="?orderby=id&desc=desc">▼</a><a href="?orderby=id&desc=asc">▲</a>
<th>Телефон <a href="?orderby=Phone&desc=desc">▼</a><a href="?orderby=Phone&desc=asc">▲</a>
<th>Дата <a href="?orderby=time&desc=desc">▼</a><a href="?orderby=time&desc=asc">▲</a>
<th>email <a href="?orderby=Email&desc=desc">▼</a><a href="?orderby=Email&desc=asc">▲</a>
<th>Адрес <a href="?orderby=address&desc=desc">▼</a><a href="?orderby=address&desc=asc">▲</a>
<th>ед.
<th>Сумма <a href="?orderby=summ&desc=desc">▼</a><a href="?orderby=summ&desc=asc">▲</a>
<th>Оплачен <a href="?orderby=paid&desc=desc">▼</a><a href="?orderby=paid&desc=asc">▲</a>
<th>Статус
{if !$State.Current_item}
	<a href="?orderby=status&desc=desc">▼</a><a href="?orderby=status&desc=asc">▲</a>
	<th>Просмотреть заказ
{/if}
</tr>
</thead>
{foreach from=$orders item=order}
	<tr class="{cycle values=',alt' name='color123'}">
		{*if !$State.Current_item*}<td><input id='delete' type='checkbox' name='delete[{$order.id}]' value='1'></td>{*/if*}
		<td><a href="/sadm/orders/{$order.id}/">{$order.id}</a></td>
		<td>{$order.Surname}{$order.Name}</td>
		<td>{$order.Phone}</td>
		<td><nobr>{$order.time|rusdate:"d m y h i"}</nobr></td>
		<td><a href="mailto:{$order.Email}">{$order.Email}</a></td>
		<td>{$order.address}</td>
		<td>{$order.amount}</td>
		<td>{$order.summ} руб.</td>
		<td>
			<input type='hidden' name='paid[{$order.id}]' value='0'>
			<input id='paid' type='checkbox' name='paid[{$order.id}]' value='1' {if $order.paid}checked{/if}>
		</td>
		<td>{$order.status2}
			<select name='status[{$order.id}]'>
			{foreach from=$statuses item=status}
				<option value='{$status.id}' {if $order.status==$status.id}selected{/if}>{$status.status}</option>
			{/foreach}

			</select>
		</td>
		{if !$State.Current_item}<td>{if !$State.Current_item}<a href="/sadm/orders/{$order.id}/?p={$current}">Просмотреть заказ</a>{/if}</td>{/if}
	</tr>
{/foreach}
</table>



{if $State.Current_item}
	<h2>В заказ включены:</h2>
	<table class='mytable'>
	<thead>
	<tr><th>
	<img src="/img/icons/cross.png">
	<th>фото
	<th>Товар
	<th>Количество
	<th>Размер
	<th>Цена за ед.
	<th>Сумма
	</tr>
	</thead>
	{foreach from=$orderitems item=orderitem}
		<tr class="{cycle values=',alt' name='color123'}">
			<td><input id='deleteitem' type='checkbox' name='deleteitem[{$orderitem.id}]' value='1'></td>
			<td>
			{if $orderitem.mprewiev}
						<a href="{$orderitem.mprewiev}" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/50x50/{$orderitem.mprewiev}" title="{$orderitem.mname}" alt="{$orderitem.mname}" />
						{else}
						<img  src="/zoom/50x50/images/nophoto.gif" title="{$orderitem.mname}" alt="{$orderitem.mname}" />
						{/if}
			</td>
			
			
			<td><a target='_blank' href="/sadm/catalog/property[{$orderitem.productid}].xml">{$orderitem.mname}</a></td>
			<td>{$orderitem.amount}</td>
			<td>
						{if $orderitem.count_values}
							{foreach from=$orderitem.count_values item=count key=size}
							{$size} - {$count} шт.<br>
							{/foreach}
							{else}
							{$orderitem.size}
						{/if}
			</td>
			<td>{$orderitem.mprice} руб.</td>
			<td>{$orderitem.amount*$orderitem.mprice} руб.</td>
		</tr>
	{/foreach}
	<tr><td colspan=6 style="text-align:right;"><b>Итого:</b></td><td ><b>{$orderitemssumm}</b> руб.</td>
	</tr>
	</table>
{/if}


<div class="buttons">
{*if !$State.Current_item*}
<a href="#" onclick="confirmDelete()">
<img  src='/img/icons/positive.png' >
Сохранить
</a>
{*/if*}
</div>
 </form>

</div>
</div>