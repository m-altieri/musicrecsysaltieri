<?php

require_once '/app/recsysbot/facebook/utils.php';

function sendMarkupMessage($chat_id, $text, $replyMarkup) {
	
	$url = sendMessageURI();
	
	$replyMarkupArray = array();
	for ($i = 0; $i < count($replyMarkup); $i++) {
		for ($j = 0; $j < count($replyMarkup[$i]); $j++) {
			$replyMarkupArray[] = $replyMarkup[$i][$j];
		}
	}
	
	$quick_replies = array();
	for ($i = 0; $i < count($replyMarkupArray); $i++) {
		$quick_replies[] = [
			"content_type" => "text",
			"title" => $replyMarkupArray[$i],
			"payload" => $replyMarkupArray[$i]
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
	file_put_contents("php://stderr", "\nSto inviando questo markup: " . print_r($req, true) . PHP_EOL);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	file_put_contents("php://stderr", "\nResult: " . print_r($result, true) . PHP_EOL);
}