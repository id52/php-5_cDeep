{loader src='highslide.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{loader src='tables.css, forms.css' type='css' base='/css/'}
{literal}
<script type="text/javascript">
	hs.graphicsDir = '/js/highslide/graphics/';
	hs.wrapperClassName = 'wide-border';
</script>
{/literal}
{address}
{orders_client}
{* вывод позиций из группы *}

<script>
{literal}
  function rmitem(im, title)
  {
  	  if(confirm('Удалить позицию «'+ title +'»?'))
	  {
	    frm = document.getElementById('fcart');
	    field = document.getElementById('cart['+im+']');
	    field.value=0;
	    frm.submit();
	  }
//    return false;
  }
  function save()
  {
    frm = document.getElementById('fcart');
    frm.submit();
    return false;
  }
{/literal}
</script>

{if $Items}
<form method="post" name="fcart" id="fcart">
<table width=100% class="mytable">
<thead> 
<tr>
<th>Фото</th>
<th>Название</th>
<th align=right>Кол-во (шт.)</th>
<th align=right>Цена за ед. товара (руб.)</th>
<th align=right>Общаяя сумма (руб.)</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
{section loop=$Items name="i"}
<tr>

  <td align=center>
  {if $Items[i].mprewiev}
						<a href="{$Items[i].mprewiev}" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/50x50/{$Items[i].mprewiev}" title="{$Items[i].mname}" alt="{$Items[i].mname}" />
						{else}
						<img  src="/zoom/50x50/images/root/nophoto.jpg" title="{$Items[i].mname}" alt="{$Items[i].mname}" />
						{/if}
  </td>
  <td>
  <a href="/catalog{$Items[i].url|default:'/'}item[{$Items[i].mid}].xml" >{$Items[i].mname}</a>
   {*$Items[i].currency*}
  </td>
  <td width="120" align=right>
  {if $Items[i].count_values}
  <input type="hidden" name="cart[{$Items[i].mid}]" id="cart[{$Items[i].mid}]" value="{$Items[i].num}">
  {foreach from=$Items[i].count_values item=count key='size'}
	<div style="padding-bottom:5px;">{$size}&nbsp;разм.:&nbsp;<input type="text" name="count_values[{$Items[i].mid}][{$size}]" value="{$count}" size=4>
	</div>
  {/foreach}
  <!--input type="hidden" name="cart[{$Items[i].mid}]" id="cart[{$Items[i].mid}]" value="{$Items[i].num}"--> 
  {else}
			<input type="text" name="cart[{$Items[i].mid}]" id="cart[{$Items[i].mid}]" value="{$Items[i].num}" size=4> 
  {/if}
  
  </td>

  <td width="100" align=right>
  {$Items[i].mprice}
  </td>
	  <td align=right>
  {$Items[i].summ}
  </td>
  <td width="20" align=center>
  <a href="#" onclick="return rmitem('{$Items[i].mid}','{$Items[i].mname|htmlall}');" title="Удалить {$Items[i].mname}?"><img src="/img/icons/cross.png" border=0></a>
  </td>
</tr>
{/section}
</tbody>
<tfoot>
<tr>
  <th colspan="4" align=right>
  <strong>Итого:</strong>
  </th>
  <th width="100" align=right class="sum">
  {$summ}
  </th>
  <th>
  </th>
</tr>
</tfoot>
</table>
<div class="buttons" style="float:right">
<a href="#" onclick="return save();" class="button"><img src="/img/icons/arrow_rotate_clockwise.png"/> Пересчитать</a>
<a href="/catalog/cart/send/" class="button positive"><img src="/img/icons/tick.png"/>Все правильно, оформляем</a>

</div>
</form>                                                           
{else}
<h2>Ваша корзина пуста</h2>
{/if}
<script> addcart({$cDeep.session.catalog.num}); </script>
