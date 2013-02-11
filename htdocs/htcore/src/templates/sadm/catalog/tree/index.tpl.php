{a_catalog action='List' item=$State.Current_item }

{if $Items.Main}
<div style="padding:1.5em 1em .5em 1.5em;">
<ul class="menu">
{foreach from=$Items.List key='p' item='Item'}
        <li >
            {if $Item.is_group}
                <img src="/img/icons/folder.png" class="delete" />
            {else}
                <img src="/img/icons/page_gear.png" class="delete"/>
            {/if}
            <a class="name" href="/sadm/catalog/property[{$Item.mid}].xml" target="_top">{$Item.mname}</a>
        </li>
{/foreach}
</ul>
</div>
{else}
<script>
{literal}

$(".menu").ulDnD({
    onDragClass: "DragClass",
    onDrop: function(table, row) {
            Img = new Image(1,1);
            Img.src = '/sadm/catalog/tree/sort[{/literal}{$Items.UP.mid|default:0}{literal}].xml?a&'+$.ulDnD.serialize();
        }
});

function listdelete(u,t)
{
  if(confirm('Вы действительно желаете '+t+' ?'))
  {
    $('.Itemmid'+u).fadeOut();
    
    Img = new Image(1,1);
    Img.src = "/sadm/catalog/tree/remove["+u+"].xml";
  }
}
{/literal}
</script>

<style>
{literal}
.DragClass { background-color: #fff0f0; }
{/literal}
</style>


<ul class="menu">
        {if $Items.UP}
        <li class="nodrag nodrop">
            <a href="/sadm/catalog/tree/list[{$Items.UP.parent}].xml?current={$Items.Current}" title='Выше, к {$Items.UP.Title}'>
                <img src="/img/icons/folder_go.png" />
            </a>
            <a class="name" href="/sadm/catalog/property[{$Items.UP.mid}].xml" target="_top">
			<img src="/img/icons/page_gear.png" />← {if $Items.Current == $Items.UP.mid} <strong>{$Items.UP.Title}</strong>{else}{$Items.UP.Title}{/if}</a>
        </li>
		{/if}
{foreach from=$Items.List key='p' item='Item'}
        <li id="sort[]={$Item.mid}" class="Itemmid{$Item.mid}">
            		
          {if $Item.is_group}
            <a class="delete" href="/sadm/catalog/tree/list[{$Item.mid}].xml?current={$Items.Current}" title='Внутрь'>
                <img src="/img/icons/folder.png" />
            </a>
            {else}
            <a class="delete" href="javascript: void(0);" target="_top" onclick="return listdelete({$Item.mid}, '{$Item.Title|htmlall}')" title='Удалить'>
                <img src="/img/icons/cross.png" />
            </a>
            {/if}
            <a class="name" href="/sadm/catalog/property[{$Item.mid}].xml" target="_top"><img src="/img/icons/page_gear.png" />{if $Items.Current == $Item.mid}<strong>{$Item.mname}</strong>{else}{$Item.mname}{/if}</a>
        </li>
{/foreach}
</ul>
{/if}