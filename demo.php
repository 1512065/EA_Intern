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
	checkCard($card1);
	checkCard($card2);
	checkCard($card3);
	
	// Check password min 8 char, include: 1 CAP, 1 normal, 1 number, no special char
	
	function checkPassword($subject)
	{
		$pattern = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
		// special letter: (?=\S*[\W])
		echo $subject;
		if(preg_match($pattern, $subject))
		{		
			echo ' correct form <br>';	
		}
		else
		{
			echo ' uncorrect form <br>';
		}
	}
	$pass1='abcDe123j';
	$pass2='aDe13j';
	$pass3='abcde123j';
	$pass4='ab$DeTTTj';
	$pass5='1241241245';
	checkPassword($pass1);
	checkPassword($pass2);
	checkPassword($pass3);
	checkPassword($pass4);
	checkPassword($pass5);
	
	// Check date format dd/mm/yyyy
	function checkDateFormat($subject)
	{
		$pattern = '/^(3[0-1]|2[0-9]|1[0-9]|0[1-9])\\/(0[0-9]|1[0-2])\\/([0-9]{4})$/';
		echo $subject;
		if (preg_match($pattern, $subject, $matches))
		{		
			echo ' correct form <br>';	
		}
		else
		{
			echo ' uncorrect form <br>';
		}
	}
	
	$date1 = '12/12/2015';
	$date2 = '20/20/1999';
	$date3 = '32/01/2018';
	checkDateFormat($date1);
	checkDateFormat($date2);
	checkDateFormat($date3);
	
	// check User format: 6-12 char, begin with alpha-char + no special char 
	function checkUser($subject)
	{
		$pattern = '/./';
		echo $subject;
		if (preg_match($pattern, $subject, $matches))
		{		
			echo ' correct form <br>';	
		}
		else
		{
			echo ' uncorrect form <br>';
		}
	}
	$user1='Duyen123';
	$user2='Du@yen123';
	$user3='4uyen123';
	
	checkUser($user1);
	checkUser($user2);
	checkUser($user3);
?>