<?php
 
use GuzzleHttp\Client;

function getPropertyValueListFromPropertyType($userID, $propertyType){


   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/propertyValueList/getPropertyValueListFromPropertyType?userID='.$userID.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   return $data;
}