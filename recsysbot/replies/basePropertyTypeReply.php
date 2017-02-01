<?php
//function menuReply($telegram, $chatId){
function basePropertyTypeReply($telegram, $chatId){


   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $text = "Please wait 🤔"; 
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
   
   $fullMenuArray = propertyTypeKeyboard($chatId);
   //$fullMenuArray = getKeyboardFullMenu($chatId);

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $result[] = array($property);
   }    
   $keyboard = [
                  [$result[0][0], $result[1][0]],
                  [$result[2][0], $result[3][0]],
                  ['🔵 Add Movies','👤 Profile', 'Next 👉']
               ];
   
/* $keyboard = [
                  ['Director','Starring'],
                  ['Category','Genre'],
                  ['Preferences','/help','->']
               ];*/


   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   //$text = "Choose among...";
   $text = "Please, choose among the most popular properties \nor type the name";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}
