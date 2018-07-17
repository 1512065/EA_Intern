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
		echo '<form method="post"><table>
		
		<tr>
		<th>ID</th>
		<th>Service</th> 
		<th>uid</th>
		<th>upw</th>
		<th>transaction_code</th>
		</tr>
		<tr>
		<td> <input type="text" name="ID" value = "his.airtrip.jp"></td>
		<td><input type="text" name="service" value="HIS"></td> 
		<td><input type="text" name="uid" value = "his.airtrip.jp"></td>
		<td><input type="text" name="upw" value ="VvTs8bEQ"></td>
		<td><input type="text" name="transaction_code" value = "894d79308ed7f41cad47ddb6e1b812171b44fffd5c8c61d4ace5a6d683722291"></td>
		</tr>		
		<button type="submit" name="submit"> SUBMIT </button>
		</table></form>';
		
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
			
			$this->payload = array('xml'=>$value);
		}
	}
	public function sendRequest()
	{
		$this->request = curl_init($this->link);
		curl_setopt($this->request, CURLOPT_POST, true);
		curl_setopt($this->request, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
		curl_setopt($this->request, CURLOPT_POSTFIELDS, $this->payload);
		curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
		$this->respone = curl_exec($this->request);
	}
	public function showRespone()
	{	
		curl_close($this->request);
	//	echo $this->respone;
		$array = json_decode(json_encode((array)simplexml_load_string($this->respone)),true);
		echo '<br> RESPONSE: <br><br>';
		foreach($array as $key => $value)
		{
			print_r ($key);
			echo ' => ';
			print_r($value);
			echo '<br>';
		}
		
	}
}
// main
$req = new Request();
$req->createForm();
if(isset($_POST['submit']))
{
	$req -> createPayload();
	$req -> sendRequest();
	$req -> showRespone();
}
?>

