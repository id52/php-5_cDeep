<?
final class SysAuth implements Event
{
	/**
	 * Список супергрупп
	 *
	 * @var unknown_type
	 */
	static $SUGroup = array(1);  //super группы
	/**
	 * Стек для хранения списка суперюзеров
	 *
	 * @var unknown_type
	 */
	static $SUIDs = array();
	
	public function __construct(&$cDeep)
	{
		$this->DB = $cDeep->obj['DB'];
	}
	
	public function Info()
	{
		return array(
		'Version'=>'1.0',
		'Name'=>'System Auth',
		);
	}
	
	public function Security($event=null)
	{
		$allowed = array(
					'AUTH','EXIT',
					);
		if (in_array($event, $allowed)) {
			return true;
		}
		return false;
	}
	
	public function onEvent($event, $args)
	{
		switch ($event) {
			case 'AUTH':
				$_SESSION['AUTH'] = array(
									'UID'=>0,
									'GID'=>0,
									'GIDs'=>array(),
									);
				$User = $this->getUser($args);
				if ($User)
				{
					$_SESSION['AUTH'] = $User;
					$return = 'AUTH_SUCCESS';
				}
				else 
				{
					$return = 'AUTH_FAILED';
				}
				break;
			case 'EXIT':
					$_SESSION['AUTH'] = null;
					unset($_SESSION['AUTH']);
					$return = 'EXIT_SUCCESS';
				break;
		
			default:
					$return = null;
				break;
		}
		return $return;
	}
	
	/***************** EVENT METHODS *************************/
	
	private function getUser($_user)
	{
		$User = $this->DB->selectRow('SELECT *, \'*\' AS `Passwd` FROM `t_sysuser` WHERE `Login`=? AND `Passwd`=?',
		$_user['Login'],
		self::Crypt($_user['Passwd']));
		
		if ($User['UID'])
		{
			$User['GIDs'] = $this->DB->selectCol('SELECT `GID` FROM `t_sysu2g` WHERE `UID`=?d', $User['UID']);
			$User['SUID'] = in_array($User['GID'], self::$SUGroup);
			if ($User['SUID'] == false) {
				foreach ($User['GIDs'] as $i=>$gid) {
					if(in_array($gid,self::$SUGroup))
					{
						$User['SUID'] = true;
						break;
					}
				}
			}
		}		
		return ($User['UID'])?$User:false;
	}
	
	/***************** END EVENT METHODS *********************/
	
	/***************** STATIC METHODS ************************/

	/**
	 * Криптует пароли
	 *
	 * @param string $string
	 * @return (crypt)string
	 */
	public static function Crypt($string)
	{
	    $string = md5($string.':'.$string);
	    return $string;
	}
	
	public static function SESSION()
	{
		$session = array(
					'UID'=>$_SESSION['AUTH']['UID'],
					'GID'=>$_SESSION['AUTH']['GID'],
					'GIDs'=>$_SESSION['AUTH']['GIDs'],
					'Login'=>$_SESSION['AUTH']['Login'],
					'SUID'=>$_SESSION['AUTH']['SUID'],
					);
		$session = $_SESSION['AUTH'];
		$session['Passwd'] = '*';
		return $session;
	}
	
	public static function isAllowedPage($_type, $_attributes, $auth=null)
	{
		$_user = self::SESSION();
		
		if (!empty($auth) && empty($_user['UID'])) { //если требуется авторизация но не авторизирован
			return 0;
		}
		
		if (empty($_user['UID']) && empty($_attributes['P'])) { //если не публичное и не авторизирован то сразу отлуп
			return 0;
		}
		
		if($_attributes['readonly']==1)
		{
			return 0;
		}
		
		if ($_user['UID']==1) { // суперюзер - поставить сюда SUID
			return 1;
		}
		
		if($_attributes['P'] && $_type == 'read')
		{
			return 1;
		}
		
		$_permission = $_attributes['A']; // все остальные
		
		if ($_attributes['UID']==$_user['UID']) // владелец
		{
			$_permission = $_attributes['O'];
		}
		elseif ($_attributes['GID']==$_user['GID'] || 
				(is_array($_user['GIDs']) && 
				in_array($_attributes['GID'], $_user['GIDs']))) // юзер в группе файла
		{
			$_permission = $_attributes['G'];
		}
		
		$_permission = self::decbin($_permission);
		switch ($_type) {
			case 'read':
				return $_permission['R'];
				break;
				
			case 'write':
				return $_permission['W'];
				break;
				
			case 'execute':
				return $_permission['X'];
				break;
		
			default:
				return -1;
				break;
		}	
	}
	/**
	 * Преобразует двоичную форму (массивом) прав доступа в десятичную
	 *
	 * @param array $bin
	 * @return int
	 */
	public static function bindec($bin)
	{
		if (is_array($bin)) {
			$return = ($bin['R'])?1:0;
			$return.= ($bin['W'])?1:0;
			$return.= ($bin['X'])?1:0;
			return (int)bindec($return);
		}
		else 
		{
			return (int)$bin;
		}
	}
	/**
	 * Преобразует десятичную форму прав доступа в двоичную (массивом)
	 *
	 * @param int $dec
	 * @return array
	 */
	public static function decbin($dec)
	{
		if (is_array($dec)) {
			return array('R'=>$dec['R'],'W'=>$dec['W'],'X'=>$dec['X']);
		}
		else 
		{
			$bin = decbin($dec);
			$bin = str_repeat('0', 3-strlen($bin)).$bin;
			$return['R'] = substr($bin, 0, 1);
			$return['W'] = substr($bin, 1, 1);
			$return['X'] = substr($bin, 2, 1);
			return (array)$return;
		}
	}
	/***************** END STATIC METHODS *********************/
	
