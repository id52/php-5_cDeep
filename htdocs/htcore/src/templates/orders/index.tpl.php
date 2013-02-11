{loader src='highslide.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{loader src='tables.css' base='/css/' type='css'}
{literal}
<script type="text/javascript">
	hs.graphicsDir = '/js/highslide/graphics/';
	hs.wrapperClassName = 'wide-border';
</script>
{/literal}

{authorization}
{myorders}
{address}

{if $uLogin==$targetuser}
{if $isauth }

		{if $State.Current_item}
			<a href='/cabinet/orders/?p={$current}'>Все заказы</a>
		{else}
									{if $count>1}    
					<div class="pagination-clean">
							<ul>
								  {if $last}
								  <li class="previous"><a href="{$link}?p={$last}{$slink}">&laquo;&nbsp;Назад</a></li>
								  {else}
								  <li class="previous-off">&laquo;&nbsp;Назад</li>
								  {/if}
								  {section name="p" loop=$count}
									{if $cDeep.section.p.iteration==$current}
									<li class="active">{$cDeep.section.p.iteration}</li>
									{else}
									<li><a href="{$link}?p={$cDeep.section.p.iteration}{$slink}">{$cDeep.section.p.iteration}</a></li>
									{/if}
								  {/section}
								  {if $next}
								  <li class="next"><a href="{$link}?p={$next}{$slink}">Далее&nbsp;&raquo;</a></li>
								  {else}
								  <li class="next-off">Далее&nbsp;&raquo;</li>
								  {/if}
							</ul>
					  </div>
				{/if}
			{/if}



			
			
			
		<table class='mytable'>
		<th>№<th>Дата<th>Кол.ед.<th>Сумма<th>Статус {*<th>Оплата*}<th>Контакты<th>{if !$State.Current_item}Просмотреть заказ{/if}
		{foreach from=$orders item=order}
			<tr>
				
				<td>
				{if !$State.Current_item}
				<a href="/cabinet/orders/{$order.id}/">{$order.id}</a>
				{else}
				<h2>{$order.id}</h2>
				{/if}
				</td>
				
				<td>{$order.time}</td>
				<td align=center>{$order.amount}</td>
				<td>{$order.out_summ} руб.</td>
				<td>
			{foreach from=$statuses item=status}
				{if $order.status==$status.id}{$status.status}{/if}
			{/foreach}
				</td>
				{*<td>
				{if $order.paid}Оплачен
				{else}Не&nbsp;оплачен<br>
				{if !$State.Current_item}{if !$State.Current_item}<a href="/cabinet/orders/{$order.id}/?p={$current}">Оплатить</a>{/if}{/if}
				{/if}
				</td>*}
				<td>{$order.Surname} {$order.Name} {$order.Phone}, {$order.address}</td>
				<td>{if !$State.Current_item}<a href="/cabinet/orders/{$order.id}/?p={$current}">Просмотреть заказ</a>{else}<nobr>&larr; <a href='/cabinet/orders/?p={$current}'>вернуться</a>{/if}</nobr></td>
			</tr>
			


		{*if $State.Current_item && !$order.paid}
			{include file="file:catalog/robokassa/pay.tpl.php"}
			
		{/if*}
		
		{/foreach}
		</table>

		{if $State.Current_item}
		<br>
			<h2>В заказ включены:</h2>
			<table class='mytable'>
			<th>&nbsp;<th>Название{*<th>Размер*}<th>Кол-во<th>Цена за ед. (руб.)<th>Сумма (руб.)
			{foreach from=$orderitems item=orderitem}
				<tr>
					<td>
					{if $orderitem.mprewiev}
						<a href="{$orderitem.mprewiev}" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/50x50/{$orderitem.mprewiev}" title="{$orderitem.mname}" alt="{$orderitem[i].mname}" />
						{else}
						<img  src="/zoom/50x50/images/root/nophoto.jpg" title="{$orderitem.mname}" alt="{$orderitem.mname}" />
						{/if}</td>
					<td><a rel="shadowbox;height=800;width=1000" href="/catalog/item[{$orderitem.productid}].xml">{$orderitem.mname}</a></td>
					{*<td>
						{if $orderitem.count_values}
							{foreach from=$orderitem.count_values item=count key=size}
							{$size} - {$count} шт.<br>
							{/foreach}
							{else}
							{$orderitem.size}
						{/if}
					</td>*}
					<td align=center>{$orderitem.amount}</td>
					<td>{$orderitem.mprice}</td>
					<td>{$orderitem.amount*$orderitem.mprice}</td>
				</tr>
			{/foreach}
			<tr><td colspan=4 style="text-align:right;"><b>Итого:</b></td><td><b>{$orderitemssumm}</b></td>
			</tr>
			</table>
		{/if}
{else}
Страница доступна только для авторизованного пользователя
{/if}
{else}
Просмотр данного заказа для вас недоступен
{/if}


