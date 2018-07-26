<?php
	session_start();
	ob_start();
	require_once('class.php');
	
	$upfile = new Uploader();
	$upfile->generate_id();
	$upfile->show_form();
	if (isset($_SESSION['res']))
	{
		echo $_SESSION['id'].' - ';
		echo $_SESSION["res"];
	}
	
	if (isset($_POST['Submit']))
	{
		$upfile->upload();	
	}
	if (isset($_SESSION['id']))
	{
		$id = $_SESSION['id'];
		echo '<br><br>Choose mode: -- ';			
		echo '<form method="get">
		<input type="hidden" name="file" value="'.$id.'">type:<br>
		<select name ="mode">
		<option value="view">View</option>
		<option value="download">Download</option>
		</select><br><br>
		<input type="submit">
		</form> ';				
	
		if (isset($_GET['mode']))
		{
			ob_end_clean();
			$file = new File_Process();
			$file_dir = $_SESSION['file'];
			if ($_GET['mode']=='view')
			{
				header("content-type: none");
				$file->view($file_dir);
			}
			else
			{
				$file->download($file_dir);
			}
		}		
	}
//	print_r ($_SESSION);
	
				
	
?>