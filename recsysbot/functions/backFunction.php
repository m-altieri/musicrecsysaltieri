<?php 

function backFunction($telegram, $chatId, $messageId, $text, $botName, $date){
   //Return to the list of recommended movies
   //Pensare a come non mandare sempre in esecuzione il pagerank per recuperare la lista

	file_put_contents("php://stderr", "back function:".$text.PHP_EOL); 
	switch ($text) {
      //ritorna alla Lista dei 5 film raccomandati
      case stristr($text, 'movies') !== false:
         $context = "backRecMovieListTop5Selected";
         $replyText = $text;
         $replyFunctionCall = "recommendationMovieListTop5Reply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);      

         recommendationMovieListTop5Reply($telegram, $chatId);
         break;
      //ritorna alla home
      case stristr($text, 'home') !== false:    case stristr($text, 'start') !== false:
         $context = "backHomeSelected";
         $replyText = $text;
         $replyFunctionCall = "startProfileAcquisitioReply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         startProfileAcquisitioReply($telegram, $chatId); 
         break;
      //ritorna al full menu delle properties   
      case stristr($text, 'properties') !== false:
         $context = "backFullPropertiesMenuSelected";
         $replyText = $text;
         $replyFunctionCall = "allPropertyTypeReply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         allPropertyTypeReply($telegram, $chatId);
         break;
      //ritorna alle proprietà del film raccomandato da riaffinare
      case stristr($text, 'property')  !== false:
         $reply = explode("\"", $text);
         $textRefine = "to \"".$reply[3]."\"";

         $context = "backRecMovieToRefineSelected";
         $replyText = $text;
         $replyFunctionCall = "refineLastMoviePropertyReply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         refineLastMoviePropertyReply($telegram, $chatId);
         break;
      //ritorna allo short menu delle properties - Rate movie properties
      case stristr($text, 'short') !== false:
         $context = "backRateMoviePropertiesSelected";
         $replyText = $text;
         $replyFunctionCall = "basePropertyTypeReply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         basePropertyTypeReply($telegram, $chatId);
         break;
      //ritorna alla lista dei valori della proprietà considerata
      default:
         $reply = explode(" ", $text);
         $propertyType =$reply[6];
         $textRefine = null;
         $context = "backpropertyTypeSelected";
         $replyText = $propertyType;
         $replyFunctionCall = "propertyValueReply"; 
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $responseType = "button";
         $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

         propertyValueReply($telegram, $chatId, $propertyType, $textRefine);
      	break;
      }



/*   $reply = explode("\"", $text);
   $propertyType = $reply[1];
   file_put_contents("php://stderr", "propertyType: ".$propertyType.PHP_EOL);       
   if ($propertyType == "movies") {
      recommendationMovieListTop5Reply($telegram, $chatId);
   }
   elseif ($propertyType == "properties") {
      allPropertyTypeReply($telegram, $chatId);
   }
   elseif ($propertyType == "property") {
      $textRefine = "to \"".$reply[3]."\"";
      file_put_contents("php://stderr", "return ".$textRefine.PHP_EOL);
      $pagerankCicle = getNumberPagerankCicle($chatId);
      refineMoviePropertyReply($telegram, $chatId, $userMovieRecommendation);
   }
   else{
      $textRefine = null;
      propertyValueReply($telegram, $chatId, $propertyType, $textRefine);
   } */
}