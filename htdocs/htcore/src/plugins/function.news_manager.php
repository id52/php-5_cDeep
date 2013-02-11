<?

function cDeep_function_news_manager($params, &$cDeep)
{
	$Plugin_News = new Plugin_News($cDeep, true);

	$action = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
	$return['do'] = strtoupper($action[0]);

	switch ($params['action']) {
		case 'Edit': // редактирование свойств новости
		switch ($return['do']) {
			case 'PROPERTY':
				$newNews = Globals::REQUEST('News');
				if (!empty($newNews)) {
					if ($newNews['id']) {
						$return['return'] = $Plugin_News->Controller('editNews', $newNews);
					}
					else
					{
						$return['return'] = $Plugin_News->Controller('addNews', $newNews);
					}
				}
				$News = $Plugin_News->Controller('propNews', array("id"=>$action[1]));
				$cDeep->assign('News',$News);
				break;
			case 'REMOVE':
				$return['return'] = $Plugin_News->Controller('removeNews', array("id"=>$action[1]));
				break;		
		}
		break;
		case 'ListByTag': // вывод списка новостей по тегу
			$News = $Plugin_News->Controller('listNews', array("primaryTagId"=>$params['primaryTagId']));
			$cDeep->assign('Pages', $News['Pages']);
			$cDeep->assign('News', $News);
			break;
		case 'List': // вывод списка всех новостей
			switch ($return['do']) {
				case 'PROPERTY':
					break;
				case 'REMOVE':
					$return['return'] = $Plugin_News->Controller('removeNews', array("id"=>$action[1]));
					break;
	            case 'REMOVEIMG':
	                $Plugin_News->Controller('removeImg', array("id"=>$action[1]));
	                break;  					
				default:
          $params['current']=$_GET['p'];
					$Newss = $Plugin_News->Controller('listNews', $params);
          
					$cDeep->assign('Newss',$Newss);
					$cDeep->assign('Pages', $Newss['Pages']);
					break;
			}
			break;
	}
	$cDeep->assign('news_manager', $return);
}
