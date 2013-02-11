{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ����, ��������� JFrame � JForm'}
{loader src='jquery.FCKEditor.js' type='js' base='/js/' comment='FCKEditor jplugin'}

{loader src='datepicker.css' type='css' base='/css/' comment='�����'}
{loader src='ui.core.js,effects.core.js,effects.drop.js,ui.sortable.js,ui.draggable.js,ui.droppable.js,ui.datepicker.js,i18n/ui.datepicker-ru.js' type='js' base='/js/ui/' comment='UI'}

<div id="container" class="nosidebar">
			{if $State.Current_item>0}
			<div id="content" class="clearfix nosidebar" src="/sadm/faq/add/{$State.Current_item}.html"></div>
			{else}
			<div id="content" class="clearfix nosidebar" src="/sadm/faq/list/"></div>
			{/if}
</div>