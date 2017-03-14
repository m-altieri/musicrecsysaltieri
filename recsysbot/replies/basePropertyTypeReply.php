<?php

function basePropertyTypeReply($telegram, $chatId){

   $text = "Please wait 😉"; 
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
   
   $fullMenuArray = propertyTypeKeyboard($chatId);

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $result[] = array($property);
   }    
   $keyboard = [
                  [$result[0][0], $result[1][0]],
                  [$result[2][0], $result[3][0]],
                  ['🔵 Movies','👤 Profile', 'Next 👉']
               ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Please, choose among the most popular properties \nor type the name";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}
