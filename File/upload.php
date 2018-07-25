<?php
	$id = $_SESSION['file_id'];
	//upload form
	echo '<form method="post" enctype="multipart/form-data">
	Attach:<br>
	<input type="file" name="'.$id.'">
	<br> <br>   
	<input type="submit" name="Submit" value="Submit">
	</form> ';
	
	//upload submit
	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		$target_dir = getcwd()."\\store\\";
		$target_file = $target_dir . basename($_FILES["$id"]['name']);
    
		if(file_exists($target_file))
		{
			echo "File exists";
		}
		else
		{
			if(move_uploaded_file($_FILES["$id"]["tmp_name"], $target_file))
			{
				echo '<br>Uploaded<br>';
				echo '<br>File ID: '.$id;
				// select mode
				$_SESSION['target'] = $target_file;
				echo '<br><br>Choose mode: -- ';			
				echo '<form method="get">
				<input type="hidden" name="file" value="'.$id.'">type:<br>
				<select name ="mode">
				<option value="view">View</option>
				<option value="download">Download</option>
				</select><br><br>
				<input type="submit">
				</form> ';			
			}  
			else 
			{
				echo '<br>Upload error';
			}
			// process get request
			if ($_SERVER['REQUEST_METHOD'] == "GET")
			{
				header ('Location: file_process.php');
			}	
		}
	}
?>