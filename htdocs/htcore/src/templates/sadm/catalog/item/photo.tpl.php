{a_catalog action="Files" item=$State.Current_item}

{if $Photo.id}
	<iframe name="frameloader" style="display:none;"></iframe>
	<form enctype="multipart/form-data" method="post" action="edit/photo[{$Photo.id}].xml" onsubmit="jQuery(document).trigger('close.facebox');" target="frameloader">
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
                maxlength="30"
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
		
		{if $Photo.ext!='jpg' && $Photo.ext!='flv' && $Photo.ext!='mp4'}
			<input type="radio" name="Photo[group]" value="1" {if $Photo.group==1}checked{/if}>Паспорта<br>
			<input type="radio" name="Photo[group]" value="2" {if $Photo.group==2}checked{/if}>Технические данные<br>
			<input type="radio" name="Photo[group]" value="3" {if $Photo.group==3}checked{/if}>Сертификаты<br>
		{/if}
		
		{if $Photo.ext=='flv' || $Photo.ext=='mp4'}
			
			Скриншот: <input name="userfile" type="file" />
		{/if}
		
		
		
	    <li class="buttons">
    		<button type="submit" class="positive"><img src="/img/icons/tick.png" />Применить</button>
	    </li>
      </ul>
	
	</form>
{/if}