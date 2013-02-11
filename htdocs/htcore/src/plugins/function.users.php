<?

function cDeep_function_users($params, &$cDeep)
{

$id=$cDeep->State['Current_item'];
$max=20;
$num = $cDeep->obj['DB']->selectCell('select count(`UID`) from `users`');
$num=intval($num);
$count    = ceil($num/$max);
$current=$_GET['p'];
$current  = abs($current);
$current = ($current < 1)?1:$current;
$next   = ($current < $count)?($current + 1):0;
$last   = ($current > 1)?($current - 1):0;
$start = ($current-1)*$max;

$cDeep->assign('next',$next);
$cDeep->assign('last',$last);
$cDeep->assign('current',$current);
$cDeep->assign('count',$count);
$cDeep->assign('uid',$_GET['uid']);


foreach($_POST['deleteuser'] as $id=>$delete)
{
	$cDeep->obj['DB']->query('delete from `users` where `UID`=? ',$id );
};

switch ($_GET['orderby']) 
{
	case 'UID':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'Login':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'Name':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'Photo':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'address':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'Phone':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'regtime':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	case 'authtime':$query="select * from `users` order by `UID`  ".$_GET['desc']."  limit ?d, ?d;" ;break;
	default: $query="select * from `users` order by `UID`  desc  limit ?d, ?d;" ;break;
};

$users = $cDeep->obj['DB']->query($query, $start, $max);
//$users = $cDeep->obj['DB']->query('select * from `users` order by `UID` DESC limit ?d, ?d;', $start, $max);
$cDeep->assign('orderby', $_GET['orderby']);		
$cDeep->assign('desc', $_GET['desc']);		
$cDeep->assign('users', $users);	

}

?>