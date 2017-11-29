<?php 

use Telegram\Bot\Api;
require_once "recsysbot/platforms/Platform.php";

class Telegram implements Platform {
	
	var $telegram;
	
	public function __construct() {
		$config = require '/app/recsysbot/config/movierecsysbot-config.php';
		$this->$telegram = new Api($config['token']);
	}
	
	public function sendMessage($array) {
		$this->$telegram->sendMessage($array);
	}
	
	public function sendPhoto($array) {
		$this->$telegram->sendPhoto($array);
	}
	

	public function sendChatAction($array) {
		$this->$telegram->sendChatAction($array);
	}
	
	public function replyKeyboardMarkup($keyboard) {
		/*
		 * In ogni chiamata di replyKeyboardMarkup nel progrmama,
		 * resize_keyboard è sempre true e one_time_keyboard è sempre false,
		 * quindi lo imposto così di default.
		 */
// 		$reply_markup = $this->$telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
		$reply_markup = $this->$telegram->replyKeyboardMarkup($keyboard);

		return $reply_markup;
	}
	
	public function getWebhookUpdates() {
		return $this->$telegram->getWebhookUpdates();
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
		
		file_put_contents("php://stderr", "Text:" . $json['message']['text']);
		$message = isset ($json['message']) ? $json['message'] : "";
		
		$info = array(
			'message' => $message,
			'messageId' => isset ($message['message_id']) ? $message['message_id'] : "",
			'chatId' => isset ($message['chat']['id']) ? $message['chat']['id'] : "",
			'firstname' => isset ($message['chat']['first_name']) ? $message['chat']['first_name'] : "",
			'lastname' => isset ($message['chat']['last_name']) ? $message['chat']['last_name'] : "",
			'username' => isset ($message['chat']['username']) ? $message['chat']['username'] : "",
			'date' => isset ($message['date']) ? $message['date'] : "",
			'text' => isset ($message['text']) ? $message['text'] : "",
			'globalDate' => gmdate("Y-m-d\TH:i:s\Z", $date)
		);

		return $info;
	}
	
	public function commandsHandler($boolean) {
		$this->$telegram->commandsHandler($boolean);
	}
	
	public function addCommand($commandClass) {
		$this->$telegram->addCommand($commandClass);
	}
	
}

?>