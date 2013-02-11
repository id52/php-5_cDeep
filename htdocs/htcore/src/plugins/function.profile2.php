<?

function cDeep_function_profile($params, &$cDeep)
{
	$user=$cDeep->obj['DB']->selectRow('select * from `users` where `Login`=?', $_SESSION['uLogin']);
	
	if($_POST['Email']!=$_SESSION['uEmail'])
		$email=$cDeep->obj['DB']->selectCell('select `Email` from `users` where `Email`=?', $_POST['Email']);
	
	if($_POST['profile'])
	{
		$login=$cDeep->obj['DB']->selectCell('select `Login` from `users` where `Login`=?', $_POST['Login']);
		$password=$cDeep->obj['DB']->selectCell('select `Password` from `users` where `Login`=?', $_SESSION['uLogin']);
		
		if($login && $login!=$_SESSION['uLogin'])
		{
			echo "<font color=vodka>Такой логин уже есть</font>";
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
						if($_POST['Password1']==$_POST['Password2'])
						{
							$cDeep->obj['DB']->query('update `users` set `Name`=?, `Login`=?, `Password`=?, `Phone`=?, `Email`=?, `address`=? where `Login`=?',$_POST['Name'], $_POST['Login'], md5($_POST['Password1']), $_POST['Phone'], $_POST['Email'], $_POST['address'], $_SESSION['uLogin']);
							$_SESSION['uLogin']=$_POST['Login'];
						}
						else
						{
							echo "<font color=vodka>Пароли не совпадают</font>";
						};
					}
					else
					{
						echo "<font color=vodka>Неправильный пароль</font>";
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
				};
			}
			else
			{
					echo "<font color=vodka>такой email уже есть</font>";
			};
		}
		else
		{
			echo "<font color=vodka>Введите Email</font>";
		};
		};
	};
	
	
	$user=$cDeep->obj['DB']->selectRow('select * from `users` where `Login`=?', $_SESSION['uLogin']);
	$cDeep->assign("Login", $user['Login']);
	$cDeep->assign("Name", $user['Name']);
	$cDeep->assign("Phone", $user['Phone']);
	$cDeep->assign("address", $user['address']);
	$cDeep->assign("Email", $user['Email']);
	

	
}

?>