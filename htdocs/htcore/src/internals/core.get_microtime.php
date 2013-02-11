<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Get seconds and microseconds
 * @return double
 */
function cDeep_core_get_microtime($params, &$cDeep)
{
    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    $mtime = (double)($mtime[1]) + (double)($mtime[0]);
    return ($mtime);
}


/* vim: set expandtab: */

?>
