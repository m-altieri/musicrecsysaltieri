<?php 

function backFunction($telegram, $chatId, $text){
   //Return to the list of recommended movies
   //Pensare a come non mandare sempre in esecuzione il pagerank per recuperare la lista

	file_put_contents("php://stderr", "back function:".$text.PHP_EOL); 
	switch ($text) { 
      case stristr($text, 'movies') !== false:  
      	file_put_contents("php://stderr", "back - movies: ".$text.PHP_EOL); 
         recommendationMovieListTop5Reply($telegram, $chatId);
         break;
      case stristr($text, 'properties') !== false:
      	file_put_contents("php://stderr", "back - properties: ".$text.PHP_EOL); 
         allPropertyTypeReply($telegram, $chatId);
         break;
      case stristr($text, 'property')  !== false:
      	file_put_contents("php://stderr", "back - property: ".$text.PHP_EOL); 
         $reply = explode("\"", $text);
         $textRefine = "to \"".$reply[3]."\"";
         //refineMoviePropertyReply($telegram, $chatId, $textRefine, $pagerankCicle);
         callRefineOrRefocusFunction($telegram, $chatId);
         break;
      case stristr($text, 'short') !== false:  
      	file_put_contents("php://stderr", "back - base:".$text.PHP_EOL); 
         basePropertyTypeReply($telegram, $chatId);
         break;
      default:
         $reply = explode(" ", $text);
         $propertyType =$reply[6];
         $textRefine = null;
         propertyValueReply($telegram, $chatId, $propertyType, $textRefine);
      	break;
      }



/*   $reply = explode("\"", $text);
   $propertyType = $reply[1];
   file_put_contents("php://stderr", "propertyType: ".$propertyType.PHP_EOL);       
   if ($propertyType == "movies") {
      recommendationMovieListTop5Reply($telegram, $chatId);
   }
   elseif ($propertyType == "properties") {
      allPropertyTypeReply($telegram, $chatId);
   }
   elseif ($propertyType == "property") {
      $textRefine = "to \"".$reply[3]."\"";
      file_put_contents("php://stderr", "return ".$textRefine.PHP_EOL);
      $pagerankCicle = getNumberPagerankCicle($chatId);
      refineMoviePropertyReply($telegram, $chatId, $textRefine, $pagerankCicle);
   }
   else{
      $textRefine = null;
      propertyValueReply($telegram, $chatId, $propertyType, $textRefine);
   } */
}