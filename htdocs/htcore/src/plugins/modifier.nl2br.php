<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep plugin
 *
 * Type:     modifier<br>
 * Name:     nl2br<br>
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to <<br>>
 * Input:<br>
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|nl2br}
 * @link http://cDeep.php.net/manual/en/language.modifier.nl2br.php
 *          nl2br (cDeep online manual)
 * @version  1.0
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function cDeep_modifier_nl2br($string)
{
    return nl2br($string);
}

/* vim: set expandtab: */

?>
