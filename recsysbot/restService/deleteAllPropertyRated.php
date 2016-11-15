<?php

use GuzzleHttp\Client;

function deleteAllPropertyRated($chatId){

   $userID = $chatId;
   
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/reset/deleteAllPropertyRated?userID='.$userID;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   
   file_put_contents("php://stderr", "deleteAllPropertyRated return:".$data.PHP_EOL);
   return $data;

}