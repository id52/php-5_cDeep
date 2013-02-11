<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:18
         template file:sadm/news/list.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'file:sadm/news/list.tpl.php', 74, false),)), $this); ?><script language="JavaScript">
<?php echo '
	function confirmDelete(esource, etarget)
	{
		if(confirm(\'Вы действительно хотите \' + esource.title + \'?\'))
		{
			$(etarget).fadeOut();
			sImg = new Image;
			sImg.src = esource.href;
		}
		return false;
	}

	function submitForm(act, conf)
        {
	    if(confirm(\'Вы действительно желаете \'+conf))
	    {
                //alert(document.getElementsByName(\'item[]\'));
	        checkboxes = document.getElementsByName(\'item[]\');
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

   

 
	
'; ?>

</script>


<img src="bla" id="test">
<div id="container">
  <div id="content" class="clearfix nosidebar">
     <div class="info">
        <h2>Новости</h2>
      </div>
	    <div class="buttons">
	    	<a href="property[new].xml"  class="positive" target="_top"><img src="/img/icons/add.png" alt="" /> Добавить</a>
	        	        <a href="javascript: void(0);" class="negative"><span onclick="return submitForm('rmDoc','Удалить отмеченные?');"><img src="/img/icons/delete.png" alt="" /> Удалить отмеченные</span></a>
                
			<span><?php echo $this->_tpl_vars['News_manager']['return']; ?>
</span>
		</div><br />
        
        <div class="relatedlinks">
        <form method="POST" id="DocList">
        <input type="hidden" name="action" id="DocListAction" value="">
        <a><span onclick="return selectAll('item[]');">отметить все</span></a>|<a><span onclick="return deselectAll('item[]');">снять отметки</span></a>|<a><span onclick="return selectInverse('item[]');">инвертировать отмеченные</span></a></div>
        <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:sadm/pages.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
		<table cellspacing="0" id="popular" class="mytable">
	<thead>
		<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
">
	        <th>&nbsp;</th>
			<th width="100%">Название</th>
			<th>Автор</th> 
			<th>Дата&nbsp;&darr;</th>
            <th>&nbsp;</th><th>&nbsp;</th>
		</tr>
    </thead>			<tbody>
			<?php $_from = $this->_tpl_vars['Newss']['List']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['News']):
?>
				<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
" id="row<?php echo $this->_tpl_vars['News']['id']; ?>
">
					<td><input name="item[]" type="checkbox" value="<?php echo $this->_tpl_vars['News']['id']; ?>
" /></td>
					<td width="100%"><a href="property[<?php echo $this->_tpl_vars['News']['id']; ?>
].xml" ><?php echo $this->_tpl_vars['News']['Title']; ?>
</a></td>
					<td  nowrap="nowrap">Автор <?php echo $this->_tpl_vars['News']['Source']; ?>
</td>
					<td nowrap="nowrap">Дата <?php echo $this->_tpl_vars['News']['Date']; ?>
</td>
					<td><a href="property[<?php echo $this->_tpl_vars['News']['id']; ?>
].xml" target="_top"><img src="/img/icons/page_white_edit.png" alt="Редактировать" width="16" height="16" /></a></td>
					<td><a href="remove[<?php echo $this->_tpl_vars['News']['id']; ?>
].xml" onclick="return confirmDelete(this, '#row<?php echo $this->_tpl_vars['News']['id']; ?>
');" title="Удалить <?php echo $this->_tpl_vars['News']['Title']; ?>
?"><img src="/img/icons/page_white_delete.png" alt="Удалить"  width="16" height="16" /></a></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>
		</form>
  </div>
</div> 