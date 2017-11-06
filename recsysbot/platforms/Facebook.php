<?php 

class Facebook implements Platform {
	
	foreach (glob('recsysbot/facebook/*.php' as $file)) {
		require $file;
	}
	
	public function sendMessage($chatId, $text, $reply_markup) {
		sendMessage($text, $chatId)
	}
	
	public function sendPhoto($chatId, $photo, $caption) {
		
	}
	
	public function sendChatAction($chatId, $action) {
		
	}
	
	public function replyKeyboardMarkup($keyboard, $resize_keyboard, $one_time_keyboard) {
		
	}
	
}

?>