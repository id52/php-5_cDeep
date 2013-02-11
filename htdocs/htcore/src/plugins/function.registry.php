<?
function cDeep_function_registry($params, &$cDeep)
{
  $user = SysAuth::SESSION();
  if($user['UID'])
  {
    if(is_array($_REQUEST['registry']))
    {
      while(list($key,$val)=each($_REQUEST['registry']))
      {
        $cDeep->obj['Reg']->write($key, $val);
      }
    }
  }

  $return = $cDeep->obj['Reg']->read($params['target']);
  $cDeep->assign('registry', $return);
}