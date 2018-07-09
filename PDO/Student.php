<?php
	class student {
		public $ID;
		public $FirstName;
		public $LastName;
		public $ClassNo;
		
		//function
		/*function setAllAtt($iID,$iFirstName,$iLastName.$iClassNo)
		{
			$this->ID = $iID;
			$this->FirstName = $iFirstName;
			$this->LastName = $iLastName;
			$this->ClassNo = $iClassNo;
		}
		function getFirstName()
		{
			return $this->FirstName;
		}
		function getLastName()
		{
			return $this->LastName;
		}
		function getClassNo()
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