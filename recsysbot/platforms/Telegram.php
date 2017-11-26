<?php 

use Telegram\Bot\Api;
require_once "recsysbot/platforms/Platform.php";

class Telegram implements Platform {
	
	var $telegram;
	var $token = $config ['token'];
	
	public function __construct() {
		$telegram = new Api($token);
	}
	
	public function sendMessage($chatId, $text, $reply_markup) {
		$telegram->sendMessage ( [
				'chat_id' => $chatId,
				'text' => text
		] );
	}
	
	public function sendPhoto($chatId, $photo, $caption) {
		
	}
	
	public function sendChatAction($chatId, $action) {
		
	}
	
	public function replyKeyboardMarkup($keyboard) {
		/*
		 * In ogni chiamata di replyKeyboardMarkup nel progrmama,
		 * resize_keyboard è sempre true e one_time_keyboard è sempre false,
		 * quindi lo imposto così di default.
		 */
		$reply_markup = $telegram->replyKeyboardMarkup([$keyboard, true, false]);
		
		// DEBUG
		file_put_contents("php://stderr", "reply_markup: " . $reply_markup);
		
		return $reply_markup;
	}
	
	public function getWebhookUpdates() {
		return $telegram->getWebhookUpdates();
	}
	
	/**
	 * $message = isset ( $update ['message'] ) ? $update ['message'] : "";
	$messageId = isset ( $message ['message_id'] ) ? $message ['message_id'] : "";
	$chatId = isset ( $message ['chat'] ['id'] ) ? $message ['chat'] ['id'] : "";
	$firstname = isset ( $message ['chat'] ['first_name'] ) ? $message ['chat'] ['first_name'] : "";
	$lastname = isset ( $message ['chat'] ['last_name'] ) ? $message ['chat'] ['last_name'] : "";
	$username = isset ( $message ['chat'] ['username'] ) ? $message ['chat'] ['username'] : "";
	$date = isset ( $message ['date'] ) ? $message ['date'] : "";
	$text = isset ( $message ['text'] ) ? $message ['text'] : "";
	$globalDate = gmdate ( "Y-m-d\TH:i:s\Z", $date );
	 * @param unknown $json
	 */
	public function getMessageInfo($json) {
		
		$info = [
			'message' => isset ($json['message']) ? $json['message'] : "",
			'messageId' => isset ($message['message_id']) ? $message['message_id'] : "",
			'chatId' => isset ($message['chat']['id']) ? $message['chat']['id'] : "",
			'firstname' => isset ($message['chat']['first_name']) ? $message['chat']['first_name'] : "",
			'lastname' => isset ($message['chat']['last_name']) ? $message['chat']['last_name'] : "",
			'username' => isset ($message['chat']['username']) ? $message['chat']['username'] : "",
			'date' => isset ($message['date']) ? $message['date'] : "",
			'text' => isset ($message['text']) ? $message['text'] : "",
			'globalDate' => gmdate("Y-m-d\TH:i:s\Z", $date)
		];
		
		return $info;
	}
	
}

?>