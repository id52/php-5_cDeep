<?php
function cDeep_function_importer($params, &$cDeep)
{

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	ini_set('max_execution_time', 0);
	set_time_limit(0);
	
	
	if (file_exists($_FILES['price']['tmp_name']) && $_FILES['price']['type']=='text/plain') 
  {
		$File=$_FILES['price']['tmp_name'];
	}


if (file_exists($File))
{		

      $tmenu = $cDeep->obj['DB']->select('SELECT `mid` FROM `t_menu`');
      foreach($tmenu as $tm)
      {
          $mids[]=$tm['mid'];
      };


      $cDeep->obj['DB']->query('update `t_menu` set `enabled`=0 where `is_group`=0');
      //define('PRICE', 'upload/input.csv');
      //$handle = fopen(PRICE, "r");
      $handle = fopen($File, "r");
      while (($data = fgetcsv($handle, 10000, "\t",'\t')) !== FALSE)
      {
      	$num=count($data);
        $row++;
      	//if ($row==1) continue;
      
      	
      	//for($i=0;$i<$num;$i++)
//      			$data[$i] = iconv('windows-1251', 'utf-8', $data[$i]);
      			
            
          
      		$mid=&$data[0];
          $mid=(int)$mid;
          
      		$mgid=&$data[1];
          
      		$mname=&$data[2];
          $descriptionmeta=&$data[2];
      		$keywordsmeta=&$data[2];
      		$mdesc=&$data[2];
      		$mcomponents=&$data[2];
          
          $enabled=1;
          
          
          if($data[3]=='')
          {
              $is_group='1';
              $mprice='0';
          }
          else
          {
            $is_group='0';
            $mprice=&$data[3];
            
          };

         
          
          if((!in_array($mid,$mids)))
          {
                		$cDeep->obj['DB']->query('insert into `t_menu` (`mid`, `mgid`, `mname`,`descriptionmeta`,`keywordsmeta`,`mdesc`,`mcomponents`,`mprice`,`is_group`,`enabled`) values(?,?,?,?,?,?,?,?,?,?)', $mid, $mgid, $mname, $descriptionmeta, $keywordsmeta, $mdesc,$mcomponents,$mprice, $is_group,$enabled);
          }
          else
          {
      	           $cDeep->obj['DB']->query('update `t_menu` set `mgid`=?, `mname`=?, `descriptionmeta`=?, `keywordsmeta`=?, `mdesc`=?, `mcomponents`=?, `mprice`=?, `enabled`=? where `mid`=?', $mgid, $mname, $descriptionmeta, $keywordsmeta, $mdesc,$mcomponents,$mprice, $enabled, $mid);
      			
           };
      
      
      };	
};










};

