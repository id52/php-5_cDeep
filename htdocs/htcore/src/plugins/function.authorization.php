<?

function cDeep_function_authorization($params, &$cDeep)
{


	if($_POST['quit'])
	{
		unset($_SESSION['uLogin']);
		unset($_SESSION['uName']);
		unset($_SESSION['uPhone']);
		unset($_SESSION['uaddress']);
		unset($_SESSION['uEmail']);
		unset($_SESSION['isauth']);
		unset($_SESSION['catalog']);
		$_SESSION['catalog']['num']=0;
		$_SESSION['catalog']['summ']=0;

		echo "<script>";		
		echo "num = document.getElementById('numcart');";
		echo "num.innerHTML = 0;";
		echo "summobj = document.getElementById('summ');";
		echo "summobj.innerHTML=0;";
		echo "</script>";		
	};
	
	if(!$_SESSION['isauth'] && !$_POST['quit'])
	{
		if(!$_POST['Login']) $_POST['Login']=$_POST['uEmail'];
		if(!$_POST['Password']) $_POST['Password']=$_POST['uPassword'];
	
		$user=$cDeep->obj['DB']->selectRow('select * from `users` where `Login`=? and `Password`=?', $_POST['Login'], md5($_POST['Password']));
		if($user)
		{
		$cDeep->obj['DB']->query('update `users` set authtime=now() where `Login`=?', $user['Login']);
		
			$_SESSION['uLogin']=$user['Login'];
			$_SESSION['uName']=$user['Name'];
			$_SESSION['uPhone']=$user['Phone'];
			$_SESSION['uaddress']=$user['address'];
			$_SESSION['uEmail']=$user['Email'];
			$_SESSION['isauth']=1;
		}
	
		elseif($_POST['authorization'])
		{
			//echo "<script>document.getElementById('auth').style.display = 'block';</script>";
			$cDeep->assign("wrongloginorpassword","Неправильная пара логин-пароль!<br>Авторизоваться не удалось.<br>Проверьте раскладку клавиатуры, не нажата ли клавиша «Caps Lock» и попробуйте ввести логин и пароль еще раз.<br><br>");

		};
		
	
		
	};

$cDeep->assign("uLogin",$_SESSION['uLogin']);
$cDeep->assign("uName",$_SESSION['uName']);
$cDeep->assign("uPhone",$_SESSION['uPhone']);
$cDeep->assign("uaddress",$_SESSION['uaddress']);
$cDeep->assign("uEmail",$_SESSION['uEmail']);
//$cDeep->assign("isauth",$_SESSION['isauth']);
$cDeep->assign("isauth",$_SESSION['isauth']);
	
	
	

	
}

?>