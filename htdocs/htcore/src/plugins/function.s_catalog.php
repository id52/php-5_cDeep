<? 




function _getTop($mmid, &$cDeep, $tpl = "file:catalog/top.tpl.php") {
    $tQuery = "SELECT * FROM `t_menu` WHERE `mgid`=?d AND `is_group`=1 AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC LIMIT 20";
    $dResult = $cDeep->obj['DB']->select($tQuery, $mmid);
    $Items = $dResult;
    $num = count($dResult);
    $cDeep->assign("Items", $Items);
    return $cDeep->fetch($tpl);
}

function _addItem($item, $mmid, &$cDeep) {

    $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mid`=?d AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC";
    $hResult = $cDeep->obj['DB']->select($tQuery, $mmid, $item);
	
	
	
    while (list(, $dResult) = each($hResult)) {
        $Items[] = $dResult;
        $mid = $dResult["mid"];
        $mgid = $dResult["mgid"];
		$mprice=$dResult["mprice"];
		$count = ($_REQUEST["count"])?$_REQUEST["count"]:1;
        $_SESSION["catalog"]["cart"][$mid]["count"]+=$count;
        $_SESSION["catalog"]["num"]+=$count;
		$_SESSION["catalog"]["summ"]+=$mprice*$count;
		
		$_SESSION["catalog"]["cart"][$mid]["sizes"][]=$_GET['size'];
		$_SESSION["catalog"]["cart"][$mid]["count_values"]=array_count_values($_SESSION["catalog"]["cart"][$mid]["sizes"]);
	//foreach ($_SESSION["catalog"]["cart"][$mid]["sizes"][]
	//foreach ($_SESSION["catalog"]["cart"][$mid]["sizes"] as $element)
	//	{
	//			$hash[$mid][$element]++;
	//		$_SESSION["catalog"]["cart"][$mid]["sizes3"][$element]++;
	//}

        
		if ( empty($_REQUEST["url"])) {
            $store_result_here = getSelfUrl($mgid, $mmid, &$cDeep);
            $store_result_here = array_reverse($store_result_here);
            array_push($store_result_here, $mgid);
            array_shift($store_result_here);
            $reallink = implode("/", $store_result_here);
            $_SESSION["catalog"]["cart"][$mid]["url"] = "/".$reallink."/";
        } else {
            $_SESSION["catalog"]["cart"][$mid]["url"] = "/".implode("/", $_REQUEST["url"])."/";
        };
		$_SESSION["catalog"]["cart"][$mid]["size"] = $_GET['size'];
    };
	
	$_SESSION["catalog"]["cart"]['out']=count($_SESSION["catalog"]["cart"]);
    $cDeep->assign("Items", $Items);
	
	
	//header("Location: ".$_SERVER['HTTP_REFERER']);
	
    return $cDeep->fetch("file:catalog/add.tpl.php");
}

function _getItem2($item, $mmid, &$cDeep, $params = array()) 
{

$address= $_SERVER['REQUEST_URI'];
	$u=split("/",$address);
	for($i=2;$i<count($u);$i++)
		$adr=$adr.'/'.$u[$i];
		
$mid=$u[count($u)-1];

$tQuery = "SELECT * FROM `t_menu` WHERE `mid`=?";
$items = $cDeep->obj['DB']->select($tQuery, $mid);
$Photo = $cDeep->obj['DB']->select('SELECT * FROM `t_menu_files` WHERE `gid`=?d ORDER BY `Order`', $mid);

	foreach($items as &$dd)
	{
		if($dd['size']) 
		{
			$splits=split(",",$dd['size']);
			foreach($splits as $split)
			{
				$split=strtoupper(trim($split));
				$dd['sizes'][]=$split;

			};
			$dd['issize']=1;
		};
	};



$cDeep->assign('Photo', $Photo);
$cDeep->assign("Item", $items);
};

function _getItem($item, $mmid, &$cDeep, $params = array()) {


    $link = '';
    foreach ($cDeep->State['Item'] as $value) {
        if ((int) $value) {
            $link .= $value."/";
        }
    }

    $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mid`=?d AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC";
    $dResult = $cDeep->obj['DB']->select($tQuery, $mmid, $item);
    $Items = $dResult;
	
	
	foreach($Items as &$dd)
	{
		if($dd['size']) 
		{
			$splits=split(",",$dd['size']);
			foreach($splits as $split)
			{
				$split=strtoupper(trim($split));
				$dd['sizes'][]=$split;

			};
			$dd['issize']=1;
		};
	};



    $num = count($dResult);
    
    $Items[0]['looklike'] = unserialize($Items[0]['looklike']);
    $Items[0]['buywith'] = unserialize($Items[0]['buywith']);
    
    #print "<pre>".print_r($Items,1)."</pre>";
    $cDeep->assign("Item", $Items);
    $cDeep->State['Path'][] = array('Title'=> $Items[0]['mname']);
	
	
    $store_result_here = getSelfUrl($dResult[0]['mgid'], $mmid, &$cDeep);
    $store_result_here = array_reverse($store_result_here);
    array_push($store_result_here, $dResult[0]['mgid']);
    array_shift($store_result_here);
    $reallink = implode("/", $store_result_here);
    if ($link !== $reallink."/" && ! empty($reallink)) {
        header("Location: /catalog/".$reallink."/item[".$item."].xml");
    }
    
    if (! empty($Items[0]['looklike'])) {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mid` IN (?a) ORDER BY `mid` ASC";
        $ItemsLookLike = $cDeep->obj['DB']->select($tQuery, $Items[0]['looklike']);
        $cDeep->assign("LookLike", $ItemsLookLike);
    }
    if (! empty($Items[0]['buywith'])) {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mid` IN (?a) ORDER BY `mid` ASC";
        $ItemsBuyWith = $cDeep->obj['DB']->select($tQuery, $Items[0]['buywith']);
        $cDeep->assign("BuyWith", $ItemsBuyWith);
    }
    
    $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=1 AND `mid`=?d AND `enabled`=1 LIMIT 1";
    $dResult = $cDeep->obj['DB']->selectRow($tQuery, 0, $dResult[0]['mgid']);
    $cDeep->assign("Group", $dResult);
    
	/*добавить фотки*/
	$Photo = $cDeep->obj['DB']->select('SELECT * FROM `t_menu_files` WHERE `gid`=?d ORDER BY `Order`', $item);
    $cDeep->assign('Photo', $Photo);
	
    return $cDeep->fetch("file:catalog/info.tpl.php");
}

