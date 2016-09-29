<?php

function noReply($telegram, $chatId){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   

   $text = "So unfortunately I can not help you :( \nGoodbye, see you soon!";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}