<h1>Заказ</h1>
<table border=0 width="95%" class="grouptable"> 
<tr>
  <td>
  <div class="itmbox">
  <b>Наименование</b>
  </div>
  </td>
  <td width="100" class="price">
  <b>Цена</b>
  </td>
  <td width="100" class="price">
  <b>Количество</b>
  </td>
  <td width="100" class="price">
  <b>Сумма</b>
  </td>
</tr>
{section loop=$Items name="i"}
<tr>
  <td>
  <div class="itmbox">[cc:{$Items[i].mid}] ({$Items[i].code}) {$Items[i].mname} // {$Items[i].maker}</a></div>
  </td>
  <td width="100" class="price">
  {$Items[i].mprice} {$Items[i].currency}
  </td>
  <td width="100" class="price">
  {$Items[i].num}&nbsp;{$Items[i].mweight}
  </td>
  <td width="100" class="price">
  {$Items[i].num*$Items[i].mprice}&nbsp;{$Items[i].currency}
  </td>
</tr>
{/section}
<tr>
  <td colspan=2>
  </td>
  <td>
  <b>Итого:</b>
  </td>
  <td width="100" class="price">
  <b>{$summ}</b>
  </td>
</tr>
</table>

<h1>Информация о заказчике</h1>
<form method="post">
<table border=0 width="95%" class="grouptable"> 
<tr><td width=200>Ф.И.О. заказчика</td><td>{$cDeep.post.fio|strip_tags}</td></tr>
<tr><td>Контактный Телефон</td><td>{$cDeep.post.phone|strip_tags}</td></tr>
<tr><td>Контактный e-mail</td><td>{$cDeep.post.email|strip_tags}</td></tr>
</table>
<h1>Информация о получателе</h1>
<table border=0 width="95%" class="grouptable"> 
<tr><td width=200>Ф.И.О. получателя товара</td><td>{$cDeep.post.pfio|strip_tags}</td></tr>
<tr><td>Индекс</td><td>{$cDeep.post.post|strip_tags}</td></tr>
<tr><td>Область</td><td>{$cDeep.post.region|strip_tags}</td></tr>
<tr><td>Город</td><td>{$cDeep.post.city|strip_tags}</td></tr>
<tr><td>Улица</td><td>{$cDeep.post.street|strip_tags}</td></tr>
<tr><td>Номер дома</td><td>{$cDeep.post.house|strip_tags}</td></tr>
<tr><td>Номер офиса/квартиры</td><td>{$cDeep.post.place|strip_tags}</td></tr>
<tr><td>Примечание</td><td>{$cDeep.post.comment|strip_tags}</td></tr>
</table>
