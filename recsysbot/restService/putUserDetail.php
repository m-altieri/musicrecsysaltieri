<?php
use GuzzleHttp\Client;

function putUserDetail($chatId, $firstname, $lastname, $username) {
	
	$config = require '/app/recsysbot/config/movierecsysbot-config.php';
	
	$userID = $chatId;
	$client = new Client ( [ 
			'base_uri' => $config['base_uri']
	] );
	$stringGetRequest = $config['application_name'] . '/restService/detail/putUserDetail?userID=' . $userID . '&firstname=' . $firstname . '&lastname=' . $lastname . '&username=' . $username;
	file_put_contents ( "php://stderr", $base_uri . $stringGetRequest . "/return:" . $data . PHP_EOL );
	
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg );
		
	return $data;
}