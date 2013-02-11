{loader src='jquery.format.1.02.js' type='js' base='/js/}
{loader src='catalog.css,navigation.css, gallery.css, tables.css' type='css' base='/css/'}
{include file='file:catalog/jscripts.tpl.php'}

{if $cDeep.request.search}
  {s_catalog action="search" group=$State.Current_item mmid=0 max=100}
  
{else}
    {************* products *************}
    {s_catalog action="item" group=$State.Current_item mmid=0 max=100}
    
    {if $Item}
	{else}
	{capture name='products' assign="products"}
  
    {if $Items}

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
	}
};
</script>
{/literal}

{if $Page.count>1}    
    <div class="pagination-clean">
            <ul>
                  {if $Page.last}
                  <li class="previous"><a href="{$link}?p={$Page.last}{$slink}&orderby={$orderby}&desc={$desc}">&laquo;&nbsp;Назад</a></li>
                  {else}
                  <li class="previous-off">&laquo;&nbsp;Назад</li>
                  {/if}
                  {section name="p" loop=$Page.count}
				  
                    {if $cDeep.section.p.iteration==$Page.current}
                    <li class="active">{$cDeep.section.p.iteration}</li>
                    {else}
                    <li><a href="{$link}?p={$cDeep.section.p.iteration}{$slink}&orderby={$orderby}&desc={$desc}">{$cDeep.section.p.iteration}</a></li>
                    {/if}
                  {/section}
                  {if $Page.next}
                  <li class="next"><a href="{$link}?p={$Page.next}{$slink}&orderby={$orderby}&desc={$desc}">Далее&nbsp;&raquo;</a></li>
                  {else}
                  <li class="next-off">Далее&nbsp;&raquo;</li>
                  {/if}
            </ul>
      </div>
{/if}

<div class="sorting">
	<a href="?orderby=mprice&desc=desc">▼</a>цена<a href="?orderby=mprice&desc=asc">▲</a>
	<a href="?orderby=mname&desc=desc">▼</a>название<a href="?orderby=mname&desc=asc">▲</a>
</div>

<div class="prods_small">
	{section loop=$Items name='mi'}
	<div class="item clear">
					<div class="pic">
						<a href="item[{$Items[mi].mid}].xml"><img width="54" height="54" alt="prod_small" src="/zoom3/54x54/ffffff/{$Items[mi].mprewiev|default:'/images/root/nophoto.jpg'}"></a>
					</div>
					<div class="text">
						<h4><a href="item[{$Items[mi].mid}].xml">{$Items[mi].mname}</a></h4>
						<div class="info2">
							ЦЕНА: <b>{$Items[mi].mprice}</b> РУБ.
							<a href="/catalog/add/{$Items[mi].mid}.html?{$cat_link}&count=1" target="hf" id="link_qty_item_{$cDeep.section.mi.index}" 
		title="{$Items[mi].mname|htmlall}" class="buy"></a>
						</div>
					</div>
				</div>
	   {/section}
</div>
    {include file="file:paging.tpl.php"}
    {else}
	   {*В группе товары пока не заданны*}
    {/if}
    {/capture}  
    
	{************* groups *************}

		{s_catalog action="selfgroup" group=$State.Current_item mmid=0}
        {if $Groups.mname}
            {if $Groups.mimage}
			     <img src="/zoom/480x355/{$Groups.mimage}" align=left/>
			{/if}
            <h2>{$Groups.mname}</h2>
            {if $Groups.mcomponents}
                {$Groups.mcomponents}
            {else}{/if}
        {else}
           <h2>{$topic}</h2>
		{/if}
		


  		
		{s_catalog action="group" group=$State.Current_item mmid=0}
		{if $Groups}

        
<div class="newprods clear">
		{section loop=$Groups name='mi'}
	<div class="item" style="width:231px; float:left; margin-right:10px;">
		<p class="title"><a href="{$Groups[mi].mid}/">{$Groups[mi].mname}</a></p>
		<p class="pic">
			<a href="{$Groups[mi].mid}/"><img width="163" src="/zoom/163x0/{$Groups[mi].mprewiev|default:'/images/root/nophoto2.jpg'}"></a>
		</p>
		</div>
		{/section}
</div>
		
		
		{/if}
    {/if}
    {$products}
{/if}



