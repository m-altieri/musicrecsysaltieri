<?php

function oldMovieToRefine($chatId, $pagerankCicle){

   $replyFunctionCall = "lastMovieToRefine";
   $oldPagerankCicle = $pagerankCicle-1;
   $result = getChatMessage($chatId, $replyFunctionCall, $oldPagerankCicle);
   if ($result !== "null") {
   	$replyText = $result['reply_text'];
   	$reply = $replyText;
   }
   else{
   	$reply = "null";
   }   
   file_put_contents("php://stderr", "oldMovieToRefine:".$reply." - oldPagerankCicle:".$oldPagerankCicle.PHP_EOL);

   return $reply;
}