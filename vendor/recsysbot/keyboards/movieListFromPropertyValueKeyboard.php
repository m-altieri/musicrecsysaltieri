<?php
 
use GuzzleHttp\Client;

function movieListFromPropertyValueKeyboard($chatId, $propertyName, $propertyType){
   
   //$userID = $chatId;
   $userID = 6;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/movieList/getMovieListFromProperty?userID='.$userID.'&propertyName='.$propertyName.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   //file_put_contents("php://stderr", "getKeyboardFilms return:".$keyboard.PHP_EOL);

   $result = array();
   $keyboard = array();
   if ($data != "null") {
      foreach ($data as $key => $value){
         foreach ($value as $k => $v) {
            $propertyStr = str_replace("http://dbpedia.org/resource/", "", $v);
            $propertyStr = str_replace('_', ' ', $propertyStr); // Replaces all underscore with spaces.
            list($score, $nodo) = explode(',', $propertyStr);
            $propertyArray[$score] = $nodo;
            krsort($propertyArray);
         }
      }
      
      foreach ($propertyArray as $key => $property) {
          $result[] = array(" ".$property);
      }
   }
   
   $keyboard = $result;
   $propertyType = "Properties";
   $keyboard[] = array("🔙 Return to the list of \"".$propertyType."\"");
   
   return $keyboard;
}