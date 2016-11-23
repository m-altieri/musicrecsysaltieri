<?php 
 
use GuzzleHttp\Client;
use Telegram\Bot\FileUpload\InputFile;

function movieDetailReply($telegram, $chatId, $movie){

   $textSorry ="Sorry :)\nI don't understand \nPlease enter a command (es.\"/start\") ";   
   $movieName = str_replace(' ', '_', $movie); 
   $data = getAllPropertyListFromMovie($movieName);

   $result = array();
   $keyboard = array();

   $directors = $starring = $categories = $genres = $writers = $producers = $musicComposers = $cinematographies = $based = $editings = $distributors = array();
   $runtime = $releaseDate = $title = $plot = $language = $country = $awards = $poster = $trailer = "";
   if ($data == "null") {
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $textSorry]);
   } else {
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
               case "/runtime": case "runtime": case "runtimeRange":      
                  $runtime = $property;
                  break;
               case "/writers": case "writers": case "writer":
                   $writers[] = $property;
                  break;
               case "/producers": case "producers": case "producer":
                   $producers[] = $property;
                  break;
               case "/release date": case "release date": case "releaseDate": case "releaseYear":
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
               case "title":
                  $title = $property;
                  break;
               case "plot":
                  $plot = $property;
                  break;
               case "language":
                  $language = $property;
                  break;
               case "country":
                  $country = $property;
                  break;
               case "awards":
                  $awards = $property;
                  break;
               case "poster":
                  $poster = $property;
                  break;
               case "trailer":
                  $trailer = $property;
                  break;
               default:
                  //test
                  //$telegram->sendMessage(['chat_id' => $chatId, 'text' => $textSorry]);
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
      $genre = implode(", ", array_reverse($genres));

      if ($poster != '' AND $poster != "N/A" ) {   
         $img = './recsysbot/images/poster.jpg';
         //$img = curl_file_create('test.png','image/png');
         //file_put_contents($img, file_get_contents($poster));
         //copy('http://somedomain.com/file.jpeg', '/tmp/file.jpeg');
         copy($poster, $img);
         $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);
         $telegram->sendPhoto(['chat_id' => $chatId,'photo' => $img]);
         copy('./recsysbot/images/default.jpg', './recsysbot/images/poster.jpg');
      }

      $text = "";
      if ($title != '') {$text .= "*Title:* ".$title;}
      if ($director != '') {$text .= "\n*Directed by* ".$director;}
      //if ($producer !== '') {$text .= "\n*Produced by* ".$producer;}
      //if ($writer !== '') {$text .= "\n*Written by* ".$writer;}
      if ($star !== '') {$text .= "\n*Starring:* ".$star;}
      //if ($musicComposer !== '') {$text .="\n*Music by* ".$musicComposer;}
      //if ($cinematography !== '') {$text .= "\n*Cinematography:* ".$cinematography;}      
      //if ($editing !== '') {$text .= "\n*Edited by* ".$editing;}
      //if ($distributor !== '') {$text .= "\n*Distributed by* ".$distributor;}
      //if ($basedOn !== '') {$text .= "\n*Based on:* ".$basedOn;}
      //if ($category !== '') {$text .= "\n*Category:* ".$category;}
      if ($genre !== '') {$text .= "\n*Genre:* ".$genre;}
      //if ($awards !== '') {$text .= "\n*Awards:* ".$awards;}
      //if ($runtime !== '') {$text .= "\n*Running time:* ".$runtime." minute";}
      if ($releaseDate !== '') {$text .= "\n*Release year:* ".$releaseDate;}
      //if ($plot !== '') {$text .= "\n*Plot:* ".$plot;}

      //$keyboard[] = array("🏁 I accept the recommendation","🔍 I want to refine It");

      $keyboard = [
            ["🏁 I accept the recommendation"],
            ["💭 Why have I received this recommendation?"],
            ["🔍 I want to refine this recommendation"],
            ["🔙 Return to the list of Movies"]
         ];

      $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

/*      $inLineKeyboard =[
         ["Detail of \"".ucwords($movie)."\""]
      ]*/;
      //$textInlineKeyboardButton = "Detail of \"".ucwords($movie)."\"";
      //$telegram->inlineKeyboardButton(['text' => $textInlineKeyboardButton]);

/*      $reply_markup1 = $telegram->inlineKeyboardMarkup(['inline_keyboard' => $keyboard]);
            $telegram->sendMessage(['chat_id' => $chatId, 
                              'text' => $text,
                              'reply_markup' => $reply_markup1 
                           ]);*/


      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
      $telegram->sendMessage(['chat_id' => $chatId, 
                              'text' => $text,
                              'reply_markup' => $reply_markup, 
                              'parse_mode' => 'Markdown']);
   }
}
