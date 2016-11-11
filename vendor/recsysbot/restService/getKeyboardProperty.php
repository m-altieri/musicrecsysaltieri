<?php 

use GuzzleHttp\Client;

function getKeyboardProperty($chatId, $propertyType){
   //$userID = $chatId;
   $userID = 6;

   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/property?userID='.$userID.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
  
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
         switch ($propertyType) {
            case "/directors": case "directors": case "director":
               $result[] = array("📽"." ".$property);
               break;
            case "/starring": case "starring":
               $result[] = array("🕴"." ".$property);
               break;
            case "/categories": case "categories": case "category":
               $property = str_replace("Category:", "", $property);
               $result[] = array("📼"." ".$property);
               break;
            case "/genres": case "genres": case "genre":
               $result[] = array("🎬"." ".$property);
               break;
            case "/writers": case "writers": case "writer":
                $result[] = array("🖊"." ".$property);
               break;
            case "/producers": case "producers": case "producer":
                $result[] = array("💰"." ".$property);
               break;
            case "/release year": case "release year": case "releaseYear":
                $result[] = array("🗓"." ".$property);
               break;
            case "/music composers": case "music composers": case "music composer": case "musicComposer": case "music":
               $result[] = array("🎼"." ".$property);
               break;
            case "/runtimeRange": case "runtimeRange": case "runtime":
               //no
               $result[] = array("🕰"." ".$property);
               break;
            case "/cinematographies": case "cinematographies": case "cinematography":
                $result[] = array("📷"." ".$property);
               break;
            case "/based on": case "based on": case "basedOn":
               //no
                $result[] = array("📔"." ".$property);
               break;
            case "/editings": case "editings": case "editing":
                $result[] = array("💼"." ".$property);
               break;
            case "/distributors": case "distributors": case "distributor":
                $result[] = array("🏢"." ".$property);
               break;
            default:
               break;
         }
      }
   }   

   $keyboard = $result;
   $keyboard[] = array("Menu");

   return $keyboard;
}
