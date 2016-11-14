<?php

function resetPropertyValueRatingReply($telegram, $chatId, $firstname){

	$userID = $chatId;  

   $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
   $result = deletePropertyRating($chatId);
      
   $newNumberOfRatedProperties = $result;

   if ($newNumberOfRatedProperties < $oldNumberOfRatedProperties) {
      $text = "All right ".$firstname.", i reset all properties that you have evaluated";
   } else{
      $text = "Sorry ".$firstname.", there was a problem to reset all properties that you have evaluated";
   }

   $keyboard = [
         ['🔴 I want to choose some movie properties'],
         ['🔵 I want to choose some movies']
     ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);

}