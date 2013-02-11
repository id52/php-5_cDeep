{loader src='gallery.css' base='/css/' type='css'}
{if $Item}
{include file="file:photo/item.tpl.php"}
{/if}
{if $Post}
{include file="file:photo/items.tpl.php"}
{/if}