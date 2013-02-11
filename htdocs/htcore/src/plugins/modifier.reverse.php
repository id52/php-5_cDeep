<?php
function cDeep_modifier_reverse($string, $delimeter = '/')
{
  $arr = explode($delimeter,$string);
  $arr = array_reverse($arr);
  return implode($delimeter, $arr);
}
?>
