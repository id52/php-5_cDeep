{loader src='facebox.css,gallery.css' type='css' base='/css/admin/' comment=''}
{loader src='facebox/facebox.js' type='js' comment='JQuery'}

<div id="actPhoto" src="#" ></div>
{a_catalog action="Files" item=$State.Current_item}
<div id="gallery">
<div class="floats">
{foreach from=$Photos.List.Files item='Img'}
    <div class="sortitem" id="photo_{$Img.id}">
        <div class="panel">
		{if $Img.ext=='jpg'}
            <a href="/upload/catalog/{$Img.src}" target="_top" rel="facebox" title="{$Img.Name}"><img src="/img/icons/zoom.png" height="16" width="16" alt="Приблизить" /></a>
		{/if}
				
			<a href="edit/photo[{$Img.id}].xml" rel="facebox" ><img src="/img/icons/picture_edit.png" width="16" height="16" alt="Редактировать {$Img.id}"/></a>
			<a href="javascript:void(0);" onclick="{literal}if(confirm(this.title)) { delPhoto('{/literal}{$Img.id}{literal}'); } return false;{/literal}" title="Удалить {$Img.id}?"><img src="/img/icons/cross.png" width="16" height="16" alt="Удалить {$Img.id}"/></a>
        </div>  

        <div class="r">
            <div class="holder">
            <em class="edge"></em>
			{if $Img.ext=='jpg'}
				<em class="container"><a href="/upload/catalog/{$Img.src}" target="_top" rel="facebox" title="{$Img.Name}"><img src="/zoom/100x100/upload/catalog/{$Img.src}" alt="jpg"/></a></em>
			{/if}
			
			
			{if $Img.ext=='flv' || $Img.ext=='mp4'}
			{if $Img.image}
					<em class="container"><img src="/zoom/100x100/upload/{$Img.image}" alt=""/></em>
				{else}
					<em class="container"><img src="/img/flv.jpg" alt=""/></em>
				{/if}
			{/if}
			
			{if $Img.ext=='doc' || $Img.ext=='docx' || $Img.ext=='odt'}
				<em class="container"><img src="/img/doc.jpg" alt="doc"/></em>
			{/if}
			
			{if $Img.ext=='xls' || $Img.ext=='ods' || $Img.ext=='xlsx'}
				<em class="container"><img src="/img/xls.jpg" alt="xls"/></em>
			{/if}
			
			{if $Img.ext=='pdf' }
				<em class="container"><img src="/img/pdf.jpg" alt="pdf"/></em>
			{/if}
            </div>
        </div>
        <div class="min"><p>{if $Img.Name}{$Img.Name}{else}Рис.{$Img.id}{/if}</p></div>
    </div><!---->
    
{/foreach}

{literal}
<SCRIPT type=text/javascript>
function delPhoto(id)
{
    $('#photo_'+id).fadeOut();
        
    Img = new Image(1,1);
    Img.src = "files/remove["+id+"].xml"}
    
 
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
		//$('a[rel*=facebox]').facebox();
    }
);
</SCRIPT> 

{/literal}
</div>
</div>