{*
	в шаблон неоходимо передавать параметры
	$faction - флаг действия бакэнду
	$id - ид связи
*}
{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ядро, поддержка JFrame и JForm'}
{loader src='admin/multiupload.css' type='css' base='/css/' comment='FileMultiUpload'}
{loader src='swfupload.js,swfupload.queue.js,fileprogress.js,handlers.js' type='js' base='/js/dl/' comment='FileMultiUpload'}
{literal}
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "/js/dl/swfupload.swf",
				upload_url: "/backend.xml?faction={/literal}{$faction}{literal}",	// Relative to the SWF file
				post_params: {{/literal}"PHPSESSID" : "{PHPSESSID}", "faction":"{$faction}", "id":{$id}{literal}},
				file_size_limit : "100 MB",
				file_types : "*",
				file_types_description : "Фото товаров",
				file_upload_limit : 30,
				file_queue_limit : 30,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "/img/button.gif",	// Relative to the Flash file
				button_width: "92",
				button_height: "32",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '',
				button_text_style: "color: #333333; font-size: 10px;",
				button_text_left_padding: 5,
				button_text_top_padding: 5,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
  </script>
{/literal}
<ul>
	<li>
    	<div class="info">
        	<h2>Загрузка фотографий</h2>
            <p>Допустимы форматы: <strong>&laquo;jpg&raquo;</strong>. 
            Можно выбрать сразу несколько файлов для закачки</p>
        </div>
    </li>
	<li class="buttons">
		<div class="left">
			<div id="spanButtonPlaceHolder">Загрузить</div>
		</div>
        <button id="btnCancel" type="button" onclick="swfu.cancelQueue();" disabled="disabled"><img src="/img/icons/cross.png" />Отмена</button>
	</li>
    <li>
		<label id="divStatus"></label>
		<br class="clear" />
		<div class="flash fsUploadProgress" id="fsUploadProgress"></div>
	</li>
</ul>