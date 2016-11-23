<?php

function propertyValueReply($telegram, $chatId, $propertyType, $text){

	$keyboard = propertyValueKeyboard($chatId, $propertyType, $text);
	$reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,'resize_keyboard' => true,'one_time_keyboard' => false]);

	if (strpos($propertyType, 'starring') !== false) {
		$text = "Please, choose the actor you want to rate";
	}
	else{
		$text = "Please, choose the ".$propertyType." you want to rate";
	}

	
	$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
	$telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup]); 

}

