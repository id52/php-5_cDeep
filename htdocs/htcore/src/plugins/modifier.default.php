<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep default modifier plugin
 *
 * Type:     modifier<br>
 * Name:     default<br>
 * Purpose:  designate default value for empty variables
 * @link http://cDeep.php.net/manual/en/language.modifier.default.php
 *          default (cDeep online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @return string
 */
function cDeep_modifier_default($string, $default = '')
{
    if (!isset($string) || $string === '')
        return $default;
    else
        return $string;
}

/* vim: set expandtab: */

?>
