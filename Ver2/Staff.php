<?php
	class room {
		public $ID;
		public $Name;
		public $Phone;
		public $RoomID;
		public $Join_date;
		#function
		function __construct($iID,$iName,$Phone,$RoomID,$Join_date)
		{
			$this->ID = $iID;
			$this->Name = $iName;
			$this->Phone = $Phone;
			$this->RoomID = $RoomID;
			this->Join_date = $Join_date;
		}
		function UpdateName($iName)
		{
			$this->Name = $iName;
		}
		function UpdatePhone($iPhone)
		{
			$this->Phone = $iPhone;
		}
		function UpdateRoomID($iRoomID)
		{
			$this->RoomID = $iRoomID;
		}
		function UpdateJoinDate($iJoin_date)
		{
			$this->Join_date = $iJoin_date;
		}
		function getName()
		{
			return $this->Name;
		}
		function getPhone()
		{
			return $this->Phone;
		}
		function getRoomID()
		{
			return $this->RoomID;
		}
		function getJoinDate()
		{
			return $this->Join_date;
		}
	}
?>