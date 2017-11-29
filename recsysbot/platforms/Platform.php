<?php 

interface Platform {
	
	/**
	 * Send a message.
	 * $array must contain 3 values:
	 * 'chat_id' - the chat where to send the message to
	 * 'text' - the text of the message
	 * 'reply_markup' - the keyboard provided to the users
	 */
	public function sendMessage($array);
	
	/**
	 * Send a photo.
	 * $array must contain 3 values:
	 * 'chat_id' - the chat where to send the message to
	 * 'photo' - the photo path
	 * 'caption' - the caption to send alongside with the photo
	 */
	public function sendPhoto($array);
	
	/**
	 *
	 * @param unknown $array Array containing the chat_id and the action.
	 */
	public function sendChatAction($array);
	
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
	
	public function commandsHandler($boolean);
	
	public function addCommand($commandClass);

}

?>