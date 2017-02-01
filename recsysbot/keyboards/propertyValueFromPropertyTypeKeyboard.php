<?php 

use GuzzleHttp\Client;

function propertyValueFromPropertyTypeKeyboard($chatId, $propertyType){  

   file_put_contents("php://stderr", "propertyValueFromPropertyTypeKeyboard - propertyType:".$propertyType.PHP_EOL);

   $data = getPropertyValueListFromPropertyType($chatId, $propertyType);

   $keyboard = array();
   $propertyArray = array();
   $scoreUpdate = 0.0000000000001;
   if ($data !== "null") {
      $returnType = "Properties";
      foreach ($data as $propertyScore => $propertyValue) {               
         $propertyName = str_replace("http://dbpedia.org/resource/", "", $propertyValue);
         $propertyName = str_replace('_', ' ', $propertyName); // Replaces all underscore with spaces.
         $propertyArray[$propertyScore] = $propertyName;
         krsort($propertyArray);               
      }
   }

   $keyboard = createKeaboardFromPropertyArrayAsScoreToPropertyValueFunction($propertyArray, $propertyType);
   $keyboard[] = array("🔙 Return to the list of Properties");

   return $keyboard;
}
