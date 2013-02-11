<?

class Config {
  /**#@+
  * cDeep Configuration Section
  */
  public $core_dir = ROOT;
  /**
   * Set variables
   *
   */
  function Config()
  {
    $this->SERVER = "http://".$_SERVER["HTTP_HOST"];
    $this->uri_trigger = true; // обрабатывать модули встречающиеся после параметров в урле
    $this->ob_enable = true; // буферизация вывода
    $this->DSN = 'mysql://toor@localhost/base'; // DSN для подключения к базе
    $this->obj = array(); //массив для ссылок на объекты
    
    /**
     * The name of the directory where templates are located.
     *
     * @var string
     */
    $this->template_dir    =  ROOT."src/templates/";
  /**
     * The directory where compiled templates are located.
     *
     * @var string
     */
    $this->compile_dir     =  ROOT."tmp/compiled/";

    /**
     * The directory where config files are located.
     *
     * @var string
     */
    $this->config_dir      =  ROOT."etc/";
    $this->source_dir      =  ROOT."src/";
    $this->core_dir        =  ROOT."lib/";
    $this->libs_dir        =  ROOT."lib/";

    /**
     * An array of directories searched for plugins.
     *
     * @var array
     */
    $this->plugins_dir     =  array(ROOT.'src/plugins/');

    /**
     * If debugging is enabled, a debug console window will display
     * when the page loads (make sure your browser allows unrequested
     * popup windows)
     *
     * @var boolean
     */
    $this->debugging       =  false;

    /**
     * When set, cDeep does uses this value as error_reporting-level.
     *
     * @var boolean
     */
    $this->error_reporting  =  null;

    /**
     * This is the path to the debug console template. If not set,
     * the default one will be used.
     *
     * @var string
     */
    $this->debug_tpl       =  '';

    /**
     * This determines if debugging is enable-able from the browser.
     * <ul>
     *  <li>NONE => no debugging control allowed</li>
     *  <li>URL => enable debugging when cDeep_DEBUG is found in the URL.</li>
     * </ul>
     * @link http://www.foo.dom/index.php?cDeep_DEBUG
     * @var string
     */
    $this->debugging_ctrl  =  'NONE';

    /**
     * This tells cDeep whether to check for recompiling or not. Recompiling
     * does not need to happen unless a template or config file is changed.
     * Typically you enable this during development, and disable for
     * production.
     *
     * @var boolean
     */
    $this->compile_check   =  true;

    /**
     * This forces templates to compile every time. Useful for development
     * or debugging.
     *
     * @var boolean
     */
    $this->force_compile   =  false;

    /**
     * This enables template caching.
     * <ul>
     *  <li>0 = no caching</li>
     *  <li>1 = use class cache_lifetime value</li>
     *  <li>2 = use cache_lifetime in cache file</li>
     * </ul>
     * @var integer
     */
    $this->caching         =  0;

    /**
     * The name of the directory for cache files.
     *
     * @var string
     */
    $this->cache_dir       =  ROOT.'tmp/cache/';

    /**
     * This is the number of seconds cached content will persist.
     * <ul>
     *  <li>0 = always regenerate cache</li>
     *  <li>-1 = never expires</li>
     * </ul>
     *
     * @var integer
     */
    $this->cache_lifetime  =  3600;

    /**
     * Only used when $caching is enabled. If true, then If-Modified-Since headers
     * are respected with cached content, and appropriate HTTP headers are sent.
     * This way repeated hits to a cached page do not send the entire page to the
     * client every time.
     *
     * @var boolean
     */
    $this->cache_modified_check = false;

    /**
     * This determines how cDeep handles "<?php ... ?>" tags in templates.
     * possible values:
     * <ul>
     *  <li>cDeep_PHP_PASSTHRU -> print tags as plain text</li>
     *  <li>cDeep_PHP_QUOTE    -> escape tags as entities</li>
     *  <li>cDeep_PHP_REMOVE   -> remove php tags</li>
     *  <li>cDeep_PHP_ALLOW    -> execute php tags</li>
     * </ul>
     *
     * @var integer
     */
    $this->php_handling    =  cDeep_PHP_PASSTHRU;

    /**
     * This enables template security. When enabled, many things are restricted
     * in the templates that normally would go unchecked. This is useful when
     * untrusted parties are editing templates and you want a reasonable level
     * of security. (no direct execution of PHP in templates for example)
     *
     * @var boolean
     */
    $this->security       =   true;

    /**
     * This is the list of template directories that are considered secure. This
     * is used only if {@link $security} is enabled. One directory per array
     * element.  {@link $template_dir} is in this list implicitly.
     *
     * @var array
     */
    $this->secure_dir     =   array();

    /**
     * These are the security settings for cDeep. They are used only when
     * {@link $security} is enabled.
     *
     * @var array
     */
    $this->security_settings  = array(
    'PHP_HANDLING'    => true,
    'IF_FUNCS'        => array('array', 'list',
    'isset', 'empty',
    'count', 'sizeof',
    'in_array', 'is_array',
    'true', 'false', 'null'),
    'INCLUDE_ANY'     => true,
    'PHP_TAGS'        => true,
    'MODIFIER_FUNCS'  => array('count'),
    'ALLOW_CONSTANTS'  => false
    );

    /**
     * This is an array of directories where trusted php scripts reside.
     * {@link $security} is disabled during their inclusion/execution.
     *
     * @var array
     */
    $this->trusted_dir        = array();

    /**
     * The left delimiter used for the template tags.
     *
     * @var string
     */
    $this->left_delimiter  =  '{';

    /**
     * The right delimiter used for the template tags.
     *
     * @var string
     */
    $this->right_delimiter =  '}';

    /**
     * The order in which request variables are registered, similar to
     * variables_order in php.ini E = Environment, G = GET, P = POST,
     * C = Cookies, S = Server
     *
     * @var string
     */
    $this->request_vars_order    = 'EGPCS';

    /**
     * Indicates wether $HTTP_*_VARS[] (request_use_auto_globals=false)
     * are uses as request-vars or $_*[]-vars. note: if
     * request_use_auto_globals is true, then $request_vars_order has
     * no effect, but the php-ini-value "gpc_order"
     *
     * @var boolean
     */
    $this->request_use_auto_globals      = true;

    /**
     * Set this if you want different sets of compiled files for the same
     * templates. This is useful for things like different languages.
     * Instead of creating separate sets of templates per language, you
     * set different compile_ids like 'en' and 'de'.
     *
     * @var string
     */
    $this->compile_id            = "p";

    /**
     * This tells cDeep whether or not to use sub dirs in the cache/ and
     * templates_c/ directories. sub directories better organized, but
     * may not work well with PHP safe mode enabled.
     *
     * @var boolean
     *
     */
    $this->use_sub_dirs          = false;

    /**
     * This is a list of the modifiers to apply to all template variables.
     * Put each modifier in a separate array element in the order you want
     * them applied. example: <code>array('escape:"htmlall"');</code>
     *
     * @var array
     */
    $this->default_modifiers        = array();

    /**
     * This is the resource type to be used when not specified
     * at the beginning of the resource path. examples:
     * $cDeep->display('file:index.tpl');
     * $cDeep->display('db:index.tpl');
     * $cDeep->display('index.tpl'); // will use default resource type
     * {include file="file:index.tpl"}
     * {include file="db:index.tpl"}
     * {include file="index.tpl"} {* will use default resource type *}
     *
     * @var array
     */
    $this->default_resource_type    = 'db';

    /**
     * The function used for cache file handling. If not set, built-in caching is used.
     *
     * @var null|string function name
     */
    $this->cache_handler_func   = null;

    /**
     * This indicates which filters are automatically loaded into cDeep.
     *
     * @var array array of filter names
     */
    $this->autoload_filters = array();//array("output"=>array("strip"));

    /**#@+
    * @var boolean
    */
    /**
     * This tells if config file vars of the same name overwrite each other or not.
     * if disabled, same name variables are accumulated in an array.
     */
    $this->config_overwrite = true;

    /**
     * This tells whether or not to automatically booleanize config file variables.
     * If enabled, then the strings "on", "true", and "yes" are treated as boolean
     * true, and "off", "false" and "no" are treated as boolean false.
     */
    $this->config_booleanize = true;

    /**
     * This tells whether hidden sections [.foobar] are readable from the
     * tempalates or not. Normally you would never allow this since that is
     * the point behind hidden sections: the application can access them, but
     * the templates cannot.
     */
    $this->config_read_hidden = false;

    /**
     * This tells whether or not automatically fix newlines in config files.
     * It basically converts \r (mac) or \r\n (dos) to \n
     */
    $this->config_fix_newlines = true;
    /**#@-*/

    /**
     * If a template cannot be found, this PHP function will be executed.
     * Useful for creating templates on-the-fly or other special action.
     *
     * @var string function name
     */
    $this->default_template_handler_func = '';

    /**
     * The file that contains the compiler class. This can a full
     * pathname, or relative to the php_include path.
     *
     * @var string
     */
    $this->compiler_file        =    'cDeep_Compiler.class.php';

    /**
     * The class used for compiling templates.
     *
     * @var string
     */
    $this->compiler_class        =   'cDeep_Compiler';

    /**
     * The class used to load config vars.
     *
     * @var string
     */
    $this->config_class          =   'Config_File';

    /**#@+
    * END cDeep Configuration Section
    * There should be no need to touch anything below this line.
    * @access private
    */
  }
}

?>