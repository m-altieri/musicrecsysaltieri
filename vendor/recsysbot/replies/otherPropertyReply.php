<?php

function otherPropertyReply($telegram, $chatId, $propertyType, $propertyValue){   

   $userID = 6;
   $rating = 1;
   $propertyName = substr($propertyValue,5);

   $result = putPropertyRating($userID, $propertyType, $propertyName, $rating);
   $oldNumberOfRatedMovies = 0;
   $newNumberOfRatedMovies = $result;

   if ($newNumberOfRatedMovies > $oldNumberOfRatedMovies) {
      $text = "You have rated \"".$propertyValue."\" property \nProfile update with ".$newNumberOfRatedMovies." rated properties";
   } else {
      $text = "Sorry, there was a problem to updating your profile";
   }
   
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 

   //$text = "You've chosen \"".$propertyType."\" \nDo you want choose another property or movie?";
   $text = "Do you prefer to tell me something else about you \nor can I recommend you a movie?";

   $keyboard = [
      ["✔ Recommend me a movie"],
      ["🔎 Let me choose additional properties"]
   ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,
                                                   'resize_keyboard' => true,
                                                   'one_time_keyboard' => true]);


   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);

//🎞🎲📼📺🚩🔍🔎🌐🔄✔️🔃☑️🔘⚪️⚫️🔴
}