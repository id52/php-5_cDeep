<?
class Cache
{
	function callback()
	{
		$numargs = func_num_args(); //количество аргументов
		$args = func_get_args(); //массивчик аргументов
		$function = array_shift($args);

		if(!empty($function) && is_callable($function)) 
		{
			$cid = md5(serialize($args).$function);
			if(Cache::is_cached($cid))
			{
				return Cache::get_cache($cid);			
			}
			else 
			{
				return Cache::put_cache($cid, call_user_func_array($function, $args));
			}
		}
	}
	/**
	 * Return true if cache exists.
	 *
	 * @param string $id
	 * @return bool
	 */
	function is_cached($id)
	{
		global $Config;
		$cache_dir = $Config->Cache["path"];
		$fCache = $cache_dir."/".$id.".stc";
		return file_exists($fCache);
	}

	/**
	 * Add cache
	 *
	 * @param string $id
	 * @param mixed $Data
	 */
	function put_cache($id, $Data)
	{
		global $Config;
		$cache_dir = $Config->Cache["path"];
		$fCache = $cache_dir."/".$id.".stc";
		$_Data["DATA"] = $Data;
		$_Data["TIME"] = date("U");

		$sData = serialize($_Data);
		$fp = fopen($fCache, "w");
		fwrite($fp, $sData);
		fclose($fp);
		return $Data;
	}

	/**
	 * Get cache
	 *
	 * @param string $id
	 * @return mixed
	 */
	function get_cache($id)
	{
		global $Config;
		$cache_dir = $Config->Cache["path"];
		$fCache = $cache_dir."/".$id.".stc";
		$return = false;
		if(file_exists($fCache))
		{
			$sData = file_get_contents($fCache);
			$_Data = unserialize($sData);
			$return = $_Data["DATA"];
		}
		return $return;
	}

	/**
	 * Add cache if not exists else return cache content
	 *
	 * @param string $id
	 * @param mixed $Data
	 * @return mixed
	 */
	function docache($id, $Data="")
	{
		global $Config;
		if($Config->Cache["enable"])
		{
			if(Cache::is_cached($id))
			{
				$return = Cache::get_cache($id);
			}
			else
			{
				Cache::put_cache($id, $Data);
				$return = $Data;
			}
		}
		else
		{
			$return = $Data;
		}
		return $return;
	}
}
?>