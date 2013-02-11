{if "/`$State.Path.0.index`" == "/index/"}
{else}
{if count($State.Path) > 0}
                    <div id="globalnav">
                            <a href="/" class="home"><span>Главная</span></a><em>&rarr;</em>
	                    {foreach from=$State.Path name='Crumbs' item='Page'}
		                    {if $cDeep.foreach.Crumbs.last}
		                      {$Page.Title}
		                    {else}
		                      <a href="/{$Page.index}">{$Page.Title}</a><em>&rarr;</em>
		                    {/if}
	                    {/foreach}
                    </div>
                    {/if}
{/if}
