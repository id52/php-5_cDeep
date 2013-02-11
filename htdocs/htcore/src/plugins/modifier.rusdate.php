<?

function cDeep_modifier_rusdate($string, $format='')
{



	switch ($format) {
		case 'sqlnow':
			return empty($string)?date("Y-m-d H:i:s"):$string;
			break;
	}
	
	$month = array(
	1=>'Января',
	2=>'Февраля',
	3=>'Марта',
	4=>'Апреля',
	5=>'Мая',
	6=>'Июня',
	7=>'Июля',
	8=>'Августа',
	9=>'Сентября',
	10=>'Октября',
	11=>'Ноября',
	12=>'Декабря',
	);
	
	$monthName = array(
	1=>'Январь',
	2=>'Февраль',
	3=>'Март',
	4=>'Апрель',
	5=>'Мйя',
	6=>'Июнь',
	7=>'Июль',
	8=>'Август',
	9=>'Сентябрь',
	10=>'Октябрь',
	11=>'Ноябрь',
	12=>'Декабрь',
	);
	
	$week = array(
	'Воскресенье',
	'Понедельник',
	'Вторник',
	'Среда',
	'Четверг',
	'Пятница',
	'Суббота',
	);
	
	
	
	//$adate = preg_split("/[\s]+/", $string. PREG_SPLIT_NO_EMPTY);
	
	$adata=split(chr(32),$string);

	
	$date = $adata['0'];
	$time = $adata['1'];
	


	$t=split(":",$time);
	$h=$t[0];
	$i=$t[1];
	$s=$t[2];
	
/*
	$t=split("-",$date);
	$y=$t[0];
	$m=$t[1];
	$d=$t[2];
*/
	
	
	if(ereg("([0-9]{2,4})[-|.]([0-9]{1,2})[-|.]([0-9]{1,2})", $date, $match))
	{
		$d = $match[3];
		$m = (int)$match[2];
		$y = $match[1];
	}
	elseif(ereg("([0-9]{1,2})[-|.]([0-9]{1,2})[-|.]([0-9]{2,4})", $date, $match))
	{
		$d = $match[1];
		$m = (int)$match[2];
		$y = $match[3];
	}
	
	
	
	
	
	$unix = mktime(0,0,0,$m,$d,$y);
	$w = date("w",$unix);
	
	switch ($format) {
			case 'd m y h i s':
				$date = $d." ".$month[$m]." ".$y." ".$h.":".$i.":".$s;
				break;
			case 'd mm y h i s':
				$date = $d." ".$m." ".$y." ".$h.":".$i.":".$s;
				break;
				
			case 'd m y h i':
				$date = $d." ".$month[$m]." ".$y." ".$h.":".$i;
				break;
			case 'd m y h':
				$date = $d." ".$month[$m]." ".$y." ".$h;
				break;
				
				
				
			case 'd w':
				$date = $d." ".$week[$w]."";
				break;
			case 'd, w':
				$date = $d.", ".$week[$w]."";
				break;
			case 'm':
				$date = $monthName[$m];
				break;
			case 'd m y':
				$date = $d." ".$month[$m]." ".$y;
				break;		
			default:
				$date = $d." ".$month[$m]."";
				break;
		}	
	
	return $date;

}

?>