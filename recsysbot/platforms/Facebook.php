<?php 

require_once "recsysbot/platforms/Platform.php";
require "recsysbot/facebook/sendMessage.php";
require "recsysbot/facebook/setBotProfile.php";
require "recsysbot/facebook/setGetStarted.php";
require "recsysbot/facebook/setGreeting.php";
require "recsysbot/facebook/setPersistentMenu.php";

class Facebook implements Platform {
	
	public function sendMessage($chatId, $text, $reply_markup) {
		sendMessage($text, $chatId);
		/*
		 * Aggiungere l'invio dei quick reply
		 */
	}
	
	public function sendPhoto($chatId, $photo, $caption) {
		
	}
	
	public function sendChatAction($chatId, $action) {
		
	}
	
	public function replyKeyboardMarkup($keyboard) {
		
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
	
	public function getMessageInfo($json) {
		
	}
	
}

?>