<?php

require_once '/app/recsysbot/facebook/utils.php';

function sendMarkupMessage($chat_id, $text, $replyMarkup) {
	
	$url = sendMessageURI();
	
	$replyMarkupArray = array();
	foreach ($replyMarkup as $row) {
		foreach ($row as $item) {
			$replyMarkupArray[] = $item;
		}
	}
	
	$quick_replies = array();
	foreach ($replyMarkupArray as $item) {
		$quick_replies[] = [
			"content_type" => "text",
			"title" => $item,
			"payload" => $item
		];
	}
	
	$req = [
			'messaging_type' => 'RESPONSE',
			'recipient' => [ 'id' => $chat_id ],
			'message' => [ 
					'text' => $text,
					'quick_replies' => $quick_replies
			]
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