<?
function cDeep_function_user_manager($params, &$cDeep)
{
	if (!is_object($cDeep->obj['SysAuth']))
	{
		$cDeep->obj['SysAuth'] = new SysAuth($cDeep);
	}

	switch ($params['action']) {
		case 'Edit':
			$action = preg_split('/\]|\[/', $cDeep->State['Current_item'], 5, PREG_SPLIT_NO_EMPTY);
			$do = strtoupper($action[0]);
			switch ($do) {
				case 'PROPERTY':
					$newUser = Globals::REQUEST('User');
					if (!empty($newUser)) {
						if ($newUser['UID']) {
							$return['return'] = $cDeep->obj['SysAuth']->userManager('editUser', $newUser);
						}
						else 
						{
							$return['return'] = $cDeep->obj['SysAuth']->userManager('addUser', $newUser);
						}
					}
					$User = $cDeep->obj['SysAuth']->userManager('listUser', $action[1]);
					
					break;
					
				case 'REMOVE':
					$return['return'] = $cDeep->obj['SysAuth']->userManager('delUser', $action[1]);
					break;

				default:
					break;
			}
			break;
		case 'listUsers':
			$Users = $cDeep->obj['SysAuth']->userManager('listUsers', 1);
			$cDeep->assign('Users', $Users);
			break;
		case 'listGroups':
			$Groups = $cDeep->obj['SysAuth']->userManager('listGroups', 1);
			$cDeep->assign('Groups', $Groups);
			break;

		default:
			break;
	}

	$cDeep->assign('User', $User);
	$cDeep->assign('user_manager', $return);
}
?>