<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * delete an automagically created file by name and id
 *
 * @param string $auto_base
 * @param string $auto_source
 * @param string $auto_id
 * @param integer $exp_time
 * @return boolean
 */

// $auto_base, $auto_source = null, $auto_id = null, $exp_time = null

function cDeep_core_rm_auto($params, &$cDeep)
{
    if (!@is_dir($params['auto_base']))
      return false;

    if(!isset($params['auto_id']) && !isset($params['auto_source'])) {
        $_params = array(
            'dirname' => $params['auto_base'],
            'level' => 0,
            'exp_time' => $params['exp_time']
        );
        require_once(cDeep_CORE_DIR . 'core.rmdir.php');
        $_res = cDeep_core_rmdir($_params, $cDeep);
    } else {
        $_tname = $cDeep->_get_auto_filename($params['auto_base'], $params['auto_source'], $params['auto_id']);

        if(isset($params['auto_source'])) {
            if (isset($params['extensions'])) {
                $_res = false;
                foreach ((array)$params['extensions'] as $_extension)
                    $_res |= $cDeep->_unlink($_tname.$_extension, $params['exp_time']);
            } else {
                $_res = $cDeep->_unlink($_tname, $params['exp_time']);
            }
        } elseif ($cDeep->use_sub_dirs) {
            $_params = array(
                'dirname' => $_tname,
                'level' => 1,
                'exp_time' => $params['exp_time']
            );
            require_once(cDeep_CORE_DIR . 'core.rmdir.php');
            $_res = cDeep_core_rmdir($_params, $cDeep);
        } else {
            // remove matching file names
            $_handle = opendir($params['auto_base']);
            $_res = true;
            while (false !== ($_filename = readdir($_handle))) {
                if($_filename == '.' || $_filename == '..') {
                    continue;
                } elseif (substr($params['auto_base'] . DIRECTORY_SEPARATOR . $_filename, 0, strlen($_tname)) == $_tname) {
                    $_res &= (bool)$cDeep->_unlink($params['auto_base'] . DIRECTORY_SEPARATOR . $_filename, $params['exp_time']);
                }
            }
        }
    }

    return $_res;
}

/* vim: set expandtab: */

?>
