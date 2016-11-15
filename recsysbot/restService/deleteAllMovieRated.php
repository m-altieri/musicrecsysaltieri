<?php

use GuzzleHttp\Client;

function deleteAllMovieRated($chatId){

   $userID = $chatId;
   
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/reset/deleteAllMovieRated?userID='.$userID;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   
   file_put_contents("php://stderr", "deleteAllMovieRated return:".$data.PHP_EOL);
   return $data;

}