
<?php
 
function createKeaboardFromPropertyArrayAsScoreToPropertyValueForMovieFunction($propertyArray, $propertyType){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$result = array();

	foreach ($propertyArray as $score => $propertyValue) {
     switch ($propertyType) {
         case "/directors": case "directors": case "director":
            $result[] = array("".$emojis['clapperboard'].""." ".ucwords($propertyValue)." - Director");
            break;
         case "/starring": case "starring":
            $result[] = array("".$emojis['manhovering'].""." ".ucwords($propertyValue)." - Actor");
            break;
         case "/categories": case "categories": case "category": case "http://purl.org/dc/terms/subject":
            $propertyValue = str_replace("Category:", "", $propertyValue);
            $result[] = array("".$emojis['videocassette'].""." ".ucwords($propertyValue)." - Category");
            break;
         case "/genres": case "genres": case "genre":
            $result[] = array("".$emojis['filmframe'].""." ".ucwords($propertyValue)." - Genre");
            break;
         case "/writers": case "writers": case "writer":
             $result[] = array("".$emojis['pen'].""." ".ucwords($propertyValue)." - Writer");
            break;
         case "/producers": case "producers": case "producer":
             $result[] = array("".$emojis['moneybag'].""." ".ucwords($propertyValue)." - Producer");
            break;
         case "/release year": case "release year": case "releaseYear":
               $result = releaseYearFilterKeyboard();
               break;
         case "/music composers": case "music composers": case "music composer": case "musicComposer": case "music":
            $result[] = array("".$emojis['musicscore'].""." ".ucwords($propertyValue)." - Music composer");
            break;
         case "/runtimeRange": case "runtimeRange": case "runtime":
            $result = runtimeRangeFilterKeyboard();
            break;
         case "/cinematographies": case "cinematographies": case "cinematography":
             $result[] = array("".$emojis['camera'].""." ".ucwords($propertyValue)." - Cinematography");
            break;
         case "/based on": case "based on": case "basedOn":
             $result[] = array("".$emojis['notebook'].""." ".ucwords($propertyValue)." - Based on");
            break;
         case "/editings": case "editings": case "editing":
             $result[] = array("".$emojis['briefcase'].""." ".ucwords($propertyValue)." - Editor");
            break;
         case "/distributors": case "distributors": case "distributor":
             $result[] = array("".$emojis['building'].""." ".ucwords($propertyValue)." - Distributor");
            break;
         default:
            break;
      }
   }
    // echo '<pre>'; echo("createKeaboardFromPropertyArrayAsScoreToPropertyValueForMovieFunction:"); echo '</pre>';
    // echo '<pre>propertyArray'; print_r($propertyArray); echo '</pre>';
    // echo '<pre>propertyType'; print_r($propertyType); echo '</pre>';
    // echo '<pre>'; echo("result:"); echo '</pre>';
    // echo '<pre>'; print_r($result); echo '</pre>';

   return $result;
}