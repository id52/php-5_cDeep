<script>

window.parent.showtip('{section loop=$Items name="i"}<strong>{$Items[i].mname|truncate:30|replace:"'":""}</strong><div align="right">{$Items[i].mprice}&nbsp;</div>{/section}');

window.parent.addcart({$cDeep.session.catalog.num}, '{section loop=$Items name="i"}{$Items[i].mname|truncate:60|replace:"'":""}{/section}','{section loop=$Items name="i"}{$Items[i].mprice}{/section}',{$cDeep.session.catalog.summ});

</script>