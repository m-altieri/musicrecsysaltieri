// <?php
use GuzzleHttp\Client;
$config = require_once '/app/recsysbot/config/movierecsysbot-config.php';

function putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $botTimestamp, $responseType) {
	$userID = $chatId;
	// $client = new Client(['base_uri'=>'http://localhost:8080']);
	$client = new Client ( [ 
			'base_uri' => $config['base_uri'] 
	] );
	$stringGetRequest = $config['application_uri'] . '/restService/chatMessage/putChatMessage?userID=' . $userID . '&messageID=' . $messageId . '&context=' . $context . '&replyFunctionCall=' . $replyFunctionCall . '&replyText=' . urlencode ( $replyText ) . '&pagerankCicle=' . $pagerankCicle . '&botName=' . $botName . '&botTimestamp=' . $botTimestamp . '&responseType=' . $responseType;
	file_put_contents ( "php://stderr", $config['base_uri'] . $stringGetRequest . "/return:" . $data . PHP_EOL );
	
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg );
		
	return $data;
}