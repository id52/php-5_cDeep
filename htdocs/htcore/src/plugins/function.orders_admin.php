<?
function cDeep_function_orders_admin($params, &$cDeep)
{

foreach($_POST['delete'] as $id=>$delete)
{
	$cDeep->obj['DB']->query('delete from `orders` where `id`=?',$id );
	$cDeep->obj['DB']->query('delete from `orderitems` where `orderid`=?',$id );
};

foreach($_POST['deleteitem'] as $id=>$delete)
{
	$cDeep->obj['DB']->query('delete from `orderitems` where `id`=?',$id );
};



foreach($_POST['paid'] as $id=>$paid)
{
	$cDeep->obj['DB']->query('update `orders` set `paid`=? where `id`=?',$paid,$id );
};



foreach($_POST['status'] as $id=>$status)
{
	$cDeep->obj['DB']->query('update `orders` set `status`=? where `id`=?',$status,$id );
};


$id=$cDeep->State['Current_item'];

$max=20;
if($_GET['uid'])
	$num = $cDeep->obj['DB']->selectCell('select count(`id`) from `orders`  left join `users` on orders.UID=users.UID where orders.UID=?;', $_GET['uid']);
else
	$num = $cDeep->obj['DB']->selectCell('select count(`id`) from `orders`  left join `users` on orders.UID=users.UID;');

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
$cDeep->assign('uid',$_GET['uid']);


if($id) $orders = $cDeep->obj['DB']->query('select orders.address, users.address as uaddress,`time`,`id`,`status`, `paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID where orders.id=? order by orders.id DESC;', $id);
else    
	{

		if ($_GET['uid'])
			$orders = $cDeep->obj['DB']->query('select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID where orders.UID=? order by orders.id DESC limit ?d, ?d;', $_GET['uid'],$start, $max);
		else
		{
					//		$orders = $cDeep->obj['DB']->query('select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by orders.id DESC limit ?d, ?d;', $start, $max);
				
				
				
				//$orders = $cDeep->obj['DB']->query('select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by orders.id DESC limit ?d, ?d;', $start, $max);
				
				switch ($_GET['orderby']) 
				{
					case 'address':    $query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `address` " .$_GET['desc']. " limit ?d, ?d;" ;break;
					case 'Phone':      $query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `Phone` " .$_GET['desc']. " limit ?d, ?d;" ;break; 
					case 'summ':       $query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `summ` " .$_GET['desc']. " limit ?d, ?d;"  ;break;
					case 'status':	$query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `status` " .$_GET['desc']. " limit ?d, ?d;"  ;break;
					case 'time':	$query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `time` " .$_GET['desc']. " limit ?d, ?d;"  ;break;
					case 'paid':	$query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `paid` " .$_GET['desc']. " limit ?d, ?d;"  ;break;
					case 'id':	$query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by orders.id " .$_GET['desc']. " limit ?d, ?d;"  ;break;
					default: //$query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by orders.id " .$_GET['desc']. " limit ?d, ?d;"  ;break;
							$query="select orders.address, users.address as uaddress,`time`,`id`,`status`,`paid`, orders.Name, orders.Phone, orders.Email from `orders`  left join `users` on orders.UID=users.UID order by `time`  desc limit ?d, ?d;"  ;break;
				};

				$orders = $cDeep->obj['DB']->query($query, $start, $max);
				
				

		//ascent descent 
		//hilight the string

	};
};
if($id) $orderitems = $cDeep->obj['DB']->query('select *,orderitems.mprice,orderitems.amount,orderitems.size from `orderitems` left join `t_menu` on orderitems.productid=t_menu.mid where `orderid`=?',$id);
else   $orderitems = $cDeep->obj['DB']->query('select *,orderitems.mprice,orderitems.amount,orderitems.size from `orderitems` left join `t_menu` on orderitems.productid=t_menu.mid');

$statuses = $cDeep->obj['DB']->query('select * from statuses');


foreach($orders as &$order)
{
	foreach ($orderitems as $orderitem)
	{
		if($orderitem['orderid']==$order['id'])
		{	
			$order['summ']+=($orderitem['amount']*$orderitem['mprice']);
			$order['amount']+=$orderitem['amount'];
		};
	};
};




foreach ($orderitems as &$orderitem)
{
	$orderitemssumm+=($orderitem['amount']*$orderitem['mprice']);
	$orderitem['count_values']=unserialize($orderitem['count_values']);
};

$cDeep->assign('orderby', $_GET['orderby']);		
$cDeep->assign('desc', $_GET['desc']);		
$cDeep->assign('statuses', $statuses);		
$cDeep->assign('orders', $orders);	
$cDeep->assign('orderitems', $orderitems);
$cDeep->assign('orderitemssumm', $orderitemssumm);



}
?>