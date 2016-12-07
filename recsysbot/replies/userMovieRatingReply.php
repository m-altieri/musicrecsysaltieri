<?php

use Recsysbot\Classes\userProfileAcquisitionByMovie;

function userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile){ 

   $oldNumberOfRatedMovies = getNumberRatedMovies($chatId);

   $movieName = $userMovieprofile->getUserMovieToRating($chatId);
   $data = $userMovieprofile->putUserMovieToRating($chatId, $movieName, $rating);
   $newNumberOfRatedMovies = getNumberRatedMovies($chatId);

   //manca il richiamo del profilo o la funzione, rivedere.
   //29.11 al momento funziona
   $title = $userMovieprofile->getTitleAndPosterMovieToRating($movieName);
   if ($rating == 2) {
      $text = "Profile update with ".$newNumberOfRatedMovies." rated movies";
   }
   elseif ($newNumberOfRatedMovies > $oldNumberOfRatedMovies) {
   	$text = "You have rated \"".$title."\" movie \nProfile update with ".$newNumberOfRatedMovies." rated movies";
   } else {
   	$text = "Sorry, there was a problem to updating your profile";
   }
   
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
   
   $userMovieprofile->handle();
   
/*   if ($newNumberOfRatedMovies >= 3) {
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $text = "Do you want evaluate another movie? \n Type profile"; 
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
   }
   else{
      $userMovieprofile->handle();
   }*/



}