<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 09:32:42
         template file:sadm/catalog/item/upload.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/catalog/item/upload.tpl.php', 6, false),array('function', 'PHPSESSID', 'file:sadm/catalog/item/upload.tpl.php', 17, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'jquery.js,jquery.form.js,jquery.jframe.js','type' => 'js','comment' => 'JQuery ядро, поддержка JFrame и JForm'), $this); echo cDeep_function_loader(array('src' => 'admin/multiupload.css','type' => 'css','base' => '/css/','comment' => 'FileMultiUpload'), $this); echo cDeep_function_loader(array('src' => 'swfupload.js,swfupload.queue.js,fileprogress.js,handlers.js','type' => 'js','base' => '/js/dl/','comment' => 'FileMultiUpload'), $this); echo '
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "/js/dl/swfupload.swf",
				upload_url: "/backend.xml?faction=';  echo $this->_tpl_vars['faction'];  echo '",	// Relative to the SWF file
				post_params: {'; ?>
"PHPSESSID" : "<?php echo cDeep_function_PHPSESSID(array(), $this);?>
", "faction":"<?php echo $this->_tpl_vars['faction']; ?>
", "id":<?php echo $this->_tpl_vars['id'];  echo '},
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
				button_text: \'\',
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
'; ?>

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