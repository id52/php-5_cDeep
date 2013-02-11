<?

function cDeep_function_video_viewer($params, &$cDeep)
{
	$action = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
	$return['do'] = strtoupper($action[0]);
	$item = intval($cDeep->State['Item'][0]);
  
    $descriptionmeta = $cDeep->obj['DB']->selectCell('SELECT `descriptionmeta` FROM `p_gallery` WHERE `id`=?', $item);
    $keywordsmeta = $cDeep->obj['DB']->selectCell('SELECT `keywordsmeta` FROM `p_gallery` WHERE `id`=?', $item);
    $titlemeta = $cDeep->obj['DB']->selectCell('SELECT `fio` FROM `p_gallery` WHERE `id`=?', $item);
        
    $cDeep->State['descriptionmeta']= $descriptionmeta;
    $cDeep->State['keywordsmeta'] =$keywordsmeta;
    $cDeep->State['titlemeta'] =$titlemeta;

	switch ($params['action']) {
	
		case 'photoRandom':
		
			$photos=$cDeep->obj['DB']->query("SELECT * FROM `p_gallery` LEFT JOIN `p_gallery_files` ON p_gallery.id = p_gallery_files.gid where `enabled`=1 and `ext`!='flv' ORDER BY RAND(NOW()) LIMIT 1");
            $cDeep->assign('photos', $photos);
			break;	
			
		case 'videoRandom':
			$videos= $cDeep->obj['DB']->query("SELECT * FROM `p_gallery` LEFT JOIN `p_gallery_files` ON p_gallery.id = p_gallery_files.gid where `enabled`=1 and `ext`='flv' and `image`!='' ORDER BY RAND(NOW()) LIMIT 1");
            $cDeep->assign('videos', $videos);
			break;		
			
		case 'galleryid':
			$query="SELECT * FROM `p_gallery` LEFT JOIN `p_gallery_files` ON p_gallery.id = p_gallery_files.gid where `ext`!='flv' and `gid`=? ORDER BY p_gallery_files.Order ";
			//`enabled`=1 and 
			
			if($params['amount'])
				$query=$query." limit ".$params['amount'];

			$photos=$cDeep->obj['DB']->query($query, $params['galleryid']);
            $cDeep->assign('photos', $photos);
			
			//$tpl = $params['tpl'];
			//$out = $cDeep->fetch($tpl);

			break;		
			

		case 'Index':
			if (!empty($cDeep->State['Item'][0]))
			{
				$return['Post'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery` WHERE `enabled`=1 AND `Parent`=?d order by `date` desc', $item);
				$return['Item'] = $cDeep->obj['DB']->selectRow('SELECT * FROM `p_gallery` WHERE `enabled`=1 AND `id`=? order by `date` desc', $item);
				$return['Parent']=$cDeep->obj['DB']->selectRow('SELECT * FROM `p_gallery` WHERE `enabled`=1 AND `id`=?d order by `date` desc', $return['Item']['Parent']);
				$return['Item']['Photo'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery_files` WHERE `gid`=? ORDER BY `Order` asc', $item);

                $cDeep->State['Path'][] = array('Title'=> $return['Item']['fio']);
			}
			else
			{
				$return['Post'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery` WHERE `enabled`=1 AND `Parent`=?d order by `date` desc', 0);
			}

			$cDeep->assign($return);
			$out = $cDeep->fetch('file:photo/index.tpl.php');
                        
                        
			break;
		case 'album':
			if (!empty($params['id']))
			{
				$return['Item']['Photo'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery_files` WHERE `gid`=? ORDER BY `Order` asc', $params['id']);
 			}
            $cDeep->assign($return);
            $tpl = (!empty($params['tpl']))?$params['tpl']:'file:photo/index.tpl.php';
            
			$out = $cDeep->fetch($tpl);
			break;

    case 'header':
        $descriptionmeta = $cDeep->obj['DB']->selectCell('SELECT `descriptionmeta` FROM `p_gallery` WHERE `id`=?', $item);
        $keywordsmeta = $cDeep->obj['DB']->selectCell('SELECT `keywordsmeta` FROM `p_gallery` WHERE `id`=?', $item);
        $fio = $cDeep->obj['DB']->selectCell('SELECT `fio` FROM `p_gallery` WHERE `id`=?', $item);

    
		 $cDeep->assign('descriptionmeta',$descriptionmeta);
         $cDeep->assign('keywordsmeta',$keywordsmeta);
         $cDeep->assign('titlemeta',$fio);  

      
	}
	return $out;
}