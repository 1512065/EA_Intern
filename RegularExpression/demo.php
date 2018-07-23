<?php

	// Check format phone card: xxxx-xxxx-xxxx-xxxx (x: number)
	function checkCard($subject)
	{
		$pattern = '/^(\d{4}-\d{4}-\d{4}-\d{4})$/';
		echo $subject;
		if(preg_match_all($pattern, $subject))
		{		
			echo ' correct form <br>';	
		}
		else
		{
			echo ' uncorrect form <br>';
		}
	}
	
	$card1 = '1234-4561-0123-9999';
	$card2 = '1234-4561-h123-9999';
	$card3 = '1234-4561-0123-999';
//	checkCard($card1);
//	checkCard($card2);
//	checkCard($card3);
	
	// check password min 8 char, include: 1 cap, 1 normal, 1 number, no special char
	function checkPassword($subject)
	{
		$pattern = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
		// special letter: (?=\S*[\W])
		echo $subject;
		if(preg_match($pattern, $subject,$matches))
		{		
			echo ' correct form <br>';	
			print_r ($matches);
		}
		else
		{
			echo ' uncorrect form <br>';
		}
	}
	$pass1='abcDe123j';
	$pass2='aDe13FSj';
	$pass3='abcde123j';
	$pass4='ab$DeTTTj';
	$pass5='1241241245';
//	checkPassword($pass1);
//	checkPassword($pass2);
//	checkPassword($pass3);
//	checkPassword($pass4);
//	checkPassword($pass5);
	
	// Check date format dd/mm/yyyy
	function checkDateFormat($subject)
	{
		$pattern = '/^(3[0-1]|2[0-9]|1[0-9]|0[1-9])\\/(0[0-9]|1[0-2])\\/([0-9]{4})$/';
		echo $subject;
		if (preg_match($pattern, $subject, $matches))
		{		
			echo ' correct form <br>';	
			print_r ($matches);
		}
		else
		{
			echo ' uncorrect form <br>';
		}
	}
	
	$date1 = '12/12/2015';
	$date2 = '20/10/1999';
	$date3 = '32/01/2018';
//	checkDateFormat($date1);
//	checkDateFormat($date2);
//	checkDateFormat($date3);
	
	// get data inside html tag
	// Ex:
	/*<formaction="main" method="post">
		Username: <input type="text" name="iusername"><br><br>
		Password: <input type="password" name="ipassword"><br><br>
		<button type="submit">LOG IN</button>
	</form>
	*/
	function getTag($subject, $tag)
	{
		$pattern ='/<'.$tag.'(.|\n|\s)*?<\/'.$tag.'>/';
		if (preg_match($pattern, $subject, $matches))
		{		
			echo ' correct form <br>';	
			print_r ($matches);
		}	
	}
	
	
	ini_set("pcre.recursion_limit", "524");
	$handle = fopen("filehtml.txt", 'r');
	$htmlfile = fread($handle,filesize("filehtml.txt"));
	$html = htmlspecialchars($htmlfile);
	getTag($html,'table');
	
	$s = '<form> demo absc <aa> <bb> </aa>dfasf4a5 65
	</form>';
	$t = 'form';
	//getTag($s,$t);
	
	// REPLACE DEMO -----------------------------------
	$partern = '/(<h1>)|(<\/h1>)/';
	// or $partern = '/(<\/?h1>)/';
	$subject = '<h1>demo demo</h1>';
	$replacement = '';
	//	echo preg_replace($partern, $replacement, $subject);
	echo '<br>';
	//------------------------------------
	// get afer http://helloworld.php-projects.local/
	
	//Solution 1: replacement
	$pattern = '/http:\/\/helloworld\.php\-projects\.local\//';
	$subject = 'http://helloworld.php-projects.local/HelloWorld/RegularExpression/demo.php';
	$replacement = '';
//	echo preg_replace($pattern, $replacement, $subject);
	
	//Solution 2:
	echo'<br>';
	$pattern = '/(?<=http:\/\/helloworld\.php\-projects\.local).*/';
//	if (preg_match_all($pattern, $subject, $matches))
//		{		
//			print_r ($matches);
//		}

	//-----------------------------------
	// get all image URL
	$html = file_get_contents('https://techtalk.vn/design-pattterns-he-thong-23-mau-design-patterns.html');
	$str = htmlspecialchars($html);
	
//	$pattern ='/(?<=img\ssrc)[^(" )]*/';
/*	if (preg_match_all($pattern, $str, $matches))
	{		
		echo '<pre>';
		print_r ($matches);
		echo '</pre>';
	}
*/	
	
	
	
	
	$str='<ul><li ABC hello word></li><li>12345</li><li>67</li></ul><ul><li>22222</li></ul>';
	$pattern ='/<ul>.*?<\/ul>/';
//	$pattern ='/<li[^>]*>/';
	if (preg_match_all($pattern, $str, $matches))
	{		
		echo '<pre>';
		print_r ($matches);
		echo '</pre>';
	}
	
	
?>