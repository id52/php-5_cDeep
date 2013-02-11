	{foreach from=$Post item='pItem'}
    <div class="photopost">
    {if $pItem.photo}
       <a href="{$State.Current.index}{$pItem.id}.xml" class='postimg' >
           <img src='/zoom/100x100/upload/photo/{$pItem.photo}' align="left">
       </a>
	   <div class="descpost" style="margin-left:120px; ">
    {else}
		<div class="descpost">{/if}
		<h3>{$pItem.fio}</h3>
	    {$pItem.post}
	    <a href="{$State.Current.index}{$pItem.id}.xml">смотреть альбом&rarr;</a>
		</div>
    </div>
	<div style="clear:both; height: 10px;"></div>
    {/foreach}