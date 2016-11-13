<?php

use Vendor\Recsysbot\Commands\ProfileCommand;

function profileReply($telegram, $chatId, $rating){
   
	$profile = new ProfileCommand();
   //$profile->setChatId($chatId);
	
   
   //$userID = $profile->getUserID();
   //$userID = $chatId;
   $userID = 6;
   $oldNumberOfRatedMovies = $profile->getNumberOfRatedMovies($userID);
   $movieName = $profile->getUserMovieToRating($userID);

   $result = $profile->putUserMovieToRating($userID, $movieName, $rating);

   $newNumberOfRatedMovies = $profile->getNumberOfRatedMovies($userID);

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