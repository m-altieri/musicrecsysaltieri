<?php 

function explanationMovieReply($telegram, $chatId){

   $pagerankCicle = getNumberPagerankCicle($chatId);
   $reply = recMovieSelected($chatId, $pagerankCicle);
   $movie = $reply[1];
   $movie_name = str_replace(' ', '_', $movie);
   $text = getMovieExplanation($chatId, $movie_name);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);   	

}