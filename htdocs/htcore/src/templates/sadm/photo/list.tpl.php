{literal}
<style>
.up { 
	border-left: 10px solid #858585; 
	border-right: 5px solid #858585; 
}
</style>
<script language="JavaScript">
	function confirmDelete(esource, etarget)
	{
		if(confirm('Вы действительно хотите ' + esource.title + '?'))
		{
			$(etarget).fadeOut();
			sImg = new Image;
			sImg.src = esource.href;
		}
		return false;
	}
</script>
{/literal}
<div id="container">
  <div id="content" class="clearfix nosidebar">
     <div class="info">
        <h2>Галереи фотографий</h2>
      </div>
	    <div class="buttons">
	    	<a href="property[new].xml"  class="positive" target="_top"><img src="/img/icons/add.png" alt="" /> Добавить</a>
	        {*<a href="property[new].xml" target="_top"><img src="/img/icons/eye.png" alt="" /> Вкл/Выкл отмеченные</a>*}
	        {*<a href="javascript: void(0);" class="negative"><span onclick="return submitForm('rmDoc','Удалить отмеченные?');"><img src="/img/icons/delete.png" alt="" /> Удалить отмеченные</span></a> *}
			<span>{$News_manager.return}</span>
		</div><br />
        
        <div class="relatedlinks">
        <form method="POST" id="DocList">
        <input type="hidden" name="action" id="DocListAction" value="">
        {*<a><span onclick="return selectAll('item[]');">отметить все</span></a>|<a><span onclick="return deselectAll('item[]');">снять отметки</span></a>|<a><span onclick="return selectInverse('item[]');">инвертировать отмеченные</span></a>*}
        </div>
        {include file='file:sadm/pages.tpl.php'}
		<table cellspacing="0" id="popular" class="mytable">
	<thead>
		<tr class="{cycle values=",alt" name="color123"}">
	        <th width="10">&nbsp;</th>
			<th width="350">Название</th>
			<th>Описание</th> 
			<th width="50">Дата&nbsp;&darr;</th>
            <th width="18">&nbsp;</th>
            <th width="18">&nbsp;</th>
		</tr>
    </thead>			<tbody>
{if $video_manager.Parent.id}
				<tr class="{cycle values=",alt" name="color123"}" id="row0">
					<td><a href="parent[0].xml"><img src="/img/icons/folder_go.png" alt="Вложенные" width="16" height="16" /></a></td>
					<td colspan="5"><a href="parent[0].xml">Корень&nbsp;каталога</a></td>
					{*<a href="parent[0].xml" target="_top">
					<img src="/img/icons/folder_go.png" alt="Вложенные" width="16" height="16" /></a>*}
				</tr>
				{if $video_manager.Parent.Parent}
				<tr class="up {cycle values=",alt" name="color123"}" id="row{$video_manager.Parent.id}">
					<td><a href="parent[{$video_manager.Parent.Parent}].xml" ><img src="/img/icons/folder_page_white.png" alt="Вложенные" width="16" height="16" /></a></td>
					<td><a href="parent[{$video_manager.Parent.Parent}].xml" >{$video_manager.Parent.fio}</a></td>
					<td>{$video_manager.Parent.post|truncate:320}</td>
					<td nowrap="nowrap"></td>
					{*<td><a href="parent[{$video_manager.Parent.Parent}].xml" target="_top">
					<img src="/img/icons/folder_page_white.png" alt="Вложенные" width="16" height="16" /></a></td>*}
					<td></td>
				</tr>
				{/if}
{/if}				
			{foreach from=$video_manager.List item='Item' key="id"}
				<tr class="{cycle values=",alt" name="color123"}" id="row{$Item.id}">
					<td><img src="/img/icons/folder_page_white.png" title="{$Item.fio}" width="16" height="16" /></td>
					<td width=""><a href="property[{$Item.id}].xml" >{$Item.fio}</a></td>
					{*<td width=""><a href="parent[{$Item.id}].xml" >{$Item.fio}</a></td>*}
					<td>{$Item.post|truncate:320}</td>
					<td nowrap="nowrap">Дата {$Item.date}</td>
					<td><a href="property[{$Item.id}].xml" target="_top"><img src="/img/icons/page_white_edit.png" title="Редактировать" width="16" height="16" /></a></td>
					<td><a href="remove[{$Item.id}].xml" onclick="return confirmDelete(this, '#row{$Item.id}');" title="Удалить {$Item.fio}?"><img src="/img/icons/page_white_delete.png" alt="Удалить"  width="16" height="16" /></a></td>
				</tr>
			{/foreach}
			</tbody>
		</table>
        {include file='file:sadm/pages.tpl.php'}
		</form>
  </div>
</div> 
