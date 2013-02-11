<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * cDeep assign_cDeep_interface core plugin
 *
 * Type:     core<br>
 * Name:     assign_cDeep_interface<br>
 * Purpose:  assign the $cDeep interface variable
 * @param array Format: null
 * @param cDeep
 */
function cDeep_core_assign_cDeep_interface($params, &$cDeep)
{
        if (isset($cDeep->_cDeep_vars) && isset($cDeep->_cDeep_vars['request'])) {
            return;
        }

        $_globals_map = array('g'  => 'HTTP_GET_VARS',
                             'p'  => 'HTTP_POST_VARS',
                             'c'  => 'HTTP_COOKIE_VARS',
                             's'  => 'HTTP_SERVER_VARS',
                             'e'  => 'HTTP_ENV_VARS');

        $_cDeep_vars_request  = array();

        foreach (preg_split('!!', strtolower($cDeep->request_vars_order)) as $_c) {
            if (isset($_globals_map[$_c])) {
                $_cDeep_vars_request = array_merge($_cDeep_vars_request, $GLOBALS[$_globals_map[$_c]]);
            }
        }
        $_cDeep_vars_request = @array_merge($_cDeep_vars_request, $GLOBALS['HTTP_SESSION_VARS']);

        $cDeep->_cDeep_vars['request'] = $_cDeep_vars_request;
}

/* vim: set expandtab: */

?>
