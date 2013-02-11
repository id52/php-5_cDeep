<? 
ob_start();
$start = microtime(1);

if(get_magic_quotes_gpc())
{
  function remslashes($arr)
  {
    if(is_array($arr))
    {
      foreach($arr as $a => $v)
      {
        $arr[$a] = remslashes($v);
      }
      return $arr;
    }
    else
    {
      return stripslashes($arr);
    }
  }

  $_GET = remslashes($_GET);
  $_POST = remslashes($_POST);
  $_REQUEST = remslashes($_REQUEST);
}


include_once('htcore/src/init.inc.php');

$State = $cDeep->obj['Site']->getCurrentState();
$cDeep->State = $State;


$cDeep->assign('State', $State);
$cDeep->assign('Current_item', $State['Current_item']);


$cDeep->assign('Dispatcher', $cDeep->obj['Dispatcher']->returns);

#print "<pre>".print_r($State,1)."</pre>";
#print "<pre>".print_r($_SESSION,1)."</pre>";

if (!empty($State['Current']['Template'])) // шаблон страницы указан
{
  $CONTENT = $cDeep->fetch($State['Current']['Template'], md5($_SERVER['REQUEST_URI']));
}
else 
{
  $CONTENT = $cDeep->fetch('file:errors/404.tpl.php');
}

$cDeep->assign('State', $cDeep->State);

if($State['Env'] && $State['Env'] !== 'empty')
{
  $cDeep->assign('CONTENT', $CONTENT);
  $cDeep->display($State['Env'], md5($_SERVER['REQUEST_URI']));
}
else 
{
  echo $CONTENT;
}

echo '<!--['.(microtime(1) - $start).'sec]-->';
?>