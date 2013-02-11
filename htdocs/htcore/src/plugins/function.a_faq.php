<?

function cDeep_function_a_faq($params, &$cDeep)
{
	

	
	if($_POST['adminemail'])
		$cDeep->obj['DB']->query("update `settings` set `value`=? where `name`='adminemail'", $_POST['adminemail']);
		
	
	$adminemail=$cDeep->obj['DB']->selectCell("select `value` from `settings` where `name`='adminemail'");
	$cDeep->assign("adminemail", $adminemail);
	
	$cDeep->assign("currentcategory", $_GET['currentcategory']);
	
	
	foreach($_POST['category'] as $id=>$category)
	{
		$cDeep->obj['DB']->query("update `t_support_categories` set `name`=?,`order`=? where `id`=?", $category['name'], $category['order'], $id);
	};

	
	foreach($_POST['delete'] as $key=>$value)
	{
		$cDeep->obj['DB']->query("delete from `t_support_categories` where `id`=?", $key);
	};
	
	if($_POST['submit']=='Сохранить' && !empty($_POST['newname']))
	{
		$cDeep->obj['DB']->query("insert into `t_support_categories` (`name`,`order`) values (?,?)", $_POST['newname'], $_POST['neworder']);
	};
	

	$categories=$cDeep->obj['DB']->query('select * from `t_support_categories` order by `order` desc');
	$cDeep->assign("categories", $categories);
	
	/////////////////////////////////////////////////////////////////////////////////


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
	$Question["category"] = $_POST["category"];
	$Question["Company"] = $_POST["Company"];
	$Question["email"] = $_POST["email"];
	$Question["phone"] = $_POST["phone"];
	if($_POST['enabled']=='1')
		$Question["enabled"]=1;
	else
		$Question["enabled"]=0;
	

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
		
		
		$faq = $cDeep->obj['DB']->selectRow("select * from `t_support` where `fid`=?d", $Question["fid"]);
		
		
		if($Question["Answer"] && $Question["Answer"]!=$faq['Answer'])
		{
			$cDeep->assign("answer", $Question["Answer"]);
			$cDeep->assign("question", $faq['Question']);
			$cDeep->assign("email", $faq['email']);

		};


			$tQuery = "UPDATE t_support "
			."SET `Question`=?, "
			."`Answer`=?, "
			."`category`=?, "
			."`Name`=?, "
			."`date`=?, "
			."`Enabled` = ? "
			."WHERE `fid`=?d LIMIT 1 ;";
			$hResult = $cDeep->obj['DB']->query($tQuery,$Question["Question"],$Question["Answer"],$Question["category"],$Question["Name"],$Question["date"], $Question["enabled"], $Question["fid"] );
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
	
	//$tQuery_base = "SELECT * FROM t_support{ WHERE fid=?d} ORDER BY `fid` DESC"; //
	//$Faq["questions"] = $cDeep->obj['DB']->select($tQuery,$faqId,$start,$max);
	
	

	
	
	if(is_int($faqId))
	{
		
		$tQuery = "SELECT * FROM t_support{ WHERE fid=?d} ORDER BY `fid` DESC"; //
		$Faq["questions"] = $cDeep->obj['DB']->select($tQuery,$faqId,$start,$max);
		
	}
	else
	{
		
				if($_GET['currentcategory']=='all' || $_GET['currentcategory']=='')
				{
					
					$tQuery = "SELECT * FROM `t_support` ORDER BY `fid` DESC  LIMIT ?d, ?d"; //
					$Faq["questions"] = $cDeep->obj['DB']->select($tQuery,$start,$max);
					$tQuery = "SELECT COUNT(`fid`) AS count FROM t_support "; //
					$Page['count'] = $cDeep->obj['DB']->selectCell($tQuery);

				}
				else
				{
					$tQuery = "SELECT * FROM `t_support` where `category`=? ORDER BY `fid` DESC  LIMIT ?d, ?d"; //
					$Faq["questions"] = $cDeep->obj['DB']->select($tQuery,$_GET['currentcategory'], $start,$max);
					$tQuery = "SELECT COUNT(`fid`) AS count FROM `t_support` where `category`=?"; //
					$Page['count'] = $cDeep->obj['DB']->selectCell($tQuery,$_GET['currentcategory']);
				};
				
	};

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