<?php

function runtimeReply($telegram, $chatId){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  

   $keyboard = [
      ['â³ 90\'','â³ 100\''],
      ['â³ 120\'','â³ more 120\''],
   ];
   $keyboard[] = array("Menu");

   $reply_markup = $telegram->replyKeyboardMarkup([
   'keyboard' => $keyboard,
   'resize_keyboard' => true,
   'one_time_keyboard' => false
   ]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  

   $text = "Choose a runtime who you like, from this ;)";
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}