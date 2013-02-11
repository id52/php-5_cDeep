<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Include the {@link shared.make_timestamp.php} plugin
 */
require_once $cDeep->_get_plugin_filepath('shared','make_timestamp');
/**
 * cDeep date_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     date_format<br>
 * Purpose:  format datestamps via strftime<br>
 * Input:<br>
 *         - string: input date string
 *         - format: strftime format for output
 *         - default_date: default date if $string is empty
 * @link http://cDeep.php.net/manual/en/language.modifier.date.format.php
 *          date_format (cDeep online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @param string
 * @return string|void
 * @uses cDeep_make_timestamp()
 */
function cDeep_modifier_date_format($string, $format="%b %e, %Y", $default_date=null)
{
    if (substr(PHP_OS,0,3) == 'WIN') {
        $hours = strftime('%I', $string);
        $short_hours = ( $hours < 10 ) ? substr( $hours, -1) : $hours; 
        $_win_from = array ('%e',  '%T',       '%D',        '%l');
        $_win_to   = array ('%#d', '%H:%M:%S', '%m/%d/%y',  $short_hours);
        $format = str_replace($_win_from, $_win_to, $format);
    }
    if($string != '') {
        return strftime($format, cDeep_make_timestamp($string));
    } elseif (isset($default_date) && $default_date != '') {
        return strftime($format, cDeep_make_timestamp($default_date));
    } else {
        return;
    }
}

/* vim: set expandtab: */

?>
