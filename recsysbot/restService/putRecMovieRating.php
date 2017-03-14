<?php
 
use GuzzleHttp\Client;

function putRecMovieRating($chatId, $movieURI, $rating, $position, $pagerankCicle, $refineRefocus, $botName, $messageID, $botTimestamp, $recommendatinsList, $ratingsList, $numberRecommendationList){

	$userID = $chatId;
	//$client = new Client(['base_uri'=>'http://localhost:8080']);
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/ratingsRecMovie/putRecMovieRating?userID='.$userID.'&movieURI='.$movieURI.'&rating='.$rating.'&position='.$position.'&pagerankCicle='.$pagerankCicle.'&refineRefocus='.$refineRefocus.'&botName='.$botName.'&messageID='.$messageID.'&botTimestamp='.$botTimestamp.'&recommendatinsList='.$recommendatinsList.'&ratingsList='.$ratingsList.'&numberRecommendationList='.$numberRecommendationList;

   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   file_put_contents("php://stderr", "http://193.204.187.192:8080".$stringGetRequest."/return:".$data.PHP_EOL);

   return $data;
   
}