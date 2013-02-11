<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * write the compiled resource
 *
 * @param string $compile_path
 * @param string $compiled_content
 * @return true
 */
function cDeep_core_write_compiled_resource($params, &$cDeep)
{
    if(!@is_writable($cDeep->compile_dir)) {
        // compile_dir not writable, see if it exists
        if(!@is_dir($cDeep->compile_dir)) {
            $cDeep->trigger_error('the $compile_dir \'' . $cDeep->compile_dir . '\' does not exist, or is not a directory.', E_USER_ERROR);
            return false;
        }
        $cDeep->trigger_error('unable to write to $compile_dir \'' . realpath($cDeep->compile_dir) . '\'. Be sure $compile_dir is writable by the web server user.', E_USER_ERROR);
        return false;
    }

    $_params = array('filename' => $params['compile_path'], 'contents' => $params['compiled_content'], 'create_dirs' => true);
    require_once(cDeep_CORE_DIR . 'core.write_file.php');
    cDeep_core_write_file($_params, $cDeep);
    return true;
}

/* vim: set expandtab: */

?>
