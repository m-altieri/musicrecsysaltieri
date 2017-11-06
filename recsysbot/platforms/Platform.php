<?php 

interface Platform {
	
	public function sendMessage($chatId, $text, $reply_markup);
	
	public function sendPhoto($chatId, $photo, $caption);
	
	public function sendChatAction($chatId, $action);
	
	/**
	 * Get the $reply_markup to pass in the sendMessage() function.
	 * @param unknown $keyboard JSON object containing the reply buttons and their text.
	 * @param unknown $resize_keyboard boolean
	 * @param unknown $one_time_keyboard boolean
	 * @return A JSON-serialized object for an inline keyboard.
	 */
	public function replyKeyboardMarkup($keyboard, $resize_keyboard, $one_time_keyboard);
	
// 	public function commandsHandler() //credo già fatto con l'id profile
// 	public function addCommand() //già fatto con l'id profile
// 	public function getWebhookUpdates() //risolto con php://input

}

?>