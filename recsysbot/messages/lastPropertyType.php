<?php

function lastPropertyType($chatId){

   $replyFunctionCall = "propertyValueReply";
   $result = getChatMessage($chatId, $replyFunctionCall);
   $replyText = $result['reply_text'];
   $reply = $replyText;

   return $reply;
}