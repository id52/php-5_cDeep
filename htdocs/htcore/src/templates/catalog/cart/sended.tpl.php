{loader src='highslide.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{loader src='tables.css, forms.css' type='css' base='/css/'}
{literal}
<script type="text/javascript">
	hs.graphicsDir = '/js/highslide/graphics/';
	hs.wrapperClassName = 'wide-border';
</script>
{/literal}
{authorization}
{address}
{myorders}
{if $uLogin==$targetuser}
Спасибо, ваш заказ № <span style="font-size:26px;color: #A51E0A;">{$State.Current_item}</span> принят.
В ближайшее время с вами свяжется наш менеджер для подтверждения заказа и уточнения возможных деталей.
{*include file="file:catalog/robokassa/pay.tpl.php"*}
{foreach from=$orders item=order}
		<table class='mytable'>
		<tr><th>№ Заказа</th><td>{$order.id}</td></tr>
		<tr><th>Имя</th><td>{$order.Surname} {$order.Name}</td></tr>
		<tr><th>Телефон</th><td>{$order.Phone}</td></tr>
		<tr><th>Время</th><td>{$order.time}</td></tr>
		<tr><th>Почта</th><td>{$order.Email}</td></tr>
		<tr><th>Кол.ед.</th><td>{$order.amount}</td></tr>
		<tr><th><nobr>Сумма (руб.)</nobr></th><td>{$order.out_summ}</td></tr>
		<tr><th>Адрес</th><td>{$order.address}</td></tr>
		<tr><th>Статус</th><td>{foreach from=$statuses item=status}{if $order.status==$status.id}{$status.status}{/if}{/foreach}</td></tr>
		<tr><th>Оплата</th><td>{if $order.paid}Оплачен{else}Не&nbsp;оплачен{/if}</td></tr>
		{if !$State.Current_item}<th>Просмотреть заказ</th>{/if}
			
		{if $State.Current_item && !$order.paid}
			
			{*literal}
			<!--script language=JavaScript src='https://merchant.roboxchange.com/Handler/MrchSumPreview.ashx?MrchLogin={/literal}{$mrh_login}{literal}&OutSum={/literal}{$order.out_summ}{literal}&InvId={/literal}{$order.id}{literal}&IncCurrLabel={/literal}{$in_curr}{literal}&Desc={/literal}{$inv_desc}{literal}&SignatureValue={/literal}{$crc}{literal}&Shp_item={/literal}{$shp_item}{literal}&Culture={/literal}{$culture}{literal}&Encoding={/literal}{$encoding}{literal}'></script-->
			{/literal*}
			
			
		{/if}	
			
		{/foreach}
		</table>

		{if $State.Current_item}
		<br>
			<h2>В заказ включены:</h2>
			<table class='mytable'>
			<th>№ Товара<th>Товар<th>Размер<th>Количество<th>Цена за ед. (руб.)<th>Сумма (руб.)
			{foreach from=$orderitems item=orderitem}
				<tr>
					<td>
					{if $orderitem.mprewiev}
						<a href="{$orderitem.mprewiev}" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/50x50/{$orderitem.mprewiev}" title="{$orderitem.mname}" alt="{$orderitem[i].mname}" />
						{else}
						<img  src="/zoom/50x50/images/root/nophoto.jpg" title="{$orderitem.mname}" alt="{$orderitem.mname}" />
						{/if}
					</td>
					<td><a href="/catalog/item[{$orderitem.productid}].xml">{$orderitem.mname}</a></td>
					<td>
						{if $orderitem.count_values}
							{foreach from=$orderitem.count_values item=count key=size}
							{$size} - {$count} шт.<br>
							{/foreach}
							{else}
							{$orderitem.size}
						{/if}
			</td>
					<td>{$orderitem.amount}</td>
					<td>{$orderitem.mprice}</td>
					<td>{$orderitem.amount*$orderitem.mprice}</td>
				</tr>
			{/foreach}
			<tr><td colspan=5 style="text-align:right;"><b>Итого:</b></td><td><b>{$orderitemssumm}</b></td>
			</tr>
			</table>
		{/if}
		
{else}
Не хорошо пытаться смотреть чужие заказы.
{/if}
		