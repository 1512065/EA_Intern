<?php
	// view or download file uploaded
	
	// check file id
	if ($_GET['file']!= $_SESSION['id'])
	{
		echo 'Wrong file id';
	}
	else
	{
		$file = $_SESSION['target'];
		if ($_GET['mode']=='view')
		{	//view
			echo mime_content_type($file);
			header('Content-Type: '.mime_content_type($file));
			header('Content-Length: ' . filesize($file));
			echo file_get_contents("$file"); 
		} 
		else
		{
			//download
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		
		}
	}
?>