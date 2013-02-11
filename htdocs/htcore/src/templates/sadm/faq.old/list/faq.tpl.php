<div class="info">
<h2>Вопрос-ответ</h2>
<p>Тут вы можете отредактировать вопросы пользователей или ответить на них</p>
</div>
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
						<table cellspacing="0" id="popular" summary="Popular topics from community members" class="mytable">
                        	<thead>
                                <tr>
                                    <th>Выборка</th>
                                    <th>Дата</th>
                                    <th>Имя</th>
                                    <th>Вопрос</th>
{*                                    <th>Email</th>
                                    <th>IP</th>*}
                                    <th colspan="2">&nbsp;</th>
                                </tr>
                            </thead>
							<tbody>
{section name=i loop=$Faq.questions}
								<tr class="{cycle values=',alt'} {if !$Faq.questions[i].enabled} newquestion{/if}">
									<td><input name="fid[]" type="checkbox" value="{$Faq.questions[i].fid}" /></td>
                                    <td nowrap="nowrap">{$Faq.questions[i].date}</td>
									<td><a href="/sadm/faq/{$Faq.questions[i].fid}.html" target="_top">{$Faq.questions[i].Name}</a></td>
                                    <td width="100%">
                                    <div class="comment"><p>{$Faq.questions[i].Question}</p>
                                    {if $Faq.questions[i].Answer}<blockquote><p>{$Faq.questions[i].Answer}</p></blockquote></div>{/if}
                                    </td>
{*									<td><a href="mailto:{$Faq.questions[i].email}">{$Faq.questions[i].email}</a></td>
                                    <td nowrap="nowrap">{$Faq.questions[i].ip}</td>*}
									<td><a href="/sadm/faq/{$Faq.questions[i].fid}.html" target="_top"><img src="/img/icons/page_white_edit.png" alt="Редактировать" /></a></td>						
									<td><a title="Удалить вопрос от {$Faq.questions[i].Name}"><span onclick="loadFrame('/sadm/faq/list/?action=delFaq&fid[]={$Faq.questions[i].fid}','Удалить вопрос от {$Faq.questions[i].Name}')"><img src="/img/icons/page_white_delete.png" alt="Удалить" /></span></a></td>
								</tr>   
{/section}
							</tbody>
						</table>

<div class="buttons">
                <a class="negative"><span onclick="return submitForm('delFaq', 'Удалить отмеченые?');"><img src="/img/icons/delete.png" alt="" /> Удалить отмеченные</span></a> 
</div>
<br />
                        
                        
						</form>
{include file="file:paging.tpl.php" link="/sadm/faq/list/"}
{else}                       
	<p><em><strong>Вопросов не заданно.</strong></em></p>
{/if}
