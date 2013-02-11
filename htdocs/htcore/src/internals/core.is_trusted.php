<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * determines if a resource is trusted or not
 *
 * @param string $resource_type
 * @param string $resource_name
 * @return boolean
 */

 // $resource_type, $resource_name

function cDeep_core_is_trusted($params, &$cDeep)
{
    $_cDeep_trusted = false;
    if ($params['resource_type'] == 'file') {
        if (!empty($cDeep->trusted_dir)) {
            $_rp = realpath($params['resource_name']);
            foreach ((array)$cDeep->trusted_dir as $curr_dir) {
                if (!empty($curr_dir) && is_readable ($curr_dir)) {
                    $_cd = realpath($curr_dir);
                    if (strncmp($_rp, $_cd, strlen($_cd)) == 0
                        && substr($_rp, strlen($_cd), 1) == DIRECTORY_SEPARATOR ) {
                        $_cDeep_trusted = true;
                        break;
                    }
                }
            }
        }

    } else {
        // resource is not on local file system
        $_cDeep_trusted = call_user_func_array($cDeep->_plugins['resource'][$params['resource_type']][0][3],
                                                array($params['resource_name'], $cDeep));
    }

    return $_cDeep_trusted;
}

/* vim: set expandtab: */

?>
