<?php

//use Vendor\Recsysbot\Commands\ProfileCommand;

function switchText($telegram, $chatId, $text){
   $textSorry ="Sorry :) \nI don't understand \nPlease enter a command (es.\"/start\") ";
   $textWorkInProgress = "Sorry :) \nWe are developing this functionality \nSoon will be available ;)";

   switch ($text) { 
      case "/start": case "/help": case "/info": case "/profile":       
         $telegram->commandsHandler(true);
         break;
      case "menu": case "<-": case strpos($text, '🔴'):
         menuReply($telegram, $chatId);
         break;
      case "->":   case strpos($text, '🔎'):
         fullMenuReply($telegram, $chatId);
         break;
      case "/no": case "no":            
         noReply($telegram, $chatId);
         break;
/*      case "/profile": case "profile":
         updateUserProfileReply($telegram, $chatId);
         break;*/
      case "/directors": case "directors": case "director":            
         $propertyType = "director";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/starring": case "starring": case "actor":
         $propertyType = "starring";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/categories": case "categories": case "category":
         $propertyType = "category";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/genres": case "genres": case "genre":
         $propertyType = "genre";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/writers": case "writers": case "writer":
         $propertyType = "writer";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/producers": case "producers": case "producer":
         $propertyType = "producer";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/releaseYear": case "release year": case "releaseyear":
         $propertyType = "releaseYear";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/musiccomposer": case "music composers": case "music composer": case "music":
         $propertyType = "musicComposer";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/runtime": case "runtime": case "runtimeRange":
         $propertyType = "runtimeRange";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/cinematographies": case "cinematographies": case "cinematography":
         $propertyType = "cinematography";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/based on": case "based on": case "basedOn":
         $propertyType = "basedOn";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/editings": case "editings": case "editing":
         $propertyType = "editing";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case "/distributors": case "distributors": case "distributor":
         $propertyType = "distributor";
         propertyReply($telegram, $chatId, $propertyType);
         break;
      case strpos($text, '📽'):
         $propertyType = "director";
         $propertyValue = $text;
         //TODO questa modifica andrà fatta a tutti
         otherPropertyReply($telegram, $chatId, $propertyType, $propertyValue);
         //getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕴'):
         $propertyType = "starring";
         $propertyValue = $text;
         //TODO questa modifica andrà fatta a tutti
         otherPropertyReply($telegram, $chatId, $propertyType, $propertyValue);
         //getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📼'):
         $propertyType = "category";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎬'):
         $propertyType = "genre";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🖊'):
         $propertyType = "writer";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💰'):
         $propertyType = "producer";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🗓'):
         $propertyType = "releaseYear";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🎼'):
         $propertyType = "musicComposer";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🕰'):
         $propertyType = "runtimeRange";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);         
         break;
      case strpos($text, '📷'):
         $propertyType = "cinematography";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '📔'):
         $propertyType = "basedOn";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '💼'):
         $propertyType = "editing";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🏢'):
         $propertyType = "distributor";
         $propertyValue = $text;
         getFilmsToReply($telegram, $chatId, $propertyType, $propertyValue);
         break;
      case strpos($text, '🔵'):
         getFilmsToReplyTop5($telegram, $chatId);
         break;
      case strpos($text, '✔'):
         $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textWorkInProgress]);
         break;
      case strpos($text, '👍'):
         $rating = 1;
         profileReply($telegram, $chatId, $rating);
         menuReply($telegram, $chatId);
         break;
      case strpos($text, '👎'):
         $rating = 0;
         profileReply($telegram, $chatId, $rating);
         menuReply($telegram, $chatId);
         break;
      case strpos($text, '🗯'):
         $rating = 2;
         profileReply($telegram, $chatId, $rating);
         menuReply($telegram, $chatId);
         break;
      case strpos($text, '🏁'):
         acceptRecommendationReply($telegram, $chatId);
         break;
      case strpos($text, '💬'):
         //Why have I received this recommendation?
         $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textWorkInProgress]);
         break;
      case strpos($text, '🔍'):
         //I want to refine the recommendation
         refineRecommendationReply($telegram, $chatId);
         fullMenuReply($telegram, $chatId);
         break;
      case strpos($text, '🔙'):
         //Return to the list of recommended movies
         $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textWorkInProgress]);
         break;
      case ($text[0] != "/"):
         //$propertyType = isset($propertyType) ? $propertyType : "";
         //$propertyValue = isset($propertyValue) ? $propertyValue : "";
         //$telegram->sendMessage(['chat_id' => $chatId, 'text' => $textSorry]);
         //getFilmDetail($telegram, $chatId, $propertyType, $propertyValue, $text);
         getFilmDetail($telegram, $chatId, $text);
         break;
      default:
         //$propertyTypeOld = $propertyType;
         //$propertyValueOld = $propertyValue;
         break;
      }
   }
