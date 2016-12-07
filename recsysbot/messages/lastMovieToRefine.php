<?php

function lastMovieToRefine($chatId, $pagerankCicle){

   $replyFunctionCall = "lastMovieToRefine";
   $result = getChatMessage($chatId, $replyFunctionCall, $pagerankCicle);
   if ($result != "null") {
   	$replyText = $result['reply_text'];
   	$reply = $replyText;
   }
   else{
   	$reply = "null";
   }   

   file_put_contents("php://stderr", "lastMovieToRefine:".$reply.PHP_EOL);

   return $reply;
}