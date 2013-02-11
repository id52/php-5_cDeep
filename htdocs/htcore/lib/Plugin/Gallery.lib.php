<?
class Plugin_Gallery implements Plugin
{

	public function __construct($cDeep, $isadm=false)
	{
		$this->DB = $cDeep->obj['DB'];
		$this->user = SysAuth::SESSION();
		$this->isadm = (!empty($this->user['UID']) && $isadm);
		$this->Item = $cDeep->State['Item'];
		$this->Current_item = $cDeep->State['Current_item'];
	}
	
	public function Controller($method, $params)
	{
		$prefix = ($this->isadm)?'adm':'pub';
		$method = $prefix.'_'.$method;
		if (method_exists($this, $method)) {
			return $this->$method($params);
		}
		else {
		}
	}
	
	public function Info()
	{
		
	}
	
	public function Security($event=null)
	{
		
	}
	
	private function getAuthors()
	{
		$tQuery = 'SELECT DISTINCT `Author` FROM `p_gallery` WHERE `enabled`=1 AND `count`>0 ORDER BY `Author` ASC';
		$Authors = $this->DB->selectCol($tQuery);
		return $Authors;
	}
	private function getPlaces()
	{
		$tQuery = 'SELECT DISTINCT `Place` FROM `p_gallery` WHERE `enabled`=1 AND `count`>0 ORDER BY `Place` ASC';
		$Places = $this->DB->selectCol($tQuery);
		return $Places;
	}
	private function getMohths()
	{
		
	}

