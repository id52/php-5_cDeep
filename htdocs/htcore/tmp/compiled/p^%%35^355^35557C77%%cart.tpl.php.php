<?php /* cDeep-3.1.1 (2.6.16), generated on 2013-01-31 12:44:44
         template file:catalog/cart.tpl.php */ ?>
<?php require_once(cDeep_CORE_DIR . 'core.load_plugins.php');
cDeep_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'file:catalog/cart.tpl.php', 5, false),)), $this); ?><!--div id="ctip" name="ctip" class="none"></div-->
<div class="toptop">
	<div class="toptopIn">
<div class="bin<?php if ($_SESSION['catalog']['num'] > 0): ?> ok<?php endif; ?>">
			Товаров в корзине: <span id="numcart"><?php echo ((is_array($_tmp=@$_SESSION['catalog']['num'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : cDeep_modifier_default($_tmp, 0)); ?>
</span> шт.
		</div>
		<div class="sum<?php if ($_SESSION['catalog']['summ'] > 0): ?> ok<?php endif; ?>">
			На сумму: <span id="summ"><?php if (! $_SESSION['catalog']['summ']): ?>0<?php else:  echo $_SESSION['catalog']['summ'];  endif; ?></span> р.
		</div>
		<p class="submitorder"><a href="/catalog/cart/">ОФОРМИТЬ ЗАКАЗ</a></p>
<div id="ctip" name="ctip" class="none" style="display: none;">0</div>
</div>
</div>

	
		