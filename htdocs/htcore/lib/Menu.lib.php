<?
class Menu implements Event
{
	function __construct(&$cDeep)
	{
		$this->cDeep = &$cDeep;
	}

	function Info()
	{
		return array(
		'Version'=>'1.0',
		'Name'=>'Menu Module',
		);
	}

	function Security($event=null)
	{
		return true;
	}

	function onEvent($event, $args)
	{
		switch ($event)
		{
			case "Sort":
				Debug::display(get_class(), $args);
				$tQuery = 'UPDATE t_page_property SET `order`=?d WHERE id=?d';
				while (list($order, $pageid)=each($args)) {
					if($pageid) $this->cDeep->obj['DB']->query($tQuery, $order, $pageid);
				}
				break;
		}
	}
	/****************************************************************************************/
}
?>