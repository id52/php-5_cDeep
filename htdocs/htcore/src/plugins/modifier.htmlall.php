<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep upper modifier plugin
 *
 * Type:     modifier<br>
 * Name:     upper<br>
 * Purpose:  convert string to uppercase
 * @link http://cDeep.php.net/manual/en/language.modifier.upper.php
 *          upper (cDeep online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function cDeep_modifier_htmlall($string)
{
    /*return htmlspecialchars($string);*/
	$string = str_replace("'", "\"", $string);
    $string = htmlspecialchars ( $string, ENT_QUOTES, "UTF-8" );
    return    $string;	
}

?>
