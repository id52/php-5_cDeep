<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:46:41
         template file:sadm/photo/photo.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'video_manager', 'file:sadm/photo/photo.tpl.php', 1, false),)), $this); ?><?php echo cDeep_function_video_manager(array('action' => 'Files'), $this); if ($this->_tpl_vars['Photo']['id']): ?>
<iframe name="frameloader" style="display:none;"></iframe>
	<form enctype="multipart/form-data" method="post" action="edit/photo[<?php echo $this->_tpl_vars['Photo']['id']; ?>
].xml" onsubmit="$(document).trigger('close.facebox');" target="frameloader">

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
                maxlength="300"
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

		<?php if ($this->_tpl_vars['Photo']['ext'] == 'flv' || $this->_tpl_vars['Photo']['ext'] == 'mp4'): ?>
			Скриншот: <input name="userfile" type="file" />
				
				<embed src="/js/player-4.1.60.swf"
				flashvars="file=/upload/photo/<?php echo $this->_tpl_vars['Photo']['src']; ?>
&image=/upload/photo/<?php echo $this->_tpl_vars['Photo']['image']; ?>
&width=400&height=300"
				width="400"
				height="300"
				autostart="false"
				allowfullscreen="true"
				allowfullscreen="true"
				streamer="lighttpd"
				showstop="true"
				showdownload="true"
				backcolor="0x333333
				overstretch="true"
				linkfromdisplay="false"
				>
				</embed>

		<?php endif; ?>
		
		
		
	    <li class="buttons">
    		<button type="submit" class="positive"><img src="/img/icons/tick.png" />Применить</button>
	    </li>
      </ul>
	
	</form>
<?php endif; ?>