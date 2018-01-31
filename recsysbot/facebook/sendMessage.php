<?php
function sendMessage($user, $text) {
		
	$utils = require '/app/recsysbot/facebook/utils.php';
	
	$url = $utils->sendMessageURI();
	
	$req = [
		'messaging_type' => 'RESPONSE',
		'recipient' => [ 'id' => $user ],
		'message' => [ 'text' => $text ]
	];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	file_put_contents("php://stderr", "\nResult: " . print_r($result, true) . PHP_EOL);
}