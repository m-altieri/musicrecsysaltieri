<?php

function menuReply($telegram, $chatId){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  

   $text = "Well!";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   
   $keyboard = [
      ['Directors','Starring'],
      ['Categories','Genre'],
      ['/profile','/help','->']
   ];

   $reply_markup = $telegram->replyKeyboardMarkup([
   'keyboard' => $keyboard,
   'resize_keyboard' => true,
   'one_time_keyboard' => false
   ]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  

   $text = "Choose a property who you like, from this ;)";
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}