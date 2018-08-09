<?php
class Soap_Request
{
    // convert array to xml string
    public function arr_to_xmlstr($arr, &$xml_str)
    {
        foreach ($arr as $key => $value)
        {
            if (is_array($value))
            {
                $xml_str.='<'.$key.'>';
                $this->arr_to_xmlstr($value, $xml_str);
                if (strpos($key,' '))
                {
                    $key = strstr($key, ' ', true);
                }
                $xml_str.='</'. $key .'>';
            }
            else 
            {
                $xml_str.= '<'. $key .'>'.$value.'</';
                $xml_str.= $key .'>';        
            }
        }
    }
    // send request
    public function send_quote_request($Signon, $InsuranceSvcRq)
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 900);
        ini_set('default_socket_timeout',30);
        $url = "http://btsws.atuat.acegroup.com/CRS_ACORD_WS/ACORDService.asmx?wsdl";
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
        
        $params = array('Signon' => $Signon, 'InsuranceSvcRq' =>$InsuranceSvcRq);
        echo '<pre>';
        print_r ($params);
        try {
          $soap = new SoapClient($url);
          var_dump($soap->__getFunctions());
          $data = $soap->GetTravelQuoteResponse($soap->GetTravelQuote($params));
        }
        catch(Exception $e) {
          die($e->getMessage());
        }
          
        return($data);

    }
    // create some array
    public function create_Signon_xml()
    {
        $CustId = array('SPName' => 'com.evolableasia', 
                        'CustLoginId' => 'evolableasiaflight_jp.svc');
        $CustPswd = array ('EncryptionTypeCd' => 'None', 
                           'Pswd' => '$craMBLeD@123!');
        $SingnonPswd = array ('CustId' => $CustId, 
                              'CustPswd' => $CustPswd);
        $ClientDt = date('Y-m-d\TH:i:s', time());
        $ClientApp = array ('Org' => 'com.evolableasia', 
                            'Name' => 'evolableasia Flight', 
                            'Version' => '1.0');
        $SignonRq_val = array ( 'SignonPswd' => $SingnonPswd, 
                                'ClientDt' => $ClientDt, 
                                'CustLangPref' => 'JA', 
                                'ClientApp' => $ClientApp);
        //create data array
        $SignonRq = array('SignonRq' => $SignonRq_val);   
        return $SignonRq;
    }
    public function create_InsuranceSvcRq($info_arr, $pass_info)
    {
        $date = date('Y-m-d\TH:i:s', time());
        $ContractTem = array('EffectiveDt' => $info_arr['start_day'],
                             'ExpirationDt' => $info_arr['end_day']);
        $acegroup_Destination = array ('RqUID' => '833B107A-9DC7-4D52-841D-6074884DCF50', 
                                        'DestinationDesc' => 'Domestic');
        $acegroup_InsuredPackage = array ('RqUID' => '851CFFF2-ED6E-4835-A7FD-9D0D0019C474', 
                                          'InsuredPackageDesc' => 'Individual');
        $acegroup_Plan = array ('RqUID' => '531CC7DB-2D16-4A2B-A59A-5E357AD22797', 
                                'PlanDesc' => 'CD1');
        $acegroup_DataExtensions = array('DataItem key="Total_Insured" type="System.Integer"' => array('value' => $info_arr['number']), 
                                         'DataItem key="Purpose" type="System.String"' => array('value' => $info_arr['number']));
        if (is_array($pass_info)) //policy
        {
            $GeneralPartyInfo = array();
            $Communications = array('PhoneInfo' => array('PhoneTypeCd' => 'Telephone', 
                                                        'PhoneNumber' => $info_arr['phone']), 
                                    'EmailInfo' => array('EmailAddr' => $info_arr['email']));
            foreach ($pass_info as $index => $person)
            {
                $GeneralPartyInfo['NameInfo id="'.$index.'"'] = $person;
            }
            $GeneralPartyInfo['Communications'] = $Communications;
            $InsuredOrPrincipal = array('GeneralPartyInfo' => $GeneralPartyInfo);
            
            $PersPkgPolicyAddRq = array('TransactionRequestDt' => $date, 
                                    'InsuredOrPrincipal' => $InsuredOrPrincipal, 
                                    'PersPolicy' => array('CompanyProductCd'=> 'C7363B08-0761-4A16-8804-A02B001A8DA1', 
                                    'ContractTerm' => $ContractTem,
                                    'com.acegroup_Destination' => $acegroup_Destination, 
                                    'com.acegroup_InsuredPackage' => $acegroup_InsuredPackage, 
                                    'com.acegroup_Plan' => $acegroup_Plan),
                                    'com.acegroup_DataExtensions' => $acegroup_DataExtensions);
            $InsuranceSvcRq_val = array('PersPkgPolicyAddRq' => $PersPkgPolicyAddRq);
            $InsuranceSvcRq = array('InsuranceSvcRq' => $InsuranceSvcRq_val);    
        } 
        else //quote
        {
            $PersPkgPolicyQuoteInqRq = array('TransactionRequestDt' => $date, 
                                        'PersPolicy' => array('CompanyProductCd'=> 'C7363B08-0761-4A16-8804-A02B001A8DA1', 
                                        'ContractTerm' => $ContractTem,
                                        'com.acegroup_Destination' => $acegroup_Destination, 
                                        'com.acegroup_InsuredPackage' => $acegroup_InsuredPackage, 
                                        'com.acegroup_Plan' => $acegroup_Plan),
                                        'com.acegroup_DataExtensions' => $acegroup_DataExtensions);
            $InsuranceSvcRq_val = array('PersPkgPolicyQuoteInqRq' => $PersPkgPolicyQuoteInqRq);
            $InsuranceSvcRq = array('InsuranceSvcRq' => $InsuranceSvcRq_val);
        }
       
        return $InsuranceSvcRq;
        
    }
    // get quote
    public function get_Quote($info_arr)
    {
        //<SignonRq>
        $SignonRq_xml = $this->create_Signon_xml();
        //<InsuranceSvcRq>
        $InsuranceSvcRq_xml = $this->create_InsuranceSvcRq($info_arr,'quote');
        //build soap body
        $soap_request = '<?xml version="1.0" encoding="utf-8"?>
                        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                        <soap:B';
        //save to file
        file_put_contents("quote_request.xml", $soap_request);
        //build soap headers
        $headers = array("Content-type: text/xml;charset=UTF-8",
                        "SOAPAction: \"http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/ACORDService/GetTravelQuote\"", 
                        "Content-length: ".strlen($soap_request),); 
        // send request
        $output = $this->send_quote_request($SignonRq_xml, $InsuranceSvcRq_xml);
        var_dump($output);
        //save to file
        file_put_contents("quote_response.xml", $output);
        echo '<br><br>Response saved to file quote_response.xml<br>';
        /*
        $xmlparser = xml_parser_create();
        xml_parse_into_struct($xmlparser,$output,$values);
        xml_parser_free($xmlparser);
        echo '<pre>';
        print_r($values);
        
        echo '<br><br>Detail:<br><pre lang="xml"';
        $xmlparser = xml_parser_create(); 
        $xmldata = $output;     
        xml_parse_into_struct($xmlparser,$xmldata,$values);
        xml_parser_free($xmlparser);
        print_r ($values);
        echo '</pre>';
        */
    }
    // get Policy
    public function get_Policy($info_arr, $pass_info)
    {
        //<SignonRq>
        $SignonRq_xml = $this->create_Signon_xml();
        //<InsuranceSvcRq>   
        $InsuranceSvcRq_xml = $this->create_InsuranceSvcRq_xml($info_arr, $pass_info);
        //build soap body
        $soap_request = '<?xml version="1.0" encoding="utf-8"?> 
                        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"> 
                        <soap:Body> <GetTravelPolicy xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/"> 
                        <ACORD xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD_PolicyReq">'.$SignonRq_xml.$InsuranceSvcRq_xml.'
                        </ACORD>
                        </GetTravelPolicy>
                        </soap:Body>
                        </soap:Envelope>';
        
        file_put_contents("policy_request.xml", $soap_request);
        
        //build soap headers
        $headers = array("Content-type: text/xml;charset=UTF-8",
                        "SOAPAction: \"http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/ACORDService/GetTravelPolicy\"", 
                        "Content-length: ".strlen($soap_request),); 
        // send request
        $output = $this->send_request($headers, $soap_request);
        var_dump($output);
        file_put_contents("policy_response.xml", $output);
        echo '<br><br> Response saved to file policy_response.xml<br>';
    }
}
