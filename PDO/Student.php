<?php
	class student {
		public $ID;
		public $FirstName;
		public $LastName;
		public $ClassNo;
		/*
		#function
		public function setAllAtt($iID,$iFirstName,$iLastName.$iClassNo)
		{
			$this->ID = $iID;
			$this->FirstName = $iFirstName;
			$this->LastName = $iLastName;
			$this->ClassNo = $iClassNo;
		}
		public function getFirstName()
		{
			return $this->FirstName;
		}
		public function getLastName()
		{
			return $this->LastName;
		}
		public function getClassNo()
		{
			return $this->ClassNo;
		}
		*/
		function showInfo()
		{
			echo '<tr>';
			echo '<td>'.$this->ID.'</td>';
			echo '<td>'.$this->FirstName.'</td>';
			echo '<td>'.$this->LastName.'</td>';
			echo '<td>'.$this->ClassNo.'</td>';
			echo '</tr>';
		}
	}
?>