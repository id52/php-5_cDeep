<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * write out a file to disk
 *
 * @param string $filename
 * @param string $contents
 * @param boolean $create_dirs
 * @return boolean
 */
function cDeep_core_write_file($params, &$cDeep)
{
    $_dirname = dirname($params['filename']);

    if ($params['create_dirs']) {
        $_params = array('dir' => $_dirname);
        require_once(cDeep_CORE_DIR . 'core.create_dir_structure.php');
        cDeep_core_create_dir_structure($_params, $cDeep);
    }

    // write to tmp file, then rename it to avoid file locking race condition
    $_tmp_file = tempnam($_dirname, 'wrt');

    if (!($fd = @fopen($_tmp_file, 'wb'))) {
        $_tmp_file = $_dirname . DIRECTORY_SEPARATOR . uniqid('wrt');
        if (!($fd = @fopen($_tmp_file, 'wb'))) {
            $cDeep->trigger_error("problem writing temporary file '$_tmp_file'");
            return false;
        }
    }

    fwrite($fd, $params['contents']);
    fclose($fd);

    if (PHP_OS == 'Windows' || !@rename($_tmp_file, $params['filename'])) {
        // On platforms and filesystems that cannot overwrite with rename() 
        // delete the file before renaming it -- because windows always suffers
        // this, it is short-circuited to avoid the initial rename() attempt
        @unlink($params['filename']);
        @rename($_tmp_file, $params['filename']);
    }
    @chmod($params['filename'], $cDeep->_file_perms);

    return true;
}

/* vim: set expandtab: */

?>