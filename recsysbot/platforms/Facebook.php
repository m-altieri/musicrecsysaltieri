<?php 

require_once "recsysbot/platforms/Platform.php";
require "recsysbot/facebook/sendMessage.php";
require "recsysbot/facebook/setBotProfile.php";
require "recsysbot/facebook/setGetStarted.php";
require "recsysbot/facebook/setGreeting.php";
require "recsysbot/facebook/setPersistentMenu.php";
$config = require_once '/app/recsysbot/config/movierecsysbot-config.php';


class Facebook implements Platform {
	
	public function sendMessage($array) {
		sendMessage($array['chat_id'], $array['text']);
		/*
		 * Aggiungere l'invio dei quick reply
		 */
	}
	
	public function sendPhoto($array) {
		
	}
	
	public function sendChatAction($array) {
		
	}
	
	private function replyKeyboardMarkup($keyboard) {
		
		$quick_replies = array();
		
		foreach ($keyboard as $item) {
			$quick_replies['content_type'] = 'text';
			$quick_replies['title'] = $item;
			$quick_replies['payload'] = $item;
		}
		
		return $quick_replies;
	
	}
	
	public function getWebhookUpdates() {
		return file_get_contents("php://input");
	}
	
	//TODO Da testare
	public function getMessageInfo($json) {
		
		$message = isset ($json['entry'][0]['messaging'][0]) ? $json['entry'][0]['messaging'][0] : "";

		$info = array(
				'message' => $message,
				'messageId' => isset ($message['message']['mid']) ? $message['message']['mid'] : "",
				'chatId' => isset ($message['sender']['id']) ? $message['sender']['id'] : "",
				'userInfo' => isset ($message['sender']['id']) ? json_decode(file_get_contents("https://graph.facebook.com/v2.6/" . $message['sender']['id'] . "?access_token=" . $config['token']), true) : "",
				'firstname' => isset ($userInfo) ? $userInfo['first_name'] : "",
				'lastname' => isset ($userInfo) ? $userInfo['last_name'] : "",
				'username' => "", //Non viene restituito dalla chiamata
				'date' => isset ($json['entry'][0]['time']) ? $json['entry'][0]['time'] : "",
				'text' => isset ($message['message']['text']) ? $message['message']['text'] : "",
				'globalDate' => isset ($json['entry'][0]['time']) ? gmdate("Y-m-d\TH:i:s\Z", $json['entry'][0]['time']) : "",
				
				// Contiene il payload per i pulsanti nel caso vengano utilizzati
				'postbackPayload' => isset ($message['postback']['payload']) ? $message['postback']['payload'] : ""
		);
		
		return $info;
	}
	
	public function commandsHandler($boolean) {
		
	}
	
	public function addCommand($commandClass) {
		
	}
	
}

?>