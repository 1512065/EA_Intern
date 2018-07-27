<?php
	
	class Uploader
	{
		public $file_id;
		public $target_file;
		public $target_dir;
		public $file_info = array();
		public function generate_id()
		{
			$char= '0123456789';
			$id = '';
			for ($i = 0; $i < 14; $i++) 
			{
				$id .= $char[mt_rand(0, strlen($char) - 1)];
			}
			$this->file_id = $id;
		}
		public function show_form()
		{
?>
	<form method="post" enctype="multipart/form-data">
			Choose file:<br>
			<input type="file" name="'.$this->file_id.'">
			<br> <br>   
			<input type="submit" name="Submit" value="Upload">
			</form> 
<?php		}
		public function rename($id)
		{
			$file_id = $id;
			$this->target_dir ="..\\store\\";
			$file_name = basename($_FILES["$file_id"]['name']);
			$target_file = $this->target_dir.$file_name;
    		$count = 0;
			while (file_exists($target_file))
			{
				//rename
				$count++;
				$new_name = $count.'_'.$file_name;
				$target_file = $this->target_dir.$new_name;				 
			}
			if ($count != 0)
			{
				$file_name = $new_name;
			}
			//echo 'File name in server: '.$file_name;
			$_SESSION['file'] = $target_file;
			$_SESSION['id'] = $this->getID();
			$this->target_file = $target_file;
		}
		public function store_in_server($id)
		{
			$file_id = $id;
			if(move_uploaded_file($_FILES["$file_id"]["tmp_name"], $this->target_file))
			{
				$_SESSION["res"]='Uploaded';
				
			}
			else
			{
				$_SESSION["res"]='Error';
			}
		}
		public function getID()
		{
			return $this->file_id;
		}
		public function upload()
		{
			
			 if (isset($_POST['Submit']))
			 {
			 	$file_id = '';
				foreach ($_FILES as $id => $info)
				{
					$file_id = $id;
					
				}			
				$this->rename($file_id);
				$this->store_in_server($file_id);
				
				header('Location: http://helloworld.php-projects.local/');
				exit();
			 }
		}
		
		public function getTarget_dir()
		{
			return $this->target_dir;
		}
	}

class File_Process
{
	public function view($file)
	{
		header('Content-Type: '.mime_content_type($file));
		header('Content-Length: ' . filesize($file));
		echo file_get_contents("$file");  
	}
	public function download($file)
	{
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