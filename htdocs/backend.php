<?
session_start();
define('ROOT', realpath(dirname(__FILE__).'/htcore/').'/');
define('RND', mt_rand());
header('Content-type: text/html; charset=UTF-8;');

function __autoload($class)
{
  $class_file = str_replace('_', '/', $class);
  if ( file_exists(ROOT.'lib/'.$class_file.'.lib.php') )
  {
    include_once(ROOT.'lib/'.$class_file.'.lib.php');
  }
  else
  {
    die('Failed load class ['.$class.'] in /lib/'.$class_file.'.lib.php');
  }
}

#class Deep { var $obj = array(); }

$cDeep            = new cDeep();
$cDeep->obj['DB']       = DbSimple_Generic::connect($cDeep->DSN);
$cDeep->obj['DB']->setErrorHandler('databaseErrorHandler');
function databaseErrorHandler($message, $info)
{
  if (!error_reporting()) return;
  echo "SQL Error: $message<br><pre>";
  print_r($info);
  echo "</pre>";
}

$cDeep->obj['DB']->query("set character_set_results='utf8'");
$cDeep->obj['DB']->query("set character_set_client='utf8'");
$cDeep->obj['DB']->query("set collation_connection='utf8_general_ci'");
$cDeep->obj['DB']->query("set collation_server='utf8_general_ci'");
$cDeep->obj['DB']->query("set collation_database='utf8_general_ci'");
$user = SysAuth::SESSION();

#$hLog = fopen("backend.log", "a+");
#fwrite($hLog, print_r($_REQUEST,1).print_r($_FILES,1).print_r($user,1));
#fclose($hLog);


if (empty($user['UID'])) { 
   header("HTTP/1.0 401 Autorization Required");
   exit(0);
}

switch (Globals::REQUEST('faction')) {
  case 'SiteHelper':
    $cDeep->obj['Debug_SiteHelper'] = new Debug_SiteHelper($cDeep);
    break;

  case 'uploadImages':
    $id = Globals::REQUEST('id');
    if (!empty($user['UID']) && !empty($id)) {
      if(!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0)
      {
        header("HTTP/1.0 500 Internal Server Error");
        print 'File IO error ';
        exit(0);
      }
      else
      {
        $file = false;
        $type = false;
        $media = 'upload/catalog/'.intval($id);
        if(!is_dir($media)) { mkdir($media, 0777, 1); }
        $_file = explode('.', $_FILES["Filedata"]["name"]);
        $ext = strtolower($_file[(sizeof($_file)-1)]);
		$filename = strtolower($_file[(sizeof($_file)-2)]);
		$type=$ext;
		

	 if ($type && move_uploaded_file($_FILES["Filedata"]["tmp_name"], $media.'/'.$type.RND.'.'.$ext))
        {
          $cDeep->obj['DB']->query('INSERT INTO `t_menu_files` (`gid`,`src`,`Name`,`Description`,`ext`) VALUES (?d, ?, ?,?,?)', $id, intval($id).'/'.$type.RND.'.'.$ext, $filename,$filename,$ext);
          print 'files/'.$id.'.xml';
        }
        else
        {
          header("HTTP/1.0 500 Internal Server Error");
          exit(0);
        }
        print 'files/'.$id.'.xml';
      }
    }
    break;
	
	
	
  case 'uploadphoto':
    $id = Globals::REQUEST('id');
    if (!empty($user['UID']) && !empty($id)) {
      if(!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0)
      {
        header("HTTP/1.0 500 Internal Server Error");
        print 'File IO error ';
        exit(0);
      }
      else
      {
        $file = false;
        $type = false;
        $media = 'upload/photo/'.intval($id);
        if(!is_dir($media)) { mkdir($media, 0777, 1); }
        $_file = explode('.', $_FILES["Filedata"]["name"]);
		echo $_file;
        $ext = strtolower($_file[(sizeof($_file)-1)]);
		$type=$ext;

	 if ($type && move_uploaded_file($_FILES["Filedata"]["tmp_name"], $media.'/'.$type.RND.'.'.$ext))
        {
          $cDeep->obj['DB']->query('INSERT INTO `p_gallery_files` (`gid`,`src`, `Name`, `Description`, `ext`) VALUES (?d, ?, ? ,? ,?)', $id, intval($id).'/'.$type.RND.'.'.$ext, $filename, $filename, $ext);
          print 'files/'.$id.'.xml';

		  
        }
        else
        {
          header("HTTP/1.0 500 Internal Server Error");
          exit(0);
        }
        print 'files/'.$id.'.xml';
      }
    }
    break;	

  case 'AttacheUpload':
    $id = Globals::REQUEST('id');
    $cDeep->obj['Plugin_Article'] = new Plugin_Article($cDeep, true);
    $return = $cDeep->obj['Plugin_Article']->Controller('uploadAttache', $id);
    print 'attache/property['.$id.'].xml';
    break;
  case 'ListTags':
    $Tag = Globals::REQUEST('q');
    $Tag = urldecode($Tag);
    $cDeep->obj['Plugin_Tag'] = new Plugin_Tag($cDeep, true);
    $return = $cDeep->obj['Plugin_Tag']->Controller('searchTag', array('Tag'=>$Tag));
    while (list(,$t)=each($return)) {
      print $t['Tag'].'|'.$t['id']."\n";
    }
    break;
  case 'ListPost':
    $Tag = Globals::REQUEST('q');
    $Tag = urldecode($Tag);
    $return = $cDeep->obj['DB']->selectCol('SELECT DISTINCT `post` FROM `p_videophoto` WHERE `post` LIKE ?', $Tag.'%');
    while (list(,$t)=each($return)) {
      print $t.'|'.$t."\n";
    }
    break;
  case 'SortMenu':
    $Sort = Globals::REQUEST('sort');
    $cDeep->obj['Plugin_Site_Pages'] = new Plugin_Site_Pages($cDeep, true);
    $return = $cDeep->obj['Plugin_Site_Pages']->Controller('sortMenu', array('Sort'=>$Sort));
    print $return['Status'];
    break;

  default:
    break;
}
?>