function _getItems($group, $mmid, &$cDeep, $params = array()) {
    $max = $params["max"] ? (int) $params["max"] : 9;
	//$max=$params["max"];
    $Page['current'] = (intval($_REQUEST['p']) > 1) ? (intval($_REQUEST['p'])) : 1;
    $start = ($Page['current'] - 1) * $max;
    
    $link = 'url[]=';
    foreach ($cDeep->State['Item'] as $key=>$value) {
        if ((int) $value) {
            $link .= $value;
            if ($key != count($cDeep->State['Item']) - 1) {
                $link .= "&url[]=";
            }
        }    
    }
	#это адрес товара в каталоге, при добавлении в корзину он идет с товаром
    $cDeep->assign("cat_link", $link);
    

	$tQuery = "SELECT COUNT(`mid`) FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mgid`=?d AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC";
	$Page['num'] = $cDeep->obj['DB']->selectCell($tQuery, $mmid, $group);
	
	
	switch ($_GET['orderby']) 
	{
	
		case 'mprice':	$tQuery="SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mgid`=?d AND `enabled`=1 ORDER BY `mprice` ".$_GET['desc']." LIMIT ?d, ?d" ;break;
		case 'mname':	$tQuery="SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mgid`=?d AND `enabled`=1 ORDER BY `mname` ".$_GET['desc']." LIMIT ?d, ?d" ;break;
		default: $tQuery="SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mgid`=?d AND `enabled`=1 ORDER BY `mprice` LIMIT ?d, ?d" ;break;

	};
	
	
	
	$dResult = $cDeep->obj['DB']->select($tQuery, $mmid, $group, $start, $max);
	$cDeep->assign('orderby',$_GET['orderby']);
	$cDeep->assign('desc',$_GET['desc']);

	/*
	//размеры
	
	if(!$_GET['mpriceFrom']) $_GET['mpriceFrom']=0;
	if(!$_GET['mpriceTo']) $_GET['mpriceTo']=1000000;
	
	$sizes=$cDeep->obj['DB']->query('select * from `sizes` order by `size` ASC');
	
//	$cDeep->assign('size',$_GET['size']);

	foreach($sizes as &$size)
	{
		if (in_array($size['size'], $_GET['size']))
			$size['checked']='checked';
	};

	$cDeep->assign('sizes',$sizes);
	
	foreach($_GET['size'] as $k=>$g)
	{
		$i++;
		if(count($_GET['size'])==$i) 
			$str=$str." `size` like '%$g%' ";
		else
			$str=$str." `size` like '%$g%' OR ";
	
	};
	

	if($str)
	{
		$tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mgid`=?d AND `enabled`=1 AND `mprice`>=? AND `mprice`<? AND (!size OR (".$str." )) ORDER BY `mprice` ASC, `mname` DESC";
		$dResult = $cDeep->obj['DB']->select($tQuery,$mmid, $group,$_GET['mpriceFrom'], $_GET['mpriceTo']);
		
		
	}
	
	if (empty($dResult))
	{
		
		$tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mgid`=?d AND `enabled`=1 AND `mprice`>=? AND `mprice`<?  ORDER BY `mprice` ASC, `mname` DESC";
		$dResult = $cDeep->obj['DB']->select($tQuery,$mmid, $group,$_GET['mpriceFrom'], $_GET['mpriceTo']);
		if($str) $dResult='f';
	};
	
	
	
	
	
	$cDeep->assign('size',$_GET['size']);
	if($_GET['mpriceTo']==1000000) $_GET['mpriceTo']='';
	$cDeep->assign('mpriceFrom',$_GET['mpriceFrom']);
	$cDeep->assign('mpriceTo',$_GET['mpriceTo']);

	
	*/
	
	
	
	$Items = $dResult;
	  
	  
	foreach($Items as &$dd)
	{
		if($dd['size']) 
		{
			$splits=split(",",$dd['size']);
			foreach($splits as $split)
			{
				$split=strtoupper(trim($split));
				$dd['sizes'][]=$split;
				
				
			};
			$dd['issize']=1;
		};
	};
	  
	  
	  
		
	foreach ($Items as $i=>$value) 
	{
		$sizes[]=$value['size'];
		$tmp = array();
		$tmp = unserialize($value['looklike']);
		$tmp = (!empty($tmp[0]))?count($tmp):0;
		$Items[$i]['looklike'] = $tmp;
	};
	
	
	
	#print_r($Item);
    $num = count($dResult);
    $cDeep->assign("Items", $Items);

    
    $Page['count'] = ceil($Page['num'] / $max);
    $Page['max'] = $max;
    $Page['current'] = $Page['current'];
    $Page['next'] = ($Page['current'] < $Page['count']) ? ($Page['current'] + 1) : 0;
    $Page['last'] = ($Page['current'] > 1) ? ($Page['current'] - 1) : 0;
    $cDeep->assign("Page", $Page);
    return '';
}

