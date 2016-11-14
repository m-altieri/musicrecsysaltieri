<?php
//function menuReply($telegram, $chatId){
function basePropertyTypeReply($telegram, $chatId){
   
   $fullMenuArray = propertyTypeKeyboard($chatId);
   //$fullMenuArray = getKeyboardFullMenu($chatId);

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $result[] = array($property);
   }    
   $keyboard = [
                  [$result[0][0], $result[1][0]],
                  [$result[2][0], $result[3][0]],
                  ["profile", "/help", "->"]
               ];
   
/* $keyboard = [
                  ['Director','Starring'],
                  ['Category','Genre'],
                  ['/profile','/help','->']
               ];*/


   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Choose your favourite...";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}