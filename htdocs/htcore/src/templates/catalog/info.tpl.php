{loader src='catalog_info.css' type='css' base='/css/'}
{loader src='highslide-with-gallery.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}
{literal}
<script type="text/javascript">
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

<h2>{$Group.mname}</h2>
{section loop=$Item name="i" max=1}
<h1>{$Item[i].mname}</h1>
            <div class="item-content_wrap">
                <div class="item-content">
                    <div class="item-price">
                        <form action="">
                            <p>
                                <span>Цена: <b>{$Item[i].mprice}</b> руб.</span>
                                {*<input type="text" name="form[{$Item[i].mId}]" class="qty" id="qty_item_{$cDeep.section.i.index}" value="1" />*}
                                <a href="/catalog/add/{$Item[i].mid}.html?{$cat_link}&count=1" target="hf" id="link_qty_item_{$cDeep.section.i.index}" title="В корзину"><img src="/images/ico_buy.png" width="23" height="21"></a>
                            </p>
                        </form>
                    </div>
                   {$Item[i].mcomponents}
                    <div class="submenu-list">
					
					

					{if $group1}
						<div class="submenu">
                            <h3>Паспорта:</h3>
                            <ul>
                             {section loop=$Photo name=img}
							{if $Photo[img].group=='1'}
							 <li><a href="/upload/menu/{$Photo[img].src}">{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}</a></li>
                            {/if}
							{/section}   
                            </ul>
                        </div>
					{/if}
						
						
					{if $group2}	
						<div class="submenu">
                            <h3>Технические данные:</h3>
                            <ul>
                             {section loop=$Photo name=img}
							{if $Photo[img].group=='2'}
							 <li><a href="/upload/menu/{$Photo[img].src}">{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}</a></li>
                            {/if}
							{/section}   
                            </ul>
                        </div>
					{/if}
					
					{if $group3}
                        <div class="submenu submenu-last">
                            <h3>Сертификаты:</h3>
                            <ul>
                             {section loop=$Photo name=img}
							{if $Photo[img].group=='3'}
							 <li><a href="/upload/menu/{$Photo[img].src}">{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}</a></li>
                            {/if}
							{/section}   
                            </ul>
                        </div>
					{/if}
						
						
                    </div>
                </div>
            </div>
            <div class="item-sidebar">
                {*Основная фотка*}
				<ul class="photo-list">
                    <li class="item">
                        {if $Item[i].ismain}<p class="label">Новинка</p>{/if}
                        {if $Item[i].mprewiev}
						<a href="{$Item[i].mprewiev}" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/149x0/{$Item[i].mprewiev}" title="{$Item[i].mname}" alt="{$Item[i].mname}" />
						{else}
						<img  src="/zoom3/149x161/ffffff/images/root/nophoto.jpg" title="{$Item[i].mname}" alt="{$Item[i].mname}" />
						{/if}
                            <span class="item-data">
                                  {if $Item[i].mprewiev}<ins class="zoom"></ins>{/if}
                                <span>{$Item[i].mname}</span>
                            </span>
                        </a>
                    </li>
                    </ul>
					{*Доплнительные фотки*}
					<ul class="photo-list">
					{section loop=$Photo name=img}
					{if $Photo[img].ext=='jpg'}
					<li class="item">
                        <a  onclick="return hs.expand(this)" href="/upload/menu/{$Photo[img].src}" class="photo-gallery" title="{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}">
                            <img src="/zoom/149x0/upload/menu/{$Photo[img].src}" alt="{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}" />
                            <span class="item-data">
                                <ins class="zoom"></ins>
                                <span>{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}</span>
                            </span>
                        </a>
                    </li>
                    {/if}
					{/section}
					</ul>
				
					{*Видео*}
					<ul class="photo-list">
					{section loop=$Photo name=img}
					{if $Photo[img].ext=='flv' || $Photo[img].ext=='mp4'}
					<li class="item video">

					<a href='/catalog/video/{$Photo[img].id}'  class="move" onclick="return hs.htmlExpand(this, width: 440, outlineType: 'rounded-white', wrapperClassName: 'draggable-header', objectType: 'iframe')" >
                            <img src="/zoom3/149x149/ffffff/upload/{$Photo[img].image}">
                            <span class="item-data">
                                <ins class="play"><img src="/upload/play.png" width="100%" alt="Посмотреть видео"></ins>
								
                                <span>{$Photo[img].Name}</span>
                            </span>
                        </a>
						
                    </li>
					{/if}
					{/section}		
					
					
                </ul>
			</div>



{*section loop=$Photo name=img}
			 {if $Photo[img].ext=='flv' || $Photo[img].ext=='mp4'}
			 		<a href='/video/upload/menu/{$Photo[img].src}&image=/upload/{$Photo[img].image}&width=200&height=200'>видюха</a>
			
				<p>{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}
				&nbsp;<em>{$Photo[img].Description}</em></p>

			
				<embed src="/js/player-4.1.60.swf"
				flashvars="file=/upload/menu/{$Photo[img].src}&image=/upload/{$Photo[img].image}&width=200&height=200"
				width="400"
				height="300"
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
				</embed><br><br><br><br>
			{/if}
	{/section*}	
{/section}


	
		
		
		
	