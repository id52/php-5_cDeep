<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 14:16:59
         template file:sadm/news/item.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/news/item.tpl.php', 1, false),array('function', 'news_manager', 'file:sadm/news/item.tpl.php', 9, false),array('modifier', 'default', 'file:sadm/news/item.tpl.php', 46, false),array('modifier', 'htmlall', 'file:sadm/news/item.tpl.php', 76, false),array('modifier', 'rusdate', 'file:sadm/news/item.tpl.php', 119, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery-ui.css','type' => 'css','base' => '/css/admin/','comment' => 'Стили'), $this); echo cDeep_function_loader(array('src' => 'jquery.js, jquery-ui.js, ui.datepicker-ru.js','type' => 'js'), $this); echo cDeep_function_loader(array('src' => 'jquery.FCKEditor.js','type' => 'js','base' => '/js/','comment' => 'FCKEditor jplugin'), $this); echo cDeep_function_loader(array('src' => 'facebox.css','type' => 'css','base' => '/css/admin/','comment' => ''), $this); echo cDeep_function_loader(array('src' => 'facebox/facebox.js','type' => 'js','comment' => 'JQuery'), $this);?>


 
<?php echo cDeep_function_news_manager(array('action' => 'Edit'), $this);?>

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
    $(\'a[rel*=facebox]\').facebox();
  });
  
	function delPhoto(id)
	{
	    $(\'#pic_\'+id).fadeOut();
		$(\'#ctrl_\'+id).fadeOut();
	    
	    Img = new Image(1,1);
	    Img.src = "removeimg["+id+"].xml";
            //alert("removeimg["+id+"].xml");
            //$.get(Img.src);
            
	}  
  </script>
  '; ?>


<div id="container">
  <div id="content" class="nosidebar clearfix">
<form enctype="multipart/form-data" method="post">
    <input type="hidden"
      name="News[id]"
      value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['News']['id'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
"  />
<ul>
  <li>
   	<div class="info">
   	<h2>Новость &laquo;<?php echo $this->_tpl_vars['News']['Title']; ?>
&raquo;</h2>
	    <p>Афиша, событие</p>
    </div>
  </li>
  <li class="leftHalf">
  <ul>
  <li class="leftHalf">
  <div class="pic-preview">
	<div class="imagewrap">
	<?php if ($this->_tpl_vars['News']['Icon']): ?>
	<img src="/zoom/185x260/upload/news/<?php echo $this->_tpl_vars['News']['Icon']; ?>
" height="100%" id="pic_<?php echo $this->_tpl_vars['News']['id']; ?>
" alt="Логотип" />
	<?php else: ?>
	<img src="/img/noimage.gif" id="pic" alt="Нет лого" />
	<?php endif; ?>
	</div>
	<?php if ($this->_tpl_vars['News']['Icon']): ?>
    <span id="ctrl_<?php echo $this->_tpl_vars['News']['id']; ?>
"><a href="/upload/news/<?php echo $this->_tpl_vars['News']['Icon']; ?>
" rel="facebox"><img src="/img/icons/zoom.png" height="16" width="16" alt="нука поближе.." /></a>
    <a href="javascript:void(0);" onclick="<?php echo 'if(confirm(this.title)) { delPhoto(\'';  echo $this->_tpl_vars['News']['id'];  echo '\'); } return false;'; ?>
" title="Удалить картинку новости?"><img src="/img/icons/cross.png" height="16" width="16"  alt="ф топку!" /></a></span>
	<?php endif; ?>
  </div>   
  </li>   
  <li class="rightHalf">
  <div class="lidiv"><label class="desc">Название статьи</label>
    <input id="Field22" 
      name="News[Title]"
      class="field text full" size="" 
      value="<?php echo ((is_array($_tmp=$this->_tpl_vars['News']['Title'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
"  />
  </div>
  </li>
  <li class="rightHalf">
  <div  class="lidiv"><label class="desc">Метка</label>
    <input id="primaryTag" 
      class="field text full"
      name="News[primaryTag]" 
      type="text" maxlength="255" value="<?php echo $this->_tpl_vars['News']['primaryTag']; ?>
" />
      <label for="Tags">Короткое название</label>
  </div>
  </li><li class="rightHalf">
  <div  class="lidiv"><label class="desc">Картинка к статье</label>
    <input id="club" 
      class="field text full"
      name="News[Icon]" 
      type="file" maxlength="255" value="" /> 
      <label for="club">Логотип или презентационная картика</label>
  </div>
  </li> 
  <li class="clear">
  <div><label class="desc">Источник</label>
    <input id="club" 
      class="field text full"
      name="News[Source]" 
      type="text" maxlength="255" value="<?php echo $this->_tpl_vars['News']['Source']; ?>
" /> 
      <label for="club">Автор статьи, или ссылка на первоисточник</label>
  </div>
  </li>
  <li>
    <div><label class="desc">Теги</label>
    <input id="Tags"
      class="field text full"
      name="News[Tags]" 
      type="text" maxlength="255" value="<?php echo $this->_tpl_vars['News']['Tags']; ?>
" />
      <label for="Tags">Ключевые слова</label>
  </div>
  </li>
  <li>
  <div  class="left half"><label class="desc">Дата</label>
    <input id="DateCreated" 
      class="field text medium datepicker"
      name="News[Date]" 
      type="text" maxlength="255" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['News']['Date'])) ? $this->_run_mod_handler('rusdate', true, $_tmp, 'sqlnow') : cDeep_modifier_rusdate($_tmp, 'sqlnow')); ?>
" /> 
  </div>
  <div  class="right half"><label class="desc">Видимость</label>
			<input id="enabled" 
			name="News[enabled]" 
	   		class="field checkbox" type="checkbox"
            <?php if ($this->_tpl_vars['News']['enabled']): ?>checked="checked"<?php endif; ?>            
		    value="1" />
			<label class="choice" for="enabled">Включена</label>
  </div>
  
  
  </li>   
     <li>
     <label class="desc">Короткое описание</label>
  <div>
    <textarea name="News[Description]" id="Description" rows="19" class="field textarea full"><?php echo $this->_tpl_vars['News']['Description']; ?>
</textarea>
  </div>
  
  
  
  <?php echo '
<script>
    $(\'#Description\').fck({Height:295, ToolbarSet:\'Basic\'});
</script>
'; ?>

  </li>
  </ul>
</li>

<li class="rightHalf">
  <label class="desc">Развернутое описание</label>
  <div>
    <textarea name="News[Content]" id="text" rows="45" class="getfck field textarea full"><?php echo $this->_tpl_vars['News']['Content']; ?>
</textarea>
  </div>
</li>

<li class="rightHalf">
  <label class="desc">Описание (description meta)</label>
  <div>
    <input name="News[descriptionmeta]" id="text" rows="2" class="" value="<?php echo $this->_tpl_vars['News']['descriptionmeta']; ?>
"></input>
  </div>
</li>

<li class="rightHalf">
  <label class="desc">Ключевые слова (keywordsmeta)</label>
  <div>
    <input name="News[keywordsmeta]" id="text" rows="2" class="" value="<?php echo $this->_tpl_vars['News']['keywordsmeta']; ?>
"></input>
  </div>
</li>











<li class="buttons">
	<button type="submit" class="positive "><img src="/img/icons/tick.png" alt="" /> Сохранить</button> 
</li>
</ul>
</form>

<hr/>



</div>

</div></div>