<?
/**
 * Registry
 *
 */
class Reg {

	private $DB = null;
	private $Cache = array();
	var $Stat = array();
	/**
	 * Init registry
	 *
	 */
	function __construct($cDeep)
	{
		$this->DB = $cDeep->obj['DB'];
	}

	/**
	 * Write or remove key
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param string $type
	 */
	function write($hkey, $value, $description="")
	{
		if(is_resource($this->DB->link))
		{
			if(list($Part,$Section,$Key)=preg_split( "#\]|\[|\.#is", $hkey, 4, PREG_SPLIT_NO_EMPTY))
			{
				$this->Stat["Write"][] = $Part.".".$Section.".".$Key;
				$type = gettype($value);
				switch (strtolower($type))
				{
					case "string":
						$result = strval($value);
						break;
					case "array":
						$result = serialize($value);
						break;
					case "integer":
						$result = intval($value);
						break;
					case "float":
						$result = floatval($value);
						break;
					case "object":
						break;
				}
				$tQuery = "REPLACE INTO `registry` (`chk`,`Part`,`Section`,`Key`,`Type`,`Value`";
				$tQuery.=($description)?",`Description`":"";
				$tQuery.= ") VALUES (?,?,?,?,?,?{,?})";
				$this->DB->query($tQuery, crc32($Part.$Section.$Key.$type), $Part, $Section, $Key, $type, $result, (empty($description)?DBSIMPLE_SKIP:$description));
			}
		}
	}

	function read($hkey, $type=NULL)
	{
		if((is_resource($this->DB->link) || $this->Cache[$hkey]) 
		&& list($Part,$Section,$Key)=preg_split( "#\]|\[|\.#is", $hkey, 4, PREG_SPLIT_NO_EMPTY))
		{
			$_hkey = $Part.".".$Section.".".$Key;
			$this->Stat["Read"][] = $_hkey;
			if ($this->Cache[$_hkey]) { #���� ���� � ����
				$this->Stat["Query"]["Cache"]++;
				$return = $this->Cache[$_hkey];
			}
			else {
				$this->Stat["Query"]["Base"]++;
				$return = NULL;
				$tQuery = array();
				$tQuery = 'SELECT `Part`, `Section`, `Key`, `Value`, `Type` FROM `registry` WHERE ';
				$tQuery.= "{`Part`=? AND }{`Section`=? AND }{`Key`=? AND }";
				$tQuery.= "1=1 ORDER BY `Part`,`Section`,`Key`, `rId` ASC";

				$hResult = $this->DB->select($tQuery, $Part, (empty($Section)?DBSIMPLE_SKIP:$Section), (empty($Key)?DBSIMPLE_SKIP:$Key));

				$i=0;
				while ($result=$hResult[$i]) {
					switch (strtolower($result["Type"]))
					{
						case "string":
							$tmp = strval($result["Value"]);
							break;
						case "array":
							$tmp = unserialize($result["Value"]);
							break;
						case "integer":
							$tmp = intval($result["Value"]);
							break;
						case "float":
							$tmp = floatval($result["Value"]);
							break;
						case "object":
							break;

					}
					$return[$result["Part"]][$result["Section"]][$result["Key"]] = $tmp;
					$this->Cache[$_hkey] = $return; #������� � ���
					$i++;
				}
			}
		}

		if(!empty($Part) && !empty($Section) && !empty($Key))
		{
			$return = $return[$Part][$Section][$Key];
		}
		elseif (!empty($Section) && empty($Key))
		{
			$return = $return[$Part][$Section];
		}
		elseif (empty($Section))
		{
			$return = $return;
		}

		return $return;
	}

	function __destruct()
	{
	}
}

?>