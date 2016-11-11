<?php

function refineRecommendationReply($telegram, $chatId){

	$text = "Which properties of the movie you want to change?";

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}