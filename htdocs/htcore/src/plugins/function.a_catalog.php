<?

function deleteRecursive($mid, $cDeep)
{
	$tQuery = "SELECT `mprewiev`, `mimage` FROM `t_menu` WHERE `mid`=?d LIMIT 1";
	$dResult = $cDeep->obj['DB']->selectRow($tQuery, $mid);
	
	$tQuery = "SELECT `mid` AS ARRAY_KEY_1, `mprewiev`, `mimage` FROM `t_menu` WHERE `mgid` IN(?a);";
	$trash = array(
	           'mid'=>array(),
			   'images'=>array()
			 );
	$id_arr = array($mid=>array('mprewiev'=>$dResult['mprewiev'],'mimage'=>$dResult['mimage']));
	$maxsteps = 500;  #чтоб не циклилось, при узлах ссылающихся на родителей — своеобразное ограничение на кол-во вложений которые будут удаляться вглубь каталога
	
	while( !empty($id_arr) && $maxsteps > 0 ) 
	    {  
	        $maxsteps--;
            $trash['mid'] = array_merge($trash['mid'], array_keys($id_arr));
	        $trash['images'] = array_merge($trash['images'], array_values($id_arr));
			$id_arr = $cDeep->obj['DB']->select($tQuery, array_keys($id_arr));
	    } 
	$trash['mid'] = array_unique($trash['mid']);
	if( !empty($trash['mid']) ) 
	    { 
	        $cDeep->obj['DB']->query("DELETE FROM `t_menu` WHERE `mid` IN(?a);", $trash['mid']);
	        foreach ($trash['images'] as $value) {
	        	if ( !empty($value['mimage']) ) {
	        		$src = 'upload/catalog/'.basename ( $value['mimage'] );
                    if (unlink($src)){ print "deleted: ".$src; } else {print "error: ".$src;}
	        	}
				if ( !empty($value['mprewiev']) ){
					$src = 'upload/catalog/'.basename ( $value['mprewiev'] );
                    if (unlink($src)){ print "deleted: ".$src; } else {print "error: ".$src;}
				}
	        }
			$cDeep->obj['DB']->query("DELETE FROM `t_menu_files` WHERE `gid` IN(?a);", $trash['mid']); 
			foreach ($trash['mid'] as $value) {
		        $src = 'upload/catalog/'.$value.'/';
		        if (is_dir($src))
		        {
		            $dir = opendir($src);
		            while ($file=readdir($dir)) {
		                if (is_file($src.$file)) {
		                    unlink($src.$file);
		                }
		            }
		            closedir($dir);
		            rmdir($src);
		        }				
			}
	    }
}

