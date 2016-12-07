<?php
 
use GuzzleHttp\Client;

function getPropertyRating($chatId, $propertyTypeUri, $propertyUri, $lastChange){

	$userID = $chatId;
	// $client = new Client(['base_uri'=>'http://localhost:8080']);
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest = '/lodrecsysrestful/restService/propertiesRating/getPropertyRating?userID='.$userID.'&propertyTypeUri='.$propertyTypeUri.'&propertyUri='.$propertyUri.'&lastChange='.$lastChange;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg, true);

   file_put_contents("php://stderr", "http://193.204.187.192:8080".$stringGetRequest."/return:".$bodyMsg.PHP_EOL);

   return $data;   
   
}