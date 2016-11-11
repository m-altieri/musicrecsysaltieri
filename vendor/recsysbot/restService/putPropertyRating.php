<?php
use GuzzleHttp\Client;

function putPropertyRating($userID, $propertyType, $propertyName, $rating){
	
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
	         $propertyTypeURI = "http://dbpedia.org/resource/";
	         $propertyTypeURI .= $propertyName;
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
      $stringGetRequest = '/lodrecsysrestful/restService/propertyRating/put?userID='.$userID.'&propertyTypeURI='.$propertyTypeURI.'&propertyURI='.$propertyURI.'&rating='.$rating;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);
   }
   else{
      $data = null;
   }

   file_put_contents("php://stderr", "putPropertyRating return:".$bodyMsg.PHP_EOL);

   return $bodyMsg;
}