function _getMainItems($limit, &$cDeep, $order = 'is_group') {
    $tQuery = "SELECT * FROM `t_menu` WHERE `enabled`=1 AND `ismain`=1 ORDER BY ".$order." DESC {LIMIT ?d}";
    $dResult = $cDeep->obj['DB']->select($tQuery, ($limit > 0) ? $limit : DBSIMPLE_SKIP);
    
	
	foreach($dResult as &$dd)
	{
		if($dd['size']) 
		{
			$splits=split(",",$dd['size']);
			foreach($splits as $split)
			{
				$split=strtoupper(trim($split));
				$dd['sizes'][]=$split;

			};
			$dd['issize']=1;
		};
	};
	
	
    foreach ($dResult as $key=>$row){
        
		if ($row['is_group']){
          $_url = getSelfUrl($row['mid'], 0, &$cDeep);
          $_url = array_reverse($_url);
		  array_push($_url, $row['mid']."/");
		}else{
          $_url = getSelfUrl($row['mgid'], 0, &$cDeep);
          $_url = array_reverse($_url);
		  array_push($_url, $row['mgid'], "item[".$row['mid']."].xml");
		}
		array_shift($_url);		
	    $url = implode("/", $_url);
		
        
		$dResult[$key]['url'] = $url;
		$_url = array(); $url = ''; 
	}
	
	$cDeep->assign("Items", $dResult);
    $cDeep->assign("Groups", $dResult);
    return '';
}


