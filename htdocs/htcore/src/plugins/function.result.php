<?

function cDeep_function_result($params, &$cDeep)
{

$id = intval($_GET['InvId']); // получаем номер транзакции
$pwd2 = "fabibaldinini3";
$sum = $cDeep->obj['DB']->selectCell('SELECT `summ` FROM `orders`  WHERE `id`=?', $id);

/////////////

//////////////////////
/*
Не забудьте сначала вставить проверку на существование такого номера транзакции вообще.
Если его нет в базе - выведите "ERR"
*/

if ( $sum != floatval($_GET['OutSum']) ) 
{
 exit();
}

if ( strtolower($_GET['SignatureValue']) != strtolower(md5($_GET['OutSum'] . ":" . $id . ":" . $pwd2. ":Shp_item=" .$_GET['Shp_item'])) ) {
 // не совпадает подпись
 echo "ERR: invalid signature";
 exit();

}
// и если все нормально:
// принимаем платеж, помечаем у себя в базе его, как выполненный
// и выводим положительный ответ Робокассе
$test=$cDeep->obj['DB']->query('update `orders` set `paid`=1 where `id`=?', $id);


echo "OK" . $id;
exit();




}

?>