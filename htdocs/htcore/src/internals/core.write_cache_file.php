<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Prepend the cache information to the cache file
 * and write it
 *
 * @param string $tpl_file
 * @param string $cache_id
 * @param string $compile_id
 * @param string $results
 * @return true|null
 */

 // $tpl_file, $cache_id, $compile_id, $results

function cDeep_core_write_cache_file($params, &$cDeep)
{

    // put timestamp in cache header
    $cDeep->_cache_info['timestamp'] = time();
    if ($cDeep->cache_lifetime > -1){
        // expiration set
        $cDeep->_cache_info['expires'] = $cDeep->_cache_info['timestamp'] + $cDeep->cache_lifetime;
    } else {
        // cache will never expire
        $cDeep->_cache_info['expires'] = -1;
    }

    // collapse nocache.../nocache-tags
    if (preg_match_all('!\{(/?)nocache\:[0-9a-f]{32}#\d+\}!', $params['results'], $match, PREG_PATTERN_ORDER)) {
        // remove everything between every pair of outermost noache.../nocache-tags
        // and replace it by a single nocache-tag
        // this new nocache-tag will be replaced by dynamic contents in
        // cDeep_core_process_compiled_includes() on a cache-read
        
        $match_count = count($match[0]);
        $results = preg_split('!(\{/?nocache\:[0-9a-f]{32}#\d+\})!', $params['results'], -1, PREG_SPLIT_DELIM_CAPTURE);
        
        $level = 0;
        $j = 0;
        for ($i=0, $results_count = count($results); $i < $results_count && $j < $match_count; $i++) {
            if ($results[$i] == $match[0][$j]) {
                // nocache tag
                if ($match[1][$j]) { // closing tag
                    $level--;
                    unset($results[$i]);
                } else { // opening tag
                    if ($level++ > 0) unset($results[$i]);
                }
                $j++;
            } elseif ($level > 0) {
                unset($results[$i]);
            }
        }
        $params['results'] = implode('', $results);
    }
    $cDeep->_cache_info['cache_serials'] = $cDeep->_cache_serials;

    // prepend the cache header info into cache file
    $_cache_info = serialize($cDeep->_cache_info);
    $params['results'] = strlen($_cache_info) . "\n" . $_cache_info . $params['results'];

    if (!empty($cDeep->cache_handler_func)) {
        // use cache_handler function
        call_user_func_array($cDeep->cache_handler_func,
                             array('write', &$cDeep, &$params['results'], $params['tpl_file'], $params['cache_id'], $params['compile_id'], null));
    } else {
        // use local cache file

        if(!@is_writable($cDeep->cache_dir)) {
            // cache_dir not writable, see if it exists
            if(!@is_dir($cDeep->cache_dir)) {
                $cDeep->trigger_error('the $cache_dir \'' . $cDeep->cache_dir . '\' does not exist, or is not a directory.', E_USER_ERROR);
                return false;
            }
            $cDeep->trigger_error('unable to write to $cache_dir \'' . realpath($cDeep->cache_dir) . '\'. Be sure $cache_dir is writable by the web server user.', E_USER_ERROR);
            return false;
        }

        $_auto_id = $cDeep->_get_auto_id($params['cache_id'], $params['compile_id']);
        $_cache_file = $cDeep->_get_auto_filename($cDeep->cache_dir, $params['tpl_file'], $_auto_id);
        $_params = array('filename' => $_cache_file, 'contents' => $params['results'], 'create_dirs' => true);
        require_once(cDeep_CORE_DIR . 'core.write_file.php');
        cDeep_core_write_file($_params, $cDeep);
        return true;
    }
}

/* vim: set expandtab: */

?>
