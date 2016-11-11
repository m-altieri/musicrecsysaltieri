<?php

use GuzzleHttp\Client;

function getNumberRatedMovie($chatId){
   //$userID = $chatId;
   $userID = 6;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/movieRating/getNumberRatedMovies?userID='.$userID;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   
   file_put_contents("php://stderr", "getNumberRatedMovie return:".$data.PHP_EOL);
   return $data;

}