<?php

use GuzzleHttp\Client;
	
function sayHi() {
	
    $config = require '/app/recsysbot/config/movierecsysbot-config.php';

	$client = new Client ( [ 
			'base_uri' => $config['base_uri']
	] );

        // debug
        file_put_contents ("php://stderr", $config['base_uri'] . PHP_EOL);

	$stringGetRequest = '/movierecsysservice/restService/sayHi';
	$response = $client->request ( 'GET', $stringGetRequest );
	$bodyMsg = $response->getBody ()->getContents ();
	$data = json_decode ( $bodyMsg );
	
	file_put_contents ( "php://stderr", "http://193.204.187.192:8090" . $stringGetRequest . "/return:" . $data . PHP_EOL );

	return $data;

}

?>
