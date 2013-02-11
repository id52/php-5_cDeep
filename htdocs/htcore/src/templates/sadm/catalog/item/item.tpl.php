<div id="container">

<div id="cardconteiner">

<div id="header">
  <h1>Товар</h1>
</div>
{*id="f{$Item.mid}" name="f{$Item.mid}"*}
<form enctype="multipart/form-data" method="post" action="/sadm/catalog/property[{$Item.mid|default:0}].xml" id="f{$Item.mid}" name="f{$Item.mid}">
  
 
  
  <div class="control">
        <input type="hidden" name="mid" value="{$Item.mid|default:0}">
        <input type="hidden" name="mgid" value="{$Item.mgid|default:0}">
        <input type="hidden" name="is_group" value="0">
        <input type="hidden" name="faction" value="{if $Item.mid}update{else}add{/if}">  
      <ul>
        <li>
          <label class="desc" id="title22" for="Field22">Фото товара:</label>
          <span>{if $Item.mprewiev}
            <div class="holder">
            <em class="gedge"></em> 
            <em class="gcontainer"><img src="{$Item.mprewiev}" width=100%/></em></div>
          {/if}</span></li>
        <li>
          <label class="desc" id="title26" for="Field26">Атрибуты</label>
          <span>
            {*<input id="cField10" 
      name="cField10" 
        class="checkbox" type="checkbox" 
        value="I prefer to make my donation anonymously."  />
            <label class="choice" for="cField10">Скрытый</label>
            <label for="Field26">Означает товар не будет виден неавторизованным пользователям</label>*}
                       
            <input id="cField11" 
        name="enabled"
          class="checkbox" type="checkbox" 
            {if $Item.enabled}checked{/if}
          value="1"  />
            <label class="choice" for="cField11">Активный</label>
            <label>Означает что товар не будет выводится в каталоге и участвовать в поиске</label>

            <input id="cField12" 
          name="ismain" 
          class="checkbox" type="checkbox" 
            {if $Item.ismain}checked{/if}            
          value="1"  />
            <label class="choice" for="cField12">На главную</label>
            <label>Этот товар выводится в определенных разделах (рекламный)</label>
          </span></li>
		  
          {*<li>
          <label class="desc">Порядковый номер</label>
            <div> 
              <input id="morder" 
                name="morder" 
              class="field text full" 
              type="text" 
              value="{$Item.morder|default:0}"  />
                <label for="morder">сортировка групп в порядке возрастания</label>
            </div></li>	*}
			{*<li>	  
        <label class="desc">Тип товара</label>
          <input id="instock"
              name="instock"
              class="field text full"
              type="text"
              value="{$Item.instock}"  />		  
		  </li>*}
		  <li>
		  
		  {if $Item.mid}
		  {include file="file:sadm/catalog/item/upload.tpl.php" faction="uploadImages" id=$Item.mid}
		  {else}<label class="desc">Загрузить дополительные фото</label>
		  <p>Загрузка дополнительных фото станет доступна после добавления товара</p>
		  {/if}
		  
		  </li>
		  
          <li><label class="desc">Фотографии товара</label>
		  <div class="UploadedList" src1='files/files[{$Item.mid}].xml'>
		  {include file="file:sadm/catalog/item/files.tpl.php"}
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
            <h2>Карточка товара: {$Item.mname|htmlall}</h2>
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
              value="{$Item.mname|htmlall}"  />
                <label for="Field26">Не более 300 символов</label>
            </div>
          </li>
          
       <li>
	   <div class="left">
		{*<span>
        <label class="desc">Ед. измерения</label>
          <input id="mweight"
              name="mweight"
              class="field text"
              type="text"
              value="{$Item.mweight}"  />
        </span>*}
		<span>
            <label class="desc">Цена</label>
		      <input id="mprice"  
		      name="mprice"
		      class="field text currency"
		      
		      type="text"
		      value="{$Item.mprice}"  /><label for="mprice"> Рубли</label>
        </span>
		</div>
		{*<div class="right">
		      <label class="desc">Наличие</label>
              <input id="currency"
              name="currency"
              class="field text full"
              type="text"
              value="{$Item.currency}"  />
		</div>*}
		{*<div class="right">
		      <label class="desc">Размер</label>
              <input id="size"
              name="size"
              class="field text full"
              type="text"
              value="{$Item.size}"  />
		</div>*}


		
        </li>   
            
         {*   <li>
            <div class="left">
            <label class="desc">Артикуль</label>
            <input id="code" 
              name="code" 
              class="field text full" 
              type="text"  
              value="{$Item.code|htmlall}" />
            </div> 
            <div class="right">
			  <label class="desc">Производитель</label>
              <input id="maker" 
              name="maker" 
              class="field text full" 
              type="text"  
              value="{$Item.maker}" /> 
			</div>
           </li> *}
             
            <li>
            <div class="left">
              <label for="Field31" class="desc">Превью</label>
                    <input class="field text full" type="file" name="mprewiev" maxlength="255" />
                    <label for="Field31">{if $Item.mprewiev}<a href="{$Item.mprewiev}">Текущее фото</a>
                    <input id="delprev" 
                      name="mprewiev" 
                      class="checkbox" type="checkbox" 
                      value="X"  />
		            <label class="choice" for="delprev">Удалить</label>	
                    {else}не прикрепленно{/if}</label>
                    </div>
                        
           {* <div class="right">
            <label class="desc" id="title26" for="Field26">Полноразмерное фото</label>
                <input id="mimage" 
              name="mimage" 
              class="field text full addr" 
              type="file"  
               value="{$Item.mimage}" />
               <label for="mimage">{if $Item.mimage}<a href="{$Item.mimage}">Текущее фото</a>
                    <input id="delimg" 
                      name="mimage" 
                      class="checkbox" type="checkbox" 
                      value="X"  />
		            <label class="choice" for="delimg">Удалить</label>	               
               {else}не прикрепленно{/if}</label>
            </div> *}
            
           </li>
   
  <li class="">   
  <div>
      <label class="desc">Краткое описание</label>       
      <textarea id="Field109" 
      class="field textarea full"
      name="mdesc" 
      rows="5" cols="50" >{$Item.mdesc|htmlall}</textarea>
            <label>Будет выводиться на главной странице</label>       
  </div>
    </li>
       
    <li>
  <div>
    <label class="desc">Развернутое описание</label>
