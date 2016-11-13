<?php

function noReply($telegram, $chatId){
	$text = "So unfortunately I can not help you :(";

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}