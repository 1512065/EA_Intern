<?php
class Base {
	protected $Status=5;
	
	static $count = 10;

	public function setStatus($stt)
	{
		$this->Status = $stt;
	}
	public function getStatusPL()
	{
		echo $this->Status;
	}
	protected function getStatusPT()
	{
		echo $this->Status;
	}
	private function getStatusPV()
	{
		echo $this->Status;
	}
	protected function getCountself()
	{
		echo self::$count;
	}
	protected function getCountstatic()
	{
		echo static::$count;
	}
}
class Staff extends Base 
{
	static $count =100;
	public function getStatus()
	{
	//	$this->getStatusPL(); //5
	//	$this->getStatusPT(); //5
		$this->getStatusPV(); // Call to private method Base::getStatusPV() from context 'Staff'
	}
	public function getCount()
	{
		$this->getCountself(); //10
//		$this->getCountstatic(); //100
	}
}
	$demo = new Staff();
//	$demo->getStatus();
	$demo->getCount();
?>
