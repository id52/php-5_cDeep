<?
/**
 * Структура сайта
 *
 */
class Site
{


	private $Site 		= array();
	private $Current 	= array();
	private $Request	= array();
	private $State		= array();
	private $DB			= null;
	private $Templates	= null;

	function __construct($cDeep)
	{
		$this->DB = $cDeep->obj['DB'];
		$Cache = new Cache_Lite(array('caching'=>1,'automaticSerialization'=>1));
		if ($Site=$Cache->get('SiteStructure', 'Site'))  //очищается в Plugin_Site_Pages
		{
			$this->Site = $Site;
		}
		else 
		{
			
			$this->Site = $this->buildSite();
			$this->Site = $this->Site['index'];
			$Cache->save($this->Site, 'SiteStructure', 'Site');
		}
		$req = explode('?', urldecode(Globals::SERVER('REQUEST_URI')), 2);
    
    
    $req[0]=strtolower($req[0]);
     
		$this->Request = preg_split('|/|', $req[0], 100, PREG_SPLIT_NO_EMPTY);
	}
	
	

	
	
	private function buildSite($parent=0)
	{
		$Node = $this->DB->select('SELECT *,`node` AS ARRAY_KEY_1 FROM `t_site` WHERE `parent`=?d ORDER BY `order` ASC', $parent);
    
          If ($page['keywordsmeta']=="")
     $page['keywordsmeta']=$page['Title'];
     
         If ($page['descriptionmeta']=="")
     $page['keywordsmeta']=$page['Title'];
                
		while (list($i,$page)=each($Node)) 
		{
			$set = array(
				"Title"		=>$page['Title'],
				"keywordsmeta" =>$page['keywordsmeta'],
				"descriptionmeta"=>$page['descriptionmeta'],
        "titlemeta"=>$page['titlemeta'],
				"Topic"		=>$page['Topic'],
				"Template"	=>$page['Template'],
				"Env"		=>$page['Env'],
				"enabled"	=>$page['enabled'],
				"Attrib"=>array(
						"UID"=>$page['UID'],
						"GID"=>$page['GID'],
						"O"=>$page['O'],
						"G"=>$page['G'],
						"A"=>$page['A'],
						"P"=>$page['P'],
						)
				);
                        
                        
			if($page['Auth'])
			{
				$set["Auth"]=array(
					"Type"		=>$page['Auth'],
					"Topic"		=>"Конфиг",
					"Template"	=>"",
					);
			}	
			$Site[$page['name']] = array("."=>$set , "/"=>$this->buildSite($i));
		}
    
		return $Site;
	}
	
	private function resetExt($withExt)
	{
		//$withoutExt = str_replace('.xml', '', $withExt);
		$withoutExt = explode('.', $withExt);
		$withoutExt = $withoutExt[0];

		return $withoutExt;
	}

	function getCurrentState()
	{
		$Info 			= $this->iterateSite($this->Request);
		return $Info;
	}
	
	private function iterateSite($RequestPath)
	{
		$PathReset = true;
		$Site			= $this->Site;
		$Path			= array();
		$Path[]			= $Site["."];
		$Current		= $Site["."];
		$Env			= $Site["."]["Env"];
		$CurrentPath 	= '';
		$Current_item	= '';
		$Item			= '';
		$c=0;
		while (list($i, $index)=each($RequestPath)) {
			$index = $this->resetExt($index);

			if (is_array($Site["/"][$index]) && $PathReset) 
			{
				$Site				= $Site["/"][$index];
				$Path[$c]			= $Site["."];
				$Current			= $Site["."];
				$CurrentPath	   .= $index."/";
				$Path[$c]['index']	= $CurrentPath;
				$Env				= (!empty($Site["."]['Env']))?$Site["."]['Env']:$Env;
				$c++;
			}
			else
			{
				$PathReset = false;
				$Item[] = $index;
				$Current_item = $index;
			}
			
			/* Проверка доступа к странице! */
			#$SysAuth = SysAuth::SESSION();
			
			if (1 == SysAuth::isAllowedPage('read', $Site["."]['Attrib'], $Site["."]['Auth']['Type']))
			{
				
			}
			else  // доступ запрещен
			{
				switch ($Site["."]['Auth']['Type']) {
					case 'System':
						$Site["."]['Template'] = "file:sadm/login.tpl.php";
						$Current = $Site["."];
						$Env = false;
						break;
					case 'User':
						$Site["."]['Template'] = "file:login.tpl.php";
						$Current = $Site["."];
						$Env = false;
						break;
					default:
						$Site["."]['Template'] = 'file:errors/401.tpl.php';
						$Current = $Site["."];
						break;
				}
				break; //остановиться на этой странице если нет авторизации
			}
		}
		$this->Current = $Site;
		$Current["index"] = '/'.$CurrentPath;
		$Current_item = $this->resetExt($Current_item); // сброс расшерения страниц
		if(empty($Path[0]['index'])) { $Path[0]['index'] = 'index/'; }
		$this->State = array("Path"=>$Path, "Current"=>$Current, "Item"=>$Item, "Current_item"=>$Current_item, "Env"=>$Env, "Request"=>$this->Request);
		return $this->State;
	}
	public function getSite() {
		return $this->Site;
	}
	public function getMenu($start=null, $params=array())
	{
		$Menu = array();
		$startpoint = $this->Current['/'];
		$startlink	= $this->State['Current']['index'];
		$Request = $this->Request;
		#print_r($this);
		
		/*
		если указан парамерт $start (в виде пути /sadm/conf), то разобрать путь, найти ветку страниц сайта,
		соответствующую этому пути с вывести вложенные страницы.
		
		если параметр не указан, выводятся вложенные страницы текущей ветки ($this->Current)
		*/
		$linkLevel=intval($params['linkLevel']);
		if ($start) {
			$start		= preg_split('|/|', $start, 100, PREG_SPLIT_NO_EMPTY);
			$startlen = count($start);
			$startpoint = $this->Site['/'];
			$startlink = '';
			
			while (list(,$l)=each($start)) {
				$startpoint = $startpoint[$l]['/'];
				$startlink.= $l.'/';
				$linkLevel++;
			}
		}
		foreach ($startpoint as $link => $item)
		{
			#print_r($item['.']['Attrib']);
			//print $link.'|<br>'; //.'-'.SysAuth::isAllowedPage('read', $item['.']['Attrib']);
			
			if(1 == SysAuth::isAllowedPage('read', $item['.']['Attrib']) && $item['.']['enabled'])
			{
				$_Menu = array(
							"id"=>$link,
							"link"=>'/'.$startlink.$link.'/',
							"title"=>$item['.']['Title'],
							"lvl"=>$linkLevel,
							"req"=>$Request[$linkLevel],
							"selected"=>($Request[$linkLevel]==$link),
							);
				$linkLevel++;
				$_level=$params['level'];
				$params['linkLevel']=$linkLevel;
				$params['level']--;
				if ($params['level']>0) {
					$_Menu['SUB'] = $this->getMenu($_Menu['link'], $params);
				}
				$params['level']=$_level;
				$Menu[] = $_Menu;
			}
		}
		return $Menu;
	}
}
