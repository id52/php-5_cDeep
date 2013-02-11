<?
class Dispatcher
{
  private $events  = array();
  private $classes = array();
  public $returns = array();

  /* если есть в реквесте вызов то аттачим его и выполняем */
  function __construct(&$cDeep)
  {
  	#$this->cDeep =& $cDeep; // а-я-яй!
  	
    # &event[ModName]=Method&ModName[Method]=EventData
    if(is_array(Globals::REQUEST('event')))
    {
      $r = Globals::REQUEST('event');
      while (list($module,$event)=each($r)) 
      {
      	# event[News][]=add&News[add][Title]=Заголовок&event[News][]=remove&News[remove][id]=5
      	# event[News]=add&News[add][Title]=Заголовок
      	$event = is_array($event)?$event:array($event);
      	while (list(,$e)=each($event)) {
	      	$this->addEvent($module, $e, $cDeep);
	       	$this->onEvent($module, $e, $cDeep);
      	}
      }
    }
  }
  private function addEvent($module, $event, $cDeep)
  {
  	$r = Globals::REQUEST($module);
    $this->events[$module][$event] = $r[$event];
    return true;
  }
  
  private function onEvent($module, $event, $cDeep)
  {
    if (class_exists($module, true) && !is_object($this->classes[$module]))
    {
      $this->classes[$module] = new $module($cDeep);
    }
    if (is_object($this->classes[$module]) && method_exists($this->classes[$module], 'Security') && $this->classes[$module]->Security(strtoupper($event))==true) 
    {
      $args = $this->events[$module][$event];
      $this->returns[$module][$event] = $this->classes[$module]->onEvent(strtoupper($event), $args, $cDeep);
    }
    else 
    {
      $this->returns[$module][$event] = 'E_ERROR';
    }
  }
}

?>