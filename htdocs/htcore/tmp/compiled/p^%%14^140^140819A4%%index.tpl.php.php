<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 13:55:20
         template file:sadm/orders/index.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('function', 'loader', 'file:sadm/orders/index.tpl.php', 1, false),array('function', 'orders_admin', 'file:sadm/orders/index.tpl.php', 12, false),array('function', 'cycle', 'file:sadm/orders/index.tpl.php', 82, false),array('modifier', 'rusdate', 'file:sadm/orders/index.tpl.php', 87, false),)), $this); ?>	<?php echo cDeep_function_loader(array('src' => 'structure.css','type' => 'css','base' => '/css/admin/','comment' => 'Стили'), $this); echo cDeep_function_loader(array('src' => 'highslide.js','base' => '/js/highslide/','type' => 'js','comment' => 'Highslide'), $this); echo cDeep_function_loader(array('src' => 'highslide.css','base' => '/js/highslide/','type' => 'css'), $this); echo '
<script type="text/javascript">
	hs.graphicsDir = \'/js/highslide/graphics/\';
	hs.wrapperClassName = \'wide-border\';
</script>
'; ?>

<div id="container">
<div id="content" class="clearfix nosidebar">
<?php echo cDeep_function_orders_admin(array(), $this);?>
	

<?php if ($this->_tpl_vars['State']['Current_item']): ?>
	<a href='/sadm/orders/?p=<?php echo $this->_tpl_vars['current']; ?>
'>Все заказы</a>
	<div class="info">
<h2>Заказ:</h2>
</div>
<?php else: ?>
<div class="info">
<h2>Заказы:</h2>
</div>
		<?php if ($this->_tpl_vars['count'] > 1): ?>    
			<div class="pagination-clean">
					<ul>
						  <?php if ($this->_tpl_vars['last']): ?>
						  <li class="previous"><a href="<?php echo $this->_tpl_vars['link']; ?>
?uid=<?php echo $this->_tpl_vars['uid']; ?>
&p=<?php echo $this->_tpl_vars['last'];  echo $this->_tpl_vars['slink']; ?>
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
?uid=<?php echo $this->_tpl_vars['uid']; ?>
&p=<?php echo $this->_sections['p']['iteration'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
"><?php echo $this->_sections['p']['iteration']; ?>
</a></li>
							<?php endif; ?>
						  <?php endfor; endif; ?>
						  <?php if ($this->_tpl_vars['next']): ?>
						  <li class="next"><a href="<?php echo $this->_tpl_vars['link']; ?>
?uid=<?php echo $this->_tpl_vars['uid']; ?>
&p=<?php echo $this->_tpl_vars['next'];  echo $this->_tpl_vars['slink']; ?>
&orderby=<?php echo $this->_tpl_vars['orderby']; ?>
&desc=<?php echo $this->_tpl_vars['desc']; ?>
">Далее&nbsp;&raquo;</a></li>
						  <?php else: ?>
						  <li class="next-off">Далее&nbsp;&raquo;</li>
						  <?php endif; ?>
					</ul>
			  </div>
		<?php endif; ?>
	<?php endif; ?>

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
	
<form name=form method=post id=form>
<table class='mytable'>
<thead>
<tr>
<th><img src="/img/icons/cross.png"><th>№ <a href="?orderby=id&desc=desc">▼</a><a href="?orderby=id&desc=asc">▲</a>
<th>Имя <a href="?orderby=id&desc=desc">▼</a><a href="?orderby=id&desc=asc">▲</a>
<th>Телефон <a href="?orderby=Phone&desc=desc">▼</a><a href="?orderby=Phone&desc=asc">▲</a>
<th>Дата <a href="?orderby=time&desc=desc">▼</a><a href="?orderby=time&desc=asc">▲</a>
<th>email <a href="?orderby=Email&desc=desc">▼</a><a href="?orderby=Email&desc=asc">▲</a>
<th>Адрес <a href="?orderby=address&desc=desc">▼</a><a href="?orderby=address&desc=asc">▲</a>
<th>ед.
<th>Сумма <a href="?orderby=summ&desc=desc">▼</a><a href="?orderby=summ&desc=asc">▲</a>
<th>Оплачен <a href="?orderby=paid&desc=desc">▼</a><a href="?orderby=paid&desc=asc">▲</a>
<th>Статус
<?php if (! $this->_tpl_vars['State']['Current_item']): ?>
	<a href="?orderby=status&desc=desc">▼</a><a href="?orderby=status&desc=asc">▲</a>
	<th>Просмотреть заказ
<?php endif; ?>
</tr>
</thead>
<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
	<tr class="<?php echo cDeep_function_cycle(array('values' => ',alt','name' => 'color123'), $this);?>
">
		<td><input id='delete' type='checkbox' name='delete[<?php echo $this->_tpl_vars['order']['id']; ?>
]' value='1'></td>		<td><a href="/sadm/orders/<?php echo $this->_tpl_vars['order']['id']; ?>
/"><?php echo $this->_tpl_vars['order']['id']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['order']['Surname'];  echo $this->_tpl_vars['order']['Name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['order']['Phone']; ?>
</td>
		<td><nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['time'])) ? $this->_run_mod_handler('rusdate', true, $_tmp, 'd m y h i') : cDeep_modifier_rusdate($_tmp, 'd m y h i')); ?>
