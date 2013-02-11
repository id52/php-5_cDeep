<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Replace cached inserts with the actual results
 *
 * @param string $results
 * @return string
 */
function cDeep_core_process_cached_inserts($params, &$cDeep)
{
    preg_match_all('!'.$cDeep->_cDeep_md5.'{insert_cache (.*)}'.$cDeep->_cDeep_md5.'!Uis',
                   $params['results'], $match);
    list($cached_inserts, $insert_args) = $match;

    for ($i = 0, $for_max = count($cached_inserts); $i < $for_max; $i++) {
        if ($cDeep->debugging) {
            $_params = array();
            require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
            $debug_start_time = cDeep_core_get_microtime($_params, $cDeep);
        }

        $args = unserialize($insert_args[$i]);
        $name = $args['name'];

        if (isset($args['script'])) {
            $_params = array('resource_name' => $cDeep->_dequote($args['script']));
            require_once(cDeep_CORE_DIR . 'core.get_php_resource.php');
            if(!cDeep_core_get_php_resource($_params, $cDeep)) {
                return false;
            }
            $resource_type = $_params['resource_type'];
            $php_resource = $_params['php_resource'];


            if ($resource_type == 'file') {
                $cDeep->_include($php_resource, true);
            } else {
                $cDeep->_eval($php_resource);
            }
        }

        $function_name = $cDeep->_plugins['insert'][$name][0];
        if (empty($args['assign'])) {
            $replace = $function_name($args, $cDeep);
        } else {
            $cDeep->assign($args['assign'], $function_name($args, $cDeep));
            $replace = '';
        }

        $params['results'] = substr_replace($params['results'], $replace, strpos($params['results'], $cached_inserts[$i]), strlen($cached_inserts[$i]));
        if ($cDeep->debugging) {
            $_params = array();
            require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
            $cDeep->_cDeep_debug_info[] = array('type'      => 'insert',
                                                'filename'  => 'insert_'.$name,
                                                'depth'     => $cDeep->_inclusion_depth,
                                                'exec_time' => cDeep_core_get_microtime($_params, $cDeep) - $debug_start_time);
        }
    }

    return $params['results'];
}

/* vim: set expandtab: */

?>
