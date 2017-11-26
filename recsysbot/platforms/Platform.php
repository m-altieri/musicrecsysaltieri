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
	 * 
	 * reply_markup: {
			"keyboard":[
				["\ud83c\udf10 Recommend Movies"],
				["\ud83d\udcd8 Help","\u2699\ufe0f Profile"]
			],
			"resize_keyboard":true,
			"one_time_keyboard":false
		}
	 */
	public function replyKeyboardMarkup($keyboard);
	
// 	public function commandsHandler() //credo già fatto con l'id profile
// 	public function addCommand() //già fatto con l'id profile

	public function getWebhookUpdates();
	
	public function getMessageInfo($json);

}

?>