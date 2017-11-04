<?php
function allPropertyTypeReply($telegram, $chatId){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);

   $fullMenuArray = propertyTypeKeyboard($chatId);

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $keyboard[] = array($property);
   }
   $keyboard[] = ["".$emojis['backarrow']." Return to the short list"];
   $keyboard[] = array('🔵 Movies',"".$emojis['gear']." Profile");

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Please, choose among the most popular properties \nor type the name";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}
