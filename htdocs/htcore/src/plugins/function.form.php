<?
function cDeep_function_form($params, &$cDeep)
{


$mrh_login = "FB3";
$mrh_pass1 = "fabibaldinini3";
$inv_id = 213;
$inv_desc = "ROBOKASSA Advanced User Guide";
$out_summ = "20018";
$shp_item = "WMR";
$in_curr = "WMR";
$culture = "ru";
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");

/*
print "<html><script language=JavaScript ".
      "src='https://merchant.roboxchange.com/Handler/MrchSumPreview.ashx?".
      "MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id&IncCurrLabel=$in_curr".
      "&Desc=$inv_desc&SignatureValue=$crc&Shp_item=$shp_item".
      "&Culture=$culture&Encoding=$encoding'></script></html>";
*/	  
	  
print "<html>".
      "<form action='http://test.robokassa.ru/Index.aspx' method=POST>".
      "<input type=hidden name=MrchLogin value=$mrh_login>".
      "<input type=hidden name=OutSum value=$out_summ>".
      "<input type=hidden name=InvId value=$inv_id>".
      "<input type=hidden name=Desc value='$inv_desc'>".
      "<input type=hidden name=SignatureValue value=$crc>".
      "<input type=hidden name=Shp_item value='$shp_item'>".
      "<input type=hidden name=IncCurrLabel value=$in_curr>".
      "<input type=hidden name=Culture value=$culture>".
      "<input type=submit value='Pay'>".
      "</form></html>";

	
}

?>