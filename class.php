<?php
class Base {
	protected $ID;
	protected $Created_datetime;
	protected $Status;
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
		if (method_exists($this,$name))
		{
			return call_user_func_array(array($this, $name), $arguments);	
		}
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
	private $First_name;
	private $Last_name;
	private $Dept_ID;
	private $Avatar;
	
	protected function getID() {
		return 'get<br>';
	}

	protected function setID($id) {
		echo 'set<br>';
	}
}

$staff = new Staff();
$staff->setID(5);

echo $staff->getID();
$staff->setStatus('my status');
echo $staff->getStatus();
	
phpinfo();
?>
