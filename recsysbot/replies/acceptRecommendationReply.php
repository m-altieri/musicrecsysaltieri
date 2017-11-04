<?php

//obsoleta
function acceptRecommendationReply($telegram, $chatId, $firstname, $movie_name){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	//Qui chiedere se gli piace il film, se lo ha già visto o non gli piace...stile profilo

	//inserisci il film tra quelli accettati
	if ($movie_name !== "null"){
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movie_name;
         $rating = 3;
         $data = putAcceptRecMovieRating($chatId, $movieURI, $rating);
   }

	detailReply($telegram, $chatId, $movie_name);

	//aggiungi alla lista dei film da vedere
	//aggiungi alla lista dei film visti

	/*Perfect Francesco.
	You can read the movie details and watch the trailer
	add movie to your list of films seen or to see
	or tap "Start" to start with a new Recommendation
	Enjoy your movie*/


	$text = "Perfect ".$firstname."!";
	$text .= "\nYou can read the movie details";
	$text .= "\nand watch the trailer or tap \"Home\"";
	//$text .= "\nadd movie to your list of films seen or to see";
	$text .= "\nfor a new recommendation ".$emojis['smile']."";
	$text .= "\n\n         🎉🎊🎊🎊🎊🎊🎊🎉";
	$text .= "\n🍕🍺".$emojis['popcorn']."Enjoy your movie😃  ".$emojis['popcorn']."🍺🍕";

   $keyboard = [
                   ['📑 Details','📣 Why?'],
                   ["🔘 List of Recommended Movies"],
                   ["".$emojis['backarrow']." Home",'👤 Profile']
               ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);   

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);


}