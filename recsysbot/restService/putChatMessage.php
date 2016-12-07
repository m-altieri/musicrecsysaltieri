// <?php
 
use GuzzleHttp\Client;

function putChatMessage($chatId, $messageId, $replyFunctionCall, $replyText, $pagerankCicle, $botTimestamp){

	$userID = $chatId;
	// $client = new Client(['base_uri'=>'http://localhost:8080']);
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/chatMessage/putChatMessage?userID='.$userID.'&messageID='.$messageId.'&replyFunctionCall='.$replyFunctionCall.'&replyText='.$replyText.'&pagerankCicle='.$pagerankCicle.'&botTimestamp='.$botTimestamp;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   file_put_contents("php://stderr", "http://193.204.187.192:8080".$stringGetRequest."/return:".$data.PHP_EOL);

   return $data;
   
}
//http://localhost:8080/lodrecsysrestful/restService/chatMessage/putChatMessage?userID=6&messageID=13336&replyFunctionCall=lastMovieToRefine&replyText=cabaret (1972 film)&pagerankCicle=0&botTimestamp=1480583300
//http://localhost:8080/lodrecsysrestful/restService/chatMessage/putChatMessage?userID=6&messageID=13350&replyFunctionCall=lastMovieToRefine&replyText=alien 3&pagerankCicle=1&botTimestamp=1480583656
//http://localhost:8080/lodrecsysrestful/restService/chatMessage/putChatMessage?userID=6&messageID=13352&replyFunctionCall=lastMovieToRefine&replyText=alien 3&pagerankCicle=2&botTimestamp=1480583657
//http://localhost:8080/lodrecsysrestful/restService/chatMessage/putChatMessage?userID=6&messageID=13360&replyFunctionCall=lastMovieToRefine&replyText=commando (1985 film)&pagerankCicle=3&botTimestamp=1480583690