function _getCart($mmid, &$cDeep) {

foreach($_POST['count_values'] as $mid=>$cv)
{
	$_SESSION['catalog']['cart'][$mid]['count_values']=$cv;
};



    $Items = array();
    $_SESSION["catalog"]["cart"] = is_array($_SESSION["catalog"]["cart"]) ? $_SESSION["catalog"]["cart"] : array();
    
    while (list($item, $quantity) = each($_SESSION["catalog"]["cart"])) {
        if ((int) $quantity > 0 && (!isset($_REQUEST["cart"][$item]["count"]) || (int) $_REQUEST["cart"][$item]["count"] !== 0)) {
		
            $Items[] = intval($item);
        }
    }
    
    $subQuery = (count($Items) > 0) ? "(`mid`=".implode(" OR `mid`=", $Items).")" : "";
    
    $i = 0;
    $all = 0;
    $summ = 0;
    $Items = array();
    $incart = array();
    if (! empty($subQuery)) {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`='?' AND `is_group`=0 AND `enabled`=1 AND ".$subQuery." ORDER BY `morder` ASC, `mname` ASC";
        #print_r($tQuery);
        $hResult = $cDeep->obj['DB']->select($tQuery, $mmid);
        while (list(, $dResult) = each($hResult)) {
            $Items[$i] = $dResult;
            $mid = $dResult["mid"];
            $incart[$mid]["count"] = isset($_REQUEST["cart"][$mid])?(int)$_REQUEST["cart"][$mid] : $_SESSION["catalog"]["cart"][$mid]["count"];
			foreach($_SESSION['catalog']['cart'][$mid]['count_values'] as $size=>$count)
			{
				if(!$count) 
				{
					unset($_SESSION['catalog']['cart'][$mid]['count_values'][$size]);
					continue;
				};
				$count2[$mid]=$count2[$mid]+$count;
			}
			
			if($count2[$mid]) $incart[$mid]["count"]=$count2[$mid];
			if($_SESSION["catalog"]["cart"][$mid]["count_values"] && !$count2[$mid])
				$incart[$mid]["count"]=0;
			
            $incart[$mid]["url"] = $_SESSION["catalog"]["cart"][$mid]["url"];
			$incart[$mid]["size"] = $_SESSION["catalog"]["cart"][$mid]["size"];
			$incart[$mid]["count_values"] = $_SESSION["catalog"]["cart"][$mid]["count_values"];
			$incart[$mid]["mprice"]=$Items[$i]["mprice"];
			
			//$Items[$i]["count2"] = $incart[$mid]["count2"];
			$Items[$i]["count_values"] = $incart[$mid]["count_values"];
            $Items[$i]["num"] = $incart[$mid]["count"];
			$Items[$i]["size"] = $incart[$mid]["size"];
            $Items[$i]["url"] = $incart[$mid]["url"];
            $Items[$i]["summ"] = $Items[$i]["mprice"] * $incart[$mid]["count"];
            $summ += $Items[$i]["summ"];

            $all += $incart[$mid]["count"];
            $i++;

        }
    }
    
    $_SESSION["catalog"]["cart"] = $incart;
    $_SESSION["catalog"]["num"] = $all;
	$_SESSION["catalog"]["summ"] = $summ;

	$address= $_SERVER['REQUEST_URI'];
	$u=split("/",$address);
	for($i=2;$i<count($u);$i++)
		$adr=$adr.'/'.$u[$i];
	$location=$u[1];
    $location2=$u[2];
	

    if (isset($_REQUEST["cart"])) {
		//header("Location: /catalog/cart/");
	
    }
    
    $cDeep->assign("num", $i);
    $cDeep->assign("Items", $Items);
    $cDeep->assign("summ", $summ);
    $cDeep->assign("all", $all);
    
    return $cDeep->fetch("file:catalog/cartlist.tpl.php");
}

function _sendCartForm(&$cDeep) {
    $emptyfields = array();
	if($_POST['action'] == 'send'){
	/////////////////////////////////

	    $form = GLOBALS::REQUEST('form');
        foreach ($form as $key=>$val) {
           if (!empty($val)) {
              $val = strip_tags($val);
              $form[$key] = mysql_real_escape_string($val);
           } else {
           	  $emptyfields[$key] = true;
           }
        }
		if ($emptyfields['oranization'] || $emptyfields['person'] || $emptyfields['phone']){
		    $cDeep->assign("form", $form);
		    $cDeep->assign("error", $emptyfields);
	        return $cDeep->fetch("file:catalog/cartform.tpl.php");	
		} else {	
			$cDeep->assign("form", $form);
			return _sendCart($mmid, &$cDeep);
		}
	} else { return $cDeep->fetch("file:catalog/cartform.tpl.php"); }
}

function _sendCart($mmid, &$cDeep) {
    $Items = array();
    $_SESSION["catalog"]["cart"] = is_array($_SESSION["catalog"]["cart"]) ? $_SESSION["catalog"]["cart"] : array();
    
    while (list($item, $quantity) = each($_SESSION["catalog"]["cart"])) {
        if ((int) $quantity > 0) {
            $Items[] = intval($item);
        }
    }
    
    $subQuery = (count($Items) > 0) ? "(`mid`=".implode(" OR `mid`=", $Items).")" : "";
    
    $i = 0;
    $all = 0;
    $summ = 0;
    $Items = array();
    $incart = array();
    if (! empty($subQuery)) {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`='?' AND `is_group`='0' AND `enabled`='1' AND ".$subQuery." ORDER BY `morder` ASC, `mname` ASC";
        $hResult = $cDeep->obj['DB']->select($tQuery, $mmid);
        while (list(, $dResult) = each($hResult)) {
            $Items[$i] = $dResult;
            $mid = $dResult["mid"];
            $incart[$mid]['count'] = $_SESSION["catalog"]["cart"][$mid]['count'];
			$incart[$mid]['url'] = $_SESSION["catalog"]["cart"][$mid]['url'];
            $Items[$i]["num"] = $incart[$mid]['count'];
			$Items[$i]["url"] = $incart[$mid]['url'];
            $Items[$i]["summ"] = $Items[$i]["mprice"] * $incart[$mid]['count'];
            $summ += $Items[$i]["summ"];
            $all += $incart[$mid]['count'];
            $i++;
        }
    }
    #print_r($_SESSION["catalog"]["cart"]);
    /*$_SESSION["catalog"]["cart"] = $incart;
    $_SESSION["catalog"]["num"] = $all;*/
	$_SESSION["catalog"]["cart"] = array();
    $_SESSION["catalog"]["num"] = 0;
	$_POST['form'] = array();
    
    $cDeep->assign("num", $i);
    $cDeep->assign("summ", $summ);
    $cDeep->assign("all", $all);
    $cDeep->assign("Items", $Items);
    return $cDeep->fetch("file:catalog/cartsend.tpl.php");
}

