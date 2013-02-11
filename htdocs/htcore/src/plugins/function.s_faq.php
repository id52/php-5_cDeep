<?

function cDeep_function_s_faq($params, &$cDeep)
{

	$cDeep->assign("currentcategory", $_GET['currentcategory']);
	$categories=$cDeep->obj['DB']->query('select * from `t_support_categories` order by `order` desc');
	
	
	$cDeep->assign("categories", $categories);


	$tpl = $params["tpl"];

	$max = $params["max"]?(int)$params["max"]:20;
	$Page['current'] = (intval($_REQUEST['p'])>1)?(intval($_REQUEST['p'])):1;
	$start = ($Page['current']-1)*$max;
	
	$on_date = $params["on_date"]?$params["on_date"]:0;

	$print_form = $params["print_form"];

	#####################################################################################
	$Faq= array();
	$action = array();
	$cDeep->Deep->SYS = $cDeep->_tpl_vars["SYS"];
	if($_POST["action"] == "addQuestion")
	{
		$Question["Name"] = $_POST["Name"];
		$Question["enabled"] = $_POST["enabled"];
		$Question["publish"] = $_POST["publish"];
		$Question["category"] = $_POST["category"];
		$Question["Question"] = $_POST["Question"];
		$Question["Company"] = $_POST["Company"];
		$Question["email"] = $_POST["email"];
		$Question["phone"] = $_POST["phone"];
		
		
		$Question["ip"] = $cDeep->Deep->SYS["VARS"]["SERVER"]["REMOTE_ADDR"]."-".getenv('HTTP_X_FORWARDED_FOR');

		if(!empty($Question["Name"]) && !empty($Question["Question"]) && ($_POST["code"] == $_SESSION["code"]) && !empty($_POST["code"]) && !empty($_SESSION["code"])  )
		{

			$Filter = new Filter;
			$Question = $Filter->html_filter($Question);
			############
			$tQuery = "INSERT INTO t_support "
			." ( `fid` , `date` , `ip` , `Name` , `Company` , `email` , `phone` , `Question` , `Answer` , `enabled`,`publish`,`category` )"
			." VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, '', ?,?,?);";
			$hResult = $cDeep->obj['DB']->query($tQuery,date("Y-m-d H:i:s"),$Question["ip"],$Question["Name"],$Question["Company"],$Question["email"],$Question["phone"],$Question["Question"],$Question["enabled"], $Question["publish"],$Question["category"]);
			############
			
			foreach($categories as $category)
			{
				if($category['id']==$Question["category"])
					$categoryName=$category['name'];
			};
			
			$max_fid = $cDeep->obj['DB']->selectCell("SELECT max(`fid`) FROM `t_support`");
			

			$adminemail=$cDeep->obj['DB']->selectCell("select `value` from `settings` where `name`='adminemail'");
			$body="Новый вопрос на сайте <a href='http://".$_SERVER['HTTP_HOST']."/sadm/faq/".$max_fid .".html'>".$_SERVER['HTTP_HOST']."</a><br><h2>Имя:</h2>".$Question['Name']."<h2>Email:</h2>".$Question['email']."<h2>Вопрос: </h2>".$Question['Question']."<h4>Категория: </h4>".$categoryName."";
			$subject="Новый вопрос в гостевой ".$_SERVER['HTTP_HOST']."";
			Sendmail::sendme($adminemail,$subject, $body);
			

			$Question = array();
			$action["added"]=true;
			$_SESSION["code"] = rand(1,900);
			

		}
		elseif(!empty($_REQUEST['action']) && $_REQUEST['action']=="addQuestion")
		{
			if(empty($Question["Name"]))
			{
				$action["emptyName"]=true;
			}
			if(empty($Question["Question"]))
			{
				$action["emptyQuestion"]=true;
			}
            if(empty($Question["email"]))
            {
                $action["emptyEmail"]=true;
            } else {
                switch ( checkmail($Question["email"]) ){
                	case 1:
                    case -1:
						$action["emptyEmail"]=true;
                        break;
					default:
                        $action["emptyEmail"]=false;
                        break;
                } 			
            }			
			if(($_POST["code"] !== $_SESSION["code"]) || empty($_POST["code"]) || empty($_SESSION["code"]) )
			{
				$action["emptyCode"]=true;
			}
			$Faq['return'] = $Question;
		}
	}
	else
	{
		$action["listing"]=true;
	}

	#$_SESSION['code'] = rand(1000,9999);
	$Faq["action"] = $action;



	if($_GET['currentcategory']=='all' || $_GET['currentcategory']=='')
	{
		$tQuery = "SELECT `fid`, DATE_FORMAT(`date`, '%d.%m.%Y') AS formated_date, `date`, `Name`,`Question`,`Answer` FROM t_support WHERE `enabled`!='0' ORDER BY `date` DESC LIMIT ?d, ?d"; 
		$Faq["questions"] = $cDeep->obj['DB']->select($tQuery, $start, $max);
		$tQuery = "SELECT COUNT(`fid`) AS count FROM t_support WHERE `enabled`!='0'"; //
		$Page['num'] = $cDeep->obj['DB']->selectCell($tQuery);
	}
	else
	{
		
		$tQuery = "SELECT `fid`, DATE_FORMAT(`date`, '%d.%m.%Y') AS formated_date, `date`, `Name`,`Question`,`Answer` FROM t_support WHERE `enabled`!='0' and `category`=? ORDER BY `date` DESC LIMIT ?d, ?d"; 
		$Faq["questions"] = $cDeep->obj['DB']->select($tQuery, $_GET['currentcategory'], $start, $max);
		$tQuery = "SELECT COUNT(`fid`) AS count FROM `t_support` WHERE `enabled`!='0' and `category`=?"; 
		$Page['num'] = $cDeep->obj['DB']->selectCell($tQuery, $_GET['currentcategory']);
		
	};
	
	
    
	$Page['count']		= ceil($Page['num']/$max);
	$Page['max']		= $max;
	$Page['current']	= $Page['current'];
	$Page['next']		= ($Page['current'] < $Page['count'])?($Page['current'] + 1):0;
	$Page['last']		= ($Page['current'] > 1)?($Page['current'] - 1):0;
	
	
	
	

	
	#print "<pre>".print_r($Faq["questions"],1)."</pre>";
	
	$Page['messages'] = count($Faq["questions"]);

	
	if(empty($tpl))
	{
		$cDeep->trigger_error("[s_faq] undefined template", E_USER_WARNING);
		$result = "<!-- s_faq error [undefined template] -->";
	}
	else
	{
		$cDeep->assign("Page", $Page);
		#print_r($Faq);
		$cDeep->assign("Faq", $Faq);
		$result = $cDeep->fetch($tpl);
	}
	
	return $result;

}


// доп. функция для удаления опасных сиволов
function pregtrim($str) {
   return preg_replace("/[^\x20-\xFF]/","",@strval($str));
}

//
// проверяет мыло и возвращает
//  *  +1, если мыло пустое
//  *  -1, если не пустое, но с ошибкой
//  *  строку, если мыло верное
//

function checkmail($mail) {
   // режем левые символы и крайние пробелы
   $mail=trim(pregtrim($mail)); // функцию pregtrim() возьмите выше в примере
   // если пусто - выход
   if (strlen($mail)==0) return 1;
   if (!preg_match("/^[a-z0-9_-]{1,20}@(([a-z0-9-]+\.)+(com|net|org|mil|".
   "edu|gov|arpa|info|biz|inc|name|[a-z]{2})|[0-9]{1,3}\.[0-9]{1,3}\.[0-".
   "9]{1,3}\.[0-9]{1,3})$/is",$mail))
   return -1;
   return $mail;
}

?>