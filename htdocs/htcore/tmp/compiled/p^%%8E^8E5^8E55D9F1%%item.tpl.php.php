<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:45:09
         template file:sadm/pages/item.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/pages/item.tpl.php', 1, false),array('modifier', 'htmlall', 'file:sadm/pages/item.tpl.php', 56, false),)), $this); ?>  <?php echo cDeep_function_loader(array('src' => 'jquery.js, simpleTabs.css','type' => 'css','base' => '/css/admin/'), $this);?>

  <?php echo cDeep_function_loader(array('src' => 'simpleTabs.jquery.js','type' => 'js','base' => '/js/'), $this);?>

  
    <?php echo '
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
    '; ?>


<div id="tabs">

    <div class="simpleTabs-nav"> 
    <ul>
        <li id="simpleTabs-nav-1">Содержание</li>
        <li id="simpleTabs-nav-2">Свойства</li>
    </ul>    
    </div>

<!--
Keywords: <?php echo $this->_tpl_vars['Page']['Keywords']; ?>
 <br>
Topic: <?php echo $this->_tpl_vars['Page']['Topic']; ?>
<br>
Title: <?php echo $this->_tpl_vars['Page']['Title']; ?>
<br>
titlemeta: <?php echo $this->_tpl_vars['Page']['titlemeta']; ?>
  <br>
