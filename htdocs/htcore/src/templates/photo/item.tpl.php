{loader src='highslide-with-gallery.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{literal}
<script type="text/javascript">

//////////////////////////////



hs.graphicsDir = '/js/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'rounded-white';
hs.fadeInOut = true;
//hs.dimmingOpacity = 0.75;

// Add the controlbar
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: 0.75,
		position: 'bottom center',
		hideOnMouseOut: true
	}
});


</script>
{/literal}
<h2>{$Item.fio}</h2>
<div id="gallery">
<div class="floats">
	{section loop=$Item.Photo name=img}
	{if $Item.Photo[img].ext!="flv" && $Item.Photo[img].ext!="mp4"}
    <div class="left">
        <div class="r">
			
				<a onclick="return hs.expand(this)" href="/upload/photo/{$Item.Photo[img].src}" title="{if $Item.Photo[img].Name}{$Item.Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}">
					<img src="/zoom/190x190/upload/photo/{$Item.Photo[img].src}" alt="{if $Item.Photo[img].Name}{$Item.Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}"/>
				</a>
			

			<div class="highslide-caption">
			
				{if $Item.Photo[img].Name}
					{$Item.Photo[img].Name}
				{else}
					Рис.{$cDeep.section.img.index+1}
				{/if}
			
			</div>
			<br />
            <p>
			
				{if $Item.Photo[img].Name}
					{$Item.Photo[img].Name}
				{else}
					Рис.{$cDeep.section.img.index+1}
				{/if}
				&nbsp;<em>{$Item.Photo[img].Description}</em></p>
			
        </div>

		
		
        <div class="min"></div>

    </div>
{/if}	
	{sectionelse}
    {/section}   
</div>

{section loop=$Item.Photo name=img}
		{if $Item.Photo[img].ext=="flv" || $Item.Photo[img].ext=="mp4"}
		<a name="video{$Item.Photo[img].id}">
				<embed src="/js/player-4.1.60.swf"
				flashvars="file=/upload/photo/{$Item.Photo[img].src}&image=/upload/photo/{$Item.Photo[img].image}&width=500&height=400"
				width="500"
				height="400"
				autostart="false"
				allowfullscreen="true"
				allowfullscreen="true"
				streamer="lighttpd"
				showstop="true"
				showdownload="true"
				backcolor="0x333333
				overstretch="true"
				linkfromdisplay="false"
				>
				</embed>
			{/if}
	
{/section}
</div>
















