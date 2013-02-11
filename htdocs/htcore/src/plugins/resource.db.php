<?php
/*
* cDeep plugin
* -------------------------------------------------------------
* ����:     resource.db.php
* ���:     resource
* ���:     db
* ����������:  �������� ������ �� ���� ������
* -------------------------------------------------------------
*/
function cDeep_resource_db_source($tpl_name, &$tpl_source, &$cDeep)
{
	$Resource = DBTemplate::Instance($cDeep)->read($tpl_name);
	if ($Resource) {
		$tpl_source = $Resource;
		return true;
	} else {
		return false;
	}
}

function cDeep_resource_db_timestamp($tpl_name, &$tpl_timestamp, &$cDeep)
{
	$Resource = DBTemplate::Instance($cDeep)->emtime($tpl_name);
	if ($Resource) {
		$tpl_timestamp = $Resource;
		return true;
	} else {
		return false;
	}
}

function cDeep_resource_db_secure($tpl_name, &$cDeep)
{
	$return = DBTemplate::Instance($cDeep)->is_readble($tpl_name);
	return ($return)?true:false;
}

function cDeep_resource_db_trusted($tpl_name, &$cDeep)
{
	print 'DB_TRUSTED:'.$tpl_name;
}

?>