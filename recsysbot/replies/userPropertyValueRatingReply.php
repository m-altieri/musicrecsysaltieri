<?php
use GuzzleHttp\Client;

function userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange){  

   if ($propertyType !== "null" && $propertyName !== "null" ) {

      $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
      $data = putPropertyRating($chatId, $propertyType, $propertyName, $rating, $lastChange);
      
      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId); 

      $needNumberOfRatedProperties = 3 - ($numberRatedProperties + $numberRatedMovies);

      file_put_contents("php://stderr", "needNumberOfRatedProperties:".$needNumberOfRatedProperties.PHP_EOL);      

      if ($needNumberOfRatedProperties > 0 ) {  

         if ($rating == 2) {
            $text = "You have rated Indifferent \"".ucwords($propertyName)."\"\nI need ".$needNumberOfRatedProperties." more ratings 😉";
         } 
         elseif ($numberRatedProperties > $oldNumberOfRatedProperties) {
            $text = "You have rated \"".ucwords($propertyName)."\"\nI need ".$needNumberOfRatedProperties." more ratings 😉"; 
         } 
         else{
            //Fare un controllo se si è aggiornato il rating della property
            $text = "I need ".$needNumberOfRatedProperties." more ratings 😉";
         }

      }
      else{

         if ($rating == 2) {
            $text = "You have rated Indifferent \"".ucwords($propertyName)."\"";
         } 
         elseif ($numberRatedProperties > $oldNumberOfRatedProperties) {
            $text = "You have rated \"".ucwords($propertyName)."\"\nProfile updated with ".$numberRatedProperties." rated properties";
         } 
         else{
            //Fare un controllo se si è aggiornato il rating della property
            $text = "You have rated ".$numberRatedProperties." properties";
         }

      }

      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   }

      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId); 

      $needNumberOfRatedProperties = 3 - ($numberRatedProperties + $numberRatedMovies);

   if ($needNumberOfRatedProperties <= 0) {

      $pagerankCicle = getNumberPagerankCicle($chatId);
      $movie = oldRecMovieToRefineSelected($chatId, $pagerankCicle);
      
      $text = "Do you prefer rate other properties of "."\"".ucwords($movie)."\" \nor Back to movies?";
   
      if ($movie !== "null") {
         $keyboard = [
                        ["🔎 Rate other properties of "."\"".ucwords($movie)."\""],
                        ["🔙 Back to Movies"]
                    ];
      } 
      else {
         $keyboard = userPropertyValueKeyboard();
      }
      
      
   }
   else{
      $text = "Do you want tell me something else about you?";
      $keyboard = startProfileAcquisitionKeyboard();
   }

   // echo '<pre>'; print_r($text); echo '</pre>';
   // echo '<pre>'; print_r($keyboard); echo '</pre>';

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup]);

}
