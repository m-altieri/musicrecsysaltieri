<?php

use Recsysbot\Classes\userProfileAcquisitionByMovie;

function userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile){

   $pagerankCicle = getNumberPagerankCicle($chatId);
   $reply = movieToRatingSelected($chatId, $pagerankCicle);
   $movieName = $reply[1];
   $userMovieprofile->setUserMovieToRating($movieName);

   //prendo l'ultimo film accettato per capire se è stato valutato
   $replyAccept = acceptRecMovieToRatingSelected($chatId, $pagerankCicle);
   $acceptRecMovieName = $replyAccept[1];

   if ($movieName !== "null" && $rating !== "null" ) {

      $oldNumberOfRatedMovies = getNumberRatedMovies($chatId);
      $data = $userMovieprofile->putUserMovieRating($chatId, $movieName, $rating);

      //se sono uguali, sto valutando un film accettato -> inserisci la valutazione
      if (strcasecmp($movieName,$acceptRecMovieName) == 0) {
         $userMovieprofile->putUserAcceptRecMovieRating($chatId, $acceptRecMovieName, $rating);
      }
      
      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId);

      $needNumberOfRatedMovies = 3 - ($numberRatedProperties + $numberRatedMovies);

      //manca il richiamo del profilo o la funzione, rivedere.
      //Credo sia tutto ok
      $title = $userMovieprofile->getTitleAndPosterMovieToRating($movieName);
      

      if ($needNumberOfRatedMovies > 0) {

         if ($rating == 2) {
            $text = "You skipped\n \"".$title."\" movie.\nI need ".$needNumberOfRatedMovies." more ratings 😉";
         }
         elseif ($numberRatedMovies > $oldNumberOfRatedMovies) {
            $text = "You have rated \"".$title."\" movie \nI need ".$needNumberOfRatedMovies." more ratings 😉";
         } 
         else {
            $text = "I need ".$needNumberOfRatedMovies." more ratings 😉";
         }

      } 
      else {

         if ($rating == 2) {
            $text = "You skipped\n \"".$title."\" movie.";
         }
         elseif ($numberRatedMovies > $oldNumberOfRatedMovies) {
            $text = "You have rated \"".$title."\" movie \nProfile update with ".$numberRatedMovies." rated movies";
         } 
         else {
            $text = "You have rated ".$numberRatedMovies." movies";
         }

      }
      
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);

   }
   
   $movieName = $userMovieprofile->getAndSetUserMovieToRating($chatId);
   $userMovieprofile->putMovieToRating($movieName);
   $userMovieprofile->handle();
   

}