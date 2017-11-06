<?php 

class Telegram implements Platform {
	
	$telegram = new Api ( $token );
	
	public function sendMessage($chatId, $text, $reply_markup) {
		
	}
	
	public function sendPhoto($chatId, $photo, $caption) {
		
	}
	
	public function sendChatAction($chatId, $action) {
		
	}
	
	public function replyKeyboardMarkup($keyboard, $resize_keyboard, $one_time_keyboard) {
		
	}
	
}

?>