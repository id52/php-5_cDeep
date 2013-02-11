<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Handle insert tags
 *
 * @param array $args
 * @return string
 */
function cDeep_core_run_insert_handler($params, &$cDeep)
{

    require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
    if ($cDeep->debugging) {
        $_params = array();
        $_debug_start_time = cDeep_core_get_microtime($_params, $cDeep);
    }

    if ($cDeep->caching) {
        $_arg_string = serialize($params['args']);
        $_name = $params['args']['name'];
        if (!isset($cDeep->_cache_info['insert_tags'][$_name])) {
            $cDeep->_cache_info['insert_tags'][$_name] = array('insert',
                                                             $_name,
                                                             $cDeep->_plugins['insert'][$_name][1],
                                                             $cDeep->_plugins['insert'][$_name][2],
                                                             !empty($params['args']['script']) ? true : false);
        }
        return $cDeep->_cDeep_md5."{insert_cache $_arg_string}".$cDeep->_cDeep_md5;
    } else {
        if (isset($params['args']['script'])) {
            $_params = array('resource_name' => $cDeep->_dequote($params['args']['script']));
            require_once(cDeep_CORE_DIR . 'core.get_php_resource.php');
            if(!cDeep_core_get_php_resource($_params, $cDeep)) {
                return false;
            }

            if ($_params['resource_type'] == 'file') {
                $cDeep->_include($_params['php_resource'], true);
            } else {
                $cDeep->_eval($_params['php_resource']);
            }
            unset($params['args']['script']);
        }

        $_funcname = $cDeep->_plugins['insert'][$params['args']['name']][0];
        $_content = $_funcname($params['args'], $cDeep);
        if ($cDeep->debugging) {
            $_params = array();
            require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
            $cDeep->_cDeep_debug_info[] = array('type'      => 'insert',
                                                'filename'  => 'insert_'.$params['args']['name'],
                                                'depth'     => $cDeep->_inclusion_depth,
                                                'exec_time' => cDeep_core_get_microtime($_params, $cDeep) - $_debug_start_time);
        }

        if (!empty($params['args']["assign"])) {
            $cDeep->assign($params['args']["assign"], $_content);
        } else {
            return $_content;
        }
    }
}

/* vim: set expandtab: */

?>
