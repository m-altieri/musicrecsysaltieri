<?php

function lastPropertyType($chatId, $pagerankCicle){

   $replyFunctionCall = "lastPropertyType";
   $result = getChatMessage($chatId, $replyFunctionCall, $pagerankCicle);
   if ($result !== "null") {
   	$replyText = $result['reply_text'];
   	$reply = $replyText;
   }
   else{
   	$reply = "null";
   }   

   file_put_contents("php://stderr", "lastPropertyType:".$reply." - pagerankCicle:".$pagerankCicle.PHP_EOL);

   return $reply;
}