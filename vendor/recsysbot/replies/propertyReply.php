<?php

function propertyReply($telegram, $chatId, $propertyType){
     
   $keyboard = getKeyboardProperty($chatId, $propertyType);
   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,'resize_keyboard' => true,'one_time_keyboard' => false]);

   $text = "Please, choose the \"".$propertyType."\" you like";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup]);

}