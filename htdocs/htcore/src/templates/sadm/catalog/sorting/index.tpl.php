{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ядро, поддержка JFrame и JForm'}
{loader src='catalog.css' type='css' base='/css/admin/' comment='Стили'}
{loader src='tables.css' type='css' base='/css/' comment='Стили'}



{a_catalog action="sorting" item=$State.Current_item }
{address}


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



<div id="secondary">
	<div id="sidebar_content">
	
		{if $State.Current_item}<a href='http://{$up}'>Назад</a><br>{/if}
		<ul class="menu"><br>{$me.mname}<br>	<br>
	    {foreach from=$groups item='group'}
			<li><a href='{$group.mid}/'>{$group.mname}</a></li>
		{/foreach}
		</ul>
	</div>
</div>

<form method='post'>
<div id="container">
  <div id="content" class="clearfix">
  <table class='mytable'>
  <th>Выделить<th>mid<th>Название<th>Артикул<th>Количество<th>Цена<th>Ед.изм.<th>М.картинка<th>Картинка<th>Отображается
  {foreach from=$items item='item'}
	<tr>
		<td><input  type="checkbox" value="1" name="item[{$item.mid}]"></td>
		<td>{$item.mid}</td>
		<td><a href='/sadm/catalog/property[{$item.mid}].xml' target='_blank'>{$item.mname}</a></td>
		<td>{$item.articul}</td>
		<td>{$item.amount}</td>
		<td>{$item.mprice}</td>
		<td>{$item.mweight}</td>
		<td>{if $item.mprewiev}есть{else}нет{/if}</td>
		<td>{if $item.mimage}есть{else}нет{/if}</td>
		<td>{if $item.enabled}да{else}нет{/if}</td>
	</tr>
  {/foreach}
  </table>
  
Переместить в:
<select name='groupmove'>
<option></option>
{foreach from=$groupsmove item='groupmove'}
<option value='{$groupmove.mid}'>{$groupmove.pad}{$groupmove.mname}</option>
{/foreach}  
</select>






<input type='submit' value='Переместить'>
  </div>
</div>
</form>


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
