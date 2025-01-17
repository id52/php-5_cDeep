<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * load a resource plugin
 *
 * @param string $type
 */

// $type

function cDeep_core_load_resource_plugin($params, &$cDeep)
{
    /*
     * Resource plugins are not quite like the other ones, so they are
     * handled differently. The first element of plugin info is the array of
     * functions provided by the plugin, the second one indicates whether
     * all of them exist or not.
     */

    $_plugin = &$cDeep->_plugins['resource'][$params['type']];
    if (isset($_plugin)) {
        if (!$_plugin[1] && count($_plugin[0])) {
            $_plugin[1] = true;
            foreach ($_plugin[0] as $_plugin_func) {
                if (!is_callable($_plugin_func)) {
                    $_plugin[1] = false;
                    break;
                }
            }
        }

        if (!$_plugin[1]) {
            $cDeep->_trigger_fatal_error("[plugin] resource '" . $params['type'] . "' is not implemented", null, null, __FILE__, __LINE__);
        }

        return;
    }

    $_plugin_file = $cDeep->_get_plugin_filepath('resource', $params['type']);
    $_found = ($_plugin_file != false);

    if ($_found) {            /*
         * If the plugin file is found, it -must- provide the properly named
         * plugin functions.
         */
        include_once($_plugin_file);

        /*
         * Locate functions that we require the plugin to provide.
         */
        $_resource_ops = array('source', 'timestamp', 'secure', 'trusted');
        $_resource_funcs = array();
        foreach ($_resource_ops as $_op) {
            $_plugin_func = 'cDeep_resource_' . $params['type'] . '_' . $_op;
            if (!function_exists($_plugin_func)) {
                $cDeep->_trigger_fatal_error("[plugin] function $_plugin_func() not found in $_plugin_file", null, null, __FILE__, __LINE__);
                return;
            } else {
                $_resource_funcs[] = $_plugin_func;
            }
        }

        $cDeep->_plugins['resource'][$params['type']] = array($_resource_funcs, true);
    }
}

/* vim: set expandtab: */

?>
