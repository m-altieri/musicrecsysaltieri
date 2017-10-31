<?php
function sendMessage($text, $user) {
		
	$config = require __DIR__ . '/recsysbot/config/movierecsysbot-config.php';
	
	$url = "https://graph.facebook.com/v2.6/me/messages?access_token=" . $config['token'];
	$res = [
		'recipient' => [ 'id' => $user ],
		'message' => [ 'text' => $text ]
	];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($res));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	file_put_contents("php://stderr", "\nResult: " . $result . PHP_EOL);
}