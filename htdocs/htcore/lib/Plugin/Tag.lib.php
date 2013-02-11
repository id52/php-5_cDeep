<?

class Plugin_Tag implements Plugin {
	
	/* PUBLIC Section */
	
	public function __construct($cDeep, $isadm=false)
	{
		$this->DB = $cDeep->obj['DB'];
		$this->user = SysAuth::SESSION();
		$this->isadm = (!empty($this->user['UID']) && $isadm);
	}
	
	public function Controller($method, $params)
	{
		$prefix = ($this->isadm)?'adm':'pub';
		$method = $prefix.'_'.$method;
		if (method_exists($this, $method)) {
			return $this->$method($params);
		}
		else {	
			return;
		}
	}	
	public function Info()
	{
		
	}
	
	public function Security($event=null)
	{
		
	}
	
	private function pub_searchTag($params)
	{
		$Tag = $params['Tag'];
		if (!empty($Tag)) {
			$tQuery = 'SELECT * FROM `p_tag` WHERE `Tag` LIKE ? OR `Tag` LIKE ? LIMIT 10 ';
			return $this->DB->select($tQuery,  $Tag.'%', '% '.$Tag.'%');
		}
		else 
		{
			return array();
		}
	}
	private function adm_searchTag($params)
	{
		$Tag = $params['Tag'];
		if (!empty($Tag)) {
			$tQuery = 'SELECT * FROM `p_tag` WHERE `Tag` LIKE ? OR `Tag` LIKE ? LIMIT 10 ';
			return $this->DB->select($tQuery,  $Tag.'%', ' '.$Tag.'%');
		}
		else 
		{
			return array();
		}
	}
}