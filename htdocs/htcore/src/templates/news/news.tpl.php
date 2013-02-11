{loader src='news.css' base='/css/' type='css'}
{news_viewer action="List" max=20}
{if  $State.Current_item}
	{include file="file:news/item.tpl.php"}
{else}
	{include file="file:news/items.tpl.php"}
{/if}