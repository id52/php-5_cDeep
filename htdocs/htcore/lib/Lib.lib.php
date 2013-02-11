<?php
abstract class Lib
{
  public static function Instance($cDeep, $args=null){
  	trigger_error('::Instance mus be redeclured!', E_USER_ERROR);
  }
  public function __construct(&$cDeep){}
  public function Info(){}
}
