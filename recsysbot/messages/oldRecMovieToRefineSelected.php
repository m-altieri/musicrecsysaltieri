<?php

function oldRecMovieToRefineSelected($chatId, $pagerankCicle){
   //valutare che il pagerank non deve andare in neativo
   $context = "recMovieToRefineSelected";
   $oldPagerankCicle = $pagerankCicle-1;
   if ($oldPagerankCicle<0) {
      $oldPagerankCicle = 0;
   }
   
   $result = getChatMessage($chatId, $context, $oldPagerankCicle);
   if ($result !== "null") {
      $replyText = $result['reply_text'];
      $reply = explode(",", $replyText);
      //$reply[1] = substr($reply[1],1);
   }
   else{
      $reply = "null";
   } 
   file_put_contents("php://stderr", "oldRecMovieToRefineSelected:".$reply[1]." - oldPagerankCicle:".$oldPagerankCicle.PHP_EOL);

   return $reply;
}