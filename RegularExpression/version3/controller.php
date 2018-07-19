<?php
	// get $type value
	function getDatatype($subject, $type)
	{
		$pattern ="/(?<=\'$type\'\s=>\s)[^(,)]*/";
		if(preg_match_all($pattern, $subject, $result))
		{
			$result1 = $result[0];
			return $result1;
		}
		else
			return array('null');
		
	}
	//get Time value
	function getTime($subject)
	{
		$pattern ='/(?<=\[)\d{4}(?:.+)(?=\])/';
		if(preg_match_all($pattern, $subject, $result))
		{
			$result1 = $result[0];
			return $result1;
		}	
	}
	// get all record from 1 logfile
	function getDayRecord($file_dir)
	{
		$day_rec = array();
		$handle = fopen("$file_dir", 'r');
		$logfile = fread($handle,filesize("$file_dir"));

		$record_arr = preg_split('/\n\n/',$logfile);
	
		foreach ($record_arr as $num => $record)
		{
			$sgl_rec = array();
			//time
			$time = getTime($record)[0];
			$format = 'Y-m-d H:i:s';
			$date = DateTime::createFromFormat($format, $time);
			//echo gettype($date);
			$sgl_rec['time'] = $date;
			// other property
			$prop_arr = array('type','id','site_id','email','member_seq','status','info','result');
			foreach ($prop_arr as $prop)
			{
				$value = getDatatype($record,$prop)[0];
				$sgl_rec["$prop"] = $value;
			}
			array_push($day_rec,$sgl_rec);
		}
		return $day_rec;
	}
	// get log file in folder
	function getLogFile($directory)
	{
		$filename = scandir($directory);
		$logfile_arr = array();
		$filepattern = '/^[0-9]{4}\-(0[0-9]|1[0-2])\-(3[0-1]|2[0-9]|1[0-9]|0[1-9]).log$/';
		foreach ($filename as $file)
		{
			if (preg_match($filepattern, $file))
			{
				array_push($logfile_arr,$file);
			}
		}
		return $logfile_arr;
	}
	
	$type_arr = array('BC','BM','PC','TM');
	$site_id_arr = array('1073','1075');
	// show static
	function Statistic($directory, $day, $catory)
	{
		$stat_arr = array(); // result
		echo '<pre>';
		$file_dir = $directory.'\\'.$day.'.log';
		$data = getDayRecord($file_dir);
		switch ($catory)
		{
			case 'all':
				return $data;
			case 'type':		
				foreach ($data as $record)
				{
					GLOBAL $type_arr;
					foreach ($type_arr as $type)
					{
						$text = "'".$type."'";
						switch ($record['type'])
						{
							case ($text):
									if (isset($stat_arr["$type"])) {
										$stat_arr["$type"] = $stat_arr["$type"] +1;			
									} else {
										$stat_arr["$type"]=1;
									}
						}
					}				
				}
				return $stat_arr;			
			case 'site_id':
				foreach ($data as $record)
				{
					GLOBAL $site_id_arr;
					foreach ($site_id_arr as $site_id)
					{
						$text = "'".$site_id."'";
						switch ($record['site_id'])
					{
						case ($text):
							if (isset($stat_arr["$site_id"])) {
								$stat_arr["$site_id"] = $stat_arr["$site_id"] +1;
							} else {
								$stat_arr["$site_id"] = 1;
							}
					}
					}				
				}
				return $stat_arr;
			case 'result':
				$stat_arr = array('total'=>0,'success'=>0);
				$stat_arr['total'] = count($data);
				foreach ($data as $record)
				{
					if ($record['result']!='\'null\'')
						$stat_arr['success']++;
				}
				return $stat_arr;
			
		}	
	}
	// optional statistic
	function Statistic_Opt($directory, $day, $type, $site_id, $result_arr)
	{
		$stat_arr = array(); // result
		$file_dir = $directory.'\\'.$day.'.log';
		$data = getDayRecord($file_dir);
	//	print_r ($data);
	$count =0;
		foreach ($data as $record)
		{
			$count ++;
			//echo 'a';
			$flag = 0; //flag = 1 => count++
			//check type
			foreach ($type as $sgl_type)
			{
				$text = "'".$sgl_type."'";
				if ($record['type']==$text)
				{
					$flag = 1;
					break;
				}
				$flag = 0;
			}
			//check site_id
			if ($flag==1)
			{
			foreach ($site_id as $sgl_site_id)
			{
				$text = "'".$sgl_site_id."'";
				if ($record['site_id']==$text)
				{
					$flag = 1;
					break;
				}
				$flag = 0;
			}
			}
			if ($flag==1)
			{
				if (count($result_arr)<2)
				{
					if ($result_arr[0]== 'unsuccess')
					{
						if ($record['result']!='\'null\'')
						{	
							$flag = 0;
						}
					} else
					{
						if ($record['result']=='\'null\'')
						{	
							$flag = 0;
						}
					}
				}
			}
			if ($flag==1)
				array_push($stat_arr, $record);
		}	
		return	$stat_arr;	
	}

?>