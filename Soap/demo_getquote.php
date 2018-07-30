<?php
 $date = date('Y-m-d\TH:i:s', time());
 $soap_request = '<?xml version="1.0" encoding="utf-8"?>
 <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetTravelQuote xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/">
      <ACORD xmlns="http://ACE.Global.Travel.CRS.Schemas.ACORD_QuoteReq">
      <SignonRq>
      <SignonPswd>
        <CustId>
          <SPName>com.evolableasia</SPName>
          <CustLoginId>evolableasiaflight_jp.svc</CustLoginId>
        </CustId>
        <CustPswd>
          <EncryptionTypeCd>None</EncryptionTypeCd>
          <Pswd>$craMBLeD@123!</Pswd>
        </CustPswd>
      </SignonPswd>
      <ClientDt>'.$date.'</ClientDt>
      <CustLangPref>JA</CustLangPref>
      <ClientApp>
        <Org>com.evolableasia</Org>
        <Name>evolableasia Flight</Name>
        <Version>1.0</Version>
      </ClientApp>
    </SignonRq>
    <InsuranceSvcRq>
      <PersPkgPolicyQuoteInqRq>
        <TransactionRequestDt>'.$date.'</TransactionRequestDt>
        <PersPolicy>
          <CompanyProductCd>C7363B08-0761-4A16-8804-A02B001A8DA1</CompanyProductCd>
          <ContractTerm>
            <EffectiveDt>2018-10-10</EffectiveDt>
            <ExpirationDt>2018-10-12</ExpirationDt>
          </ContractTerm>
          <com.acegroup_Destination>
            <RqUID>833B107A-9DC7-4D52-841D-6074884DCF50</RqUID>
            <DestinationDesc>Domestic</DestinationDesc>
          </com.acegroup_Destination>
          <com.acegroup_InsuredPackage>
            <RqUID>851CFFF2-ED6E-4835-A7FD-9D0D0019C474</RqUID>
            <InsuredPackageDesc>Individual</InsuredPackageDesc>
          </com.acegroup_InsuredPackage>
          <com.acegroup_Plan>
            <RqUID>531CC7DB-2D16-4A2B-A59A-5E357AD22797</RqUID>
            <PlanDesc>CD1</PlanDesc>
          </com.acegroup_Plan>
        </PersPolicy>
      </PersPkgPolicyQuoteInqRq>
    </InsuranceSvcRq>
  </ACORD>
  </GetTravelQuote>
   </soap:Body>
 </soap:Envelope>';
  
 $headers = array(
      "Content-type: text/xml;charset=UTF-8",
      "SOAPAction: \"http://ACE.Global.Travel.CRS.Schemas.ACORD.WS/ACORDService/GetTravelQuote\"", 
      "Content-length: ".strlen($soap_request),
                     ); 
 $url = "http://btsws.atuat.acegroup.com/CRS_ACORD_WS/ACORDService.asmx";
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
 var_dump($output);
 //var_dump($output);

   
?>