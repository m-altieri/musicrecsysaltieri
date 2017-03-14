<?php

use Recsysbot\Classes\userMovieRecommendation;

function recMovieRatingReply($telegram, $chatId, $rating, $userMovieRecommendation){

   $pagerankCicle = getNumberPagerankCicle($chatId);

   if ($rating == 1) {
      $reply = likeRecMovieSelected($chatId, $pagerankCicle);
      $movie = $reply[1];
      $userMovieRecommendation->setUserRecMovieToRating($movie);
      $userMovieRecommendation->putUserRecMovieRating($chatId, $movie, $rating);
      //putRecMovieRating($chatId, $movieURI, $rating, $position, $pagerank_cicle, $refineRefocus, $botName, $message_id, $bot_timestamp, $recommendatinsList, $ratingsList, $number_recommendation_list)
      $text = "You Like";
   } elseif ($rating == 0) {
      $reply = dislikeRecMovieSelected($chatId, $pagerankCicle);
      $movie = $reply[1];
      $userMovieRecommendation->setUserRecMovieToRating($movie);
      $userMovieRecommendation->putUserRecMovieRating($chatId, $movie, $rating);
      //putRecMovieRating($chatId, $movieURI, $rating, $position, $pagerank_cicle, $refineRefocus, $botName, $message_id, $bot_timestamp, $recommendatinsList, $ratingsList, $number_recommendation_list)
      $text = "You Dislike";
   }
   
   $title = $userMovieRecommendation->getTitleAndPosterRecMovieToRating($movie);

   $text .= $text." \"".$title."\" movie 😉";
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
   
   $page = $userMovieRecommendation->getPageFromMovieName($chatId,$movie);
   $page = $page+1;
   backNextFunction($telegram, $chatId, $page, $userMovieRecommendation);

   

}