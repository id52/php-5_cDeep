<?
session_start();
define('ROOT', realpath(dirname(__FILE__).'/htcore/').'/');
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

$cDeep            = new cDeep();
$cDeep->obj['DB']       = DbSimple_Generic::connect($cDeep->DSN);
$cDeep->obj['DB']->setErrorHandler('databaseErrorHandler');
$cDeep->obj['DB']->query("set character_set_results='utf8'");
$cDeep->obj['DB']->query("set character_set_client='utf8'");
$cDeep->obj['DB']->query("set collation_connection='utf8_general_ci'");
$cDeep->obj['DB']->query("set collation_server='utf8_general_ci'");
$cDeep->obj['DB']->query("set collation_database='utf8_general_ci'");

function databaseErrorHandler($message, $info)
{
  if (!error_reporting()) return;
  echo "SQL Error: $message<br><pre>";
  print_r($info);
  echo "</pre>";
}

$REQUEST = preg_split("|/|", $_SERVER['REQUEST_URI'], 10, PREG_SPLIT_NO_EMPTY);
switch ($REQUEST[1]) {
  case 'help':
    $tQuery = 'SELECT `Content` FROM `t_help` WHERE `Part`=? AND `Note`=?';
    print '<h1>'.$REQUEST[2].':'.$REQUEST[3].'</h1><br />';
    print $cDeep->obj['DB']->selectCell($tQuery, $REQUEST[2], $REQUEST[3]);
    exit();
    break;
  default:
    break;
}