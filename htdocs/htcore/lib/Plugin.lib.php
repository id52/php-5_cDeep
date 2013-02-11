<?php
interface Plugin
{
  public function __construct($cDeep, $isadm=false);
  public function Info();
  public function Security($event=null);
  public function Controller($method, $params);  
}
