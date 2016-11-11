<?php
use GuzzleHttp\Client;

function putPropertyRating($chatId, $propertyType, $propertyName, $rating){

	$userID = 6;
	
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
		case "category":
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
      $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
      $stringGetRequest = '/lodrecsysrestful/restService/propertyRating/putPropertyRating?userID='.$userID.'&propertyTypeURI='.$propertyTypeURI.'&propertyURI='.$propertyURI.'&rating='.$rating;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);
      file_put_contents("php://stderr", "putPropertyRating return:".$data.PHP_EOL);
   }
   else{
      $data = null;
   }
	//file_put_contents("php://stderr", "putPropertyRating stringGetRequest:".$stringGetRequest.PHP_EOL);
   

   return $bodyMsg;
}