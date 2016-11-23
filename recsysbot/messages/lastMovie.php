<?php

function lastMovie($chatId){

   $replyFunctionCall = "movieDetailReply";
   $result = getChatMessage($chatId, $replyFunctionCall);
   $replyText = $result['reply_text'];
   $reply = $replyText;

   return $reply;
}