Description: <?php echo $this->_tpl_vars['Page']['Description']; ?>
<br>
DescriptionHtml: <?php echo $this->_tpl_vars['Page']['DescriptionHtml']; ?>
<br>
Name (путь): <?php echo $this->_tpl_vars['Page']['name']; ?>
<br>

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
                <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
                type="text" maxlength="255" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['Title'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
" /> 
        </div>	   
	   

	   </li>
              
    <li>
        <label class="desc">Текст страницы</label>
        <div>
                <textarea id="About" 
                class="getfck textarea large"
                name="Page[TemplateSource]" 
                <?php if ($this->_tpl_vars['Page']['readonly'] || $this->_tpl_vars['Page']['writable'] != 1): ?> disabled readonly<?php endif; ?>
                cols="50" rows="35"><?php echo $this->_tpl_vars['Page']['TemplateSource']; ?>
</textarea>        
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
                        <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
                        value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['name'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
"  />
                    <label for="name"> </label>
                </div>
            
                <div class="desc"><label class="desc">Заголовок страницы<a href="/notice/help/admin/PageTopic/" class="betterTip" id="hPageTopic">(?)</a></label>
                        <input id="Topic"
                        class="field text full"
                        name="Page[Topic]"
                        value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['Topic'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
"  />
                        <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
                </div>
            
            	<div>
                <label class="desc">Ключевые слова (meta - keywords) <a href="/notice/help/admin/Keywords/" class="betterTip" id="hKeywords">(?)</a></label>
                      <input id="keywordsmeta" 
                        class="field text full"
                        name="Page[keywordsmeta]"
                        value="<?php echo $this->_tpl_vars['Page']['keywordsmeta']; ?>
"
                                                
                        <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
                />
                </div>

                <div>
                <label class="desc">Title<a href="/notice/help/admin/Keywords/" class="betterTip" id="hKeywords">(?)</a></label>
                      <input id="titlemeta" 
                        class="field text full"
                        name="Page[titlemeta]" 
                        value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['titlemeta'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
" 
                        <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
                />
                </div>
            
                <div>
                <label class="desc">Описание шаблона <a href="/notice/help/admin/TplDesc/" class="betterTip" id="hTplDesc">(?)</a></label>
                          <input id="Description" 
                            class="field text full"
                            name="Page[Description]" 
                            value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['Description'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
" 
                            <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
                    />
                </div>


                <div>
                        <label class="desc">Описание страницы (meta - description) <a href="/notice/help/admin/DescHtml/" class="betterTip" id="hDeskHtml">(?)</a></label>
                        <input id="Descriptionmeta" 
                        class="field text full"
                        name="Page[descriptionmeta]" 
                        value="<?php echo ((is_array($_tmp=$this->_tpl_vars['Page']['descriptionmeta'])) ? $this->_run_mod_handler('htmlall', true, $_tmp) : cDeep_modifier_htmlall($_tmp)); ?>
" 
                        <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>
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
                    <?php if ($this->_tpl_vars['Page']['P']): ?>checked="checked"<?php endif; ?>
                    <?php if ($this->_tpl_vars['Page']['readonly'] || $this->_tpl_vars['Page']['writable'] != 1): ?> disabled readonly<?php endif; ?>
                    value="1"  />
                    <label class="choice" for="P">Опубликовано</label> 
                </div>
            <div>
              <input id="enabled"
              name="Page[enabled]"
                class="field checkbox" type="checkbox"
                    <?php if ($this->_tpl_vars['Page']['enabled']): ?> checked="checked"<?php endif; ?>
                    <?php if ($this->_tpl_vars['Page']['readonly'] || $this->_tpl_vars['Page']['writable'] != 1): ?> disabled readonly<?php endif; ?>
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
                    <select class="field text full" name="Page[UID]"<?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>>
                      <option value="1">Root</option>
                      <?php $_from = $this->_tpl_vars['Page']['UIDs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['User']):
?>
                        <option value="<?php echo $this->_tpl_vars['User']['UID']; ?>
"<?php if ($this->_tpl_vars['User']['selected']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['User']['Name']; ?>
 <?php echo $this->_tpl_vars['User']['Surname']; ?>
 (<?php echo $this->_tpl_vars['User']['Login']; ?>
)</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                    </td>
                    <td><input class="checkbox" name="Page[O][R]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['O']['R']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                    <td><input class="checkbox" name="Page[O][W]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['O']['W']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                    <td><input class="checkbox" name="Page[O][X]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['O']['X']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                  </tr>
                  <tr>
                    <td>
                    <select class="field text full" name="Page[GID]"<?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?>>
                      <option value="1">Wheel</option>
                      <?php $_from = $this->_tpl_vars['Page']['GIDs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Group']):
?>
                        <option value="<?php echo $this->_tpl_vars['Group']['GID']; ?>
"<?php if ($this->_tpl_vars['Group']['selected']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Group']['Name']; ?>
 (<?php echo $this->_tpl_vars['Group']['GID']; ?>
)</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                    </td>
                    <td><input class="checkbox" name="Page[G][R]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['G']['R']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                    <td><input class="checkbox" name="Page[G][W]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['G']['W']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                    <td><input class="checkbox" name="Page[G][X]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['G']['X']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                  </tr>
                  <tr>
                    <td>Для остальных</td>
                    <td><input class="checkbox" name="Page[A][R]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['A']['R']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                    <td><input class="checkbox" name="Page[A][W]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['A']['W']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                    <td><input class="checkbox" name="Page[A][X]" type="checkbox" value="1"<?php if ($this->_tpl_vars['Page']['A']['X']): ?> checked<?php endif;  if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> /></td>
                  </tr>
              </table>
          </div>
    </li>         
    <li class="leftHalf">         
        

		
		
        <label class="desc">Отображение <a href="/notice/help/admin/EnvSel/" class="betterTip" id="hEnvSel">(?)</a></label>
        <div>
            <select class="field text full" name="Page[Env]"<?php if ($this->_tpl_vars['Page']['readonly'] || $this->_tpl_vars['Page']['writable'] != 1): ?> disabled readonly<?php endif; ?>>
              <option value="<?php echo $this->_tpl_vars['Page']['Env']; ?>
" style="background: #f0f0ff;"><?php echo $this->_tpl_vars['Page']['Env']; ?>
</option>
              <?php $_from = $this->_tpl_vars['Page']['Envs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Env']):
?>
              <option value="<?php echo $this->_tpl_vars['Env']['name']; ?>
"<?php if ($this->_tpl_vars['Env']['selected']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Env']['name']; ?>
 (нода:<?php echo $this->_tpl_vars['Env']['node']; ?>
 от <?php echo $this->_tpl_vars['Env']['emtime']; ?>
) <?php echo $this->_tpl_vars['Env']['Description']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
              <option value=""<?php if ($this->_tpl_vars['Page']['Env'] == ""): ?> selected<?php endif; ?>>Наследовать</option>
              <option value="empty"<?php if ($this->_tpl_vars['Page']['Env'] == 'empty'): ?> selected<?php endif; ?>>Нет</option>
            </select>
            <label for="Passwd">Оболочка</label>
        </div>
        <div>
            <select class="field text full" name="Page[Template]"<?php if ($this->_tpl_vars['Page']['readonly'] || $this->_tpl_vars['Page']['writable'] != 1): ?> disabled readonly<?php endif; ?>>
              <option value="<?php echo $this->_tpl_vars['Page']['Template']; ?>
" style="background: #f0f0ff;"><?php echo $this->_tpl_vars['Page']['Template']; ?>
</option>
              <?php $_from = $this->_tpl_vars['Page']['Tpls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Template']):
?>
              <option value="<?php echo $this->_tpl_vars['Template']['name']; ?>
"<?php if ($this->_tpl_vars['Template']['selected']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Template']['name']; ?>
 (нода:<?php echo $this->_tpl_vars['Template']['node']; ?>
 от <?php echo $this->_tpl_vars['Template']['emtime']; ?>
) <?php echo $this->_tpl_vars['Template']['Description']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
              <option value=""<?php if ($this->_tpl_vars['Page']['Template'] == ""): ?> selected<?php endif; ?>>нет страницы (404)</option>
              <option value="tpl.page.<?php echo $this->_tpl_vars['Page']['node']; ?>
"<?php if ($this->_tpl_vars['Page']['Template'] == "tpl.page.".($this->_tpl_vars['Page']['node']) || $this->_tpl_vars['Page']['Template'] == "tpl.page."): ?> selected<?php endif; ?>>Собственный шаблон</option>
            </select>
            <label for="RePasswd">Шаблон</label>
        </div>
        <div>
        <label class="desc">Авторизация <a href="/notice/help/admin/PageAuth/" class="betterTip" id="hPageAuth">(?)</a></label>
            <select class="field text full" name="Page[Auth]"<?php if ($this->_tpl_vars['Page']['readonly'] || $this->_tpl_vars['Page']['writable'] != 1): ?> disabled readonly<?php endif; ?>>
              <option value="">Наследовать</option>
              <option value="System"<?php if ($this->_tpl_vars['Page']['Auth'] == 'System'): ?> selected<?php endif; ?>>Административная</option>
              <option value="User"<?php if ($this->_tpl_vars['Page']['Auth'] == 'User'): ?> selected<?php endif; ?>>Пользовательская</option>
            </select>
        </div>
        </li>
      </ul>
  </div> <!-- конец 2 вкладки -->
  
  <ul>
      <li class="buttons">
          <button id="saveForm" class="positive" type="submit" <?php if ($this->_tpl_vars['Page']['writable'] != 1): ?> readonly disabled<?php endif; ?> ><img src="/img/icons/tick.png"/> Применить</button>
    </li>
	
  </ul>
  </div>