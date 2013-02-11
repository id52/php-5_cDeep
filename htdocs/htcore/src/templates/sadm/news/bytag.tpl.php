{* в шаблоне неовходимо определить $TagId - номер нужного тэга *}
{news_manager action="ListByTag" primaryTagId=$TagId}
{include file='file:sadm/pages.tpl.php'}
<table cellspacing="0">
	<thead>
		<tr class="{cycle values=",alt" name="color123"}">
			<th width="100%">Название</th>
            <th>∑</th>
{*			<th>Автор</th> *}
			<th>Дата&nbsp;&darr;</th>
		</tr>
    </thead>
	<tbody>
	{foreach from=$News.List item='New'}
		<tr class="{cycle values=",alt" name="color123"}">
			<td width="100%"><a href="/sadm/news/property[{$New.id}].xml" >{$New.Title}</a></td>
            <td>{$New.count}</td>
{*			<td>{$Gallery.Author}</td>*}
			<td>{$New.Date}</td>
		</tr>
	{/foreach}
	</tbody>
</table>

