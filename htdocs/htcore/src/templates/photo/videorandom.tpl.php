{video_viewer action='videoRandom'}


{if $videos.0.id}
	{foreach from=$videos item=video}
		<div class="player">
		<a href="/photo/{$video.gid}.xml#video{$video.id}">
			<img src='/zoom/235x0/upload/photo/{$video.image}' border="0" alt="">
		</a>
		</div>
	{/foreach}
	<div class="description">
		{$video.Description}
	</div>
{/if}



