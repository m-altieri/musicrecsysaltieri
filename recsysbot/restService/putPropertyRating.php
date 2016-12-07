<?php
use GuzzleHttp\Client;

function putPropertyRating($chatId, $propertyType, $propertyName, $rating, $lastChange){

	$userID = $chatId;

	$propertyTypeURI = "null";
	$propertyURI = "null";

	
	switch ($propertyType) {
		case "genre": case "releaseYear": case "runtimeRange":
			$propertyTypeURI = $propertyType;
			$propertyURI = $propertyName;
			break;
		case "director": case "starring": case "writer": case "producer": case "musicComposer": case "cinematography": case "basedOn": case "editing": case "distributor":
			if ($propertyName != "null"){
	         $propertyName = str_replace(' ', '_', $propertyName);
	         $propertyURI = "http://dbpedia.org/resource/";
	         $propertyURI .= $propertyName;
	      }
	      if ($propertyType != "null"){
	         $propertyType = str_replace(' ', '_', $propertyType);
	         $propertyTypeURI = "http://dbpedia.org/ontology/";
	         $propertyTypeURI .= $propertyType;
	      }
			break;
		case "category": case "http://purl.org/dc/terms/subject":
			if ($propertyName != "null"){
	         $propertyName = str_replace(' ', '_', $propertyName);
	         $propertyURI = "http://dbpedia.org/resource/Category:";
	         $propertyURI .= $propertyName;
	      }
	      $propertyTypeURI = "http://purl.org/dc/terms/subject";
			break;
		default:
			break;
	}


   if ($propertyURI != "null" && $propertyTypeURI != "null" ){    	
      // $client = new Client(['base_uri'=>'http://localhost:8080']);
      $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
      $stringGetRequest = '/lodrecsysrestful/restService/propertyRating/putPropertyRating?userID='.$userID.'&propertyTypeURI='.$propertyTypeURI.'&propertyURI='.$propertyURI.'&rating='.$rating.'&lastChange='.$lastChange;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);

   	file_put_contents("php://stderr", "http://193.204.187.192:8080".$stringGetRequest."/return:".$data.PHP_EOL);      
   }
   else{
   	file_put_contents("php://stderr", "putPropertyRating/return:".$data.PHP_EOL);
      $data = "null";
   }   

   return $data;
   
}
