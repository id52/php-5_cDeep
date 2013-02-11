{loader src='jquery-ui.css' type='css' base='/css/admin/' comment='Стили'}
{loader src='jquery-ui.js, ui.datepicker-ru.js' type='js' base='/js/' comment='UI'}

{loader src='jquery.FCKEditor.js' type='js' base='/js/' comment='FCKEditor jplugin'}

{loader src='facebox.css,gallery.css' type='css' base='/css/admin/' comment=''}
{loader src='facebox/facebox.js' type='js' comment='JQuery'}


  {literal}
  <script>
  $(document).ready(function(){
  	$('#DateCreated').datepicker(
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
  {/literal}

<div id="container">
  <div id="content" class="nosidebar clearfix">
<form enctype="multipart/form-data" method="post">
    <input type="hidden"
      name="Item[id]"
      value="{$video_manager.List.id|default:0}"  />
<ul class="half left">
  <li>
   	<div class="info">
   	<h2>Галерея &laquo;{$video_manager.List.fio}&raquo;</h2>
	<p>Объект описывающий галерею должен быть сохранен чтобы в него можно было закачать фотографии</p>
    </div>
  </li>
  
  <li>
  <div><label class="desc">Название</label>
    <input id="Field22" 
      name="Item[fio]"
      class="field text full" size="" 
      value="{$video_manager.List.fio}"  />
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
  {*<span class="right half"><label class="desc">Родительская галерея</label>
    <select id="Parent" 
      class="field text full"
      name="Item[Parent]">
    <option value="0">Корень каталога</option>
    {foreach from=$video_manager.List.Parents item='Parent'}
    <option value="{$Parent.id}"{if $Parent.selected} selected{/if}>{$Parent.fio}</option>
    {/foreach}
    </select>
      <label for="Parent">выберите галерею</label>
  </span>*}
  </li>
  <li>
  <div class="left half"><label class="desc">Дата</label>
    <input id="DateCreated" 
      class="field text medium datepicker"
      name="Item[date]" 
      type="text" maxlength="255" value="{$video_manager.List.date|rusdate:'sqlnow'}" /> 
  </div>
  <div  class="right half"><label class="desc">Видимость</label>
			<input id="enabled" 
			name="Item[enabled]" 
	   		class="field checkbox" type="checkbox"
            {if $video_manager.List.enabled}checked="checked"{/if}            
		    value="1" />
			<label class="choice" for="enabled">Включена</label>
  </div>
  </li>
  <li>  
  <div  class="lidiv"><label class="desc">Описание</label>
    <textarea id="primaryTag" 
      class="getfck field textarea full"
      name="Item[post]" rows="20">{$video_manager.List.post}</textarea>
      <label for="Tags">Небольшой текст описывающий галерею</label>
  </div>
  
  
    <div  class="lidiv"><label class="desc">Описание (descriptionmeta)</label>
    <input id="primaryTag" 
      name="Item[descriptionmeta]" value="{$video_manager.List.descriptionmeta}"></input>
      <label for="Tags"></label>
  </div>
  
    <div  class="lidiv"><label class="desc">Ключевые слова (keywordsmeta)</label>
    <input id="primaryTag" 
      name="Item[keywordsmeta]" value="{$video_manager.List.keywordsmeta}"></input>
      <label for="Tags"></label>
  </div>
  

  </li>
  {*
  <li class="clear">
  <div><label class="desc">Источник</label>
    <input id="club" 
      class="field text full"
      name="Item[Source]" 
      type="text" maxlength="255" value="{$video_manager.List.Source}" /> 
      <label for="club">Автор статьи, или ссылка на первоисточник</label>
  </div>
  </li>
  <li>
    <div><label class="desc">Теги</label>
    <input id="Tags"
      class="field text full"
      name="Item[Tags]" 
      type="text" maxlength="255" value="{$video_manager.List.Tags}" />
      <label for="Tags">Ключевые слова</label>
  </div>
  </li>
  *}

<li class="buttons">
	<button type="submit" class="positive "><img src="/img/icons/tick.png" alt="Сохранить" /> Сохранить</button> 
</li>
</ul>



<ul class="half right">
  <li class="leftHalf">

  <div class="pic-preview">
	<div class="imagewrap">
	{if $video_manager.List.photo}
  
	<img src="/zoom/175x175/upload/photo/{$video_manager.List.photo}" id="pic" alt="Фотокарточка"/>
	{else}
	<img src="/img/noimage.gif" id="pic" alt="Нет фото" />
	{/if}
	</div> 
  

  
  
    <span>{*<a href="#"><img src="/img/icons/zoom.png" height="16" width="16" alt="нука поближе.." /></a>
    <a href="#"><img src="/img/icons/cross.png" height="16" width="16"  alt="ф топку!" /></a>*}</span>
  </div> 
  

    
  </li>
  <li class="rightHalf">
  
<div>
<label class="desc">Удалить фотографию</label>  
  <input	name="Item[deletePhoto]"  type="checkbox"   value="1" >
</div>

  <div>
  {if $video_manager.List.id}
  {include file="file:sadm/photo/upload.tpl.php" faction=uploadphoto id=$video_manager.List.id}
  {else}
  Станет доступно после сохранения
  {/if}
  </div>
  </li> 
  <li class="left full"><label class="desc">Фотографии альбома</label>
  <div class="UploadedList" src1='files/files[{$video_manager.List.id}].xml'>
  {include file="file:sadm/photo/files.tpl.php"}
  </div>
  </li>
</ul>
</form>
<hr/>
</div>
</div>

{literal}
<SCRIPT type=text/javascript>
$(document).ready(function() {
    $('a[rel*=facebox]').facebox()
});
</SCRIPT>
{/literal}
