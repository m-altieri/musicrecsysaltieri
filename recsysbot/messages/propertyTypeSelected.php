<?php

function propertyTypeSelected($chatId, $pagerankCicle){

   $context = "propertyTypeSelected";
   $result = getChatMessage($chatId, $context, $pagerankCicle);
   if ($result !== "null") {
   	$replyText = $result['reply_text'];
   	$reply = $replyText;
   }
   else{
   	$reply = "null";
   }   

   file_put_contents("php://stderr", "propertyTypeSelected:".$reply." - pagerankCicle:".$pagerankCicle.PHP_EOL);

   return $reply;
}