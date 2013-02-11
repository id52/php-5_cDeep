<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep wordwrap modifier plugin
 *
 * Type:     modifier<br>
 * Name:     wordwrap<br>
 * Purpose:  wrap a string of text at a given length
 * @link http://cDeep.php.net/manual/en/language.modifier.wordwrap.php
 *          wordwrap (cDeep online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @return string
 */
function cDeep_modifier_wordwrap($string,$length=80,$break="\n",$cut=false)
{
    return wordwrap($string,$length,$break,$cut);
}

?>
