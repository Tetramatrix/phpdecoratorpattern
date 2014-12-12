<?php
/*
*      Copyright (c) 2014 Chi Hoang 
*      All rights reserved
*
*/

namespace Vehicle;

class AddEngine extends AbstractDecorator {

    const COMPONENT_CLASS = 'Engine'; 
    
    public function start($value=null)
    {
	return $this->hasEngine().parent::start("Start engine. ").($this->drive==1 ?  "Drive." : "Stop.");
    }

    public function stop($value=null)
    {
	return $this->hasEngine().parent::stop("Stop engine. ").($this->drive==1 ?  "Drive." : "Stop.");
    }
    
    public function hasEngine()
    {
	return "Has engine. ";
    }
    
    public function travel($component)
    {
	$this->engine=$this;
	$component->value = $this->hasWheels($component->value);        
	parent::travel($component);    
    }
}

class AddWheels extends AbstractDecorator {

    const COMPONENT_CLASS = 'Wheels';   
  
    public function travel($component)
    {
        $component->value="Has $this->wheels wheels. ".$component->value;    
        parent::travel($component);    
    }
}


abstract class AbstractDecorator {
    
    private $component;
    const COMPONENT_CLASS = false;
  
    public function __construct($component,$value=null)
    {    
        $this->component=$component;
        $type=constant(get_class($this) . '::COMPONENT_CLASS');
	$this->$type=$value;
        return;
    }
  
    public function __call($name, $arguments) 
    {
        if (method_exists($this->component, strtolower($name)))
        {
	    return call_user_func_array(array($this->component, strtolower($name)), $arguments);
	} 
    }
    
    public function __get($name)
    {
        return $this->component->$name;
    }
   
    public function __set($name, $value)
    {
        $name=strtolower($name);
        $this->component->$name = $value;
    }
   
    public function __isset($name)
    {
        return isset($this->component->$name);
    }
    
    public function start($value=null)
    {
	$this->drive=true;
	return $value;
    }
    
    public function stop($value=null)
    {
	$this->drive=false;
	return $value;
    }
      
    public function hasWheels($value)
    {
	if (empty($this->wheels))
	{
	    $value="Has no wheels. ";
	}
	return $value;    
    }
}

class Subject {
    
    public $execute;
    public $value;
    
    public function __construct($execute="Pick")
    {
        $this->execute=$execute;
    }    
    
    public function noEngine()
    {
	return "Has no engine. ".($this->drive==1 ?  "Drive." : "Stop.");
    }
    
    public function start($obj)
    {
	$obj->drive=true;
	return $this->noEngine();
    }
    
    public function stop($obj)
    {
	$obj->drive=false;
	return $this->noEngine();
    }
    
    public function __toString()
    {
	if ($this->value)
	{
	    $_string=$this->value;    
	} else 
	{
	    $_string=$this->execute;
	}
        return $_string;
    }
}


class Vehicle  {

    public $vehicle;
    private $component;
    
    public function __construct($vehicle) 
    {
        $this->vehicle=$vehicle;
    }
    
    public function __call($name, $arguments) 
    {
        if (method_exists($this->engine, strtolower($name)))
        {
	    return call_user_func_array(array($this->engine, strtolower($name)), $arguments);
	} else if (method_exists($this->component, strtolower($name))) 
	{
	    return call_user_func_array(array($this->component, strtolower($name)), $arguments);
	}
    }
    
    public function pick($arguments)
    {
	return $arguments.$this->hasEngine($this).chr(0xA);
    }
    
    public function drive($arguments)
    {
	return "Commencing travel. ".$arguments.$this->start($this).chr(0xA);
    }
    
    public function Arrived($arguments)
    {
	if ($this->drive)
	{
	    return "Arrived. ".$arguments.$this->stop($this).chr(0xA);
	   
	} else if (empty($this->drive))
	{
	    return $arguments.$this->stop().chr(0xA);
	}  
    }
    
    public function travel($component)
    {
	$this->component=$component;
        $component->value=$this->{$component->execute}("Pick ".$this->vehicle.". ".$component);
        echo $component->value;
    }
}
?>