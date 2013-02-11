<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:43:10
         template file:sadm/photo/item.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/photo/item.tpl.php', 1, false),array('modifier', 'default', 'file:sadm/photo/item.tpl.php', 33, false),array('modifier', 'rusdate', 'file:sadm/photo/item.tpl.php', 75, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery-ui.css','type' => 'css','base' => '/css/admin/','comment' => 'Стили'), $this); echo cDeep_function_loader(array('src' => 'jquery-ui.js, ui.datepicker-ru.js','type' => 'js','base' => '/js/','comment' => 'UI'), $this); echo cDeep_function_loader(array('src' => 'jquery.FCKEditor.js','type' => 'js','base' => '/js/','comment' => 'FCKEditor jplugin'), $this); echo cDeep_function_loader(array('src' => 'facebox.css,gallery.css','type' => 'css','base' => '/css/admin/','comment' => ''), $this); echo cDeep_function_loader(array('src' => 'facebox/facebox.js','type' => 'js','comment' => 'JQuery'), $this);?>



  <?php echo '
  <script>
  $(document).ready(function(){
  	$(\'#DateCreated\').datepicker(
  		$.extend({},
  		$.datepicker.regional["ru"],
  		{ 
  			showStatus: true,
  			showOn: "both",
			dateFormat:"yy-mm-dd",
  			buttonImage: "/img/icons/calendar.png",
  			buttonImageOnly: true
  		}
  	));
  }); 
  </script>
  '; ?>


<div id="container">
  <div id="content" class="nosidebar clearfix">
<form enctype="multipart/form-data" method="post">
    <input type="hidden"
      name="Item[id]"
      value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['video_manager']['List']['id'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
"  />
<ul class="half left">
  <li>
   	<div class="info">
   	<h2>Галерея &laquo;<?php echo $this->_tpl_vars['video_manager']['List']['fio']; ?>
&raquo;</h2>
	<p>Объект описывающий галерею должен быть сохранен чтобы в него можно было закачать фотографии</p>
    </div>
  </li>
  
  <li>
  <div><label class="desc">Название</label>
    <input id="Field22" 
      name="Item[fio]"
      class="field text full" size="" 
      value="<?php echo $this->_tpl_vars['video_manager']['List']['fio']; ?>
"  />
  </div>
  </li>
  <li>
  <span class="left half"><label class="desc">Основная фотография</label>
    <input id="club" 
      class="field text full"
      name="Item[photo]" 
      type="file" maxlength="255" value="" /> 
      <label for="club">Фото или презентационная картика</label>
  </span>
    </li>
  <li>
  <div class="left half"><label class="desc">Дата</label>
    <input id="DateCreated" 
      class="field text medium datepicker"
      name="Item[date]" 
      type="text" maxlength="255" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['video_manager']['List']['date'])) ? $this->_run_mod_handler('rusdate', true, $_tmp, 'sqlnow') : cDeep_modifier_rusdate($_tmp, 'sqlnow')); ?>
" /> 
  </div>
  <div  class="right half"><label class="desc">Видимость</label>
			<input id="enabled" 
			name="Item[enabled]" 
	   		class="field checkbox" type="checkbox"
            <?php if ($this->_tpl_vars['video_manager']['List']['enabled']): ?>checked="checked"<?php endif; ?>            
		    value="1" />
			<label class="choice" for="enabled">Включена</label>
  </div>
  </li>
  <li>  
  <div  class="lidiv"><label class="desc">Описание</label>
    <textarea id="primaryTag" 
      class="getfck field textarea full"
      name="Item[post]" rows="20"><?php echo $this->_tpl_vars['video_manager']['List']['post']; ?>
</textarea>
      <label for="Tags">Небольшой текст описывающий галерею</label>
  </div>
  
  
    <div  class="lidiv"><label class="desc">Описание (descriptionmeta)</label>
    <input id="primaryTag" 
      name="Item[descriptionmeta]" value="<?php echo $this->_tpl_vars['video_manager']['List']['descriptionmeta']; ?>
"></input>
      <label for="Tags"></label>
  </div>
  
    <div  class="lidiv"><label class="desc">Ключевые слова (keywordsmeta)</label>
    <input id="primaryTag" 
      name="Item[keywordsmeta]" value="<?php echo $this->_tpl_vars['video_manager']['List']['keywordsmeta']; ?>
"></input>
      <label for="Tags"></label>
  </div>
  

  </li>
  
<li class="buttons">
	<button type="submit" class="positive "><img src="/img/icons/tick.png" alt="Сохранить" /> Сохранить</button> 
</li>
</ul>



<ul class="half right">
  <li class="leftHalf">

  <div class="pic-preview">
	<div class="imagewrap">
	<?php if ($this->_tpl_vars['video_manager']['List']['photo']): ?>
  
	<img src="/zoom/175x175/upload/photo/<?php echo $this->_tpl_vars['video_manager']['List']['photo']; ?>
" id="pic" alt="Фотокарточка"/>
	<?php else: ?>
	<img src="/img/noimage.gif" id="pic" alt="Нет фото" />
	<?php endif; ?>
	</div> 
  

  
  
    <span></span>
  </div> 
  

    
  </li>
  <li class="rightHalf">
  
<div>
<label class="desc">Удалить фотографию</label>  
  <input	name="Item[deletePhoto]"  type="checkbox"   value="1" >
</div>

  <div>
  <?php if ($this->_tpl_vars['video_manager']['List']['id']): ?>
  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/photo/upload.tpl.php", 'cDeep_include_vars' => array('faction' => 'uploadphoto','id' => $this->_tpl_vars['video_manager']['List']['id'])));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
  <?php else: ?>
  Станет доступно после сохранения
  <?php endif; ?>
  </div>
  </li> 
  <li class="left full"><label class="desc">Фотографии альбома</label>
  <div class="UploadedList" src1='files/files[<?php echo $this->_tpl_vars['video_manager']['List']['id']; ?>
].xml'>
  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/photo/files.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
  </div>
  </li>
</ul>
</form>
<hr/>
</div>
</div>

<?php echo '
<SCRIPT type=text/javascript>
$(document).ready(function() {
    $(\'a[rel*=facebox]\').facebox()
});
</SCRIPT>
'; ?>
