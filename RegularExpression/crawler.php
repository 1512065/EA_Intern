<?php
//	$html = file_get_contents('https://skyticket.com/');
//	$str = htmlspecialchars($html);
	$str = 'header id="header" class="header">
	<div class="header_top">
		<div class="header_wrap">
			<div class="header_top_inner">
				<a href="/" class="logo"><img src="/img/logo.png" alt="skyticket - Cheap Air Tickets/Domestic Flights/International Flights"></a>
				<div id="top" class="header_metaText">
				<a href="/" class="logo"><img src="/im124124t - Cheap Air Tickets/Domestic Flights/International Flights"></a>
					<h1>Compare Cheap Flights & Airfare Deals - Skyticket</h1>';
					
	$pattern ='/img\s+[^>]*/';
	if (preg_match_all($pattern, $str, $matches))
	{		
		echo '<pre>';
		print_r ($matches);
		echo 'pre';
	}
	
?>