	/**
	 * Список всех галерей, выборка по условию.
	 *
	 */
	private function adm_listGallery($params)
	{
		$onpage = 20;
		$p = intval(Globals::REQUEST('p'));
		$p = ($p > 1)?($p):1;
		$primaryTagId = $params['primaryTagId'];
		
		$tQuery = 'SELECT COUNT(`id`) FROM `p_gallery` WHERE 1=1 { AND `primaryTagId`=?d }{ AND `UID`=?d}{ AND `src` != ?}';
		$count = $this->DB->selectCell($tQuery,  ($primaryTagId)?$primaryTagId:DBSIMPLE_SKIP, ($this->user['SUID'])?DBSIMPLE_SKIP:$this->user['UID'], ($this->isadm)?DBSIMPLE_SKIP:'');
		$Pages['count'] = ceil($count/$onpage);
		$Pages['current'] = ($p > $Pages['count'])?$Pages['count']:$p;
		$Pages['prev'] = ($Pages['current'] > 1)?($Pages['current']-1):0;
		$Pages['next'] = ($Pages['current'] < $Pages['count'])?($Pages['current']+1):0;
		$start = abs($Pages['current']-1)*$onpage;
		$Galleries['Pages'] = $Pages;
		
		$tQuery = 'SELECT *, `id` AS ARRAY_KEY_1 FROM `p_gallery` WHERE 1=1 { AND `primaryTagId`=?d }{ AND `UID`=?d}{ AND `src` != ?} ORDER BY `Date` DESC LIMIT ?d, ?d';
		$Galleries['List'] = $this->DB->select($tQuery, ($primaryTagId)?$primaryTagId:DBSIMPLE_SKIP, ($this->user['SUID'])?DBSIMPLE_SKIP:$this->user['UID'], ($this->isadm)?DBSIMPLE_SKIP:'', $start, $onpage);
		
		return $Galleries;
	}
	private function pub_topGallery($params)
	{
		$current = $params['current'];
		$current = $this->Current_item;
		if (count($this->Item)==4) {
			$Place = urldecode($this->Item[0]);
			$Month = intval($this->Item[1]);
			$Author = urldecode($this->Item[2]);
		}
		
		if(!empty($current))
		{
		    $tQuery = 'SELECT * FROM `p_gallery` WHERE{ `Place`=? AND}{ MONTH(`Date`)=?d AND}{ `Author`=? AND} `src`!=? AND `enabled`=1 AND `Date` > `p_gallery_date`(?d) ORDER BY `Date` ASC LIMIT 16';
		    $part1 = $this->DB->select($tQuery, ($Place)?$Place:DBSIMPLE_SKIP, ($Month)?$Month:DBSIMPLE_SKIP, ($Author)?$Author:DBSIMPLE_SKIP, '', $current);
		    
		    $tQuery = 'SELECT * FROM `p_gallery` WHERE{ `Place`=? AND}{ MONTH(`Date`)=?d AND}{ `Author`=? AND} `src`!=? AND `enabled`=1 AND `Date` <= `p_gallery_date`(?d) ORDER BY `Date` DESC LIMIT 15';
		    $part2 = $this->DB->select($tQuery, ($Place)?$Place:DBSIMPLE_SKIP, ($Month)?$Month:DBSIMPLE_SKIP, ($Author)?$Author:DBSIMPLE_SKIP, '', $current);
		    
		    $part1 = array_reverse($part1);
		    $Galleries['List'] = array_merge($part1, $part2);
		}
		else
		{
		    $tQuery = 'SELECT * FROM `p_gallery` WHERE{ `Place`=? AND}{ MONTH(`Date`)=?d AND}{ `Author`=? AND} `src`!=? AND `enabled`=1 ORDER BY `Date` DESC LIMIT 25';
		    $Galleries['List'] = $this->DB->select($tQuery, ($Place)?$Place:DBSIMPLE_SKIP, ($Month)?$Month:DBSIMPLE_SKIP, ($Author)?$Author:DBSIMPLE_SKIP, '');
		}
		
		$count = count($Galleries['List']);
		$count = ($count > 1)?($count-1):0;

		$j=0;
		$i=-1;
		if($current)
		{
			$i=0;
			while ($count > $i) {
				if ($Galleries['List'][$i]['id']==$current) {
					break;
				}
				$i++;
			}
			$j = $i;
			$j = ($j>1)?($j-2):0;
			#$j = ($j>3)?($j-rand(-1,1)):$j;
			$j = ($j<($count-4))?$j:($count-4);
		}
		$Galleries['CurPos']  = $j;
		$Galleries['RealCurPos']  = $i;
		$Galleries['Authors'] = $this->getAuthors();
		$Galleries['Places'] = $this->getPlaces();
		$Galleries['Months'] = $this->getMohths();

		$Galleries['MaxDate'] = $Galleries['List'][0]['Date'];
		$Galleries['MinDate'] = (substr($Galleries['List'][0]['Date'], 0, 7)==substr($Galleries['List'][$count]['Date'], 0, 7))?false:$Galleries['List'][$count]['Date'];
		return $Galleries;
	}
	private function pub_listGallery($params)
	{
		print 'pub_listGallery';
		$onpage = 10;
		$p = intval(Globals::REQUEST('p'));
		$p = ($p > 1)?($p):1;
		
		$tQuery = 'SELECT COUNT(`id`) FROM `p_gallery` WHERE `src`!=? AND `enabled`=1';
		$count = $this->DB->selectCell($tQuery, '');
		$Pages['count'] = ceil($count/$onpage);
		$Pages['current'] = ($p > $Pages['count'])?$Pages['count']:$p;
		$Pages['prev'] = ($Pages['current'] > 1)?($Pages['current']-1):0;
		$Pages['next'] = ($Pages['current'] < $Pages['count'])?($Pages['current']+1):0;
		
		$start = abs($Pages['current']-1)*$onpage;
		
		
		$tQuery = 'SELECT * FROM `p_gallery` WHERE `src`!=? AND `enabled`=1 ORDER BY `Date` DESC LIMIT ?d, ?d';
		$Galleries['List'] = $this->DB->select($tQuery, '', $start, $onpage);

		$count = count($Galleries['List']);
		$count = ($count > 1)?($count-1):0;
		$Galleries['Pages'] = $Pages;
		
		$Galleries['MaxDate'] = $Galleries['List'][0]['Date'];
		$Galleries['MinDate'] = (substr($Galleries['List'][0]['Date'], 0, 7)==substr($Galleries['List'][$count]['Date'], 0, 7))?false:$Galleries['List'][$count]['Date'];
		return $Galleries;
	}


	/**
	 * Выборка всех фоток из галереи. Выборка по условию.
	 *
	 */
	private function adm_listPhoto($params)
	{
		$tQuery = 'SELECT * FROM `p_gallery_photo` WHERE `gid`=?d ORDER BY `Order` ASC';
		$Photos = $this->DB->select($tQuery, $params['id']);
		return $Photos;
	}
	private function pub_listPhoto($params)
	{
		$onpage = 39;
		$p = intval(Globals::REQUEST('p'));
		$p = ($p > 1)?($p):1;
		
		$tQuery = 'SELECT COUNT(`id`) FROM `p_gallery_photo` WHERE `gid`=?d AND `enabled`=1';
		$count = $this->DB->selectCell($tQuery, $params['id']);
		$Pages['count'] = ceil($count/$onpage);
		$Pages['current'] = ($p > $Pages['count'])?$Pages['count']:$p;
		$Pages['prev'] = ($Pages['current'] > 1)?($Pages['current']-1):0;
		$Pages['next'] = ($Pages['current'] < $Pages['count'])?($Pages['current']+1):0;
		
		$start = ($Pages['current']-1)*$onpage;
		
		$tQuery = 'SELECT * FROM `p_gallery_photo` WHERE `gid`=?d AND `enabled`=1 ORDER BY `Order` ASC LIMIT ?d, ?d';
		$Photos['List'] = $this->DB->select($tQuery, $params['id'], $start, $onpage);
		$Photos['Pages'] = $Pages;
		return $Photos;
	}

