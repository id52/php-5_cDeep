<?

class Plugin_News implements Plugin {

  /* PUBLIC Section */

  public function __construct($cDeep, $isadm=false)
  {
    $this->upload = 'upload/news';
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

  /* END OF PUBLIC Section */

  private function adm_listNews($params)
  {
    $primaryTagId = $params['primaryTagId'];
    $primaryTagName = $params['primaryTagName'];
#    $tQuery = 'SELECT `id`,`Title`,`Icon`,`Source`,`primaryTag`,`primaryTagId`,`Date`,`enabled` FROM `p_news` WHERE 1=1{ AND `primaryTagId`=?d } ORDER BY `Date` DESC LIMIT 0 , 20 ';
#    $News['List'] = $this->DB->select($tQuery, empty($primaryTagId)?DBSIMPLE_SKIP:$primaryTagId);
		$tQuery = "SELECT COUNT(`id`) FROM `p_news` WHERE 1=1{ AND (`primaryTagId`=?d OR `primaryTagId`=1)}{ AND `primaryTag`=?}"; //
		$max = $params['max']?intval($params['max']):10;
		$Page['num'] = $this->DB->selectCell($tQuery, empty($primaryTagId)?DBSIMPLE_SKIP:$primaryTagId, empty($primaryTagName)?DBSIMPLE_SKIP:$primaryTagName);
		
		$Page['count']    = ceil($Page['num']/$max);
		$Page['max']    = $max;
		$Page['current']  = abs($params['current']);
		$Page['current'] = ($Page['current'] < 1)?1:$Page['current'];
		$Page['next']   = ($Page['current'] < $Page['count'])?($Page['current'] + 1):0;
		$Page['last']   = ($Page['current'] > 1)?($Page['current'] - 1):0;
		$Page['start'] = ($Page['current']-1)*$Page['max'];
    	
    	$News['Pages'] = $Page;
      #$tQuery = 'SELECT `id`,`Title`,`Icon`,`Description`,`Content`,`primaryTag`,`primaryTagId`,`Date`,`enabled` FROM `p_news` WHERE `enabled`=1{ AND (`primaryTagId`=?d OR `primaryTagId`=1)}{ AND `primaryTag`=?} ORDER BY `Date` DESC LIMIT ?d , ?d ';
	  $tQuery = 'SELECT * FROM `p_news` WHERE 1=1{ AND (`primaryTagId`=?d OR `primaryTagId`=1)}{ AND `primaryTag`=?} ORDER BY `Date` DESC LIMIT ?d , ?d ';
      $News['List'] = $this->DB->select($tQuery, empty($primaryTagId)?DBSIMPLE_SKIP:$primaryTagId, empty($primaryTagName)?DBSIMPLE_SKIP:$primaryTagName, $Page['start'], $Page['max']);
    return $News;
  }
  private function pub_listNews($params)
  {
    $primaryTagId = $params['primaryTagId'];
    $primaryTagName = $params['primaryTagName'];
    $id = intval($params['id']);
    if (empty($id)) {
		$tQuery = "SELECT COUNT(`id`) FROM `p_news` WHERE `enabled`=1{ AND (`primaryTagId`=?d OR `primaryTagId`=1)}{ AND `primaryTag`=?}"; //
		$max = $params['max']?intval($params['max']):10;
		$Page['num'] = $this->DB->selectCell($tQuery, empty($primaryTagId)?DBSIMPLE_SKIP:$primaryTagId, empty($primaryTagName)?DBSIMPLE_SKIP:$primaryTagName);
		
		$Page['count']    = ceil($Page['num']/$max);
		$Page['max']    = $max;
		$Page['current']  = abs($params['current']);
		$Page['current'] = ($Page['current'] < 1)?1:$Page['current'];
		$Page['next']   = ($Page['current'] < $Page['count'])?($Page['current'] + 1):0;
		$Page['last']   = ($Page['current'] > 1)?($Page['current'] - 1):0;
		$Page['start'] = ($Page['current']-1)*$Page['max'];
    	
    	$News['Pages'] = $Page;
        $tQuery = 'SELECT * FROM `p_news` WHERE `enabled`=1{ AND (`primaryTagId`=?d OR `primaryTagId`=1)}{ AND `primaryTag`=?} ORDER BY `Date` DESC LIMIT ?d , ?d ';
        $News['List'] = $this->DB->select($tQuery, empty($primaryTagId)?DBSIMPLE_SKIP:$primaryTagId, empty($primaryTagName)?DBSIMPLE_SKIP:$primaryTagName, $Page['start'], $Page['max']);
    }
    else 
    {
      $tQuery = 'SELECT * FROM `p_news` WHERE `enabled`=1{ AND (`primaryTagId`=?d AND `primaryTagId`=1)}{ AND `primaryTag`=?}{ AND `id`=?d} ORDER BY `Date` DESC LIMIT 0 , 30 ';
      $News['List'] = $this->DB->selectRow($tQuery, empty($primaryTagId)?DBSIMPLE_SKIP:$primaryTagId, empty($primaryTagName)?DBSIMPLE_SKIP:$primaryTagName, empty($id)?DBSIMPLE_SKIP:$id);
    }
    return $News;
  }
  private function adm_propNews($params)
  {
    $id = $params['id'];
    $tQuery = 'SELECT * FROM `p_news` WHERE `id`=?d LIMIT 1 ';
    return $this->DB->selectRow($tQuery,  $id);
  }
  private function adm_removeNews($params)
  {
    $id = $params['id'];
    $tQuery = 'DELETE FROM `p_news` WHERE `id`=?d';
    return $this->DB->query($tQuery, $id)?'REMOVED':'REMOVEFAILED';
  }
   private function adm_removeImg($params)
  {
    $id = $params['id'];
    $tQuery = "UPDATE `p_news` SET `Icon`='' WHERE `id`=$id";
    
    return $this->DB->query($tQuery, $id)?'REMOVED':'REMOVEFAILED';
  }
  
  private function adm_editNews($params)
  {

    $id = intval($params['id']);
    if (isset($_FILES["News"]) &&
    is_uploaded_file($_FILES["News"]["tmp_name"]["Icon"]) &&
    $_FILES["News"]["name"]["Icon"] &&
    $_FILES["News"]["error"]["Icon"] == 0) {
      if (!is_dir($this->upload.'/'.$id)) {
        mkdir($this->upload.'/'.$id, 0777, true);
      }
      $rnd = time();
	  $path=$this->upload.'/'.$id.'/'.$rnd.'.jpg';
      move_uploaded_file($_FILES["News"]["tmp_name"]["Icon"], $path);
	  
	  
	  chmod($this->upload.'/'.$id,0777);
	  chmod($this->upload,0777);
	  chmod($path,0777);
	  
      $News['Icon'] = ''.$id.'/'.$rnd.'.jpg';
    }
    $News['Title'] = $params['Title'];
    $News['Source'] = $params['Source'];
    $News['primaryTag'] = $params['primaryTag'];
    $News['Tags'] = $params['Tags'];
    $News['Date'] = $params['Date'];
    $News['Description'] = $params['Description'];
    $News['Content'] = $params['Content'];
    $News['enabled'] = intval($params['enabled']);
    
    if (!$params['descriptionmeta']) $News['descriptionmeta'] = $params['Title'];
    else $News['descriptionmeta'] = $params['descriptionmeta'];
      
    if (!$params['keywordsmeta']) $News['keywordsmeta'] = $params['Title'];
    else $News['keywordsmeta'] = $params['keywordsmeta'];
    

    if ($id) 
	{
		$this->DB->query('insert ignore into `p_tag` (`Tag`) values (?)', $News['primaryTag']);
		$primaryTagId=$this->DB->selectRow('SELECT `id` FROM `p_tag` WHERE `Tag` LIKE ? LIMIT 1', $News['primaryTag']);
		$tQuery = 'UPDATE `p_news` SET ?a, `primaryTagId`=? WHERE `id`=?d LIMIT 1';
		return $this->DB->query($tQuery, $News, $primaryTagId['id'], $id)?'UPDATED':'UPDATEFAILED';
    }
    return 'UPDATEFAILED';
  }
  private function adm_addNews($params)
  {
   
    $News['Title'] = $params['Title']?$params['Title']:'Untitled';
    $News['Source'] = $params['Source'];
    $News['primaryTag'] = $params['primaryTag'];
    $News['Tags'] = $params['Tags'];
    $News['Date'] = $params['Date'];
    $News['Description'] = $params['Description'];
    $News['Content'] = $params['Content'];
    $News['enabled'] = intval($params['enabled']);
    $News['descriptionmeta'] = $params['Title'];
    if (!$News['descriptionmeta']) $News['descriptionmeta'] =$News['Title'];
    if (!$News['keywordsmeta']) $News['keywordsmeta'] = $News['Title'];

    $id = $params['id'];
    if (empty($id)) 
	{
		$this->DB->query('insert ignore into `p_tag` (`Tag`) values (?)', $News['primaryTag']);
		$primaryTagId=$this->DB->selectRow('SELECT `id` FROM `p_tag` WHERE `Tag` LIKE "?" LIMIT 1', $News['primaryTag']);
		
		
      $tQuery = 'INSERT INTO `p_news` (?#, `primaryTagId`) VALUES (?a, ?)';
      $id = $this->DB->query($tQuery, array_keys($News), array_values($News),$News['primaryTag'], $primaryTagId['id']);
      if ($id) {
        header('Location: property['.$id.'].xml'); //не на месте! должно быть в плагине смарти
        return $id;
      }
    }
    return 'INSERTFAILED';
  }
  private function pub_indexNews($params)
  {
    $tQuery = 'SELECT UPPER(SUBSTRING(`primaryTag`, 1, 1)) AS ARRAY_KEY_1, `primaryTagId` AS ARRAY_KEY_2, `primaryTag` FROM `p_news` ORDER BY `primaryTag` ASC';
    $Index = $this->DB->selectCol($tQuery);
    return $Index;
  }
}
