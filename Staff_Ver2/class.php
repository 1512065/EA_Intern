<?php
require_once('db_connect.php');
abstract class Base
{
	// att
	private $ID;
	private $Created_datetime;
	private $Status;
	
	// get
	public function getID()
	{
		return $this->ID;
	}
	public function getCreated_datetime()
	{
		return $this->Created_datetime;
	}
	public function getStatus()
	{
		return $this->Status;
	}
	
	// set
	public function setID($iID)
	{
		$this->ID = $iID ;
	}
	public function setCreated_datetime($iCreated_datetime)
	{
		$this->Created_datetime = $iCreated_datetime;
	}
	public function setStatus($iStatus)
	{
		$this->Status = $iStatus;
	}
	
	// function
	abstract public function delete_row($id);
	abstract public function show();
//	abstract public function show_all();
//	abstract public function select_row($id);
}

class Dept extends Base
{
	//att
	private $Note;
	private $Name;
	//func
	public function show()
	{
		echo '<tr>';
		echo '<td>'.$this->ID.'</td>';
		echo '<td>'.$this->Name.'</td>';
		echo '<td>'.$this->Status.'</td>';
		echo '<td>'.$this->Note.'</td>';
		echo '<td>'.$this->Created_datetime.'</td>';
		echo '</tr>';
	}
	//set 
	public function setNote($iNote)
	{
		$this->Note = $iNote;
	}
	public function setName($iName)
	{
		$this->Name = $iName;
	}
	
	// get
	public function getNote()
	{
		return $this->Note;
	}
	public function getName()
	{
		return $this->Name;
	}
	public function delete_row($id)
	{
		GLOBAL $conn;
		try
		{
			$sql = "DELETE FROM department WHERE ID = ".$id;		
			$conn->exec($sql);
		//	echo "Deleted";
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}	
	}
	public function insert_row($id,$Name,$Status,$Note,$Created_datetime)
	{
		GLOBAL $conn;
		try
		{
			$sql = $conn->prepare("INSERT INTO department(ID,Name,Status,Note,Created_datetime) 
			values (?,?,?,?,?)");				
			$sql->execute(array($id,$Name,$Status,$Note,$Created_datetime));
		//	echo "Inserted";
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}
	}
}
class Staff extends Base
{
	//att
	private $First_name;
	private $Last_name;
	private $Dept_ID;
	private $Avatar;
	
	//func
	public function show()
	{
		echo '<tr>';
		echo '<td>'.$this->ID.'</td>';
		echo '<td>'.$this->First_name.'</td>';
		echo '<td>'.$this->Last_name.'</td>';
		echo '<td>'.$this->Dept_ID.'</td>';
		echo '<td>'.$this->Status.'</td>';
		echo '<td>'.$this->Avatar.'</td>';
		echo '<td>'.$this->Created_datetime.'</td>';
		echo '</tr>';
	}
	
	//set
	public function setFirst_name($iFirst_name)
	{
		$this->First_name = $iFirst_name ;
	}
	public function setLast_name($iLast_name)
	{
		$this->Last_name = $iLast_name;
	}
	public function setDept_ID($iDept_ID)
	{
		$this->Dept_ID = $iDept_ID;
	}
	public function setAvatar($iAvatar)
	{
		$this->Avatar = $iAvatar;
	}
	
	//get
	public function getFirst_name()
	{
		return $this->First_name;
	}
	public function getLast_name()
	{
		return $this->Last_name;
	}
	public function getDept_ID()
	{
		return $this->Dept_ID;
	}
	public function getAvatar()
	{
		return $this->Avatar;
	}
		public function delete_row($id)
	{
		GLOBAL $conn;
		try
		{
			$sql = "DELETE FROM staff WHERE ID = ".$id;		
			$conn->exec($sql);
		//	echo "Deleted";
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}	
	}
	public function insert_row($id,$First_name,$Last_name,$Dept_ID,$Status,$Avatar,$Created_datetime)
	{
		GLOBAL $conn;
		try
		{
			$sql = $conn->prepare("INSERT INTO staff(ID,First_name,Last_name,Dept_ID,Status,Avatar,Created_datetime) 
			values (?,?,?,?,?,?,?)");				
			$sql->execute(array($id,$First_name,$Last_name,$Dept_ID,$Status,$Avatar,$Created_datetime));
			echo "Inserted";
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}
	}
}
/*
class account 
{
	private $Username;
	private $Password;
	private $Staff_id;
	// get
	public function getUsername()
	{
		return $this->Username;
	}
	public function getPassword()
	{
		return $this->Password;
	}
	public function getStaff_id()
	{
		return $this->Staff_id;
	}
	
	// set
	public function setUsername($iUsername)
	{
		$this->Username = $iUsername;
	}
	public function setPassword($iPassword)
	{
		$this->Password = $iPassword;
	}
	public function setStaff_id($iStaff_id)
	{
		$this->Staff_id = $iStaff_id;
	}

}
*/
?>