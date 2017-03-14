<?php

function recMovieToRefocusSelected($chatId, $pagerankCicle){

   $context = "recMovieToRefocusSelected";
   $result = getChatMessage($chatId, $context, $pagerankCicle);
   if ($result !== "null") {
      $replyText = $result['reply_text'];
      $reply = explode(",", $replyText);
      //$reply[1] = substr($reply[1],1);
   }
   else{
      $reply = "null";
   }  

   file_put_contents("php://stderr", "recMovieToRefocusSelected:".$reply[1]." - pagerankCicle:".$pagerankCicle.PHP_EOL);

   return $reply;
}