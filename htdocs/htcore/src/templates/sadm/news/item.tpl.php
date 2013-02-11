{loader src='jquery-ui.css' type='css' base='/css/admin/' comment='Стили'}
{loader src='jquery.js, jquery-ui.js, ui.datepicker-ru.js' type='js'}
{loader src='jquery.FCKEditor.js' type='js' base='/js/' comment='FCKEditor jplugin'}

{loader src='facebox.css' type='css' base='/css/admin/' comment=''}
{loader src='facebox/facebox.js' type='js' comment='JQuery'}

 
{news_manager action="Edit"}
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
    $('a[rel*=facebox]').facebox();
  });
  
	function delPhoto(id)
	{
	    $('#pic_'+id).fadeOut();
		$('#ctrl_'+id).fadeOut();
	    
	    Img = new Image(1,1);
	    Img.src = "removeimg["+id+"].xml";
            //alert("removeimg["+id+"].xml");
            //$.get(Img.src);
            
	}  
  </script>
  {/literal}

<div id="container">
  <div id="content" class="nosidebar clearfix">
<form enctype="multipart/form-data" method="post">
    <input type="hidden"
      name="News[id]"
      value="{$News.id|default:0}"  />
<ul>
  <li>
   	<div class="info">
   	<h2>Новость &laquo;{$News.Title}&raquo;</h2>
	    <p>Афиша, событие</p>
    </div>
  </li>
  <li class="leftHalf">
  <ul>
  <li class="leftHalf">
  <div class="pic-preview">
	<div class="imagewrap">
	{if $News.Icon}
	<img src="/zoom/185x260/upload/news/{$News.Icon}" height="100%" id="pic_{$News.id}" alt="Логотип" />
	{else}
	<img src="/img/noimage.gif" id="pic" alt="Нет лого" />
	{/if}
	</div>
	{if $News.Icon}
    <span id="ctrl_{$News.id}"><a href="/upload/news/{$News.Icon}" rel="facebox"><img src="/img/icons/zoom.png" height="16" width="16" alt="нука поближе.." /></a>
    <a href="javascript:void(0);" onclick="{literal}if(confirm(this.title)) { delPhoto('{/literal}{$News.id}{literal}'); } return false;{/literal}" title="Удалить картинку новости?"><img src="/img/icons/cross.png" height="16" width="16"  alt="ф топку!" /></a></span>
	{/if}
  </div>   
  </li>   
  <li class="rightHalf">
  <div class="lidiv"><label class="desc">Название статьи</label>
    <input id="Field22" 
      name="News[Title]"
      class="field text full" size="" 
      value="{$News.Title|htmlall}"  />
  </div>
  </li>
  <li class="rightHalf">
  <div  class="lidiv"><label class="desc">Метка</label>
    <input id="primaryTag" 
      class="field text full"
      name="News[primaryTag]" 
      type="text" maxlength="255" value="{$News.primaryTag}" />
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
      type="text" maxlength="255" value="{$News.Source}" /> 
      <label for="club">Автор статьи, или ссылка на первоисточник</label>
  </div>
  </li>
  <li>
    <div><label class="desc">Теги</label>
    <input id="Tags"
      class="field text full"
      name="News[Tags]" 
      type="text" maxlength="255" value="{$News.Tags}" />
      <label for="Tags">Ключевые слова</label>
  </div>
  </li>
  <li>
  <div  class="left half"><label class="desc">Дата</label>
    <input id="DateCreated" 
      class="field text medium datepicker"
      name="News[Date]" 
      type="text" maxlength="255" value="{$News.Date|rusdate:'sqlnow'}" /> 
  </div>
  <div  class="right half"><label class="desc">Видимость</label>
			<input id="enabled" 
			name="News[enabled]" 
	   		class="field checkbox" type="checkbox"
            {if $News.enabled}checked="checked"{/if}            
		    value="1" />
			<label class="choice" for="enabled">Включена</label>
  </div>
  
  
  </li>   
     <li>
     <label class="desc">Короткое описание</label>
  <div>
    <textarea name="News[Description]" id="Description" rows="19" class="field textarea full">{$News.Description}</textarea>
  </div>
  
  
  
  {literal}
<script>
    $('#Description').fck({Height:295, ToolbarSet:'Basic'});
</script>
{/literal}
  </li>
  </ul>
</li>

<li class="rightHalf">
  <label class="desc">Развернутое описание</label>
  <div>
    <textarea name="News[Content]" id="text" rows="45" class="getfck field textarea full">{$News.Content}</textarea>
  </div>
</li>

<li class="rightHalf">
  <label class="desc">Описание (description meta)</label>
  <div>
    <input name="News[descriptionmeta]" id="text" rows="2" class="" value="{$News.descriptionmeta}"></input>
  </div>
</li>

<li class="rightHalf">
  <label class="desc">Ключевые слова (keywordsmeta)</label>
  <div>
    <input name="News[keywordsmeta]" id="text" rows="2" class="" value="{$News.keywordsmeta}"></input>
  </div>
</li>











<li class="buttons">
	<button type="submit" class="positive "><img src="/img/icons/tick.png" alt="" /> Сохранить</button> 
</li>
</ul>
</form>

<hr/>

{*<div id="toolbox" class="clearfix">
		<div id="toolbox-upload">
		нет загрузки
		</div>
		<div id="toolbox-gallery">
			<div class="info">
            <h2>Галереи</h2>
            <p>Фотоотчеты всех событий связанных с этим местом</p>
            </div>
            <div class="innertext">
	            {include file='file:sadm/photos/bytag.tpl.php' TagId=$News.primaryTagId}
			</div>
		</div>
		<div id="toolbox-poster">
   			<div class="info">
			<h2>Афиши</h2>
            <p>Анонсы всех событий этого места (постеры)</p>
            </div>
            <div class="innertext">
				
			</div>
		</div>
		<div id="toolbox-interier">
        	<div class="info">
			<h2>&larr;&nbsp;Интерьер</h2>
            <p>Фотоотчет по сабжу</p>
            </div>
            <div class="innertext UploadedList"'>нет файлов</div>
		</div>        
	</div> <!-- end #toolbox -->*}


</div>

</div></div>