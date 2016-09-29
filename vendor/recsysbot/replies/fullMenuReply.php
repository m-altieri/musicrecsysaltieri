<?php

function fullMenuReply($telegram, $chatId){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  

   $keyboard = [
      ['Writers','Producers','Release date'],
      ['Music','Runtime','Cinematographies'],
      ['Based on','Editings','Distributors'],
      ['/profile','/help','<-']
   ];

   $reply_markup = $telegram->replyKeyboardMarkup([
   'keyboard' => $keyboard,
   'resize_keyboard' => true,
   'one_time_keyboard' => false
   ]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $text = "Or choose a property from this: ";
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}