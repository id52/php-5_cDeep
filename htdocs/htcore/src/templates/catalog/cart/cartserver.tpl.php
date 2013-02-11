<!--div id="ctip" name="ctip" class="none"></div-->
		<div class="topbin">
			<p class="title"><a href="/catalog/cart/" style="color: #D2280F;">Ваша корзина</a></p>
			Товаров <b><span id="numcart">{$cDeep.session.catalog.num|default:0}</span></b>&nbsp;шт.<br>
			На сумму: <b><span id="summ">{if !$cDeep.session.catalog.summ}0{else}{$cDeep.session.catalog.summ}{/if}</span></b>&nbsp;руб.<br>
			<a href="/catalog/cart/"><b>Оформить заказ</b></a>
			<div id="ctip" name="ctip" class="none" style="display: none;">0</div>
		</div><!-- /topbin -->
		
		