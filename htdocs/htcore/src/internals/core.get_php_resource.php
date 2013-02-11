<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Retrieves PHP script resource
 *
 * sets $php_resource to the returned resource
 * @param string $resource
 * @param string $resource_type
 * @param  $php_resource
 * @return boolean
 */

function cDeep_core_get_php_resource(&$params, &$cDeep)
{

    $params['resource_base_path'] = $cDeep->trusted_dir;
    $cDeep->_parse_resource_name($params, $cDeep);

    /*
     * Find out if the resource exists.
     */

    if ($params['resource_type'] == 'file') {
        $_readable = false;
        if(file_exists($params['resource_name']) && is_readable($params['resource_name'])) {
            $_readable = true;
        } else {
            // test for file in include_path
            $_params = array('file_path' => $params['resource_name']);
            require_once(cDeep_CORE_DIR . 'core.get_include_path.php');
            if(cDeep_core_get_include_path($_params, $cDeep)) {
                $_include_path = $_params['new_file_path'];
                $_readable = true;
            }
        }
    } else if ($params['resource_type'] != 'file') {
        $_template_source = null;
        $_readable = is_callable($cDeep->_plugins['resource'][$params['resource_type']][0][0])
            && call_user_func_array($cDeep->_plugins['resource'][$params['resource_type']][0][0],
                                    array($params['resource_name'], &$_template_source, &$cDeep));
    }

    /*
     * Set the error function, depending on which class calls us.
     */
    if (method_exists($cDeep, '_syntax_error')) {
        $_error_funcc = '_syntax_error';
    } else {
        $_error_funcc = 'trigger_error';
    }

    if ($_readable) {
        if ($cDeep->security) {
            require_once(cDeep_CORE_DIR . 'core.is_trusted.php');
            if (!cDeep_core_is_trusted($params, $cDeep)) {
                $cDeep->$_error_funcc('(secure mode) ' . $params['resource_type'] . ':' . $params['resource_name'] . ' is not trusted');
                return false;
            }
        }
    } else {
        $cDeep->$_error_funcc($params['resource_type'] . ':' . $params['resource_name'] . ' is not readable');
        return false;
    }

    if ($params['resource_type'] == 'file') {
        $params['php_resource'] = $params['resource_name'];
    } else {
        $params['php_resource'] = $_template_source;
    }
    return true;
}

/* vim: set expandtab: */

?>
