{include file='file:catalog/jscripts.tpl.php'}

{if $current_item=="send"}
  {s_catalog action="sendcart" mmid=0}
{elseif $current_item=="flush"}
  {*php}
    $_SESSION["catalog"] = array();
  {/php*}
  <h2>Очищено.</h2>
{else}
  {s_catalog action="cart2" mmid=0}
{/if}

