<?php
function cDeep_function_feedback($params, &$cDeep) {
    $email = $cDeep->obj['Reg']->read('Exchange.Send.rEmail');
    $FeedBack['Form']['serviceType']=array();
    $Form = Filter::html_filter($_POST['form']);
    if ($_GET['Added']) {
        $FeedBack['Added'] = true;
		$cDeep->assign("form", $FeedBack);
    }
    if ($_GET['form']) {
        $FeedBack['Form'] = $_GET['form'];
		$cDeep->assign("form", $FeedBack);
    }	
    $FeedBack['Form'] = $Form;
    if (! empty($Form['site'])) {
        die('Spam not allowed!');
    }
    switch ($params['action']) {
        case 'visit':
            if ($Form && ! empty($Form['contacts'])) {
                $IP = $_SERVER['REMOTE_ADDR'];
                if ($email) {
                	$text = '<dl>';
					if (! empty($Form['serviceType'])) { 
					   $text .= "<dt>С сайта, вопрос главе администрации: </dt><dd>";
					   switch($Form['serviceType']){
						   case "1": $text .= "Диетология"; break;
						   case "2": $text .= "Психология"; break;
                           case "3": $text .= "Массаж"; break;
                           case "4": $text .= "Фитнес"; break;
                           case "5": $text .= "Косметология"; break;			   
					   }
					   $text .= "</dd>";
					}
					if (! empty($Form['Name'])) { 
                       $text .= '<dt>Имя:</dt><dd>'.$Form['Name'].'</dd>';
                    }
					$text .= '<dt>Компания:</dt><dd>'.$Form['company'].'</dd>';
					$text .= '<dt>Должность:</dt><dd>'.$Form['dolj'].'</dd>';
					$text .= '<dt>E-mail:</dt><dd>'.$Form['contacts'].'</dd>';
					$text .= '<dt>Телефон:</dt><dd>'.$Form['tel'].'</dd>';
					
					if (! empty($Form['details'])) { 
					   $text .= '<dt>Дополнительная информация:</dt><dd>'.$Form['details'].'</dd>';
					}					
					$text .= '</dl>';
					$result = Sendmail::sendme($email, 'С сайта, вопрос главе администрации: '.$_SERVER['SERVER_NAME'], '<h1> '.$IP.'</h1>'.$text);
	                $ID = $cDeep->obj['DB']->query("INSERT INTO `d_FeedBack` (`IP`, `Email`, `Message`) VALUES (?, ?, ?)", $IP, $Form['contacts'], '<h3>Заявка с сайта</h3>'.$text);
                    if ($ID) {
                        header('Location: ?Added=true');
                    } else {
                        $FeedBack['Error']['send'] = $result;
                    }
                }
            } elseif ($Form) {
                $FeedBack['Error']['EMPTY'] = true;
				$cDeep->assign("form", $FeedBack);
            }        
            break;
        case 'feed':
            if ($Form && ! empty($Form['email'])) {
                $IP = $_SERVER['REMOTE_ADDR'];
                if ($email) {
                    $text = '<dl>';
                    if (! empty($Form['Name'])) { $text .= '<dt>Заказчик:</dt><dd>'.$Form['Name'].'</dd>'; }
                    if (! empty($Form['www'])) { 
                       $text .= '<dt>Адрес сайта:</dt><dd>'.$Form['www'].'</dd>'; 
                    }
                    if (! empty($Form['contacts'])) { 
                       $text .= '<dt>Реквизиты:</dt><dd>'.$Form['contacts'].'</dd>'; 
                    }
                    if (! empty($Form['details'])) { 
                       $text .= '<dt>Дополнительная информация:</dt><dd>'.$Form['details'].'</dd>'; 
                    } 					
                    $text .= '</dl>';                	
                    $result = Sendmail::sendme($email, 'Поддержка '.$_SERVER['SERVER_NAME'], '<h1>Сообщение от '.$IP.'/'.$Form['email'].'</h1>'.$text);
                    $ID = $cDeep->obj['DB']->query("INSERT INTO `d_FeedBack` (`IP`, `Email`, `Message`) VALUES (?, ?, ?)", $IP, $Form['email'], '<h3>Поддержка</h3>'.$text);

                    if ($ID) {
                        header('Location: ?Added=true');
                    } else {
                        $FeedBack['Error']['send'] = $result;
                    }
                }
            } elseif ($Form) {
                $FeedBack['Error']['EMPTY'] = true;
				$cDeep->assign("form", $FeedBack);
            }        
            break;
        default:
            if ($Form && ! empty($Form['email']) && ! empty($Form['message'])) {
                $IP = $_SERVER['REMOTE_ADDR'];
                if ($email) {
                    $result = Sendmail::sendme($email, 'Заказ сайта '.$_SERVER['SERVER_NAME'], '<h1>Сообщение от '.$IP.'/'.$Form['email'].'</h1>'.$text);
                    $ID = $cDeep->obj['DB']->query("INSERT INTO `d_FeedBack` (`IP`, `Email`, `Message`) VALUES (?, ?, ?)", $IP, $Form['email'], $text);
                    if ($ID) {
                        header('Location: ?Added=true');
                    } else {
                        $FeedBack['Error']['send'] = $result;
                    }
                }
            } elseif ($Form) {
                $FeedBack['Error']['EMPTY'] = true;
				$cDeep->assign("form", $FeedBack);
            }
            break;
    }
}
