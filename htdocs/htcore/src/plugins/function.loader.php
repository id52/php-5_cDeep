<?
/*
Подключение скриптов
{loader src='script.js, script2.js' type='js' base='/js/'}

Подключение стилей
{loader src='style.css, style2.css' type='css' base='/css/'}

Вывод блока
{loader action='print'}

*/

function cDeep_function_loader($params, &$cDeep)
{
	$eos = "\n";

	switch (strtoupper($params['action'])) {
		case 'INSERT':
		case 'PRINT':
                    
				$loaded = is_array($cDeep->stack['loaded'])?$cDeep->stack['loaded']:array();
                    
				while (list($type, $files)=each($loaded))
				{
					switch (strtoupper($type)) {
						case 'JS':
						case 'JAVASCRIPT':
							while (list($file,$count)=each($files)) {
                                                               // $str= '<script language=\\\'JavaScript\\\' src=\\\''.$file.'\\\'></script>';
								print '<script language="JavaScript" src="'.$file.'"></script>'.$eos;
                                                              //  print $str;
                                                                
							}
							break;
					
						case 'CSS':
						case 'STYLE':
							#$files = array_reverse($files);
							while (list($file,$count)=each($files)) {
                                                                //$str='<link rel=\\\'stylesheet\\\' type=\\\'text/css\\\' href=\\\''.$file. '\\\'>';
                                                                print '<link rel="stylesheet" type="text/css" href="'.$file.'" />'.$eos;
                                                              //  print $str;
                                                                
                                                                
							}
							break;
							
						case 'COMMENT+':
							print '<!--'.$eos;
							while (list($file,$count)=each($files)) {
								print '['.$file.']:'.$count.''.$eos;
							}
							print '-->'.$eos;
							break;
							
						default:
							break;
					}
				}
			break;

		default:
			$src = $params['src'];
			$type = $params['type']?$params['type']:'unknown';
			$base = ($params['base'])?$params['base']:'/'.$type.'/';
			if (!empty($src)) 
			{
				$src = preg_split('/[,\s]+/', $src, 100, PREG_SPLIT_NO_EMPTY);
				while (list($i, $s)=each($src))
				{
					$cDeep->stack['loaded'][$type][$base.$s]++;
					$cDeep->stack['loaded']['comment'][$base.$s] = $params['comment'];
				}
			}
			break;
	}
}
?>