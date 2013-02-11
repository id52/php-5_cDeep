<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:19
         template file:sadm/clients/clients.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/clients/clients.tpl.php', 1, false),array('function', 'users', 'file:sadm/clients/clients.tpl.php', 2, false),array('function', 'cycle', 'file:sadm/clients/clients.tpl.php', 60, false),)), $this); ?><?php echo cDeep_function_loader(array('src' => 'structure.css','type' => 'css','base' => '/css/admin/','comment' => 'Стили'), $this); echo cDeep_function_users(array(), $this);?>

<script>
<?php echo '	
function confirmDelete() {
    if (confirm("Сохранить?")) {
	        document.form.submit();
	    } else {
	        
	    }
	}	
'; ?>

</script>	


<div id="container">
<div id="content" class="clearfix nosidebar">

<div class="info">
<h2>Клиенты:</h2>
</div>
		<?php if ($this->_tpl_vars['count'] > 1): ?>    
			<div class="pagination-clean">
					<ul>
						  <?php if ($this->_tpl_vars['last']): ?>
						  <li class="previous"><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_tpl_vars['last'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
">&laquo;&nbsp;Назад</a></li>
						  <?php else: ?>
						  <li class="previous-off">&laquo;&nbsp;Назад</li>
						  <?php endif; ?>
						  <?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
							<?php if ($this->_sections['p']['iteration'] == $this->_tpl_vars['current']): ?>
							<li class="active"><?php echo $this->_sections['p']['iteration']; ?>
</li>
							<?php else: ?>
							<li><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_sections['p']['iteration'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
"><?php echo $this->_sections['p']['iteration']; ?>
</a></li>
							<?php endif; ?>
						  <?php endfor; endif; ?>
						  <?php if ($this->_tpl_vars['next']): ?>
						  <li class="next"><a href="<?php echo $this->_tpl_vars['link']; ?>
?p=<?php echo $this->_tpl_vars['next'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
">Далее&nbsp;&raquo;</a></li>
						  <?php else: ?>
						  <li class="next-off">Далее&nbsp;&raquo;</li>
						  <?php endif; ?>
					</ul>
			  </div>
		<?php endif; ?>

<form method='post' name='form' id='form'>
<table class='mytable'>
<thead>
<th><img src="/img/icons/cross.png">
<th>№<a href="?orderby=UID&desc=desc">▼</a><a href="?orderby=UID&desc=asc">▲</a>
<th>Логин<a href="?orderby=Login&desc=desc">▼</a><a href="?orderby=Login&desc=asc">▲</a>
<th>ФИО<a href="?orderby=Name&desc=desc">▼</a><a href="?orderby=Name&desc=asc">▲</a>
<th>Телефон<a href="?orderby=Phone&desc=desc">▼</a><a href="?orderby=Phone&desc=asc">▲</a>
<th>Email<a href="?orderby=Email&desc=desc">▼</a><a href="?orderby=Email&desc=asc">▲</a>
<th>Адрес<a href="?orderby=address&desc=desc">▼</a><a href="?orderby=address&desc=asc">▲</a>
<th>Дата регистрации<a href="?orderby=regtime&desc=desc">▼</a><a href="?orderby=regtime&desc=asc">▲</a>
<th>Посл. вход<a href="?orderby=authtime&desc=desc">▼</a><a href="?orderby=authtime&desc=asc">▲</a>
</thead>
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
<tr  class="<?php echo cDeep_function_cycle(array('values' => ',alt','name' => 'color123'), $this);?>
">
<td><input id='deleteuser' type='checkbox' name='deleteuser[<?php echo $this->_tpl_vars['user']['UID']; ?>
]' value='1'></td>
<td><?php echo $this->_tpl_vars['user']['UID']; ?>
</td>
<td><a href="/sadm/orders/?uid=<?php echo $this->_tpl_vars['user']['UID']; ?>
"><?php echo $this->_tpl_vars['user']['Login']; ?>
</a></td>
<td><a href="/sadm/orders/?uid=<?php echo $this->_tpl_vars['user']['UID']; ?>
"><?php echo $this->_tpl_vars['user']['Name']; ?>
</a></td>
<td><?php echo $this->_tpl_vars['user']['Phone']; ?>
</td>
<td><a href="mailto:<?php echo $this->_tpl_vars['user']['Email']; ?>
"><?php echo $this->_tpl_vars['user']['Email']; ?>
</a></td>
<td><?php echo $this->_tpl_vars['user']['address']; ?>
</td>
<td><?php echo $this->_tpl_vars['user']['regtime']; ?>
</td>
<td><?php echo $this->_tpl_vars['user']['authtime']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>



<div class="buttons">
<a href="#" onclick="confirmDelete()">
<img  src='/img/icons/cross.png' >
удалить выбранных
</a>
</div>



</form>
</div>
</div>