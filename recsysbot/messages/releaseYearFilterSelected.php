<?php

function releaseYearFilterSelected($chatId, $pagerankCicle){

   $context = "releaseYearFilterSelected";
   $result = getChatMessage($chatId, $context, $pagerankCicle);
   if ($result !== "null") {
      $replyText = $result['reply_text'];
      $reply = explode(",", $replyText);
      //$propertyType = $reply[0];
      //$propertyName = $reply[1];
      $reply[1] = substr($reply[1],1);
   }
   else{
      $reply = "null";
   }   

   file_put_contents("php://stderr", "releaseYearFilterSelected propertyType:".$reply[0]." - pagerankCicle:".$pagerankCicle.PHP_EOL);
   file_put_contents("php://stderr", "releaseYearFilterSelected propertyValue:".$reply[1]." - pagerankCicle:".$pagerankCicle.PHP_EOL);

   return $reply;
}