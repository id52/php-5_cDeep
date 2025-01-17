<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */

/**
 * Extract non-cacheable parts out of compiled template and write it
 *
 * @param string $compile_path
 * @param string $template_compiled
 * @return boolean
 */

function cDeep_core_write_compiled_include($params, &$cDeep)
{
    $_tag_start = 'if \(\$this->caching && \!\$this->_cache_including\) \{ echo \'\{nocache\:('.$params['cache_serial'].')#(\d+)\}\'; \};';
    $_tag_end   = 'if \(\$this->caching && \!\$this->_cache_including\) \{ echo \'\{/nocache\:(\\2)#(\\3)\}\'; \};';

    preg_match_all('!('.$_tag_start.'(.*)'.$_tag_end.')!Us',
                   $params['compiled_content'], $_match_source, PREG_SET_ORDER);

    // no nocache-parts found: done
    if (count($_match_source)==0) return;

    // convert the matched php-code to functions
    $_include_compiled =  "<?php /* cDeep version ".$cDeep->_version.", created on ".strftime("%Y-%m-%d %H:%M:%S")."\n";
    $_include_compiled .= "         compiled from " . strtr(urlencode($params['resource_name']), array('%2F'=>'/', '%3A'=>':')) . " */\n\n";

    $_compile_path = $params['include_file_path'];

    $cDeep->_cache_serials[$_compile_path] = $params['cache_serial'];
    $_include_compiled .= "\$this->_cache_serials['".$_compile_path."'] = '".$params['cache_serial']."';\n\n?>";

    $_include_compiled .= $params['plugins_code'];
    $_include_compiled .= "<?php";

    $this_varname = ((double)phpversion() >= 5.0) ? '_cDeep' : 'this';
    for ($_i = 0, $_for_max = count($_match_source); $_i < $_for_max; $_i++) {
        $_match =& $_match_source[$_i];
        $source = $_match[4];
        if ($this_varname == '_cDeep') {
            /* rename $this to $_cDeep in the sourcecode */
            $tokens = token_get_all('<?php ' . $_match[4]);

            /* remove trailing <?php */
            $open_tag = '';
            while ($tokens) {
                $token = array_shift($tokens);
                if (is_array($token)) {
                    $open_tag .= $token[1];
                } else {
                    $open_tag .= $token;
                }
                if ($open_tag == '<?php ') break;
            }

            for ($i=0, $count = count($tokens); $i < $count; $i++) {
                if (is_array($tokens[$i])) {
                    if ($tokens[$i][0] == T_VARIABLE && $tokens[$i][1] == '$this') {
                        $tokens[$i] = '$' . $this_varname;
                    } else {
                        $tokens[$i] = $tokens[$i][1];
                    }                   
                }
            }
            $source = implode('', $tokens);
        }

        /* add function to compiled include */
        $_include_compiled .= "
function _cDeep_tplfunc_$_match[2]_$_match[3](&\$$this_varname)
{
$source
}

";
    }
    $_include_compiled .= "\n\n?>\n";

    $_params = array('filename' => $_compile_path,
                     'contents' => $_include_compiled, 'create_dirs' => true);

    require_once(cDeep_CORE_DIR . 'core.write_file.php');
    cDeep_core_write_file($_params, $cDeep);
    return true;
}


?>
