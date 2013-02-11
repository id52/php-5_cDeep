<h2>Оплатить заказ</h2>
<p>К оплате: <b style="font-size:18px;">{$orders.0.out_summ}</b>&nbsp;руб.</p>
<p><img src="/images/root/pay/Visa.gif" width="52" height="35" title="Пластиковой картой Виза">&nbsp;
<img src="/images/root/pay/Mastercard.gif" width="52" height="35" title="Пластиковой картой Мастеркард">&nbsp;
<img src="/images/root/pay/YandexMoney.gif" width="52" height="35" title="Яндекс-деньги">&nbsp;
<img src="/images/root/pay/Webmoney_ru.png" width="88" height="31" title="Вебмани">&nbsp;
<img src="/images/root/pay/VTB24.gif" width="52" height="35" title="Через банкомат ВТБ24: наличными, картой или телебанк">&nbsp;
<img src="/images/root/pay/AlfaBank.gif" width="52" height="35" title="Выставление счета в интернет-банк Альфа банка">&nbsp;
<img src="/images/root/pay/Euroset.gif" width="52" height="35" title="В салонах Евросеть">&nbsp;
<img src="/images/root/pay/Svyaznoy.gif" width="52" height="35" title="В салонах Связной">&nbsp;
<img src="/images/root/pay/MoneyMail.gif" width="52" height="35" title="MoneyMail">&nbsp;
<img src="/images/root/pay/RBKMoney.gif" width="52" height="35" title="RBK Money">&nbsp;
<img src="/images/root/pay/TerminalsQiwi.gif" width="52" height="35" title="Через теримрал Киви">&nbsp;
<img src="/images/root/pay/TerminalsElecsnet.gif" width="52" height="35" title="Через термирал Элекснет">&nbsp;
</p>
<p>После нажатия кнопки "Оплатить", вы будете перенаправлены на сайт платежной системы, где сможете выбрать наиболее удобный для вас способ оплаты.</p>
<form action='https://merchant.roboxchange.com/Index.aspx' method=POST target="_blank">
<input type=hidden name=MrchLogin value="{$mrh_login}">
<input type=hidden name=OutSum value="{$orders.0.out_summ}">
<input type=hidden name=InvId value="{$orders.0.id}">
<input type=hidden name=Desc value="{$inv_desc}">
<input type=hidden name=SignatureValue value="$orders.0.crc">
<input type=hidden name=Shp_item value="{$shp_item}">
<input type=hidden name=IncCurrLabel value="{$in_curr}">
<input type=hidden name=Culture value="{$culture}">
<input type=submit value='Оплатить' style="font-size:18px;">
</form>
<br>