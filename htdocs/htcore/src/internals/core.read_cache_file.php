<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * read a cache file, determine if it needs to be
 * regenerated or not
 *
 * @param string $tpl_file
 * @param string $cache_id
 * @param string $compile_id
 * @param string $results
 * @return boolean
 */

//  $tpl_file, $cache_id, $compile_id, &$results

function cDeep_core_read_cache_file(&$params, &$cDeep)
{
    static  $content_cache = array();

    if ($cDeep->force_compile) {
        // force compile enabled, always regenerate
        return false;
    }

    if (isset($content_cache[$params['tpl_file'].','.$params['cache_id'].','.$params['compile_id']])) {
        list($params['results'], $cDeep->_cache_info) = $content_cache[$params['tpl_file'].','.$params['cache_id'].','.$params['compile_id']];
        return true;
    }

    if (!empty($cDeep->cache_handler_func)) {
        // use cache_handler function
        call_user_func_array($cDeep->cache_handler_func,
                             array('read', &$cDeep, &$params['results'], $params['tpl_file'], $params['cache_id'], $params['compile_id'], null));
    } else {
        // use local cache file
        $_auto_id = $cDeep->_get_auto_id($params['cache_id'], $params['compile_id']);
        $_cache_file = $cDeep->_get_auto_filename($cDeep->cache_dir, $params['tpl_file'], $_auto_id);
        $params['results'] = $cDeep->_read_file($_cache_file);
    }

    if (empty($params['results'])) {
        // nothing to parse (error?), regenerate cache
        return false;
    }

    $_contents = $params['results'];
    $_info_start = strpos($_contents, "\n") + 1;
    $_info_len = (int)substr($_contents, 0, $_info_start - 1);
    $_cache_info = unserialize(substr($_contents, $_info_start, $_info_len));
    $params['results'] = substr($_contents, $_info_start + $_info_len);

    if ($cDeep->caching == 2 && isset ($_cache_info['expires'])){
        // caching by expiration time
        if ($_cache_info['expires'] > -1 && (time() > $_cache_info['expires'])) {
            // cache expired, regenerate
            return false;
        }
    } else {
        // caching by lifetime
        if ($cDeep->cache_lifetime > -1 && (time() - $_cache_info['timestamp'] > $cDeep->cache_lifetime)) {
            // cache expired, regenerate
            return false;
        }
    }

    if ($cDeep->compile_check) {
        $_params = array('get_source' => false, 'quiet'=>true);
        foreach (array_keys($_cache_info['template']) as $_template_dep) {
            $_params['resource_name'] = $_template_dep;
            if (!$cDeep->_fetch_resource_info($_params) || $_cache_info['timestamp'] < $_params['resource_timestamp']) {
                // template file has changed, regenerate cache
                return false;
            }
        }

        if (isset($_cache_info['config'])) {
            $_params = array('resource_base_path' => $cDeep->config_dir, 'get_source' => false, 'quiet'=>true);
            foreach (array_keys($_cache_info['config']) as $_config_dep) {
                $_params['resource_name'] = $_config_dep;
                if (!$cDeep->_fetch_resource_info($_params) || $_cache_info['timestamp'] < $_params['resource_timestamp']) {
                    // config file has changed, regenerate cache
                    return false;
                }
            }
        }
    }

    $content_cache[$params['tpl_file'].','.$params['cache_id'].','.$params['compile_id']] = array($params['results'], $_cache_info);

    $cDeep->_cache_info = $_cache_info;
    return true;
}

/* vim: set expandtab: */

?>
