{s_catalog action='item2'}

{loader src='notify.js' type='js' base='/js/}
{loader src='notify.css, catalog_info.css' type='css' base='/css/'}
{include file='file:catalog/jscripts.tpl.php'}
{loader src='highslide-with-gallery.js' base='/js/highslide/' type='js' comment='Highslide'}
{loader src='highslide.css' base='/js/highslide/' type='css'}

		<div class="topbin" style='display:none'>
			<p class="title"><a href="/catalog/cart/" style="color: #D2280F;">Ваша корзина</a></p>
			Товаров <b><span id="numcart">{$cDeep.session.catalog.num|default:0}</span></b>&nbsp;шт.<br>
			На сумму: <b><span id="summ">{if !$cDeep.session.catalog.summ}0{else}{$cDeep.session.catalog.summ}{/if}</span></b>&nbsp;руб.<br>
			<a href="/catalog/cart/"><b>Оформить заказ</b></a>
			<div id="ctip" name="ctip" class="none" style="display: none;">0</div>
		</div><!-- /topbin -->



{literal}
<script>

function f(mprice)
{


//numcart = window.parent.document.getElementById('numcart').innerHTML;
//numcart=parseInt(numcart)+1;
//window.parent.document.getElementById('numcart').innerHTML=numcart;


//summ = window.parent.document.getElementById('summ').innerHTML;
//summ=parseInt(summ)+parseInt(mprice);
//window.parent.document.getElementById('summ').innerHTML=summ;

numcart = document.getElementById('numcart').innerHTML;
numcart=parseInt(numcart)+1;
window.parent.document.getElementById('numcart').innerHTML=numcart;


summ = document.getElementById('summ').innerHTML;
summ=parseInt(summ)+parseInt(mprice);
window.parent.document.getElementById('summ').innerHTML=summ;


}
</script>
{/literal}





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
	{literal}
	<script>
	
	
	
function selectenable()
{
alert(document.getElementById("myselect").options.length);
if(document.getElementById("myselect").options.length==5)//0
document.getElementById('aaa').style.display = 'none';
alert('5');


};	
	
	
	
function select(mid)
{
	for (i=0;i<document.getElementById("select"+mid).options.length;i++)
	{
		if (document.getElementById("select"+mid).options[i].selected==true)
		{
		
			document.getElementById("href"+mid).href=document.getElementById("href"+mid).href+"&size="+document.getElementById("select"+mid).options[i].value;
			//document.getElementById("href"+mid).style.display = 'block';
			document.getElementById("href"+mid).style.visibility = 'visible';
		}
		
		
			//alert(document.getElementById("myselect").options[i].value)
		
	}
};
</script>
	{/literal}
{address}




<h2>{$Group.mname}</h2>
{section loop=$Item name="i" max=1}

<div class="product">
	<div class="gall">
	{*Основная фотка*}
				<div class="photo-list">
                    <div class="item">
                        {*if $Item[i].ismain}<p class="label">Новинка</p>{/if*}
                        {if $Item[i].mprewiev}
						<a href="{$Item[i].mprewiev}" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/400x0/{$Item[i].mprewiev}" title="{$Item[i].mname}" alt="{$Item[i].mname}" />
						<ins class="zoom"></ins>
						{else}
						<img  src="/zoom3/149x149/ffffff/images/nophoto.gif" title="{$Item[i].mname}" alt="{$Item[i].mname}"/>
						{/if}
						
						<span class="item-data">
                                
                                <span>{$Item[i].mname}</span>
                            </span>
                        </a>
                    </div>
                </div>
				
				<div class="thumbs">
				{section loop=$Photo name=img}
				{if $Photo[img].ext=='jpg'}
				
                <a href="/upload/catalog/{$Photo[img].src}" onclick="return hs.expand(this)" >
                <img src="/zoom3/50x50/ffffff/upload/catalog/{$Photo[img].src}" alt="{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}" /></a>
                {/if}
				{/section}
				</div>
				
				
	</div>
	<div class="prod_right">
	<h1>{$Item[i].mname}</h1>
	<div class="item-price">
                        <form action="">
                            <p>
                                <span>Цена: <b>{$Item[i].mprice}</b> руб.</span>
                                {*<input type="text" name="form[{$Item[i].mId}]" class="qty" id="qty_item_{$cDeep.section.i.index}" value="1" />*}
								{if $Item[i].issize}
										 <SELECT id='select{$Item[i].mid}' name="select{$Item[i].mid}"  onchange='select({$Item[i].mid})'>
										 
										 <option disabled selected>Выберете размер</option>
										 {section loop=$Item[i].sizes name='k'}
											<option>{$Item[i].sizes[k]}</option>
										 {/section}
										 
										 </SELECT>
								{/if}
                                
								{if $Item[i].issize}
									<a style='visibility: hidden' onclick='javascript:f({$Item[i].mprice})' id="href{$Item[i].mid}" href="/catalog/add/{$Item[i].mid}.html?{$cat_link}&count=1" target="hf" id="link_qty_item_{$cDeep.section.i.index}" title="В корзину"></a>

								{else}
								<a href="/catalog/add/{$Item[i].mid}.html?{$cat_link}&count=1"  onclick='javascript:f({$Item[i].mprice}' id="href{$Item[i].mid}" target="hf" id="link_qty_item_{$cDeep.section.i.index}" title="В корзину" ></a>
								{/if}
							
							</p>
                        </form>
                    </div>
					{$Item[i].mcomponents}
	</div>
	

</div>







{*section loop=$Photo name=img}
			 {if $Photo[img].ext=='flv' || $Photo[img].ext=='mp4'}
			 		<a href='/video/upload/catalog/{$Photo[img].src}&image=/upload/{$Photo[img].image}&width=200&height=200'>видюха</a>
			
				<p>{if $Photo[img].Name}{$Photo[img].Name}{else}Рис.{$cDeep.section.img.index+1}{/if}
				&nbsp;<em>{$Photo[img].Description}</em></p>

			
				<embed src="/js/player-4.1.60.swf"
				flashvars="file=/upload/catalog/{$Photo[img].src}&image=/upload/{$Photo[img].image}&width=200&height=200"
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


	
		
		
		
	