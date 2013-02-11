<div id="actPhoto" src="#" ></div>

{video_manager action="Files"}  
<div id="gallery">
<div class="floats">
{foreach from=$video_manager.List.Files item='Img'}
    <div class="sortitem" id="photo_{$Img.id}">
        <div class="panel">
		
		
{if $Img.ext!="flv" && $Img.ext!="mp4"}
            <a href="/upload/photo/{$Img.src}" target="_top" rel="facebox" title="{$Photo.Name}"><img src="/img/icons/zoom.png" height="16" width="16" alt="Приблизить" /></a>
{/if}
			<a href="edit/photo[{$Img.id}].xml" rel="facebox" ><img src="/img/icons/picture_edit.png" width="16" height="16" alt="Редактировать {$Img.id}"/></a>
			<a href="javascript:void(0);" onclick="{literal}if(confirm(this.title)) { loadPhoto('remove','{/literal}{$Img.id}{literal}'); } return false;{/literal}" title="Удалить {$Img.id}?"><img src="/img/icons/cross.png" width="16" height="16" alt="Удалить {$Img.id}"/></a>
        </div>  

        <div class="r">
            <div class="holder">
            <em class="edge"></em>
            <em class="container">

			{if $Img.ext=="flv" || $Img.ext=="mp4"}
				<img src="/zoom/100x100/upload/photo/{$Img.image}" alt="video"/>
			{else}
				<a href="/upload/photo/{$Img.src}" target="_top" rel="facebox" title="{$Photo.Name}">
				<img src="/zoom/100x100/upload/photo/{$Img.src}" alt="preview"/>
			{/if}
			</a></em>
            </div>
        </div>
        <div class="min"><p>{if $Img.Name}{$Img.Name}{else}Рис.{$Img.id}{/if}</p></div>
    </div><!---->
    
{/foreach}


{literal}
<SCRIPT type=text/javascript>
        

function loadPhoto(act, p)
{
	$("#actPhoto").loadJFrame('files/' + act + '[' + p + '].xml');
        
	switch(act)
	{
		case 'remove':
		    $('#photo_'+p).fadeOut(400);
			break;
	};
        
	return false;
}
</SCRIPT>

<SCRIPT type=text/javascript> 
function chfunct(e,ui)
{
    $("#actPhoto").loadJFrame('files/sort[].xml?a&' + $('.floats').sortable('serialize'));
    
}

$(document).ready(
    function () {
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
        $('.disabled').css('opacity', '0.4');
    }
    
);
</SCRIPT> 

{/literal}
</div>
</div>