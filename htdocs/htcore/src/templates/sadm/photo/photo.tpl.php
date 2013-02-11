{video_manager action="Files"}
{if $Photo.id}
<iframe name="frameloader" style="display:none;"></iframe>
	<form enctype="multipart/form-data" method="post" action="edit/photo[{$Photo.id}].xml" onsubmit="$(document).trigger('close.facebox');" target="frameloader">

	<input type="hidden" name="Photo[gid]" value="{$Photo.gid}">
      <ul>
      	<li><div class="info"><h2>Свойства изображения id={$Photo.id}</h2></div></li>
        <li>
        <label class="desc">Название</label>
        <div>
            <input id="Phone"
                name="Photo[Name]"
                class="field text full"
                size="30"
                type="text"
                maxlength="300"
                value="{$Photo.Name}"  />
            <label for="phone_town"> </label>
        </div>
        </li>
        <li>
        <label class="desc">Описание</label>
        <div>
                <textarea id="URL" 
                class="textarea full" rows="15"
                name="Photo[Description]">{$Photo.Description}</textarea>
        </div>
        </li>

		{if $Photo.ext=='flv' || $Photo.ext=='mp4'}
			Скриншот: <input name="userfile" type="file" />
				
				<embed src="/js/player-4.1.60.swf"
				flashvars="file=/upload/photo/{$Photo.src}&image=/upload/photo/{$Photo.image}&width=400&height=300"
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

		{/if}
		
		
		
	    <li class="buttons">
    		<button type="submit" class="positive"><img src="/img/icons/tick.png" />Применить</button>
	    </li>
      </ul>
	
	</form>
{/if}