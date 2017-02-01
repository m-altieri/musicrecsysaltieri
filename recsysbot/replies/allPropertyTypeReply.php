<?php

//function fullMenuReply($telegram, $chatId){
function allPropertyTypeReply($telegram, $chatId){

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   // $text = "Please wait 🤔"; 
   // $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);

   $fullMenuArray = propertyTypeKeyboard($chatId);

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $keyboard[] = array($property);
   }
   $keyboard[] = ['🔙 Return to the short list'];
   $keyboard[] = array('🔵 Add Movies','👤 Profile');

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   //$text = "Choose among...";
   $text = "Please, choose among the most popular properties \nor type the name";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}
