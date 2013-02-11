<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * called for included php files within templates
 *
 * @param string $cDeep_file
 * @param string $cDeep_assign variable to assign the included template's
 *               output into
 * @param boolean $cDeep_once uses include_once if this is true
 * @param array $cDeep_include_vars associative array of vars from
 *              {include file="blah" var=$var}
 */

//  $file, $assign, $once, $_cDeep_include_vars

function cDeep_core_cDeep_include_php($params, &$cDeep)
{
    $_params = array('resource_name' => $params['cDeep_file']);
    require_once(cDeep_CORE_DIR . 'core.get_php_resource.php');
    cDeep_core_get_php_resource($_params, $cDeep);
    $_cDeep_resource_type = $_params['resource_type'];
    $_cDeep_php_resource = $_params['php_resource'];

    if (!empty($params['cDeep_assign'])) {
        ob_start();
        if ($_cDeep_resource_type == 'file') {
            $cDeep->_include($_cDeep_php_resource, $params['cDeep_once'], $params['cDeep_include_vars']);
        } else {
            $cDeep->_eval($_cDeep_php_resource, $params['cDeep_include_vars']);
        }
        $cDeep->assign($params['cDeep_assign'], ob_get_contents());
        ob_end_clean();
    } else {
        if ($_cDeep_resource_type == 'file') {
            $cDeep->_include($_cDeep_php_resource, $params['cDeep_once'], $params['cDeep_include_vars']);
        } else {
            $cDeep->_eval($_cDeep_php_resource, $params['cDeep_include_vars']);
        }
    }
}


/* vim: set expandtab: */

?>
