	{importer}
	<head>
	<link rel="Stylesheet"  href="/css/forms.css" type="text/css" />
	</head>
	<body>
	<form class='info' method="POST" enctype="multipart/form-data" style="font-size:1.2em; margin-top:1em; width:390px;" action='/sadm/catalog/importer/uploadprice'>
	<ul>
	<li><div class="info">
	<h2>Загрузка/обновление</h2>
	<p>Для загрузки из файла, выберите файл и нажмите &laquo;Загрузить&raquo;. Для обновления из локальной копии - просто нажмите &laquo;Загрузить&raquo;.</p>
	</div></li>
	
	<li>
	<input type="hidden" name="reload" value="true">
	<div>
	<label class="desc">Выберите файл для загрузки</label>
	<input type="file" class="text full" name="price"></div></li>
	
	<li class="buttons"><button type="submit" class="positive">Загрузить</button></li>
	</ul>
	</form>
	</body>