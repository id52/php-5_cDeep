<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Replace nocache-tags by results of the corresponding non-cacheable
 * functions and return it
 *
 * @param string $compiled_tpl
 * @param string $cached_source
 * @return string
 */

function cDeep_core_process_compiled_include($params, &$cDeep)
{
    $_cache_including = $cDeep->_cache_including;
    $cDeep->_cache_including = true;

    $_return = $params['results'];

    foreach ($cDeep->_cache_info['cache_serials'] as $_include_file_path=>$_cache_serial) {
        $cDeep->_include($_include_file_path, true);
    }

    foreach ($cDeep->_cache_serials as $_include_file_path=>$_cache_serial) {
        $_return = preg_replace_callback('!(\{nocache\:('.$_cache_serial.')#(\d+)\})!s',
                                         array(&$cDeep, '_process_compiled_include_callback'),
                                         $_return);
    }
    $cDeep->_cache_including = $_cache_including;
    return $_return;
}

?>
