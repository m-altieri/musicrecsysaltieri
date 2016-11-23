<?php
 
use GuzzleHttp\Client;

function getChatMessage($chatId, $replyFunctionCall){

	$userID = $chatId;

   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest = '/lodrecsysrestful/restService/message/getChatMessage?userID='.$userID.'&replyFunctionCall='.$replyFunctionCall;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg, true);

   file_put_contents("php://stderr", "getChatMessage return:".$bodyMsg.PHP_EOL);

   return $data;
   
}