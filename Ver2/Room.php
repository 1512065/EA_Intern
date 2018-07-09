<?php
	class room {
		public $ID;
		public $Name;
		public $RoomNum;
		public $Branch;
		#function
		function __construct($iID,$iName,$iRoomNum.$iBranch)
		{
			$this->ID = $iID;
			$this->Name = $iName;
			$this->RoomNum = $iRoomNum;
			$this ->Branch = $iBranch;
		}
		function UpdateName($iName)
		{
			$this->Name = $iName;
		}
		function UpdateRoomNum($iRoomNum)
		{
			$this->RoomNum = $iRoomNum;
		}
		function UpdateBranch($iBranch)
		{
			$this->Branch = $iBranch;
		}
		function getName()
		{
			return $this->Name;
		}
		function getRoomNum()
		{
			return $this->RoomNum;
		}
		function getBranch()
		{
			return $this->Branch;
		}
	}
?>