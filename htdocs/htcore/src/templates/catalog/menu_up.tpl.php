{s_catalog action="sidemenu" group=$tree_root mmid=0}
{address}



<div class="pager">
					<img src="/images/fabi/pager_shadows.png" alt="pager_shadows" class="pshadows" />
					<div id="pager">
						<div class="b-load">



<!--
{section name=u1 loop=$ur1}
	{if $ur1[u1].mname==$location}
		{section name=u2 loop=$ur2}						
			{if $cDeep.section.u2.index%2==0}						
										<div>
											<a href="/{$location}/catalog/{$ur2[u2].mgid}/{$ur2[u2].mid}/" class="catlink"><img src="/images/fabi/pager_shadow_l.png" alt="pager_shadow_l" /></a>
											<img src="{$ur2[u2].mimage}" alt="cat1" />
										</div>
			{else}					
										<div>
											<a href="/{$location}/catalog/{$ur2[u2].mgid}/{$ur2[u2].mid}/" class="catlink"><img src="/images/fabi/pager_shadow_r.png" alt="pager_shadow_r" /></a>
											<img src="{$ur2[u2].mimage}" alt="cat2" />
										</div>
			{/if}
		{/section}
	{/if}
{/section}

-->

		{section name=image loop=$images}		
			{if $cDeep.section.images.index%2==0}						
										<div>
											<a href="/{$location}/catalog/{$images[image].mgid}/{$images[image].mid}/" class="catlink"><img src="/images/fabi/pager_shadow_l.png" title="{$images[image].mname}" /></a>
											<img src="/zoom4/480x355/{$images[image].mimage}" title="cat1" />
										</div>
			{else}					
										<div>
											<a href="/{$location}/catalog/{$images[image].mgid}/{$images[image].mid}/" class="catlink"><img src="/images/fabi/pager_shadow_r.png" title="pager_shadow_r" /></a>
											<img src="{$images[image].mimage}" title="cat2" />
										</div>
			{/if}
		{/section}


						</div><!-- /b-load -->
					</div><!-- /pager -->
</div><!-- /pager -->