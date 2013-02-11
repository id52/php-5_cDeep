{loader src='facebox.css,gallery.css' type='css' base='/css/admin/' comment=''}
{loader src='facebox/facebox.js' type='js' comment='JQuery'}

<script>
{literal}
function cdelete(u,t,i)
{
  if(confirm('Вы действительно желаете '+t+' ?'))
  {
  	$("#f"+i).fadeOut();
	
	Img = new Image(1,1);
    Img.src = u;
	// при удалении надо бы еще обновлять список каталога и перекидывать на папку родитель (открытую) удялемого объекта
  	//$("#catinfo").loadJFrame(u);
  }
}
$(document).ready(function() {
    $('a[rel*=facebox]').facebox()
});
{/literal}
</script>

<div>
<a href='/sadm/catalog/importer/'>Импорт</a>
<a href='/sadm/catalog/sorting/'>Сортировка</a>
</div>




{if $State.Current_item}
	{if $Item.is_group}
            <div class="buttons">
                <a href="/sadm/catalog/tree/main[].xml" rel="facebox" >
                <img src="/img/icons/news.png" alt="" /> 
                Список товаров на главной
                </a>
            	<a href="/sadm/catalog/add[{$Item.mid|default:0}].xml" class="positive" ><img src="/img/icons/add.png" alt="" /> Добавить позицию в ({$Item.mid|catalog|default:"корень каталога"})</a>
            	<a href="/sadm/catalog/add[{$Item.mid|default:0}].xml?is_group=1" class="positive" ><img src="/img/icons/add.png" alt="" /> Добавить подгруппу в ({$Item.mid|catalog|default:"корень каталога"})</a>
                <a href="javascript: void(0);" class="negative" ><span onclick="return cdelete('/sadm/catalog/remove[{$Item.mid}].xml', this.title, {$Item.mid});" title='Удалить {$Item.mname|htmlall}'><img src="/img/icons/delete.png" alt="" /> Удалить эту группу ({$Item.mid|catalog})</span></a> 
    		</div>
	{include file="file:sadm/catalog/item/group.tpl.php"}
	{elseif !$Item.is_group}
            <div class="buttons">
                <a href="/sadm/catalog/tree/main[].xml" rel="facebox" >
                <img src="/img/icons/news.png" alt="" /> 
                Список товаров на главной
                </a>
            	<a href="/sadm/catalog/add[{$Item.mgid|default:0}].xml"  class="positive" ><img src="/img/icons/add.png" alt="" /> Добавить позицию в ({$Item.mgid|catalog|default:"корень каталога"})</a>
                <a href="javascript: void(0);" class="negative"><span onclick="return cdelete('/sadm/catalog/remove[{$Item.mid}].xml', this.title, {$Item.mid});" title='Удалить {$Item.mname}'><img src="/img/icons/delete.png" alt="" /> Удалить эту позицию ({$Item.mid|catalog})</span></a> 
    		</div>		
		{include file="file:sadm/catalog/item/item.tpl.php"}
	{/if}
{else}
        <div class="buttons">
            <a href="/sadm/catalog/tree/main[].xml" rel="facebox" >
            <img src="/img/icons/news.png" alt="" /> 
            Список товаров на главной
            </a>
	       	<a href="/sadm/catalog/add[0].xml?is_group=1" class="positive" >
			<img src="/img/icons/add.png" alt="" /> 
			Добавить подгруппу в корень каталога
			</a>
	    </div>
		
    	<!--iframe src="/tools/price.php" width="400" height="300" frameborder="1" allowtransparency="0" scrolling="no"></iframe-->
		<!--iframe src="/sadm/catalog/importer/uploadprice" width="400" height="300" frameborder="1" allowtransparency="1" scrolling="no"></iframe-->
{/if}

<div id="catinfo"></div>