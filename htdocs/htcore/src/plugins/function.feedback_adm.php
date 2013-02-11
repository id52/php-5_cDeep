<?php

function cDeep_function_feedback_adm($params, &$cDeep)
{
	if($_GET['DelFeed']) {
		$cDeep->obj['DB']->query("DELETE FROM `d_FeedBack` WHERE `ID`=?d", $_GET['DelFeed']);
	}
	switch ($params['action']) {
		case '-':
			break;
	
		default:
			$FeedBack['List'] = $cDeep->obj['DB']->query("SELECT * FROM `d_FeedBack` ORDER BY `addDate` DESC");
			break;
	}
	$cDeep->assign("FeedBack", $FeedBack);
}