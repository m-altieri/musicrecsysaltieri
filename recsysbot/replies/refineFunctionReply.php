<?php

function refineFunctionReply($telegram, $chatId){

   $pagerankCicle = getNumberPagerankCicle($chatId);
   $replyLast = recMovieToRefineSelected($chatId, $pagerankCicle);
   $movie = $replyLast[1];
   
   //Chiama prima la funzione di refine e poi fai modicare  una proprietà
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $text = refineFunction($chatId);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);   
   

	$keyboard = refineMoviePropertyKeyboard($chatId, $movie);
   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Which properties of the movie you want to change?";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}