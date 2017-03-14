<?php 

use GuzzleHttp\Client;

function propertyValueKeyboard($chatId, $propertyType, $text){   

   $reply = explode("\"", $text);
   $movieName = isset($reply[1])? $reply[1] : null;

   $keyboard = array();
   if ($movieName == null) {
      //Probabilmente vanno gestite le nuove tastiere per release year e runtime range
      $keyboard = propertyValueFromPropertyTypeKeyboard($chatId, $propertyType);
   }      
   else{
      $keyboard = propertyValueFromPropertyTypeAndMovieKeyboard($chatId, $propertyType, $text);
   }   

   return $keyboard;
}