function _searchItems($search, $group, $mmid, &$cDeep) {

    $minlen = 2;
    $Items = array();
    $i = 0;
    if (strlen($search) > $minlen) {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`='?' AND `is_group`='0' AND `enabled`='1' AND ";
        $tQuery .= "(";
        $aSearch = preg_split("/[\s,]+/", $search);
        $fSearch = array();
        $r = 0;
        $c = count($aSearch);
        while ($r < $c) {
            $tQuery .= (strlen($aSearch[$r]) > $minlen) ? "`mname` LIKE '%".mysql_real_escape_string($aSearch[$r])."%' OR " : "";
            if (trim($aSearch[$r])) {
                $fSearch[] = trim($aSearch[$r]);
            }
            $r++;////
        }
        $tQuery .= "0=1 )";
        $tQuery .= "ORDER BY `morder` DESC";
        $replacment = "/".implode("|", $fSearch)."/i";
        $hResult = $cDeep->obj['DB']->select($tQuery, $mmid);
        while (list(, $Result) = each($hResult)) {
            $dResult[$i] = $Result;
            $dResult[$i]["mname"] = preg_replace($replacment, "<span class='fined'>\\0</span>", $dResult[$i]["mname"]);
            $i++;
        }
        $Items = $dResult; //["Result"];
    } else {
        $search = '';
    }
    $cDeep->assign("Items", $Items);
    $cDeep->assign("Count", $i);
    $cDeep->assign("search", $search);
    return $cDeep->fetch("file:catalog/search.tpl.php");
}

function _getGroup($group, $mmid, &$cDeep, $params = array()) {
    global $z;
    $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=1 AND `mgid`=?d AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC";
    $hResult = $cDeep->obj['DB']->select($tQuery, $mmid, $group);
    $cDeep->assign("Groups", $hResult);
    return '';
}


function _getSelfGroup($group, $mmid, &$cDeep) {
    if (strpos($group, "item") !== false) {
        $tmp_item = preg_split('/\]|\[/', $group, 5, PREG_SPLIT_NO_EMPTY);
        $item = (int) $tmp_item[1];
    }
    if (! empty($item)) {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mid`=?d AND `enabled`=1 LIMIT 1";
        $group = $item;
    } else {
        $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=1 AND `mid`=?d AND `enabled`=1 LIMIT 1";
    }
    $dResult = $cDeep->obj['DB']->selectRow($tQuery, $mmid, $group);
    
    $cDeep->assign("Groups", $dResult);
	return $dResult;
}

