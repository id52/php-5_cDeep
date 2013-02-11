<?
session_start();

ini_set('magic_quotes_gpc', 'off');
header('Content-type: text/html; charset=UTF-8;');
define('ROOT', realpath(dirname(__FILE__).'/../../').'/');
define('RND', mt_rand());


$File = ROOT."tmp/catalog.txt";

if ($_SESSION['AUTH']) {
	print '
	<style>
		@import url("/css/admin/structure.css");
		@import url("/css/admin/screen.css");		
		@import url("/css/forms.css");
		html, body { background:#fff;}
	</style>
	<body>
	<form method="POST" enctype="multipart/form-data" style="font-size:1.2em; margin-top:1em; width:390px;">
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
	';
	if (file_exists($_FILES['price']['tmp_name']) && $_FILES['price']['type']=='text/plain') {
		$File=$_FILES['price']['tmp_name'];
	}
	elseif(empty($_REQUEST['reload'])) 
	{
		exit;
	}
}

function __autoload($class)
{
	$class_file = str_replace('_', '/', $class);
	if ( file_exists(ROOT.'lib/'.$class_file.'.lib.php') )
	{
		include_once(ROOT.'lib/'.$class_file.'.lib.php');
	}
	else
	{
		#die('Failed load class ['.$class.'] in /lib/'.$class_file.'.lib.php');
	}
}

$cDeep            = new cDeep();
$cDeep->obj['DB'] = DbSimple_Generic::Instance($cDeep);
$cDeep->obj['DB']->setErrorHandler('databaseErrorHandler');
$cDeep->obj['DB']->query("set character_set_results='utf8'");
$cDeep->obj['DB']->query("set collation_connection='utf8_general_ci'");
$cDeep->obj['DB']->query("set collation_server='utf8_general_ci'");
$cDeep->obj['DB']->query("set collation_database='utf8_general_ci'");
$cDeep->obj['DB']->query("set character_set_client='cp1251'");

function databaseErrorHandler($message, $info)
{
	if (!error_reporting()) return;
	print $info;
	print $message;
}


if (file_exists($File)) {
	$cDeep->obj['DB']->query('UPDATE `t_menu` SET `enabled`=0');

	$hCatFile = fopen($File, "r") or die('CanNotOpenFile');
	$iQuery = 'INSERT IGNORE INTO `t_menu` (?#) VALUES (?a)';
	$uQuery = 'UPDATE `t_menu` SET ?a WHERE `mid`=?d';
	$counter=array();
	$strerr=null;
	while (($aItem = fgetcsv($hCatFile, 1000, "\t")) !== FALSE) {
		#print "<pre>".print_r($aItem,1)."</pre>";
		$num = count($aItem);
		$Item=null;
		#print $num;
		switch ($num) {
			case 3:
				// this is group
				$Item = array(
				'mid'=>intval($aItem[0]),
				'mgid'=>intval($aItem[1]),
				'is_group'=>1,
				'mname'=>$aItem[2],
				'enabled'=>1,
				);
				break;

			case 10:
				// this is item
				$Item = array(
				'mid'=>intval($aItem[0]),
				'mgid'=>intval($aItem[1]),
				'is_group'=>0,
				'mname'=>$aItem[2],
				'mprice'=>$aItem[3],
				'code'=>$aItem[4],
				'mweight'=>$aItem[5],
				'currency'=>$aItem[6],
				'maker'=>$aItem[7],
				'instock'=>$aItem[8],
				'morder'=>$aItem[9],
				'enabled'=>1,
				);
				break;
			default:
				$counter['FormatMismatch']++;
				$strerr.='['.print_r($aItem,1).']';
				break;
		}
		if ($Item) {
			$insertID = $cDeep->obj['DB']->query($iQuery, array_keys($Item), array_values($Item));
			if (empty($insertID)) {
				if($cDeep->obj['DB']->query($uQuery, $Item, $Item['mid']))
				{
					$counter['Update']++;
				}
				else
				{
					$counter['Fail']++;
				}
			}
			else
			{
				$counter['Insert']++;
			}
		}
		$counter['All']++;
	}
	fclose($hCatFile);
	if($counter['Insert'])      print '[Добавлено]=>'.$counter['Insert'].';<br />';
	if($counter['Update'])      print '[Обновлено]=>'.$counter['Update'].';<br />';
	if($counter['Fail'])      print '[ОшибкаИмпорта]=>'.$counter['Fail'].';<br />';
	if($counter['FormatMismatch'])  
	   print '[ОшибкаФормата]=>'.$counter['FormatMismatch'].'('.$strerr.');<br />';
	   
	print '[Всего]=>'.$counter['All'].';';
}
else
{
	die('Локальный файл прайса не найден');
}
