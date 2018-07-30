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
                $xml_str.='</'. $key .'>';
            }
            else 
            {
                $xml_str.= '<'. $key .'>'.$value.'</'.$key .'>';
            }
        }
    }
    // send request
    public function send_request($headers,$payload)
    {
        $url = "http://btsws.atuat.acegroup.com/CRS_ACORD_WS/ACORDService.asmx";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    // create some array
    public function create_Signon_xml()
    {
        $CustId = array('SPName' => 'com.evolableasia', 'CustLoginId' => 'evolableasiaflight_jp.svc');
        $CustPswd = array('EncryptionTypeCd' => 'None', 'Pswd' => '$craMBLeD@123!');
        $SingnonPswd = array ('CustId' => $CustId, 'CustPswd' => $CustPswd);
        $ClientDt = date('Y-m-d\TH:i:s', time());
        $ClientApp = array('Org' => 'com.evolableasia', 'Name' => 'evolableasia Flight', 'Version' => '1.0');
        $SignonRq_val = array('SignonPswd' => $SingnonPswd, 'ClientDt' => $ClientDt, 'CustLangPref' => 'JA', 'ClientApp' => $ClientApp);
        //create data array
        $SignonRq = array('SignonRq' => $SignonRq_val);
        $SignonRq_xml ='';
        $this->arr_to_xmlstr($SignonRq, $SignonRq_xml);
        return $SignonRq_xml;
    }
    public function create_InsuranceSvcRq_xml($info_arr, $pass_info)
    {
        $date = date('Y-m-d\TH:i:s', time());
        $ContractTem = array('EffectiveDt' => $info_arr['start_day'], 'ExpirationDt' => $info_arr['end_day']);
        $acegroup_Destination = array('RqUID' => '833B107A-9DC7-4D52-841D-6074884DCF50', 'DestinationDesc' => 'Domestic');
        $acegroup_InsuredPackage = array ('RqUID' => '851CFFF2-ED6E-4835-A7FD-9D0D0019C474', 'InsuredPackageDesc' => 'Individual');
        $acegroup_Plan = array ('RqUID' => '531CC7DB-2D16-4A2B-A59A-5E357AD22797', 'PlanDesc' => 'CD1');
        $PersPkgPolicyQuoteInqRq = array('TransactionRequestDt' => $date, 'PersPolicy' => array('CompanyProductCd'=> 'C7363B08-0761-4A16-8804-A02B001A8DA1', 'ContractTerm' => $ContractTem,
            'com.acegroup_Destination' => $acegroup_Destination, 'com.acegroup_InsuredPackage' => $acegroup_InsuredPackage, 'com.acegroup_Plan' => $acegroup_Plan));
            $InsuranceSvcRq_val = array('PersPkgPolicyQuoteInqRq' => $PersPkgPolicyQuoteInqRq);
        if ($pass_info !=='quote')
        {
            // add InsuranceSvcRq
            $NameInfo = array('PersonName' => array('GivenName' => $pass_info['name'], 'TitlePrefix' => $pass_info['title']),'BirthDt' => $pass_info['dob'], 'Gender' => $pass_info['gender']);
            $Communications = array('PhoneInfo' => array('PhoneTypeCd' => 'Telephone', 'PhoneNumber' => $pass_info['phone']), 'EmailInfo' => array('EmailAddr' => $pass_info['mail']));
            $InsuredOrPrincipal = array('GeneralPartyInfo' => array('NameInfo'=> $NameInfo, 'Communications' => $Communications));
            array_push($PersPkgPolicyQuoteInqRq, $InsuredOrPrincipal);
        }
        $InsuranceSvcRq = array('InsuranceSvcRq' => $InsuranceSvcRq_val);
        $InsuranceSvcRq_xml ='';
        $this->arr_to_xmlstr($InsuranceSvcRq, $InsuranceSvcRq_xml);
        return $InsuranceSvcRq_xml;
        
    }
    // get quote
    public function get_Quote($info_arr)
    {
        //<SignonRq>
        $SignonRq_xml = $this->create_Signon_xml();
        //<InsuranceSvcRq>
        $InsuranceSvcRq_xml = $this->create_InsuranceSvcRq_xml($info_arr,'quote');
        //build soap body
        $soap_request = '<?xml version="1.0" encoding="utf-8"?>
                        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                        <soap:Body>
                        <GetTravelQuote xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/">
                        <ACORD xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD_QuoteReq">'.$SignonRq_xml.$InsuranceSvcRq_xml.'
                        </ACORD>
                        </GetTravelQuote>
                        </soap:Body>
                        </soap:Envelope>';

        //build soap headers
        $headers = array("Content-type: text/xml;charset=UTF-8",
                        "SOAPAction: \"http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/ACORDService/GetTravelQuote\"", 
                        "Content-length: ".strlen($soap_request),); 
        // send request
        $output = $this->send_request($headers, $soap_request);
        // var_dump($output);
        echo '<pre lang="xml"';
        $xmlparser = xml_parser_create(); 
        $xmldata = $output;     
        xml_parse_into_struct($xmlparser,$xmldata,$values);
        xml_parser_free($xmlparser);
        print_r ($values);
        echo '</pre>';
    }
    // get Policy
    public function get_Policy($info_arr, $pass_info)
    {
        //<SignonRq>
        $SignonRq_xml = $this->create_Signon_xml();
        //<InsuranceSvcRq>   
        $InsuranceSvcRq_xml = $this->create_InsuranceSvcRq_xml($info_arr,$pass_info);
        //build soap body
        $soap_request = '<?xml version="1.0" encoding="utf-8"?>
                        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                        <soap:Body>
                        <GetTravelPolicy xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/">
                        <ACORD xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD_PolicyReq">'.$SignonRq_xml.$InsuranceSvcRq_xml.'
                        </ACORD>
                        </GetTravelPolicy>
                        </soap:Body>
                        </soap:Envelope>';

        //build soap headers
        $headers = array("Content-type: text/xml;charset=UTF-8",
                        "SOAPAction: \"http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/ACORDService/GetTravelPolicy\"", 
                        "Content-length: ".strlen($soap_request),); 
        // send request
        $output = $this->send_request($headers, $soap_request);
        var_dump($output);
        echo '<pre lang="xml"';
        $xmlparser = xml_parser_create(); 
        $xmldata = $output;     
        xml_parse_into_struct($xmlparser,$xmldata,$values);
        xml_parser_free($xmlparser);
        print_r ($values);
        echo '</pre>';
    }
  
}
class Passenger
{
    //number of passenger
    public $p_number;
    //passenger info
    public $p_info = array();
    //representative passenger id in $p_info
    public $p_prim = 0;
    //display single form
    public function show_sigle_form($id)
    {
        $num = $id + 1;
        echo 
            '<h3>Passenger '.$num.'</h3>
            Full name: 
            <input type="text" name="fullname'.$id.'"> 
            DOB:
            <input type="date" name="dob'.$id.'"><br>
            Gender:
            <input type="radio" name="gender'.$id.'" value="male" checked> Male
            <input type="radio" name="gender'.$id.'" value="female"> Female
            <input type="radio" name="gender'.$id.'" value="other"> Other <br>
            Representative
            <input type="radio" name="rep" value='.$id;
        if ($id == 0) //default representative
        {
            echo ' checked';
        } 
        echo'><br><br>';
    }
    //display full form
    public function show_full_form()
    {
        echo '<h2>Complete form </h2>'; 
        echo '
            <form method="post">
            Insure from <input type="date" name="start_day">
            to <input type="date" name="end_day">
            <br>
            Representative info <br>
            Phone number:
            <input type="text" name="phone">
            Email:
            <input type="text" name="email"><br>
            <br>';
        //display each passenger form
        for ($i = 0; $i < $this->p_number ; $i++)
        {
            $this ->show_sigle_form($i);
        }
        echo '<input type="submit" name="sub_info" value="Register Insure"></form>';
    }
    //check input information
    public function check_form()
    {   
        $name_arr = array();
        foreach ($_POST as $key => $value)
        {
            //get all name
            if (preg_match('/name\d/', $key))
            {
                array_push($name_arr, $value);
            }
        }
        //check name
        $name_patt = '/^[a-z\s]*$/';
        foreach ($name_arr as $name)
        {
            if (!preg_match($name_patt, $name))
                return false;
        }
        //check phone 
        //check email
        return true;
    }
    //get value into arrat
    public function info_to_array()
    {
        $this->p_info = $_SESSION['post_data']; 
    }
    public function show()
    {
        if (isset($_POST['sub_num']) && $_POST['p_number'] > 0)
        {       
            $this ->p_number = $_POST['p_number'];
            //show form
            $this ->show_full_form();
        }
    }
    public function quote()
    {
        //check info
        if ($this ->check_form() == FALSE)
        {
            echo 'Invalid input...<br>';
            //$this ->show_full_form();
        }
        else //input correct
        {
            $this ->info_to_array();
            $QuoteRequest = new Soap_Request();
            //get quote
            $QuoteRequest->get_Quote($this->p_info);
            //get policy button
            echo '<br><form method="post">Register<input type="submit" name="sub_reg" value="Register">';             
        } 
    }
    public function policy()
    {
        $PolicyRequest = new Soap_Request();
        $this ->info_to_array();
        $pass_info = array('name' => 'Duyen', 'title' =>'Miss', 'dob' => '1997-05-08', 'gender' => 'F', 'phone' => '0901234567', 'mail' =>'duyen12345@gmail.com');
        $PolicyRequest->get_Policy($this->p_info, $pass_info);
    }
}
