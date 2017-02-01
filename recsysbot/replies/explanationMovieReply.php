<?php 

function explanationMovieReply($telegram, $chatId){

   $pagerankCicle = getNumberPagerankCicle($chatId);
	$movieName = lastMovie($chatId, $pagerankCicle);
   $movieName = str_replace(' ', '_', $movieName);
   $text = getMovieExplanation($chatId, $movieName);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);   	

}