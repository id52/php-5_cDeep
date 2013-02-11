<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     replace<br>
 * Purpose:  simple search/replace
 * @link http://cDeep.php.net/manual/en/language.modifier.replace.php
 *          replace (cDeep online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @param string
 * @return string
 */
function cDeep_modifier_replace($string, $search, $replace)
{
    return str_replace($search, $replace, $string);
}

/* vim: set expandtab: */

?>
