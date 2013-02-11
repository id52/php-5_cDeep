<?
/**
 * DbSimple factory.
 */
define('DBSIMPLE_SKIP', log(0));
define('DBSIMPLE_ARRAY_KEY', 'ARRAY_KEY');   // hash-based resultset support
define('DBSIMPLE_PARENT_KEY', 'PARENT_KEY'); // forrest-based resultset support

class DbSimple_Generic
{
	public static function Instance($cDeep)
	{
		if (array_key_exists('DB',$cDeep->obj) && is_object($cDeep->obj['DB'])) {
			return $cDeep->obj['DB'];
		}
		else 
		{
			$cDeep->obj['DB'] = DbSimple_Generic::connect($cDeep->DSN);
			$cDeep->obj['DB']->query("set character_set_results='utf8'");
			$cDeep->obj['DB']->query("set character_set_client='utf8'");
			$cDeep->obj['DB']->query("set collation_connection='utf8_general_ci'");
			$cDeep->obj['DB']->query("set collation_server='utf8_general_ci'");
			$cDeep->obj['DB']->query("set collation_database='utf8_general_ci'");
			return $cDeep->obj['DB'];
		}
	}
	
	/**
     * DbSimple_Generic connect(mixed $dsn)
     * 
     * Universal static function to connect ANY database using DSN syntax.
     * Choose database driver according to DSN. Return new instance
     * of this driver.
     */
	
	static function connect($dsn)
	{
		// Load database driver and create its instance.
		$parsed = DbSimple_Generic::parseDSN($dsn);
		if (!$parsed) {
			$dummy = null;
			return $dummy;
		}
		$class = 'DbSimple_'.ucfirst($parsed['scheme']);
		if (!class_exists($class)) {
			trigger_error("Error loading database driver: Autoload failed!", E_USER_ERROR);
			return null;
		}
		$object = new $class($parsed);
		if (isset($parsed['ident_prefix'])) {
			$object->setIdentPrefix($parsed['ident_prefix']);
		}
		$object->setCachePrefix(md5(serialize($parsed['dsn'])));
		if (class_exists("Cache_Lite")) {
			$tmp_dirs = array(
			ini_get('session.save_path'),
			getenv("TEMP"),
			getenv("TMP"),
			getenv("TMPDIR"),
			'/tmp'
			);
			foreach ($tmp_dirs as $dir) {
				if (!$dir) continue;
				if (is_writeable($dir)) {
					$t = new Cache_Lite(array('cacheDir' => $dir.'/', 'lifeTime' => null, 'automaticSerialization' => true));
					$object->_cacher =& $t;
					break;
				}

			}
		}
		return $object;
	}


	/**
     * array parseDSN(mixed $dsn)
     * Parse a data source name.
     * See parse_url() for details. 
     */
	static function parseDSN($dsn)
	{
		if (is_array($dsn)) return $dsn;
		$parsed = @parse_url($dsn);
		if (!$parsed) return null;
		$params = null;
		if (!empty($parsed['query'])) {
			parse_str($parsed['query'], $params);
			$parsed += $params;
		}
		$parsed['dsn'] = $dsn;
		return $parsed;
	}
}
?>