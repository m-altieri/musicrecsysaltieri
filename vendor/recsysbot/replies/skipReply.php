<?php

function skipReply($telegram, $chatId){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $text = "Profile update ;)"; 
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $text = "Do you want evaluate another movie? "; 
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $text = "type /profile"; 
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);  

}