<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-08 13:47:41
         template file:sadm/vote/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'a_vote', 'file:sadm/vote/index.tpl.php', 2, false),)), $this); ?><?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "sadm/header.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
  echo cDeep_function_a_vote(array('id' => $this->_tpl_vars['State']['Current_item']), $this); echo '
<script>
function confirm_delete(id)
{

	if(confirm("Удалить?"))
	{
		$.get(id+".xml?action=rmQuest");
		$(\'#vote\'+id).remove();
		
	};
};
</script>
'; ?>



<div id="secondary">
    <div id="sidebar_content" class="clearfix">
    <h3>Опросы <a href="new.xml"><img src="/images/admin/tag_blue.png" alt="добавить"/>добавить</a></h3>
		<?php echo cDeep_function_a_vote(array(), $this);?>

        <ul id="opros">
        <?php $_from = $this->_tpl_vars['Votes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['V']):
?>
        	<li id=vote<?php echo $this->_tpl_vars['V']['id']; ?>
>
			<a class="name" href="<?php echo $this->_tpl_vars['V']['id']; ?>
.xml">
			<?php if ($this->_tpl_vars['State']['Current_item'] == $this->_tpl_vars['V']['id']): ?><i><?php endif; ?>
			
			<?php if ($this->_tpl_vars['V']['enabled']): ?><span style="font-size:14px;"><?php endif; ?>
			<?php echo $this->_tpl_vars['V']['title']; ?>

			<?php if ($this->_tpl_vars['V']['enabled']): ?></span><?php endif; ?>
			<?php if ($this->_tpl_vars['State']['Current_item'] == $this->_tpl_vars['V']['id']): ?></i><?php endif; ?>
			</a>
	
			<img onclick="confirm_delete(<?php echo $this->_tpl_vars['V']['id']; ?>
)" src="/images/admin/cross.png" />
		
			</li>
        <?php endforeach; endif; unset($_from); ?>

        </ul>
	</div>
</div>

<hr/>
<?php echo '

<script>
function clearfield(field)
{
	if(confirm("Удалить?"))
	{
		document.getElementById(field).value = \'\';
		document.getElementById(\'qform\').submit();
		return false;
	};
}
</script>

'; ?>

<div id="container">
  <div id="content" class="clearfix">
        <div class="info">
          <h2><?php echo $this->_tpl_vars['topic']; ?>
</h2>
        </div>  
<form method="POST" id="qform">
<ul>
   	<li>
    <label class="desc">Тема опроса</label>
    <div>
	<input type="text" class="field text medium" id="first" name="title" value="<?php echo $this->_tpl_vars['Vote']['title']; ?>
" />
    <label>Ваш вопрос к посетителям сайта</label>
    </div>
    <span>
	<input type="checkbox" class="field text checkbox" id="active" name="enabled" value="1" <?php if ($this->_tpl_vars['Vote']['enabled']): ?> checked="checked"<?php endif; ?> />
    <label class="choice" for="active">Активный опрос</label>
    </span>    
   	</li>
   	<li>
    <label class="desc">Варианты ответов</label>

    
    <?php $_from = $this->_tpl_vars['Vote']['quest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['q'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['q']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Quest'] => $this->_tpl_vars['Stat']):
        $this->_foreach['q']['iteration']++;
?>
    <div class="left half">    
   	<input type="text" class="field text full" id="q<?php echo $this->_foreach['q']['iteration']; ?>
" name="quest[]" value="<?php echo $this->_tpl_vars['Quest']; ?>
" />
    <label>Вариант ответа номер <?php echo $this->_foreach['q']['iteration']; ?>
, набрал <?php echo $this->_tpl_vars['Stat']; ?>
 голосов</label></div>
	<a class="delete" href="#" onclick="return clearfield('q<?php echo $this->_foreach['q']['iteration']; ?>
');"><img src="/images/admin/delete.png" /></a><br class="clear" />   
	<?php endforeach; endif; unset($_from); ?>
    <div class="left half">    
   	<input type="text" class="field text full" id="third" name="quest[]" value="" />
        	
    <label>Новый</label></div>
	<br class="clear" />
    </li>
   	<li class="buttons">
   	<button type="submit"><img src="/images/admin/add.png" /> Добавить | Сохранить</button>
	</li>
</form>
    </div>
</div>
<?php $_cDeep_tpl_vars = $this->_tpl_vars;
$this->_cDeep_include(array('cDeep_include_tpl_file' => "sadm/footer.tpl.php", 'cDeep_include_vars' => array()));
$this->_tpl_vars = $_cDeep_tpl_vars;
unset($_cDeep_tpl_vars);
 ?> 
    