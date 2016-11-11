<?php

use GuzzleHttp\Client;

function getNumeberRatedMovie($chatId){
   //$userID = $chatId;
   $userID = 6;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/preference/number?userID='.$userID;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   print_r($data);
   return $data;

}