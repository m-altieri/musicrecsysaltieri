<?php

//function propertyRatingReply($telegram, $chatId, $propertyType, $propertyValue){   
function propertyValueRatingReply($telegram, $chatId, $propertyType, $propertyValue){   

   $userID = 6;
   $propertyName = substr($propertyValue,5);

   $keyboard = [
      ["😃 I like \"".ucwords($propertyName)."\" as \"".$propertyType."\""],
      ["😑 I dislike \"".ucwords($propertyName)."\" as \"".$propertyType."\""],
      ["🤔 Is indifferente to me \"".ucwords($propertyName)."\" as \"".$propertyType."\""],
      ["🔙 Return to the list of \"".$propertyType."\""]
   ];

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Do you like \"".ucwords($propertyName)."\" as ".$propertyType."?";

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);


}