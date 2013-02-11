<?

function cDeep_function_address($params, &$cDeep)
{
	//var_dump($_SERVER);

	$address= $_SERVER['REQUEST_URI'];
	$u=split("/",$address);
	for($i=2;$i<count($u);$i++)
		$adr=$adr.'/'.$u[$i];
		
	$fulladdress= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$host=$_SERVER['HTTP_HOST'];
	$cDeep->assign("host", $host);
	
		
		
	$eng=$u[1];
  
  $location=$eng;
  $location2=$u[2];
  $cDeep->assign("location", $location);
  $cDeep->assign("location2", $location2);
	$cDeep->assign("eng", $eng);
	$cDeep->assign("address", $adr);
	
	$ids=split('/',$adr);
	//echo $ids[2];
	
	//for($i=2;$i<count($ids);$i++)
		$id=$ids[2];
		
	$cDeep->assign("id", $id);
	
	
	$result = $cDeep->obj['DB']->select('SELECT * FROM `t_menu_files`  WHERE `id`=?', $id);
	$src=$result[0][src];
	$srcimg=$result[0][image];
	$cDeep->assign("src", $src);
	$cDeep->assign("srcimg", $srcimg);
  
  
  $titleend= $cDeep->obj['DB']->selectCell('SELECT `value` FROM `site`  WHERE `id`=1');
  $cDeep->assign('titleend',$titleend);
  
	$u=split("/",$fulladdress);
	for($i=0;$i<count($u)-2;$i++)
		$up=$up.$u[$i].'/';
	$cDeep->assign("up", $up);

	
}

?>