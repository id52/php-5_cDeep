<?
session_start();
ini_set('magic_quotes_gpc', 'off');
header('Content-type: text/html; charset=UTF-8;');
define('ROOT', realpath(dirname(__FILE__).'/../').'/');
define('RND', mt_rand());

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
  switch ($errno) {
  case E_USER_ERROR:
    echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
    echo "  Fatal error in line $errline of file $errfile";
    echo "Aborting...<br />\n";
    exit(1);
    break;
  case E_USER_WARNING:
    //echo "<b>My WARNING</b> [$errno] $errstr in line $errline of file $errfile<br />\n";
    break;
  case E_USER_NOTICE:
    //echo "<b>My NOTICE</b> [$errno] $errstr in line $errline of file $errfile<br />\n";
    break;
  default:
    //echo "Unkown error type: [$errno] $errstr in line $errline of file $errfile<br />\n";
    break;
  }
}
set_error_handler("myErrorHandler");

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

$cDeep = new cDeep();

$cDeep->obj['DB'] = DbSimple_Generic::Instance($cDeep);
$cDeep->obj['DB']->setErrorHandler('databaseErrorHandler');
function databaseErrorHandler($message, $info)
{
    if (!error_reporting()) return;
  print $info;
  print $message;
}

/* перенести в конструктор cDeep? */
$cDeep->obj['Reg']      = new Reg($cDeep);
$cDeep->obj['Dispatcher']   = new Dispatcher($cDeep);
$cDeep->obj['Site']     = new Site($cDeep);

?>