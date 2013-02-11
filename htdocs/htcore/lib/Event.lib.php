<?
interface Event
{
	public function __construct(&$cDeep);
	public function Info();
	public function Security($event=null);
	public function onEvent($event, $args);
	
}
?>