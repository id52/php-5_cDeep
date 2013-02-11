  {loader src='jquery.js, simpleTabs.css' type='css' base='/css/admin/' }
  {loader src='simpleTabs.jquery.js' type='js' base='/js/'}
  
    {literal}
	<script type="text/javascript">
	
	$(document).ready(function() {
    $("#tabs").simpleTabs({
        fadeSpeed: "medium", // @param : low, medium, fast
        defautContent: 1, // @param : number ( simpleTabs-nav-number)
        autoNav: "false", // @param : true or false
        closeTabs : "false" // @param : true or false;
    });
	});
    </script>
    {/literal}

<div id="tabs">

    <div class="simpleTabs-nav"> 
    <ul>
        <li id="simpleTabs-nav-1">Содержание</li>
        <li id="simpleTabs-nav-2">Свойства</li>
    </ul>    
    </div>

<!--
Keywords: {$Page.Keywords} <br>
Topic: {$Page.Topic}<br>
Title: {$Page.Title}<br>
titlemeta: {$Page.titlemeta}  <br>
Description: {$Page.Description}<br>
DescriptionHtml: {$Page.DescriptionHtml}<br>
Name (путь): {$Page.name}<br>

-->

    
<div id="simpleTabs-content-1"  class="simpleTabs-content">
    <ul>
  <li>
        <div class="info">
            <h2>Содержание:</h2>
        </div>
    </li>
       
	   <li>
        <div  class="left full">
        <label class="desc">Пункт меню <a href="/notice/help/admin/PageTitle/" class="betterTip" id="hPageTitle">(?)</a></label>
        
            <input id="Title" 
                class="field text full"
                name="Page[Title]" 
                tabindex="11"
                {if $Page.writable!=1} readonly disabled{/if}
                type="text" maxlength="255" value="{$Page.Title|htmlall}" /> 
        </div>	   
	   

	   </li>
              
    <li>
        <label class="desc">Текст страницы</label>
        <div>
                <textarea id="About" 
                class="getfck textarea large"
                name="Page[TemplateSource]" 
                {if $Page.readonly || $Page.writable!=1} disabled readonly{/if}
                cols="50" rows="35">{$Page.TemplateSource}</textarea>        
        </div>
    </li>

    </ul>
    
</div><!-- Конец 1 вкладки -->


