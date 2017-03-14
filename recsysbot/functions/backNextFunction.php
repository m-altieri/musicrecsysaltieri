<?php 

use Recsysbot\Classes\userMovieRecommendation;

function backNextFunction($telegram, $chatId, $messageId, $text, $botName, $date, $userMovieRecommendation){
   //Return to the list of recommended movies
   //Pensare a come non mandare sempre in esecuzione il pagerank per recuperare la lista

   switch ($text) {
      //Vai a una delle pagine dei film raccomandati
      case stristr($text, '1') !== false:  
      case stristr($text, '2') !== false: 
      case stristr($text, '3') !== false: 
      case stristr($text, '4') !== false: 
      case stristr($text, '5') !== false: 
         $context = "backNextFunctionSelected";
         $replyText = $text;
         $replyFunctionCall = "userMovieRecommendationInstance"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         $userMovieRecommendation->setPage($text);
         $userMovieRecommendation->handle();
         break;
      default:
      //Vai al full menu delle properties
         $context = "backNextFunctionSelected";
         $replyText = $text;
         $replyFunctionCall = "allPropertyTypeReply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         allPropertyTypeReply($telegram, $chatId);
         break;
      }

}