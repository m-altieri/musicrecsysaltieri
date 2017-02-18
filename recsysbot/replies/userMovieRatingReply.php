<?php

use Recsysbot\Classes\userProfileAcquisitionByMovie;

function userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile){

   $oldNumberOfRatedMovies = getNumberRatedMovies($chatId);
   $pagerankCicle = getNumberPagerankCicle($chatId);
   $movieName = lastMovieToRating($chatId, $pagerankCicle);
   $userMovieprofile->setMovieToRating($movieName);
   file_put_contents("php://stderr", "out if - userMovieRatingReply - movieName: ".$movieName." - rating: ".$rating.PHP_EOL);

   if ($movieName !== "null" && $rating !== "null" ) {
      file_put_contents("php://stderr", "in if - userMovieRatingReply - movieName: ".$movieName." - rating: ".$rating.PHP_EOL);
      $data = $userMovieprofile->putUserMovieToRating($chatId, $movieName, $rating);
      $newNumberOfRatedMovies = getNumberRatedMovies($chatId);

      //manca il richiamo del profilo o la funzione, rivedere.
      //29.11 al momento funziona
      $title = $userMovieprofile->getTitleAndPosterMovieToRating($movieName);

      $needNumberOfRatedMovies = 3 - $newNumberOfRatedMovies;
      if ($needNumberOfRatedMovies > 0) {

         if ($rating == 2) {
            $text = "You have skipped\n \"".$title."\" movie.\nI need ".$needNumberOfRatedMovies." more ratings 😉";
         }
         elseif ($newNumberOfRatedMovies > $oldNumberOfRatedMovies) {
            $text = "You have rated \"".$title."\" movie \nI need ".$needNumberOfRatedMovies." more ratings 😉";
         } 
         else {
            $text = "I need ".$needNumberOfRatedMovies." more ratings 😉";
         }

      } 
      else {

         if ($rating == 2) {
            $text = "You have skipped\n \"".$title."\" movie.";
         }
         elseif ($newNumberOfRatedMovies > $oldNumberOfRatedMovies) {
            $text = "You have rated \"".$title."\" movie \nProfile update with ".$newNumberOfRatedMovies." rated movies";
         } 
         else {
            $text = "You have rated ".$newNumberOfRatedMovies." movies";
         }

      }
      
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);

   }
      
   $userMovieprofile->handle();
   

}