	/***************** PRIVATE METHODS ************************/
	
	/**
	 * Дабавление юзера
	 *
	 * @param array $_user
	 * @return int
	 */
	private function addUser($_user)
	{
		$user = array(
		'GID'=>1,
		'Login'=>$_user['Login'],
		'Passwd'=>self::Crypt($_user['Passwd']),
		'Name'=>$_user['Name'],
		'Surname'=>$_user['Surname'],
		'Photo'=>$_user['Photo'],
		'Post'=>$_user['Post'],
		'About'=>$_user['About'],
		'Phone'=>$_user['Phone'],
		'URL'=>$_user['URL'],
		'Email'=>$_user['Email'],
		);
		
		$tQuery = 'INSERT IGNORE INTO `t_sysuser` (?#) VALUES (?a)';
		$UID = $this->DB->query($tQuery, array_keys($user), array_values($user));
		if($UID)
		{
			//добавился. создать ему группу и загнать его в свою группу овнером
			return $UID;
		}
		return 'ADDUSRFAILED';
	}
	
	/**
	 * Редактирование юзера
	 *
	 * @param array $_user
	 * @return int
	 */
	private function editUser($_user)
	{
		if (!empty($_user['Passwd']) && $_user['Passwd'] != $_user['RePasswd'])
		{
			return 'MISMATCHPWD';
		}
		
		$user = array(
		'Name'=>$_user['Name'],
		'Surname'=>$_user['Surname'],
		'Photo'=>$_user['Photo'],
		'Post'=>$_user['Post'],
		'About'=>$_user['About'],
		'Phone'=>$_user['Phone'],
		'URL'=>$_user['URL'],
		'Email'=>$_user['Email'],
		);
		
		if(!empty($_user['Passwd'])) { $user['Passwd'] = self::Crypt($_user['Passwd']); }
		
		$tQuery = 'UPDATE `t_sysuser` SET ?a WHERE `UID` = ?d';
		$return = $this->DB->query($tQuery, $user, $_user['UID']);
		if($return)
		{
			return 'UPDATED';
		}
		return 'UPDATEFAILED';
	}
	
    /**
     * Удаление юзера
     *
     * @param array $_user
     * @return int
     */
    private function delUser($id)
    {
        if ($id == 1)
        {
            return 'NOTPERMITTED';
        }
               
        $tQuery = 'DELETE FROM `t_sysuser` WHERE `UID` = ?d';
        $return = $this->DB->query($tQuery, $id);
        if($return)
        {
            return 'DELETED';
        }
        return 'DELETEFAILED';
    }
    	
	
	/**
	 * Дабавление группы
	 *
	 * @param array $_group
	 * @return int
	 */
	private function addGroup($_group)
	{
		$group = array(
		'Name'=>$_group['Name'],
		'Description'=>$_group['Description'],
		);
		
		$tQuery = 'INSERT IGNORE INTO `t_sysgroup` (?#) VALUES (?)';
		$GID = $this->DB->query($tQuery, array_keys($group), array_values($group));
		if($GID)
		{
			return $GID;
		}
		return 'ADDGRPFAILED';
	}
	
	private function listUsers($groups=null)
	{
		if (!empty($groups)) {
			$groups = is_array($groups)?$groups:array($groups);
			$tQuery = 'SELECT *, `UID` AS ARRAY_KEY_1, \'*\' AS `Passwd` FROM `t_sysuser` WHERE `GID` IN (?a)';
			$users = $this->DB->query($tQuery, $groups);
		}
		else 
		{
			$users = array();
		}
		return $users;
	}
	private function listGroups()
	{
		$Groups = $this->DB->query('SELECT * FROM `t_sysgroup`');
		return $Groups;
	}
	
	private function listUser($UID)
	{
		$User = $this->DB->selectRow('SELECT *, \'*\' AS `Passwd` FROM `t_sysuser` WHERE `UID`=?', $UID);
		
		if ($User['UID'])
		{
			$User['GID'] = $this->DB->select('SELECT `GID`,`Name`{,(`GID`=?d) AS `selected`} FROM `t_sysgroup` ORDER BY `Name` ASC', $User['GID']?$User['GID']:DBSIMPLE_SKIP);			
			$User['GIDs'] = $this->DB->selectCol('SELECT `GID` FROM `t_sysu2g` WHERE `UID`=?d', $User['UID']);
			$User['GIDs'] = $this->DB->select('SELECT `GID`,`Name`{,(`GID` IN (?a)) AS `selected`} FROM `t_sysgroup` ORDER BY `Name` ASC', count($User['GIDs'])?$User['GIDs']:DBSIMPLE_SKIP);
		}
		
		return ($User['UID'])?$User:false;
	}
	
	public function userManager($method, $args)
	{
		if (method_exists($this, $method)) {
			return $this->$method($args);
		}
	}
	/***************** END METHODS ************************/
}
?>