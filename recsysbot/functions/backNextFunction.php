<?php 

use Recsysbot\Classes\userMovieRecommendation;

function backNextFunction($telegram, $chatId, $text, $userMovieRecommendation){
   //Return to the list of recommended movies
   //Pensare a come non mandare sempre in esecuzione il pagerank per recuperare la lista

   switch ($text) { 
      case stristr($text, '1') !== false:  
      case stristr($text, '2') !== false: 
      case stristr($text, '3') !== false: 
      case stristr($text, '4') !== false: 
      case stristr($text, '5') !== false: 
         file_put_contents("php://stderr", "backNextFunction - text: ".$text.PHP_EOL);
         $userMovieRecommendation->setText($text);
         $userMovieRecommendation->handle();
         break;
      default:
         allPropertyTypeReply($telegram, $chatId);
         break;
      }

}