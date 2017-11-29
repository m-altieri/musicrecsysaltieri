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
	
// 	public function commandsHandler() //credo già fatto con l'id profile
// 	public function addCommand() //già fatto con l'id profile

	public function getWebhookUpdates();
	
	/**
	 * Get various information about the message.
	 * @param unknown $json The JSON-serialized message object.
	 * @return An array containing:
	 * 			'messageId' - the ID of the message;
	 * 			'chatId' - the ID of the user;
	 * 			'firstname' - the first name of the user;
	 * 			'lastname' - the last name of the user;
	 * 			'username' - the username of the user;
	 * 			'date' - the date of the message in UNIX epoch format;
	 * 			'text' - the text of the message;
	 * 			'globalDate' - a readable format of the date.
	 */
	public function getMessageInfo($json);
	
	public function commandsHandler($boolean);
	
	public function addCommand($commandClass);

}

?>