{loader src='jquery.js,jquery.form.js,jquery.jframe.js' type='js' comment='JQuery ядро, поддержка JFrame и JForm'}
{loader src='jquery.FCKEditor.js' type='js' base='/js/' comment='FCKEditor jplugin'}

{loader src='catalog.css' type='css' base='/css/admin/' comment='Стили'}

{a_catalog action="Edit" item=$State.Current_item }
{***** 
    если редактируем то сообщаем текущей странице в каком месте каталогам мы находимся — tree/list[{$Page.parent}].xml
******}
<hr/> 
<div id="secondary">
	<div id="sidebar_content">
	    <div src="tree/list[{$Item.mgid}].xml?current={$Item.mid}"></div>
	</div>
</div>

<hr/>
<div id="container">
  <div id="content" class="clearfix">
  {include file='file:sadm/catalog/item/index.tpl.php'}
  </div>
</div>