<div id="simpleTabs-content-2"  class="simpleTabs-content">

      <ul>
        <li>
            <div class="info">
                <h2>Свойства:</h2>
                 <p>адрес страницы, атрибуты, доступ, шаблоны</p>
            </div>
        </li>      
        <li class="leftHalf">
                <div><label class="desc">Путь <a href="/notice/help/admin/PagePath/" class="betterTip" id="hPagePath">(?)</a></label>
                    <input id="name"
                        name="Page[name]"
                        class="field text full"
                        size="30"
                        type="text"
                        maxlength="30"
                        {if $Page.writable!=1} readonly disabled{/if}
                        value="{$Page.name|htmlall}"  />
                    <label for="name"> </label>
                </div>
            
                <div class="desc"><label class="desc">Заголовок страницы<a href="/notice/help/admin/PageTopic/" class="betterTip" id="hPageTopic">(?)</a></label>
                        <input id="Topic"
                        class="field text full"
                        name="Page[Topic]"
                        value="{$Page.Topic|htmlall}"  />
                        {if $Page.writable!=1} readonly disabled{/if}
                </div>
            
            	<div>
                <label class="desc">Ключевые слова (meta - keywords) <a href="/notice/help/admin/Keywords/" class="betterTip" id="hKeywords">(?)</a></label>
                      <input id="keywordsmeta" 
                        class="field text full"
                        name="Page[keywordsmeta]"
                        value="{$Page.keywordsmeta}"
                                                
                        {if $Page.writable!=1} readonly disabled{/if}
                />
                </div>

                <div>
                <label class="desc">Title<a href="/notice/help/admin/Keywords/" class="betterTip" id="hKeywords">(?)</a></label>
                      <input id="titlemeta" 
                        class="field text full"
                        name="Page[titlemeta]" 
                        value="{$Page.titlemeta|htmlall}" 
                        {if $Page.writable!=1} readonly disabled{/if}
                />
                </div>
            
                <div>
                <label class="desc">Описание шаблона <a href="/notice/help/admin/TplDesc/" class="betterTip" id="hTplDesc">(?)</a></label>
                          <input id="Description" 
                            class="field text full"
                            name="Page[Description]" 
                            value="{$Page.Description|htmlall}" 
                            {if $Page.writable!=1} readonly disabled{/if}
                    />
                </div>


                <div>
                        <label class="desc">Описание страницы (meta - description) <a href="/notice/help/admin/DescHtml/" class="betterTip" id="hDeskHtml">(?)</a></label>
                        <input id="Descriptionmeta" 
                        class="field text full"
                        name="Page[descriptionmeta]" 
                        value="{$Page.descriptionmeta|htmlall}" 
                        {if $Page.writable!=1} readonly disabled{/if}
                />
                </div>

         </li>
         <li class="rightHalf">
		 
        <div>
                  <label class="desc">Атрибуты</label><br />
                  <div>
                    <input id="P" 
                    name="Page[P]" 
                    class="checkbox" type="checkbox" 
                    {if $Page.P}checked="checked"{/if}
                    {if $Page.readonly || $Page.writable!=1} disabled readonly{/if}
                    value="1"  />
                    <label class="choice" for="P">Опубликовано</label> 
                </div>
            <div>
              <input id="enabled"
              name="Page[enabled]"
                class="field checkbox" type="checkbox"
                    {if $Page.enabled} checked="checked"{/if}
                    {if $Page.readonly || $Page.writable!=1} disabled readonly{/if}
                value="1" />
              <label class="choice" for="enabled">Активно&nbsp;в&nbsp;меню</label>
            </div>
        </div>
		 
          <label class="desc">Права доступа<a href="/notice/help/admin/PagePerms/" class="betterTip" id="hPagePerms">(?)</a></label>
          <div>
              <table>
                  <tr>
                    <td></td><td>R</td><td>W</td><td>X</td>
                  </tr>
                  <tr>
                    <td>
                    <select class="field text full" name="Page[UID]"{if $Page.writable!=1} readonly disabled{/if}>
                      <option value="1">Root</option>
                      {foreach from=$Page.UIDs item='User'}
                        <option value="{$User.UID}"{if $User.selected} selected{/if}>{$User.Name} {$User.Surname} ({$User.Login})</option>
                      {/foreach}
                    </select>
                    </td>
                    <td><input class="checkbox" name="Page[O][R]" type="checkbox" value="1"{if $Page.O.R} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                    <td><input class="checkbox" name="Page[O][W]" type="checkbox" value="1"{if $Page.O.W} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                    <td><input class="checkbox" name="Page[O][X]" type="checkbox" value="1"{if $Page.O.X} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                  </tr>
                  <tr>
                    <td>
                    <select class="field text full" name="Page[GID]"{if $Page.writable!=1} readonly disabled{/if}>
                      <option value="1">Wheel</option>
                      {foreach from=$Page.GIDs item='Group'}
                        <option value="{$Group.GID}"{if $Group.selected} selected{/if}>{$Group.Name} ({$Group.GID})</option>
                      {/foreach}
                    </select>
                    </td>
                    <td><input class="checkbox" name="Page[G][R]" type="checkbox" value="1"{if $Page.G.R} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                    <td><input class="checkbox" name="Page[G][W]" type="checkbox" value="1"{if $Page.G.W} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                    <td><input class="checkbox" name="Page[G][X]" type="checkbox" value="1"{if $Page.G.X} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                  </tr>
                  <tr>
                    <td>Для остальных</td>
                    <td><input class="checkbox" name="Page[A][R]" type="checkbox" value="1"{if $Page.A.R} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                    <td><input class="checkbox" name="Page[A][W]" type="checkbox" value="1"{if $Page.A.W} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                    <td><input class="checkbox" name="Page[A][X]" type="checkbox" value="1"{if $Page.A.X} checked{/if}{if $Page.writable!=1} readonly disabled{/if} /></td>
                  </tr>
              </table>
          </div>
    </li>         
    <li class="leftHalf">         
        

		
		
        <label class="desc">Отображение <a href="/notice/help/admin/EnvSel/" class="betterTip" id="hEnvSel">(?)</a></label>
        <div>
            <select class="field text full" name="Page[Env]"{if $Page.readonly || $Page.writable!=1} disabled readonly{/if}>
              <option value="{$Page.Env}" style="background: #f0f0ff;">{$Page.Env}</option>
              {foreach from=$Page.Envs item='Env'}
              <option value="{$Env.name}"{if $Env.selected} selected{/if}>{$Env.name} (нода:{$Env.node} от {$Env.emtime}) {$Env.Description}</option>
              {/foreach}
              <option value=""{if $Page.Env==""} selected{/if}>Наследовать</option>
              <option value="empty"{if $Page.Env=="empty"} selected{/if}>Нет</option>
            </select>
            <label for="Passwd">Оболочка</label>
        </div>
        <div>
            <select class="field text full" name="Page[Template]"{if $Page.readonly || $Page.writable!=1} disabled readonly{/if}>
              <option value="{$Page.Template}" style="background: #f0f0ff;">{$Page.Template}</option>
              {foreach from=$Page.Tpls item='Template'}
              <option value="{$Template.name}"{if $Template.selected} selected{/if}>{$Template.name} (нода:{$Template.node} от {$Template.emtime}) {$Template.Description}</option>
              {/foreach}
              <option value=""{if $Page.Template==""} selected{/if}>нет страницы (404)</option>
              <option value="tpl.page.{$Page.node}"{if $Page.Template=="tpl.page.`$Page.node`" || $Page.Template=="tpl.page."} selected{/if}>Собственный шаблон</option>
            </select>
            <label for="RePasswd">Шаблон</label>
        </div>
        <div>
        <label class="desc">Авторизация <a href="/notice/help/admin/PageAuth/" class="betterTip" id="hPageAuth">(?)</a></label>
            <select class="field text full" name="Page[Auth]"{if $Page.readonly || $Page.writable!=1} disabled readonly{/if}>
              <option value="">Наследовать</option>
              <option value="System"{if $Page.Auth=='System'} selected{/if}>Административная</option>
              <option value="User"{if $Page.Auth=='User'} selected{/if}>Пользовательская</option>
            </select>
        </div>
        </li>
      </ul>
  </div> <!-- конец 2 вкладки -->
  
  <ul>
      <li class="buttons">
          <button id="saveForm" class="positive" type="submit" {if $Page.writable!=1} readonly disabled{/if} ><img src="/img/icons/tick.png"/> Применить</button>
    </li>
	
  </ul>
  </div>