	private function adm_getGallery($params)
	{
		$tQuery = 'SELECT * FROM `p_gallery` WHERE `id`=?d { AND `UID`=?d}';
		$Gallery = $this->DB->selectRow($tQuery, $params['id'], ($this->user['SUID'])?DBSIMPLE_SKIP:$this->user['UID']);
		if($Gallery['id'])
		{
			$Gallery['Photos'] = $this->adm_listPhoto($params);
		}
		return $Gallery;
	}
	private function pub_getGallery($params)
	{
		$tQuery = 'SELECT * FROM `p_gallery` WHERE `id`=?d AND `enabled`=1';
		$Gallery = $this->DB->selectRow($tQuery, $params['id']);
		if($Gallery['id'])
		{
			$Gallery['Photos'] = $this->pub_listPhoto($params);
		}
		return $Gallery;
	}

	private function adm_propGallery($params)
	{
		$tQuery = 'SELECT * FROM `p_gallery` WHERE `id`=?d { AND `UID`=?d}';
		$Gallery = $this->DB->selectRow($tQuery, $params['id'], ($this->user['SUID'])?DBSIMPLE_SKIP:$this->user['UID']);
		$Gallery['ListAuthors'] = ($this->user['SUID'])?
		$this->DB->selectCol('SELECT `UID` AS ARRAY_KEY_1, CONCAT(`Name`,\' \',`Surname`) FROM `t_sysuser` WHERE `Rang`<=?d ORDER BY `UID`', $this->user['Rang'])
		:array($this->user['UID'] => $this->user['Name'].' '.$this->user['Surname']);
		return $Gallery;
	}

	private function adm_editGallery($_Gallery)
	{
		$Gallery = array(
		"Name"			=>$_Gallery['Name'],
		"Place"			=>$_Gallery['Place'],
		"Description"	=>$_Gallery['Description'],
		"Date"			=>$_Gallery['Date'],
		"enabled"		=>intval($_Gallery['enabled']),
		);
		if($this->user['SUID'])
		{
			$Gallery['UID']		= ($_Gallery['UID'])?$_Gallery['UID']:$this->user['UID'];
			$Gallery['Author']	= ($_Gallery['Author'])?$_Gallery['Author']:$this->user['Name'].' '.$this->user['Surname'];
		}

		$tQuery = 'UPDATE `p_gallery` SET ?a, `primaryTagId`=`p_tag_getByName`(?) WHERE `id`=?d {AND `UID`=?d}';
		$return = $this->DB->query($tQuery, $Gallery, $Gallery['Place'], $_Gallery['id'], ($this->user['SUID'])?DBSIMPLE_SKIP:$this->user['UID']);
		return ($return)?'UPDATED':'UPDATEFAILED';
	}

	private function adm_removeGallery($_Gallery)
	{
		$Gallery = $this->adm_getGallery(array('id'=>$_Gallery['id']));
		if($Gallery['id'])
		{
			$tQuery = 'DELETE FROM `p_gallery` WHERE `id`=?d {AND `UID`=?d} LIMIT 1';
			$return = $this->DB->query($tQuery, $Gallery['id'], ($this->user['SUID'])?DBSIMPLE_SKIP:$this->user['UID']);
			if($return)
			{
				$prefix = 'upload/gallery/';
				while (list($i, $Photo)=each($Gallery['Photos'])) {
					if(file_exists($prefix.$Photo['src'])) { unlink($prefix.$Photo['src']); }
				}

				$tQuery = 'DELETE FROM `p_gallery_photo` WHERE `gid`=?d ';
				$this->DB->query($tQuery, $Gallery['id']);
				#print_r($this->DB);
			}
		}
		return ($return)?'REMOVED':'REMOVEFAILED';
	}

