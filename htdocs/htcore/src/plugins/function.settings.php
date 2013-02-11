<?php

function cDeep_function_settings($params, &$cDeep)
{
if ($_POST['sitename'] )
{
	$cDeep->obj['DB']->query('update `site` set `value`=?', $_POST['sitename']);
	$sitename = $cDeep->obj['DB']->selectCell('SELECT `value` FROM `site`');
	$cDeep->assign('sitename',$sitename);
}
else
{
	$sitename = $cDeep->obj['DB']->selectCell('SELECT `value` FROM `site`');
	$cDeep->assign('sitename',$sitename);
};

if($_POST['submit'])
{
	$cDeep->obj['DB']->query('update `robokassa` set `mrh_login`=?,`mrh_pass1`=?, `inv_desc`=?, `shp_item`=?,`in_curr`=?, `culture`=?, `mrh_pass2`=?', $_POST['mrh_login'],$_POST['mrh_pass1'],$_POST['inv_desc'],$_POST['shp_item'],$_POST['in_curr'],$_POST['culture'],$_POST['mrh_pass2']);
}

$query=$cDeep->obj['DB']->selectRow("select * from `robokassa`");
$cDeep->assign('mrh_login',$query['mrh_login']);
$cDeep->assign('mrh_pass1',$query['mrh_pass1']);
$cDeep->assign('inv_desc',$query['inv_desc']);
$cDeep->assign('shp_item',$query['shp_item']);
$cDeep->assign('in_curr',$query['in_curr']);
$cDeep->assign('culture',$query['culture']);
$cDeep->assign('mrh_pass2',$query['mrh_pass2']);
$cDeep->assign('time',date("Y-m-d h:i:s",time()));

if($_POST['submit'])
{
	$cDeep->obj['DB']->query('update `sms` set `neworder`=?,`newquestion`=?, `clientstatus`=?', $_POST['neworder'],$_POST['newquestion'],$_POST['clientstatus']);
	$cDeep->obj['DB']->query('update `imagesettings` set `quality`=?', $_POST['quality']);
}

	$query=$cDeep->obj['DB']->selectRow("select * from `sms`, `imagesettings`");
	$cDeep->assign('neworder',$query['neworder']);
	$cDeep->assign('newquestion',$query['newquestion']);
	$cDeep->assign('clientstatus',$query['clientstatus']);
	$cDeep->assign('quality',$query['quality']);

//if ($_POST['percent'] )
{
	$cDeep->obj['DB']->query('update `Course` set `percent`=?', $_POST['percent']);
	$percent = $cDeep->obj['DB']->selectCell('SELECT `percent` FROM `Course`');
	$cDeep->assign('percent',$percent);
}

if(function_exists('imagecopyresized'));
{
	$cDeep->assign('gd2','gd2');
};

if(function_exists('NewMagickWand'))
{
	$cDeep->assign('magicwand','magicwand');
};


}

?>