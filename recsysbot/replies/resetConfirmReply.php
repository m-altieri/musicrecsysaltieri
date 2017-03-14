<?php

function resetConfirmReply($telegram, $chatId, $firstname, $deleteType, $preference, $confirm){  

   file_put_contents("php://stderr", "resetConfirmReply - deleteType:".$deleteType.PHP_EOL);
   file_put_contents("php://stderr", "resetConfirmReply - preference:".$preference.PHP_EOL);
   file_put_contents("php://stderr", "resetConfirmReply - confirm:".$confirm.PHP_EOL);

   $text = "Sorry ".$firstname.", there was a problem to reset your preferences";

   if ( (strpos($confirm, 'yes') !== false) && (strpos($deleteType, 'delete') !== false) ) {

      if (strpos($preference, 'properties') !== false) {
         $data = deleteAllPropertyRated($chatId);        
         $newNumberOfRatedProperties = $data;

         if ($newNumberOfRatedProperties == 0) {
            $text = "All right ".$firstname.", i have reset all properties that you have evaluated";
         } else{
            $text = "Sorry ".$firstname.", there was a problem to reset all properties that you have evaluated";
         }

      }
      elseif (strpos($preference, 'movies') !== false) {
         $data = deleteAllMovieRated($chatId);          
         $newNumberOfRatedMovies = $data;

         if ($newNumberOfRatedMovies == 0 ) {
            $text = "All right ".$firstname.", i have reset all movies that you have evaluated";
         } else{
            $text = "Sorry ".$firstname.", there was a problem to reset all movies that you have evaluated";
         }

      }
      elseif(strpos($preference, 'preferences') !== false) {
         $data = deleteAllProfile($chatId);          
         $newNumberPagerankCicle = $data;

         if ($newNumberPagerankCicle == 0 ) {
            $text = "All right ".$firstname.", i have reset all preferences that you have evaluated";
         } else{
            $text = "Sorry ".$firstname.", there was a problem to reset all preferences that you have evaluated";
         }
      }
       
   }
   elseif (strpos($confirm, 'no') !== false) {
      $text = "".ucwords($firstname).", your profile has not been changed";
   }

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);   
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 

   //vai al profilo
   profileReply($telegram, $chatId);

}

