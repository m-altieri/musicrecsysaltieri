<?php 

class Facebook implements Platform {
	
	foreach (glob('recsysbot/facebook/*.php' as $file)) {
		require $file;
	}
	
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
			$quick_replies['content_type' => 'text'];
			$quick_replies['title' => $item];
			$quick_replies['payload' => $item];
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