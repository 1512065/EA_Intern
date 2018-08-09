<?php
 ini_set('soap.wsdl_cache_enabled', 0);
 ini_set('soap.wsdl_cache_ttl', 900);
 ini_set('default_socket_timeout', 15);
 
 
 $params = array('zipCode'=>'70105');
 
 
 $wsdl = 'http://www.tracmedia.com/lol/LOLService.asmx?wsdl';
 
 $options = array(
     'style'=>SOAP_RPC,
     'use'=>SOAP_ENCODED,
     'soap_version'=>SOAP_1_1,
     'cache_wsdl'=>WSDL_CACHE_NONE,
     'connection_timeout'=>15,
     'trace'=>true,
     'encoding'=>'UTF-8',
     'exceptions'=>true,
   );
 try {
   $soap = new SoapClient($wsdl, $options);
   $data = $soap->CooksCountry($params);
 }
 catch(Exception $e) {
   die($e->getMessage());
 }
   
 var_dump($data);
 die;
?>