<?php

function userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange){  

   file_put_contents("php://stderr", "userPropertyValueRatingReply...".PHP_EOL);
   file_put_contents("php://stderr", "propertyType:".$propertyType.PHP_EOL);
   file_put_contents("php://stderr", "propertyValue:".$propertyName.PHP_EOL);    
   file_put_contents("php://stderr", "rating:".$rating.PHP_EOL);     

   if ($propertyType !== "null" && $propertyName !== "null" ) {

      $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
      $data = putPropertyRating($chatId, $propertyType, $propertyName, $rating, $lastChange);
      
      $newNumberOfRatedProperties = $data;

      $needNumberOfRatedProperties = 3 - $newNumberOfRatedProperties;
      if ($needNumberOfRatedProperties > 0) {

         if ($rating == 2) {
            $text = "You have rated Indifferent \"".ucwords($propertyName)."\"\nI need ".$needNumberOfRatedProperties." more ratings 😉";
         } 
         elseif ($newNumberOfRatedProperties > $oldNumberOfRatedProperties) {
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
         elseif ($newNumberOfRatedProperties > $oldNumberOfRatedProperties) {
            $text = "You have rated \"".ucwords($propertyName)."\"\nProfile update with ".$newNumberOfRatedProperties." rated properties";
         } 
         else{
            //Fare un controllo se si è aggiornato il rating della property
            $text = "You have rated ".$newNumberOfRatedProperties." properties";
         }

      }

      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   }

   $numberRatedMovies = getNumberRatedMovies($chatId);
   $numberRatedProperties = getNumberRatedProperties($chatId); 
   if ($numberRatedMovies >= 3 || $numberRatedProperties >= 3){

      
      $text = "Do you prefer to tell me something else about you \nor can I recommend you a movie?";

      $pagerankCicle = getNumberPagerankCicle($chatId);
      $movie = oldMovieToRefine($chatId, $pagerankCicle);
      file_put_contents("php://stderr", "Let me change other properties of: ".$replyText.PHP_EOL);    
      if ($movie !== "null") {
         $keyboard = [
                        ["✔ Recommend me a movie"],
                        ["🔎 Let me change other properties of "."\"".ucwords($movie)."\""],
                        ["🔴 Let me choose additional properties"],
                        ['🔵 Let me choose some movies']
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

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);

}
