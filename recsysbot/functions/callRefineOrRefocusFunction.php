<?php 

function callRefineOrRefocusFunction($telegram, $chatId){

	$pagerankCicle = getNumberPagerankCicle($chatId);
   $text = null;

	if ($pagerankCicle == 0) {
		 refineMoviePropertyReply($telegram, $chatId);
	}
	else{
		$oldMovieToRefine = oldMovieToRefine($chatId, $pagerankCicle);
		$lastMovieToRefine = lastMovieToRefine($chatId, $pagerankCicle);

   	$text = "".$pagerankCicle."^ cicle of recommendation...";
   	$text .= "\nDuring previous cycle you have chosen:";
      $text .= "\n\"".ucwords($oldMovieToRefine)."\"";
   	$text .= "\nIn this cycle you have chosen:";
      $text .= "\n\"".ucwords($lastMovieToRefine)."\"";
   	$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   	$telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);

   	if (strcasecmp($oldMovieToRefine, $lastMovieToRefine) == 0){
         refocusFunctionReply($telegram, $chatId);
   	}
   	else{
         refineFunctionReply($telegram, $chatId);
   	}
   	
	}

/*   putNumberPagerankCicle($chatId, $pagerankCicle+1);

   $text = "Do you prefer to tell me something else about you \nor can I recommend you a movie?";

   $keyboard = [
      ["✔ Recommend me a movie"],
      ["🔎 Let me choose additional properties"]
   ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);*/


}

