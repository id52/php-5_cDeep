<?
function cDeep_function_email($params, &$cDeep)
{

		$body="<h2>Ваш вопрос: </h2>".$_POST['question']."<br><h2>Ответ: </h2>".$_POST['answer']."<br>";
		$subject = $cDeep->obj['DB']->selectCell('select `value` from `site` where `name`="title"');
		Sendmail::sendme($_POST['email'],$subject, $body);
}
?>