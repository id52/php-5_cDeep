<?
function cDeep_function_forgotpassword($params, &$cDeep)
{
	if($_POST['recover'])
	{
		$result=$cDeep->obj['DB']->selectRow('select `Login`,`Email` from `users` where `Email`=? or `Login`=?', $_POST['Email'], $_POST['Email']);
		$email=$result['Email'];
		if($result['Email'] || $result['Login'])
		{		
			$a=array('a','e','y','u','i','o');
			$b=array('q','w','r','t','p','s','d','f','g','h','j','k','l','m','z','x','c','v','b','n','m');
			
			for($i=0;$i<5;$i++)
			{
				$newpassword.= $b[rand(0,20)];
				$newpassword.= $a[rand(0,6)];
				
			}
			
			$newpassword;
			$hash=md5($newpassword);
			
			$sitename=$cDeep->obj['DB']->selectCell('select `value` from `site` where `id`=1');
			$url="http://".$_SERVER['HTTP_HOST'];

			$cDeep->obj['DB']->query('update `users` set `Password`=? where `Email`=? or `Login`=?', $hash,$email, $_POST['Login']);
			$result = Sendmail::sendme($email,$sitename.' - восстановление пароля','Ваш новый пароль: '.$newpassword.'<br><br><a href='.$url.'>'.$sitename.'</a>');
			echo "Новый пароль выслан на ".$email;
			$cDeep->assign('sended',true);
		}
		else
		{
			echo "Нет такого email или логина";
		};
	};
};