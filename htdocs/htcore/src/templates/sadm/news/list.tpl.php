<script language="JavaScript">
{literal}
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

	function submitForm(act, conf)
        {
	    if(confirm('Вы действительно желаете '+conf))
	    {
                //alert(document.getElementsByName('item[]'));
	        checkboxes = document.getElementsByName('item[]');
	        Img = new Image(1,1);
                var imgs=[];
	        for(i=0;i<checkboxes.length;i++)
	        {
                      if (checkboxes[i].checked)
                      {                        
                        Img.src = "remove["+checkboxes[i].value+"].xml";
                        imgs.push("remove["+checkboxes[i].value+"].xml");
                        $("#row"+checkboxes[i].value).fadeOut();
                      }
                    
	        };
                
                for(var p=0; p<imgs.length;p++)
                {                      
                       //alert(Img.src);
                       Img.src=imgs[p];
                       $.get(Img.src);
                                       
                }

               
            }
    }

   

 
	
{/literal}
</script>


<img src="bla" id="test">
<div id="container">
  <div id="content" class="clearfix nosidebar">
     <div class="info">
        <h2>Новости</h2>
      </div>
	    <div class="buttons">
	    	<a href="property[new].xml"  class="positive" target="_top"><img src="/img/icons/add.png" alt="" /> Добавить</a>
	        {*<a href="property[new].xml" target="_top"><img src="/img/icons/eye.png" alt="" /> Вкл/Выкл отмеченные</a>*}
	        <a href="javascript: void(0);" class="negative"><span onclick="return submitForm('rmDoc','Удалить отмеченные?');"><img src="/img/icons/delete.png" alt="" /> Удалить отмеченные</span></a>
                
			<span>{$News_manager.return}</span>
		</div><br />
        
        <div class="relatedlinks">
        <form method="POST" id="DocList">
        <input type="hidden" name="action" id="DocListAction" value="">
        <a><span onclick="return selectAll('item[]');">отметить все</span></a>|<a><span onclick="return deselectAll('item[]');">снять отметки</span></a>|<a><span onclick="return selectInverse('item[]');">инвертировать отмеченные</span></a></div>
        {include file='file:sadm/pages.tpl.php'}
		<table cellspacing="0" id="popular" class="mytable">
	<thead>
		<tr class="{cycle values=",alt" name="color123"}">
	        <th>&nbsp;</th>
			<th width="100%">Название</th>
			<th>Автор</th> 
			<th>Дата&nbsp;&darr;</th>
            <th>&nbsp;</th><th>&nbsp;</th>
		</tr>
    </thead>			<tbody>
			{foreach from=$Newss.List item='News' key="id"}
				<tr class="{cycle values=",alt" name="color123"}" id="row{$News.id}">
					<td><input name="item[]" type="checkbox" value="{$News.id}" /></td>
					<td width="100%"><a href="property[{$News.id}].xml" >{$News.Title}</a></td>
					<td  nowrap="nowrap">Автор {$News.Source}</td>
					<td nowrap="nowrap">Дата {$News.Date}</td>
					<td><a href="property[{$News.id}].xml" target="_top"><img src="/img/icons/page_white_edit.png" alt="Редактировать" width="16" height="16" /></a></td>
					<td><a href="remove[{$News.id}].xml" onclick="return confirmDelete(this, '#row{$News.id}');" title="Удалить {$News.Title}?"><img src="/img/icons/page_white_delete.png" alt="Удалить"  width="16" height="16" /></a></td>
				</tr>
			{/foreach}
			</tbody>
		</table>
		</form>
  </div>
</div> 
