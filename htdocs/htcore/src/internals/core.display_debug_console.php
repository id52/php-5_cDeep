<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * cDeep debug_console function plugin
 *
 * Type:     core<br>
 * Name:     display_debug_console<br>
 * Purpose:  display the javascript debug console window
 * @param array Format: null
 * @param cDeep
 */
function cDeep_core_display_debug_console($params, &$cDeep)
{
    // we must force compile the debug template in case the environment
    // changed between separate applications.

    if(empty($cDeep->debug_tpl)) {
        // set path to debug template from cDeep_DIR
        $cDeep->debug_tpl = cDeep_DIR . 'debug.tpl';
        if($cDeep->security && is_file($cDeep->debug_tpl)) {
            $cDeep->secure_dir[] = realpath($cDeep->debug_tpl);
        }
        $cDeep->debug_tpl = 'file:' . cDeep_DIR . 'debug.tpl';
    }

    $_ldelim_orig = $cDeep->left_delimiter;
    $_rdelim_orig = $cDeep->right_delimiter;

    $cDeep->left_delimiter = '{';
    $cDeep->right_delimiter = '}';

    $_compile_id_orig = $cDeep->_compile_id;
    $cDeep->_compile_id = null;

    $_compile_path = $cDeep->_get_compile_path($cDeep->debug_tpl);
    if ($cDeep->_compile_resource($cDeep->debug_tpl, $_compile_path))
    {
        ob_start();
        $cDeep->_include($_compile_path);
        $_results = ob_get_contents();
        ob_end_clean();
    } else {
        $_results = '';
    }

    $cDeep->_compile_id = $_compile_id_orig;

    $cDeep->left_delimiter = $_ldelim_orig;
    $cDeep->right_delimiter = $_rdelim_orig;

    return $_results;
}

/* vim: set expandtab: */

?>
