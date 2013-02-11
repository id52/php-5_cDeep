<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-06 08:36:57
         template file:sadm/faq/list/faq.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'file:sadm/faq/list/faq.tpl.php', 21, false),)), $this); ?><div class="info">
<h2>Вопрос-ответ</h2>
<p>Тут вы можете отредактировать вопросы пользователей или ответить на них.</p>
<p>На e-mail указанный в данной форме, будут отправляться новые вопросы: 
<form target="hFrm" action="/sadm/faq/list/" method='post'>
<input type="hidden" name="action" value="chmail">
<input type="text" name="adminemail" value="<?php echo $this->_tpl_vars['adminemail']; ?>
">&nbsp;
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
<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
	<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
">
	<td><input type='checkbox' name='delete[<?php echo $this->_tpl_vars['category']['id']; ?>
]' value='<?php echo $this->_tpl_vars['category']['id']; ?>
'></td>
	<td><input type='text' name='category[<?php echo $this->_tpl_vars['category']['id']; ?>
][name]'  value='<?php echo $this->_tpl_vars['category']['name']; ?>
'></td>
	<td><input type='text' name='category[<?php echo $this->_tpl_vars['category']['id']; ?>
][order]'  value='<?php echo $this->_tpl_vars['category']['order']; ?>
'></td>
	
	</tr>
<?php endforeach; endif; unset($_from); ?>
<tr bgcolor='#cccccc'><td>Новая категория</td><td><input type='text' name='newname'></td><td><input type='text' name='neworder'></td></tr>
</table>
<input type='submit' name='categories' value='Сохранить'>
</form>


<!---------------------------------------------------------------------------------------------------------------------->




<form method='get' target="hFrm" action="/sadm/faq/list/">
Категория:
<select name='currentcategory'>
<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
	<option value='<?php echo $this->_tpl_vars['category']['id']; ?>
' <?php if ($this->_tpl_vars['category']['id'] == $this->_tpl_vars['currentcategory']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']['name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
<option value="all" <?php if ($this->_tpl_vars['currentcategory'] == 'all' || $this->_tpl_vars['currentcategory'] == ''): ?>selected<?php endif; ?>>Все</option>
</select>
<input type='submit'  value='Показать'>
</form>


<!---------------------------------------------------------------------------------------------------------------------->






<?php if ($this->_tpl_vars['Faq']['questions']):  echo '
<script language="JavaScript">
function submitForm(act, conf)
{
	if(confirm(\'Вы действительно желаете \'+conf))
	{
		url=\'/sadm/faq/list/?action=\'+act;
		checkboxes = document.getElementsByName(\'fid[]\');
		for(i=0;i<checkboxes.length;i++)
		{
			url+=(checkboxes[i].checked)?\'&fid[]=\'+checkboxes[i].value:\'\';
		}
		$("#content").loadJFrame(url);
	}
}

function loadFrame(url, conf)
{
	if(confirm(\'Вы действительно желаете \'+conf))
	{
		$("#content").loadJFrame(url);
	}
}
</script>
';  $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:paging.tpl.php", 'cDeep_include_vars' => array('link' => "/sadm/faq/list/")));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?>





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
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['Faq']['questions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
								<tr class="<?php echo cDeep_function_cycle(array('values' => ",alt",'name' => 'color123'), $this);?>
">
									<td><input name="fid[]" type="checkbox" value="<?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['fid']; ?>
" /></td>
                                    <td nowrap="nowrap"><a href="/sadm/faq/<?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['fid']; ?>
.html" target="_top"><?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['Name']; ?>
</a><br><?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['date']; ?>
<br><a href="mailto:<?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['email']; ?>
"><?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['email']; ?>
</a></td>
									
                                    <td width="100%">
                                    <div class="comment"><p><a  target="_top" href="/sadm/faq/<?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['fid']; ?>
.html" style="font-weight:normal; text-decoration:underline;"><?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['Question']; ?>
</a></p>
                                    <?php if ($this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['Answer']): ?><blockquote><p><?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['Answer']; ?>
</p></blockquote></div><?php endif; ?>
                                    </td>
									
                                    <td nowrap="nowrap">
									<?php if ($this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['enabled']): ?>
										<span style="color:green;">Да</span>
									<?php else: ?>
										<span style="color:red;">Нет</span>
									<?php endif; ?>
									
									</td>
									<td><a href="/sadm/faq/<?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['fid']; ?>
.html" target="_top"><img src="/images/admin/page_white_edit.png" alt="Редактировать" /></a></td>						
									<td><a title="Удалить вопрос от <?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['Name']; ?>
"><span onclick="loadFrame('/sadm/faq/list/?action=delFaq&fid[]=<?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['fid']; ?>
','Удалить вопрос от <?php echo $this->_tpl_vars['Faq']['questions'][$this->_sections['i']['index']]['Name']; ?>
')"><img src="/images/admin/page_white_delete.png" alt="Удалить" /></span></a></td>
									
								</tr>   
<?php endfor; endif; ?>
							</tbody>
						</table>

<div class="buttons">
                <a class="negative"><span onclick="return submitForm('delFaq', 'Удалить отмеченые?');"><img src="/images/admin/delete.png" alt="" /> Удалить отмеченные</span></a> 
</div>
<br />

						</form>
<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "file:paging.tpl.php", 'cDeep_include_vars' => array('link' => "/sadm/faq/list/")));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  else: ?>                       
	<p><em><strong>Вопросов не задано.</strong></em></p>
<?php endif; ?>