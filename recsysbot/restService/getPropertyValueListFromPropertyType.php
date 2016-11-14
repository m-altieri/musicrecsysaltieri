<?php
 
use GuzzleHttp\Client;

function getPropertyValueListFromPropertyType($chatId, $propertyType){
	//$userID = $chatId;
	$userID = 6;

   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/propertyValueList/getPropertyValueListFromPropertyType?userID='.$userID.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   file_put_contents("php://stderr", "getPropertyValueListFromPropertyType?userID=".$userID."&propertyType=".$propertyType.PHP_EOL);

   return $data;
}