<textarea name="mcomponents" id="mcomponents" class="getfck textarea full" rows=30>{$Item.mcomponents}</textarea>
{literal}
<script>
    $('#Field109').fck({height: {/literal}{$height|default:200}{literal}, ToolbarSet:'Basic'}); 
</script>
{/literal}
  </div>
  </li>
  
  
  <li>
  <div>
      <label class="desc">Описание (descriptionmeta)</label>       
      <input id="Field109" 
      class="field textarea full"
      name="descriptionmeta"
      cols="50" value="{$Item.descriptionmeta|htmlall}"></input>
      <label></label>       
  </div>
</li>


  <li>
  <div>
      <label class="desc">Ключевые слова (keywordsmeta)</label>       
      <input id="Field109" 
      class="field textarea full"
      name="keywordsmeta"  
      cols="50" value="{$Item.keywordsmeta|htmlall}"></input>
      <label></label>       
  </div>
</li>  


  
  
  
         {* <li>
          <label class="desc">С этим товаром покупают</label>
            <div> 
              <input id="buywith" 
        name="buywith" 
              class="field text full" 
              type="text" 
              value="{$Item.buywith|htmlall}"  />
                <label for="buywith">Введите ID товаров через запятую</label>
            </div>
          </li>
		          <li>
          <label class="desc">Похожие товары</label>
            <div> 
              <input id="looklike" 
        name="looklike" 
              class="field text full" 
              type="text" 
              value="{$Item.looklike|htmlall}"  />
                <label for="looklike">Введите ID товаров через запятую</label>
            </div>
          </li>*}
		  
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
{literal}

$(document).ready(function(){
    $("#hidecontrol").toggle(function(){
        $(".control").css({display:'none'});
        $(".mainform").css({margin:0, border: 'none'});
        $(this).css ( {'background-position': 'left bottom'} );
        $(this).toggleClass("active"); 
        return false;
    },function(){
        $(".mainform").css( {margin: '0px 0px 0px 26%', 'border-left':'1px solid #ddd' } );
        $(".control").fadeIn();
        $(this).css ( {'background-position': 'left top'} );
        $(this).toggleClass("active"); 
        return false;   
    });  
});

{/literal}
</script>
