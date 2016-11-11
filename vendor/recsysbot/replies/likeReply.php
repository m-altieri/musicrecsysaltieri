<?php

use Vendor\Recsysbot\Commands\ProfileCommand;

function likeReply($telegram, $chatId){
   
	$profile = new ProfileCommand();
   $userID = $profile->getUserID();
   $movieName = $profile->getUserMovieToRating($userID);
   $title = $profile->getTitleAndPosterMovieToRating($movieName);
   print_r ("Movie: ".$title."<br>");
   $rating = "1";
   $result = $profile->putUserMovieToRating($userID, $movieName, $rating);
   print_r ("Put Result: ".$result."<br>");
   if ($result == "ok") {
   	$text = "You like ".$title." movie \nProfile update ".$result;
   } else {
   	$text = "Sorry, there was a problem to updating your profile";
   }
   
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
}