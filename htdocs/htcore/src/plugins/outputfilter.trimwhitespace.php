<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * cDeep trimwhitespace outputfilter plugin
 *
 * File:     outputfilter.trimwhitespace.php<br>
 * Type:     outputfilter<br>
 * Name:     trimwhitespace<br>
 * Date:     Jan 25, 2003<br>
 * Purpose:  trim leading white space and blank lines from
 *           template source after it gets interpreted, cleaning
 *           up code and saving bandwidth. Does not affect
 *           <<PRE>></PRE> and <SCRIPT></SCRIPT> blocks.<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$cDeep->load_filter('output','trimwhitespace');</code>
 *           from application.
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @author Contributions from Lars Noschinski <lars@usenet.noschinski.de>
 * @version  1.3
 * @param string
 * @param cDeep
 */
function cDeep_outputfilter_trimwhitespace($source, &$cDeep)
{
    // Pull out the script blocks
    preg_match_all("!<script[^>]+>.*?</script>!is", $source, $match);
    $_script_blocks = $match[0];
    $source = preg_replace("!<script[^>]+>.*?</script>!is",
                           '@@@cDeep:TRIM:SCRIPT@@@', $source);

    // Pull out the pre blocks
    preg_match_all("!<pre>.*?</pre>!is", $source, $match);
    $_pre_blocks = $match[0];
    $source = preg_replace("!<pre>.*?</pre>!is",
                           '@@@cDeep:TRIM:PRE@@@', $source);

    // Pull out the textarea blocks
    preg_match_all("!<textarea[^>]+>.*?</textarea>!is", $source, $match);
    $_textarea_blocks = $match[0];
    $source = preg_replace("!<textarea[^>]+>.*?</textarea>!is",
                           '@@@cDeep:TRIM:TEXTAREA@@@', $source);

    // remove all leading spaces, tabs and carriage returns NOT
    // preceeded by a php close tag.
    $source = trim(preg_replace('/((?<!\?>)\n)[\s]+/m', '\1', $source));
#    $source = preg_replace('(\r\n|\r|\n)', '', $source);

    // replace textarea blocks
    cDeep_outputfilter_trimwhitespace_replace("@@@cDeep:TRIM:TEXTAREA@@@",$_textarea_blocks, $source);

    // replace pre blocks
    cDeep_outputfilter_trimwhitespace_replace("@@@cDeep:TRIM:PRE@@@",$_pre_blocks, $source);

    // replace script blocks
    cDeep_outputfilter_trimwhitespace_replace("@@@cDeep:TRIM:SCRIPT@@@",$_script_blocks, $source);

    return $source;
}

function cDeep_outputfilter_trimwhitespace_replace($search_str, $replace, &$subject) {
    $_len = strlen($search_str);
    $_pos = 0;
    for ($_i=0, $_count=count($replace); $_i<$_count; $_i++)
        if (($_pos=strpos($subject, $search_str, $_pos))!==false)
            $subject = substr_replace($subject, $replace[$_i], $_pos, $_len);
        else
            break;

}

?>
