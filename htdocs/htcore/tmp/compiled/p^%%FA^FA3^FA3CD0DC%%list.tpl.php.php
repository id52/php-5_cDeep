<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 14:08:22
         template file:sadm/photo/list.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'file:sadm/photo/list.tpl.php', 41, false),array('modifier', 'truncate', 'file:sadm/photo/list.tpl.php', 61, false),)), $this); ?><?php echo '
<style>
.up { 
	border-left: 10px solid #858585; 
	border-right: 5px solid #858585; 
}
</style>
<script language="JavaScript">
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
</script>
'; ?>

<div id="container">
  <div id="content" class="clearfix nosidebar">
     <div class="info">
        <h2>Галереи фотографий</h2>
      </div>
	    <div class="buttons">
	    	<a href="property[new].xml"  class="positive" target="_top"><img src="/img/icons/add.png" alt="" /> Добавить</a>
	        	        			<span><?php echo $this->_tpl_vars['News_manager']['return']; ?>
</span>
		</div><br />
        
        <div class="relatedlinks">
        <form method="POST" id="DocList">
        <input type="hidden" name="action" id="DocListAction" value="">
                </div>
        <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:sadm/pages.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
		<table cellspacing="0" id="popular" class="mytable">
	<thead>
		<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
">
	        <th width="10">&nbsp;</th>
			<th width="350">Название</th>
			<th>Описание</th> 
			<th width="50">Дата&nbsp;&darr;</th>
            <th width="18">&nbsp;</th>
            <th width="18">&nbsp;</th>
		</tr>
    </thead>			<tbody>
<?php if ($this->_tpl_vars['video_manager']['Parent']['id']): ?>
				<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
" id="row0">
					<td><a href="parent[0].xml"><img src="/img/icons/folder_go.png" alt="Вложенные" width="16" height="16" /></a></td>
					<td colspan="5"><a href="parent[0].xml">Корень&nbsp;каталога</a></td>
									</tr>
				<?php if ($this->_tpl_vars['video_manager']['Parent']['Parent']): ?>
				<tr class="up <?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
" id="row<?php echo $this->_tpl_vars['video_manager']['Parent']['id']; ?>
">
					<td><a href="parent[<?php echo $this->_tpl_vars['video_manager']['Parent']['Parent']; ?>
].xml" ><img src="/img/icons/folder_page_white.png" alt="Вложенные" width="16" height="16" /></a></td>
					<td><a href="parent[<?php echo $this->_tpl_vars['video_manager']['Parent']['Parent']; ?>
].xml" ><?php echo $this->_tpl_vars['video_manager']['Parent']['fio']; ?>
</a></td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['video_manager']['Parent']['post'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 320) : cDeep_modifier_truncate($_tmp, 320)); ?>
</td>
					<td nowrap="nowrap"></td>
										<td></td>
				</tr>
				<?php endif;  endif; ?>				
			<?php $_from = $this->_tpl_vars['video_manager']['List']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['Item']):
?>
				<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
" id="row<?php echo $this->_tpl_vars['Item']['id']; ?>
">
					<td><img src="/img/icons/folder_page_white.png" title="<?php echo $this->_tpl_vars['Item']['fio']; ?>
" width="16" height="16" /></td>
					<td width=""><a href="property[<?php echo $this->_tpl_vars['Item']['id']; ?>
].xml" ><?php echo $this->_tpl_vars['Item']['fio']; ?>
</a></td>
										<td><?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['post'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 320) : cDeep_modifier_truncate($_tmp, 320)); ?>
</td>
					<td nowrap="nowrap">Дата <?php echo $this->_tpl_vars['Item']['date']; ?>
</td>
					<td><a href="property[<?php echo $this->_tpl_vars['Item']['id']; ?>
].xml" target="_top"><img src="/img/icons/page_white_edit.png" title="Редактировать" width="16" height="16" /></a></td>
					<td><a href="remove[<?php echo $this->_tpl_vars['Item']['id']; ?>
].xml" onclick="return confirmDelete(this, '#row<?php echo $this->_tpl_vars['Item']['id']; ?>
');" title="Удалить <?php echo $this->_tpl_vars['Item']['fio']; ?>
?"><img src="/img/icons/page_white_delete.png" alt="Удалить"  width="16" height="16" /></a></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>
        <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => 'file:sadm/pages.tpl.php', 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
		</form>
  </div>
</div> 