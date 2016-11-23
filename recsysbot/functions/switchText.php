<?php

use Recsysbot\Classes\UserProfileAcquisitionByMovie;

function switchText($telegram, $chatId, $messageId, $date, $text, $firstname){
   $textSorry ="Sorry :) \nI don't understand \nPlease enter a command (es.\"/start\") ";
   $textWorkInProgress = "Sorry :) \nWe are developing this functionality \nSoon will be available ;)";
   $userMovieprofile = new UserProfileAcquisitionByMovie($telegram, $chatId, $text);

   switch ($text) { 
      case strpos($text, '/start'): case strpos($text, '/help'): case strpos($text, '/info'): case strpos($text, '/reset'):    
         $telegram->commandsHandler(true);
         break;
      case strpos($text, 'profile'): case strpos($text, '/profile'):
         startProfileAcquisitioReply($telegram, $chatId);        
         break;
      case "menu": case "<-": case strpos($text, '🔴'):
         basePropertyTypeReply($telegram, $chatId);
         break;
      case strpos($text, '🔵'):
         $userMovieprofile->handle();
         //userMovieRatingReply($telegram, $chatId, $rating, $userMovieprofile);
         //movieListTop5Reply($telegram, $chatId);
         break;
      case stristr($text, '👉') !== false: case strpos($text, '🔎'):
         allPropertyTypeReply($telegram, $chatId);
         break;
      case "/no": case "no":            
         noReply($telegram, $chatId);
         break;
      case "reset":         
         resetAllPropertyValueRatingReply($telegram, $chatId, $firstname);
         break;
      case strpos($text, '/directors'): case strpos($text, 'directors'): case strpos($text, 'director'):            
         $propertyType = "director";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/starring'): case strpos($text, 'starring'): case strpos($text, 'actor'): case strpos($text, 'actors'):
         $propertyType = "starring";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/categories'): case strpos($text, 'categories'): case strpos($text, 'category'):
         $propertyType = "category";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/genres'): case strpos($text, 'genres'): case strpos($text, 'genre'):
         $propertyType = "genre";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/writers'): case strpos($text, 'writers'): case strpos($text, 'writer'):
         $propertyType = "writer";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/producers'): case strpos($text, 'producers'): case strpos($text, 'producer'):
         $propertyType = "producer";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/releaseYear'): case strpos($text, 'release year'): case strpos($text, 'releaseyear'):
         $propertyType = "releaseYear";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/musiccomposer'): case strpos($text, 'music composers'): case strpos($text, 'music composer'): case strpos($text, 'music'):
         $propertyType = "musicComposer";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/runtime'): case strpos($text, 'runtime'): case strpos($text, 'runtimeRange'):
         $propertyType = "runtimeRange";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/cinematographies'): case strpos($text, 'cinematographies'): case strpos($text, 'cinematography'):
         $propertyType = "cinematography";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/based on'): case strpos($text, 'based on'): case strpos($text, 'basedOn'):
         $propertyType = "basedOn";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/editings'): case strpos($text, 'editings'): case strpos($text, 'editing'):
         $propertyType = "editing";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/distributors'): case strpos($text, 'distributors'): case strpos($text, 'distributor'):
         $propertyType = "distributor";
         $replyFunctionCall = "propertyValueReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $propertyType, $pagerankCicle, $date); 
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '📽'):
         $text = str_replace('📽', 'director,', $text); // Replaces all 📽 with propertyType.
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕴'):
         $text = str_replace('🕴', 'starring,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📼'):
         $text = str_replace('📼', 'category,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎬'):
         $text = str_replace('🎬', 'genre,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🖊'):
         $text = str_replace('🖊', 'writer,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💰'):
         $text = str_replace('💰', 'producer,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🗓'):
      $text = str_replace('🗓', 'releaseYear,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎼'):
         $text = str_replace('🎼', 'musicComposer,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕰'):
         $text = str_replace('🕰', 'runtimeRange,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);         
         break;
      case strpos($text, '📷'):
         $text = str_replace('📷', 'cinematography,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📔'):
         $text = str_replace('📔', 'basedOn,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💼'):
         $text = str_replace('💼', 'editing,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🏢'):
         $text = str_replace('🏢', 'distributor,', $text);
         $replyFunctionCall = "propertyValueRatingReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $text, $pagerankCicle, $date); 
         propertyValueRatingReply($telegram, $chatId);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '✔'):
         movieListTop5Reply($telegram, $chatId);
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
         $reply = lastPropertyTypeAndPropertyName($chatId);
         $propertyType = $reply[0];
         $propertyName = $reply[1];         
         userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating);
         break;
      case strpos($text, '😑'):
         $rating = 0;
         $reply = lastPropertyTypeAndPropertyName($chatId);
         $propertyType = $reply[0];
         $propertyName = $reply[1];         
         userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue, $rating);
         break;
      case strpos($text, '🤔'):
         $rating = 2;   
         $reply = lastPropertyTypeAndPropertyName($chatId);
         $propertyType = $reply[0];
         $propertyName = $reply[1];             
         userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue, $rating);
         break;
      case strpos($text, '🏁'):
         acceptRecommendationReply($telegram, $chatId, $firstname);
         break;
      case strpos($text, '💭'):
         //Why have I received this recommendation?
         $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textWorkInProgress]);
         break;
      case strpos($text, '🔍'):
         //I want to refine this recommendation
         refineMoviePropertyReply($telegram, $chatId);
         break;
      case ($text[0] != "/"):
         $movie = $text;
         $replyFunctionCall = "movieDetailReply";
         $pagerankCicle = 0;
         $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $movie, $pagerankCicle, $date); 
         movieDetailReply($telegram, $chatId, $movie);
         break;
      default:
         break;
      }
   }
