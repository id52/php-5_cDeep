<!--div id="ctip" name="ctip" class="none"></div-->
<div class="toptop">
	<div class="toptopIn">
<div class="bin{if $cDeep.session.catalog.num > 0} ok{/if}">
			Товаров в корзине: <span id="numcart">{$cDeep.session.catalog.num|default:0}</span> шт.
		</div>
		<div class="sum{if $cDeep.session.catalog.summ > 0} ok{/if}">
			На сумму: <span id="summ">{if !$cDeep.session.catalog.summ}0{else}{$cDeep.session.catalog.summ}{/if}</span> р.
		</div>
		<p class="submitorder"><a href="/catalog/cart/">ОФОРМИТЬ ЗАКАЗ</a></p>
<div id="ctip" name="ctip" class="none" style="display: none;">0</div>
</div>
</div>

	
		