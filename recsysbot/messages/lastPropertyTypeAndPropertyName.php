<?php

//function propertyRatingReply($telegram, $chatId, $propertyType, $propertyValue){   
function lastPropertyTypeAndPropertyName($chatId){

   $replyFunctionCall = "propertyValueRatingReply";
   $result = getChatMessage($chatId, $replyFunctionCall);
   $replyText = $result['reply_text'];
   $reply = explode(",", $replyText);
   //$propertyType = $reply[0];
   //$propertyName = $reply[1];
   $reply[1] = substr($reply[1],1);

   return $reply;
}