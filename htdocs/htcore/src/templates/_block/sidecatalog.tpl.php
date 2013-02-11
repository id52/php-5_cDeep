
                      {foreach from=$State.Item item='i' name='Crumbs'}
                      {*s_catalog action="selfgroup" group=$i mmid=0*} 
                      {if !$cDeep.foreach.Crumbs.last}
                      {assign var="lnk" value="`$lnk``$i`/"}
                      {/if}
                      {/foreach}

                      {if $State.Current_item && $State.Current.index == "/catalog/"}
                        <!--li class="firstli">&larr; <a  href="/catalog/{$lnk}">назад</a></li-->
					    {assign var=tree_root value=$State.Current_item}
					  {else}
					    {assign var=tree_root value=''}
                      {/if}
					  
                  
                  {s_catalog action="sidemenu" group=$tree_root mmid=0}
                  {*foreach from=$Cat item='catItem' key='catKey' name='cat'*}
                    <!--li class="{if $cDeep.foreach.cat.first && !$State.Current_item}firstli{/if}"><a href="/catalog/{$CatLink}{$catItem.mid}/">{$catItem.mname}</a></li-->  
                  {*/foreach*}


{address}				  

<div class="leftmenu">
<ul>

	{section name=u1 loop=$ur1}
	{if $ur1[u1].active}
		<li class='active'><a  href="/catalog/{$ur1[u1].mid}/">{$ur1[u1].mname}</a></li>
		<ul>
		{section name=u2 loop=$ur2}
			{if $ur2[u2].mgid==$ur1[u1].mid}
				{if $ur2[u2].active}
					<li class='active'><a href="/catalog/{$ur1[u1].mid}/{$ur2[u2].mid}/">{$ur2[u2].mname}</a></li>
				{else}
					<li><a href="/catalog/{$ur1[u1].mid}/{$ur2[u2].mid}/">{$ur2[u2].mname}</a></li>
				{/if}
			{else}
			{/if}
		{/section}
		</ul>
	{else}
		<li><a  href="/catalog/{$ur1[u1].mid}/">{$ur1[u1].mname}</a></li> 
	{/if}
	{/section}
</ul>
</div><!-- /leftmenu -->




















{*section name=u1 loop=$ur1}
{if !$ur1[u1].active}
ACTIVE
<li><a  href="/catalog/{$ur1[u1].mid}/">2) INACTIVE {$ur1[u1].mname}</a>	 
{else}
<li><a class='active' href="/catalog/{$ur1[u1].mid}/">1) ACTIVE {$ur1[u1].mname}</a>
	{section name=u2 loop=$ur2}
		{if  $ur2[u2].mgid==$ur1[u1].mid}
			{if !$ur2[u2].active}
			<li><a href="/catalog/{$ur2[u2].mid}/">4) SUBINACTIVE{$ur2[u2].mname}</a><br>
			{else}
				<li class='active'><a href="/catalog/{$ur2[u2].mid}/">3) SUBACTIVE {$ur2[u2].mname}</a>
			{/if}
				{if $ur2[u2].active}
					<ul>
					{section name=u3 loop=$ur3}
						{if $ur3[u3].mgid==$ur2[u2].mid}
						{if !$ur3[u3].active}
							<li><a href="/catalog/{$ur2[u2].mid}/{$ur3[u3].mid}/">{$ur3[u3].mname}</a></li><br>
						{else}
						<li class='active'><a href="/catalog/{$ur2[u2].mid}/{$ur3[u3].mid}/">{$ur3[u3].mname}</a></li><br>
							
						{/if}
						
						{/if}
					{/section}
					</ul>	
				{/if}
				
			</li>
		{/if}
	{/section}

{/if}
{/section*}








	  