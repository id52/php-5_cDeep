<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep strip_tags modifier plugin
 *
 * Type:     modifier<br>
 * Name:     strip_tags<br>
 * Purpose:  strip html tags from text
 * @link http://cDeep.php.net/manual/en/language.modifier.strip.tags.php
 *          strip_tags (cDeep online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param boolean
 * @return string
 */
function cDeep_modifier_strip_tags($string, $replace_with_space = true)
{
    if ($replace_with_space)
        return preg_replace('!<[^>]*?>!', ' ', $string);
    else
        return strip_tags($string);
}

/* vim: set expandtab: */

?>
