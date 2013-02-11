<?

function cDeep_function_a_vote($params, &$cDeep)
{

        

	$tQuery = 'SELECT * FROM `t_vote` order by `id` desc';
	$votes = $cDeep->obj['DB']->select($tQuery);
              
	$cDeep->assign('Votes', $votes);
        //$params['id']=1;    

	$id = intval($params['id']);
        
        $cDeep->assign('id',$id);//
        
	if ($id && $_REQUEST['action']=='rmQuest') {
		$tQuery = 'DELETE FROM `t_vote` WHERE `id`=?';
		$cDeep->obj['DB']->query($tQuery,$id);
                
		header('Location: new.xml');
	}
	
	if ($id) {
		$tQuery = 'SELECT * FROM `t_vote` WHERE `id`=?d';
		$vote = $cDeep->obj['DB']->selectRow($tQuery,$id);

		$vote['quest'] = unserialize($vote['quest']);
		$vote['stat'] = unserialize($vote['stat']);
                
                
                $cDeep->assign('v3',$vote['quest']);
                $cDeep->assign('v4',$vote['stat']);
                
                

		$quest = $_REQUEST['quest'];
		if(is_array($quest))
		{
			$vote['quest'] = array();
			while (list(,$q)=each($quest)) {
				$q=trim($q);
				if(!empty($q))
				{
					$vote['quest'][] = $q;
				}
			}
			
			$tQuery = 'UPDATE `t_vote` SET `quest`=?, `title`=? WHERE `id`=?d';
			$cDeep->obj['DB']->query($tQuery, serialize($vote['quest']), $_REQUEST['title'], $vote['id']);
			unset($_REQUEST['quest']);
                        
                        
                
                
                        
		}
		
		
		
		
		if (intval($_REQUEST['enabled'])==1) 
		{
			$tQuery = 'UPDATE `t_vote` SET `enabled`=0';
			$cDeep->obj['DB']->query($tQuery);
			$tQuery = 'UPDATE `t_vote` SET `enabled`=1 WHERE `id`=?d';
			$cDeep->obj['DB']->query($tQuery, $vote['id']);
			$vote['enabled']=1;
		}
		
		if (is_array($vote['quest'])) {
			while (list(,$q)=each($vote['quest'])) {
				$qst[$q] = intval($vote['stat'][$q]);
			}
		}
		$vote['quest'] = $qst;
                $cDeep->assign('Vote', $vote);
                
	}
	else 
	{
		$quest = $_REQUEST['quest'];
		if(is_array($quest))
		{
			$vote['quest'] = array();
			while (list(,$q)=each($quest)) {
				$q=trim($q);
				if(!empty($q))
				{
					$vote['quest'][] = $q;
				}
			}
			
			$tQuery = 'INSERT INTO `t_vote` (`quest`, `title`) VALUES (? , ?) ';
			$id = $cDeep->obj['DB']->query($tQuery, serialize($vote['quest']), $_REQUEST['title']);
			
			unset($_REQUEST['quest']);
			header('Location: '.$id.'.xml');
		}
	}
}

?>