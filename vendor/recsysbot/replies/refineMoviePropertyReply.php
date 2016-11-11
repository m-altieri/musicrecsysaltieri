<?php

function refineMoviePropertyReply($telegram, $chatId, $text){

   $reply = explode("\"", $text);
   $movie = isset($reply[1])? $reply[1] : null;

	$keyboard = refineMoviePropertyKeyboard($chatId, $movie);

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Which properties of the movie you want to change?";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}