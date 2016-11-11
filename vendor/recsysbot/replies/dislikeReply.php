<?php

use Vendor\Recsysbot\Commands\ProfileCommand;

function dislikeReply($telegram, $chatId){
   
	$profile = new ProfileCommand();
	$oldNumberOfRatedMovies = $profile->getNumberOfRatedMovies($chatId);
   
   $userID = $profile->getUserID();
   $movieName = $profile->getUserMovieToRating($userID);
   $rating = "0";

   $result = $profile->putUserMovieToRating($userID, $movieName, $rating);

   $newNumberOfRatedMovies = $profile->getNumberOfRatedMovies($chatId);

   $title = $profile->getTitleAndPosterMovieToRating($movieName);
   if ($newNumberOfRatedMovies > $oldNumberOfRatedMovies) {
   	$text = "You have rated \"".$title."\" movie \nProfile update with ".$newNumberOfRatedMovies." rated movies";
   } else {
   	$text = "Sorry, there was a problem to updating your profile";
   }
   
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);    
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}
