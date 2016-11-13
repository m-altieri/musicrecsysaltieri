<?php

function acceptRecommendationReply($telegram, $chatId, $firstname){

	//Qui chiedere se gli piace il film, se lo ha già visto o non gli piace...stile profilo
	$text = "Perfect ".$firstname."!\nWrite \"/start\" for a new Recommendation";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}