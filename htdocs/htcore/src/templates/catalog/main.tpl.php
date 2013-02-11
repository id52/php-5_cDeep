{literal}
<script>
var head = document.getElementsByTagName("head")[0];
var link = document.createElement("link");
link.setAttribute("href","/css/notify.css");
link.setAttribute("rel","stylesheet");
head.appendChild(link);




var script = document.createElement("script");
script.setAttribute("src","/css/notify.js");
script.setAttribute("type","text/javascript");
head.appendChild(script);


</script>
{/literal}






<link rel="Stylesheet"  href="/css/notify.css" type="text/css" />
<script type="text/javascript" src="/js/notify.js"></script>
{include file='file:catalog/jscripts.tpl.php'}




        {************* groups *************}
        {s_catalog action="group" group=$State.Current_item mmid=0}
		{s_catalog action="main"}
    
			
		{section loop=$Groups name='mi'}

		
		{if $Groups[mi].is_group}
		<div class="item clear">
		<p class="title"><a href="/catalog/{$Groups[mi].url}">{$Groups[mi].mname}</a></p>
		<p class="pic">
			<a href="/catalog/{$Groups[mi].url}"><img width="163" src="/zoom/163x0/{$Groups[mi].mprewiev|default:'/images/root/nophoto2.jpg'}"></a>
		</p>
		</div>

		{else}
		
		
		
		<div class="item clear">
		<p class="title"><a href="/catalog/{$Groups[mi].url}">{$Items[mi].mname}</a></p>
		<p class="pic">
			<a href="/catalog/{$Groups[mi].url}"><img src="/zoom/163x0/{$Items[mi].mprewiev|default:'/images/root/nophoto.jpg'}" alt="prod_mid" width="163"/></a>
		</p>
		<div class="info2 clear">
		<p class="priceLabel">ЦЕНА:</p>
		<p class="price"><b>{$Items[mi].mprice}</b> РУБ.</p>
		<a href="/catalog/add/{$Groups[mi].mid}.html?{$cat_link}&count=1" target="hf" id="link_qty_item_{$cDeep.section.mi.index}" 
		title="{$Groups[mi].mname|htmlall}" class="buy"></a>
		</div>
		</div>
		
		
		
		


		


		{/if}
		
       {/section}
