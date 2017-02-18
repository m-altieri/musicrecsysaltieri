<?php 
 
use GuzzleHttp\Client;

function findPropertyValueOrMovieReply($telegram, $chatId, $userMovieprofile, $name){

	$textSorry ="Sorry :)\nI don't understand \nPlease enter a command \n(es.\"/start\") ";   
   $fullname = str_replace(' ', '_', $name); //tutti gli spazi con undescore
   
   $movieData = getAllPropertyListFromMovie($fullname);

   if ($movieData !== "null") { //se si tratta di un film
      $userMovieprofile->movieRatingReply($fullname);
      //$page = 1;
      //movieDetailReply($telegram, $chatId, $name, $page);
   }
   else{  //se si tratta do una proprietà
      $propertyData = getPropertyTypeListFromPropertyValue($fullname);
      if ($propertyData !== "null") {
         $keyboard = propertyTypeListFromPropertyValueKeyboard($propertyData);
         $text = "Did you mean:";
         $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,'resize_keyboard' => true,'one_time_keyboard' => false]);

         $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
         $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup]);
      }
      else{
         $levDistanceData = levDistanceTop5Keyboards($fullname);
         if ($levDistanceData !== "null") {
            $keyboard = $levDistanceData;
            $text = "Did you mean:";
            $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,'resize_keyboard' => true,'one_time_keyboard' => false]);

            $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
            $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup]);
         } 
         else {
            $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
            $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textSorry]);
         }
      }
   }
}