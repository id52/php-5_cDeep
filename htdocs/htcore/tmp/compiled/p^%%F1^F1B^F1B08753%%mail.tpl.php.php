<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-02-13 08:37:40
         template file:sadm/mail/mail.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'registry', 'file:sadm/mail/mail.tpl.php', 3, false),array('function', 'settings', 'file:sadm/mail/mail.tpl.php', 16, false),array('modifier', 'rusdate', 'file:sadm/mail/mail.tpl.php', 58, false),)), $this); ?><div id="container">
  <div id="content" class="nosidebar clearfix">
<?php echo cDeep_function_registry(array('target' => 'Exchange.Send'), $this);?>

<form method="POST" style="width:300px;">
<input type="hidden" name="action" value="chmail">
<ul>
	<li><div class="info">
    	<h2>Настройки сайта</h2>
    </div></li>
	<li>
		<label class="desc">email, куда будут приходить письма с сайта</label>
		<div><input class="text full" type="text" name="registry[Exchange.Send.rEmail]" value="<?php echo $this->_tpl_vars['registry']['rEmail']; ?>
" size="40"></div>
	</li>


<?php echo cDeep_function_settings(array(), $this);?>


<li>
<label class='desc'>Название сайта в заголовке окна браузера. &#60;title&#62;</label>
<div><input class="text full" type='text' name='sitename' value='<?php echo $this->_tpl_vars['sitename']; ?>
'></div>
</li>
<li><div class="info">

    	<h2>Настройки робокассы</h2>
		
		<p>
		<a href="http://robokassa.ru/">http://robokassa.ru/</a>
		</p>
		
		<label class='desc' for='mrh_login'>mrh_login</label>
		<input class="text full" type='text' id='mrh_login' name='mrh_login' value='<?php echo $this->_tpl_vars['mrh_login']; ?>
'>
		
		<label class='desc' for='mrh_pass1'>mrh_pass1</label>
		<input class="text full" type='text' id='mrh_pass1' name='mrh_pass1' value='<?php echo $this->_tpl_vars['mrh_pass1']; ?>
'>
		
		<label class='desc' for='inv_desc'>inv_desc</label>
		<input class="text full" type='text' id='inv_desc'  name='inv_desc' value='<?php echo $this->_tpl_vars['inv_desc']; ?>
'>
		
		<label class='desc' for='shp_item'>shp_item</label>
		<input class="text full" type='text' id='shp_item' name='shp_item' value='<?php echo $this->_tpl_vars['shp_item']; ?>
'>
		
		<label class='desc' for='in_curr'>in_curr</label>
		<input class="text full" type='text' id='in_curr'  name='in_curr' value='<?php echo $this->_tpl_vars['in_curr']; ?>
'>
		
		<label class='desc' for='culture'>culture</label>
		<input class="text full" type='text' id='culture'  name='culture' value='<?php echo $this->_tpl_vars['culture']; ?>
'>
		
		<label class='desc' for='mrh_pass2'>mrh_pass2</label>
		<input class="text full" type='text' id='mrh_pass2' name='mrh_pass2' value='<?php echo $this->_tpl_vars['mrh_pass2']; ?>
'>
		

    </div></li>

	
	
<li><div class="info">
<h2>СМС</h2>
Время на сервере: <?php echo ((is_array($_tmp=$this->_tpl_vars['time'])) ? $this->_run_mod_handler('rusdate', true, $_tmp, 'd m y h i') : cDeep_modifier_rusdate($_tmp, 'd m y h i')); ?>
<br>
Время на компе: 
<?php echo '
<script>
	var date = new Date();
	var month="";
	var hour="";
	var minute="";

	switch(date.getMonth())
	{
		case 0:month="Января";
		  break;
		case 1:month="Февряля";
		  break;
		case 2:month="Марта";
		  break;
		case 3:month="Апреля";
		  break;
		case 4:month="Мая";
		  break;
		case 5:month="Июня";
		  break;
		case 6:month="Июля";
		  break;
		case 7:month="Авгста";
		  break;
		case 8:month="Сентября";
		  break;
		case 9:month="Октября";
		  break;
		case 10:month="Ноября";
		  break;
		case 11:month="Декабря";
		  break;
	};

	hour=date.getHours();
	minute=date.getMinutes();
	
	if(hour<10) hour="0"+hour;
	if(minute<10) minute="0"+minute;
	
	var t=date.getDate()+" "+month+" "+date.getFullYear()+" "+hour+":"+minute;
	document.write(t);
</script>
'; ?>

<br>
<p>Уведомлять меня по СМС о следующих событиях:</p>
<input type="checkbox" name="neworder" value="neworder" <?php if ($this->_tpl_vars['neworder']): ?>checked<?php endif; ?>>Новый заказ<br>
<input type="checkbox" name="newquestion" value="newquestion" <?php if ($this->_tpl_vars['newquestion']): ?>checked<?php endif; ?>>Новый вопрос<br>
<input type="checkbox" name="clientstatus" value="clientstatus" <?php if ($this->_tpl_vars['clientstatus']): ?>checked<?php endif; ?>>Уведомлять клиента о смене статуса заказа<br>
</div></li>





<li><div class="info">
<h2>zoom</h2>
	<p>Доступно на сервере:</p>
	<ul>
	<?php if ($this->_tpl_vars['magicwand']): ?><li>magicwand (используется по умолчанию)</li><?php endif; ?>
	<?php if ($this->_tpl_vars['gd2']): ?><li>gd2</li><?php endif; ?><br>
	</ul>
	<label class='desc' for='quality'>Качество сжатия</label>
	<input class="text full" type='text' id='quality'  name='quality' value='<?php echo $this->_tpl_vars['quality']; ?>
'>
</li>


	
<li class='buttons'><button class="positive" name='submit' value='Сохранить' type="submit"><img src="/img/icons/tick.png"/>Сохранить</button></li>
</ul>

</form>
</div>



</div>
