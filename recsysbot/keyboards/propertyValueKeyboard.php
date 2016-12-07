<?php 

use GuzzleHttp\Client;

function propertyValueKeyboard($chatId, $propertyType, $text){   

   $reply = explode("\"", $text);
   $movieName = isset($reply[1])? $reply[1] : null;
   //$movieName = "cast away";   

   file_put_contents("php://stderr", "propertyValueKeyboard - propertyType:".$propertyType.PHP_EOL);
   file_put_contents("php://stderr", "propertyValueKeyboard - movieName:".$movieName.PHP_EOL);

   $data = getPropertyValueListFromPropertyType($chatId, $propertyType);
  
   $result = array();
   $keyboard = array();
   $propertyArray = array();
   if ($data != "null") {
      if ($movieName == null) {
         $returnType = "Properties";
         foreach ($data as $movie => $propertiesValue){
            //echo '<pre>'; print_r("All movies: ".$movie); echo '</pre>';
            foreach ($propertiesValue as $propertyScore => $propertyValue) {
               //echo '<pre>'; print_r($propertiesValue); echo '</pre>';
               $propertyName = str_replace("http://dbpedia.org/resource/", "", $propertyValue);
               $propertyName = str_replace('_', ' ', $propertyName); // Replaces all underscore with spaces.
               list($score, $property) = explode(',', $propertyName);
               $propertyArray[$score] = $property;
               krsort($propertyArray);               
            }
         }
      }
      else{
         $returnType = "\"property\" of \"".$movieName."\"";
         foreach ($data as $movie => $propertiesValue){
            //echo '<pre>'; print_r("Single movie: ".$movie); echo '</pre>';
            $movieName = str_replace(' ', '_', $movieName); // Replaces all spaces with underscore.
            if (strpos(strtolower($movie),strtolower($movieName))) {
               foreach ($propertiesValue as $propertyScore => $propertyValue) {
                  //echo '<pre>'; print_r($propertiesValue); echo '</pre>';
                  $propertyName = str_replace("http://dbpedia.org/resource/", "", $propertyValue);
                  $propertyName = str_replace('_', ' ', $propertyName); // Replaces all underscore with spaces.
                  list($score, $property) = explode(',', $propertyName);
                  $propertyArray[$score] = $property;
                  krsort($propertyArray);                  
               }
            }            
         }         
      }
      
      //echo '<pre>'; print_r($propertyArray); echo '</pre>';
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
   $keyboard[] = array("🔙 Return to the list of ".$returnType);

   return $keyboard;
}
