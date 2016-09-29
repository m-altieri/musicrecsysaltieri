<?php

function propertyReply($telegram, $chatId, $propertyType){
    
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']); 
   $text = "Good! You've chosen \"".$propertyType."\" \nLet me take a look at your profile.\nJust a moment... :)";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   
   $keyboard = getKeyboardProperty($chatId, $propertyType);

   $reply_markup = $telegram->replyKeyboardMarkup([
     'keyboard' => $keyboard,
     'resize_keyboard' => true,
     'one_time_keyboard' => false
     ]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  

   $text = "Your profile shows an interest for these " .$propertyType.".\nIn particular, which do you choose?";
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}