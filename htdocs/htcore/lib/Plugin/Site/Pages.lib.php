<?
final class Plugin_Site_Pages implements Plugin {

	public function __construct($cDeep, $isadm=false)
	{
		$this->DB = $cDeep->obj['DB'];
		$this->user = SysAuth::SESSION();
		$this->isadm = (!empty($this->user['UID']) && $isadm);
		$this->Item = $cDeep->State['Item'];
		$this->Current_item = $cDeep->State['Current_item'];
		


	}

	public function Info()
	{
		return array(
		'Version'=>'1.0',
		'Name'=>'Page Management Plugin',
		);
	}

	public function Security($event=null)
	{

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
	/****************************************************************************************/
	
	private function recheckNodes($Page)
	{

		//$this->DB->query('UPDATE `t_site` SET `subnodes`=t_site_count(`node`) WHERE `node`=?d', $Page['parent']);
		//пересчетать ВСЕ страницы !!!! - заменить на пересчет по условию.
		$Cache = new Cache_Lite(array('caching'=>1,'automaticSerialization'=>1));
		$Cache->clean('Site', 'ingroup');
		//$this->DB->query('UPDATE `t_site` SET `subnodes`=`t_site_count`(`node`), `level`=`t_site_sublevel`(`parent`) WHERE `parent`>0');
		
		
		///////////////////////////////////////////вместо процедур
		$tsite=$this->DB->query('select * from `t_site` WHERE `parent`>0');
		foreach ($tsite as $t)
		{
			$t_site_sublevel=$this->DB->selectRow("SELECT (`level`+1) as `count` FROM `t_site` WHERE `node`=?",$t['node']); 
			$this->DB->query('UPDATE `t_site` SET `level`=? WHERE `parent`=?',$t_site_sublevel['count'], $t['node']);
			
			$t_site_count=$this->DB->selectRow("SELECT COUNT(`node`) as `count` FROM `t_site` WHERE `parent`=?",$t['node']); 
			$this->DB->query('UPDATE `t_site` SET `subnodes`=? WHERE `node`=?', $t_site_count['count'], $t['node']);
		};
		
	}
	private function saveTemplate($params)
	{
		$Template = array(
			'name'      =>'tpl.page.'.$params['node'],
			'Description' =>$params['Description'],
		//'descriptionmeta' =>$params['descriptionmeta'],
        //'keywordsmeta' =>$params['keywordsmeta'],
			'source'     =>$params['TemplateSource'],
			'Auth'      =>$params['Auth'],
			'UID'     =>$params['UID'],
			'GID'     =>$params['GID'],
			'O'       =>$params['O'],
			'G'       =>$params['G'],
			'A'       =>$params['A'],
			'P'       =>intval($params['P']),
			'enabled'   =>1, //intval($params['enabled']),
			'type'	=>'tpl',
		);
		$tQuery = 'REPLACE INTO `t_template` (?#) VALUES (?a)';
		if($this->DB->query($tQuery, array_keys($Template), array_values($Template)))
		{
			
		}
	}
	
	/****************************************************************************************/
	private function adm_listPages($params)
	{
		$parent = intval($params['parent']);
		$List = $this->DB->select('SELECT * FROM `t_site` WHERE `parent`=?d ORDER BY `order`', $parent);
		foreach ($List as $i=>$Page)
		{
			if (1 == SysAuth::isAllowedPage('read', array('UID'=>$Page['UID'],'GID'=>$Page['GID'],'O'=>$Page['O'],'G'=>$Page['G'],'A'=>$Page['A'],'P'=>$Page['P']))) /* если на чтение права есть */
			{
				$Pages['List'][] = $Page;
			}
		}
		$Pages['UP'] = $this->DB->selectRow('SELECT * FROM `t_site` WHERE `node`=?d ORDER BY `order`', $parent);
		return $Pages;
	}
	private function adm_editPage($params)
	{

		if (empty($params['node']))
		{
			return array('Status'=>'EMPTYNODE');
		}

		$Page = $this->DB->selectRow('SELECT `node`,`UID`,`GID`,`O`,`G`,`A`,`P` FROM `t_site` WHERE `node`=?d ORDER BY `order`', $params['node']);
		if (empty($Page['node']))
		{
			return array('Status'=>'NOTFOUND');
		}
		if (1 != SysAuth::isAllowedPage('write', $Page)) /* если на запись прав нет */
		{
			return array('Status'=>'UPDATEDENIED');
		}

		$params['O'] = SysAuth::bindec($params['O']);
		$params['G'] = SysAuth::bindec($params['G']);
		$params['A'] = SysAuth::bindec($params['A']);
		if ($params['readonly'])
		{
			$Page = array(
				'name'      =>$params['name'],
				'Title'     =>$params['Title'],
        'Topic'     =>$params['Topic'],
		'Description' =>$params['Description'],
        'descriptionmeta' =>$params['descriptionmeta'],
        'keywordsmeta' =>$params['keywordsmeta'],
        'titlemeta' =>$params['titlemeta'],
				'UID'     =>$params['UID'],
				'GID'     =>$params['GID'],
				'O'       =>$params['O'],
				'G'       =>$params['G'],
				'A'       =>$params['A'],
				'P'       =>0,
				'enabled'   =>1,
				'readonly'    =>1,
			);
			$params['readonly'] = 1;
		}
		else
		{
			$Page = array(
				'name'      =>$params['name'],
				'Title'     =>$params['Title'],
         'titlemeta'     =>$params['titlemeta'],
				'Topic'     =>$params['Topic'],
				'Description' =>$params['Description'],
        'descriptionmeta' =>$params['descriptionmeta'],
        'keywordsmeta' =>$params['keywordsmeta'],
        'titlemeta' =>$params['titlemeta'],
				'Env'     =>$params['Env'],
				'Template'    =>$params['Template'],
				'Auth'      =>$params['Auth'],
				'UID'     =>$params['UID'],
				'GID'     =>$params['GID'],
				'O'       =>$params['O'],
				'G'       =>$params['G'],
				'A'       =>$params['A'],
				'P'       =>intval($params['P']),
				'enabled'   =>intval($params['enabled']),
				'readonly'    =>0,

			);
                        If ($params['keywordsmeta']=="")
                                     $params['keywordsmeta']=$params['Title'];
                        
			$params['readonly'] = 0;

			if ($params['Template']=='tpl.page.'.$params['node']) {
				$this->saveTemplate($params);
			}
		}

		$tQuery = 'UPDATE `t_site` SET ?a WHERE `readonly`=?d AND `node`=?d';
		if($this->DB->query($tQuery, $Page, $params['readonly'], $params['node']))
		{
			$Cache = new Cache_Lite(array('caching'=>1,'automaticSerialization'=>1));
			$Cache->clean('Site', 'ingroup');
			return array('Status'=>'UPDATED');
		}
		return array('Status'=>'UPDATEFAILED');
	}

	private function adm_newPage($params)
	{
		$Page['parent'] = $params['parent']; //проверить права на запись в родительский шаблон (можно ли создовать дочерние?)!!!!!!!
		$params = GLOBALS::REQUEST('Page');
		
		if ( empty($params['name']) && !empty($params['Title']) ){
            $params['name'] = Filter::translit($params['Title']);
		}
		
		if(!empty($params['name']) && empty($params['node']) && $Page['parent'] == $params['parent'])
		{
			$params['O'] = SysAuth::bindec($params['O']);
			$params['G'] = SysAuth::bindec($params['G']);
			$params['A'] = SysAuth::bindec($params['A']);

			$Page = array(
				'name'      =>$params['name'],
				'parent'    =>$params['parent'],
				'level'	=>-1, // level родителя + 1
				'Title'     =>$params['Title'],
				'titlemeta'     =>$params['titlemeta'],
				'Topic'     =>$params['Topic'],
				'Description' =>$params['Description'],
				'descriptionmeta' =>$params['descriptionmeta'],
				'keywordsmeta' =>$params['keywordsmeta'],
				'Env'     =>$params['Env'],
				'Template'    =>$params['Template'],
				'Auth'      =>$params['Auth'],
				'UID'     =>$params['UID'],
				'GID'     =>$params['GID'],
				'O'       =>$params['O'],
				'G'       =>$params['G'],
				'A'       =>intval($params['A']),
				'P'       =>intval($params['P']),
				'enabled'   =>intval($params['enabled']),
				'readonly'    =>0,
			);
                        //Копирование во вторую вкладку свойтсв
                        If (!$Page['keywordsmeta'])
                                     $Page['keywordsmeta']=$Page['Title'];
                        If (!$Page['Description'])
                                     $Page['Description']=$Page['Title'];
                        If (!$Page['titlemeta'])
                                     $Page['titlemeta']=$Page['Title'];
                        If (!$Page['descriptionmeta'])
                                     $Page['descriptionmeta']=$Page['Title'];
                        If (!$Page['Template'])
                                     $Page['Template']=$Page['Title'];
                        If (!$Page['Topic'])
                                     $Page['Topic']=$Page['Title'];
                       
                        
                        
                        
			$tQuery = 'INSERT INTO `t_site` (?#) VALUES (?a)';
			$Page['node'] = $this->DB->query($tQuery, array_keys($Page), array_values($Page));
			if ($Page['node']) {
				$params['node'] = $Page['node'];
				if ($Page['Template']=='tpl.page.') {
					$this->saveTemplate($params);
					$this->DB->query('UPDATE `t_site` SET `Template`=? WHERE `node`=?d',$Page['Template'].$Page['node'],$Page['node']);
				}
				$this->recheckNodes($Page);
				
				header('Location: property['.$Page['node'].'].xml');
				return array('Status'=>'ADDED');
			}
		}
		else
		{
			$Page['readonly'] = 0;
			$Page['UID'] = $this->user['UID'];
			$Page['GID'] = $this->user['GID'];
		}

		$Page['O'] = array('R'=>1, 'W'=>1, 'X'=>1);
		$Page['G'] = array('R'=>1, 'W'=>0, 'X'=>0);
		$Page['A'] = array('R'=>0, 'W'=>0, 'X'=>0);
		
    $Page['P'] = 1;
    $Page['enabled'] = 1;
    
				
		$Page['writable'] = 1;
		$Page['Template'] = 'tpl.page.';
		$Page['UIDs'] = $this->DB->select('SELECT `UID`,`Login`,`Name`,`Surname`,(`UID`=?d) AS `selected` FROM `t_sysuser` ORDER BY `Name` ASC, `Surname` ASC', $this->user['UID']);
		$Page['GIDs'] =  $this->DB->select('SELECT `GID`,`Name`,(`GID`=?d) AS `selected` FROM `t_sysgroup` ORDER BY `Name` ASC', $this->user['GID']);
		$tQuery = 'SELECT `node`,`name`,`Description`,`emtime`,`enabled`,(`name`=?) AS `selected` FROM `t_template` WHERE `type`=? ORDER BY `node` ASC';
		$Page['Tpls'] =  $this->DB->select($tQuery, $Page['Template'], 'tpl');
		$Page['Envs'] =  $this->DB->select($tQuery, $Page['Env'], 'env');
		$Page['TemplateSource'] = '';
		return $Page;
	}
	/**
   * Получает свойства страницы из базы
   *
   * @param array $params
   * @return array
   */
	private function adm_propPage($params)
	{
		$Page = $this->DB->selectRow('SELECT * FROM `t_site` WHERE `node`=?d ORDER BY `order`', $params['node']);
		if (empty($Page['node'])) /* если пусто */
		{
			return array('Status'=>'NOTFOUND');
		}
		if (1 == SysAuth::isAllowedPage('read', array('UID'=>$Page['UID'],'GID'=>$Page['GID'],'O'=>$Page['O'],'G'=>$Page['G'],'A'=>$Page['A'],'P'=>$Page['P']))) /* если на чтение права есть */
		{
			$Page['O'] = SysAuth::decbin($Page['O']);
			$Page['G'] = SysAuth::decbin($Page['G']);
			$Page['A'] = SysAuth::decbin($Page['A']);
			$Page['UIDs'] = $this->DB->select('SELECT `UID`,`Login`,`Name`,`Surname`,(`UID`=?d) AS `selected` FROM `t_sysuser` ORDER BY `Name` ASC, `Surname` ASC',$Page['UID']);
			$Page['GIDs'] =  $this->DB->select('SELECT `GID`,`Name`,(`GID`=?d) AS `selected` FROM `t_sysgroup` ORDER BY `Name` ASC',$Page['GID']);
			$tQuery = 'SELECT `node`,`name`,`Description`,`emtime`,`enabled`,(`name`=?) AS `selected` FROM `t_template` WHERE `type`=? ORDER BY `node` ASC';
			$Page['writable'] = (1 == SysAuth::isAllowedPage('write', array('UID'=>$Page['UID'],'GID'=>$Page['GID'],'O'=>$Page['O'],'G'=>$Page['G'],'A'=>$Page['A'],'P'=>$Page['P'])));
			if ($Page['readonly']==0 && $Page['writable']) /* получать список шаблонов и оболочек только если возможна их смена */
			{
				$Page['Tpls'] =  $this->DB->select($tQuery,$Page['Template'], 'tpl');
				$Page['Envs'] =  $this->DB->select($tQuery,$Page['Env'], 'env');
				$Page['TemplateSource'] = $this->DB->selectCell('SELECT `source` FROM `t_template` WHERE `name`=?', 'tpl.page.'.$Page['node']);
			}                                                                                                                                                    
			$Page['Status'] = 'OK';
			return $Page;
		}
		else
		{
			return array('Status'=>'DENIED');
		}
		return array('Status'=>'DENIED'); /* нет доступа */
	}

	private function adm_removePage($params)
	{
		$Page = $this->DB->selectRow('SELECT * FROM `t_site` WHERE `node`=?d', intval($params['node']));
		if (empty($Page['node'])) /* если пусто */
		{
			return array('Status'=>'NOTFOUND');
		}
		if (1 == SysAuth::isAllowedPage('write', array('UID'=>$Page['UID'],'GID'=>$Page['GID'],'O'=>$Page['O'],'G'=>$Page['G'],'A'=>$Page['A'],'P'=>$Page['P'],'readonly'=>$Page['readonly']))) /* если на запись права есть */
		{
			$tQuery = 'DELETE FROM `t_site` WHERE `node`=?d';
			if ($this->DB->query($tQuery, $Page['node'])) {
				$this->recheckNodes($Page);
				return array('Status'=>'REMOVED', 'parent'=>$Page['parent']);
			}
			return array('Status'=>'REMOVEFAILED', 'parent'=>$Page['parent']);
		}
		return array('Status'=>'DENIED', 'parent'=>$Page['parent']);
	}

	private function adm_sortMenu($params)
	{
		if (is_array($params['Sort'])) {
			while (list($i,$node)=each($params['Sort'])) {
				$this->DB->query('UPDATE `t_site` SET `order`=?d WHERE `node`=?d', intval($i), intval($node));
			}
			$Cache = new Cache_Lite(array('caching'=>1,'automaticSerialization'=>1));
			$Cache->clean('Site', 'ingroup');
			return array('Status'=>'RESORTED');
		}
		return array('Status'=>'RESORTFAILED');
	}
}