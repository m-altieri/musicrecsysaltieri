<?php
use GuzzleHttp\Client;

function getAuxReply($auxAPI) {
	
	$apiURL = $auxAPI['apiURL'];
	
	$baseUrl = explode('?', $apiURL)[0];
	$stringGetRequest = '?' . explode('?', $apiURL)[1];
	
	if ($auxAPI['parameters'] == null) { // E' una richiesta GET
		
		$client = new Client ([
				'base_uri' => $baseUrl
		]);
		
		file_put_contents("php://stderr", '[auxAPI GET]' . $baseUrl . $stringGetRequest . PHP_EOL);
		
		$response = $client->request('GET', $stringGetRequest);
		$bodyMsg = $response->getBody()->getContents();
		$data = json_decode($bodyMsg, true);
		
	} else { // E' una richiesta POST
		
		file_put_contents("php://stderr", '[auxAPI POST]' . $baseUrl . $stringGetRequest . PHP_EOL);
		
		// TODO
	}
	
	
	return $data;
}