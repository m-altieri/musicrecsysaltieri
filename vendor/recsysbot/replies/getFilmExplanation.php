<?php 
 
use GuzzleHttp\Client;
use Telegram\Bot\FileUpload\InputFile; 

function getFilmExplanation($telegram, $chatId, $movie){
   $movieName = str_replace(' ', '_', $movie); 
   $userID = 8;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/explanation?movieName='.$movieName;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);

   //Gestire il caso di risposta nulla

   $result = array();
   $keyboard = array();

   $directors = $starring = $categories = $writers = $producers = $musicComposers = $cinematographies = $based = $editings = $distributors = array();
   $runtime = $releaseDate = $poster = $title = "";

   foreach ($data as $key => $value){
      foreach ($value as $k => $v) {
         $propertyType = str_replace("http://dbpedia.org/ontology/", "", $v[1]);
         $property = str_replace("http://dbpedia.org/resource/", "", $v[2]);
         $property = str_replace('_', ' ', $property); // Replaces all underscore with spaces.

            switch ($propertyType) {
               case "/directors": case "directors": case "director":
                  $directors[] = $property;
                  break;
               case "/starring": case "starring":
                  $starring[] = $property;
                  break;
               case "/categories": case "categories": case "category": case "http://purl.org/dc/terms/subject":
                  $property = str_replace("Category:", "", $property);
                  $categories[] = $property;
                  break;
               case "/genres": case "genres": case "genre":
                   $genres[] = $property;
                  break;
               case "/runtime": case "runtime":       
                  $runtime = $property;
                  break;
               case "/writers": case "writers": case "writer":
                   $writers[] = $property;
                  break;
               case "/producers": case "producers": case "producer":
                   $producers[] = $property;
                  break;
               case "/release date": case "release date": case "releaseDate":
                  $releaseDate = $property;
                  break;
               case "/music composers": case "music composers": case "music composer": case "musicComposer":
                  //no
                  $musicComposers[] = $property;
                  break;
               case "/cinematographies": case "cinematographies": case "cinematography":
                   $cinematographies[] = $property;
                  break;
               case "/based on": case "based on": case "basedOn":
                  $based[] = $property;
                  break;
               case "/editings": case "editings": case "editing":
                  $editings[] = $property;
                  break;
               case "/distributors": case "distributors": case "distributor":
                  $distributors[] = $property;
                  break;
               case "poster":
                  $poster = $property;
                  break;
               case "title":
                  $title = $property;
                  break;
               default:
                  break;
         }
      }
   }
   $director = implode(", ", array_reverse($directors));
   $producer = implode(", ",array_reverse($producers));
   $writer = implode(", ", array_reverse($writers));
   $star = implode(", ", array_reverse($starring));
   $musicComposer = implode(", ", array_reverse($musicComposers));
   $cinematography = implode(", ", array_reverse($cinematographies));
   $editing = implode(", ", array_reverse($editings));
   $distributor = implode(", ",array_reverse($distributors));
   $basedOn = implode(", ", array_reverse($based));
   $category = implode(", ", array_reverse($categories));


   
   //$img = './images/poster.jpg';
   //file_put_contents($img, file_get_contents($poster));

   if ($poster != '' AND $poster != "N/A" ) {
      $remoteImage = $poster;
      $img = './images/poster.jpg';

      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);
      $telegram->sendPhoto(['chat_id' => $chatId,'photo' => $poster]);
   }

   if ($title != '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Title: ".$title]);}

   if ($director != '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Directed by ".$director]);}

   if ($producer !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Produced by ".$producer]);}

   if ($writer !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Written by ".$writer]);}

   if ($star !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Starring: ".$star]);}

   if ($musicComposer !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Music by ".$musicComposer]);}

/*   if ($cinematography !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Cinematography: ".$cinematography]);}*/
      
/*   if ($editing !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Edited by ".$editing]);}*/

   if ($distributor !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Distributed by ".$distributor]);}

/*   if ($basedOn !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Based on: ".$basedOn]);}*/

   if ($category !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Category: ".$category]);}

   if ($runtime !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Running time: ".$runtime." minute"]);}

   if ($releaseDate !== '') {$telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => "Release dates: ".$releaseDate]);}

}