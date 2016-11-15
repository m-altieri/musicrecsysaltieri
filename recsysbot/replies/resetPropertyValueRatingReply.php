<?php

function resetPropertyValueRatingReply($telegram, $chatId, $firstname){

	$userID = $chatId;  

   $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
   $result = deleteAllPropertyRated($chatId);
      
   $newNumberOfRatedProperties = $result;

   if ($newNumberOfRatedProperties < $oldNumberOfRatedProperties) {
      $text = "All right ".$firstname.", i reset all properties that you have evaluated";
   } else{
      $text = "Sorry ".$firstname.", there was a problem to reset all properties that you have evaluated";
   }

   $keyboard = startProfileAcquisitionKeyboard();

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);

}