<?php

//function propertyRatingReply($telegram, $chatId, $propertyType, $propertyValue){   
function lastPropertyTypeAndPropertyName($chatId, $pagerankCicle){

   $replyFunctionCall = "lastPropertyTypeAndPropertyName";
   $result = getChatMessage($chatId, $replyFunctionCall, $pagerankCicle);
   if ($result != "null") {
      $replyText = $result['reply_text'];
      $reply = explode(",", $replyText);
      //$propertyType = $reply[0];
      //$propertyName = $reply[1];
      $reply[1] = substr($reply[1],1);
   }
   else{
      $reply = "null";
   }   



   file_put_contents("php://stderr", "lastPropertyTypeAndPropertyName 0:".$reply[0].PHP_EOL);
   file_put_contents("php://stderr", "lastPropertyTypeAndPropertyName 1:".$reply[1].PHP_EOL);


   return $reply;
}