<?php

//function fullMenuReply($telegram, $chatId){
function allPropertyTypeReply($telegram, $chatId){

   //$fullMenuArray = getKeyboardFullMenu($chatId);
   $fullMenuArray = propertyTypeKeyboard($chatId);

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $keyboard[] = array($property);
   }
   $keyboard[] = array('/profile','/help','<-');

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Choose your favourite...";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}