<?php

function refineMoviePropertyKeyboard($chatId, $movie){

   //$userID = $chatId;
   $userID = 6;
   
   $movieName = str_replace(' ', '_', $movie);  
   $data = getAllPropertyListFromMovie($movieName);

   $fullMenuArray = array();

   $directors = $starring = $categories = $genres = $writers = $producers = $musicComposers = $cinematographies = $basedOn = $editings = $distributors = $runtimeRange = $releaseYear = array();
   $title = $plot = $language = $country = $awards = $poster = $trailer = "";
   if ($data != "null") {
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
                  $runtimeRange[] = $property;
                  break;
               case "/writers": case "writers": case "writer":
                   $writers[] = $property;
                  break;
               case "/producers": case "producers": case "producer":
                   $producers[] = $property;
                  break;
               case "/release date": case "release date": case "releaseDate": case "releaseYear":
                  $releaseYear[] = $property;
                  break;
               case "/music composers": case "music composers": case "music composer": case "musicComposer":
                  $musicComposers[] = $property;
                  break;
               case "/cinematographies": case "cinematographies": case "cinematography":
                   $cinematographies[] = $property;
                  break;
               case "/based on": case "based on": case "basedOn":
                  $basedOn[] = $property;
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

      $size_director = count($directors);
      $size_starring = count($starring);
      $size_category = count($categories);
      $size_genre = count($genres);
      $size_writer = count($writers);
      $size_producer = count($producers);
      $size_releaseYear = count($releaseYear);
      $size_musicComposer = count($musicComposers);
      $size_runtimeRange = count($runtimeRange);
      $size_cinematography = count($cinematographies);
      $size_basedOn = count($basedOn);
      $size_editing = count($editings);
      $size_distributor = count($distributors);

      $fullMenuArray[10+$size_director."director"] = "Directors of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_starring."starring"] = "Actors of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_category."category"] = "Categories of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_genre."genre"] = "Genres of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_writer."writer"] = "Writes of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_producer."producer"] = "Producers of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_releaseYear."releaseYear"] = "Release year of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_musicComposer."musicComposer"] = "Music of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_runtimeRange."runtimeRange"] = "Runtime of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_cinematography."cinematography"] = "Cinematographies of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_basedOn."basedOn"] = "Based on of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_editing."editing"] = "Editings of \"".ucwords($movie)."\"";
      $fullMenuArray[10+$size_distributor."distributor"] = "Distributors of \"".ucwords($movie)."\"";
      krsort($fullMenuArray);
   }

   //echo '<pre>'; print_r($fullMenuArray); echo '</pre>';

   $keyboard = array();
   foreach ($fullMenuArray as $key => $property) {
       $keyboard[] = array($property);
   }

   $propertyType = "Movies";
   $keyboard[] = array("🔙 Return to the list of \"".$propertyType."\"");

   return $keyboard;
}
