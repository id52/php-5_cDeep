<?

function cDeep_function_news_viewer($params, &$cDeep)
{
	$Plugin_News = new Plugin_News($cDeep, false);

	$return['do'] = '';

    $max = $params["max"]?(int)$params["max"]:15;
    if($params['nopage']) {
        $current = 1;
    } else {
        $current = (intval($_REQUEST['p'])>1)?(intval($_REQUEST['p'])):1;
    }
    $start = ($current-1)*$max;

	switch ($params['action']) {
		case 'ListByTag': // вывод списка на главную
			$News = $Plugin_News->Controller('listNews', array("primaryTagId"=>$params['primaryTagId'], "primaryTagName"=>$params['primaryTagName'],"max"=>$params['max']));
			$cDeep->assign('News', $News);
			break;
		case 'List':
			$params['id'] = $cDeep->State['Current_item'];
            $params['max']      = $max;
            $params['current']  = $current;
            $params['start']    = $start;
			
			$News = $Plugin_News->Controller('listNews', $params);

            if($params['id']) {
                $cDeep->State['Path'][] = array('Title'=> $News['List']['Title']);
                
            }
            
            $cDeep->State['descriptionmeta']= $News['List']['descriptionmeta'];
            $cDeep->State['keywordsmeta'] =$News['List']['keywordsmeta'];
            $cDeep->State['titlemeta'] =$News['List']['Title'];
      
			$cDeep->assign('News',$News);
			$cDeep->assign('Page', $News['Pages']);
			break;
      
      case 'header':
			$params['id'] = $cDeep->State['Current_item'];
            $params['max']      = $max;
            $params['current']  = $current;
            $params['start']    = $start;
			
			$News = $Plugin_News->Controller('listNews', $params);

            if($params['id']) {
                $cDeep->State['Path'][] = array('Title'=> $News['List']['Title']);
            }
      $cDeep->assign('title',$News['List']['Title']);
			$cDeep->assign('descriptionmeta',$News['List']['descriptionmeta']);
			$cDeep->assign('keywordsmeta', $News['List']['keywordsmeta']);
			break;
      
      
      
      
      
      
      
      
      
      
      
      
      
      
	}
	$cDeep->assign('news_viewer', $return);
}
