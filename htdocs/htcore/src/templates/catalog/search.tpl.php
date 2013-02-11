{loader src='jquery.format.1.02.js, notify.js' type='js' base='/js/}
{loader src='catalog.css, gallery.css, tables.css, notify.css' type='css' base='/css/'}
{include file='file:catalog/jscripts.tpl.php'}
<div>
{if $search}
  По запросу <strong>{$search}</strong> {if $Count}{if ($Count % 2 == 0) || ($Count < 10 && $Count !== 1)}найдено {$Count} записей{else}найдена {$Count} запись{/if}{else}ничего не найдено. Попробуйте использовать синонимы или расширьте запрос.{/if}.
{else}
 Поиск производится по запросам от и более 3-х символов.
{/if}
</div><br>
{if $Items}
{include file="file:paging.tpl.php"}
<div class="prods_small">
        {section loop=$Items name='mi'}    

	<div class="item clear">
					<div class="pic">
						<a href="item[{$Items[mi].mid}].xml"><img width="54" height="54" alt="prod_small" src="/zoom3/54x54/ffffff/{$Items[mi].mprewiev|default:'/images/nophoto.gif'}"></a>
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
{/if}