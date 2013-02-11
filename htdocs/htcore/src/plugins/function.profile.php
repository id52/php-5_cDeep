<?

function cDeep_function_profile($params, &$cDeep)
{
if($_POST['changepassword'] && empty($_POST['Password']))
{
	$cDeep->assign('errorpassword',"Старый пароль введён неверно");
	$cDeep->assign('error',"error");
};



$_POST['Login']=$_SESSION['uLogin'];
	$user=$cDeep->obj['DB']->selectRow('select * from `users` where `Login`=?', $_SESSION['uLogin']);
	
	if($_POST['Email']!=$_SESSION['uEmail'])
		$email=$cDeep->obj['DB']->selectCell('select `Email` from `users` where `Email`=?', $_POST['Email']);
	
	if($_POST['profile'] || $_POST['changepassword'])
	{
		$login=$cDeep->obj['DB']->selectCell('select `Login` from `users` where `Login`=?', $_POST['Login']);
		$password=$cDeep->obj['DB']->selectCell('select `Password` from `users` where `Login`=?', $_SESSION['uLogin']);
		
		if($login && $login!=$_SESSION['uLogin'])
		{
			$cDeep->assign('errorlogins',"Такой логин уже есть");
		}	
		else
		{
		if(ereg(".+@.+\..+", $_POST['Email']))
		{
			if (!$email)
			{
				if($_POST['Password'])
				{
					if(md5($_POST['Password'])==$password)
					{
					
						if(!empty($_POST['Password1']) || !empty($_POST['Password2']))
						{
						
							if(($_POST['Password1']==$_POST['Password2']) && !empty($_POST['Password1']) && !empty($_POST['Password2']))
							{
								$cDeep->obj['DB']->query('update `users` set `Name`=?, `Login`=?, `Password`=?, `Phone`=?, `Email`=?, `address`=? where `Login`=?',$_POST['Name'], $_POST['Login'], md5($_POST['Password1']), $_POST['Phone'], $_POST['Email'], $_POST['address'], $_SESSION['uLogin']);
								$_SESSION['uLogin']=$_POST['Login'];
								$cDeep->assign('alertpasswords',"Пароль изменён");
							}
							else	
							{
								$cDeep->assign('errorpasswords',"Новые пароли не совпадают");
								$cDeep->assign('error',"error");
							};
							
						}
						else
						{
							$cDeep->assign('erroremptypasswords',"Пустой новый пароль");
							$cDeep->assign('error',"error");
						};
						
					}
					else
					{
						$cDeep->assign('errorpassword',"Старый пароль введён неверно");
							$cDeep->assign('error',"error");
					};
					
				}
				else
				{
					$cDeep->obj['DB']->query('update `users` set `Name`=?,`Login`=?, `Phone`=?, `Email`=?, `address`=? where `Login`=?',$_POST['Name'], $_POST['Login'], $_POST['Phone'], $_POST['Email'], $_POST['address'], $_SESSION['uLogin']);
					$_SESSION['uLogin']=$_POST['Login'];
					$_SESSION['uName']=$_POST['Name'];
					$_SESSION['uPhone']=$_POST['Phone'];
					$_SESSION['uEmail']=$_POST['Email'];
					$_SESSION['uaddress']=$_POST['address'];
					$_SESSION['isauth']=true;
				};
			}
			else
			{
					$cDeep->assign('erroremails',"Такой email уже есть");
					$cDeep->assign('error',"error");
			};
		}
		else
		{
			$cDeep->assign('erroremails',"Введите Email");
			$cDeep->assign('error',"error");
		};
		};
	};
	
	
	$user=$cDeep->obj['DB']->selectRow('select * from `users` where `Login`=?', $_SESSION['uLogin']);
	$cDeep->assign("Login", $user['Login']);
	$cDeep->assign("Name", $user['Name']);
	$cDeep->assign("Phone", $user['Phone']);
	$cDeep->assign("address", $user['address']);
	$cDeep->assign("Email", $user['Email']);
	$cDeep->assign("isauth", $_SESSION['isauth']);
	

	
}

?>