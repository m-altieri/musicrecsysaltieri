<?php
require './../../../vendor/autoload.php';

use GuzzleHttp\Client;
   
   $movie="Titanic_(1997_film)";
   $movieName = str_replace(' ', '_', $movie); 
   $userID = 8;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/explanation?movieName='.$movieName;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   $result = array();
   $keyboard = array();
   $directors = $starring = $categories = $writers = $producers = $musicComposers = $cinematographies = $based = $editings = $distributors = array();
   $runtime = $releaseDate = $poster = $title = "";

   //print_r($data);echo '<br/>';

   foreach ($data as $key => $value){
      foreach ($value as $k => $v) {
/*         print_r("<br> v-->");
         print_r($v);
         print_r("<br>");*/
         $propertyType = str_replace("http://dbpedia.org/ontology/", "", $v[1]);
         //$propertyType = str_replace('_', ' ', $propertyType); // Replaces all underscore with spaces.
         $property = str_replace("http://dbpedia.org/resource/", "", $v[2]);
         $property = str_replace('_', ' ', $property); // Replaces all underscore with spaces.
/*         print_r("<br> propertyType-->");
         print_r($propertyType);
         print_r("<br>");
         print_r("<br> property-->");
         print_r($property);
         print_r("<br>");*/
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
   $star = implode(", ", array_reverse($starring));
   $writer = implode(", ", array_reverse($writers));
   $cinematography = implode(", ", array_reverse($cinematographies));
   $musicComposer = implode(", ", array_reverse($musicComposers));
   $producer = implode(", ",array_reverse($producers));
   $editing = implode(", ", array_reverse($editings));
   $distributor = implode(", ",array_reverse($distributors));
   $basedOn = implode(", ", array_reverse($based));
   $category = implode(", ", array_reverse($categories));
   $writer = implode(", ", array_reverse($writers));

   print_r("Title: ".$title);echo '<br/>';   
   print_r("Director: ".$director);echo '<br/>';
   print_r("Starring: ".$star);echo '<br/>';
   print_r("Writer: ".$writer);echo '<br/>';
   print_r("Cinematography: ".$cinematography);echo '<br/>';
   print_r("Music composer: ".$musicComposer);echo '<br/>';
   print_r("Producer: ".$producer);echo '<br/>';
   print_r("editing: ".$editing);echo '<br/>';
   print_r("distributor: ".$distributor);echo '<br/>';
   print_r("Based On: ".$basedOn);echo '<br/>';
   print_r("Category: ".$category);echo '<br/>';
   print_r("Runtime:".$runtime);echo '<br/>';
   print_r("Release date:".$releaseDate);echo '<br/>';
   print_r("Poster:".$poster);echo '<br/>';

   if ($poster != '' AND $poster != "N/A" ) {   
      $img = './../../../images/poster.jpg';
      file_put_contents($img, file_get_contents($poster));
      
   }
 
