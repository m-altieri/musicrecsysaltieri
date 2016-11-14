<?php

use GuzzleHttp\Client;

function deletePropertyRating($chatId){

   $userID = $chatId;
   
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/reset/deletePropertyRating?userID='.$userID;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   
   file_put_contents("php://stderr", "deletePropertyRating return:".$data.PHP_EOL);
   return $data;

}