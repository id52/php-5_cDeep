<div class="info">
<h2>Вопрос-ответ</h2>
<p>Тут вы можете отредактировать вопросы пользователей или ответить на них.</p>
<p>На e-mail указанный в данной форме, будут отправляться новые вопросы: 
<form target="hFrm" action="/sadm/faq/list/" method='post'>
<input type="hidden" name="action" value="chmail">
<input type="text" name="adminemail" value="{$adminemail}">&nbsp;
<input type="submit" value="сохранить">
</form>
</p>
</div>

<!---------------------------------------------------------------------------------------------------------------------->

<form method='post' target="hFrm" action="/sadm/faq/list/">
<table>
<thead>
<th>Удалить?</th><th>Название категории</th><th>Порядок</th>
</thead>
{foreach from=$categories item=category}
	<tr class="{cycle values=",alt" name="color123"}">
	<td><input type='checkbox' name='delete[{$category.id}]' value='{$category.id}'></td>
	<td><input type='text' name='category[{$category.id}][name]'  value='{$category.name}'></td>
	<td><input type='text' name='category[{$category.id}][order]'  value='{$category.order}'></td>
	
	</tr>
{/foreach}
<tr bgcolor='#cccccc'><td>Новая категория</td><td><input type='text' name='newname'></td><td><input type='text' name='neworder'></td></tr>
</table>
<input type='submit' name='categories' value='Сохранить'>
</form>


<!---------------------------------------------------------------------------------------------------------------------->




<form method='get' target="hFrm" action="/sadm/faq/list/">
Категория:
<select name='currentcategory'>
{foreach from=$categories item=category}
	<option value='{$category.id}' {if $category.id==$currentcategory}selected{/if}>{$category.name}</option>
{/foreach}
<option value="all" {if $currentcategory=='all' || $currentcategory==''}selected{/if}>Все</option>
</select>
<input type='submit'  value='Показать'>
</form>


<!---------------------------------------------------------------------------------------------------------------------->






{if $Faq.questions}
{literal}
<script language="JavaScript">
function submitForm(act, conf)
{
	if(confirm('Вы действительно желаете '+conf))
	{
		url='/sadm/faq/list/?action='+act;
		checkboxes = document.getElementsByName('fid[]');
		for(i=0;i<checkboxes.length;i++)
		{
			url+=(checkboxes[i].checked)?'&fid[]='+checkboxes[i].value:'';
		}
		$("#content").loadJFrame(url);
	}
}

function loadFrame(url, conf)
{
	if(confirm('Вы действительно желаете '+conf))
	{
		$("#content").loadJFrame(url);
	}
}
</script>
{/literal}




{include file="file:paging.tpl.php" link="/sadm/faq/list/"}
	<div class="relatedlinks">
		<a><span onclick="return selectAll('fid[]');">отметить все</span></a>|<a><span onclick="return deselectAll('fid[]');">снять отметки</span></a>|<a><span onclick="return selectInverse('fid[]');">инвертировать отмеченные</span></a>
	</div>
						<table cellspacing="0" id="popular" summary="Popular topics from community members">
                        	<thead>
                                <tr>
                                    <th>Выборка</th>
                                    <th>Дата</th>
                                    
                                    <th>Вопрос</th>
                                    
                                    <th>Отображается?</th>
									
                                    <th colspan="2">&nbsp;</th>
                                </tr>
                            </thead>
							<tbody>
{section name=i loop=$Faq.questions}
								<tr class="{cycle values=",alt" name="color123"}">
									<td><input name="fid[]" type="checkbox" value="{$Faq.questions[i].fid}" /></td>
                                    <td nowrap="nowrap"><a href="/sadm/faq/{$Faq.questions[i].fid}.html" target="_top">{$Faq.questions[i].Name}</a><br>{$Faq.questions[i].date}<br><a href="mailto:{$Faq.questions[i].email}">{$Faq.questions[i].email}</a></td>
									
                                    <td width="100%">
                                    <div class="comment"><p><a  target="_top" href="/sadm/faq/{$Faq.questions[i].fid}.html" style="font-weight:normal; text-decoration:underline;">{$Faq.questions[i].Question}</a></p>
                                    {if $Faq.questions[i].Answer}<blockquote><p>{$Faq.questions[i].Answer}</p></blockquote></div>{/if}
                                    </td>
									
                                    <td nowrap="nowrap">
									{if $Faq.questions[i].enabled}
										<span style="color:green;">Да</span>
									{else}
										<span style="color:red;">Нет</span>
									{/if}
									
									</td>
									<td><a href="/sadm/faq/{$Faq.questions[i].fid}.html" target="_top"><img src="/images/admin/page_white_edit.png" alt="Редактировать" /></a></td>						
									<td><a title="Удалить вопрос от {$Faq.questions[i].Name}"><span onclick="loadFrame('/sadm/faq/list/?action=delFaq&fid[]={$Faq.questions[i].fid}','Удалить вопрос от {$Faq.questions[i].Name}')"><img src="/images/admin/page_white_delete.png" alt="Удалить" /></span></a></td>
									
								</tr>   
{/section}
							</tbody>
						</table>

<div class="buttons">
                <a class="negative"><span onclick="return submitForm('delFaq', 'Удалить отмеченые?');"><img src="/images/admin/delete.png" alt="" /> Удалить отмеченные</span></a> 
</div>
<br />

						</form>
{include file="file:paging.tpl.php" link="/sadm/faq/list/"}
{else}                       
	<p><em><strong>Вопросов не задано.</strong></em></p>
{/if}
