<?php 

use GuzzleHttp\Client;

function propertyValueFromPropertyTypeAndMovieKeyboard($chatId, $propertyType, $text){   

   $reply = explode("\"", $text);
   $movieName = isset($reply[1])? $reply[1] : null;
   //$movieName = "gone girl (film)";  

   file_put_contents("php://stderr", "propertyValueKeyboard - propertyType:".$propertyType.PHP_EOL);
   file_put_contents("php://stderr", "propertyValueKeyboard - movieName:".$movieName.PHP_EOL);

   $data = getPropertyValueListFromPropertyTypeAndMovie($chatId, $propertyType);
   
   $keyboard = array();
   $propertyArray = array();
   $scoreUpdate = 0.0000000000001;
   $returnType = "Properties";
   if ($data !== "null") {
      if ($movieName == null) {
         //magari richiamare l'altra funzione
      }
      else{
         $returnType = "\"property\" of \"".$movieName."\"";
         foreach ($data as $movie => $propertiesValue){            
            
            $movieName = str_replace(' ', '_', $movieName); // Replaces all spaces with underscore.
            if (strpos(strtolower($movie),strtolower($movieName))) {
               //echo '<pre>'; print_r("Single movie: ".$movie); echo '</pre>';
               foreach ($propertiesValue as $propertyScore => $propertyValue) {
                  //echo '<pre>'; print_r($propertiesValue); echo '</pre>';
                  $propertyName = str_replace("http://dbpedia.org/resource/", "", $propertyValue);
                  $propertyName = str_replace('_', ' ', $propertyName); // Replaces all underscore with spaces.
                  list($score, $property) = explode(',', $propertyName);
                  if( isset( $propertyArray[$score])) {
                     //echo '<pre>'; print_r("score: ".$score); echo '</pre>';
                     $score = floatval($score) + $scoreUpdate;
                     $scoreUpdate = $scoreUpdate + 0.0000000000001;                     
                     
                     //echo '<pre>'; print_r("scoreUpdate: ".$scoreUpdate); echo '</pre>';
                     //echo '<pre>'; print_r("newscore: ".$score); echo '</pre>';
                     $propertyArray[sprintf($score)] = $property;
                  }
                  else{
                     $propertyArray[$score] = $property;
                  }                  
                  krsort($propertyArray);                  
               }            
            }            
         }         
      }      
   }

   $keyboard = createKeaboardFromPropertyArrayAsScoreToPropertyValueForMovieFunction($propertyArray, $propertyType);
   $keyboard[] = array("🔙 Return to the list of ".$returnType);

   return $keyboard;
}
