<?
function cDeep_function_registration($params, &$cDeep)
{



if($_POST['registration']=='Зарегистрироваться')
{

$_POST['Login']=$_POST['Email'];

//$Login=$cDeep->obj['DB']->selectCell('select `Login` from `users` where `Login`=? ', $_POST['Login']);
$Email=$cDeep->obj['DB']->selectCell('select `Email` from `users` where `Email`=? ', $_POST['Email']);

/*
	if($Login)
	{
		$error=true;
		$cDeep->assign('errorlogins',"Такой логин уже есть");
	};
*/	
	if($Email)
	{
		$error=true;
		$cDeep->assign('erroremails',"Такой email уже есть");
	};

	/*
	if ($_POST['Password']!=$_POST['Password2'])
	{	
		$error=true;
		$cDeep->assign('errorpasswords',"Пароли не совпадают");
	}
	else
		if (!$_POST['Password'] || !$_POST['Password2'])
		{
			$error=true;
			$cDeep->assign('errorpassword',"Введите пароль");
		};
	*/
/*
	if (!$_POST['Login'])
	{
		$error=true;
		$cDeep->assign('errorlogin',"Введите логин");
	};
	
	*/
/*
	if (!$_POST['Name'])
	{
		$error=true;
		echo '<font color=vodka>Введите имя</font><br>';
	};


	if (!$_POST['Phone'])
	{
		$error=true;
		echo '<font color=vodka>Введите телефон</font><br>';
	};
*/

	if (!$_POST['Password'])
	{
		$error=true;
		$cDeep->assign('errorpassword',"Введите пароль");
	};

	if (!$_POST['Email'] || !ereg(".+@.+\..+", $_POST['Email']))
	{
		$error=true;
		$cDeep->assign('erroremails',"Введите Email");
	};
	
	if(!$error)
	{
		$_POST['Password']=md5($_POST['Password']);
		$cDeep->obj['DB']->query('insert into `users` (`Login`,`Password`,`Name`,`Phone`, `Email`,`address`, `regtime`,`authtime`) values(?,?,?,?,?,?,now(),now())',$_POST['Login'], $_POST['Password'],$_POST['Name'],$_POST['Phone'],$_POST['Email'],$_POST['address']);
		$cDeep->assign('isRegistered', true);
		
		
		//$user=$cDeep->obj['DB']->selectRow('select * from `users` where `Login`=? and `Password`=?', $_POST['Login'], md5($_POST['Password']));
		
		$_SESSION['uLogin']=$_POST['Login'];
		$_SESSION['uName']=$_POST['Name'];
		$_SESSION['uPhone']=$_POST['Phone'];
		$_SESSION['uaddress']=$_POST['address'];
		$_SESSION['uEmail']=$_POST['Email'];
		$_SESSION['isauth']=1;
		
				$address= $_SERVER['REQUEST_URI'];
				$u=split("/",$address);
				for($i=2;$i<count($u);$i++)
					$adr=$adr.'/'.$u[$i];
				$location=$u[1];
				$location2=$u[2];
				header("Location: /".$location."/cabinet/profile/");
		
		
		
		
	}
	else
	{
		$cDeep->assign('Login',$_POST['Login']);
		$cDeep->assign('Name',$_POST['Name']);
		$cDeep->assign('Phone',$_POST['Phone']);
		$cDeep->assign('Email',$_POST['Email']);
		
		$cDeep->assign('address',$_POST['address']);
		$cDeep->assign('error',$error);
		
	};
	

	
	
echo "<br>";	
};
	
}
?>