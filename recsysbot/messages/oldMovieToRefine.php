<?php

function oldMovieToRefine($chatId, $pagerankCicle){

   $replyFunctionCall = "lastMovieToRefine";
   $result = getChatMessage($chatId, $replyFunctionCall, $pagerankCicle-1);
   if ($result != "null") {
   	$replyText = $result['reply_text'];
   	$reply = $replyText;
   }
   else{
   	$reply = "null";
   }   
   file_put_contents("php://stderr", "oldMovieToRefine:".$reply.PHP_EOL);

   return $reply;
}