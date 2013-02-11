<div id="container">

<div id="cardconteiner">

<div id="header">
  <h1>Группа</h1>
</div>

<form class="card" method="POST" enctype="multipart/form-data" id="f{$Item.mid}" name="f{$Item.mid}" action="/sadm/catalog/property[{$Item.mid|default:0}].xml">
  
  <div class="control">
        <input type="hidden" name="mid" value="{$Item.mid|default:0}">
        <input type="hidden" name="mgid" value="{$Item.mgid|default:0}">
        <input type="hidden" name="is_group" value="1">
        <input type="hidden" name="faction" value="{if $Item.mid}update{else}add{/if}">  
      <ul>
        <li>
          <label class="desc" id="title22" for="Field22"> Фото товара:</label>
          <span>{if $Item.mprewiev}
          


            <div class="holder">
            <em class="gedge"></em> 
            <em class="gcontainer"><img src="{$Item.mprewiev}" width=100%/></em></div>
       
          
          
          {/if}</span></li>
        <li>
          <label class="desc" id="title26" for="Field26">Атрибуты</label>
          <span>
<!--            <input id="cField10" 
      name="cField10" 
        class="checkbox" type="checkbox" 
        value="I prefer to make my donation anonymously."  />
            <label class="choice" for="cField10">Скрытый</label>
            <label for="Field26">Означает товар не будет виден неавторизованным пользователям</label>-->
                       
            <input id="cField11" 
      name="enabled"
        class="checkbox" type="checkbox" 
            {if $Item.enabled || !$Item.mid}checked{/if}
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
        {*  <li>
          <label class="desc">Порядковый номер</label>
            <div> 
              <input id="morder" 
        		name="morder" 
              class="field text full" 
              type="text" 
              value="{$Item.morder|default:0}"  />
                <label for="morder">сортировка групп в порядке возрастания</label>
            </div>          </li>*}
      </ul>
  </div>
  
<div class="mainform clearfix">
    <div id="hidecontrol"></div>
    <div class="contentform">
      <ul>
        <li>
          <div class="info">
            <h2>{$Item.mname|htmlall}</h2>
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
          
      <!--<li>
                    <div class="left">
                    <label class="desc">Валюта</label>
                    <select class="field select full addr" 
                    name="card[country]" />
                    <option>Рубли</option>
                    </select>   
                    </div>
                    
<div class="right">
            <label class="desc">Стоимость</label>
            <span class="symbol">$</span>
      <span>
      <input id="Field0"
      name="mprice"
      class="field text currency"
      size="10"
      type="text"
      value="{$Item.mprice}"  /><label for="Field0">Рубли</label>
      </span>
            </div>                    
                    
        </li> -->   
                
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
<!--           <li class="rightHalf"> 
                    <div>
                    <label class="desc">Производитель</label>
                    <select class="field select full addr" 
                    name="card[country]"/>
                    </select>   
                    </div>
        </li>
-->
       
    <li>
  <div>
    <label class="desc">Развернутое описание</label>
<textarea name="mcomponents" id="mcomponents" class="getfck textarea full" rows=30>{$Item.mcomponents}</textarea>
              
{literal}
<script>
	$('#Field109').fck({Height:200, ToolbarSet:'Basic'});
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


  <!--li>
  <div>
      <label class="desc">urn</label>       
      <input id="Field109" 
      class="field textarea full"
      name="urn"  
      cols="50" value="{$Item.urn|htmlall}"></input>
      <label></label>       
  </div>
</li-->    
  
  
  

        <li class="buttons">
          <button  id="saveForm" class="positive" type="submit"><img src="/img/icons/tick.png"/> Применить</button>
        </li>
        
      </ul>
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
