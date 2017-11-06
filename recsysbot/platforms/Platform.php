<?php 

interface Platform {
	
	public function sendMessage($chatId, $text, $reply_markup);
	
	public function sendPhoto($chatId, $photo, $caption);
	
	public function sendChatAction($chatId, $action);
	
	/**
	 * 
	 * @param unknown $keyboard
	 * @param unknown $resize_keyboard boolean
	 * @param unknown $one_time_keyboard boolean
	 */
	public function replyKeyboardMarkup($keyboard, $resize_keyboard, $one_time_keyboard);
}

?>