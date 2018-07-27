<?php
 
 $soap_request = '<?xml version="1.0" encoding="utf-8"?>
 <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
   <soap:Body>
     <CooksCountry xmlns="http://tracmedia.org/">
       <zipCode>70105</zipCode>
     </CooksCountry>
   </soap:Body>
 </soap:Envelope>';
  
 $headers = array(
      "Content-type: text/xml;charset=UTF-8",
      "SOAPAction: \"http://tracmedia.org/CooksCountry\"", 
      "Content-length: ".strlen($soap_request),
                     ); 
 $url = "http://www.tracmedia.com/lol/LOLService.asmx";
 $ch = curl_init($url);
    
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  curl_setopt($ch, CURLOPT_TIMEOUT,10);
  
  $output = curl_exec($ch);
  
 curl_close($ch);
  
 //var_dump($output);
 echo '<pre lang="xml"';
 //echo( "$output"); 


$xmlparser = xml_parser_create();


$xmldata = $output;

xml_parse_into_struct($xmlparser,$xmldata,$values);

xml_parser_free($xmlparser);
print_r($values);
   
?>