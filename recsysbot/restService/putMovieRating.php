<?php
 
use GuzzleHttp\Client;

function putMovieRating($chatId, $movieURI, $rating){
	//$userID = $chatId;
	$userID = 6;

   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/movieRating/putMovieRating?userID='.$userID.'&movieURI='.$movieURI.'&rating='.$rating;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   file_put_contents("php://stderr", "putMovieRating return:".$data.PHP_EOL);

   return $data;
}