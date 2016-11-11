<?php

function acceptRecommendationReply($telegram, $chatId){

	$text = "Perfect!\nWrite \"/start\" for a new Recommendation";

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}