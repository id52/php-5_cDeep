<?
function cDeep_function_orders_client($params, &$cDeep)
{

$_POST['uLogin'] = $_POST['uEmail'];

if ($_POST['registration'] && empty($_POST['uLogin']) && empty($_POST['uEmail']) && empty($_POST['uName']) && !$_SESSION['isauth']) 
{
	$error=true;
	$cDeep->assign('errorform',"Заполните форму");
	$cDeep->assign('error',"error");
};



///////////////////////////////////////////////////////////////////////////////
if ($_POST['uName'] || $_POST['uLogin'] || $_POST['uPhone'] || $_POST['uaddress'] || $_POST['uEmail']) 
{


if($_POST['registration'])
{


$Email=$cDeep->obj['DB']->selectCell('select `Email` from `users` where `Email`=? ', $_POST['uEmail']);

echo "<br>";

	if($Email && !$_SESSION['isauth'])
	{
		$error=true;
		$cDeep->assign('erroremails',"Пользователь с таким email уже существует, но пароль введен не верно, <a href=/cabinet/forgotpassword/>вспомнить пароль?</a>");
	};


	
	
	
	if (!$_POST['uPassword'])
		{
			$error=true;
			$cDeep->assign('errorpassword',"Введите пароль");
		};
	
	if (!$_POST['uaddress'])
	{
		$error=true;
		$cDeep->assign('erroraddress',"Введите адрес");
	};
	

	if (!$_POST['uName'])
	{
		$error=true;
		$cDeep->assign('errorname',"Введите имя");
		
	};


	if (!$_POST['uPhone'])
	{
		$error=true;
		$cDeep->assign('errorphone',"Введите номер телефона");
	};

	if (!$_POST['uEmail'] || !ereg(".+@.+\..+", $_POST['uEmail']))
	{
		$error=true;
		$cDeep->assign('erroremails',"Введите Email");
	};
	
	if(!$error && !$_SESSION['isauth'] )
	{
		$_POST['uPassword']=md5($_POST['uPassword']);
		$cDeep->obj['DB']->query('insert into `users` (`Login`,`Password`,`Name`,`Phone`, `Email`,`address`,`regtime`, `authtime`) values(?,?,?,?,?,?,now(),now())',$_POST['uLogin'], $_POST['uPassword'],$_POST['uName'],$_POST['uPhone'],$_POST['uEmail'],$_POST['uaddress']);
		$cDeep->assign('isRegistered', true);

		$_SESSION['uLogin']=$_POST['uLogin'];
		$_SESSION['uName']=$_POST['uName'];
		$_SESSION['uPhone']=$_POST['uPhone'];
		$_SESSION['uaddress']=$_POST['uaddress'];
		$_SESSION['uEmail']=$_POST['uEmail'];
		$_SESSION['isauth']=true;
		
	}
	else
	{
	
	
		if($_SESSION['isauth'])
		{
		
			//$cDeep->assign('error',true);
			$cDeep->assign('uLogin',$_SESSION['uLogin']);
			$cDeep->assign('uName',$_SESSION['uName']);
			$cDeep->assign('uPhone',$_SESSION['uPhone']);
			$cDeep->assign('uEmail',$_SESSION['uEmail']);
			$cDeep->assign('uaddress',$_SESSION['uaddress']);
			$cDeep->assign('isauth',$_SESSION['isauth']);
			
		}
		else
		{

			$cDeep->assign('error',true);
			$cDeep->assign('uLogin',$_POST['uLogin']);
			$cDeep->assign('uName',$_POST['uName']);
			$cDeep->assign('uPhone',$_POST['uPhone']);
			$cDeep->assign('uEmail',$_POST['uEmail']);
			$cDeep->assign('uaddress',$_POST['uaddress']);
			$cDeep->assign('isauth',$_SESSION['isauth']);
		
		};

	};
};



if($_SESSION['uLogin'] && !$error){
		$UID=$cDeep->obj['DB']->selectCell('select `UID` from `users` where `Login`=?',$_SESSION['uLogin']);
		if(!$UID) $UID=$cDeep->obj['DB']->selectCell('select `UID` from `users` where `Name`=?',$_POST['uName']);

		if($UID)
			$cDeep->obj['DB']->query('insert into `orders` (`Name`,`Phone`,`Email`,`address`,`status`,`UID`,`time`) values(?,?,?,?,?,?,now())',$_POST['uName'],$_POST['uPhone'],$_POST['uEmail'],$_POST['uaddress'],1,$UID);
		else
			$cDeep->obj['DB']->query('insert into `orders` (`Name`,`Phone`,`Email`,`address`,`status`,`time`) values(?,?,?,?,?,now())',$_POST['uName'],$_POST['uPhone'],$_POST['uEmail'],$_POST['uaddress'],1);

			
		$orderid=$cDeep->obj['DB']->selectCell('select max(`id`) from `orders`');
		$adminemail=$cDeep->obj['DB']->selectRow('select `Value` from `registry` order by `rid` DESC');
		$url=$_SERVER["SERVER_NAME"]."/sadm/orders/".$orderid;

		$html_user="Спасибо, Ваш заказ принят.<br>В ближайшее время с вами свяжется наш менеджер для подтверждения заказа и уточнения возможных деталей.<br><br>";
		$html=$html."Номер заказа: ".$orderid."<br>";
		$html=$html."Имя: ".$_POST['uName']."<br>";
		$html=$html."Телефон: ".$_POST['uPhone']."<br>";
		$html=$html."Дата заказа: ".date('Y-m-d H:i:s')."<br>";
		$html=$html."Email: ".$_POST['uEmail']."<br>";
		$html=$html."Адрес: ".$_POST['uaddress']."<br>";
		$html=$html."Статус заказа: Новый<br><br>";
		$html=$html."<table border=1><thead><th>№ товара</th><th>Товар</th><th>Количество</th><th>Цена за Ед.</th><th>Сумма</th></thead>";


			
		foreach ($_SESSION['catalog']['cart'] as $mid=>$val)
		{
			$item=$cDeep->obj['DB']->selectRow('select * from `t_menu` where `mid`=?', $mid);
			
			$url=urlencode("http://".$_SERVER['HTTP_HOST']."/catalog/item[".$mid."].xml");

			$html=$html."<tr><td>".$mid."</td><td><a href='".$url."'>".$item['mname']."</a></td><td>".$val['count']."</td><td>".$val['mprice']."</td><td>".$val['count']*$val['mprice']."</td></tr>";

			$html=$html."</tr>";

			$summ+=$val['count']*$val['mprice'];
			$amount+=$val['count'];
			$cDeep->obj['DB']->query('update `orders` set `summ`=? where `id`=?',$summ,$orderid);

			$count_values=serialize($_SESSION['catalog']['cart'][$mid]['count_values']);
			$cDeep->obj['DB']->query('insert into `orderitems` (`productid`,`amount`,`url`,`mprice`,`orderid`,`size`,`count_values`) values(?,?,?,?,?,?,?)',$mid, $val['count'],$val['url'],$val['mprice'],$orderid,$val['size'],$count_values);
		};

		$html=$html."<tr><td colspan='4'>Общее количество:</td><td>".$amount."</b></td></tr>";
		$html=$html."<tr><td colspan='4'>Общая сумма:</td><td>".$summ."</b></td></tr>";
		$html=$html."</table><br>";
		$neworder="Новый заказ с сайта ";
		$site=$cDeep->obj['DB']->selectCell('select `value` from `site` where `name`="title"');
		$subject=$neworder.$site;
		$url="http://".$_SERVER['HTTP_HOST'];
		$html=$html."<a href='".$url."'>".$site."</a><br>";
		
		
		$html_user=$html_user.$html;
		$html_admin=$html;
		
		$notice=Sendmail::sendme($adminemail['Value'],$subject, $html_admin);
		$notice=Sendmail::sendme($_POST['uEmail'],$subject.' - ваш заказ '.$orderid.' отправлен.', $html_user);
		
		$address= $_SERVER['REQUEST_URI'];
		$u=split("/",$address);
				for($i=2;$i<count($u);$i++)
					$adr=$adr.'/'.$u[$i];
				$location=$u[1];
				$location2=$u[2];
				
				header("Location: /catalog/cart/sended/".$orderid);
				$_SESSION['catalog']="";
				
};
};
















}

