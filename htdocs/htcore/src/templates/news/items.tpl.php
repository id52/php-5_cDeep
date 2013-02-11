{include file="file:paging.tpl.php" link="/news/"}
<div id="news">
	    {foreach from=$News.List item="New"}
		<div class="nitem">
            <a href="/news/{$New.id}.html">{$New.Title}</a>
			<span class="newsdate">{$New.Date|rusdate:"d m y"}</span>       
            <div class="descript">
            {if $New.Icon}
    		<a href="/news/{$New.id}.html"><img src="/zoom/120x120/upload/news/{$New.Icon}" alt="{$New.Title}" title="{$New.Title}" align="left"></a>
    		{/if}
            {$New.Description}
			</div>
        </div><!-- item -->
    {/foreach}
</div>
{include file="file:paging.tpl.php" link="/news/"}