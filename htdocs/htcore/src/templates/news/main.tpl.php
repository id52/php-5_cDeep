{loader src='news.css' base='/css/' type='css'}
{news_viewer action="ListByTag" max=3}


			
<div class="leftnews">
				<p class="header">Последние новости</p>
				<div class="leftnewsT">
				<div class="leftnewsB">
					{foreach from=$News.List item="New" name='news'}
					<div class="item">
						<p class="date"><span>{$New.Date|rusdate:"d m y"}</span></p>
						<p class="title"><a href="/news/{$New.id}.html">{$New.Title}</a></p>
						{$New.Description}
						<a href="/news/{$New.id}.html" class="readon">подробнее</a>
					</div>
					{/foreach}    
				</div>
				</div>
				<a href="/news/" class="readall">Все новости</a>
</div>			