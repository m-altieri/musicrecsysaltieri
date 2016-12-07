<?php

function refocusFunctionReply($telegram, $chatId){

   $pagerankCicle = getNumberPagerankCicle($chatId);
   $movie = lastMovieToRefine($chatId, $pagerankCicle);
   
   $text = refocusFunction($chatId);
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);   
   
	$text = "Do you prefer to tell me something else about you \nor can I recommend you a movie?";

   $keyboard = [
      ["✔ Recommend me a movie"],
      ["🔎 Let me choose additional properties"]
   ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}