function getSelfUrl($group, $mmid, &$cDeep, &$store_result_here = array()) {
    if ($group) {
        $tQuery = "SELECT `mgid` FROM `t_menu` WHERE `mmid`=?d AND `is_group`=1 AND `mid`=?d AND `enabled`=1 LIMIT 1";
        $dResult = $cDeep->obj['DB']->selectCell($tQuery, $mmid, $group);
        $store_result_here[] = $dResult;
        getSelfUrl($dResult, $mmid, &$cDeep, &$store_result_here);
    } else {
        return $store_result_here;
    }
    return $store_result_here;
}
////////////////////////
function GroupIteratorIterator($PID, $Groups, $Level=0) {
	$Gr = array();
	if ($Groups[$PID]) {
		foreach ($Groups[$PID] as $G) {
			$G['Level'] = $Level;
			$G['pad'] = str_repeat('&nbsp;&nbsp;&nbsp;', $Level);
			$Gr[] = $G;
			if ($Groups[ $G['mid'] ]) {
				$Gr = array_merge($Gr, GroupIteratorIterator($G['mid'], $Groups, ($Level+1)));
			}
		}
	}

	return $Gr;
};
function GroupIterator($Groups) {
	$PIDs = array_keys($Groups);
	return GroupIteratorIterator($PIDs[0], $Groups);
};
////////////////////////

