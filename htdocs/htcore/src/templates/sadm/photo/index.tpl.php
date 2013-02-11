{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ядро, поддержка JFrame и JForm'}
{video_manager action="List"}


{if $video_manager.do=='PROPERTY'}{* указан конкретный номер - вывадим свойства *}
  {include file="file:sadm/photo/item.tpl.php"}
{else}{* неуказан номер, выводим список*}
  {include file="file:sadm/photo/list.tpl.php"}
{/if}{* конец проверки do *}
<br class="clear" />
