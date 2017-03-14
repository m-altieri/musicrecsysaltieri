<?php 

use GuzzleHttp\Client;

function propertyValueFromPropertyTypeAndMovieKeyboard($chatId, $propertyType, $text){   

   $reply = explode("\"", $text);
   $movieName = isset($reply[1])? $reply[1] : "null"; 

   $data = getPropertyValueListFromPropertyTypeAndMovie($chatId, $propertyType);
   
   $keyboard = array();
   $propertyArray = array();
   $scoreUpdate = 0.0000000000001;
   $returnType = "Properties";
   if ($data !== "null" && $movieName !== "null" ) {

      $returnType = "\"property\" of \"".$movieName."\"";

      foreach ($data as $movie => $propertiesValue){ 
         $movie_name = str_replace(' ', '_', $movieName); // Replaces all spaces with underscore.
         if (strpos(strtolower($movie),strtolower($movie_name))) {

            foreach ($propertiesValue as $propertyScore => $propertyValue) {
               $propertyName = str_replace("http://dbpedia.org/resource/", "", $propertyValue);
               $propertyName = str_replace('_', ' ', $propertyName); // Replaces all underscore with spaces.
               list($score, $property) = explode(',', $propertyName);
               if( isset( $propertyArray[$score])) {
                  //aggiorna lo score per avere chiavi diverse
                  $score = floatval($score) + $scoreUpdate;
                  $scoreUpdate = $scoreUpdate + 0.0000000000001;                     
                  
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

   $keyboard = createKeaboardFromPropertyArrayAsScoreToPropertyValueForMovieFunction($propertyArray, $propertyType);
   $keyboard[] = array("🔙 Return to the list of ".$returnType);

   return $keyboard;
}