	private function adm_addGallery($_Gallery)
	{
		$_Gallery['UID'] = empty($_Gallery['UID'])?$this->user['UID']:$_Gallery['UID']; // если не указано, владельцем ставить создающего
		$Gallery = array(
		"UID"			=>($this->user['SUID'])?$_Gallery['UID']:$this->user['UID'], // если суперюзер то позволять указывать владельца
		"Author"		=>($this->user['SUID'])?$_Gallery['Author']:$this->user['Name'].' '.$this->user['Surname'], // если суперюзер то позволять указывать автора
		"Name"			=>$_Gallery['Name'],
		"Place"			=>$_Gallery['Place'],
		"Description"	=>$_Gallery['Description'],
		"Date"			=>$_Gallery['Date'],
		"enabled"		=>$_Gallery['enabled'],
		);

		$tQuery = 'INSERT IGNORE INTO `p_gallery` (?#, `primaryTagId`) VALUES (?a, `p_tag_getByName`(?))';
		$id = $this->DB->query($tQuery, array_keys($Gallery), array_values($Gallery), $Gallery['Place']);
		if ($id) {
			header('Location: property['.$id.'].xml'); //не на месте! должно быть в плагине смарти
			return $id;
		}
		return 'INSERTFAILED';
	}

	public function adm_uploadPhoto($id)
	{
		$id = intval($id);

		if(!isset($_FILES["Filedata"]) ||
		!is_uploaded_file($_FILES["Filedata"]["tmp_name"]) ||
		$_FILES["Filedata"]["error"] != 0)
		{
			header("HTTP/1.0 500 Internal Server Error");
			print 'File IO error ';
			exit(0);
		}
		else
		{
			$date = date("d.m.Y");
			$media = 'upload/gallery/'.$date;
			if(!is_dir($media)) { mkdir($media); }
			$media.= '/'.intval($id);
			if(!is_dir($media)) { mkdir($media); }

			$filename = rand(0,10000)."_".$_FILES["Filedata"]["name"];
			$filename = Filter::translit($filename);
			$file = $media.'/'.$filename;

			if (move_uploaded_file($_FILES["Filedata"]["tmp_name"], $file)) {

				$tQuery = 'INSERT IGNORE INTO `p_gallery_photo` (`gid`,`src`) VALUES (?d , ?)';
				$this->DB->query($tQuery, $id, $date.'/'.intval($id).'/'.$filename);
			}
			else
			{
				header("HTTP/1.0 500 Internal Server Error");
				exit(0);
			}
		}
	}

	private function adm_editPhoto($params)
	{
		$_params = array(
		'Name'=>$params['Name'],
		'Tags'=>$params['Tags'],
		'enabled'=>$params['enabled'],
		);

		if ($params['gid']) {
			$tQuery = 'UPDATE `p_gallery_photo` SET ?a WHERE `id`=?';
			$this->DB->query($tQuery, $_params, $params['id']);
		}

		$tQuery = 'SELECT * FROM `p_gallery_photo` WHERE `id`=?d';
		$Photo = $this->DB->selectRow($tQuery, $params['id']);
		return $Photo;
	}

	private function adm_removePhoto($params)
	{
		$tQuery = 'SELECT * FROM `p_gallery_photo` WHERE `id`=?d';
		$Photos = $this->DB->selectRow($tQuery, $params['id']);

		if($Photos)
		{
			//удалить файл и запись из базы
			if (file_exists('upload/gallery/'.$Photos['src'])) {
				unlink('upload/gallery/'.$Photos['src']);
			}

			$tQuery = 'DELETE FROM `p_gallery_photo` WHERE `id`=?d';
			return ($this->DB->query($tQuery, $Photos['id']))?'REMOVED':'REMOVEFAILED';
		}
		return 'REMOVEEMPTY';
	}
	private function adm_enablePhoto($params)
	{
		$tQuery = 'UPDATE `p_gallery_photo` SET `enabled`=1 WHERE `id`=?d';
		return ($this->DB->query($tQuery, $params['id']))?'ENABLED':'ENABLEFAILED';
	}
	private function adm_disablePhoto($params)
	{
		$tQuery = 'UPDATE `p_gallery_photo` SET `enabled`=0 WHERE `id`=?d';
		return ($this->DB->query($tQuery, $params['id']))?'DISABLED':'DISABLEFAILED';
	}
	private function adm_sortPhoto($sort)
	{
		$tQuery = 'UPDATE `p_gallery_photo` SET `Order`=?d WHERE `id`=?d';
		while (list($order,$pid)=each($sort)) {
			$this->DB->query($tQuery, $order, $pid);
		}
		return 'RESORTED';
	}
}


?>
