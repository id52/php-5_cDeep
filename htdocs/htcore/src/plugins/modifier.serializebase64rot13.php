<?php
function cDeep_modifier_serializebase64rot13($string)
{
  return str_rot13(base64_encode(serialize($string)));
}
