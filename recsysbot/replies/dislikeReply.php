<?php

use Vendor\Recsysbot\Commands\ProfileCommand;

function dislikeReply($telegram, $chatId){
   
   $userID = 6;
   $rating = "0";
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
}
