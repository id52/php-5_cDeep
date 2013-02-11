<?
function cDeep_function_myorders($params, &$cDeep)
{
	
$id=$cDeep->State['Current_item'];

$num = $cDeep->obj['DB']->selectCell('select count(`id`) from `orders`  left join `users` on orders.UID=users.UID where users.Login=?;',$_SESSION['uLogin']);
$targetuser = $cDeep->obj['DB']->selectCell('select `Login` from  `orders` left join `users` on orders.UID=users.UID where orders.id=?',$id);


if(!$id){$targetuser=$_SESSION['uLogin'];};



$cDeep->assign('targetuser', $targetuser);

$cDeep->assign('id', $id);


$max=20;
//$num = $cDeep->obj['DB']->selectCell('select count(`id`) from `orders`  left join `users` on orders.UID=users.UID;');
$num = $cDeep->obj['DB']->selectCell('select count(`id`) from `orders`  left join `users` on orders.UID=users.UID where users.Login=?;',$_SESSION['uLogin']);
$num=intval($num);
$count    = ceil($num/$max);
$current=$_GET['p'];
$current  = abs($current);
$current = ($current < 1)?1:$current;
$next   = ($current < $count)?($current + 1):0;
$last   = ($current > 1)?($current - 1):0;
$start = ($current-1)*$max;

$cDeep->assign('next',$next);
$cDeep->assign('last',$last);
$cDeep->assign('current',$current);
$cDeep->assign('count',$count);
	
$UID = $cDeep->obj['DB']->selectCell('select `UID` from `users` where `Login`=?', $_SESSION['uLogin']);	
if($id) $orders = $cDeep->obj['DB']->query('select orders.address, users.address as uaddress,`time`,`id`,`status`, orders.Name, orders.Phone, orders.Email,orders.paid from `orders`  left join `users` on orders.UID=users.UID where orders.id=? and orders.UID=? order by orders.id DESC;', $id,$UID);
else    $orders = $cDeep->obj['DB']->query('select orders.address, users.address as uaddress,`time`,`id`,`status`, orders.Name, orders.Phone, orders.Email,orders.paid from `orders`  left join `users` on orders.UID=users.UID where orders.UID=? order by orders.id DESC limit ?d, ?d;', $UID,$start, $max);
	
	
if($id) $orderitems = $cDeep->obj['DB']->query('select *,orderitems.mprice,orderitems.amount, orderitems.size from `orderitems` left join `t_menu` on orderitems.productid=t_menu.mid where `orderid`=?',$id);
else   $orderitems = $cDeep->obj['DB']->query('select *,orderitems.mprice,orderitems.amount, orderitems.size from `orderitems` left join `t_menu` on orderitems.productid=t_menu.mid');



$robokassa=$cDeep->obj['DB']->selectRow('select * from `robokassa`');

$mrh_login =$robokassa['mrh_login'];
$mrh_pass1 = $robokassa['mrh_pass1'];
$inv_desc = $robokassa['inv_desc'];
$shp_item = $robokassa['shp_item'];
$in_curr = $robokassa['in_curr'];
$culture = $robokassa['culture'];


$cDeep->assign('mrh_login', $mrh_login);	
$cDeep->assign('mrh_pass1', $mrh_pass1);	
$cDeep->assign('inv_desc', $inv_desc);	
$cDeep->assign('shp_item', $shp_item);	
$cDeep->assign('in_curr', $in_curr);	
$cDeep->assign('culture', $culture);	






foreach($orders as &$order)
{
	foreach ($orderitems as $orderitem)
	{
		if($orderitem['orderid']==$order['id'])
		{	
			$order['out_summ']+=($orderitem['amount']*$orderitem['mprice']);
			$order['amount']+=$orderitem['amount'];
		}
		
	};
	
	
	$crc  = md5($mrh_login.":".$order['out_summ'].":".$order['id'].":".$mrh_pass1.":"."Shp_item=".$shp_item);
	$order['crc']=$crc;
	
}


foreach ($orderitems as &$orderitem)
{
	$orderitemssumm+=($orderitem['amount']*$orderitem['mprice']);
	$orderitem['count_values']=unserialize($orderitem['count_values']);
	
	
	
};

$statuses = $cDeep->obj['DB']->query('select * from statuses');
$cDeep->assign('statuses', $statuses);	


	
$cDeep->assign('orders', $orders);	
$cDeep->assign('orderitems', $orderitems);
$cDeep->assign('orderitemssumm', $orderitemssumm);
	
}

