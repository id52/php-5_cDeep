{loader src='jquery.js, jquery.colorbox-min.js' type='js' comment='JQuery'}
{loader src='gallery.css, colorbox.css' base='/css/' type='css'}

{loader action=print}

        {literal}
        <script type="text/javascript"> 
     
            jQuery(document).ready(function(){
                $("a[rel='mirrors']").colorbox();
            });
     
        </script>
        {/literal}


<div class="floats">{section loop=$Item.Photo name=img}

    <div class="left">
        <div class="r">
	<a href="/zoom/800x800/upload/photo/{$Item.Photo[img].src}" rel="mirrors" title="{if $Item.Photo[img].Name}{$Item.Photo[img].Name}{else}{$Item.Photo[img].Description}{/if}"><img src="/zoom/190x190/upload/photo/{$Item.Photo[img].src}" alt="{if $Item.Photo[img].Name}{$Item.Photo[img].Name}{else}{$Item.Photo[img].Description}{/if}"/></a><p>{if $Item.Photo[img].Name}{$Item.Photo[img].Name}{else}{$Item.Photo[img].Description}{/if}</p>
        </div>
        <div class="min"></div>
    </div>{/section}</div>