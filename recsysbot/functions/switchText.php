<?php

use Recsysbot\Commands\ProfileCommand;
use Recsysbot\Classes\UserProfileAcquisitionByMovie;

function switchText($telegram, $chatId, $text, $firstname){
   $textSorry ="Sorry :) \nI don't understand \nPlease enter a command (es.\"/start\") ";
   $textWorkInProgress = "Sorry :) \nWe are developing this functionality \nSoon will be available ;)";

   switch ($text) { 
      case "/start": case "/help": case "/info":      
         $telegram->commandsHandler(true);
         break;
      case strpos($text, 'profile'): case strpos($text, '/profile'): 
         $profile = new UserProfileAcquisitionByMovie($telegram, $chatId, $text);
         $profile->handle();
         break;
      case "menu": case "<-": case strpos($text, '🔴'):
         basePropertyTypeReply($telegram, $chatId);
         break;
      case "->":   case strpos($text, '🔎'):
         allPropertyTypeReply($telegram, $chatId);
         break;
      case "/no": case "no":            
         noReply($telegram, $chatId);
         break;
      case "/reset":         
         resetPropertyValueRatingReply($telegram, $chatId, $firstname);
         break;
      case strpos($text, '/directors'): case strpos($text, 'directors'): case strpos($text, 'director'):            
         $propertyType = "director";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/starring'): case strpos($text, 'starring'): case strpos($text, 'actor'): case strpos($text, 'actors'):
         $propertyType = "starring";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/categories'): case strpos($text, 'categories'): case strpos($text, 'category'):
         $propertyType = "category";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/genres'): case strpos($text, 'genres'): case strpos($text, 'genre'):
         $propertyType = "genre";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/writers'): case strpos($text, 'writers'): case strpos($text, 'writer'):
         $propertyType = "writer";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/producers'): case strpos($text, 'producers'): case strpos($text, 'producer'):
         $propertyType = "producer";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/releaseYear'): case strpos($text, 'release year'): case strpos($text, 'releaseyear'):
         $propertyType = "releaseYear";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/musiccomposer'): case strpos($text, 'music composers'): case strpos($text, 'music composer'): case strpos($text, 'music'):
         $propertyType = "musicComposer";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/runtime'): case strpos($text, 'runtime'): case strpos($text, 'runtimeRange'):
         $propertyType = "runtimeRange";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/cinematographies'): case strpos($text, 'cinematographies'): case strpos($text, 'cinematography'):
         $propertyType = "cinematography";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/based on'): case strpos($text, 'based on'): case strpos($text, 'basedOn'):
         $propertyType = "basedOn";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/editings'): case strpos($text, 'editings'): case strpos($text, 'editing'):
         $propertyType = "editing";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '/distributors'): case strpos($text, 'distributors'): case strpos($text, 'distributor'):
         $propertyType = "distributor";
         propertyValueReply($telegram, $chatId, $propertyType, $text);
         break;
      case strpos($text, '📽'):
         $propertyType = "director";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕴'):
         $propertyType = "starring";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📼'):
         $propertyType = "category";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎬'):
         $propertyType = "genre";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🖊'):
         $propertyType = "writer";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💰'):
         $propertyType = "producer";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🗓'):
         $propertyType = "releaseYear";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎼'):
         $propertyType = "musicComposer";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕰'):
         $propertyType = "runtimeRange";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);         
         break;
      case strpos($text, '📷'):
         $propertyType = "cinematography";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📔'):
         $propertyType = "basedOn";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💼'):
         $propertyType = "editing";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🏢'):
         $propertyType = "distributor";
         $propertyValue = $text;
         propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue);
         // movieListFromPropertyValueReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🔵'):
         movieListTop5Reply($telegram, $chatId);
         break;
      case strpos($text, '✔'):
         movieListTop5Reply($telegram, $chatId);
         break;
      case strpos($text, '🔙'): 
         //Return to the list of recommended movies
         //Pensare a come non mandare sempre in esecuzione il pagerank per recuperare la lista
         $reply = explode("\"", $text);
         $propertyType = $reply[1];
         file_put_contents("php://stderr", "propertyType: ".$propertyType.PHP_EOL);       
         if ($propertyType == "movies") {
            movieListTop5Reply($telegram, $chatId);
         }
         elseif ($propertyType == "properties") {
            allPropertyTypeReply($telegram, $chatId);
         }
         elseif ($propertyType == "property") {
            $textRefine = "to \"".$reply[3]."\"";
            file_put_contents("php://stderr", "return ".$textRefine.PHP_EOL); 
            refineMoviePropertyReply($telegram, $chatId, $textRefine);
         }
         else{
            $textRefine = null;
            propertyValueReply($telegram, $chatId, $propertyType, $textRefine);
         } 
         break;
      case strpos($text, '👍'):
         $rating = 1;
         profileReply($telegram, $chatId, $rating);
         basePropertyTypeReply($telegram, $chatId);
         break;
      case strpos($text, '👎'):
         $rating = 0;
         profileReply($telegram, $chatId, $rating);
         basePropertyTypeReply($telegram, $chatId);
         break;
      case strpos($text, '🗯'):
         $rating = 2;
         profileReply($telegram, $chatId, $rating);
         basePropertyTypeReply($telegram, $chatId);
         break;
      case strpos($text, '😃'):
         $rating = 1;
         $reply = explode("\"", $text);
         $propertyName = $reply[1];
         $propertyType = $reply[3];
         file_put_contents("php://stderr", "propertyValueRatingReply - rating:".$rating.PHP_EOL); 
         file_put_contents("php://stderr", "propertyType:".$propertyType.PHP_EOL);
         file_put_contents("php://stderr", "propertyValue:".$propertyName.PHP_EOL);               
         otherPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating);
         break;
      case strpos($text, '😑'):
         $rating = 0;
         $reply = explode("\"", $text);
         $propertyValue = $reply[1];
         $propertyType = $reply[3];
         file_put_contents("php://stderr", "propertyValueRatingReply - rating:".$rating.PHP_EOL); 
         file_put_contents("php://stderr", "propertyType:".$propertyType.PHP_EOL);
         file_put_contents("php://stderr", "propertyValue:".$propertyValue.PHP_EOL);              
         otherPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue, $rating);
         break;
      case strpos($text, '🤔'):
         $rating = 2;   
         $reply = explode("\"", $text);
         $propertyValue = $reply[1];
         $propertyType = $reply[3];
         file_put_contents("php://stderr", "propertyValueRatingReply - rating:".$rating.PHP_EOL); 
         file_put_contents("php://stderr", "propertyType:".$propertyType.PHP_EOL);
         file_put_contents("php://stderr", "propertyValue:".$propertyValue.PHP_EOL);               
         otherPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue, $rating);
         break;
      case strpos($text, '🏁'):
         acceptRecommendationReply($telegram, $chatId, $firstname);
         break;
      case strpos($text, '💬'):
         //Why have I received this recommendation?
         $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textWorkInProgress]);
         break;
      case strpos($text, '🔍'):
         //I want to refine the recommendation
         refineMoviePropertyReply($telegram, $chatId, $text);
         break;
      case ($text[0] != "/"):
         //$propertyType = isset($propertyType) ? $propertyType : "";
         //$propertyValue = isset($propertyValue) ? $propertyValue : "";
         //$telegram->sendMessage(['chat_id' => $chatId, 'text' => $textSorry]);
         //movieDetailReply($telegram, $chatId, $propertyType, $propertyValue, $text);
         movieDetailReply($telegram, $chatId, $text);
         break;
      default:
         break;
      }
   }
