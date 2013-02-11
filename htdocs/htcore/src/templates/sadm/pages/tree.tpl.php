{pages_manager action='List'}
<style>
{literal}
.DragClass { background-color: #fff0f0; }
{/literal}
</style>
<script>
{literal}
$("#treemenu").ulDnD({
    onDragClass: "DragClass",
    onDrop: function(table, row) {
            Img = new Image(1,1);
            Img.src = '/backend.xml?faction=SortMenu&'+$.ulDnD.serialize();
        }
});

function removePage(Node, Title)
{
  if(confirm('Удалить безвозвратно страницу "'+Title+'" ?'))
  {
        Img = new Image(1,1);
        Img.src = 'remove['+Node+'].xml';
    $('.PageNode'+Node).fadeOut();
  }
}
{/literal}
</script>
<ul class="menu" id="treemenu">
        <li class="nodrag nodrop">
        {if $Pages.UP}
            <a href="tree/list[{$Pages.UP.parent}].xml" title='Выше, к {$Pages.UP.Title}'>
                <img src="/img/icons/folder_go.png" />
            </a>
            <a class="delete" href="add[{$Pages.UP.node}].xml" target="_top" title='Добавить подстраницу в {$Pages.UP.Title|htmlall}'>
                <img src="/img/icons/page_add.png" />
            </a>            
            <a class="name" href="tree/list[{$Pages.UP.parent}].xml" title='Выше, к {$Pages.UP.Title|htmlall}'>&larr; {$Pages.UP.Title}</a>
        {/if}
        </li>
{foreach from=$Pages.List key='p' item='Page'}
        <li id="sort[]={$Page.node}" class="PageNode{$Page.node}">
          {if $Page.subnodes}
            <a class="delete" href="tree/list[{$Page.node}].xml" title='Внутрь'>
                <img src="/img/icons/folder.png" />
            </a>
            {else}
            <a class="delete" href="javascript: void(0);" target="_top" onclick="return removePage({$Page.node}, '{$Page.Title|htmlall}')" title='Удалить'>
                <img src="/img/icons/cross.png" />
            </a>
            {/if}
            <a class="delete" href="add[{$Page.node}].xml" target="_top" title='Добавить подстраницу'>
                <img src="/img/icons/page_add.png" />
            </a>
            <a class="name" href="property[{$Page.node}].xml" target="_top"><img src="/img/icons/page_gear.png" />{$Page.Title}</a>
        </li>
{/foreach}
</ul>
