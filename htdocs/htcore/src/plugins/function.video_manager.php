<?

function cDeep_function_video_manager($params, &$cDeep)
{
  
  
	$action = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
	$return['do'] = strtoupper($action[0]);
	
	switch ($params['action']) {
		case 'Index':
			$return['Index'] = $cDeep->obj['DB']->select('SELECT COUNT( * ) AS `count` , `post` FROM `p_gallery` WHERE `enabled`=1 GROUP BY `post` ORDER BY `post`');
			break;
		case 'Files':
			switch ($return['do']) {
				case 'REMOVE':
					$src = $cDeep->obj['DB']->selectCell('SELECT `src` FROM `p_gallery_files` WHERE `id`=?d', $action[1]);
					if(is_file('upload/photo/'.$src))
					{
						unlink('upload/photo/'.$src);
					}
					
					$cDeep->obj['DB']->query('DELETE FROM `p_gallery_files` WHERE `id`=?d', $action[1]);
					break;
				case 'PHOTO':

					$_Photo = Globals::REQUEST('Photo');
				    if(is_array($_Photo) && !empty($_Photo))
                    {
						if(is_uploaded_file($_FILES["userfile"]["tmp_name"]))
						{
							move_uploaded_file($_FILES["userfile"]["tmp_name"], "upload/photo/".$_FILES["userfile"]["name"]);
							$cDeep->obj['DB']->query('UPDATE `p_gallery_files` SET ?a WHERE `id`=?d', array('Name'=>$_Photo['Name'], 'Description'=>$_Photo['Description'],'group'=>$_Photo['group'], 'image'=>$_FILES['userfile']['name']), $action[1]);
							
						}
						else
						{
							$cDeep->obj['DB']->query('UPDATE `p_gallery_files` SET ?a WHERE `id`=?d', array('Name'=>$_Photo['Name'], 'Description'=>$_Photo['Description'],'group'=>$_Photo['group']), $action[1]);
						};
                    }

					
					$Photo = $cDeep->obj['DB']->selectRow('SELECT * FROM `p_gallery_files` WHERE `id`=?d ORDER BY `Order`', $action[1]);
					$cDeep->assign('Photo', $Photo);
					return '';
					break;
		        case 'SORT':
		            $sort = Globals::REQUEST('photo');
					
		            $tQuery = 'UPDATE `p_gallery_files` SET `Order`=?d WHERE `id`=?d';
		            while (list($order,$pid)=each($sort)) {
		                $cDeep->obj['DB']->query($tQuery, $order, $pid);
		            }
	                header('Location: /sadm/photo/ok/');
		            break;  					
				default:
					break;
			}
			$return['List']['Files'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery_files` WHERE `gid`=?d ORDER BY `Order`', intval($action[1]));
			break;		
		case 'List':
			switch ($return['do']) {
				case 'PROPERTY':
					$_newItem = Globals::REQUEST('Item');
					$type = false;
					if ($_FILES["Item"]["name"]["photo"]) {
						$_file = explode('.', $_FILES["Item"]["name"]["photo"]); $ext = strtolower($_file[(sizeof($_file)-1)]);
						switch ($ext) {
							case 'txt':
							case 'pdf':
							case 'doc':
							case 'docx':
								$type = 'text';
								break;

							case 'flv':
								$type = 'video';
								break;

							case 'jpg':
							case 'jpeg':
							case 'png':
							case 'gif':
								$type = 'photo';
								break;

							default:
								break;
						}
					}

         if( $_newItem['deletePhoto'])
         {
          $photo = $cDeep->obj['DB']->selectCell('SELECT `photo` FROM `p_gallery` WHERE `id`=?d', $action[1]);
					if(is_file('upload/photo/'.$photo))
					{
						unlink('upload/photo/'.$photo);
					}
					$cDeep->obj['DB']->query('UPDATE `p_gallery` SET `photo`="" WHERE `id`=?d', $action[1]);
         }

					if (!empty($_newItem)) {
						if ($_newItem['id']) {

							$newItem = array(
							"post"=>$_newItem['post'],
							"fio"=>$_newItem['fio'],
							"Parent"=>intval($_newItem['Parent']),
							"enabled"=>intval($_newItem['enabled']),
							"descriptionmeta"=>$_newItem['descriptionmeta'],
							"keywordsmeta"=>$_newItem['keywordsmeta'],
							"date"=>$_newItem['date']
							);

							
							if ($_FILES["Item"]["name"]["photo"]) {
								$media = 'upload/photo/'.intval($_newItem['id']);
								if(!is_dir($media)) { mkdir($media, 0777, 1); }
								if ($type && move_uploaded_file($_FILES["Item"]["tmp_name"]["photo"], $media.'/'.$type.RND.'.'.$ext))
								{
									$newItem[$type] = intval($_newItem['id']).'/'.$type.RND.'.'.$ext;

                  $photo = $cDeep->obj['DB']->selectCell('SELECT `photo` FROM `p_gallery` WHERE `id`=?d', $action[1]);
        					if(is_file('upload/photo/'.$photo))
        					{
        						unlink('upload/photo/'.$photo);
        					}
        					$cDeep->obj['DB']->query('UPDATE `p_gallery` SET `photo`="" WHERE `id`=?d', $action[1]);               

								}
							}
							$return['return'] = $cDeep->obj['DB']->query('UPDATE `p_gallery` SET ?a WHERE `id`=?d', $newItem, intval($_newItem['id']));
						}
						else
						{
							$newItem = array(
							"post"=>$_newItem['post'],
							"fio"=>$_newItem['fio'],
							"descriptionmeta"=>$_newItem['descriptionmeta'],
							"keywordsmeta"=>$_newItem['keywordsmeta'],
							"Parent"=>intval($_newItem['Parent']),
							"enabled"=>intval($_newItem['enabled']),
							"date"=>$_newItem['date']
							);
							
								if(!$newItem['descriptionmeta']) $newItem['descriptionmeta']=$_newItem['fio'];
								if(!$newItem['keywordsmeta']) $newItem['keywordsmeta']=$_newItem['fio'];	
								
							
							$return['return']=$_newItem['id'] = $cDeep->obj['DB']->query('INSERT INTO `p_gallery` (?#) VALUES(?a)', array_keys($newItem), array_values($newItem));
							if ($_FILES["Item"]["name"]["photo"]) {
								$media = 'upload/photo/'.intval($_newItem['id']);
								if(!is_dir($media)) { mkdir($media, 0777, 1); }
								if ($type && move_uploaded_file($_FILES["Item"]["tmp_name"]["photo"], $media.'/'.$type.RND.'.'.$ext))
								{
									$cDeep->obj['DB']->query('UPDATE `p_gallery` SET ?#=? WHERE `id`=?d', $type, intval($_newItem['id']).'/'.$type.RND.'.'.$ext, intval($_newItem['id']));
                  
                  $photo = $cDeep->obj['DB']->selectCell('SELECT `photo` FROM `p_gallery` WHERE `id`=?d', $action[1]);
        					if(is_file('upload/photo/'.$photo))
        					{
        						unlink('upload/photo/'.$photo);
        					}
        					$cDeep->obj['DB']->query('UPDATE `p_gallery` SET `photo`="" WHERE `id`=?d', $action[1]);            

								}
							}
							if($_newItem['id']) { header('Location: property['.$_newItem['id'].'].xml'); }
						}
					}
					$return['List'] = $cDeep->obj['DB']->selectRow('SELECT * FROM `p_gallery` WHERE `id`=?d', intval($action[1]));
					$return['List']['Parents'] = $cDeep->obj['DB']->select('SELECT `id`, `fio`, `Parent`, `Level`, (`id`=?d) AS selected FROM `p_gallery` WHERE `id` NOT IN (?a)', intval($return['List']['Parent']), array(intval($return['List']['id'])));

					break;
				case 'REMOVE':
					$return['return'] = $cDeep->obj['DB']->query('DELETE FROM `p_gallery` WHERE `id`=?d', intval($action[1]));
					$media = 'upload/photo/'.intval($action[1]).'/';
					if ($return['return'] && is_dir($media))
					{
						$dir = opendir($media);
						while ($file=readdir($dir)) {
							if (is_file($media.$file)) {
								unlink($media.$file);
							}
						}
						closedir($dir);
						rmdir($media);
					}
					
					$cDeep->obj['DB']->query('DELETE FROM `p_gallery_files` WHERE `gid`=?d', intval($action[1]));
					
					
					break;
				case 'PARENT':
					$onpage = 25;
					$p = intval(Globals::REQUEST('p'));
					$p = ($p > 1)?($p):1;
					$count = $cDeep->obj['DB']->selectCell('SELECT COUNT(`id`) FROM `p_gallery` WHERE `Parent`=?d', intval($action[1]));
					$Pages['count'] = ceil($count/$onpage);
					$Pages['current'] = ($p > $Pages['count'])?$Pages['count']:$p;
					$Pages['prev'] = ($Pages['current'] > 1)?($Pages['current']-1):0;
					$Pages['next'] = ($Pages['current'] < $Pages['count'])?($Pages['current']+1):0;
					$start = abs($Pages['current']-1)*$onpage;
					$return['Pages'] = $Pages;
					$return['List'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery` WHERE `Parent`=?d order by `date` desc LIMIT ?d, ?d', intval($action[1]), $start, $onpage);
                                        
					$return['Parent'] = $cDeep->obj['DB']->selectRow('SELECT * FROM `p_gallery` WHERE `id`=?d', intval($action[1]));
					break;
				default:
					$onpage = 25;
					$p = intval(Globals::REQUEST('p'));
					$p = ($p > 1)?($p):1;
					$count = $cDeep->obj['DB']->selectCell('SELECT COUNT(`id`) FROM `p_gallery`');
					$Pages['count'] = ceil($count/$onpage);
					$Pages['current'] = ($p > $Pages['count'])?$Pages['count']:$p;
					$Pages['prev'] = ($Pages['current'] > 1)?($Pages['current']-1):0;
					$Pages['next'] = ($Pages['current'] < $Pages['count'])?($Pages['current']+1):0;
					$start = abs($Pages['current']-1)*$onpage;
					$return['Pages'] = $Pages;
					$return['List'] = $cDeep->obj['DB']->select('SELECT * FROM `p_gallery` WHERE `Parent`=0 order by `date` desc LIMIT ?d, ?d', $start, $onpage);
					break;
			}
			break;
	}

	//print_r($return);

    $cDeep->assign('Pages', $return['Pages']);
	$cDeep->assign('video_manager', $return);
}
