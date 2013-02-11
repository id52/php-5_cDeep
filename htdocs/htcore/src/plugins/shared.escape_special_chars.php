<?php
/**
 * cDeep shared plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * escape_special_chars common function
 *
 * Function: cDeep_function_escape_special_chars<br>
 * Purpose:  used by other cDeep functions to escape
 *           special chars except for already escaped ones
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function cDeep_function_escape_special_chars($string)
{
    if(!is_array($string)) {
        $string = preg_replace('!&(#?\w+);!', '%%%cDeep_START%%%\\1%%%cDeep_END%%%', $string);
        $string = htmlspecialchars($string);
        $string = str_replace(array('%%%cDeep_START%%%','%%%cDeep_END%%%'), array('&',';'), $string);
    }
    return $string;
}

/* vim: set expandtab: */

?>
