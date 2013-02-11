{loader src='jquery.js, jquery.FCKEditor.js' type='js' base='/js/' comment='FCKEditor jplugin'}
{*loader src='ckeditor.js, /adapters/jquery.js' type='js' base='/tools/ckeditor/' comment='CKEditor jplugin'*}

{pages_manager action='Edit'}

<div id="secondary">
    <div id="sidebar_content" class="clearfix">
    <h1>Страницы {if $Page.readonly==0 && $Page.writable==1}<a href="add[{$Page.node}].xml"><img src="/img/icons/add.png" /> добавить</a>{/if}</h1>
    <div src="tree/list[{$Page.parent}].xml"></div>
    </div>
</div>

<hr/>

<div id="container">
  <div id="content" class="clearfix">

<div id="cardconteiner">
{$pages_manager.return.Status}
  <div id="headercard">
  {if $pages_manager.do=='ADD'}
    <h1>Новая страница</h1>
  {elseif $Page.node}
    <h1><strong>{$Page.Title}</strong> {if $Page.readonly==1} [системная страница. ограниченый доступ]{elseif $Page.writable!=1}[нет доступа для записи]{/if}</h1>
  {else}
    <h1>Помощь</h1>
  {/if}
  </div>  
{if $Page.node || $pages_manager.do=='ADD'}
<form enctype="multipart/form-data" method="post" action=""{if $Page.writable!=1} onsubmit="return false;"{/if}>
<input type="hidden" name="Page[node]" value="{$Page.node}">
<input type="hidden" name="Page[parent]" value="{$Page.parent}">
<input type="hidden" name="Page[readonly]" value="{$Page.readonly}">

   {include file='file:sadm/pages/item.tpl.php'}

</form>
{else}
{/if}
</div>
    </div>
</div>