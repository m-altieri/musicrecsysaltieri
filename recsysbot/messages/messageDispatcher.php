<?php

use Recsysbot\Classes\DialogManager;

function messageDispatcher($platform, $chatId, $messageId, $date, $text, $firstname, $botName) {
	
	$chatAction = array(
			'chat_id' => $chatId,
			'action' => 'typing'
	);
	$platform->sendChatAction($chatAction);
	
	file_put_contents("php://stderr", "[messageDispatcher] Sending message to server: " . 
			"\nChat ID: " . $chatId . "\nText: " . $text . PHP_EOL);
	
	// Nome provvisorio
	// Prende le informazioni sul messaggio inviato dall'utente e le manda al server
	// $data è già un array; sendMessageToServer si occupa di fare il json_decode
	$data = sendMessageToServer($chatId, $messageId, $date, $text, $firstname, $botName);
	
	// Queste righe servono per collegare direttamente il client al servizio di NLP
// 	$dialogManager = new \Recsysbot\Classes\DialogManager($platform, $chatId);
// 	$data = $dialogManager->sendMessage($text);
	
	file_put_contents("php://stderr", "[messageDispatcher] Received message from server: ");
	file_put_contents("php://stderr", print_r($data, true) . PHP_EOL);
	
	// JSON Object containing the messages to send to the user.
	$replyMessages = $data['messages'];
	// JSON Object containing the keyboard to provide to the user.
	$markup = $data['reply_markup'];
	
	// Invio i messaggi e la eventuale keyboard all'utente
	foreach ($replyMessages as $message) {

		file_put_contents("php://stderr", "[messageDispatcher] Sending message to user:\n" .
				"chat_id: " . $chatId . "\ntext: " . $message['text'] . "\nphoto: " . $message['photo']. 
				"\nlink: " . $message['link'] . "\nkeyboard: " . $markup . PHP_EOL);
		
		if (isset ($message['photo'])) {
			$platform->sendPhoto($chatId, $message['photo'], $message['text'], $markup);
		} else if (isset ($message['link'])) {
			$platform->sendLink($chatId, $message['text'], $message['link'], $markup);
		} else {
			$platform->sendMessage($chatId, $message['text'], $markup);
		}
	}
		
	return $data;
}