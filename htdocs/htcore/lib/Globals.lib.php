<?
class Globals
{
	/*
	Класс - оболочка для работы с глобальными массивами
	*/
	
	public static function POST($var=null)
	{
		return $_POST[$var];
	}
	
	public static function REQUEST($var=null)
	{
		if (array_key_exists($var,$_REQUEST)) {
			return $_REQUEST[$var];
		}
	}
	
	public static function GET($var=null)
	{
		return $_GET[$var];
	}
	
	public static function COOKIE($var=null)
	{
		return $_COOKIE[$var];
	}
	
	public static function SESSION($var=null)
	{
		return $_SESSION[$var];
	}
	
	public static function SERVER($var=null)
	{
		return $_SERVER[$var];
	}
	
	/* должна быть возможность установить значение */
	public function set($var, $value)
	{
		
	}
}
?>