<?php

function userPropertyValueRatingReply($telegram, $chatId, $propertyType, $propertyName, $rating, $lastChange){  

   file_put_contents("php://stderr", "userPropertyValueRatingReply...".PHP_EOL);
   file_put_contents("php://stderr", "propertyType:".$propertyType.PHP_EOL);
   file_put_contents("php://stderr", "propertyValue:".$propertyName.PHP_EOL);    
   file_put_contents("php://stderr", "rating:".$rating.PHP_EOL);     

   if ($propertyType != "null" && $propertyName != "null" ) {

      $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
      $data = putPropertyRating($chatId, $propertyType, $propertyName, $rating, $lastChange);
      
      $newNumberOfRatedProperties = $data;

      if ($newNumberOfRatedProperties > $oldNumberOfRatedProperties) {
         $text = "You have rated \"".ucwords($propertyName)."\"\nProfile update with ".$newNumberOfRatedProperties." rated properties";
      } elseif ($rating == 2) {
         $text = "You have rated \"".ucwords($propertyName)."\"\nProfile update with ".$newNumberOfRatedProperties." rated properties";
      } else{
         $text = "Sorry, there was a problem to updating your profile";
      }
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   }

   $text = "Do you prefer to tell me something else about you \nor can I recommend you a movie?";

   $keyboard = [
      ["✔ Recommend me a movie"],
      ["🔎 Let me choose additional properties"]
   ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);

//🎞🎲📼📺🚩🔍🔎🌐🔄✔️🔃☑️🔘⚪️⚫️🔴
}