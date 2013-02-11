{if $Page.count>1}    

    <div class="pagination-clean">
            <ul>
                  {if $Page.last}
                  <li class="previous"><a href="{$link}?p={$Page.last}{$slink}">&laquo;&nbsp;Назад</a></li>
                  {else}
                  <li class="previous-off">&laquo;&nbsp;Назад</li>
                  {/if}
                  {section name="p" loop=$Page.count}
                    {if $cDeep.section.p.iteration==$Page.current}
                    <li class="active">{$cDeep.section.p.iteration}</li>
                    {else}
                    <li><a href="{$link}?p={$cDeep.section.p.iteration}{$slink}">{$cDeep.section.p.iteration}</a></li>
                    {/if}
                  {/section}
                  {if $Page.next}
                  <li class="next"><a href="{$link}?p={$Page.next}{$slink}">Далее&nbsp;&raquo;</a></li>
                  {else}
                  <li class="next-off">Далее&nbsp;&raquo;</li>
                  {/if}
            </ul>
      </div>
{/if}