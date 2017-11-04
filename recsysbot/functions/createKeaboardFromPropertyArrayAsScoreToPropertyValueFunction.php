<?php
 
function createKeaboardFromPropertyArrayAsScoreToPropertyValueFunction($propertyArray, $propertyType){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$result = array();
	foreach ($propertyArray as $score => $propertyValue) {
         switch ($propertyType) {
            case "/directors": case "directors": case "director":
               $result[] = array("".$emojis['clapperboard'].""." ".ucwords($propertyValue));
               break;
            case "/starring": case "starring":
               $result[] = array("".$emojis['manhovering'].""." ".ucwords($propertyValue));
               break;
            case "/categories": case "categories": case "category": case "http://purl.org/dc/terms/subject":
               $propertyValue = str_replace("Category:", "", $propertyValue);
               $result[] = array("".$emojis['videocassette'].""." ".ucwords($propertyValue));
               break;
            case "/genres": case "genres": case "genre":
               $result[] = array("".$emojis['filmframe'].""." ".ucwords($propertyValue));
               break;
            case "/writers": case "writers": case "writer":
                $result[] = array("".$emojis['pen'].""." ".ucwords($propertyValue));
               break;
            case "/producers": case "producers": case "producer":
                $result[] = array("".$emojis['moneybag'].""." ".ucwords($propertyValue));
               break;
            case "/release year": case "release year": case "releaseYear":
               //$result[] = array("".$emojis['calendar'].""." ".ucwords($propertyValue));
               $result = releaseYearFilterKeyboard();
               break;
            case "/music composers": case "music composers": case "music composer": case "musicComposer": case "music":
               $result[] = array("".$emojis['musicscore'].""." ".ucwords($propertyValue));
               break;
            case "/runtimeRange": case "runtimeRange": case "runtime":
               //$result[] = array("".$emojis['clockflat'].""." Under ".ucwords($propertyValue)." minutes";
               $result = runtimeRangeFilterKeyboard();
               break;
            case "/cinematographies": case "cinematographies": case "cinematography":
                $result[] = array("".$emojis['camera'].""." ".ucwords($propertyValue));
               break;
            case "/based on": case "based on": case "basedOn":
                $result[] = array("".$emojis['notebook'].""." ".ucwords($propertyValue));
               break;
            case "/editings": case "editings": case "editing":
                $result[] = array("".$emojis['briefcase'].""." ".ucwords($propertyValue));
               break;
            case "/distributors": case "distributors": case "distributor":
                $result[] = array("".$emojis['building'].""." ".ucwords($propertyValue));
               break;
            default:
               break;
         }
      }
   return $result;
}
