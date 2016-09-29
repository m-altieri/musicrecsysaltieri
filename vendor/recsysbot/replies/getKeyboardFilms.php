<?php 

function getKeyboardFilms($chatId, $propertyName, $propertyType){
   
   $userID = 8;
   //$propertyName = "Chris_Noonan";
   //$propertyType = "director";
   //$client = new Client(['base_uri'=>'http://lodrecsysrestful.herokuapp.com']);
   //$stringGetRequest ='/restService/films?userID='.$userID.'&propertyName='.$propertyName.'&propertyType='.$propertyType;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/films?userID='.$userID.'&propertyName='.$propertyName.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   $result = array();
   $keyboard = array();

   foreach ($data as $key => $value){
      foreach ($value as $k => $v) {
         $film = str_replace("http://dbpedia.org/resource/", "", $v);
         $film = str_replace('_', ' ', $film); // Replaces all underscore with spaces.
         $result[] = array(" ".$film);
      }
   }

   //Costruisco la tastiera Elimino i duplicati e i nomi anomali
   foreach($result as $key => $value){
      if(($i = array_search($value,$result))!== FALSE and $key==$i and strlen($value[0]) < 30){   
        $keyboard[] = $result[$i];
      }
   }
   //$keyboard[] = array("🔙", "why ❔", "detail 💬");
   $keyboard[] = array("Menu");

   return $keyboard;
}