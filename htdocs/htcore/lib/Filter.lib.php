<?php
class Filter {
	function html_filter($String)
	{
		if(is_array($String))
		{
			while (list ($index, $data) = each ($String))
			{
				$String[$index] = Filter::html_filter($data);
			}

		}
		else
		{
			$String = htmlspecialchars($String, ENT_QUOTES);
			$String = strip_tags($String);
		}
		return $String;
	}
	public static function translit($string, $codepage=null)
	{
		if($codepage)
		{
			$string = mb_convert_encoding($string, 'UTF-8', $codepage);
		};
		
		
		$u=split("\.",$string);
		$ext=$u[count($u)-1];
		$ext=strtolower($ext);
		
		if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='bmp' ) $isImage=true;
		
		$string=$u[0];
		for($i=1;$i<count($u)-1;$i++)
			$string=$string.'.'.$u[$i];
			
			
		$translit = array(
"А"=>"a",
"а"=>"a",
"Б"=>"b",
"б"=>"b",
"В"=>"v",
"в"=>"v",
"Г"=>"g",
"г"=>"g",
"Д"=>"d",
"д"=>"d",
"Е"=>"e",
"е"=>"e",
"Ё"=>"E",
"ё"=>"e",
"Ж"=>"j",
"ж"=>"j",
"З"=>"z",
"з"=>"z",
"И"=>"i",
"и"=>"i",
"Й"=>"Y",
"й"=>"y",
"К"=>"k",
"к"=>"k",
"Л"=>"l",
"л"=>"l",
"М"=>"m",
"м"=>"m",
"Н"=>"n",
"н"=>"n",
"О"=>"o",
"о"=>"o",
"П"=>"p",
"п"=>"p",
"Р"=>"r",
"р"=>"r",
"С"=>"s",
"с"=>"s",
"Т"=>"t",
"т"=>"t",
"У"=>"u",
"у"=>"u",
"Ф"=>"f",
"ф"=>"f",
"Х"=>"h",
"х"=>"h",
"Ц"=>"c",
"ц"=>"c",
"Ч"=>"ch",
"ч"=>"ch",
"Ш"=>"sh",
"ш"=>"sh",
"Щ"=>"sch",
"щ"=>"sch",
"Ъ"=>"",
"ъ"=>"",
"Ы"=>"y",
"ы"=>"y",
"Ь"=>"",
"ь"=>"",
"Э"=>"e",
"э"=>"e",
"Ю"=>"yu",
"ю"=>"yu",
"Я"=>"ya",
"я"=>"ya",


		" "=>"-",
		"#"=>"_",
		"№"=>"_",
		"$"=>"_",
		"%"=>"_",
		":"=>"_",
		"!"=>"_",
		"+"=>"_",
		"="=>"_",
		"@"=>"_",
		"~"=>"_",
		","=>"_",
		"/"=>"_",
		"|"=>"_",
		"\\"=>"_",
		"`"=>"_",
		"'"=>"_",
        "."=>"_",
        "?"=>"_",
		"\""=>"_");
		/*
		while (list($from, $to)=each($translit)) {
			$string = str_replace($from, $to, $string);			
		}
		*/
		
		
		
		
		$string = strtr($string, $translit);
		if($isImage) $string=$string.'.'.$ext;
		
		return $string;
	}
}
?>