<?php

function userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange){  

   //file_put_contents("php://stderr", "userPropertyValueRatingReply...".PHP_EOL);
   //file_put_contents("php://stderr", "propertyType:".$propertyType.PHP_EOL);
   //file_put_contents("php://stderr", "propertyValue:".$propertyName.PHP_EOL);    
   //file_put_contents("php://stderr", "rating:".$rating.PHP_EOL);     

   if ($propertyType !== "null" && $propertyName !== "null" ) {

      $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
      $data = putPropertyRating($chatId, $propertyType, $propertyName, $rating, $lastChange);
      
      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId); 

      $needNumberOfRatedProperties = 3 - ($numberRatedProperties + $numberRatedMovies);

      file_put_contents("php://stderr", "numberRatedProperties:".$numberRatedProperties.PHP_EOL);
      file_put_contents("php://stderr", "numberRatedMovies:".$numberRatedMovies.PHP_EOL);
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
            $text = "You have rated \"".ucwords($propertyName)."\"\nProfile update with ".$numberRatedProperties." rated properties";
         } 
         else{
            //Fare un controllo se si è aggiornato il rating della property
            $text = "You have rated ".$numberRatedProperties." properties";
         }

      }

      //echo '<pre>'; print_r($text); echo '</pre>';

      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   }


   $numberRatedMovies = getNumberRatedMovies($chatId);
   $numberRatedProperties = getNumberRatedProperties($chatId);
   $needNumberOfRatedProperties = 3 - ($numberRatedProperties + $numberRatedMovies);

   if ($needNumberOfRatedProperties <= 0) {

      
      $text = "Do you prefer to tell me something else about you \nor can I recommend you a movie?";

      $pagerankCicle = getNumberPagerankCicle($chatId);
      $replyOld = oldRecMovieToRefineSelected($chatId, $pagerankCicle);
      $movie = $replyOld[1];
      file_put_contents("php://stderr", "Let me rate other properties of: ".$movie.PHP_EOL);    
      if ($movie !== "null") {
         $keyboard = [
                        ["🌐 Recommend Movies"],
                        ["🔎 Rate other properties of "."\"".ucwords($movie)."\""],
                        ["🔴 Rate additional movie properties"],
                        ["🔵 Rate movies"],
                        ["👤 Profile"]
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
