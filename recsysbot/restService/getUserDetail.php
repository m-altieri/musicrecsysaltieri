// <?php
use GuzzleHttp\Client;
function getUserDetail($chatId) {
	$userID = $chatId;
	// $client = new Client(['base_uri'=>'http://localhost:8080']);
	$client = new Client ( [ 
			'base_uri' => 'http://193.204.187.192:8080' 
	] );
	$stringGetRequest = '/movierecsysrestful/restService/users/getUserDetail?userID=' . $userID;
// 	$response = $client->request ( 'GET', $stringGetRequest );
// 	$bodyMsg = $response->getBody ()->getContents ();
// 	$data = json_decode ( $bodyMsg, true );
	
	$ch = curl_init("http://193.204.187.192:8080" . $stringGetRequest);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res = curl_exec($ch);
	curl_close($ch);
	
	file_put_contents ( "php://stderr", "http://193.204.187.192:8080" . $stringGetRequest . "/return:" . $bodyMsg . PHP_EOL );
	
	return json_decode($res, true);
}
