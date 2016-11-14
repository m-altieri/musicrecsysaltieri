<?php

use Vendor\Recsysbot\Commands\ProfileCommand;

function likeReply($telegram, $chatId){
   
   $userID = 6;
   $rating = "1";
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
   if ($data == "ok") {
   	$text = "You like ".$title." movie \nProfile update ".$data;
   } else {
   	$text = "Sorry, there was a problem to updating your profile";
   }
   
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}