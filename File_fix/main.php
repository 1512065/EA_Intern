<?php
	session_start();
	require_once('class.php');
	if (isset($_GET['mode']))
		{
			$file = new File_Process();
			//decode
			$filename = $file->decode($_GET['file']);
			$file_dir = "..\\store\\".$filename;
			if ($_GET['mode']=='view')
			{
				$file->view($file_dir);
			}
			else
			{
				$file->download($file_dir);
			}
		}
	
	$upfile = new Uploader();
	$upfile->generate_id();
	$upfile->show_form();
	if (isset($_SESSION['res']))
	{
		echo 'File ID: '.$_SESSION['id'].' - ';
		echo $_SESSION["res"];
		
	}
	
	if (isset($_POST['Submit']))
	{
		$upfile->upload();	
	}
	if (isset($_SESSION['id']))
	{
		$id = $_SESSION['id'];			
		echo '<br><br>
			<form method="get">
			ID: <input type="text" name="file"><br>
			<br>Choose mode: <br>
			<select name ="mode">
			<option value="view">View</option>
			<option value="download">Download</option>
			</select><br><br>
			<input type="submit">
			</form>';				
			
	}

				
	
?>