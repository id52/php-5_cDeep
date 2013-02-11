{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ядро, поддержка JFrame и JForm'}

{news_manager action="List"}
{if $news_manager.do=='PROPERTY'}{* указан конкретный номер - вывадим свойства *}
	{include file="file:sadm/news/item.tpl.php"}
{else}{* неуказан номер, выводим список*}
	{include file="file:sadm/news/list.tpl.php"}
{/if}{* конец проверки do *}
<br class="clear" />
