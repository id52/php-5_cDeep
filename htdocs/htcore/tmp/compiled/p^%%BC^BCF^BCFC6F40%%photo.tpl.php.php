<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:33:56
         template file:sadm/catalog/item/photo.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'a_catalog', 'file:sadm/catalog/item/photo.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_a_catalog(array('action' => 'Files','item' => $this->_tpl_vars['State']['Current_item']), $this); if ($this->_tpl_vars['Photo']['id']): ?>
	<iframe name="frameloader" style="display:none;"></iframe>
	<form enctype="multipart/form-data" method="post" action="edit/photo[<?php echo $this->_tpl_vars['Photo']['id']; ?>
].xml" onsubmit="jQuery(document).trigger('close.facebox');" target="frameloader">
	<input type="hidden" name="Photo[gid]" value="<?php echo $this->_tpl_vars['Photo']['gid']; ?>
">
      <ul>
      	<li><div class="info"><h2>Свойства изображения id=<?php echo $this->_tpl_vars['Photo']['id']; ?>
</h2></div></li>
        <li>
        <label class="desc">Название</label>
        <div>
            <input id="Phone"
                name="Photo[Name]"
                class="field text full"
                size="30"
                type="text"
                maxlength="30"
                value="<?php echo $this->_tpl_vars['Photo']['Name']; ?>
"  />
            <label for="phone_town"> </label>
        </div>
        </li>
        <li>
        <label class="desc">Описание</label>
        <div>
                <textarea id="URL" 
                class="textarea full" rows="15"
                name="Photo[Description]"><?php echo $this->_tpl_vars['Photo']['Description']; ?>
</textarea>
        </div>
        </li>
		
		<?php if ($this->_tpl_vars['Photo']['ext'] != 'jpg' && $this->_tpl_vars['Photo']['ext'] != 'flv' && $this->_tpl_vars['Photo']['ext'] != 'mp4'): ?>
			<input type="radio" name="Photo[group]" value="1" <?php if ($this->_tpl_vars['Photo']['group'] == 1): ?>checked<?php endif; ?>>Паспорта<br>
			<input type="radio" name="Photo[group]" value="2" <?php if ($this->_tpl_vars['Photo']['group'] == 2): ?>checked<?php endif; ?>>Технические данные<br>
			<input type="radio" name="Photo[group]" value="3" <?php if ($this->_tpl_vars['Photo']['group'] == 3): ?>checked<?php endif; ?>>Сертификаты<br>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['Photo']['ext'] == 'flv' || $this->_tpl_vars['Photo']['ext'] == 'mp4'): ?>
			
			Скриншот: <input name="userfile" type="file" />
		<?php endif; ?>
		
		
		
	    <li class="buttons">
    		<button type="submit" class="positive"><img src="/img/icons/tick.png" />Применить</button>
	    </li>
      </ul>
	
	</form>
<?php endif; ?>