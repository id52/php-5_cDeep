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
{video_viewer action='galleryid' galleryid='180'}

{if $photos.0.id}

	{foreach from=$photos item=photo}
	<div style="float:left; width: 250px; text-align:center; padding:20px;">
	<a onclick="return hs.expand(this)" href="/upload/photo/{$photo.src}"><img src='/zoom/235x330/upload/photo/{$photo.src}' border="0" alt=""></a>
	</div>
	{/foreach}

{/if}



