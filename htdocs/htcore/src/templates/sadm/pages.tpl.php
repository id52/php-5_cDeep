{if $Pages.count > 1}
<div class="pagination-clean"> 
<ul> 
{if $Pages.prev}<li class="pages_previous"><a href="?p={$Pages.prev}">←&nbsp;Назад</a></li>{else}<li class="pages_previous-off">←&nbsp;Назад</li>{/if}
{section loop=$Pages.count name='Page'}
{if $cDeep.section.Page.iteration == $Pages.current}<li class="pages_active">{$cDeep.section.Page.iteration}</li>{else}<li><a href="?p={$cDeep.section.Page.iteration}">{$cDeep.section.Page.iteration}</a></li>{/if}
{/section}
{if $Pages.next}<li class="pages_next"><a href="?p={$Pages.next}">Вперед&nbsp;→</a></li>{else}<li class="pages_next-off">Вперед&nbsp;→</li>{/if}
</ul>
</div>
{/if}
<!--PAGES-->