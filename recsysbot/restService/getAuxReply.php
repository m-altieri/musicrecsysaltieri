<?php
use GuzzleHttp\Client;

function getAuxReply($chatId, $messageId, $url, $date, $firstname, $botName) {
	
	$baseUrl = explode('?', $url)[0];
	$stringGetRequest = '?' . explode('?', $url)[1];
	
	$client = new Client ( [
			'base_uri' => $baseUrl
	] );
	
	file_put_contents ( "php://stderr", '[sendMessageToServer]' . $baseUrl . $stringGetRequest . PHP_EOL );
	
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg, true );
	
	return $data;
}