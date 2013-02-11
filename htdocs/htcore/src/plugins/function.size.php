<?
function cDeep_function_size($params, &$cDeep)
{
$cDeep->obj['DB']->query('delete from `sizes`');
$sizes=$cDeep->obj['DB']->query('select `size` from `t_menu` where `enabled`=1 and `is_group`=0');


foreach($sizes as $size)
{
	if($size['size']) 
	{
		$splits=split(",",$size['size']);
		foreach($splits as $split)
		{
			$split=strtoupper(trim($split));
			$sizes_uniq[]=$split;
		};
		
	}
};
$sizes_uniq=array_unique($sizes_uniq,$sort_flags=SORT_STRING);
foreach($sizes_uniq as $size_uniq)
{
	$cDeep->obj['DB']->query('insert into `sizes` (`size`) values(?)', $size_uniq);
};



}

?>	