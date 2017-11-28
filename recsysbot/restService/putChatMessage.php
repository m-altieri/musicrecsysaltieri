// <?php
use GuzzleHttp\Client;

function putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $botTimestamp, $responseType) {
	
	$config = require '/app/recsysbot/config/movierecsysbot-config.php';
	
	$userID = $chatId;
	$base_uri = $config['base_uri'];
	$client = new Client ( [ 
			'base_uri' => $base_uri
	] );
	$stringGetRequest = $config['application_uri'] . '/restService/chatMessage/putChatMessage?userID=' . $userID . '&messageID=' . $messageId . '&context=' . $context . '&replyFunctionCall=' . $replyFunctionCall . '&replyText=' . urlencode ( $replyText ) . '&pagerankCicle=' . $pagerankCicle . '&botName=' . $botName . '&botTimestamp=' . $botTimestamp . '&responseType=' . $responseType;
	file_put_contents ( "php://stderr", $base_uri . $stringGetRequest . "/return:" . $data . PHP_EOL );
	
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg );
		
	return $data;
}