<?
function cDeep_function_s_vote($params, &$cDeep)
{
  $tQuery = 'SELECT * FROM `t_vote` WHERE `enabled`=1';
  
  $vote = $cDeep->obj['DB']->selectRow($tQuery);

  $vote['quest']  = unserialize($vote['quest']);
  $vote['stat'] = unserialize($vote['stat']);
  $vote['voted']  = $_COOKIE['vote'.$vote['id']];

  $vote['quest'] = is_array($vote['quest'])?$vote['quest']:array();
  $vote['stat'] = is_array($vote['stat'])?$vote['stat']:array();

  $result = $_REQUEST['result'];
  if(!empty($result) && in_array($result, $vote['quest']) && empty($vote['voted']))
  {
    $vote['stat'][$result]++;
    $tQuery = 'UPDATE `t_vote` SET `stat`=? WHERE `id`=?d';
    $cDeep->obj['DB']->query($tQuery, serialize($vote['stat']), $vote['id']);
    setcookie('vote'.$vote['id'], 'yes', time()+(60*60*24*7), '/');
    $vote['voted'] = true;
  }
  $all = 0;
  while (list(,$q)=each($vote['quest'])) {
    if(isset($vote['stat'][$q]))
    {
      $stat[$q]['num'] = $vote['stat'][$q];
      $all += $vote['stat'][$q];
    } 
  }
  reset($vote['quest']);
  while (list(,$q)=each($vote['quest'])) {
    if(isset($vote['stat'][$q]))
    {
      $stat[$q]['percent'] = ($vote['stat'][$q]/$all)*100;
    } 
  }
  
  $vote['stat'] = $stat;
  $vote['all'] = $all;
  
  $cDeep->assign('Vote', $vote);

}

?>