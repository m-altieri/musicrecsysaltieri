<?php 

class Telegram implements Platform {
	
	$telegram = new Api ( $token );
	
	public function sendMessage($chatId, $text, $reply_markup) {
		
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
	
}

?>