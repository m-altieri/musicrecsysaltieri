<?php

use Recsysbot\Commands\ProfileCommand;

function profileReply($telegram, $chatId, $rating){
   
   $userID = 6;
   $oldNumberOfRatedMovies = getNumberRatedMovies($userID);
   $movieName = getUserMovieToRating($userID);

   if ($movieName != "null"){
      $movieName = str_replace(' ', '_', $movieName);
      $movieURI = "http://dbpedia.org/resource/";
      $movieURI .= $movieName;

      $data = putMovieRating($chatId, $movieURI, $rating);         
   }
   else{
      $data = null;
   }

   $newNumberOfRatedMovies = getNumberRatedMovies($userID);
   //manca il richiamo del profilo o la funzione, rivedere.
   $title = $profile->getTitleAndPosterMovieToRating($movieName);
   if ($newNumberOfRatedMovies > $oldNumberOfRatedMovies) {
   	$text = "You have rated \"".$title."\" movie \nProfile update with ".$newNumberOfRatedMovies." rated movies";
   } else {
   	$text = "Sorry, there was a problem to updating your profile";
   }
   
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $text = "Do you want evaluate another movie? \n Type \profile"; 
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
}