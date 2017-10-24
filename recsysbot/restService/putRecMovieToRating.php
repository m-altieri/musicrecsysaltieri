<?php
use GuzzleHttp\Client;
function putRecMovieToRating($chatId, $movieURI, $numberRecommendationList, $position, $pagerankCicle, $botName, $messageID, $botTimestamp) {
	
	/*
	 * if (!$position >=0) {
	 * $position = 1;
	 * }
	 */
	$userID = $chatId;
	// $client = new Client(['base_uri'=>'http://localhost:8080']);
	$client = new Client ( [ 
			'base_uri' => 'http://193.204.187.192:8080' 
	] );
	$stringGetRequest = '/movierecsysrestful/restService/userRecMovieToRating/putRecMovieToRating?userID=' . $userID . '&movieURI=' . urlencode ( $movieURI ) . '&numberRecommendationList=' . $numberRecommendationList . '&position=' . $position . '&pagerankCicle=' . $pagerankCicle . '&botName=' . $botName . '&messageID=' . $messageID . '&botTimestamp=' . $botTimestamp;
	
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg );
	
	file_put_contents ( "php://stderr", "http://193.204.187.192:8080" . $stringGetRequest . "/return:" . $data . PHP_EOL );
	
	return $data;
}