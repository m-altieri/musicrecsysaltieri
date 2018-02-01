<?php

require_once '/app/recsysbot/facebook/createQuickReplies.php';

function sendPhoto($chat_id, $photo, $reply_markup) {
	
	$url = sendMessageURI();
	
	$message = [
		'attachment' => [
			"type" => "image",
			"payload" => [
				"url" => $photo
			]
		]
	];
	
	$quickReplies = array();
	
	if ($replyMarkup != null) {
		$quick_replies = createQuickReplies($replyMarkup);
		$message['quick_replies'] = $quick_replies;
	}
	
	
	$req = [
		'messaging_type' => 'RESPONSE',
		'recipient' => [ 'id' => $chat_id ],
		'message' => $message
	];
	
	file_put_contents("php://stderr", "\nSto inviando questa foto: " . print_r($req, true) . PHP_EOL);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	file_put_contents("php://stderr", "\nResult: " . print_r($result, true) . PHP_EOL);
	
	// Dovrebbe essere catturata da messageDispatcher, che manderà la foto di default
	if (json_decode($result)['error'] != null) {
		throw new Exception();
	}
}