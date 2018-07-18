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
	// show static
	function Statistic($directory, $day, $catory)
	{
		echo '<pre>';
		$file_dir = $directory.'//'.$day.'.log';
		$data = getDayRecord($file_dir);
		switch ($catory)
		{
			case 'all':
				return $data;
			case 'type':
				$stat_arr = array('BC'=>0,'BM'=>0,'PC'=>0,'TM'=>0);
				foreach ($data as $record)
				{
					$type_arr = array('BC','BM','PC','TM');
					foreach ($type_arr as $type)
					{
						$text = "'".$type."'";
						switch ($record['type'])
						{
							case ($text):
								$stat_arr["$type"] = $stat_arr["$type"] +1;
						}
					}				
				}
				return $stat_arr;			
			case 'site_id':
				$stat_arr = array('1073'=>0,'1075'=>0);
				foreach ($data as $record)
				{
					$site_id_arr = array('1073','1075');
					foreach ($site_id_arr as $site_id)
					{
						$text = "'".$site_id."'";
						switch ($record['site_id'])
					{
						case ($text):
							$stat_arr["$site_id"] = $stat_arr["$site_id"] +1;
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
?>