function getItem($group, $mmid, &$cDeep)
{
  $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`=?d AND `is_group`='0' AND `mgid`=?d ORDER BY `morder` ASC, `mname` ASC";
  $dResult = $cDeep->obj['DB']->select($tQuery, $mmid, $group);
  $cDeep->assign("Items", $dResult);
  return ''; //$cDeep->fetch("sadm/catalog/item.tpl.php");
}

function getItemInfo($item, &$cDeep)
{
  $tQuery = "SELECT * FROM `t_menu` WHERE `mid`='".$item."' LIMIT 1";
  $dResult = $cDeep->obj['DB']->selectRow($tQuery);
  
  $dResult['looklike'] = unserialize($dResult['looklike']);
  $dResult['looklike'] = implode(",",$dResult['looklike']);
  $dResult['buywith'] = unserialize($dResult['buywith']);
  $dResult['buywith'] = implode(",",$dResult['buywith']);

  $cDeep->assign("Item", $dResult);
  return '';
}

function getItemAdd($item, &$cDeep)
{
  
  $hResult['is_group'] = GLOBALS::REQUEST('is_group');
  if ($hResult['is_group']){
  	$hResult['mgid'] = $item;
  	#$hResult['mgid'] = $dResult['mgid'];
  }else{
  	$hResult['mgid'] = $item;
  }
  
  $cDeep->assign("Item", $hResult);
  return '';
}

function getGroup($group, $mmid, &$cDeep)
{
  global $z;
  //$tQuery = "SELECT * FROM `t_menu_list` WHERE `mmid`='".$mmid."' AND `is_group`='1' AND `mgid`=".$group." ORDER BY `morder` ASC, `mname` ASC";
  $tQuery = "SELECT * FROM `t_menu` WHERE `mmid`='".$mmid."' AND `is_group`='1' AND `mgid`=".$group." ORDER BY `morder` ASC, `mname` ASC";
  $hResult = $cDeep->obj['DB']->select($tQuery);
  $cDeep->assign("Groups", $hResult);
  return '';
}

function setQuery($mmid, &$cDeep)
{
  $tQuery['action'] = $_REQUEST["faction"];
  
  $mgid = $_POST["mgid"];
  $mname = mysql_real_escape_string($_POST["mname"]);
  $descriptionmeta=$_POST['descriptionmeta'];
  $keywordsmeta=$_POST['keywordsmeta'];
  $mdesc = $_POST["mdesc"];
  
  if(!$keywordsmeta) $keywordsmeta=$mname;
  if(!$descriptionmeta) $descriptionmeta=$mname;
  if(!$_POST['keywordsmeta']) $_POST['keywordsmeta']=$_POST['mname'];
  if(!$_POST['descriptionmeta']) $_POST['descriptionmeta']=$_POST['mname'];
  //
  $mdesc = $_POST["mdesc"];
  $mcomponents = $_POST["mcomponents"];
  
  #$mcomponents = mysql_real_escape_string( $mcomponents );
  
  $maker = mysql_real_escape_string($_POST["maker"]);
  $currency = mysql_real_escape_string($_POST["currency"]);
  $instock = mysql_real_escape_string($_POST["instock"]);
  
  $buywith = mysql_real_escape_string($_POST["buywith"]);
  $buywith = explode(",",$buywith);
  $buywith = serialize($buywith);
  $looklike = mysql_real_escape_string($_POST["looklike"]);
  $looklike = explode(",",$looklike);
  $looklike = serialize($looklike);
  
  $is_group = ($_POST["is_group"]=="1")?1:0;
  $mid = (int)$_REQUEST["mid"]; 
  
  
    if($_POST['urn'])
    {
      $_POST['urn']=Filter::translit($_POST['urn']);
      $urn=$_POST['urn'];
    }
    else
    {
      $_POST['urn']=Filter::translit($_POST['mname']);
      $urn=$_POST['mname'];
    
    }
  
  
   
  #########################################################
  $mprewiev="";
  if (is_uploaded_file($_FILES['mprewiev']['tmp_name']))
  {
    $mprewiev = Filter::translit($_FILES['mprewiev']['name']);
    $mprewiev_new = rand()."_".$mprewiev;
    $mprewiev = "/upload/catalog/".$mprewiev_new;
    #$mprewiev = $mprewiev_new;
    $fullName = getcwd().$mprewiev;
    move_uploaded_file($_FILES['mprewiev']['tmp_name'], $fullName);
  }
  
  $mimage="";
  if (is_uploaded_file($_FILES['mimage']['tmp_name']))
  {
    $mimage = Filter::translit($_FILES['mimage']['name']);
    $mimage_new = rand()."_".$mimage;
    $mimage = "/upload/catalog/".$mimage_new;
	#$mimage = $mimage_new;
    $fullName = getcwd().$mimage;
    move_uploaded_file($_FILES['mimage']['tmp_name'], $fullName);
  }
  #########################################################

  switch($tQuery['action'])
  {
 
    case "add":
  
      if(!empty($mname))
      {
//        $tQuery['query'] = "INSERT INTO `t_menu` ( `mid`, `mmid`, `mgid` , `mname` , `mdesc`, `mcomponents` , `mweight` , `mprice` , `mprewiev`, `mimage`, `morder`, `enabled`, `is_group`, `code`, `maker`, `currency`, `instock`, `buywith`, `looklike`) "
//        ."VALUES ("
//        ."'', '".(int)$mmid."', '".(int)$mgid."', '".$mname."', ?, ?, '".$_POST["mweight"]."', '".(float)$_POST["mprice"]."', '".$mprewiev."', '".$mimage."', '".(int)$_POST["morder"]."', '".(int)$_POST["enabled"]."', '".(int)$is_group."', '".mysql_escape_string($_POST["code"])."', '".$maker."', '".$currency."', '".$instock."', '".$buywith."', '".$looklike."'".");";
        
         $tQuery['query'] = "INSERT INTO `t_menu` ( `mid`, `mmid`, `mgid` , `mname` , `mdesc`, `mcomponents` , `mweight` , `mprice` , `mprewiev`, `mimage`, `morder`, `enabled`, `is_group`, `code`, `maker`, `currency`, `instock`, `buywith`, `looklike`, `descriptionmeta`, `keywordsmeta`,`urn`,`size`) "
        ."VALUES ("
        ."'', '".(int)$mmid."', '".(int)$mgid."', '".$mname."', ?, ?, '".$_POST["mweight"]."', '".(float)$_POST["mprice"]."', '".$mprewiev."', '".$mimage."', '".(int)$_POST["morder"]."', '".(int)$_POST["enabled"]."', '".(int)$is_group."', '".mysql_escape_string($_POST["code"])."', '".$maker."', '".$currency."', '".$instock."', '".$buywith."', '".$looklike."','".$_POST["descriptionmeta"]."','".$_POST['keywordsmeta']."','".$_POST['urn']."','".$_POST['size']."'".");";
        
      
      }
      break;
    case "update":
      if(!empty($mname))
      {
        $tQuery['query'] = "UPDATE `t_menu` SET `mname` = '".$_POST["mname"]."',"
		."`mdesc` = ?,"
        ."`mcomponents` = ?,"
		#."`mcomponents` = '".$mcomponents."',"
        ."`mweight` = '".$_POST["mweight"]."',"
        ."`descriptionmeta` = '".$_POST["descriptionmeta"]."',"
        ."`keywordsmeta` = '".$_POST["keywordsmeta"]."',"
        ."`urn` = '".$_POST['urn']."',"  
        ."`mprice` = '".(float)$_POST["mprice"]."',";
        if(!empty($mprewiev) || $_POST['mprewiev']=='X')
        {
          $tQuery['query'].= "`mprewiev` = '".$mprewiev."',";
		  if ($_POST['mprewiev']=='X') {
		  	  $delQuery = "SELECT `mprewiev` FROM `t_menu` WHERE `mid`=?d LIMIT 1";
		      $delResult = $cDeep->obj['DB']->selectCell($delQuery, $mid);
              $src = 'upload/catalog/'.basename ( $delResult );
              unlink($src);    	
		  }
        }
        if(!empty($mimage) || $_POST['mimage']=='X')
        {
          $tQuery['query'].= "`mimage` = '".$mimage."',";
          if ($_POST['mimage']=='X') {
              $delQuery = "SELECT `mimage` FROM `t_menu` WHERE `mid`=?d LIMIT 1";
              $delResult = $cDeep->obj['DB']->selectCell($delQuery, $mid);
              $src = 'upload/catalog/'.basename ( $delResult );
              unlink($src);     
          }		  
        }
        $tQuery['query'] .= "`morder` = '".(int)$_POST["morder"]."',"
        ."`code` = '".mysql_escape_string($_POST["code"])."',"
		."`maker` = '".$maker."',"
		."`currency` = '".$currency."',"
		."`instock` = '".$instock."',"
		."`buywith` = '".$buywith."',"
		."`looklike` = '".$looklike."',"
		."`ismain` = '".(int)$_POST["ismain"]."',"
		."`size` = '".$_POST["size"]."',"
        ."`enabled` = '".(int)$_POST["enabled"]."' WHERE `mmid`='".$mmid."' AND `mid`=".$mid." LIMIT 1 ";
      }
      break;
    default:
      break;
  }
  return $tQuery;
}

function getTree($group=0, $mmid=0, &$cDeep)
{
    
    $action = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
    $return['do'] = strtoupper($action[0]);
    
    $action[1] = (! empty($action[1]))?$action[1]:0;
    
    //$tQuery = "SELECT * FROM `t_menu_list` WHERE `mmid`='".$mmid."' AND `mgid`=".$action[1]." ORDER BY `morder` ASC, `mid` ASC";
	$tQuery = "SELECT * FROM `t_menu` WHERE `mmid`='".$mmid."' AND `mgid`=".$action[1]." ORDER BY `morder` ASC, `mid` ASC";
    $hResult['List'] = $cDeep->obj['DB']->select($tQuery);
	
	//$tQuery = "SELECT * FROM `t_menu_list` WHERE `mmid`='".$mmid."' AND `mid`=".$action[1]." AND `is_group`=1";
	$tQuery = "SELECT * FROM `t_menu` WHERE `mmid`='".$mmid."' AND `mid`=".$action[1]." AND `is_group`=1";
	$_group = $cDeep->obj['DB']->selectRow($tQuery);
	
	if (!empty($_group)){
		$hResult['UP']['parent'] = $_group['mgid'];
		$hResult['UP']['Title'] = $_group['mname'];
	  $hResult['UP']['mid'] = $_group['mid'];
	}
	
	$hResult['Current'] = GLOBALS::REQUEST('current');
	
    $cDeep->assign("Items", $hResult);
}

function sortTree($group, &$cDeep)
{
        $sort = Globals::REQUEST('sort');
        if (is_array($sort)) {
            while (list($order,$mid)=each($sort)) {
                $cDeep->obj['DB']->query('UPDATE `t_menu` SET `morder`=?d WHERE `mid`=?d AND `mgid`=?d', intval($order), intval($mid), $group);
            }
            return array('Status'=>'RESORTED');
        }
        return array('Status'=>'RESORTFAILED');
}

function getMainList(&$cDeep) {
    $tQuery = "SELECT * FROM `t_menu` WHERE `ismain`=1 ORDER BY `mid` AND `is_group` DESC {LIMIT ?d}";
	$dResult['Main'] = true;
    $dResult['List'] = $cDeep->obj['DB']->select($tQuery, ($limit > 0) ? $limit : DBSIMPLE_SKIP);
    $cDeep->assign("Items", $dResult);
    return '';
}

function getBreakImagesList(&$cDeep) {
    $tQuery = "SELECT `mid`, `mname`, `mprewiev` FROM `t_menu`";	
    $dResult['List'] = $cDeep->obj['DB']->select($tQuery);
	foreach($dResult['List'] as $key=>$value){
	   if(empty($value['mprewiev'])){
	       unset($dResult['List'][$key]);    
	   }
	}
    foreach($dResult['List'] as $key=>$value){
    	$src = 'upload/catalog/'.basename($value['mprewiev']);
        if (is_file($src)){
           unset($dResult['List'][$key]);    
       }
    }
    $cDeep->assign("Items", $dResult);
	return $cDeep->fetch("sadm/catalog/tree/index.tpl.php");
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
}
function GroupIterator($Groups) {
	$PIDs = array_keys($Groups);
	return GroupIteratorIterator($PIDs[0], $Groups);
}
////////////////////////


function cDeep_function_a_catalog($params, &$cDeep)
{

    $mmid = (int)$params["mmid"];
    $group = (int)$params["group"];
 
    $item = preg_split('/\]|\[/', $params["item"], 5, PREG_SPLIT_NO_EMPTY);

    $do = strtoupper($item[0]);
    $item = $item[1]; 

    switch ($params['action']) {
		case 'sorting':
		
		
		//$GroupList = $cDeep->obj['DB']->query("select * from `t_menu` where `is_group`=1");
		//$cDeep->assign('GroupList', GroupIterator($GroupList));
		
		$GroupList =$cDeep->obj['DB']->select("SELECT *, `mgid` AS ARRAY_KEY_1, `mid` AS ARRAY_KEY_2, (`mid`=?d) AS `selected` FROM `t_menu` where `is_group`=1 ORDER BY `mgid` ASC",2);
		$cDeep->assign('groupsmove', GroupIterator($GroupList));

		foreach($_POST['item'] as $keyitem=>$item)
		{
			$cDeep->obj['DB']->query('update `t_menu` set `mgid`=? where `mid`=?',$_POST['groupmove'],$keyitem );
		};
		

		$me= $cDeep->obj['DB']->selectRow('select * from `t_menu` where  `mid`=?',$cDeep->State['Current_item']);
		$cDeep->assign('me',$me);
		
		
		
		$max=20;
		$num = $cDeep->obj['DB']->selectCell('SELECT COUNT(`mid`) FROM `t_menu` where `mgid`=? and `is_group`=0',$cDeep->State['Current_item']);
		 
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
		
		
		//$groupsmove= $cDeep->obj['DB']->query('select * from `t_menu` where  `is_group`=1');
		//$cDeep->assign('groupsmove',$groupsmove);
		

		if(!$cDeep->State['Current_item']) $cDeep->State['Current_item']=0;
			$groups = $cDeep->obj['DB']->query('select * from `t_menu` where `mgid`=? and `is_group`=1',$cDeep->State['Current_item']);

	
		$cDeep->assign('groups',$groups);
		
		$items = $cDeep->obj['DB']->query('select * from `t_menu` where `mgid`=? and `is_group`=0 limit ?d,?d',$cDeep->State['Current_item'],$start,$max);
		$cDeep->assign('items',$items);

		break;
	
	
	
        case 'Edit': // редактирование свойств
        switch ($do) {
            case 'ADD':
				$content = getItemAdd($item, &$cDeep);
				break;
            case 'PROPERTY':
                $tQuery = setQuery($mmid, &$cDeep);
                if(!empty($tQuery['query']))
                {
                  $hResult = $cDeep->obj['DB']->query($tQuery['query'],$_POST["mdesc"], $_POST["mcomponents"]);
                  if ($tQuery['action'] == "add"){
                      header("Location: /sadm/catalog/property[".$hResult."].xml");                        	
                  }                    
				}
				$content = getItemInfo($item, &$cDeep);
                break;
            case 'REMOVE':
				deleteRecursive($item, &$cDeep);
                break;
        }
        break;
        case 'Files':
            switch ($do) {
                case 'REMOVE':
                    $src = $cDeep->obj['DB']->selectCell('SELECT `src` FROM `t_menu_files` WHERE `id`=?d', $item);
                    if(is_file('upload/catalog/'.$src))
                    {
                        unlink('upload/catalog/'.$src);
                    }
                    
                    $cDeep->obj['DB']->query('DELETE FROM `t_menu_files` WHERE `id`=?d', $item);
                    break;
                case 'PHOTO':   
                    $_Photo = Globals::REQUEST('Photo');
                    
                    if(is_array($_Photo) && !empty($_Photo))
                    {
                        $cDeep->obj['DB']->query('UPDATE `t_menu_files` SET ?a WHERE `id`=?d', array('Name'=>$_Photo['Name'], 'Description'=>$_Photo['Description']), $item);
                    }
                    $Photo = $cDeep->obj['DB']->selectRow('SELECT * FROM `t_menu_files` WHERE `id`=?d ORDER BY `Order`', $item);
                    $cDeep->assign('Photo', $Photo);
                    return '';
                    break;  
                case 'SORT':
                    $sort = Globals::REQUEST('photo');
                    
                    $tQuery = 'UPDATE `t_menu_files` SET `Order`=?d WHERE `id`=?d';
                    while (list($order,$pid)=each($sort)) {
                        $cDeep->obj['DB']->query($tQuery, $order, $pid);
                    }
                    header('Location: /sadm/catalog/ok/');
                    break;                      
                default:
                    $return['List']['Files'] = $cDeep->obj['DB']->select('SELECT * FROM `t_menu_files` WHERE `gid`=?d ORDER BY `Order`', intval($item));
					$cDeep->assign('Photos', $return);
                    break;
            }
            $return['List']['Files'] = $cDeep->obj['DB']->select('SELECT * FROM `t_menu_files` WHERE `gid`=?d ORDER BY `Order`', intval($action[1]));
            break;		
        case 'List':
            switch ($do) {
                case 'REMOVE':
					deleteRecursive($item, &$cDeep);
                    break;
                case 'SORT':
                    sortTree($item, &$cDeep);
                    break;	
                case 'MAIN':
                    $content = getMainList(&$cDeep);
                    break;  
                case 'BREAK':
                    $content = getBreakImagesList(&$cDeep);
                    break;
                case 'PROPERTY':
                default:
                    $content = getTree($item, $mmid, &$cDeep);
                    break;
            }
            break;
    }

  return $content;
}



?>