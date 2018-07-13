<?php
class Base {
	public function  __isset($property)
	{
		return isset($this->$property);
	}
	public function __get($property)
	{
		return $this->$property;
	}
	public function __set($property,$value)
	{
		$this->$property = $value;
	}
	public function __call($name, $arguments) {
		//set
        if (strpos($name, 'set') !== false) {
            $attribute = substr($name, 3);
		//	echo $attribute;
           if (property_exists($this, $attribute)) {
                $this->$attribute = $arguments[0];
           }	
        }
		//get
		if (strpos($name, 'get') !== false) {
            $attribute = substr($name, 3);
           if (property_exists($this, $attribute)) {
                return $this->$attribute;
           }	
        }
    }
}
class Staff extends Base 
{
	protected $ID;
	protected $Name;
}
	
	$staff = new Staff();
	$staff->setID(10);
//	echo $staff->ID;
	$a = $staff->getID();
	echo $a;
	
	echo '<br>';
	$staff->setName('staff name');
	echo $staff->getName();
?>
