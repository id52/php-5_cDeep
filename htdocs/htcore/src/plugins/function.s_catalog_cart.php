<?
function cDeep_function_s_catalog_cart($params, &$cDeep){
    switch($params['action']):
    case "list":
        $cart = unserialize($_COOKIE['cart']);
        if(empty($cart)) $cart = array();
        sort($cart);
        $cDeep->assign("arElements",$cart); 
    break;
    
    case "delete":
        $cart = unserialize($_COOKIE['cart']);
        if($params['id'] == 0) $cart = array();
        else unset($cart[array_search((int)$params['id'],$cart)]);
        $cart = serialize($cart);
        setcookie('cart',$cart,mktime(0,0,0,01,01,2015),"/");
    break;
    
    case "count":
        $cart = unserialize($_COOKIE['cart']);
        if(empty($cart)) $cart = array();
        $cDeep->assign("cartCount",count($cart));
    break;
    
    case "add":
        $cart = unserialize($_COOKIE['cart']);
        if(array_search((int)$params['id'],$cart) === false){
            echo '{"message" : ""}';
            $cart[] = (int)$params['id'];
        }
        else echo '{"message" : "Товар уже добавлен в корзину"}';
        $cart = serialize($cart);
        setcookie('cart',$cart,mktime(0,0,0,01,01,2015),"/");
    break;
    case "send":
        if($_POST['count']):
            $count = $_POST['count'];
            foreach ($count as $key => $value)
                $count[$key] = (int)$value;
            $count = serialize($count);
            setcookie('count',$count,mktime(0,0,0,01,01,2015),"/");
        endif;
        if($_POST['send']=='true'):
            $message = "ФИО - {$_POST['fio']}\nтелефон - {$_POST['phone']}\nemail - {$_POST['email']}\n";
            $message .= "\nЗаказанные товары\n-----------------\n";
            $cart = unserialize($_COOKIE['cart']);
            $count = unserialize($_COOKIE['count']);
            foreach ($cart as $arGoods) {
                $arElement = $cDeep->DB->query("SELECT * FROM `elements` WHERE `id`={$arGoods}");
                $arElement = mysql_fetch_assoc($arElement);
                $message .= $arElement['name']." \t кол-во:{$count[$arElement['id']]}\n";
            }
            
            echo $message;
            mail("newbe@vsibiri.info","Заказ",$message);
        endif;
    break;
    endswitch;
    return;
}
?>