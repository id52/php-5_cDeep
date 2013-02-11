{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' }
{loader src='jquery-ui.css' type='css' base='/css/admin/' }
{loader src='jquery-ui.js, ui.datepicker-ru.js' type='js' base='/js/' comment='UI'}


{loader src='jquery.FCKEditor.js' type='js' base='/js/' comment='FCKEditor jplugin'}

<div id="container" class="nosidebar">
			{if $State.Current_item>0}
			<div id="content" class="clearfix nosidebar" src="/sadm/faq/add/{$State.Current_item}.html"></div>
			{else}
			<div id="content" class="clearfix nosidebar" src="/sadm/faq/list/"></div>
			{/if}
</div>