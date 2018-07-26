<?php
	
	class Uploader
	{
		public $file_id;
		public $target_file;
		public $target_dir;
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
			echo'
			<form method="post" enctype="multipart/form-data">
			Choose file:<br>
			<input type="file" name="'.$this->file_id.'">
			<br> <br>   
			<input type="submit" name="Submit" value="Upload">
			</form>';
		}
		public function rename_file($id)
		{
			$file_id = $id;
			$this->target_dir ="..\\store\\";
			$file_name = basename($_FILES["$file_id"]['name']);			
			$target_file = $this->target_dir.$file_name;
			$extension = pathinfo($_FILES["$file_id"]['name'], PATHINFO_EXTENSION);
			$filename = pathinfo($_FILES["$file_id"]['name'], PATHINFO_FILENAME);
    		$count = 0;
			while (file_exists($target_file))
			{
				//rename_file
				$count++;
				$new_name = $filename.'('.$count.')'.'.'.$extension;
				$target_file = $this->target_dir.$new_name;				 
			}
			if ($count != 0)
			{
				$filename = $new_name;
			}
			else
			{
				$filename = $file_name;
			}
			$_SESSION['file'] = $target_file;
			$newid = '';
			$length = strlen($filename);
			for ($i=0; $i<$length; $i++) 
			{
				$c = $filename["$i"];
				$newid .= sprintf("%03s", ord("$c"));
			}
			
	
			$_SESSION['id'] = $newid;
			$this->file_id = $newid;
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
				$this->rename_file($file_id);
				$this->store_in_server($file_id);
				
				header('Location: ./');
				exit();
			 }
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
		public function decode($id)
		{
			$file_name = '';
			foreach (str_split($id, 3) as $number) {
				$file_name .= chr($number);
			}
			return $file_name;
		}
}

?>