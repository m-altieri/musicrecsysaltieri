<?php
 
function addmovieOrPropertyRating($propertyValue, $propertyType, $rating){

   $movieOrPropertyRating = $propertyValue;
   switch ($propertyType) {
      case "movie":
         if ($rating == 1) {
            $movieOrPropertyRating = ucwords($propertyValue)." - "."👍 liked movie";
         } 
         elseif ($rating == 0){
            $movieOrPropertyRating = ucwords($propertyValue)." - "."👎 disliked movie";
         }
         break;
      case ($propertyType !== 'movie'):
         if ($rating == 1) {
            $movieOrPropertyRating = ucwords($propertyValue)." - "."🙂 liked ".$propertyType;
         } 
         elseif ($rating == 0){
            $movieOrPropertyRating = ucwords($propertyValue)." - "."😑 disliked ".$propertyType;
         }
         break;
      default:
         break;
   }
   return $movieOrPropertyRating;
}