</nobr></td>
		<td><a href="mailto:<?php echo $this->_tpl_vars['order']['Email']; ?>
"><?php echo $this->_tpl_vars['order']['Email']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['order']['address']; ?>
</td>
		<td><?php echo $this->_tpl_vars['order']['amount']; ?>
</td>
		<td><?php echo $this->_tpl_vars['order']['summ']; ?>
 руб.</td>
		<td>
			<input type='hidden' name='paid[<?php echo $this->_tpl_vars['order']['id']; ?>
]' value='0'>
			<input id='paid' type='checkbox' name='paid[<?php echo $this->_tpl_vars['order']['id']; ?>
]' value='1' <?php if ($this->_tpl_vars['order']['paid']): ?>checked<?php endif; ?>>
		</td>
		<td><?php echo $this->_tpl_vars['order']['status2']; ?>

			<select name='status[<?php echo $this->_tpl_vars['order']['id']; ?>
]'>
			<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['status']):
?>
				<option value='<?php echo $this->_tpl_vars['status']['id']; ?>
' <?php if ($this->_tpl_vars['order']['status'] == $this->_tpl_vars['status']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['status']['status']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>

			</select>
		</td>
		<?php if (! $this->_tpl_vars['State']['Current_item']): ?><td><?php if (! $this->_tpl_vars['State']['Current_item']): ?><a href="/sadm/orders/<?php echo $this->_tpl_vars['order']['id']; ?>
/?p=<?php echo $this->_tpl_vars['current']; ?>
">Просмотреть заказ</a><?php endif; ?></td><?php endif; ?>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>



<?php if ($this->_tpl_vars['State']['Current_item']): ?>
	<h2>В заказ включены:</h2>
	<table class='mytable'>
	<thead>
	<tr><th>
	<img src="/img/icons/cross.png">
	<th>фото
	<th>Товар
	<th>Количество
	<th>Размер
	<th>Цена за ед.
	<th>Сумма
	</tr>
	</thead>
	<?php $_from = $this->_tpl_vars['orderitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['orderitem']):
?>
		<tr class="<?php echo cDeep_function_cycle(array('values' => ',alt','name' => 'color123'), $this);?>
">
			<td><input id='deleteitem' type='checkbox' name='deleteitem[<?php echo $this->_tpl_vars['orderitem']['id']; ?>
]' value='1'></td>
			<td>
			<?php if ($this->_tpl_vars['orderitem']['mprewiev']): ?>
						<a href="<?php echo $this->_tpl_vars['orderitem']['mprewiev']; ?>
" class="photo-gallery" onclick="return hs.expand(this)">
						<img  src="/zoom/50x50/<?php echo $this->_tpl_vars['orderitem']['mprewiev']; ?>
" title="<?php echo $this->_tpl_vars['orderitem']['mname']; ?>
" alt="<?php echo $this->_tpl_vars['orderitem']['mname']; ?>
" />
						<?php else: ?>
						<img  src="/zoom/50x50/images/nophoto.gif" title="<?php echo $this->_tpl_vars['orderitem']['mname']; ?>
" alt="<?php echo $this->_tpl_vars['orderitem']['mname']; ?>
" />
						<?php endif; ?>
			</td>
			
			
			<td><a target='_blank' href="/sadm/catalog/property[<?php echo $this->_tpl_vars['orderitem']['productid']; ?>
].xml"><?php echo $this->_tpl_vars['orderitem']['mname']; ?>
</a></td>
			<td><?php echo $this->_tpl_vars['orderitem']['amount']; ?>
</td>
			<td>
						<?php if ($this->_tpl_vars['orderitem']['count_values']): ?>
							<?php $_from = $this->_tpl_vars['orderitem']['count_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['size'] => $this->_tpl_vars['count']):
?>
							<?php echo $this->_tpl_vars['size']; ?>
 - <?php echo $this->_tpl_vars['count']; ?>
 шт.<br>
							<?php endforeach; endif; unset($_from); ?>
							<?php else: ?>
							<?php echo $this->_tpl_vars['orderitem']['size']; ?>

						<?php endif; ?>
			</td>
			<td><?php echo $this->_tpl_vars['orderitem']['mprice']; ?>
 руб.</td>
			<td><?php echo $this->_tpl_vars['orderitem']['amount']*$this->_tpl_vars['orderitem']['mprice']; ?>
 руб.</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr><td colspan=6 style="text-align:right;"><b>Итого:</b></td><td ><b><?php echo $this->_tpl_vars['orderitemssumm']; ?>
</b> руб.</td>
	</tr>
	</table>
<?php endif; ?>


<div class="buttons">
<a href="#" onclick="confirmDelete()">
<img  src='/img/icons/positive.png' >
Сохранить
</a>
</div>
 </form>

</div>
</div>