function cDeep_function_s_catalog($params, &$cDeep) {

    $mmid = (int) $params["mmid"];
    $group = $params["group"];
    $item = (int) $params["item"];


    $id=$cDeep->State['Current_item'];
    if (strpos($cDeep->State['Current_item'], "item") !== false) {
        $tmp_item = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
        $item = (int) $tmp_item[1];
        $id=$item;
    }
    
$tQuery = "SELECT `keywordsmeta` FROM `t_menu` WHERE `mid`=?d";
$keywordsmeta = $cDeep->obj['DB']->selectCell($tQuery, $id);

$tQuery = "SELECT `descriptionmeta` FROM `t_menu` WHERE `mid`=?d";
$descriptionmeta = $cDeep->obj['DB']->selectCell($tQuery, $id);

$tQuery = "SELECT `mname` FROM `t_menu` WHERE `mid`=?d";
$mname = $cDeep->obj['DB']->selectCell($tQuery, $id);

$cDeep->State['descriptionmeta']=$descriptionmeta;
$cDeep->State['keywordsmeta']=$keywordsmeta;
$cDeep->State['titlemeta']=$mname;

    $limit = (int) $params["limit"];
    $search = urldecode($_REQUEST["search"]);
    #$search = $_REQUEST["search"];
    $search = substr($search, 0, 200);
    #################################
	
	
///$baldininiid =$cDeep->obj['DB']->query("select `mid` from `t_menu` where `mname`='baldinini'");
//$baldininiid=intval($baldininiid);
//$fabiid =$cDeep->obj['DB']->query("select `mid` from `t_menu` where `mname`='fabi'");
//$fabiid=intval($fabiid);
//$cDeep->assign('baldininiid', $baldininiid);
//$cDeep->assign('fabiid', $fabiid);	
	

	
    switch ($params["action"]) {
        case "add":

		
            if (! empty($item)) {
                $content = _addItem($item, $mmid, &$cDeep);
            }
			
            break;
            
			
		case "initids":

			$baldininiid =$cDeep->obj['DB']->selectCell("select `mid` from `t_menu` where `mname`='baldinini'");
			$baldininiid=intval($baldininiid);
			$fabiid =$cDeep->obj['DB']->selectCell("select `mid` from `t_menu` where `mname`='fabi'");
			$fabiid=intval($fabiid);
			$cDeep->assign('baldininiid', $baldininiid);
			$cDeep->assign('fabiid', $fabiid);	
	
			break;
        case "cart":
		
            $content = _getCart($mmid, &$cDeep);
            break;
			
		case "cart2":
		
            $content = _getCart2($mmid, &$cDeep);
            break;			
	
            
        case "sendcart":
			if ($_SESSION['catalog']['num']){
				$content = _sendCartForm(&$cDeep);
                #$content .= _sendCart($mmid, &$cDeep);
			}else{
			//header("Location: /catalog/cart/");
			}
            break;
            
        case "search":
            $content = _searchItems($search, $group, $mmid, &$cDeep);
            break;
            
        case "selfgroup":
            $title = _getSelfGroup($group, $mmid, &$cDeep);
            break;
            
        case "top":
            $content = _getTop($mmid, &$cDeep, $params["tpl"]);
            break;
            
        case "item":
		
            $crumbs = array();
			$indexurl = $cDeep->State['Path'][0]['index'];
			
			
            foreach ($cDeep->State['Item'] as $key=>$value) {
                if ((int) $value) {
                    $title = _getSelfGroup($value, $mmid, &$cDeep); 

					$indexurl .= $value.'/'; 
                    $crumbs[] = array('Title'=> $title['mname'], 'index'=> $indexurl);
					
					
                }    
            }
            $cDeep->State['Path'] = array_merge($cDeep->State['Path'],$crumbs);
			
            if (! empty($item)) {
                $content = _getItem($item, $mmid, &$cDeep);
            } else {
                $content = _getItems($group, $mmid, &$cDeep, $params);
            }
			
            break;
            
		case 'item2':
			_getItem2($item, $mmid, &$cDeep);
			 
		break;
			
        case "main":


            $content = _getMainItems($limit, &$cDeep);
	         break;
            
        case "group":
            $content = _getGroup($group, $mmid, &$cDeep, $params);
            break;
            
        case "menu":
            $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=1 AND `mgid`=?d AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC";
            $catmenu = $cDeep->obj['DB']->select($tQuery, $mmid, $group);
            $cDeep->assign("Cat", $catmenu);
            break;
		/*
         case "sidemenu":
            $link = '';
            foreach ($cDeep->State['Item'] as $value) {
                if ((int) $value) {
                    $link .= $value."/";
                }
            }
            if (! empty($item)) {
                $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mid`=?d AND `enabled`=1 LIMIT 1";
                $dResult = $cDeep->obj['DB']->selectRow($tQuery, $mmid, $item);
                $group = $dResult['mgid'];
            }
            
            $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=1 AND `mgid`=?d AND `enabled`=1 ORDER BY `morder` ASC, `mname` ASC";
            $catmenu = $cDeep->obj['DB']->select($tQuery, $mmid, $group);
            
            $cDeep->assign("CatLink", $link);
            $cDeep->assign("Cat", $catmenu);
            break;
			
			
		*/
		
    case "sidemenu":
            $link = '';
            foreach ($cDeep->State['Item'] as $value) {
                if ((int) $value) {
                    $link .= $value."/";
                }
            }
            if (! empty($item)) {
                $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`=0 AND `mid`=?d AND `enabled`=1 LIMIT 1";
                $dResult = $cDeep->obj['DB']->selectRow($tQuery, $mmid, $item);
                $group = $dResult['mgid'];
            }
            
          	$tQuery = "SELECT * FROM `t_menu` WHERE `enabled`=1 and `is_group`=1";
			$catmenu = $cDeep->obj['DB']->select($tQuery);
			
			
			$currentpage=$_SERVER['REQUEST_URI'];
			$cDeep->assign("currentpage",$currentpage);
			$slashcount=substr_count($currentpage, "/");
            $cDeep->assign("slashcount",$slashcount);
			
		
			$u=split("/",$currentpage);
			
			
			
			for($i=0;$i<count($u);$i++)//-2?
				$isactive=$isactive.'/'.$u[$i];
			$isactive=$isactive.'/';
			$cDeep->assign("isactive",$isactive);
						
			
			$z=split("/",$currentpage);
			for($i=2;$i<count($z)-1;$i++)//-1
				$activemids[]=$z[$i];
				
		
	
			
			foreach ($catmenu as &$cat)
			{

					
				if(in_array($cat['mid'], $activemids))
				{
					$cat['active']=true;
					
				};
				
				if($cat['mgid']==0)
					$ur1[]=$cat;

					
			}
			
			

			
			
			
			
			
			foreach ($catmenu as &$cat)
			{
				foreach ($ur1 as $u1)
				if(!in_array($cat,$ur1) && $cat['mgid']==$u1['mid'])
				{
					if(in_array($cat['mid'], $activemids))
					{
						$cat['active']=true;
					}
					$ur2[]=$cat;
					
				}
			}
			
			
			
			foreach ($catmenu as &$cat)
			{
				if(!in_array($cat,$ur1) && !in_array($cat,$ur2))
				{
					if(in_array($cat['mid'], $activemids))
						$cat['active']=true;
					$ur3[]=$cat;
				}
			}
			
			
			foreach ($catmenu as $cat)
			{
				if(!$cat['is_group'])
					$ur4[]=$cat;

			}
			
			$cDeep->assign("ur1", $ur1);
			$cDeep->assign("ur2", $ur2);
			$cDeep->assign("ur3", $ur3);
			$cDeep->assign("ur4", $ur4);
			

			
			
			$GroupList =$cDeep->obj['DB']->select("SELECT *, `mgid` AS ARRAY_KEY_1, `mid` AS ARRAY_KEY_2, (`mid`=?d) AS `selected` FROM `t_menu` where `is_group`=1 and `mimage`!='' ORDER BY `mgid` ASC",2);
			//$GroupList =$cDeep->obj['DB']->select("SELECT *, `mgid` AS ARRAY_KEY_1, `mid` AS ARRAY_KEY_2 FROM `t_menu` where `is_group`=1 and `mimage`!='' ORDER BY `mgid` ASC");
			
			//$cDeep->assign('images', GroupIterator($GroupList));
			
			$address= $_SERVER['REQUEST_URI'];
			$u=split("/",$address);
			$location=$u[1];
			
			
			$cDeep->assign('images', $images);
			
			$pattern ="/^\/catalog\/(\d+)\/(\d+)\/(\d+)\//";
			$replacement = "/catalog/$1/$2/";
			$currentpage2= preg_replace($pattern, $replacement, $currentpage);
			
			$pattern ="/^\/catalog\/(\d+)\/(\d+)\/(\d+)\//";
			$IsHave3rd=preg_match($pattern, $currentpage);
			
			$cDeep->assign("IsHave3rd", $IsHave3rd);
			$cDeep->assign("currentpage2", $currentpage2);
            $cDeep->assign("CatLink", $link);
            $cDeep->assign("Cat", $catmenu);
			
            break;
        default:
            $return = true;
            break;
    }
    
    return $content;
}
?>
