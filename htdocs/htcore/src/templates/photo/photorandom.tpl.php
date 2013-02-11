{video_viewer action='photoRandom'}
		
		<div class="gallery">
            	<div class="c_title">Наша<br /><span>фотогалерея <a href="/photo/">все фотoграфии</a></span></div>
				{foreach from=$photos item=photo}
					<div class="foto">
					<a href="/photo/{$photo.gid}.xml">
							<img src="/zoom/235x0/upload/photo/{$photo.src}" border="0" alt="" />
						</a>
					</div>
				{/foreach}
            </div>
			
			