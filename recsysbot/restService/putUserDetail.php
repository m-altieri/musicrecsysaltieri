<?php
use GuzzleHttp\Client;
function putUserDetail($chatId, $firstname, $lastname, $username) {
	$userID = $chatId;
	// $client = new Client(['base_uri'=>'http://192.168.1.107:8080']);
// 	$client = new Client ( [ 
// 			'base_uri' => 'http://193.204.187.192:8080' 
// 	] );
	$stringGetRequest = '/movierecsysrestful/restService/detail/putUserDetail?userID=' . $userID . '&firstname=' . $firstname . '&lastname=' . $lastname . '&username=' . $username;
// 	$response = $client->request ( 'GET', $stringGetRequest );
// 	$bodyMsg = $response->getBody ()->getContents ();
// 	$data = json_decode ( $bodyMsg );
	$ch = curl_init("http://192.168.1.107:8080" . $stringGetRequest);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($ch);
	curl_close($ch);
	//192.168.1.107
	file_put_contents("php://stderr", $res . PHP_EOL);
	file_put_contents ( "php://stderr", "http://192.168.1.107:8080" . $stringGetRequest . "/return:" . $data . PHP_EOL );
	
	return $data;
}

// 193.204.187.192

