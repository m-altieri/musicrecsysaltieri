<?php
use GuzzleHttp\Client;

function getAuxReply($chatId, $messageId, $url, $date, $firstname, $botName) {
	
	$client = new Client ( [
			'base_uri' => $url
	] );
	$stringGetRequest = '?userID=' . $userID .
	'&messageID=' . $messageId . '&timeStamp=' . $timeStamp .
	'&text=' . urlencode($text) . '&firstname=' . $firstname . '&botName=' . $botName;
	
	file_put_contents ( "php://stderr", '[sendMessageToServer]' . $base_uri . $stringGetRequest . PHP_EOL );
	
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg, true );
	
	return $data;
}