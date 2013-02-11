<h2>Ваша заявка принята</h2>
<p>Наши менеджеры обязательно свяжутся с вами для подтверждения заказа.</p>
{registry target='Exchange.Send'}
{sendmail send="true" return="false" mailto=$registry.rEmail}

<h2>Данные о заказчике</h2>
<table border=1 width=100% cellpadding=4 cellspacing=0>
    <tbody>
        <tr>
            <th align=left width=30%>Наименование организации:</th>
            <td width=70%>{$form.oranization}</td>
        </tr>
        <tr>
            <th align=left>Юридический адрес:</th>
            <td>{$form.adrfirm|default:'не указанно'}</td>
        </tr>
        <tr>
            <th align=left>ИНН&nbsp;/&nbsp;КПП:</th>
            <td>{$form.inn|default:'не указанно'}&nbsp;/&nbsp;{$form.kpp|default:'не указанно'}</td>
        </tr>
        <tr>
            <th align=left>Контактное лицо:</th>
            <td>{$form.person}</td>
        </tr>
        <tr>
            <th align=left>Телефон:</th>
            <td>{$form.phone}</td>
        </tr>
        <tr>
            <th align=left>E-mail:</th>
            <td>{$form.email|default:'не указанно'}</td>
        </tr>
        <tr>
            <th align=left>Адрес доставки:</th>
            <td>{$form.adrwere|default:'не указанно'}</td>
        </tr>
        <tr>
            <th align=left>Время&nbsp;работы:</th>
            <td>{$form.time|default:'не указанно'}{if $form.break}<br/><em>Перерыв:</em>&nbsp;{$form.break|default:'не указанно'}{/if}</td>
        </tr>
        <tr>
            <th align=left>Расчет:</th>
            <td>{if !$form.pay}Безналичный{else}Наличный{/if}</td>
        </tr>
    </tbody>
</table><hr/>{if $Items}<h2>Перечень заказанных товаров</h2>
<table width=100% border=1  cellpadding=4 cellspacing=0>
<thead> 
<tr>
<th>
Артикул
</th>
<th>
Название
</th>
<th  align=right>
Кол-во
</th>
<th>
Ед. измерения
</th>
<th align=right>
Цена за ед. товара (руб.)
</th>
<th align=right>
Общаяя сумма (руб.)
</th>
</tr>
</thead>
<tbody>
{section loop=$Items name="i"}
<tr>
  <td>
   {$Items[i].code}
  <td>
  {$Items[i].mname}s
   {*$Items[i].currency*}
  </td>
  <td width="70" align=right>
  {$Items[i].num} 
  </td>
    <td align=center>{$Items[i].mweight}</td>
  <td width="100" align=right>
  {$Items[i].mprice}
  </td>
      <td align=right>
  {$Items[i].summ}
  </td>
</tr>
{/section}
</tbody>
<tfoot>
<tr>
  <th colspan="5" align=right>
  <strong>Итого:</strong>
  </th>
  <th width="100" align=right class="sum">
  {$summ}
  </th>
</tr>
</tfoot>
</table>
{/if}

{/sendmail}