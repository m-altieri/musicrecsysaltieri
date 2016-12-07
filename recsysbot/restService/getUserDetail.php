// <?php
 
use GuzzleHttp\Client;

function getUserDetail($chatId, $replyFunctionCall){

	$userID = $chatId;
		// $client = new Client(['base_uri'=>'http://localhost:8080']);
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest = '/lodrecsysrestful/restService/users/getUserDetail?userID='.$userID;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg, true);

   file_put_contents("php://stderr", "http://193.204.187.192:8080".$stringGetRequest."/return:".$bodyMsg.PHP_EOL);

   return $data;
   
}
