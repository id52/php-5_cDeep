<?php
/**
 * cDeep plugin
 * @package cDeep
 * @subpackage plugins
 */


/**
 * cDeep {fetch} plugin
 *
 * Type:     function<br>
 * Name:     fetch<br>
 * Purpose:  fetch file, web or ftp data and display results
 * @link http://cDeep.php.net/manual/en/language.function.fetch.php {fetch}
 *       (cDeep online manual)
 * @author Monte Ohrt <monte at ohrt dot com>
 * @param array
 * @param cDeep
 * @return string|null if the assign parameter is passed, cDeep assigns the
 *                     result to a template variable
 */
function cDeep_function_fetch($params, &$cDeep)
{
    if (empty($params['file'])) {
        $cDeep->_trigger_fatal_error("[plugin] parameter 'file' cannot be empty");
        return;
    }

    $content = '';
    if ($cDeep->security && !preg_match('!^(http|ftp)://!i', $params['file'])) {
        $_params = array('resource_type' => 'file', 'resource_name' => $params['file']);
        require_once(cDeep_CORE_DIR . 'core.is_secure.php');
        if(!cDeep_core_is_secure($_params, $cDeep)) {
            $cDeep->_trigger_fatal_error('[plugin] (secure mode) fetch \'' . $params['file'] . '\' is not allowed');
            return;
        }
        
        // fetch the file
        if($fp = @fopen($params['file'],'r')) {
            while(!feof($fp)) {
                $content .= fgets ($fp,4096);
            }
            fclose($fp);
        } else {
            $cDeep->_trigger_fatal_error('[plugin] fetch cannot read file \'' . $params['file'] . '\'');
            return;
        }
    } else {
        // not a local file
        if(preg_match('!^http://!i',$params['file'])) {
            // http fetch
            if($uri_parts = parse_url($params['file'])) {
                // set defaults
                $host = $server_name = $uri_parts['host'];
                $timeout = 30;
                $accept = "image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*";
                $agent = "cDeep Template Engine ".$cDeep->_version;
                $referer = "";
                $uri = !empty($uri_parts['path']) ? $uri_parts['path'] : '/';
                $uri .= !empty($uri_parts['query']) ? '?' . $uri_parts['query'] : '';
                $_is_proxy = false;
                if(empty($uri_parts['port'])) {
                    $port = 80;
                } else {
                    $port = $uri_parts['port'];
                }
                if(!empty($uri_parts['user'])) {
                    $user = $uri_parts['user'];
                }
                if(!empty($uri_parts['pass'])) {
                    $pass = $uri_parts['pass'];
                }
                // loop through parameters, setup headers
                foreach($params as $param_key => $param_value) {
                    switch($param_key) {
                        case "file":
                        case "assign":
                        case "assign_headers":
                            break;
                        case "user":
                            if(!empty($param_value)) {
                                $user = $param_value;
                            }
                            break;
                        case "pass":
                            if(!empty($param_value)) {
                                $pass = $param_value;
                            }
                            break;
                        case "accept":
                            if(!empty($param_value)) {
                                $accept = $param_value;
                            }
                            break;
                        case "header":
                            if(!empty($param_value)) {
                                if(!preg_match('![\w\d-]+: .+!',$param_value)) {
                                    $cDeep->_trigger_fatal_error("[plugin] invalid header format '".$param_value."'");
                                    return;
                                } else {
                                    $extra_headers[] = $param_value;
                                }
                            }
                            break;
                        case "proxy_host":
                            if(!empty($param_value)) {
                                $proxy_host = $param_value;
                            }
                            break;
                        case "proxy_port":
                            if(!preg_match('!\D!', $param_value)) {
                                $proxy_port = (int) $param_value;
                            } else {
                                $cDeep->_trigger_fatal_error("[plugin] invalid value for attribute '".$param_key."'");
                                return;
                            }
                            break;
                        case "agent":
                            if(!empty($param_value)) {
                                $agent = $param_value;
                            }
                            break;
                        case "referer":
                            if(!empty($param_value)) {
                                $referer = $param_value;
                            }
                            break;
                        case "timeout":
                            if(!preg_match('!\D!', $param_value)) {
                                $timeout = (int) $param_value;
                            } else {
                                $cDeep->_trigger_fatal_error("[plugin] invalid value for attribute '".$param_key."'");
                                return;
                            }
                            break;
                        default:
                            $cDeep->_trigger_fatal_error("[plugin] unrecognized attribute '".$param_key."'");
                            return;
                    }
                }
                if(!empty($proxy_host) && !empty($proxy_port)) {
                    $_is_proxy = true;
                    $fp = fsockopen($proxy_host,$proxy_port,$errno,$errstr,$timeout);
                } else {
                    $fp = fsockopen($server_name,$port,$errno,$errstr,$timeout);
                }

                if(!$fp) {
                    $cDeep->_trigger_fatal_error("[plugin] unable to fetch: $errstr ($errno)");
                    return;
                } else {
                    if($_is_proxy) {
                        fputs($fp, 'GET ' . $params['file'] . " HTTP/1.0\r\n");
                    } else {
                        fputs($fp, "GET $uri HTTP/1.0\r\n");
                    }
                    if(!empty($host)) {
                        fputs($fp, "Host: $host\r\n");
                    }
                    if(!empty($accept)) {
                        fputs($fp, "Accept: $accept\r\n");
                    }
                    if(!empty($agent)) {
                        fputs($fp, "User-Agent: $agent\r\n");
                    }
                    if(!empty($referer)) {
                        fputs($fp, "Referer: $referer\r\n");
                    }
                    if(isset($extra_headers) && is_array($extra_headers)) {
                        foreach($extra_headers as $curr_header) {
                            fputs($fp, $curr_header."\r\n");
                        }
                    }
                    if(!empty($user) && !empty($pass)) {
                        fputs($fp, "Authorization: BASIC ".base64_encode("$user:$pass")."\r\n");
                    }

                    fputs($fp, "\r\n");
                    while(!feof($fp)) {
                        $content .= fgets($fp,4096);
                    }
                    fclose($fp);
                    $csplit = split("\r\n\r\n",$content,2);

                    $content = $csplit[1];

                    if(!empty($params['assign_headers'])) {
                        $cDeep->assign($params['assign_headers'],split("\r\n",$csplit[0]));
                    }
                }
            } else {
                $cDeep->_trigger_fatal_error("[plugin] unable to parse URL, check syntax");
                return;
            }
        } else {
            // ftp fetch
            if($fp = @fopen($params['file'],'r')) {
                while(!feof($fp)) {
                    $content .= fgets ($fp,4096);
                }
                fclose($fp);
            } else {
                $cDeep->_trigger_fatal_error('[plugin] fetch cannot read file \'' . $params['file'] .'\'');
                return;
            }
        }

    }


    if (!empty($params['assign'])) {
        $cDeep->assign($params['assign'],$content);
    } else {
        return $content;
    }
}

/* vim: set expandtab: */

?>
