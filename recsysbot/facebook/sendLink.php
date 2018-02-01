<?php

require_once '/app/recsysbot/facebook/createQuickReplies.php';

function sendLink($chat_id, $text, $url, $reply_markup) {
	
	$url = sendMessageURI();
	
	$message = [
		'attachment' => [
			'type' => 'template',
			'payload' => [
				'template_type' => 'button',
				'text' => $text,
				'buttons' => [
					'type' => 'web_url',
					'url' => $url,
					'title' => $text
				]
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
	
	file_put_contents("php://stderr", "\nSto inviando questo link: " . print_r($req, true) . PHP_EOL);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	file_put_contents("php://stderr", "\nResult: " . print_r($result, true) . PHP_EOL);
	
	// TODO
	/*
	 * Usare il "Modello con pulsante"
	 * es.
	 * {
	"messaging_type": "RESPONSE",
	"recipient": {
		"id": "1491368210953105"
	},
	"message": {
		"attachment": {
			"type": "template",
			"payload": {
				"template_type": "button",
				"text": "Trailer",
				"buttons": [
					{
						"type": "web_url",
						"url": "https://youtu.be/5DVw_AQgOuE",
						"title": "https://youtu.be/5DVw_AQgOuE"
					}
				]
			}
		}
	}
}
	 */
}