<? 
function cDeep_function_mailer($params, &$cDeep) {
    $tpl = $params["tpl"];
    
    $Form = array();
    $action = array();
    #$cDeep->Deep->SYS = $cDeep->_tpl_vars["SYS"];
    if ($_POST["action"] == "addQuestion") {
    	
		$tmp = $_POST["form"];
		
        $Question["Name"] = $tmp["Name"];
        $Question["Question"] = $tmp["Question"];
        $Question["email"] = $tmp["Mail"];
        $Question["ip"] = $cDeep->Deep->SYS["VARS"]["SERVER"]["REMOTE_ADDR"]."-".getenv('HTTP_X_FORWARDED_FOR');

        if (! empty($Question["Name"]) && ! empty($Question["Question"]) && ! empty($Question["email"]) && ! empty($_POST["code"]) && ($_POST["code"] == $_SESSION["code"])) {
        
            $Filter = new Filter;
            $Question = $Filter->html_filter($Question);
            $_SESSION["code"] = rand(1, 900);
			
			if (!eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$Question["email"])){
             $action["emptyMail"] = true;   
			} else {
			 $action["send"] = true;
			}
			$Form['return'] = $Question;
            $Form['action'] = $action;			
            
        } elseif (! empty($_REQUEST['action']) && $_REQUEST['action'] == "addQuestion") {
            if ( empty($Question["Name"])) {
                $action["emptyName"] = true;
            }
            if ( empty($Question["Question"])) {
                $action["emptyQuestion"] = true;
            }
            if (($_POST["code"] !== $_SESSION["code"])) {
                $action["emptyCode"] = true;
				#print $_POST["code"]. " = ". $_SESSION["code"];
            }
            if ( empty($Question["email"]) || !eregi("^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$",$Question["email"])) {
                $action["emptyMail"] = true;
            }
            $Form['return'] = $Question;
			$Form['action'] = $action;
        }
        $cDeep->assign("form", $Form);
		$result = $cDeep->fetch($tpl);
    } else {
        if ( empty($tpl)) {
            $cDeep->trigger_error("undefined template", E_USER_WARNING);
            $result = "<!-- s_faq error [undefined template] -->";
        } else {
			$result = $cDeep->fetch($tpl);
        }
    }
    return $result;
}
?>
