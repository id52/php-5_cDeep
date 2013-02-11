{* в шаблоне неовходимо определить $TagId - номер нужного тэга *}
{news_viewer action="ListByTag" primaryTagId=$TagId}
{include file='file:pages.tpl.php'}
<table cellspacing="0">
	<tbody>
	{foreach from=$News.List item='New'}
		<tr class="{cycle values=",alt" name="color123"}">
			<td width="100%"><a href="/news/{$New.id}.xml" >{$New.Title}</a>
			<p>{$New.Date|rusdate:"d m y"}</p>
			<p><img src="/preview/165x230/upload/news/{$New.Icon|default:'default.jpg'}"></p></td>
		</tr>
	{/foreach}
	</tbody>
</table>

