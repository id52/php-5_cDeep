<?

function cDeep_function_pages_manager($params, &$cDeep)
{
	$Plugin_Site_Pages = new Plugin_Site_Pages($cDeep, true);

	$action = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
	$return['do'] = strtoupper($action[0]);

	switch ($params['action']) {
		case 'Edit': // редактирование свойств
		switch ($return['do']) {
			case 'ADD':
				$newPage = Globals::REQUEST('Page');
				$return['return'] = $Plugin_Site_Pages->Controller('addPage', $newPage);
				$Page = $Plugin_Site_Pages->Controller('newPage', array("parent"=>$action[1]));
				$cDeep->assign('Page',$Page);
				break;
			case 'PROPERTY':
				$newPage = Globals::REQUEST('Page');
				if (!empty($newPage)) {
					if ($newPage['node']) {
						$return['return'] = $Plugin_Site_Pages->Controller('editPage', $newPage);
					}
				}
				$Page = $Plugin_Site_Pages->Controller('propPage', array("node"=>$action[1]));
				$cDeep->assign('Page',$Page);
				break;
			case 'REMOVE':
				$return['return'] = $Plugin_Site_Pages->Controller('removePage', array("node"=>$action[1]));
				$cDeep->assign('Page',$return['return']);
				break;
		}
		break;
		case 'List':
			switch ($return['do']) {
				case 'PROPERTY':
					break;
				case 'REMOVE':
					$return['return'] = $Plugin_Site_Pages->Controller('removePage', array("node"=>$action[1]));
					break;
				default:
					$Pages = $Plugin_Site_Pages->Controller('listPages', array("parent"=>$action[1]));
					$cDeep->assign('Pages', $Pages);
          
					break;
			}
			break;
	}
	$cDeep->assign('pages_manager', $return);
}
