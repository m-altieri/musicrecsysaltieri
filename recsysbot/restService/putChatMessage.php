<?php
 
use GuzzleHttp\Client;

function putChatMessage($chatId, $messageID, $replyFunctionCall, $replyText, $pagerankCicle, $botTimestamp){

	$userID = $chatId;

   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/chat/putChatMessage?userID='.$userID.'&messageID='.$messageID.'&replyFunctionCall='.$replyFunctionCall.'&replyText='.$replyText.'&pagerankCicle='.$pagerankCicle.'&botTimestamp='.$botTimestamp;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   file_put_contents("php://stderr", "putChatMessage return:".$data.PHP_EOL);

   return $data;
}