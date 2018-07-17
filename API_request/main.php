<?php

$url = 'http://opraws-dev.e-koukuuken.com/s/common/v1/booking.php';
$data = array(
    'ID' => 'his.airtrip.jp',
    'service' => 'HIS',
	'uid' => 'his.airtrip.jp',
	'upw' => 'VvTs8bEQ',
	'transaction_code' => '894d79308ed7f41cad47ddb6e1b812171b44fffd5c8c61d4ace5a6d683722291'
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
//$result = file_get_contents($url, false, $context);

 $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

        $response = curl_exec($ch);
        if(!$response) {
            echo 'unsuccess';
        }
		
var_dump($response);


?>
