<?php

use Recsysbot\Classes\userMovieRecommendation;

function recommendationBackNextMovieReply($telegram, $chatId, $userMovieRecommendation){

	$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
	$text = "Please wait. I work for you 🤔"; 
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);

	$userMovieRecommendation->setText(1);
   $userMovieRecommendation->handle();
}