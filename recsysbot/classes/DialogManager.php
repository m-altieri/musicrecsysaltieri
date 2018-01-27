<?php

namespace Recsysbot\Classes;
use Exception;
use GuzzleHttp\Client;

class DialogManager
{
	protected $platform;
	protected $chatId;
	
	public function __construct($platform, $chatId){
		$this->platform = $platform;
		$this->chatId = $chatId;
	}
	
	public function sendMessage($text) {
		$contexts = $this->getContexts();
		$data = $this->sendIntentRequest($contexts, $text);
		$webServiceResponse = $this->sendRequestToWebService($data);
		$this->handleResponse($webServiceResponse);
	}
	
	public function sendIntentRequest($contexts, $text) {
		$contextObj = [];
		if ($contexts['responseDone'] == true) {
			$contextObj = $contexts['contexts'];
		}
		$obj = [
				'contexts' => $contextObj,
				'query' => $text,
				'sessionId' => $this->chatId,
				'lang' => "en"
		];
		$client = new Client(['base_uri'=> getApiAiBaseURL()]);
		$stringGetRequest = '/v1/query?v=20150910';
		$response = $client->request('POST', $stringGetRequest, [
				'headers' => [
						'Authorization'     => 'Bearer '.getAccessToken(),
						'Content-Type'      => 'application/json'
				],
				'json' => $obj
		]);
		$bodyMsg = $response->getBody()->getContents();
		$data = json_decode($bodyMsg, true);
		file_put_contents("php://stderr", "Sent message /return:".print_r($data, true).PHP_EOL);
		return $data;
	}
	
	public function sendRequestToWebService($data) {
		$client = new Client();
		$response = $client->post('193.204.187.192:8090/movierecsysservice/restService/dialogMessage/', [
				'json' => $data,
				'connect_timeout' => 0
		]);
		$bodyMsg = $response->getBody()->getContents();
		$responseDecoded = json_decode($bodyMsg, true);
		file_put_contents("php://stderr", "Response is:".print_r($responseDecoded).PHP_EOL);
		return $responseDecoded;
	}
	
	
	public function getContexts() {
		file_put_contents("php://stderr", "Called getContexts".PHP_EOL);
		
		$client = new Client();
		$uri = '193.204.187.192:8090/movierecsysservice/restService/getContext?userID=' . $this->chatId;
		file_put_contents("php://stderr", "uri is ".$uri.PHP_EOL);
		$response = $client->request('GET', $uri);
		$responseDecoded = json_decode($response->getBody()->getContents(), true);
		file_put_contents("php://stderr", "Response is:".print_r($responseDecoded).PHP_EOL);
		return $responseDecoded;
	}
	
	public function handleResponse($data) {
		$textResponse = $data['speech'];
		/*$this->platform->sendChatAction(['chat_id' => $this->chatId, 'action' => 'typing']);
		 $this->platform->sendMessage(['chat_id' => $this->chatId, 'text' => $textResponse]);*/
		$this->writeText($textResponse);
		
		//Controlla se c'Ã¨ un'immagine da visualizzare
		if ($data['data']['image'] != null) {
			$this->sendImage($data['data']['image'],
					$data['data']['imageCaption']);
			
			//Se c'Ã¨ un messaggio da visualizzare dopo l'immagine
			if ($data['data']['postImageSpeech'] != null) {
				$this->writeText($data['data']['postImageSpeech']);
			}
		}
		
		//Controlla se si deve chiamare un'api
		if ($data['data']['apiURL'] != null) {
			file_put_contents("php://stderr", "Found an auxiliary API request".PHP_EOL);
			$this->sendAuxiliaryRequest($data['data']['apiURL']);
		}
		if ($data['data']['auxAPI'] != null) {
			file_put_contents("php://stderr", "Found an auxiliary POST API request".PHP_EOL);
			$this->sendAuxiliaryPostRequest($data['data']['auxAPI']);
		}
		
	}
	
	public function sendAuxiliaryRequest($uri) {
		file_put_contents("php://stderr", "Sending a request to:".$uri.PHP_EOL);
		
		$client = new Client();
		$response = $client->request('GET', $uri);
		$bodyMsg = $response->getBody()->getContents();
		$data = json_decode($bodyMsg, true);
		
		file_put_contents("php://stderr", "Auxiliary request sent:".print_r($data, true).PHP_EOL);
		$this->handleResponse($data);
	}
	
	public function sendAuxiliaryPostRequest($data) {
		$url = $data['apiURL'];
		$parameters = $data['parameters'];
		$client = new Client();
		file_put_contents("php://stderr", "Body is:".json_encode($parameters).PHP_EOL);
		$response = $client->post($url, [
				'json' => $parameters,
				'connect_timeout' => 0
		]);
		$bodyMsg = $response->getBody()->getContents();
		$responseDecoded = json_decode($bodyMsg, true);
		file_put_contents("php://stderr", "Response is:".print_r($responseDecoded).PHP_EOL);
		$this->handleResponse($responseDecoded);
	}
	
	public function writeText($text) {
		$messages = explode("\n\n", $text);
		for ($i = 0; $i < sizeof($messages); $i++) {
			if (strlen($messages[$i]) > 0) {
				$this->platform->sendChatAction(['chat_id' => $this->chatId, 'action' => 'typing']);
				$this->platform->sendMessage($this->chatId, $messages[$i], array());
			}
		}
	}
	
	public function sendImage($image, $caption) {
		try {
			$response = $this->platform->sendPhoto($this->chatId, $image, $caption, array());
		} catch (Exception $e) {
			file_put_contents("php://stderr", "Image is not valid!".PHP_EOL);
		}
	}

}