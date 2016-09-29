<?php
function likeReply($telegram, $chatId){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   

   $text = "Profile update ;)";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}