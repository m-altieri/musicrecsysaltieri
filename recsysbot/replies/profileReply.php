<?php

use Recsysbot\Classes\userProfileAcquisitionByMovie;

function profileReply($telegram, $chatId, $rating, $userMovieprofile){
   
   $userID = $chatId;

   $oldNumberOfRatedMovies = getNumberRatedMovies($userID);

   $movieName = $userMovieprofile->getUserMovieToRating($chatId);

   $data = $userMovieprofile->putUserMovieToRating($chatId, $movieName, $rating);


   $newNumberOfRatedMovies = getNumberRatedMovies($userID);
   //manca il richiamo del profilo o la funzione, rivedere.
   $title = $userMovieprofile->getTitleAndPosterMovieToRating($movieName);
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