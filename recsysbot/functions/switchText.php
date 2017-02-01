<?php

use Recsysbot\Classes\userMovieRecommendation;
use Recsysbot\Classes\UserProfileAcquisitionByMovie;
//🎥
//📽
//🎬
//🎞
function switchText($telegram, $chatId, $messageId, $date, $text, $firstname){
   $textSorry ="Sorry :) \nI don't understand \nPlease enter a command (es.\"/start\") ";
   $textWorkInProgress = "Sorry :) \nWe are developing this functionality \nSoon will be available ;)";
   $userMovieprofile = new UserProfileAcquisitionByMovie($telegram, $chatId, $text);
   $userMovieRecommendation = new userMovieRecommendation($telegram, $chatId, $messageId, $date, $text);

   switch ($text) { 
      case strpos($text, '/start'): case strpos($text, '/help'): case strpos($text, '/info'): case strpos($text, '/reset'):    
         $telegram->commandsHandler(true);
         break;
      case strpos($text, 'preferences'): case strpos($text, 'start'):
         startProfileAcquisitioReply($telegram, $chatId);        
         break;
      case "menu": case "<-": case strpos($text, '🔴'):
         basePropertyTypeReply($telegram, $chatId);
         break;
      case strpos($text, '🔵'):
         $userMovieprofile->handle();
         //userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile);
         //recommendationMovieListTop5Reply($telegram, $chatId);
         break;
      case stristr($text, '👈') !== false: case stristr($text, '👉') !== false:
         //allPropertyTypeReply($telegram, $chatId);
         backNextFunction($telegram, $chatId, $text, $userMovieRecommendation);
         break;
      case "/no": case "no":            
         noReply($telegram, $chatId);
         break;
      case strpos($text, '/directors'): case strpos($text, 'directors'): case strpos($text, 'director'):            
         $propertyType = "director";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/starring'): case strpos($text, 'starring'): case strpos($text, 'actor'): case strpos($text, 'actors'):
         $propertyType = "starring";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/categories'): case strpos($text, 'categories'): case strpos($text, 'category'):
         $propertyType = "category";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/genres'): case strpos($text, 'genres'): case strpos($text, 'genre'):
         $propertyType = "genre";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/writers'): case strpos($text, 'writers'): case strpos($text, 'writer'):
         $propertyType = "writer";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/producers'): case strpos($text, 'producers'): case strpos($text, 'producer'):
         $propertyType = "producer";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/releaseYear'): case strpos($text, 'release year'): case strpos($text, 'releaseyear'):
         $propertyType = "releaseYear";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/musiccomposer'): case strpos($text, 'music composers'): case strpos($text, 'music composer'): case strpos($text, 'music'):
         $propertyType = "musicComposer";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/runtime'): case strpos($text, 'runtime'): case strpos($text, 'runtimeRange'): case strpos($text, 'runtimerange'): case strpos($text, 'runtime range'):
         $propertyType = "runtimeRange";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/cinematographies'): case strpos($text, 'cinematographies'): case strpos($text, 'cinematography'):
         $propertyType = "cinematography";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/based on'): case strpos($text, 'based on'): case strpos($text, 'basedOn'):
         $propertyType = "basedOn";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/editings'): case strpos($text, 'editings'): case strpos($text, 'editing'): case strpos($text, 'editor'): case strpos($text, 'editors'):
         $propertyType = "editing";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/distributors'): case strpos($text, 'distributors'): case strpos($text, 'distributor'):
         $propertyType = "distributor";
         $replyFunctionCall = "lastPropertyType";  //propertyValueReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '🎬'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('🎬', 'director,', $text); // Replaces all 🎬 with propertyType.
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕴'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('🕴', 'starring,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📼'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('📼', 'category,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎞'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('🎞', 'genre,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🖊'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('🖊', 'writer,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💰'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('💰', 'producer,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🗓'):
      $text = clearLastPropertyTypeAndPropertyName($text);
      $text = str_replace('🗓', 'releaseYear,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎼'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('🎼', 'musicComposer,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕰'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace("under ", "", $text);
         $text = str_replace(" minutes", "", $text);
         $text = str_replace('🕰', 'runtimeRange,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);         
         break;
      case strpos($text, '📷'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('📷', 'cinematography,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📔'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('📔', 'basedOn,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💼'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('💼', 'editing,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🏢'):
         $text = clearLastPropertyTypeAndPropertyName($text);
         $text = str_replace('🏢', 'distributor,', $text);
         $replyFunctionCall = "lastPropertyTypeAndPropertyName"; //propertyValueRatingReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId, $pagerankCicle);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🔙'): 
         backFunction($telegram, $chatId, $text);
         break;
      case strpos($text, '👍'):
         $rating = 1;
         userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile);
         break;
      case strpos($text, '👎'):
         $rating = 0;
         userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile);
         break;
      case strpos($text, '💬'):
         $rating = 2;
         userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile);
         break;
      case strpos($text, '😃'):
         $rating = 1;
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $reply = lastPropertyTypeAndPropertyName($chatId, $pagerankCicle);
         $propertyType = $reply[0];
         $propertyName = $reply[1];
         $lastChange = "user";        
         userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange);
         break;
      case strpos($text, '😑'):
         $rating = 0;
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $reply = lastPropertyTypeAndPropertyName($chatId, $pagerankCicle);
         $propertyType = $reply[0];
         $propertyName = $reply[1];
         $lastChange = "user";                 
         userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange);
         break;
      case strpos($text, '🤔'):
         $rating = 2;
         $pagerankCicle = getNumberPagerankCicle($chatId);   
         $reply = lastPropertyTypeAndPropertyName($chatId, $pagerankCicle);
         $propertyType = $reply[0];
         $propertyName = $reply[1];
         $lastChange = "user";                     
         userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange);
         break;
      case strpos($text, '🏁'):
         acceptRecommendationReply($telegram, $chatId, $firstname);
         break;
      case strpos($text, '💭'):
         //Why have I received this recommendation?
         //$telegram->sendMessage(['chat_id' => $chatId, 'text' => $textWorkInProgress]);
         explanationMovieReply($telegram, $chatId);
         break;
      case strpos($text, '✔'): case stristr($text, 'rec') !== false: case stristr($text, 'run') !== false:
/*         $replyFunctionCall = "oldMovieToRefine"; //recommendationMovieListTop5Reply
         $pagerankCicle = getNumberPagerankCicle($chatId);         
         $replyText = lastMovieToRefine($chatId, $pagerankCicle);
         if ($replyText !== "null") {
            $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $replyText, $updatePagerankCicle, $date);
            $updatePagerankCicle = $pagerankCicle + 1;            
         } */
         //recommendationMovieListTop5Reply($telegram, $chatId);
         recommendationBackNextMovieReply($telegram, $chatId, $userMovieRecommendation);
         break;
      case strpos($text, '🔍'):
         //I want to refine this recommendation
         $replyFunctionCall = "lastMovieToRefine"; //refineMoviePropertyReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $replyText = lastMovie($chatId, $pagerankCicle);
         if ($replyText !== "null") {
            $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $replyText, $pagerankCicle, $date);
         }  
         callRefineOrRefocusFunction($telegram, $chatId);
         break;
      case strpos($text, '🔎'):
         $replyFunctionCall = "lastMovieToRefine"; //refineMoviePropertyReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $replyText = oldMovieToRefine($chatId, $pagerankCicle);
         if ($replyText !== "null") {
            $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $replyText, $pagerankCicle, $date);
         }
         refineLastMoviePropertyReply($telegram, $chatId);
         break;
      case strpos($text, '👤'): case strpos($text, 'profile'):
         //fare la put dei messaggi
         profileReply($telegram, $chatId);
         break;
      case strpos($text, '📽'):
         $text = str_replace('📽', '', $text);
         $text = clearLastPropertyTypeAndPropertyName($text);         
         $movie = $text;
         // $page = 1;
         // $replyFunctionCall = "lastMovie"; //movieDetailReply
         // $pagerankCicle = getNumberPagerankCicle($chatId);
         // $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $movie, $pagerankCicle, $date); 
         // movieDetailReply($telegram, $chatId, $movie, $page);
         $userMovieprofile->movieRatingReply($movie);
         break;
      case ($text[0] != "/"):
         $text;
         $replyFunctionCall = "findPropertyValueOrMovie"; //movieDetailReply
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         findPropertyValueOrMovieReply($telegram, $chatId, $text);
         break;
      default:
         break;
      }
   }
