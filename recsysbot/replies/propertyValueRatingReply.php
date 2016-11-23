<?php

//function propertyRatingReply($telegram, $chatId, $propertyType, $propertyValue){   
function propertyValueRatingReply($telegram, $chatId){

   $reply =  lastPropertyTypeAndPropertyName($chatId);
   $propertyType = $reply[0];
   $propertyName = $reply[1];

   $text = "Do you like \"".ucwords($propertyName)."\"?";
   $keyboard = [
      ["😃 I like \"".ucwords($propertyName)."\""],
      ["😑 I dislike \"".ucwords($propertyName)."\""],
      ["🤔 Is indifferente to me"],
      ["🔙 Return to the list of ".$propertyType]
   ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);   

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);

}
