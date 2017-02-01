<?php

function lastMovie($chatId, $pagerankCicle){

   $replyFunctionCall = "lastMovie"; //movieDetailReply
   $result = getChatMessage($chatId, $replyFunctionCall, $pagerankCicle);
   if ($result !== "null") {
   	$replyText = $result['reply_text'];
   	$reply = $replyText;
   }
   else{
   	$reply = "null";
   }   

   file_put_contents("php://stderr", "lastMovie:".$reply." - pagerankCicle:".$pagerankCicle.PHP_EOL);

   return $reply;
}