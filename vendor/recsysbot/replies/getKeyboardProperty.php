<?php 

function getKeyboardProperty($chatId, $propertyType){
   $userID = 8;
   //$client = new Client(['base_uri'=>'http://lodrecsysrestful.herokuapp.com']);
   //$stringGetRequest ='/restService/property?userID='.$userID.'&propertyType='.$propertyType;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/property?userID='.$userID.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   $result = array();
   $keyboard = array();

   foreach ($data as $key => $value){
      foreach ($value as $k => $v) {
         $property = str_replace("http://dbpedia.org/resource/", "", $v);
         $property = str_replace('_', ' ', $property); // Replaces all underscore with spaces.
         switch ($propertyType) {
               case "/directors": case "directors": case "director":
                  $result[] = array("📽"." ".$property);
                  break;
               case "/starring": case "starring":
                  $result[] = array("🕴"." ".$property);
                  break;
               case "/categories": case "categories": case "category":
                  $result[] = array("🗒"." ".$property);
                  break;
               case "/runtime": case "runtime":
                  //no
                  $result[] = array("⏳"." ".$property);
                  break;
               case "/writers": case "writers": case "writer":
                   $result[] = array("✍"." ".$property);
                  break;
               case "/producers": case "producers": case "producer":
                   $result[] = array("💰"." ".$property);
                  break;
               case "/release date": case "release date": case "releaseDate":
                   $result[] = array("🗓"." ".$property);
                  break;
               case "/music composers": case "music composers": case "music composer": case "musicComposer":
                  //no
                  $result[] = array("🎼"." ".$property);
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

   //Costruisco la tastiera Elimino i duplicati e i nomi anomali
   foreach($result as $key => $value){
      if(($i = array_search($value,$result))!== FALSE and $key==$i and strlen($value[0]) < 50){   
        $keyboard[] = $result[$i];
      }
   }
   $keyboard[] = array("Menu");


   return $keyboard;
}