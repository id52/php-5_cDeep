<?

function cDeep_function_a_faq($params, &$cDeep)
{

	$max = $params["max"]?(int)$params["max"]:20;
	$Page['current'] = (intval($_REQUEST['p'])>1)?(intval($_REQUEST['p'])):1;
	$start = ($Page['current']-1)*$max;
	
	$tpl = $params["tpl"];
	$faqId = (int)$params["faqId"];
	
	if(!empty($_REQUEST['fid']) && $_REQUEST['action']=='delFaq')
	{
		$fid = is_array($_REQUEST['fid'])?$_REQUEST['fid']:array($_REQUEST['fid']);
		$tQuery = "DELETE FROM t_support WHERE `fid` IN (?a) ";
		$hResult = $cDeep->obj['DB']->query($tQuery, $fid);
	}
	
	$on_date = $params["on_date"]?$params["on_date"]:0;
	$print_form = $params["print_form"];

	#####################################################################################
	$Faq= array();
	$cDeep->Deep->SYS = $cDeep->_tpl_vars["SYS"];
	
	$Question["fid"] = $_POST["fid"];
	$Question["Name"] = $_POST["Name"];
	$Question["date"] = $_POST["date"];
	$Question["Question"] = $_POST["Question"];
	$Question["Answer"] = $_POST["Answer"];
	$Question["Company"] = $_POST["Company"];
	$Question["email"] = $_POST["email"];
	$Question["phone"] = $_POST["phone"];
	$Question["enabled"] = (!empty($_POST["enabled"]))?$_POST["enabled"]:0;
	$Question["ip"] = $cDeep->Deep->SYS["VARS"]["SERVER"]["REMOTE_ADDR"]."-".getenv('HTTP_X_FORWARDED_FOR');


	switch($_POST["action"])
	{
		case "addQuestion":
			if(!empty($Question["Name"]) && !empty($Question["Question"]) && ($_POST["code"] == $_SESSION["code"]))
			{

				############
				$tQuery = "INSERT INTO t_support "
				." ( `fid` , `date` , `ip` , `Name` , `Company` , `email` , `phone` , `Question` , `Answer` , `enabled` )"
				." VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, '', '0');";
				$hResult = $cDeep->obj['DB']->query($tQuery,date("Y-m-d H:i:s"),$Question["ip"],$Question["Name"],$Question["Company"],$Question["email"],$Question["phone"],$Question["Question"]);
				############
				$Question = array();
				$action = "added";
				#$_SESSION["code"] = rand(1,900);
			}
			elseif(empty($Question["Name"]))
			{
				$action = "emptyName";
			}
			elseif(empty($Question["Question"]))
			{
				$action = "emptyQuestion";
			}
			elseif(($_POST["code"] !== $_SESSION["code"]))
			{
				$action = "emptyCode";
			}
			$Faq["Question"] = $Question;
			break;
		case "Update":
			$tQuery = "UPDATE t_support "
			."SET `Question`=?, "
			."`Answer`=?, "
			."`Name`=?, "
			."`date`=?, "
			."`Enabled` = ? "
			."WHERE `fid`=?d LIMIT 1 ;";
			$hResult = $cDeep->obj['DB']->query($tQuery,$Question["Question"],$Question["Answer"],$Question["Name"],$Question["date"], $Question["enabled"], $Question["fid"] );
			break;
		case "Disable":
			#
			break;
		case "Enable":
			#
			break;
		default:
			$action = "listing";
			break;
	}

	$_SESSION['code'] = rand(1000,9999);
	$Faq["action"] = $action;
	$faqId = empty($faqId)?DBSIMPLE_SKIP:$faqId;
	$tQuery_base = "SELECT * FROM t_support{ WHERE fid=?d} ORDER BY `fid` DESC"; //
	$tQuery = $tQuery_base." LIMIT ?d, ?d";
	$Faq["questions"] = $cDeep->obj['DB']->select($tQuery,$faqId,$start,$max);

	$tQuery = "SELECT COUNT(`fid`) AS count FROM t_support "; //
	$Page['count'] = $cDeep->obj['DB']->selectCell($tQuery);
	$Page['count']		= ceil($Page['count']/$max);
	$Page['max']		= $max;
	$Page['current']	= $Page['current'];
	$Page['next']		= ($Page['current'] < $Page['count'])?($Page['current'] + 1):0;
	$Page['last']		= ($Page['current'] > 1)?($Page['current'] - 1):0;
	$cDeep->assign("Page", $Page);
	
	if(empty($tpl))
	{
		$cDeep->trigger_error("[s_faq] undefined template", E_USER_WARNING);
		$result = "<!-- s_faq error [undefined template] -->";
	}
	else
	{
		$cDeep->assign("Faq", $Faq);
		$result = $cDeep->fetch($tpl);
	}
	return $result;

}

?>