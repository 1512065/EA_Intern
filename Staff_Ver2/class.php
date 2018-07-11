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
}

class Department extends Base
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
			$conn= null;
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}
	}
	public function select_all()
	{
		GLOBAL $conn;
		$sql ="SELECT * from department";
		$res = $conn->query($sql);
		echo '<table><table border=1>
			<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Status</th>
			<th>Note</th>
			<th>Created_datetime</th></tr>';
		foreach ($res->fetchALL(PDO::FETCH_CLASS,'Department') as $r)
		{
			$r->show();
		}
		echo '</table>';
	}
	public function show_update_mode()
	{
		echo '<form method="post"><tr>
			<td><input type="int" name="ID" value='.$this->ID.'></td>
			<td><input type="text" name="Name" value='.$this->Name.'></td>
			<td><input type="int" name="Status" value='.$this->Status.'></td>
			<td><input type="text" name="Note" value='.$this->Note.'></td>
			<td><input type="date" name="Created_datetime" value='.$this->Created_datetime.'></td>
			<td><input type="submit" name="update" value="UPDATE"></td>
			<td><input type="submit" name="delete" value="DELETE"></td></tr></form>';
		
	}
	public function show_all()
	{
		GLOBAL $conn;
		$sql ="SELECT * from department";
		$res = $conn->query($sql);
		echo '<table border=1>
			<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Status</th>
			<th>Note</th>
			<th>Created_datetime</th>
			<th>Update</th>
			<th>Delete</th>
			</tr>';
		foreach ($res->fetchALL(PDO::FETCH_CLASS,'Department') as $r)
		{
			$r->show_update_mode();
		}
		echo '</table>';
	}
	public function update_row($id,$Name,$Status,$Note,$Created_datetime)
	{
		GLOBAL $conn;
		try
		{
			$sql = $conn->prepare("UPDATE department SET Name=?, Status=?, Note=?, Created_datetime=? WHERE ID=?");				
			$sql->execute(array($Name,$Status,$Note,$Created_datetime,$id));
		//	echo "Inserted";
			$conn= null;
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
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}
	}
	public function select_all()
	{
		GLOBAL $conn;
		$sql ="SELECT * from staff";
		$res = $conn->query($sql);
		echo '<table><table border=1>
			<tr>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Department ID</th>
			<th>Status</th>
			<th>Avatar</th>
			<th>Created_datetime</th></tr>';
		foreach ($res->fetchALL(PDO::FETCH_CLASS,'Staff') as $r)
		{
			$r->show();
		}
		echo '</table>';
	}
	public function show_update_mode()
	{
		echo '<form method="post"><tr>
			<td><input type="int" name="ID" value='.$this->ID.'></td>
			<td><input type="text" name="First_name" value='.$this->First_name.'></td>
			<td><input type="text" name="Last_name" value='.$this->Last_name.'></td>
			<td><input type="int" name="Dept_ID" value='.$this->Dept_ID.'></td>
			<td><input type="int" name="Status" value='.$this->Status.'></td>
			<td><input type="text" name="Avatar" value='.$this->Avatar.'></td>
			<td><input type="date" name="Created_datetime" value='.$this->Created_datetime.'></td>
			<td><input type="submit" name="update" value="UPDATE"></td>
			<td><input type="submit" name="delete" value="DELETE"></td></tr></form>';		
	}
	public function show_all()
	{
		GLOBAL $conn;
		$sql ="SELECT * from staff";
		$res = $conn->query($sql);
		echo '<table border=1>
			<tr>
			<th>ID</th>
			<th>First_name</th>
			<th>Last_name</th>
			<th>Dept_ID</th>
			<th>Status</th>
			<th>Avatar</th>
			<th>Created_datetime</th>
			<th>Update</th>
			<th>Delete</th>
			</tr>';
		foreach ($res->fetchALL(PDO::FETCH_CLASS,'staff') as $r)
		{
			$r->show_update_mode();
		}
		echo '</table>';
	}
	public function update_row($id,$First_name,$Last_name,$Dept_ID,$Status,$Avatar,$Created_datetime)
	{
		GLOBAL $conn;
		try
		{	
			// get old department
			$sql = "SELECT Dept_ID FROM staff WHERE ID =".$id;
			$res = $conn->query($sql);
			$res2 = $res->fetch();
			$old_dept = $res2['Dept_ID'];
			if ($old_dept != $Dept_ID) // save in history
			{
			date_default_timezone_set("Asia/Bangkok");
			$stamp = date("Y-m-d H:i:s");
			$sql = $conn->prepare("INSERT INTO history(Staff_ID,Old_dept,New_dept,Time_stamp) values (?,?,?,?)");
			$sql->execute(array($id,$old_dept,$Dept_ID,$stamp));
			}
			// update new
			$sql = $conn->prepare("UPDATE staff SET First_name=?, Last_name=?,Dept_ID=?, Status=?, Avatar=?, Created_datetime=? WHERE ID=?");				
			$sql->execute(array($First_name,$Last_name,$Dept_ID,$Status,$Avatar,$Created_datetime,$id));
			
		}
		catch (PDOException $e)
		{
			echo $sql."<br>".$e->getMessage();
		}
	}
}

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

?>