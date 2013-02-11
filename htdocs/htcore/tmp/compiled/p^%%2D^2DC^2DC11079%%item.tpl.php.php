<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:32:42
         template file:sadm/catalog/item/item.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'file:sadm/catalog/item/item.tpl.php', 9, false),array('modifier', 'htmlall', 'file:sadm/catalog/item/item.tpl.php', 96, false),)), $this); ?><div id="container">

<div id="cardconteiner">

<div id="header">
  <h1>Товар</h1>
</div>
<form enctype="multipart/form-data" method="post" action="/sadm/catalog/property[<?php echo ((is_array($_tmp=@$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
].xml" id="f<?php echo $this->_tpl_vars['Item']['mid']; ?>
" name="f<?php echo $this->_tpl_vars['Item']['mid']; ?>
">
  
 
  
  <div class="control">
        <input type="hidden" name="mid" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['Item']['mid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
">
        <input type="hidden" name="mgid" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['Item']['mgid'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
">
        <input type="hidden" name="is_group" value="0">
        <input type="hidden" name="faction" value="<?php if ($this->_tpl_vars['Item']['mid']): ?>update<?php else: ?>add<?php endif; ?>">  
      <ul>
        <li>
          <label class="desc" id="title22" for="Field22">Фото товара:</label>
          <span><?php if ($this->_tpl_vars['Item']['mprewiev']): ?>
            <div class="holder">
            <em class="gedge"></em> 
            <em class="gcontainer"><img src="<?php echo $this->_tpl_vars['Item']['mprewiev']; ?>
" width=100%/></em></div>
          <?php endif; ?></span></li>
        <li>
          <label class="desc" id="title26" for="Field26">Атрибуты</label>
          <span>
                                   
            <input id="cField11" 
        name="enabled"
          class="checkbox" type="checkbox" 
            <?php if ($this->_tpl_vars['Item']['enabled']): ?>checked<?php endif; ?>
          value="1"  />
            <label class="choice" for="cField11">Активный</label>
            <label>Означает что товар не будет выводится в каталоге и участвовать в поиске</label>

            <input id="cField12" 
          name="ismain" 
          class="checkbox" type="checkbox" 
            <?php if ($this->_tpl_vars['Item']['ismain']): ?>checked<?php endif; ?>            
          value="1"  />
            <label class="choice" for="cField12">На главную</label>
            <label>Этот товар выводится в определенных разделах (рекламный)</label>
          </span></li>
		  
          					  <li>
		  
		  <?php if ($this->_tpl_vars['Item']['mid']): ?>
		  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/catalog/item/upload.tpl.php", 'cDeep_include_vars' => array('faction' => 'uploadImages','id' => $this->_tpl_vars['Item']['mid'])));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
		  <?php else: ?><label class="desc">Загрузить дополительные фото</label>
		  <p>Загрузка дополнительных фото станет доступна после добавления товара</p>
		  <?php endif; ?>
		  
		  </li>
		  
          <li><label class="desc">Фотографии товара</label>
		  <div class="UploadedList" src1='files/files[<?php echo $this->_tpl_vars['Item']['mid']; ?>
].xml'>
		  <?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:sadm/catalog/item/files.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>
		  </div>
		  </li>		  
		  
      </ul>
  </div>
  
<div class="mainform clearfix">
    <div id="hidecontrol"></div>
    <div class="contentform">
      <ul>
        <li>
          <div class="info">
            <h2>Карточка товара: <?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['mname'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
</h2>
            <p>Заполните форму ниже, описывающую характеристики товара</p>
          </div>
        </li>
        
        <li>
          <label class="desc" id="title26" for="Field26">Название товара</label>
            <div> 
              <input id="Field26" 
        name="mname" 
              class="field text full addr" 
              type="text" 
              value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['mname'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
"  />
                <label for="Field26">Не более 300 символов</label>
            </div>
          </li>
          
       <li>
	   <div class="left">
				<span>
            <label class="desc">Цена</label>
		      <input id="mprice"  
		      name="mprice"
		      class="field text currency"
		      
		      type="text"
		      value="<?php echo $this->_tpl_vars['Item']['mprice']; ?>
"  /><label for="mprice"> Рубли</label>
        </span>
		</div>
				

		
        </li>   
            
                      
            <li>
            <div class="left">
              <label for="Field31" class="desc">Превью</label>
                    <input class="field text full" type="file" name="mprewiev" maxlength="255" />
                    <label for="Field31"><?php if ($this->_tpl_vars['Item']['mprewiev']): ?><a href="<?php echo $this->_tpl_vars['Item']['mprewiev']; ?>
">Текущее фото</a>
                    <input id="delprev" 
                      name="mprewiev" 
                      class="checkbox" type="checkbox" 
                      value="X"  />
		            <label class="choice" for="delprev">Удалить</label>	
                    <?php else: ?>не прикрепленно<?php endif; ?></label>
                    </div>
                        
                       
           </li>
   
  <li class="">   
  <div>
      <label class="desc">Краткое описание</label>       
      <textarea id="Field109" 
      class="field textarea full"
      name="mdesc" 
      rows="5" cols="50" ><?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['mdesc'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
</textarea>
            <label>Будет выводиться на главной странице</label>       
  </div>
    </li>
       
    <li>
  <div>
    <label class="desc">Развернутое описание</label>
<textarea name="mcomponents" id="mcomponents" class="getfck textarea full" rows=30><?php echo $this->_tpl_vars['Item']['mcomponents']; ?>
</textarea>
<?php echo '
<script>
    $(\'#Field109\').fck({height: ';  echo ((is_array($_tmp=@$this->_tpl_vars['height'])) ? $this->_run_mod_handler('default', true, $_tmp, 200) : cDeep_modifier_default($_tmp, 200));  echo ', ToolbarSet:\'Basic\'}); 
</script>
'; ?>

  </div>
  </li>
  
  
  <li>
  <div>
      <label class="desc">Описание (descriptionmeta)</label>       
      <input id="Field109" 
      class="field textarea full"
      name="descriptionmeta"
      cols="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['descriptionmeta'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
"></input>
      <label></label>       
  </div>
</li>


  <li>
  <div>
      <label class="desc">Ключевые слова (keywordsmeta)</label>       
      <input id="Field109" 
      class="field textarea full"
      name="keywordsmeta"  
      cols="50" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Item']['keywordsmeta'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
"></input>
      <label></label>       
  </div>
</li>  


  
  
  
         		  
        <li class="buttons">
          <button  id="saveForm" class="positive" type="submit"><img src="/img/icons/tick.png"/> Применить</button>
        </li>
        
      </ul><br />
    </div>
  </form>
  </div>
</div>

</div>

<script type="text/javascript">
<?php echo '

$(document).ready(function(){
    $("#hidecontrol").toggle(function(){
        $(".control").css({display:\'none\'});
        $(".mainform").css({margin:0, border: \'none\'});
        $(this).css ( {\'background-position\': \'left bottom\'} );
        $(this).toggleClass("active"); 
        return false;
    },function(){
        $(".mainform").css( {margin: \'0px 0px 0px 26%\', \'border-left\':\'1px solid #ddd\' } );
        $(".control").fadeIn();
        $(this).css ( {\'background-position\': \'left top\'} );
        $(this).toggleClass("active"); 
        return false;   
    });  
});

'; ?>

</script>