<?php
class Request
{
	private $link='http://opraws-dev.e-koukuuken.com/s/common/v1/booking.php';
	private $method='POST';
	private $payload;
	private $request;
	private $response;
	public function createForm()
	{
		echo '<form method="post">
		ID: <input type="text" name="ID" value = "his.airtrip.jp"><br><br>
		Service: <input type="text" name="service" value="HIS"><br><br>
		uid: <input type="text" name="uid" value = "his.airtrip.jp"><br><br>
		upw: <input type="text" name="upw" value ="VvTs8bEQ"><br><br>
		transaction_code: <input type="text" name="transaction_code" value = "894d79308ed7f41cad47ddb6e1b812171b44fffd5c8c61d4ace5a6d683722291"><br><br>
		<button type="submit" name="submit"> SUBMIT </button>
		</form>';
	}
	public function createPayload()
	{
		if(isset($_POST['submit']))
		{
			$value = '<?xml version="1.0" encoding="UTF-8"?>
			<data>
			<ID>'.$_POST['ID'].'</ID>
			<service>'.$_POST['service'].'</service>
			<uid>'.$_POST['uid'].'</uid>
			<upw>'.$_POST['upw'].'</upw>
			<transaction_code>'.$_POST['transaction_code'].'</transaction_code>
			</data>';
			$this->payload = $value;
			//$this->payload = array('key'=>'xml(string)', 'value'=>$value);
		}
	}
	public function sendRequest()
	{
		$this->request = curl_init($this->link);
		curl_setopt($this->request, CURLOPT_POST, true);
		curl_setopt($this->request, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		curl_setopt($this->request, CURLOPT_POSTFIELDS, $this->payload);
		curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
		$this->respone = curl_exec($this->request);
	}
	public function showRespone()
	{
		
		$info = curl_getinfo($this->request);
	//	print_r($info);
		curl_close($this->request);
		echo $this->respone;

	}
}
// main
$req = new Request();
$req->createForm();
if(isset($_POST['submit']))
{
	$req->createPayload();
$req->sendRequest();
echo '<br><br>';
$req->showRespone();
}
?>
<?php
/*
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
        'header'  => "Content-type: application/xml",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);


var_dump($result);
*/
?>
