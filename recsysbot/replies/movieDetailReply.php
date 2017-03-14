<?php 
 
use GuzzleHttp\Client;
use Telegram\Bot\FileUpload\InputFile;

function movieDetailReply($telegram, $chatId, $movie, $page){

   $textSorry ="Sorry :)\nI don't understand \nPlease enter a command (es.\"/start\") ";   
   $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore
   $data = getAllPropertyListFromMovie($movie_name);

   $result = array();
   $keyboard = array();

   $directors = $starring = $genres = $writers = $producers = array();
   $runtimeMinutes = $releaseYear = $title = $imdbRating = $poster = "";
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
               case "director":
                  $directors[] = $property;
                  break;
               case "starring":
                  $starring[] = $property;
                  break;
               case "genre":
                   $genres[] = $property;
                  break;
               case "runtimeMinutes":      
                  $runtimeMinutes = $property;
                  break;
               case "writer":
                   $writers[] = $property;
                  break;
               case "producer":
                   $producers[] = $property;
                  break;
               case "releaseYear":
                  $releaseYear = $property;
                  break;
               case "title":
                  $title = $property;
                  break;
               case "imdbRating":
                  $imdbRating = $property;
                  break;
               case "poster":
                  $poster = $property;
                  break;
               default:
                  //test
                  //$telegram->sendMessage(['chat_id' => $chatId, 'text' => $textSorry]);
                  break;
            }
         }
      }

      $director = implode(", ", array_slice($directors, 0, 3));
      $star = implode(", ", array_slice($starring, 0, 3));
      $genre = implode(", ", array_slice($genres, 0, 3));

      $producer = implode(", ",array_slice($producers, 0, 3));
      $writer = implode(", ", array_slice($writers, 0, 3));    

      if ($poster != '' AND $poster != "N/A" ) {   
         $img = './recsysbot/images/poster.jpg';
         //$img = curl_file_create('test.png','image/png');
         //file_put_contents($img, file_get_contents($poster));
         //copy('http://somedomain.com/file.jpeg', '/tmp/file.jpeg');
         copy($poster, $img); //copia nell'immagine l'immagine del poster
         $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);
         $telegram->sendPhoto(['chat_id' => $chatId,'photo' => $img]);
         copy('./recsysbot/images/default.jpg', './recsysbot/images/poster.jpg'); //copia nel poster l'immagine di default
      }

/*      $text = "";
      if ($title != '') {$text .= "*Title:* ".$title;}
      if ($director != '') {$text .= "\n*Directed by* ".$director;}
      if ($star !== '') {$text .= "\n*Starring:* ".$star."...";}
      if ($genre !== '') {$text .= "\n*Genre:* ".$genre;}
      if ($releaseYear !== '') {$text .= "\n*Release year:* ".$releaseYear;}*/

      $text = "";
      if ($title !== '') {$text .= "🎥 *".$title."*";}
         if ($releaseYear !== '') {$text .= " *(".$releaseYear.")*";}

      if ($runtimeMinutes !== '') {$text .= "\n_".$runtimeMinutes."min_ "."⭐️*".$imdbRating."*"." @imdb";}
      
      $SizeDirectors = count($directors);
      if ($SizeDirectors <= 3) {
         if ($director !== '') {$text .= "\n*Director: *".$director;}
         elseif($producer !== '') {$text .= "\n*Producers: *".$producer;}
            elseif($writer !== '') {$text .= "\n*Writers: *".$writer;}
      } else {
         if ($director !== '') {$text .= "\n*Director: *".$director."...";}
         elseif($producer !== '') {$text .= "\n*Producers: *".$producer;}
            elseif($writer !== '') {$text .= "\n*Writers: *".$writer;}
      }  
      
      if ($star !== '') {$text .= "\n*Actors: *".$star."...";}
         elseif($director !== '' && $producer !== '') {$text .= "\n*Producers: *".$producer;}
            elseif($director !== '' && $writer !== '') {$text .= "\n*Writers: *".$writer;}      

      if ($genre !== '') {$text .= "\n*Genres: *".$genre;}


      if ($page == 1) {
         $nextPage = $page+1;
         $keyboard = [
                        //["🎯 Accept recommendation"],
                        //["🌀 Revise your preferences to find the right movie"],
                        ["😃 Like", "🙁 Dislike","🌀 Like, but..."],
                        //["🔘 List of Recommended Movies"],
                        ["📑 Details","📣 Why?"],
                        ["Next ".$nextPage." 👉"],
                        ['🔙 Home','👤 Profile']

                     ];
      } 
      elseif ($page > 1 && $page < 5) {
         $nextPage = $page+1;
         $backPage = $page-1;
         $keyboard = [
                        //["🎯 Accept recommendation"],
                        //["🌀 Revise your preferences to find the right movie"],
                        ["😃 Like", "🙁 Dislike","🌀 Like, but..."],
                        //["🔘 List of Recommended Movies"],
                        ["📑 Details","📣 Why?"],
                        ["👈 Back ".$backPage,"Next ".$nextPage." 👉"],
                        ['🔙 Home','👤 Profile']
                     ];
      }
      elseif($page > 4) {
         $backPage = 4;
         $keyboard = [
                        //["🎯 Accept recommendation"],
                        //["🌀 Revise your preferences to find the right movie"],
                        ["😃 Like", "🙁 Dislike","🌀 Like, but..."],
                        //["🔘 List of Recommended Movies"],
                        ["📑 Details","📣 Why?"],
                        ["👈 Back ".$backPage."", "💢 Change"],
                        ['🔙 Home','👤 Profile']
                     ];
      }
      
      echo '<pre>'; echo($text); echo '</pre>';
      echo '<pre>'; print_r($keyboard); echo '</pre>';

      $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

/*      $inLineKeyboard =[
         ["Detail of \"".ucwords($movie)."\""]
      ];*/
      //$textInlineKeyboardButton = "Detail of \"".ucwords($movie)."\"";
      //$telegram->inlineKeyboardButton(['text' => $textInlineKeyboardButton]);

/*      $reply_markup1 = $telegram->inlineKeyboardMarkup(['inline_keyboard' => $keyboard]);
            $telegram->sendMessage(['chat_id' => $chatId, 
                              'text' => $text,
                              'reply_markup' => $reply_markup1 
                           ]);*/


      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup, 'parse_mode' => 'Markdown']);
   }
}
