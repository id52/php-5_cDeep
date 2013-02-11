{Catalog action="Images"}
<div id="gallery">
<div class="floats">
    {foreach from=$Images item='Img'}
    <div class="sortitem" id="photo_{$Img.ID}">
        <div class="panel">
            <a href="{$Img.src}" target="_blank" rel="{$Img.ID}" class="SetMain"><img src="/img/icons/tag.png" height="16" width="16" alt="Поставить главной" /></a>
            <a href="{$Img.src}" target="_blank" rel="facebox"><img src="/img/icons/zoom.png" height="16" width="16" alt="Приблизить" /></a>
			<a title="Удалить {$Img.ID}?" target="_blank" class="RemoveImage" href="{$State.Current.Link}{$Item.ID}.html?RemoveImage={$Img.ID}"><img src="/img/icons/cross.png" width="16" height="16" alt="Удалить {$Img.ID}"/></a>
        </div>

        <div class="r">
            <div class="holder">
            <em class="edge"></em>
            <em class="container"><a href="{$Img.src}" target="_blank" rel="facebox"><img src="/zoom/100x100{$Img.src}" rel="{$Img.src}" width="100" alt="/zoom/100x100:{$Img.src}" id="ImageSrc{$Img.ID}"/></a></em>
            </div>
        </div>
        <div class="min"><p>Рис.{$Img.ID}</p></div>
    </div><!---->
    {/foreach}
    {literal}<SCRIPT type=text/javascript>
    function chfunct(e,ui)
    {
        $.get('{/literal}{$State.Current.Link}{$Item.ID}.html{literal}?a&' + $('.floats').sortable('serialize'), function(){});
        
    }
    (function () {
        $('.floats').sortable(
            {
                opacity:        0.8,
                fx:             200,
                revert:         true,
                helper:         "clone",
                tolerance:      "guess",
                items:          ".sortitem",
                update:         function(e,ui) { chfunct(e,ui); }
            }
        );
        $('#gallery a.SetMain').live('click', function(){
	        	var id       = $(this).attr('rel');
	        	var srcImage = $('#ImageSrc'+id);
	        	var dstImage = $('#MainImage');
	        	
	        	var src = srcImage.attr('alt').split(':');
	        	var dst = dstImage.attr('alt').split(':');
        		
	        	if(dst[1]=='') {
	        		dstImage.attr('src', dst[0]+src[1]);
	        		dstImage.attr('alt', dst[0]+':'+src[1]);
	        		dstImage.fadeIn();
	        		srcImage.fadeOut();
	        	} else {
	        		srcImage.attr('src', src[0]+dst[1]);
	        		dstImage.attr('src', dst[0]+src[1]);
	        		
	        		srcImage.attr('alt', src[0]+':'+dst[1]);
	        		dstImage.attr('alt', dst[0]+':'+src[1]);
	        	}
	        	
	        	var Img = new Image(1,1);
	        	Img.src = '{/literal}{$State.Current.Link}{$Item.ID}.html{literal}?RevertImage='+id;
	        	
	        	return false;
        });
        $('#gallery a.RemoveImage').live('click', function(){
        	var title = $(this).attr('title');
        	if(confirm(title)) {
	        	var href = $(this).attr('href');
	        	var cont = $(this).parentsUntil('.sortitem').parent();
	        	cont.fadeOut();
	        	var Img = new Image(1,1);
	        	Img.src = href;
        	}
        	return false;
        });
    })();
    </SCRIPT>{/literal}
</div>
</div>
