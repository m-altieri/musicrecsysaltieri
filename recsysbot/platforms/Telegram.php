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

		$chatId = $array['chat_id'];
		$keyboard = $array['reply_markup']['keyboard'];
		$resize_keyboard = $array['reply_markup']['resize_keyboard'] == 1 ? true : false;
		$one_time_keyboard = $array['reply_markup']['one_time_keyboard'] == 1 ? true : false;
		
		$reply_markup = $this->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => $resize_keyboard, 'one_time_keyboard' => $one_time_keyboard]);
		$text = $array['text'];
		$this->$telegram->sendMessage(['chat_id' => $chatId,
				'text' => 'test',
				'reply_markup' => $reply_markup]);
	}
	
	public function sendPhoto($array) {
		$chatId = $array['chat_id'];
		$photo = $array['photo'];
		$caption = $array['text'];
		$this->$telegram->sendPhoto([
				'chat_id' => $chatId,
				'photo' => $photo,
				'caption' => $caption
		]);
	}
	

	public function sendChatAction($array) {
		$this->$telegram->sendChatAction($array);
	}
	
	private function replyKeyboardMarkup($keyboard) {
		
		$reply_markup = $this->$telegram->replyKeyboardMarkup([
				'keyboard' => $keyboard['keyboard'],
				'resize_keyboard' => $keyboard['resize_keyboard'],
				'one_time_keyboard' => $keyboard['one_time_keyboard']
		]);

		return $reply_markup;
	}
	
	public function getWebhookUpdates() {
		return $this->$telegram->getWebhookUpdates();
	}
	
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