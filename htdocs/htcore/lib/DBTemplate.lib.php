<?
final class DBTemplate extends Lib
{
	private $DB		= null;
	private $cache	= array();
	private $Auth	= array();
	
	public static function Instance($cDeep, $_path='t_template')
	{
		if (array_key_exists('DBTemplate',$cDeep->obj) && is_object($cDeep->obj['DBTemplate'])) {
			return $cDeep->obj['DBTemplate'];
		}
		else 
		{
			$cDeep->obj['DBTemplate'] = new DBTemplate($cDeep, $_path);
			return $cDeep->obj['DBTemplate'];
		}
	}
	
	public function __construct($cDeep, $_path='t_template')
	{
		$this->DB 	= $cDeep->obj['DB'];
		$this->path = ($_path)?$_path:'t_template';
		$this->Auth	= SysAuth::SESSION(); // сессионные данные авторизации
	}

	private function getfile($_file)
	{
		if (!isset($this->cache[$_file]))
		{
			$this->cache[$_file] = $this->DB->selectRow(
			"SELECT *, DATE(`emtime`) AS `emtime` FROM ?# WHERE `name`=? {AND `enabled`=?d}",
			$this->path, $_file, (0==$this->Auth['UID'])?1:DBSIMPLE_SKIP);
		}
	}
	
	private function permission($_file)
	{
		if (0==$this->Auth['UID']) // неавторизирован
			return -1;
		
		if (1==$this->Auth['UID']) // суперюзер - все может
			return 7;
		
		if (isset($this->cache[$_file]['permission'])) // уже проверяли права
			return $this->cache[$_file]['permission'];
		
		if (
			!isset($this->cache[$_file]['UID']) ||
			!isset($this->cache[$_file]['GID']) ||
			!isset($this->cache[$_file]['O']) ||
			!isset($this->cache[$_file]['G']) ||
			!isset($this->cache[$_file]['A'])
			) 
		{
			$this->getfile($_file);
		}
		
		
		if ($this->cache[$_file]['UID'] == $this->Auth['UID']) // юзер - владелец
		{
			$this->cache[$_file]['permission'] = $this->cache[$_file]['O'];
			return $this->cache[$_file]['O'];
		}
		
		if ($this->cache[$_file]['GID'] == $this->Auth['GID'] || 
			in_array($this->cache[$_file]['GID'], $this->Auth['GIDs'])) // юзер - в группе файла
		{
			$this->cache[$_file]['permission'] = $this->cache[$_file]['G'];
			return $this->cache[$_file]['G'];
		}
		
		return $this->cache[$_file]['A']; // остальные
	}
	
	public function is_readble($_file)
	{
		$_permission = $this->permission($_file);
		switch ($_permission) {
			case -1:
				$_readble = 1; // неавторизированным можно читать
				break;
			default:
				$_readble = substr(decbin($_permission),0,1);
				break;
		}
		return true;
		return (1==$_readble)?true:false;
	}
	
	public function is_writeble($_file)
	{
		$_permission = $this->permission($_file);
		switch ($_permission) {
			case -1:
				$_writeble = 0; // неавторизированным нельзя писать
				break;
			default:
				$_writeble = substr(decbin($_permission),1,1);
				break;
		}
		return (1==$_writeble)?true:false;
	}

	public function read($_file, $_cache=true)
	{
		if (!$this->is_readble($_file)) // нечитаемый (доступ запрещен)
			return false;
			
		$_mode = intval(isset($this->cache[$_file]['source'])).'x'.intval($_cache);
		switch ($_mode) {
			case '0x0': // НЕТ в хэше , НЕ хэшировать
			case '1x0': // ЕСТЬ в хэше , НЕ хэшировать
				$_Source = $this->DB->selectCell("SELECT `source` FROM ?# WHERE `name`=? {AND `enabled`=?d}",
				$this->path, $_file, (0==$this->Auth['UID'])?1:DBSIMPLE_SKIP);
				break;

			case '0x1': // НЕТ вы хэше , НАДО хэшировать
				$this->getfile($_file);
			case '1x1': // ЕСТЬ вы хэше , НАДО хэшировать
				$_Source = $this->cache[$_file]['source'];
				break;

			default:
				$_Source = false;
				break;
		}
		return $_Source;
	}


	public function write($_file, $_source)
	{
		if (!$this->is_writeble($_file)) // незаписываемый (доступ запрещен)
			return -1;
		
		$_return = $this->DB->query("REPLACE INTO ?# (`name`, `emtime`, `source`) VALUES (?, NOW(), ?)",
		$this->path, $_file, $_source);
		$this->cache[$_file]['source'] = $_source;
		
		return $_return;
	}

	public function emtime($_file)
	{
		if (!$this->is_readble($_file)) // нечитаемый (доступ запрещен)
			return -1;
				
		if (isset($this->cache[$_file]['emtime'])) // в кэше есть
			return $this->cache[$_file]['emtime'];
		
		$_emtime = $this->DB->selectCell("SELECT UNIX_TIMESTAMP(`emtime`) FROM ?# WHERE `name`=? {AND `enabled`=?d}",
		$this->path, $_file, (0==$this->Auth['UID'])?1:DBSIMPLE_SKIP);
		
		return $_emtime;
	}

	public function chown($_file, $_perm)
	{
		if (!$this->is_writeble($_file)) // незаписываемый (доступ запрещен)
			return -1;
	}
}

?>