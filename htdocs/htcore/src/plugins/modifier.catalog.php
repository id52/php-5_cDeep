<?php
function cDeep_modifier_catalog($id)
{
      global $cDeep;
      $tQuery = 'SELECT `mname` FROM `t_menu` WHERE `mid`=?d';
      return $cDeep->obj['DB']->selectCell($tQuery, $id);
}
?>
